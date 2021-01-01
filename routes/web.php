<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.blank');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
