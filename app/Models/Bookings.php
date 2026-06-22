<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
class Bookings extends Model
{
    protected $table = 'bookings';

    static public function CheckIfExist($user_id , $doctor_id , $clinic_id , $date) {
        return self::where('user_id' , '=' , $user_id)
                    ->where('doctor_id' , '=' , $doctor_id)
                    ->where('clinic_id' , '=' , $clinic_id)
                    ->whereDate('date' , '=' , $date)
                    ->get();
    }

    static public function myAppointaments() {
        $return = self::select('bookings.*' , 'users.name as doctor_name', 'clinics.name as clinic_name')
                    ->where('user_id' , '=' , Auth::user()->id)
                    ->join('users' , 'users.id' , '=' , 'bookings.user_id')
                    ->join('clinics' , 'clinics.id' , '=' , 'bookings.clinic_id');

                    if(!empty(Request::get('doctor_name'))){
                    $return = $return->where('users.name' , 'like' ,'%'.trim(Request::get('doctor_name')).'%');
                    }
                    
                    if(!empty(Request::get('clinic_name'))){
                    $return = $return->where('clinics.name' , 'like' ,'%'.trim(Request::get('clinic_name')).'%');
                    }

                    if(!empty(Request::get('created_date_from'))){
                            $return = $return->where('bookings.date' , '>=' , Request::get('created_date_from'));
                    }

                    if(!empty(Request::get('created_date_to'))){
                            $return = $return->where('bookings.date' , '<=' , Request::get('created_date_to'));
                    }

                    $return = $return->paginate(30);

                    return $return;
        
    }

    static public function myAppointamentsDoctor() {

        $return = self::select('bookings.*' , 'users.name as user_name' ,'users.phone1' , 'users.phone2' , 'users.phone3', 'clinics.name as clinic_name')
                    ->where('doctor_id' , '=' , Auth::user()->id)
                    ->join('users' , 'users.id' , '=' , 'bookings.user_id')
                    ->join('clinics' , 'clinics.id' , '=' , 'bookings.clinic_id');
                    
                    if(!empty(Request::get('patient_name'))){
                    $return = $return->where('users.name' , 'like' ,'%'.trim(Request::get('patient_name')).'%');
                    }

                    if(!empty(Request::get('clinic_name'))){
                    $return = $return->where('clinics.name' , 'like' ,'%'.trim(Request::get('clinic_name')).'%');
                    }

                    if(!empty(Request::get('phone_number'))){
                    $return = $return->where('clinics.phone1' , 'like' ,'%'.trim(Request::get('phone_number')).'%');
                    }

                    if(!empty(Request::get('created_date_from'))){
                            $return = $return->where('bookings.date' , '>=' , Request::get('created_date_from'));
                    }

                    if(!empty(Request::get('created_date_to'))){
                            $return = $return->where('bookings.date' , '<=' , Request::get('created_date_to'));
                    }

                    $return = $return->paginate(30);

                    return $return;
        
    }
}
