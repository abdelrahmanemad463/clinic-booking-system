<?php

namespace App\Http\Controllers;

use App\Models\Clinics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicsController extends Controller
{
    public function list() {
        $data['header_title'] = 'Clinics List';
        $data['getRecord'] = Clinics::getAll();
        return view('admin.clinics.list' , $data);
    }

    
    public function add() {
        $data['header_title'] = 'Clinics Add';
        return view('admin.clinics.add' , $data);
    }

    public function insert(Request $request) {
        //  dd($request->all());

        $clinic = new Clinics();
        $clinic->name = trim($request->name);
        $clinic->gps_location = trim($request->gps_location);
        $clinic->address = trim($request->address);
        $clinic->phone1 = trim($request->phone1);
        $clinic->phone2 = trim($request->phone2);
        $clinic->phone3 = trim($request->phone3);
        $clinic->status = trim($request->status);
        $clinic->created_by = Auth::user()->id;
        
        $clinic->save();

        return redirect('admin/clinics/list')->with('success' , 'Clinic successfully created');
    }

    public function edit($id) {
        $data['header_title'] = 'Edit User';
        $data['getRecord'] = Clinics::find($id);

        return view('admin.clinics.edit' , $data);
    }

    public function update($id , Request $request) {
        // dd($id , $request->all());

        $clinic = Clinics::find($id);
        $clinic->name = trim($request->name);
        $clinic->gps_location = trim($request->gps_location);
        $clinic->address = trim($request->address);
        $clinic->phone1 = trim($request->phone1);
        $clinic->phone2 = trim($request->phone2);
        $clinic->phone3 = trim($request->phone3);
        $clinic->status = trim($request->status);
        $clinic->save();

        return redirect('admin/clinics/list')->with('success' , 'Clinic successfully updated');
    }

}
