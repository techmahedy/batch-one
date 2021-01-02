<?php

namespace App\Http\Controllers\Doctor\Auth;

use Facades\App\Helper\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{   
	protected const test = "test";

    public function login()
    {
        if(View::exists('doctor.auth.login'))
        {
            return view('doctor.auth.login');
        }

        abort(Response::HTTP_NOT_FOUND);
    }

    public function processLogin(Request $request)
    {
    	return self::test;
    }

    protected function test()
    {
    	return "ok";
    }
}
