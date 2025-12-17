<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of doctors for booking
     */
    public function index(Request $request)
    {
        $specialization = $request->get('specialization', 'all');
        $day = $request->get('day', 'all');

        $query = Doctor::with('user')->active();

        // Filter by specialization
        if ($specialization && $specialization !== 'all') {
            $query->where('specialization', $specialization);
        }

        // Filter by day
        if ($day && $day !== 'all') {
            $query->whereJsonContains('available_days', $day);
        }

        $doctors = $query->get();

        // Debug logging
        \Log::info('AppointmentController@index', [
            'doctors_count' => $doctors->count(),
            'specialization' => $specialization,
            'day' => $day,
            'total_doctors_in_db' => Doctor::count(),
            'active_doctors_in_db' => Doctor::where('is_active', true)->count()
        ]);

        // Get unique specializations for filter
        $specializations = Doctor::select('specialization')
            ->distinct()
            ->pluck('specialization');

        return view('appointments.index', compact('doctors', 'specializations', 'specialization', 'day'));
    }

    /**
     * Show the form for creating a new appointment
     */
    public function create(Doctor $doctor)
    {
        return view('appointments.create', compact('doctor'));
    }

    /**
     * Store a newly created appointment
     */
    public function store(Request $request, Doctor $doctor)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'symptoms' => 'nullable|string|max:1000',
        ]);

        // Check if doctor is available on the selected day
        $dayOfWeek = date('l', strtotime($request->appointment_date));
        if (!in_array($dayOfWeek, $doctor->available_days)) {
            return back()->with('error', 'Dokter tidak tersedia pada hari tersebut.');
        }

        // Ensure the selected time is within doctor's working hours
        $selectedTime = strtotime($request->appointment_time);
        $startTime = strtotime($doctor->start_time);
        $endTime = strtotime($doctor->end_time);
        if ($selectedTime < $startTime || $selectedTime > $endTime) {
            return back()->with('error', 'Waktu yang dipilih berada di luar jam praktik dokter.');
        }

        // Check if time slot is already taken
        $existingAppointment = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($existingAppointment) {
            return back()->with('error', 'Jadwal tersebut sudah dibooking. Silakan pilih waktu lain.');
        }

        try {
            DB::beginTransaction();

            $appointment = Appointment::create([
                'patient_id' => Auth::id(),
                'doctor_id' => $doctor->id,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'symptoms' => $request->symptoms,
                'total_price' => $doctor->price_per_session,
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('appointments.show', $appointment)
                ->with('success', 'Appointment berhasil dibuat! Silakan tunggu konfirmasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified appointment
     */
    public function show(Appointment $appointment)
    {
        // Make sure user can only see their own appointments
        if ($appointment->patient_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $appointment->load(['doctor.user', 'patient']);

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Display user's appointments
     */
    public function myAppointments()
    {
        $appointments = Appointment::with(['doctor.user'])
            ->forPatient(Auth::id())
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(10);

        return view('appointments.my-appointments', compact('appointments'));
    }

    /**
     * Cancel an appointment
     */
    public function cancel(Appointment $appointment)
    {
        // Make sure user can only cancel their own appointments
        if ($appointment->patient_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($appointment->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Appointment ini tidak dapat dibatalkan.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment berhasil dibatalkan.');
    }
}
