<?php

namespace App\Http\Controllers;

use App\Models\Clinics;
use App\Models\Bookings;
use App\Models\DoctorClinic;
use App\Models\DoctorClinicTimetableModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DoctorController extends Controller
{
    public function my_appointaments_doctor() {
        $data['header_title'] = 'My Appointaments';
        $data['getRecord'] = Bookings::myAppointamentsDoctor();
        return view('doctor.my_appointaments_doctor' , $data);
    }


}
