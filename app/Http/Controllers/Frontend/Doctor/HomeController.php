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

    public function index(Request $request)
    {   

        $doctor = $this->doctor->getDoctor();

        $doctor = $doctor->when($request->country, function($doctor) use($request){
                    return $doctor->where('country_id',$request->country);
                })
                ->when($request->designation, function($doctor) use($request){
                    return $doctor->where('designation_id',$request->designation);
                });
                
        $select_doctor = [];
        $select_designation = [];
        $select_doctor[] = $request->country;
        $select_designation[] = $request->designation;

        return view('welcome', 
                    [
                        'doctors' => $doctor,
                        'select_doctor' => $select_doctor[0],
                        'selected_designation' => $select_designation[0]
                    ]
                );
    }
}
