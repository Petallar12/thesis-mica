<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonorRegistrationConfirmation;
use Illuminate\Support\Facades\Cache;
use App\Mail\DonorEmailVerification;

class DonorController extends Controller
{
    /**
     * Display a list of donors (optional for admin or dashboard).
     */
    public function index()
    {
        $donors = Donor::where('register_outside_inside', 'Inside')->get();
        return view('donors.index', compact('donors'));
    }
    public function index_archive()
    {
        $archive = Donor::where('register_outside_inside', 'Archive')->get();
        return view('donors.index_archive', compact('archive'));
    }
    public function archive(Donor $donor)
    {
        // Update the 'register_outside_inside' field to 'Archive'
        $donor->update(['register_outside_inside' => 'Archive']);

        return response()->json(['success' => true]);
    }
public function setInside(Donor $donor)
{
    // Update the 'register_outside_inside' field to 'Inside'
    $donor->update(['register_outside_inside' => 'Inside']);

    return response()->json(['success' => true]);
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
        // Check for duplicate by first and last name (but always add)
        $existingDonor = Donor::where('first_name', $data['first_name'])
            ->where('last_name', $data['last_name'])
            ->where('blood_type', $data['blood_type'])
            ->where('birthday', $data['birthday'])
            ->first();
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
            'message' => $existingDonor ? 'Donor has a Donor Card' : 'Donor Successfully Added!'
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

    /**
     * Send a verification code to the donor's email address.
     */
    public function sendVerification(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $code = rand(100000, 999999);
        Cache::put('donor_verification_' . $request->email, $code, now()->addMinutes(10));
        Mail::to($request->email)->send(new DonorEmailVerification($code));
        return response()->json(['message' => 'Verification code sent!']);
    }

    /**
     * Verify the code entered by the donor.
     */
    public function verifyCode(Request $request)
    {
        $request->validate(['email' => 'required|email', 'code' => 'required']);
        $cachedCode = Cache::get('donor_verification_' . $request->email);
        if ($cachedCode && $request->code == $cachedCode) {
            Cache::put('donor_verified_' . $request->email, true, now()->addMinutes(15));
            return response()->json(['verified' => true]);
        }
        return response()->json(['verified' => false], 422);
    }
}
