<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Doctor;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Validator;
use DB;

class ClinicController extends Controller
{

    private $return_message = '';

    
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


        if($this->checkPreviousBookingSlot($request)) {

            return ["status" => $this->return_message];

        }


        if($this->createNewBookingSlot($request)) {

            return ['status' => 'Successfully Booked'];
        }

        return ['status' => 'Faile To Book'];
    }

    private function createNewBookingSlot($request) {


        $appointment_date = date('Y-m-d',strtotime($request->appointment_date));
        $appointment_time = date('H:i:s',strtotime($request->appointment_date));


        $new_booking = new Booking();
        $new_booking->doctor = $request->doctor;
        $new_booking->specialization = Doctor::where('id',$request->doctor)->first()->specialization;
        $new_booking->patient = $request->patient_name;
        $new_booking->appointment_date = $appointment_date;
        $new_booking->start_time = $appointment_time;
        $new_booking->end_time = $this->createNextTimeInterval($request->appointment_date);
        $new_booking->information = $request->reason;

        if($new_booking->save()) {
            return true;
        }

        return false;

    }

    private function checkPreviousBookingSlot($request){


        
        $appointment_date = date('Y-m-d',strtotime($request->appointment_date));
        $appointment_time = date('H:i:s',strtotime($request->appointment_date));


        $booking = new Booking();

        $checkSameBookingTime = $booking->checkSameBookingTime($appointment_date,$appointment_time);

        if($checkSameBookingTime) {

            
            $latestBookingTimeByDay = $booking->latestBookingTimeByDay($appointment_date);

            $next_schedule_book_time = $latestBookingTimeByDay->end_time;
            $next_schedule_book_time = date('h:i a',strtotime($next_schedule_book_time));

            $this->return_message = "Booking slot already been booked. Please select another time slot after ".$next_schedule_book_time;

            return true;
        }

        return false;
    }

    private function createNextTimeInterval($appointment_time_seconds) {
        $appointment_time_seconds = strtotime($appointment_time_seconds);
        $appointment_time_seconds_after_half_hour = $appointment_time_seconds + (30*60);
        $appointment_time_seconds_after_half_hour = date('H:i:s',$appointment_time_seconds_after_half_hour);

        return $appointment_time_seconds_after_half_hour;
    }

   

    
    public function showAppointmentCalender() {

        $appointments = Booking::get();

        return view('appointments')->with(['appointments' => $appointments]);
    }

    public function getAppointments() {
        $appointments = Booking::orderBy('id','ASC')->get();

        foreach($appointments as $row)
        {
            $data[] = array(
                'id'   => $row["id"],
                'title'   => $row["patient"]." - (".date('h:i a',strtotime($row["start_time"]))." - ".
                            date('h:i a',strtotime($row["end_time"])).")",
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
            "end_time" => date('h:i a',strtotime($appointments->end_time)),
        );


        return $appointments_data;

    }
}
