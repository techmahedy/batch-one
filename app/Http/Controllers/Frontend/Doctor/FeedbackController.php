<?php

namespace App\Http\Controllers\Frontend\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function feedback(Request $request, $id)
    {   
        if($this->isAbleToGiveFeedback())
        {
           Feedback::create([
              'doctor_id' => $id,
              'patient_id' => Auth::guard('patient')->id(),
              'feedback' => $request->feedback,
              'rating_value' => $request->rating_value,
           ]);

           return back()->with('message','Feedback inserted successfully');
        }

        return back()->with('message','You are not able to give feedback, please make sure you have atleast one appointment associated with this doctor');
    }

    public function isAbleToGiveFeedback()
    {   
        $patient_id = Auth::guard('patient')->id();
        $check = Appointment::where('patient_id',$patient_id)->exists();
        if($check == true){
            return true;
        }
        return false;
    }
}
