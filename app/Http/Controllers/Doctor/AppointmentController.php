<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentAcceptedEmail;

class AppointmentController extends Controller
{
    public function index(Appointment $appointment)
    {
       $doctor_id = Auth::guard('doctor')->id();
       return view('doctor.appointment.list',[
           'appointments' => $appointment->where('doctor_id',$doctor_id)->with('patient')->get()
       ]);
    }

    public function accept($id)
    {   
        $patient = Appointment::find($id)->patient()->first();
        
        Appointment::find($id)->update([
           'status' => 1
        ]);

       // Mail::to($patient->email)->send(new AppointmentAcceptedEmail($patient));

        return redirect()->back();
    }

    public function reject($id)
    {
        $patient = Appointment::find($id)->patient()->first();
        
        Appointment::find($id)->update([
           'status' => 3
        ]);

       // Mail::to($patient->email)->send(new AppointmentAcceptedEmail($patient));

        return redirect()->back();
    }

    public function seen($id)
    {
        $patient = Appointment::find($id)->patient()->first();
        
        Appointment::find($id)->update([
           'status' => 2
        ]);

       // Mail::to($patient->email)->send(new AppointmentAcceptedEmail($patient));

        return redirect()->back();
    }
}
