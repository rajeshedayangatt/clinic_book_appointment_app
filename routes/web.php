<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['App\Http\Controllers\ClinicController','index'])->name('home');
Route::get('/appointment',['App\Http\Controllers\ClinicController','showAppointmentForm'])->name('appointment_form');
Route::post('/appointment-submit',['App\Http\Controllers\ClinicController','submitAppointmentForm'])->name('appointment_form_submit');
Route::get('/appointments',['App\Http\Controllers\ClinicController','showAppointmentCalender'])->name('appointments_calender');
Route::get('/appointment-all',['App\Http\Controllers\ClinicController','getAppointments'])->name('appointment_all');
Route::get('/appointment-detail',['App\Http\Controllers\ClinicController','detailAppointment'])->name('appointment_detail');

