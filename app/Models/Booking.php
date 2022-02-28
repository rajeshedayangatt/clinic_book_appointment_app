<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function specializedIn() {
        return $this->hasOne(Specelization::class,'id','specialization');
    }

    public function doctorDetail() {
        return $this->hasOne(Doctor::class,'id','doctor');
    }

    public function latestBookingTimeByDay($appointment_date){

        $latest_appointment = Booking::where('appointment_date',$appointment_date)
            ->orderBy('id','DESC')
            ->first();

        return $latest_appointment;
        
    }

    public function checkSameBookingTime($appointment_date,$appointment_time) {

        $check_appointment = Booking::where('appointment_date',$appointment_date)
            ->where('start_time','<',$appointment_time)
            ->where('end_time','>',$appointment_time)
            ->first();

        return $check_appointment;
    }
}
