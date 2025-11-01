<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = Auth::user();
        
        // Get doctor-specific data here
        // For example: appointments, patients, schedules
        
        return view('doctor.dashboard', [
            'doctor' => $doctor,
        ]);
    }
}
