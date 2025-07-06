<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorCardController extends Controller
{
    public function index()
    {
        $donors = Donor::where('register_outside_inside', 'Website')->get();
        return view('donor-card.index', compact('donors'));
    }

    public function edit(Donor $donor)
    {
        return view('donor-card.edit', compact('donor'));
    }

    public function update(Request $request, Donor $donor)
    {
        $data = $request->all();
        $donor->update($data);
        return redirect()->route('donor-card.index')->with('success', 'Donor updated successfully.');
    }
}
