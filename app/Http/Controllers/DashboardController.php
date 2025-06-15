<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Recipients;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDonors = Donor::count();
        $totalRecipients = Recipients::count();
        $totalRegistration = $totalDonors + $totalRecipients;
        $totalInactiveDonors = Donor::where('status', 'Inactive')->count();
        $totalInactiveRecipients = Recipients::where('status', 'Inactive')->count();
        $totalActiveDonors = Donor::where('status', 'Active')->count();
        $totalActiveRecipients = Recipients::where('status', 'Active')->count();
        $totalUsers = User::count();


        return view('dashboard', compact('totalRegistration', 'totalRecipients', 'totalDonors', 'totalUsers',
        'totalInactiveDonors', 'totalInactiveRecipients' ,'totalActiveDonors', 'totalActiveRecipients'));
    }
} 