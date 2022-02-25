<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Doctor;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Validator;

class ClinicController extends Controller
{
    public function index() {

        return view('home');
    }

    public function showAppointmentForm() {

        $doctors = Doctor::get();

        return view('appointment')->with(['doctors' => $doctors]);
    }


    public function submitAppointmentForm(Request  $request) {

        $validate = Validator::make($request->all(), [
            "appointment_date" => "required",
            "doctor" => "required",
            "patient_name" => "required",
            "reason" => "required",
        ]);

        if($validate->fails()) {
            return ["status" => "Plsease fill the fields"];
        }


        //check double booking

        $appointment_date = date('Y-m-d',strtotime($request->appointment_date));
         $appointment_time = date('H:i',strtotime($request->appointment_date));

        $check_appointment = Booking::where('appointment_date',$appointment_date)
                ->where('start_time',$appointment_time)
                ->first();

        if($check_appointment) {

            return ["status" => "Already Booked This Time. Please select another time"];

        }
        $doctor_id = $request->doctor;
        $patient = $request->patient_name;
        $reason = $request->reason;
        $spec = Doctor::where('id',$doctor_id)->first()->specialization;

        $booking = new Booking();

        $booking->doctor = $doctor_id;
        $booking->specialization = $spec;
        $booking->patient = $patient;
        $booking->appointment_date = $appointment_date;
        $booking->start_time = $appointment_time;
        $booking->end_time = $appointment_time;
        $booking->information = $reason;

        if($booking->save()) {
            return ['status' => 'Successfully Booked'];
        }

        return ['status' => 'Faile To Book'];

    }


    public function showAppointmentCalender() {

        $appointments = Booking::get();

        return view('appointments')->with(['appointments' => $appointments]);
    }

    public function getAppointments() {
        $appointments = Booking::get();

        foreach($appointments as $row)
        {
            $data[] = array(
                'id'   => $row["id"],
                'title'   => $row["patient"]." - ".date('h:i a',strtotime($row["start_time"])),
                'start'   => $row["appointment_date"],
                'end'   => $row["appointment_date"]
            );
        }

        return $data;
    }

    public function detailAppointment(Request  $request) {


        $bookingid = $request->id;

        $appointments = Booking::where('id',$bookingid)->first();

        $appointments_data = [];


        $appointments_data[] = array(

            "patient_name" => $appointments->patient,
            "doctor_name"  => $appointments->doctorDetail->name,
            "specelization"  => $appointments->specializedIn->title,
            "information" => $appointments->information,
            "appointment_date" => date('d/m/Y',strtotime($appointments->appointment_date)),
            "start_time" => date('h:i a',strtotime($appointments->start_time)),

        );


        return $appointments_data;

    }
}
