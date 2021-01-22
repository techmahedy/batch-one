<?php

namespace App\Repository\Doctor;

use App\Models\Doctor;

class DoctorRepository implements IDoctor
{
    
    public function getDoctor()
    {
        return Doctor::all();
    }




}