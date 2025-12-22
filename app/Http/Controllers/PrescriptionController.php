<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Appointment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    /**
     * Display all prescriptions for patient
     */
    public function index()
    {
        $prescriptions = Prescription::with(['doctor.user', 'items.product', 'appointment'])
            ->forPatient(Auth::id())
            ->latest()
            ->paginate(10);

        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show specific prescription
     */
    public function show(Prescription $prescription)
    {
        // Authorization check
        if ($prescription->patient_id !== Auth::id() && !Auth::user()->isDoctor() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $prescription->load(['doctor.user', 'patient', 'items.product', 'appointment']);

        return view('prescriptions.show', compact('prescription'));
    }

    /**
     * Show form to create prescription (doctor only)
     */
    public function create(Appointment $appointment)
    {
        // Check if doctor owns this appointment
        if ($appointment->doctor->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if prescription already exists
        if ($appointment->prescription) {
            return redirect()->route('doctor.prescriptions.edit', $appointment->prescription);
        }

        $products = Product::where('category_id', 1)->get(); // Assuming category 1 is medicines

        return view('prescriptions.create', compact('appointment', 'products'));
    }

    /**
     * Store new prescription (doctor only)
     */
    public function store(Request $request, Appointment $appointment)
    {
        // Check if doctor owns this appointment
        if ($appointment->doctor->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'diagnosis' => 'required|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.dosage' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.duration_days' => 'required|integer|min:1',
            'items.*.instructions' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $prescription = Prescription::create([
                'appointment_id' => $appointment->id,
                'doctor_id' => $appointment->doctor_id,
                'patient_id' => $appointment->patient_id,
                'diagnosis' => $validated['diagnosis'],
                'notes' => $validated['notes'] ?? null,
                'prescription_date' => now(),
                'status' => 'active',
            ]);

            foreach ($validated['items'] as $item) {
                PrescriptionItem::create([
                    'prescription_id' => $prescription->id,
                    'product_id' => $item['product_id'],
                    'dosage' => $item['dosage'],
                    'quantity' => $item['quantity'],
                    'duration_days' => $item['duration_days'],
                    'instructions' => $item['instructions'] ?? null,
                ]);
            }

            // Update appointment status to completed
            $appointment->update(['status' => 'completed']);

            DB::commit();

            return redirect()
                ->route('doctor.appointments.show', $appointment)
                ->with('success', 'Resep berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat resep: ' . $e->getMessage());
        }
    }

    /**
     * Show edit form for prescription (doctor only)
     */
    public function edit(Prescription $prescription)
    {
        // Check if doctor owns this prescription
        if ($prescription->doctor->user_id !== Auth::id()) {
            abort(403);
        }

        $prescription->load(['items.product', 'appointment']);
        $products = Product::where('category_id', 1)->get();

        return view('prescriptions.edit', compact('prescription', 'products'));
    }

    /**
     * Update prescription (doctor only)
     */
    public function update(Request $request, Prescription $prescription)
    {
        // Check if doctor owns this prescription
        if ($prescription->doctor->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'diagnosis' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,completed,cancelled',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.dosage' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.duration_days' => 'required|integer|min:1',
            'items.*.instructions' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $prescription->update([
                'diagnosis' => $validated['diagnosis'],
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status'],
            ]);

            // Delete old items and create new ones
            $prescription->items()->delete();

            foreach ($validated['items'] as $item) {
                PrescriptionItem::create([
                    'prescription_id' => $prescription->id,
                    'product_id' => $item['product_id'],
                    'dosage' => $item['dosage'],
                    'quantity' => $item['quantity'],
                    'duration_days' => $item['duration_days'],
                    'instructions' => $item['instructions'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('doctor.prescriptions.show', $prescription)
                ->with('success', 'Resep berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengupdate resep: ' . $e->getMessage());
        }
    }

    /**
     * Get prescriptions for doctor
     */
    public function doctorIndex()
    {
        $doctor = Auth::user()->doctorProfile;
        
        if (!$doctor) {
            abort(403);
        }

        $prescriptions = Prescription::with(['patient', 'appointment', 'items.product'])
            ->where('doctor_id', $doctor->id)
            ->latest()
            ->paginate(15);

        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

    /**
     * API: Check for new prescriptions (for patient real-time updates)
     */
    public function checkNew()
    {
        $lastCheck = session('last_prescription_check', now()->subSeconds(15));
        
        $newCount = Prescription::forPatient(Auth::id())
            ->where('created_at', '>', $lastCheck)
            ->count();

        session(['last_prescription_check' => now()]);

        return response()->json([
            'new_count' => $newCount,
            'has_new' => $newCount > 0,
        ]);
    }

    /**
     * API: Get latest prescriptions for patient
     */
    public function latest()
    {
        $prescriptions = Prescription::with(['doctor.user', 'items.product'])
            ->forPatient(Auth::id())
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($prescription) {
                return [
                    'id' => $prescription->id,
                    'doctor_name' => 'Dr. ' . ($prescription->doctor->user->name ?? 'N/A'),
                    'specialization' => $prescription->doctor->specialization ?? '',
                    'diagnosis' => $prescription->diagnosis,
                    'prescription_date' => $prescription->prescription_date->format('d M Y'),
                    'status' => $prescription->status,
                    'items_count' => $prescription->items->count(),
                    'url' => route('prescriptions.show', $prescription),
                ];
            });

        return response()->json([
            'prescriptions' => $prescriptions,
        ]);
    }
}

