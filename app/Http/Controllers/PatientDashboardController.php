<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $patient = Auth::user();
        
        // Get upcoming appointments
        $upcomingAppointments = $patient->appointments()
            ->with('doctor.user')
            ->upcoming()
            ->limit(3)
            ->get();
        
        // Get active prescriptions count
        $activePrescriptionsCount = $patient->prescriptions()
            ->active()
            ->count();
        
        // Get unread messages count
        $unreadMessagesCount = \App\Models\Message::whereHas('conversation', function ($query) use ($patient) {
            $query->where('patient_id', $patient->id);
        })
        ->where('sender_id', '!=', $patient->id)
        ->whereNull('read_at')
        ->count();
        
        return view('patient.dashboard', [
            'patient' => $patient,
            'upcomingAppointments' => $upcomingAppointments,
            'activePrescriptionsCount' => $activePrescriptionsCount,
            'unreadMessagesCount' => $unreadMessagesCount,
        ]);
    }
}
