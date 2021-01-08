<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Models\Doctor;
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
}
