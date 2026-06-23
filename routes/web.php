<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(url('user/avaiable_doctors/list'));
});

// avaiable doctors
Route::get('user/avaiable_doctors/list', [UserController::class , 'list'] );
Route::get('user/avaiable_doctors/timetable/{doctor_id}/{clinic_id}', [UserController::class , 'timetable'] );

Route::get('/login' , [AuthController::class , 'login']);
Route::post('/login' , [AuthController::class , 'AuthLogin']);
Route::get('/logout' , [AuthController::class , 'logout']);

Route::group(['middleware' => 'auth'] , function(){    // middleware alias in bootstrap/app.php
    Route::get('dashboard', [DashboardController::class , 'dashboard'] );

    // avaiable doctors
    Route::post('user/avaiable_doctors/book', [UserController::class , 'book'] );
    Route::post('user/avaiable_doctors/remove_book', [UserController::class , 'remove_book'] );
    
    //  my appointaments
    Route::get('user/my_appointaments/list', [UserController::class , 'my_appointaments_list'] );


    // users (admin role)
    Route::get('admin/users/list', [AdminController::class , 'list'] );
    Route::get('admin/users/add', [AdminController::class , 'add'] );
    Route::post('admin/users/add', [AdminController::class , 'insert'] );
    Route::get('admin/users/edit/{id}', [AdminController::class , 'edit'] );
    Route::post('admin/users/edit/{id}', [AdminController::class , 'update'] );
    Route::get('admin/users/delete/{id}', [AdminController::class , 'delete'] );

    // roles (admin role)
    Route::get('admin/role', [RoleController::class , 'list'] );
    Route::get('admin/role/add', [RoleController::class , 'add'] );
    Route::post('admin/role/add', [RoleController::class , 'insert'] );
    Route::get('admin/role/edit/{id}', [RoleController::class , 'edit'] );
    Route::post('admin/role/edit/{id}', [RoleController::class , 'update'] );
    Route::get('admin/role/delete/{id}', [RoleController::class , 'delete'] );

    // clinics
    Route::get('admin/clinics/list', [ClinicsController::class , 'list'] );
    Route::get('admin/clinics/add', [ClinicsController::class , 'add'] );
    Route::post('admin/clinics/add', [ClinicsController::class , 'insert'] );
    Route::get('admin/clinics/edit/{id}', [ClinicsController::class , 'edit'] );
    Route::post('admin/clinics/edit/{id}', [ClinicsController::class , 'update'] );
    Route::get('admin/clinics/delete/{id}', [ClinicsController::class , 'delete'] );

    // assign to doctor
    Route::get('admin/assign/list', [AdminController::class , 'assign_list'] );
    Route::get('admin/assign/assign_clinic/{id}', [AdminController::class , 'assign_to_doctor'] );
    Route::post('admin/assign/assign_clinic/{id}', [AdminController::class , 'assign_to_doctor_insert'] );
    
    // set doctor appointaments
    Route::get('admin/set_doctor_appointaments', [AdminController::class , 'set_doctor_appointaments'] );
    Route::post('admin/set_doctor_appointaments/get_clinic', [AdminController::class , 'get_clinic'] );
    Route::post('admin/set_doctor_appointaments/add', [AdminController::class , 'insert_update_doctor_appointaments'] );
    // Doctor My Appointaments
    Route::get('doctor/doctor_appointaments/list', [DoctorController::class , 'my_appointaments_doctor'] );


    // notifications
    Route::get('user/notifications' , [NotificationsController::class , 'list']);

    Route::get('user/read-all-notifications' , [NotificationsController::class , 'readAll']);

    Route::get('user/unread-all-notifications' , [NotificationsController::class , 'unReadAll']);

    Route::get('user/read-notification/{id}', [NotificationsController::class , 'readNotification']);

    Route::get('user/unread-notification/{id}', [NotificationsController::class , 'unReadNotification']);

    Route::get('user/delete-notification/{id}', [NotificationsController::class , 'deleteNotification'] );

});