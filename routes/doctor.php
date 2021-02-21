<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::name('doctor.')->namespace('Doctor')->prefix('doctors')->group(function(){

    Route::namespace('Auth')->middleware('guest:doctor')->group(function(){

        //register route
        Route::get('/register','RegisterController@register')->name('register');Route::post('/register','RegisterController@processRregister');

        //login route
        Route::get('/login','LoginController@login')->name('login');
        Route::post('/login','LoginController@processLogin');
    });

    Route::namespace('Auth')->middleware('auth:doctor')->group(function(){
        
        Route::get('/home',function(){
            return Auth::guard('doctor')->check()? 
                view('doctor.home') : abort(404);
        })->name('home');
        
        Route::post('/logout',function(){
            Auth::guard('doctor')->logout();
            return redirect()->route('doctor.login');
        })->name('logout');

        //Doctor profile related route
        Route::get('/change/password','ChangePasswordController@index')->name('change.password');
        Route::patch('/change/password','ChangePasswordController@change_password');
        Route::get('/profile/{id}', 'ProfileController@index')->name('profile');
        Route::patch('/profile/{id}', 'ProfileController@update_profile');

    });
    
    Route::middleware('auth:doctor')->group(function(){
        //appointment route
        Route::get('/appointment/list', 'AppointmentController@index')->name('appointment.list');
        Route::get('/appointment/{id}', 'AppointmentController@accept')->name('appointment.accept');
        Route::get('/appointment/reject/{id}', 'AppointmentController@reject')->name('appointment.reject');
        Route::get('/appointment/seen/{id}', 'AppointmentController@seen')->name('appointment.seen');
    });
});

