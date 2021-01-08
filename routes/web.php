<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.blank');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->group(function(){

    Route::name('admin.')->group(function(){
        Route::get('designation', 'DesignationController@index')->name('designation.index');
    });


});