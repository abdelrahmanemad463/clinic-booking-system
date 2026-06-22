<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorClinicTimetableModel extends Model
{
    protected $table = 'doctor_clinic_timetable';

    static public function getRecordDoctorClinic($doctor_id , $clinic_id) {
        return self::where('doctor_id' , '=' , $doctor_id)->where('clinic_id' , '=' , $clinic_id)->get();
    }
}
