<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Doctor $doctor)
    {
        $id = Auth::guard('doctor')->id();
        return view('doctor.profile.profile',[
            'doctor' => $doctor::findOrfail($id)
        ]);
    }

    public function update_profile(Request $request, $id)
    {
        $experience = array_filter($request->start_date, function($filter){
            return ! empty($filter);
        });

        $counter = sizeof($experience);
        $experience_in_month = 0;

        for ($i=0; $i < $counter; $i++) {

            $date1 = $request->start_date[$i];
            $date2 = $request->end_date[$i];
            $diff = differenceBetweenTwoDate($date1, $date2);
            $experience_in_month += $diff;

            if($this->doctorExpericenceIsExists($request->experience_id[$i]))
            {
                //update the row
            }
            else
            {
                //insert the new row
            }

        }

        Doctor::find($id)->update(
            $request->except(
                [
                    '_token',
                    '_method',
                    'start_date',
                    'end_date',
                    'clinic_name',
                    'resume',
                    'documents',
                    'experience_id'
                ]
            )
        );

        return redirect()->back();
    }

    public function doctorExpericenceIsExists($id) : bool
    {
        $check = Experience::where('id',$id)->exists();

        if($check)
        {
            return true;
        }
        return false;
    }
}
