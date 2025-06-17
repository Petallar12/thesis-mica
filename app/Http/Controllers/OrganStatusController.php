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
            ->select('organ_needed', DB::raw('COUNT(*) as total_count'))
            ->groupBy('organ_needed')
            ->get();

        return view('organ-status.index', compact('availableOrgans'));
    }
} 