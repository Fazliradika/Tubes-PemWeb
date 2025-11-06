<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        if (!$doctorProfile) {
            abort(403, 'Doctor profile not found');
        }
        
        // Get today's appointments
        $todayAppointments = Appointment::where('doctor_id', $doctorProfile->id)
            ->whereDate('appointment_date', Carbon::today())
            ->with('patient')
            ->orderBy('appointment_time')
            ->get();
        
        // Get upcoming appointments (next 7 days)
        $upcomingAppointments = Appointment::where('doctor_id', $doctorProfile->id)
            ->whereBetween('appointment_date', [Carbon::today(), Carbon::today()->addDays(7)])
            ->whereIn('status', ['pending', 'confirmed'])
            ->with('patient')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();
        
        // Get pending appointments that need confirmation
        $pendingAppointments = Appointment::where('doctor_id', $doctorProfile->id)
            ->where('status', 'pending')
            ->with('patient')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();
        
        // Statistics
        $stats = [
            'total_appointments' => Appointment::where('doctor_id', $doctorProfile->id)->count(),
            'pending_count' => Appointment::where('doctor_id', $doctorProfile->id)->where('status', 'pending')->count(),
            'confirmed_today' => Appointment::where('doctor_id', $doctorProfile->id)
                ->whereDate('appointment_date', Carbon::today())
                ->where('status', 'confirmed')
                ->count(),
            'completed_this_month' => Appointment::where('doctor_id', $doctorProfile->id)
                ->where('status', 'completed')
                ->whereMonth('appointment_date', Carbon::now()->month)
                ->count(),
        ];
        
        return view('doctor.dashboard', [
            'doctor' => $doctor,
            'doctorProfile' => $doctorProfile,
            'todayAppointments' => $todayAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'pendingAppointments' => $pendingAppointments,
            'stats' => $stats,
        ]);
    }
    
    /**
     * Show all appointments for doctor
     */
    public function appointments(Request $request)
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        if (!$doctorProfile) {
            abort(403, 'Doctor profile not found');
        }
        
        $status = $request->get('status', 'all');
        
        $query = Appointment::where('doctor_id', $doctorProfile->id)
            ->with('patient');
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $appointments = $query->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(15);
        
        return view('doctor.appointments.index', [
            'appointments' => $appointments,
            'status' => $status,
        ]);
    }
    
    /**
     * Show appointment detail
     */
    public function showAppointment(Appointment $appointment)
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        // Check if this appointment belongs to this doctor
        if ($appointment->doctor_id !== $doctorProfile->id) {
            abort(403, 'Unauthorized access');
        }
        
        $appointment->load(['patient', 'prescription.items.product', 'conversation']);
        
        return view('doctor.appointments.show', [
            'appointment' => $appointment,
        ]);
    }
    
    /**
     * Confirm appointment
     */
    public function confirmAppointment(Appointment $appointment)
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        if ($appointment->doctor_id !== $doctorProfile->id) {
            abort(403);
        }
        
        $appointment->update(['status' => 'confirmed']);
        
        // Create conversation if not exists
        if (!$appointment->conversation) {
            \App\Models\Conversation::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient_id,
                'doctor_id' => $appointment->doctor_id,
                'status' => 'active',
                'last_message_at' => now(),
            ]);
        }
        
        return back()->with('success', 'Appointment telah dikonfirmasi dan chat dengan pasien sudah tersedia');
    }
    
    /**
     * Cancel appointment
     */
    public function cancelAppointment(Request $request, Appointment $appointment)
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        if ($appointment->doctor_id !== $doctorProfile->id) {
            abort(403);
        }
        
        $appointment->update([
            'status' => 'cancelled',
            'notes' => $request->input('reason', 'Cancelled by doctor'),
        ]);
        
        return back()->with('success', 'Appointment telah dibatalkan');
    }

    public function createAppointment()
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        if (!$doctorProfile) {
            abort(403, 'Doctor profile not found');
        }
        
        // Get all patients (users with patient role)
        $patients = \App\Models\User::where('role', 'patient')->orderBy('name')->get();
        
        return view('doctor.appointments.create', compact('doctor', 'doctorProfile', 'patients'));
    }

    public function storeAppointment(Request $request)
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        if (!$doctorProfile) {
            abort(403, 'Doctor profile not found');
        }
        
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'symptoms' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        $appointment = Appointment::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $doctorProfile->id,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'symptoms' => $validated['symptoms'],
            'notes' => $validated['notes'],
            'status' => 'confirmed', // Auto-confirm since doctor is creating it
        ]);
        
        // Create conversation automatically since appointment is confirmed
        \App\Models\Conversation::create([
            'appointment_id' => $appointment->id,
            'patient_id' => $appointment->patient_id,
            'doctor_id' => $appointment->doctor_id,
            'status' => 'active',
            'last_message_at' => now(),
        ]);
        
        return redirect()->route('doctor.dashboard')
            ->with('success', 'Appointment berhasil dibuat dan chat dengan pasien sudah tersedia');
    }

    public function patients()
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        if (!$doctorProfile) {
            abort(403, 'Doctor profile not found');
        }
        
        // Get all unique patients who have booked this doctor
        $patients = \App\Models\User::whereHas('appointments', function($query) use ($doctorProfile) {
            $query->where('doctor_id', $doctorProfile->id);
        })
        ->with(['appointments' => function($query) use ($doctorProfile) {
            $query->where('doctor_id', $doctorProfile->id)
                ->orderBy('appointment_date', 'desc');
        }])
        ->get();
        
        return view('doctor.patients.index', compact('patients', 'doctor', 'doctorProfile'));
    }

    public function schedule()
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;
        
        if (!$doctorProfile) {
            abort(403, 'Doctor profile not found');
        }
        
        // Get appointments for the next 30 days
        $appointments = Appointment::where('doctor_id', $doctorProfile->id)
            ->whereBetween('appointment_date', [Carbon::today(), Carbon::today()->addDays(30)])
            ->with('patient')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();
        
        // Group appointments by date
        $appointmentsByDate = $appointments->groupBy(function($appointment) {
            return Carbon::parse($appointment->appointment_date)->format('Y-m-d');
        });
        
        return view('doctor.schedule.index', compact('appointmentsByDate', 'doctor', 'doctorProfile'));
    }
}
