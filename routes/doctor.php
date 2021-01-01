<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return "test";
});

Route::name('doctor.')->namespace('Doctor')->prefix('doctor')->group(function(){

    Route::namespace('Auth')->middleware('guest')->group(function(){
        Route::get('/register','RegisterController@register')->name('register');
    });

});

