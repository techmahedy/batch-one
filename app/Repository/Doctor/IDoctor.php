<?php

namespace App\Repository\Doctor;

use App\Models\Doctor;

interface IDoctor
{
      
    public function getDoctor();

    public function getDoctorDetails(Doctor $doctor);

}