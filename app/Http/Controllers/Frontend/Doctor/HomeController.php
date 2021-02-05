<?php

namespace App\Http\Controllers\Frontend\Doctor;

use Illuminate\Http\Request;
use App\Repository\Doctor\IDoctor;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{   
    public $doctor;

    public function __construct(IDoctor $idoctor)
    {
        $this->doctor = $idoctor;
    }

    public function index()
    {
        $doctor = $this->doctor->getDoctor();

        $doctor->load('certificates','designation');

        return view('welcome', 
                    [
                        'doctors' => $doctor->load('certificates')
                    ]
                );
    }
}
