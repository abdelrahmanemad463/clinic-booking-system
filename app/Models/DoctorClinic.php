<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
class DoctorClinic extends Model
{
    protected $table = 'doctor_clinic';
    
    static public function getAssignDoctorID($doctor_id) {
        return self::select('doctor_clinic.*' , 'clinics.name as clinic_name')
                    ->where('doctor_id' , '=' , $doctor_id)
                    ->join('clinics' , 'clinics.id' , '=' , 'doctor_clinic.clinic_id')
                    ->get();
    }

    static public function getIfExist($doctor_id , $clinic_id) {
        return self::select('doctor_clinic.*')
                    ->where('doctor_id' , '=' , $doctor_id)
                    ->where('clinic_id' , '=' , $clinic_id)
                    ->get();
    }

    static public function getAvailableDoctors() {
        $return = self::select('doctor_clinic.*' , 'users.name as doctor_name' , 'clinics.name as clinic_name','clinics.image','clinics.address','clinics.phone1','clinics.phone2','clinics.phone3','clinics.description','clinics.gps_location')
                    ->join('users' , 'users.id' , '=' , 'doctor_clinic.doctor_id')
                    ->join('clinics' , 'clinics.id' , '=' , 'doctor_clinic.clinic_id');
                    
                    if(!empty(Auth::user()->id)) {
                        $return->where('doctor_id' , '!=' , Auth::user()->id);
                    }

                    $return->where('users.is_doctor' , '=' , '1')
                    ->where('clinics.status' , '=' , '1');

                    if(!empty(Request::get('doctor_name'))){
                    $return = $return->where('users.name' , 'like' ,'%'.trim(Request::get('doctor_name')).'%');
                    }

                    if(!empty(Request::get('clinic_name'))){
                    $return = $return->where('clinics.name' , 'like' ,'%'.trim(Request::get('clinic_name')).'%');
                    }

                    $return = $return->paginate(30);

                    return $return;
    }

}
