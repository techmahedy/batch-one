<?php

namespace App\Http\Controllers\Patient\Auth;

use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PatientVerifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    public function register()
    {
        return view('patient.auth.register');
    }

    public function processRregister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $patient = Patient::create([
           'name' => $request->name,
           'email' => strtolower($request->email),
           'token' => Str::random(32),
           'password' => Hash::make($request->password) 
        ]);

        Mail::to($patient->email)->send(new PatientVerifyEmail($patient));

        return redirect()->back();
    }

    public function verifyEmail(Request $request, string $token = null)
    {
        if($request->token)
        {
            Patient::whereToken($request->token)
                    ->update([
                        'token' => null,
                        'is_verified' => 1,
                        'email_verified_at' => now()
                    ]);
            
            return redirect()->route('patient.login');
        }

        return abort(404);
    }

    public function login()
    {
        return view('patient.auth.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->except(['_token']);

        if(Auth::guard('patient')->attempt($credentials))
        {   
            return redirect(RouteServiceProvider::PATIENT);
        }
        return redirect()->back()->with('message','Credentials not matced in our records!');
    }
}
