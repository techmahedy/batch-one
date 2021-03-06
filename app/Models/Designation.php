<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Designation extends Model
{
    use HasFactory,Cachable;

    public function doctor()
    {
       return $this->hasMany(Doctor::class,'designation_id');
    }
}
