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
        $donors = Donor::where('registration_inside_outside', 'Inside')->get();
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
            'first_name' => 'required',
            'last_name' => 'required',
            'goverment_id_number' => 'required',
            'organ_needed' => 'required',
            'blood_type' => 'required',
            // add other required fields as needed
        ]);
        $data = $request->all();
        $donor = Donor::create($data);
        // Send email if contact_information is an email
        if (isset($data['contact_information']) && filter_var($data['contact_information'], FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($data['contact_information'])
                    ->send(new DonorRegistrationConfirmation($donor));
            } catch (\Exception $e) {
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
        $data = $request->all();
        $donor->update($data);
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
    public function destroy(Request $request, Donor $donor)
    {
        $donor->delete();
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('donors.index')->with('success', 'Donor deleted successfully.');
    }
}
