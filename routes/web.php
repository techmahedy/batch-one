<?php

use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->group(function(){

    Route::name('admin.')->group(function(){
        Route::get('designation', 'DesignationController@index')->name('designation.index');
    });

});

//Frontend section
Route::namespace('Frontend\Doctor')->group(function(){

    Route::get('/', 'HomeController@index');
    
});