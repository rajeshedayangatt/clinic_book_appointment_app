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
}
