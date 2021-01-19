<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Models\Doctor;
use App\Models\Experience;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        for ($i = 0; $i < $counter; $i++) { 

            $date1 = $request->start_date[$i];
            $date2 = $request->end_date[$i];
            $diff = differenceBetweenTwoDate($date1, $date2);
            $experience_in_month += $diff;

            if($this->doctorExpericenceIsExists($request->experience_id[$i]))
            {
                Experience::where('id',$request->experience_id[$i])
                ->update([
                    'start_date' => $request->start_date[$i],
                    'end_date' => $request->end_date[$i],
                    'clinic_name' => $request->clinic_name[$i],
                ]);
            }
            else
            {
                Experience::create([
                    'doctor_id' => $id,
                    'start_date' => $request->start_date[$i],
                    'end_date' => $request->end_date[$i],
                    'clinic_name' => $request->clinic_name[$i],
                ]);
            }
        }
        
        if ($img = $request->file('avatar')) {
            $destinationPath = public_path('/avatars/');
            $image = $img->getClientOriginalName();
            $img->move($destinationPath, $image);
        }

        if ($cv = $request->file('resume')) {
            $destinationPath = public_path('/resumes/');
            $resume = $cv->getClientOriginalName();
            $cv->move($destinationPath, $resume);
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
                    'experience_id',
                    'update_certifate'
                ]
            )
        );

        if($request->has('avatar'))
        {
            Doctor::find($id)->update([
                'avatar' => $image,
                'experience' => round($experience_in_month / 12,1)
            ]);
        }
        else
        {
            Doctor::find($id)->update([
                'experience' => round($experience_in_month / 12,1)
            ]);
        }

        if($request->has('resume'))
        {
            Doctor::find($id)->update([
                'resume' => $resume,
                'experience' => round($experience_in_month / 12,1)
            ]);
        }


        $certificates = Certificate::where('doctor_id',$id)->get();
      
        $count = Certificate::where('doctor_id',$id)->count();
        
        //delete documents
        if( $count > 0 ){
            if( $count != count($request->update_certifate) )
            {   
                if( $request->update_certifate == true && $certificates ) {
                    foreach ($request->update_certifate as $value) {
                        foreach ($certificates as $certificate) {
                            if($certificate->id != $value){
                                Certificate::where('id',$certificate->id)->delete();
                            }
                        }
                    }
                }
            }
        }
        
        //insert documents
        if ($files = $request->file('documents')) {
            $destinationPath = public_path('/documents/');
            foreach($files as $img) {
              $image = $img->getClientOriginalName();
              $img->move($destinationPath, $image);
              $certificate = new Certificate();
              $certificate->doctor_id = $id;
              $certificate->documents = $image;
              $certificate->save();
           }
        }

        return redirect()
                ->back()
                ->with('message','Profile updated successfully!');;
                
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
