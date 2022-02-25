<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function specializedIn() {
        return $this->hasOne(Specelization::class,'id','specialization');
    }
}
