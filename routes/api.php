<?php

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('doctor/list', function (Doctor $doctor) {
    return $doctor->get();
});