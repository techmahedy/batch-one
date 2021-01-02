<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\DoctorRegister;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Doctor\Auth\LoginController;

class RegisterController extends Controller
{
    public function register()
    {
        if(View::exists('doctor.auth.register'))
        {
            return view('doctor.auth.register');
        }

        abort(Response::HTTP_NOT_FOUND);
    }

    public function processRregister(Request $request)
    {   

        Doctor::create([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => $request->input('password')
        ]);

        return redirect()
                ->action([LoginController::class,'login'])
                ->with('message','Registration completed successfully! please login!');
        
    }
}
