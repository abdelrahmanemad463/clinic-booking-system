<?php

namespace App\Http\Controllers;

use App\Mail\BookMail;
use App\Mail\DoctorBookMail;
use App\Models\Clinics;
use App\Models\Bookings;
use App\Models\DoctorClinic;
use App\Models\DoctorClinicTimetableModel;
use App\Models\User;
use App\Notifications\UserBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class UserController extends Controller
{
    public function list() {
        $data['header_title'] = 'Avaiable Doctors';
        $data['getRecord'] = DoctorClinic::getAvailableDoctors();
        return view('user.avaiable_doctors.list' , $data);
    }

    
    public function timetable($doctor_id,$clinic_id) {
        $data['header_title'] = 'Timetable';
        $data['doctorName'] = User::find($doctor_id);
        $data['clinicName'] = Clinics::find($clinic_id);
        $data['getRecord'] = DoctorClinicTimetableModel::getRecordDoctorClinic($doctor_id,$clinic_id);
        return view('user.avaiable_doctors.timetable' , $data);
        
    }

    public function book(Request $request) {
        // dd($request->id);
        $timetable = DoctorClinicTimetableModel::find($request->id);

        $CheckIfExist = Bookings::CheckIfExist(Auth::user()->id , $timetable->doctor_id , $timetable->clinic_id , $timetable->date);

        if($CheckIfExist->count() > 0){
            return redirect()->back()->with('error' , 'Already Appointmented in this day');
        }

        $book = new Bookings;
        $book->user_id = Auth::user()->id;
        $book->doctor_id = $timetable->doctor_id;
        $book->clinic_id = $timetable->clinic_id;
        $book->date = $timetable->date;
        $book->start_time = $timetable->start_time;
        $book->end_time = $timetable->end_time;
        $book->session_duration = $timetable->session_duration;
        $book->break_duration = $timetable->break_duration;
        $book->price = $timetable->price;
        $book->save();

        // send mail to user when book
        $auth = Auth::user();  // pass auth in variable instead make Auth::user() in blade view because when run php artisan queue:work it runs from cli and no user will be logged in to send mail so will make error
        // Mail::to(Auth::user()->email)->send(new BookMail($book , $auth));
        // send mail to doctor that user booked to him
        $doctor = User::find($book->doctor_id);
        // Mail::to($doctor->email)->send(new DoctorBookMail($book , $doctor , $auth));
        
        // send notification to doctor that user booked to him
        $content ="You have a new book | name: ".$auth->name." from ".$book->start_time." to ".$book->end_time;
        Notification::send($doctor,new UserBook($content));

        return redirect()->back()->with('success' , 'Appointment Successfully Saved');
        
    }

    public function remove_book(Request $request) {
        // dd($request->id);
        $timetable = DoctorClinicTimetableModel::find($request->id);

        $CheckIfExist = Bookings::CheckIfExist(Auth::user()->id , $timetable->doctor_id , $timetable->clinic_id , $timetable->date);

        foreach ($CheckIfExist as $booking) {
            $booking->delete();
        }

        return redirect()->back()->with('error' , 'Appointment Successfully Removed');
        
    }

    public function my_appointaments_list() {
        $data['header_title'] = 'My Appointaments';
        $data['getRecord'] = Bookings::myAppointaments();
        return view('user.my_appointaments' , $data);
    }

}
