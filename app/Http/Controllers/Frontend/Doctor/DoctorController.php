<?php

namespace App\Http\Controllers\Frontend\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Repository\Doctor\IDoctor;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public $doctor;

    public function __construct(IDoctor $idoctor)
    {
        $this->doctor = $idoctor;
    }


    public function doctorDetails(Doctor $doctor)
    {
        return view('frontend.doctor.single',[
            'doctor' => $this->doctor->getDoctorDetails($doctor)
        ]);
    }
}
