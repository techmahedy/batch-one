<?php

namespace App\Http\Controllers\Frontend\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Exception;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function store($id)
    {   
        $doctor = Doctor::find($id);

        try {
            $doctor->appointment()->create([
                'patient_id' => Auth::guard('patient')->id(),
                'schedule_date' => date('Y-m-d'),
                'status' => 0
             ]);

             return redirect()->route('patient.home');

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
}
