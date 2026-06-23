<?php

namespace App\Http\Controllers;

use App\Models\DoctorClinicTimetableModel;
use App\Models\Clinics;
use App\Models\DoctorClinic;
use App\Models\PermissionRoleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list() {
        $PermissionRole = PermissionRoleModel::getPermission('User' , Auth::user()->role_id);

        if (empty($PermissionRole)) {
                abort(404);
        }

        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add User' , Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit User' , Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete User' , Auth::user()->role_id);

        $data['header_title'] = 'Users List';
        // dd(User::getAll());
        $data['users'] = User::getAll();
        return view('admin.users.list' , $data);
    }

    
    public function add() {
        $PermissionRole = PermissionRoleModel::getPermission('Add User' , Auth::user()->role_id);

        if (empty($PermissionRole)) {
                abort(404);
        }

        $data['header_title'] = 'Users Add';
        return view('admin.users.add' , $data);
    }

    public function insert(Request $request) {
        //  dd($request->all());

         request()->validate([
        'email' => 'required|email|unique:users',
        ]);

        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        
        if (!empty($request->is_doctor)) {
            $user->is_doctor = 1;
        }

        if (!empty($request->is_assistant)) {
            $user->	is_assistant = 1;
        }

        $user->status = $request->status;

        if (!empty($request->phone1)) {
            $user->phone1 = trim($request->phone1);
        }
        if (!empty($request->phone2)) {
            $user->phone2 = trim($request->phone2);
        }
        if (!empty($request->phone3)) {
            $user->phone3 = trim($request->phone3);
        }

        $user->created_by = Auth::user()->id;
        
        $user->save();

        return redirect('admin/users/list')->with('success' , 'User successfully created');
    }

    public function edit($id) {

        $PermissionRole = PermissionRoleModel::getPermission('Edit User' , Auth::user()->role_id);

        if (empty($PermissionRole)) {
                abort(404);
        }

        $data['header_title'] = 'Edit User';
        $data['user'] = User::find($id);

        return view('admin.users.edit' , $data);
    }

    public function update($id , Request $request) {
        // dd($id , $request->all());

        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::find($id);

        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        
        if (!empty($request->is_doctor)) {
            $user->is_doctor = 1;
        }

        if (!empty($request->is_assistant)) {
            $user->	is_assistant = 1;
        }

        if (empty($request->is_doctor)) {
            $user->is_doctor = 0;
        }

        if (empty($request->is_assistant)) {
            $user->	is_assistant = 0;
        }

        if (!empty($request->phone1)) {
            $user->phone1 = trim($request->phone1);
        }
        if (!empty($request->phone2)) {
            $user->phone2 = trim($request->phone2);
        }
        if (!empty($request->phone3)) {
            $user->phone3 = trim($request->phone3);
        }

        $user->status = $request->status;

        $user->save();

        return redirect('admin/users/list')->with('success' , 'User successfully Edited');
    }

    // assign to doctor

    public function assign_list() {
        $PermissionRole = PermissionRoleModel::getPermission('Assign clinic to doctor' , Auth::user()->role_id);

        if (empty($PermissionRole)) {
                abort(404);
        }

        $data['header_title'] = 'assign List';
        // dd(User::getAll());
        $data['getRecord'] = User::getAllDoctors();
        return view('admin.assign.list' , $data);
    }
    public function assign_to_doctor($id) {
        $PermissionRole = PermissionRoleModel::getPermission('Assign to doctor' , Auth::user()->role_id);

        if (empty($PermissionRole)) {
                abort(404);
        }

        $data['header_title'] = 'Assign To Doctor';
        // dd(User::getAll());
        if(User::checkIfNotDoctor($id)->count() > 0) {
            abort(404);
        }

        $data['getRecord'] = User::find($id);
        $data['getClinics'] = Clinics::getAllStatusActive();
        $data['getAssignDoctorID'] = DoctorClinic::getAssignDoctorID($id);

        return view('admin.assign.assign_clinic' , $data);
    }

    public function assign_to_doctor_insert($id , Request $request) {
        // dd($request->all());
        DoctorClinic::where('doctor_id','=' , $id)->delete();
        
        if (!empty($request->assign_clinics)) {
            foreach ($request->assign_clinics as $value) {
                $new = new DoctorClinic;
                $new->doctor_id = $id;
                $new->clinic_id = $value;
                $new->created_by = Auth::user()->id;
                $new->save();
            }
        }

        return redirect('admin/assign/list')->with('success' , 'Doctor successfully Assigned');
    }

    // set_doctor_appointaments

    public function set_doctor_appointaments(Request $request) {

        $PermissionRole = PermissionRoleModel::getPermission('Set Doctor Appointaments' , Auth::user()->role_id);

        if (empty($PermissionRole)) {
                abort(404);
        }

        $data['header_title'] = "Set Doctor Appointaments";

        $data['getDoctor'] = User::getAllDoctors();
        if(!empty($request->doctor_id)){
            $data['getMyClinics'] = DoctorClinic::getAssignDoctorID($request->doctor_id);
        }

        $data['doctorClinic'] = DoctorClinicTimetableModel::getRecordDoctorClinic($request->doctor_id , $request->clinic_id);
       
        
        $data['getIfExist'] = DoctorClinic::getIfExist($request->doctor_id , $request->clinic_id);

        return view('admin.set_doctor_appointaments.set_doctor_appointaments' , $data);

    }

    public function get_clinic(Request $request) {
        $getMyClinics = DoctorClinic::getAssignDoctorID($request->doctor_id);
        $html = "<option value=''>Select</option>" ;
        foreach ($getMyClinics as $value) {
            $html .= "<option value='".$value->clinic_id."'>".$value->clinic_name."</option>" ;
        }

        $json['html'] = $html ;
        echo json_encode($json);
    }

    public function insert_update_doctor_appointaments(Request $request) {
        // dd($request->all());
        DoctorClinicTimetableModel::where('doctor_id' , '=' , $request->doctor_id)->where('clinic_id' , '=' , $request->clinic_id)->delete();

        $getIfExist = DoctorClinic::getIfExist($request->doctor_id , $request->clinic_id);
        if(!$getIfExist->count() > 0){
            abort(404);
        }

        foreach ($request->timetable as $timetable) {
            if(!empty($timetable['date']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['price']) && !empty($timetable['max_requests'])){
                $save = new DoctorClinicTimetableModel;
                $save->doctor_id = $request->doctor_id;
                $save->clinic_id = $request->clinic_id;
                $save->date = $timetable['date'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->session_duration = $timetable['session_duration'];
                $save->break_duration = $timetable['break_duration'];
                $save->price = $timetable['price'];
                $save->max_requests = $timetable['max_requests'];
                $save->save();
            }
        }
        return redirect()->back()->with('success' , 'Doctor Timetable successfully saved');
    }

}
