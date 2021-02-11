<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::name('patient.')->namespace('Patient')->prefix('patient')->group(function(){

    Route::namespace('Auth')->middleware('guest:patient')->group(function(){

        //register route
        Route::get('/register','RegisterController@register')->name('register');
        Route::post('/register','RegisterController@processRregister');
        Route::get('/verify/email/{token}','RegisterController@verifyEmail')->name('verify.email');
        Route::get('/login','RegisterController@login')->name('login');
    });

    Route::namespace('Auth')->middleware('auth:doctor')->group(function(){
        
        // Route::get('/home',function(){
        //     if(Auth::guard('doctor')->check())
        //     {
        //         return view('doctor.home');
        //     }
        //     abort(404);
        // })->name('home');
   

    });

});

