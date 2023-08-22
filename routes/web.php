<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Employeecontroller;
use Illuminate\Support\Facades\Route;




Route::get('/login1',[AdminController::class ,'login'] );

//home
Route::get('admin',[AdminController::class ,'index']);
//login
Route::get('login',[AdminController::class ,'login'] );
//submit_button
Route::get('admin/login',[AdminController::class ,'submit_login'] );
Route::post('admin/login',[AdminController::class ,'submit_login'] );
//logout
Route::GET('admin/logout',[AdminController::class ,'logout'] );

//departement routes
Route::get('depart/{id}/delete',[DepartmentController::class,'destroy']);
Route::resource("depart",DepartmentController::class);

//employee routes
Route::get('emp/{id}/delete',[Employeecontroller::class,'destroy']);
Route::resource("emp",Employeecontroller::class);

//admin 
Route::get('/', function () {
    return view('RH');
});
