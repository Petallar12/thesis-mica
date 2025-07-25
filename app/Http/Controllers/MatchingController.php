<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Recipients;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;  // Importing Log facade for logging
class MatchingController extends Controller
{
public function index()
{
    // Get all donors and recipients
    $donors = Donor::all();
    $recipients = Recipients::all();

    // Group donors and recipients by organ
    $donorsByOrgan = $donors->groupBy('organ_needed');
    $recipientsByOrgan = $recipients->groupBy('organ_needed');

    $matches = [];

    foreach ($donorsByOrgan as $organ => $donorsGroup) {
        if (isset($recipientsByOrgan[$organ])) {
            $recipientsGroup = $recipientsByOrgan[$organ];

            foreach ($donorsGroup as $donor) {
                // Calculate the organ condition based on retrieval time
                $donor->organ_condition = $this->calculateOrganCondition($donor);
                
                // You can still include expired organs but they will have 'Expired' label
                // Skip matching if the organ condition is expired (optional based on your requirement)
                if ($donor->organ_condition === 'Expired') {
                    // Optionally, you can continue to the next donor
                    // continue;  
                }

                $donorMatches = [];

                foreach ($recipientsGroup as $recipient) {
                    if (
                        $donor->blood_type === $recipient->blood_type &&
                        $donor->register_outside_inside === 'Inside' &&
                        $recipient->register_outside_inside === 'Inside' &&
                        $donor->status === 'Active' &&
                        $recipient->status === 'Active' &&
                        $donor->transplant_status === 'Waiting' &&
                        $recipient->transplant_status === 'Waiting'
                    ) {
                        $compatibility = $this->checkCompatibility($donor, $recipient);
                        $pointsBreakdown = [];
                        $matchScore = $this->calculateMatchScore($donor, $recipient, $pointsBreakdown);

                        $donorMatches[] = [
                            'donor' => $donor,
                            'recipient' => $recipient,
                            'organ' => $organ,
                            'compatibility' => $compatibility,
                            'matchScore' => $matchScore,
                            'pointsBreakdown' => $pointsBreakdown
                        ];
                    }
                }

                if (!empty($donorMatches)) {
                    usort($donorMatches, function ($a, $b) {
                        return $b['matchScore'] <=> $a['matchScore'];
                    });

                    $matches[$donor->id] = [
                        'donor' => $donor,
                        'organ' => $organ,
                        'recipient_matches' => $donorMatches
                    ];
                }
            }
        }
    }

    return view('matching.index', compact('matches'));
}


private function calculateOrganCondition($donor)
{
    if (!$donor->retrieval_time) {
        return 'Unknown';  // If retrieval time is missing
    }

    $retrievalTime = Carbon::parse($donor->retrieval_time);
    $currentTime = Carbon::now();

    // Define organ viability periods in hours
    $viabilityPeriods = [
        'Heart' => 6,
        'Lungs' => 6,
        'Eyes' => 6,
        'Corneas' => 6,  // Add Corneas if necessary
        'Liver' => 12,
        'Pancreas' => 12,
        'Kidneys' => 36,
    ];

    $organ = $donor->organ_needed;

    if (isset($viabilityPeriods[$organ])) {
        // Calculate the difference in hours between the retrieval time and current time
        $hoursElapsed = $retrievalTime->diffInHours($currentTime);

        // Log the time and organ condition check
        Log::info("Checking organ condition for {$organ}. Hours elapsed: {$hoursElapsed}");

        // Compare the elapsed time to the allowed time for the organ
        $maxHours = $viabilityPeriods[$organ];
        if ($hoursElapsed > $maxHours) {
            return 'Expired';  // If the time is over, it's expired
        } else {
            return 'Good';  // If it's still within the allowed time, it's good
        }
    }

    return 'Unknown';  // For cases where the organ doesn't have a specific time condition
}



    
    
    private function checkCompatibility($donor, $recipient)
    {
        $compatibility = [
            'isCompatible' => true,
            'checks' => []
        ];

        if ($donor->donor_status !== 'Alive' && $donor->donor_status !== 'Deceased') {
            $compatibility['isCompatible'] = false;
            $compatibility['checks'][] = 'Donor not available';
        }

        if ($recipient->transplant_status !== 'Waiting' && $recipient->transplant_status !== 'Listed') {
            $compatibility['isCompatible'] = false;
            $compatibility['checks'][] = 'Recipient not waiting for transplant';
        }

        if ($donor->blood_type && $recipient->blood_type) {
            $bloodCompatible = $this->checkBloodTypeCompatibility($donor->blood_type, $recipient->blood_type);
            $compatibility['checks'][] = 'Blood type: ' . ($bloodCompatible ? 'Compatible' : 'Incompatible');
            if (!$bloodCompatible) {
                $compatibility['isCompatible'] = false;
            }
        }

        if ($donor->age && $recipient->age) {
            $ageDiff = abs($donor->age - $recipient->age);
            $compatibility['checks'][] = 'Age difference: ' . $ageDiff . ' years';
            if ($ageDiff > 30) {
                $compatibility['checks'][] = 'Large age difference may affect compatibility';
            }
        }

        if ($donor->organ_size && $recipient->height && $donor->height) {
            $sizeCompatible = $this->checkSizeCompatibility($donor, $recipient);
            $compatibility['checks'][] = 'Size: ' . ($sizeCompatible ? 'Compatible' : 'May need size adjustment');
        }

        return $compatibility;
    }

