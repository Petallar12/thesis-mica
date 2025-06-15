<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonorRegistrationConfirmation;

class DonorController extends Controller
{
    /**
     * Display a list of donors (optional for admin or dashboard).
     */
    public function index()
    {
        $donors = Donor::all();
        return view('donors.index', compact('donors'));
    }

    /**
     * Show donor registration form (optional if you're using a modal).
     */
    public function create()
    {
        return view('donors.create');
    }

    /**
     * Store a new donor registration.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'goverment_id_number' => 'required|string|max:100|unique:donors,goverment_id_number',
            'contact_information' => 'required|string|max:100',
            'blood_type' => 'required|string|max:100',
            'age' => 'required|integer|min:0',
            'organ_needed' => 'required|string|max:100',
            'medical_history' => 'required|string|max:255',
            'waiting_time' => 'required|string|max:255',
            'donation_preferences' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
        ]);

        $donor = Donor::create($validated);

        // Send email if contact_information is an email
        if (filter_var($validated['contact_information'], FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($validated['contact_information'])
                    ->send(new DonorRegistrationConfirmation($donor));
            } catch (\Exception $e) {
                // Log the error but don't stop the registration process
                \Log::error('Failed to send email: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for registering as a donor!'
        ]);
    }

    /**
     * Show a single donor's details (optional).
     */
    public function show(Donor $donor, Request $request)
    {
        if ($request->ajax()) {
            return view('donors.partials.show', compact('donor'));
        }
    
        return view('donors.show', compact('donor'));
    }
    
    /**
     * Edit donor info (optional for admin).
     */
    public function edit(Donor $donor)
    {
        if (request()->ajax()) {
            return response()->json($donor);
        }
        return view('donors.edit', compact('donor'));
    }

    /**
     * Update a donor's information (optional).
     */
    public function update(Request $request, Donor $donor)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'goverment_id_number' => 'required|string|max:100|unique:donors,goverment_id_number,' . $donor->id,
            'contact_information' => 'required|string|max:100',
            'blood_type' => 'required|string|max:100',
            'age' => 'required|integer|min:0',
            'organ_needed' => 'required|string|max:100',
            'medical_history' => 'required|string|max:255',
            'waiting_time' => 'required|string|max:255',
            'donation_preferences' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'status' => 'required|string|max:20',
            'contact_number' => 'required|string|max:100',
            'encoded_by' => 'required|string|max:100',
            'encoded_date' => 'required|date'
        ]);

        $donor->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Donor updated successfully!'
            ]);
        }

        return redirect()->route('donors.index')->with('success', 'Donor updated successfully.');
    }

    /**
     * Delete a donor (optional).
     */
    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect()->route('donors.index')->with('success', 'Donor deleted successfully.');
    }
}
