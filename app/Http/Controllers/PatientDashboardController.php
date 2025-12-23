<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $patient = Auth::user();

        // Get upcoming appointments with safety check
        try {
            $upcomingAppointments = $patient->appointments()
                ->with('doctor.user')
                ->upcoming()
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            $upcomingAppointments = collect();
        }

        // Get active prescriptions count with safety check
        try {
            $activePrescriptionsCount = $patient->prescriptions()
                ->active()
                ->count();
        } catch (\Exception $e) {
            $activePrescriptionsCount = 0;
        }

        // Get unread messages count with safety check
        try {
            $unreadMessagesCount = \App\Models\Message::whereHas('conversation', function ($query) use ($patient) {
                $query->where('patient_id', $patient->id);
            })
                ->where('sender_id', '!=', $patient->id)
                ->whereNull('read_at')
                ->count();
        } catch (\Exception $e) {
            $unreadMessagesCount = 0;
        }

        // Get medical records count (prescriptions)
        try {
            $medicalRecordsCount = $patient->prescriptions()->count();
        } catch (\Exception $e) {
            $medicalRecordsCount = 0;
        }

        return view('patient.dashboard', [
            'patient' => $patient,
            'upcomingAppointments' => $upcomingAppointments,
            'activePrescriptionsCount' => $activePrescriptionsCount,
            'medicalRecordsCount' => $medicalRecordsCount,
            'unreadMessagesCount' => $unreadMessagesCount,
        ]);
    }
}
