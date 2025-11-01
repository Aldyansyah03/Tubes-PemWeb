<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $patient = Auth::user();
        
        // Get patient-specific data here
        // For example: appointments, medical records, prescriptions
        
        return view('patient.dashboard', [
            'patient' => $patient,
        ]);
    }
}
