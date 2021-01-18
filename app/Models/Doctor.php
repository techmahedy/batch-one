<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $guarded = [];
    
    protected $casts = [
        'education' => 'array'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active',1);
    }

    public function setEducationAttribute($value)
    {
        $education = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $education[] = $array_item;
            }
        }

        $this->attributes['education'] = json_encode($education);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class,'doctor_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class,'doctor_id');
    }
}
