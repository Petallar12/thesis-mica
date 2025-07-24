<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganStatusController extends Controller
{
    public function index()
    {
        // Get available organs from active donors with their total count
        $availableOrgans = Donor::where('status', 'Active')
            ->where('register_outside_inside','Inside')
            ->select('organ_needed', DB::raw('COUNT(*) as total_count'))
            ->groupBy('organ_needed')
            ->get();

        return view('organ-status.index', compact('availableOrgans'));
    }

public function organDetails(Request $request)
{
    $organType = $request->input('organ_type');
    $organs = Donor::where('status', 'Active')
        ->where('register_outside_inside','Inside')
        ->where('organ_needed', $organType)
        ->select('organ_size', 'blood_type', 'organ_viability_status', 'brain_death_confirmation', 'donor_card_registration_date')  // Added missing fields
        ->get();
    
    return response()->json($organs);
}

} 