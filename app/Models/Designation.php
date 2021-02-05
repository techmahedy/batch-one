<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    public function doctor()
    {
       return $this->hasMany(Doctor::class,'designation_id');
    }
}
