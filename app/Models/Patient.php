<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function appointment()
    {
       return $this->hasMany(Appointment::class,'patient_id');
    }
}
