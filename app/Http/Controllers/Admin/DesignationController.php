<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignationController extends Controller
{
    public function index (Designation $designation)
    {   
        return view('admin.designation.index', [
            'designations' => $designation->latest()->get()
        ]);
    }
}
