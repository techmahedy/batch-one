<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\Auth\RegisterController;

Route::name('patient.')->namespace('Patient')->prefix('patient')->group(function(){

    Route::namespace('Auth')->middleware('guest:patient')->group(function(){

        //register route
        Route::get('/register','RegisterController@register')->name('register');
        Route::post('/register','RegisterController@processRregister');
        Route::get('/verify/email/{token}','RegisterController@verifyEmail')->name('verify.email');
        Route::get('/login','RegisterController@login')->name('login');
        Route::post('/login','RegisterController@processLogin')->name('login');
    });

    Route::namespace('Auth')->middleware('auth:patient')->group(function(){
        
        Route::get('/home',function(){
            if(Auth::guard('patient')->check())
            {
                return view('patient.home');
            }
            abort(404);
        })->name('home');

        Route::post('/logout',function(){
            Auth::guard('patient')->logout();
            return redirect()->action([
                RegisterController::class,
                'login'
            ]);
        })->name('logout');
   

    });

});