    private function checkBloodTypeCompatibility($donorBlood, $recipientBlood)
    {
        $compatibility = [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['A-', 'B-', 'AB-', 'O-']
        ];

        return in_array($recipientBlood, $compatibility[$donorBlood] ?? []);
    }

    private function checkSizeCompatibility($donor, $recipient)
    {
        $donorHeight = $donor->height ?? 0;
        $recipientHeight = $recipient->height ?? 0;

        if ($donorHeight > 0 && $recipientHeight > 0) {
            $heightDiff = abs($donorHeight - $recipientHeight);
            return $heightDiff <= 20;
        }

        return true;
    }

 private function calculateMatchScore($donor, $recipient, &$pointsBreakdown = null)
{
    // Get points from the database (MatchingPoint model)
    $points = \App\Models\MatchingPoint::first(); 

    $score = 0;

    $pointsBreakdown = [
        'waiting_time' => [
            'label' => 'Waiting Time',
            'points' => 0,
            'max' => $points->waiting_time_max,  // Use dynamic max value from DB
            'desc' => '',
        ],
        'age' => [
            'label' => 'Age',
            'points' => 0,
            'max' => $points->age_max,  // Use dynamic max value from DB
            'desc' => '',
        ],
        'blood_type' => [
            'label' => 'Blood Type',
            'points' => 0,
            'max' => $points->blood_type_max,  // Use dynamic max value from DB
            'desc' => '',
        ],
        'urgency' => [
            'label' => 'Urgency',
            'points' => 0,
            'max' => $points->urgency_max,  // Use dynamic max value from DB
            'desc' => '',
        ],
    ];

    // Adjust points based on config settings (from database)
    if (isset($recipient->waiting_time)) {
        $months = (int) $recipient->waiting_time;
        if ($months < 12) {
            $score += $points->waiting_time_less_than_12;
            $pointsBreakdown['waiting_time']['points'] = $points->waiting_time_less_than_12;
            $pointsBreakdown['waiting_time']['desc'] = "$months months (<12)";
        } elseif ($months >= 12 && $months < 36) {
            $score += $points->waiting_time_12_to_35;
            $pointsBreakdown['waiting_time']['points'] = $points->waiting_time_12_to_35;
            $pointsBreakdown['waiting_time']['desc'] = "$months months (12-35)";
        } elseif ($months >= 36) {
            $score += $points->waiting_time_more_than_36;
            $pointsBreakdown['waiting_time']['points'] = $points->waiting_time_more_than_36;
            $pointsBreakdown['waiting_time']['desc'] = "$months months (36+)";
        }
    }

    // Age scoring
    if (isset($recipient->age)) {
        $age = (int) $recipient->age;
        if ($age < 18) {
            $pointsBreakdown['age']['points'] = 0;
            $pointsBreakdown['age']['desc'] = "$age years (<18)";
        } elseif ($age >= 18) {
            $score += $points->age_more_than_18;
            $pointsBreakdown['age']['points'] = $points->age_more_than_18;
            $pointsBreakdown['age']['desc'] = "$age years (18+)";
        }
    }

    // Blood type scoring
    if ($donor->blood_type && $recipient->blood_type) {
        if ($this->checkBloodTypeCompatibility($donor->blood_type, $recipient->blood_type)) {
            $score += $points->blood_type;
            $pointsBreakdown['blood_type']['points'] = $points->blood_type;
            $pointsBreakdown['blood_type']['desc'] = 'Compatible';
        } else {
            $pointsBreakdown['blood_type']['desc'] = 'Incompatible';
        }
    }

    // Urgency scoring
    if (isset($recipient->medical_urgency_score)) {
        $urgency = strtolower($recipient->medical_urgency_score);
        $score += $points->{"urgency_$urgency"};  // Dynamically get the point value based on urgency
        $pointsBreakdown['urgency']['points'] = $points->{"urgency_$urgency"};
        $pointsBreakdown['urgency']['desc'] = ucfirst($urgency);
    }

    return $score;
}

public function updateSettings(Request $request)
{
    $points = \App\Models\MatchingPoint::first();
    
    // Validate the input
    $request->validate([
        'waiting_time_less_than_12' => 'required|integer',
        'waiting_time_12_to_35' => 'required|integer',
        'waiting_time_more_than_36' => 'required|integer',
        'age_less_than_18' => 'required|integer',
        'age_more_than_18' => 'required|integer',
        'blood_type' => 'required|integer',
        'urgency_low' => 'required|integer',
        'urgency_medium' => 'required|integer',
        'urgency_high' => 'required|integer',
        'urgency_critical' => 'required|integer',
    ]);
    
    // Update the points in the DB
    $points->update($request->all());

    return redirect()->route('matching.settings')->with('success', 'Settings updated!');
}

public function showSettings()
{
    // Get the first record from the MatchingPoint table
    $points = \App\Models\MatchingPoint::first(); 

    // Check if the record is null and handle accordingly
    if (!$points) {
        // You can return an error message or create default points
        return redirect()->route('matching.settings')->with('error', 'No points data found!');
    }

    // Return the view and pass the points data
    return view('matching.settings', compact('points'));
}



}
