<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('doctor.auth.change_password');
    }

    public function change_password(Request $request)
    {   
        $prevoius_pass = Auth::guard('doctor')->user()->password;

        $doctor_id = Auth::guard('doctor')->id();

        if (Hash::check($request->oldpassword , $prevoius_pass )) {
           if (!Hash::check($request->password , $prevoius_pass)) {
                Doctor::where('id' , $doctor_id)->update(
                    [
                        'password' =>  Hash::make($request->password)
                    ]
                );
                session()->flash('message','Password updated successfully!');
                return redirect()->back();
              }
        else{
                session()->flash('message','New password can not be the old password!');
                return redirect()->back();
            }
        }
        else{
            session()->flash('message','Old password was wrong. sorry, try agian!');
            return redirect()->back();
        }
    }
}
