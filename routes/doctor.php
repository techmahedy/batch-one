<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Doctor\Auth\LoginController;

Route::get('/test', function () {
    return "test";
});

Route::name('doctor.')->namespace('Doctor')->prefix('doctor')->group(function(){

    Route::namespace('Auth')->middleware('guest:doctor')->group(function(){

        //register route
        Route::get('/register','RegisterController@register')->name('register');Route::post('/register','RegisterController@processRregister');

        //login route
        Route::get('/login','LoginController@login')->name('login');
        Route::post('/login','LoginController@processLogin');
    });

    Route::namespace('Auth')->middleware('auth:doctor')->group(function(){
        
        Route::get('/home',function(){
            if(Auth::guard('doctor')->check())
            {
                return view('doctor.home');
            }
            abort(404);
        });
        
        Route::post('/logout',function(){
            Auth::guard('doctor')->logout();
            return redirect()->action([
                LoginController::class,
                'login'
            ]);
        })->name('logout');

    });

});

