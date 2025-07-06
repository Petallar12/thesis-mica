<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Recipients;
use Illuminate\Http\Request;

class MatchingController extends Controller
{
    public function index()
    {
        // Get all donors and recipients
        $donors = Donor::all();
        $recipients = Recipients::all();
        
        // Group donors by organ available
        $donorsByOrgan = $donors->groupBy('organ_needed');
        
        // Group recipients by organ needed
        $recipientsByOrgan = $recipients->groupBy('organ_needed');
        
        // Create matches
        $matches = [];
        
        foreach ($donorsByOrgan as $organ => $donors) {
            if (isset($recipientsByOrgan[$organ])) {
                $recipients = $recipientsByOrgan[$organ];
                
                foreach ($donors as $donor) {
                    foreach ($recipients as $recipient) {
                        // Strictly require all four criteria:
                        // 1. Same organ_needed (already grouped)
                        // 2. Same blood type
                        // 3. Both status = 'Active'
                        // 4. Both transplant_status = 'Waiting'
                        if (
                            $donor->blood_type === $recipient->blood_type &&
                            $donor->status === 'Active' &&
                            $recipient->status === 'Active' &&
                            $donor->transplant_status === 'Waiting' &&
                            $recipient->transplant_status === 'Waiting'
                        ) {
                            // Optionally, run further compatibility checks and scoring
                            $compatibility = $this->checkCompatibility($donor, $recipient);
                            $pointsBreakdown = [];
                            $matchScore = $this->calculateMatchScore($donor, $recipient, $pointsBreakdown);
                            $matches[] = [
                                'donor' => $donor,
                                'recipient' => $recipient,
                                'organ' => $organ,
                                'compatibility' => $compatibility,
                                'matchScore' => $matchScore,
                                'pointsBreakdown' => $pointsBreakdown
                            ];
                        }
                    }
                }
            }
        }
        
        // Sort matches by match score (highest first)
        usort($matches, function($a, $b) {
            return $b['matchScore'] <=> $a['matchScore'];
        });
        
        return view('matching.index', compact('matches', 'donors', 'recipients'));
    }
    
    private function checkCompatibility($donor, $recipient)
    {
        $compatibility = [
            'isCompatible' => true,
            'checks' => []
        ];
        
        // Check if donor is available (status check)
        if ($donor->donor_status !== 'Alive' && $donor->donor_status !== 'Deceased') {
            $compatibility['isCompatible'] = false;
            $compatibility['checks'][] = 'Donor not available';
        }
        
        // Check if recipient is still waiting
        if ($recipient->transplant_status !== 'Waiting' && $recipient->transplant_status !== 'Listed') {
            $compatibility['isCompatible'] = false;
            $compatibility['checks'][] = 'Recipient not waiting for transplant';
        }
        
        // Blood type compatibility (basic check)
        if ($donor->blood_type && $recipient->blood_type) {
            $bloodCompatible = $this->checkBloodTypeCompatibility($donor->blood_type, $recipient->blood_type);
            $compatibility['checks'][] = 'Blood type: ' . ($bloodCompatible ? 'Compatible' : 'Incompatible');
            if (!$bloodCompatible) {
                $compatibility['isCompatible'] = false;
            }
        }
        
        // Age compatibility (donor should be within reasonable age range)
        if ($donor->age && $recipient->age) {
            $ageDiff = abs($donor->age - $recipient->age);
            $compatibility['checks'][] = 'Age difference: ' . $ageDiff . ' years';
            if ($ageDiff > 30) {
                $compatibility['checks'][] = 'Large age difference may affect compatibility';
            }
        }
        
        // Size compatibility (basic check)
        if ($donor->organ_size && $recipient->height && $donor->height) {
            $sizeCompatible = $this->checkSizeCompatibility($donor, $recipient);
            $compatibility['checks'][] = 'Size: ' . ($sizeCompatible ? 'Compatible' : 'May need size adjustment');
        }
        
        return $compatibility;
    }
    
    private function checkBloodTypeCompatibility($donorBlood, $recipientBlood)
    {
        // Basic blood type compatibility rules
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
        // Basic size compatibility check
        $donorHeight = $donor->height ?? 0;
        $recipientHeight = $recipient->height ?? 0;
        
        if ($donorHeight > 0 && $recipientHeight > 0) {
            $heightDiff = abs($donorHeight - $recipientHeight);
            return $heightDiff <= 20; // Within 20cm difference
        }
        
        return true; // If we can't determine, assume compatible
    }
    
    private function calculateMatchScore($donor, $recipient, &$pointsBreakdown = null)
    {
        $score = 0;
        $pointsBreakdown = [
            'waiting_time' => ['label' => 'Waiting Time', 'points' => 0, 'max' => 30, 'desc' => ''],
            'age' => ['label' => 'Age', 'points' => 0, 'max' => 10, 'desc' => ''],
            'blood_type' => ['label' => 'Blood Type', 'points' => 0, 'max' => 25, 'desc' => ''],
            'urgency' => ['label' => 'Urgency', 'points' => 0, 'max' => 35, 'desc' => ''],
        ];

        // Waiting time (recipient->waiting_time in months)
        if (isset($recipient->waiting_time)) {
            $months = (int) $recipient->waiting_time;
            if ($months < 12) {
                $score += 10;
                $pointsBreakdown['waiting_time']['points'] = 10;
                $pointsBreakdown['waiting_time']['desc'] = "$months months (<12)";
            } elseif ($months >= 12 && $months < 36) {
                $score += 20;
                $pointsBreakdown['waiting_time']['points'] = 20;
                $pointsBreakdown['waiting_time']['desc'] = "$months months (12-35)";
            } elseif ($months >= 36) {
                $score += 30;
                $pointsBreakdown['waiting_time']['points'] = 30;
                $pointsBreakdown['waiting_time']['desc'] = "$months months (36+)";
            }
        }

        // Age (recipient->age)
        if (isset($recipient->age)) {
            $age = (int) $recipient->age;
            if ($age < 18) {
                $pointsBreakdown['age']['points'] = 0;
                $pointsBreakdown['age']['desc'] = "$age years (<18)";
            } elseif ($age >= 18) {
                $score += 10;
                $pointsBreakdown['age']['points'] = 10;
                $pointsBreakdown['age']['desc'] = "$age years (18+)";
            }
        }

        // Blood type compatibility (25 points)
        if ($donor->blood_type && $recipient->blood_type) {
            if ($this->checkBloodTypeCompatibility($donor->blood_type, $recipient->blood_type)) {
                $score += 25;
                $pointsBreakdown['blood_type']['points'] = 25;
                $pointsBreakdown['blood_type']['desc'] = 'Compatible';
            } else {
                $pointsBreakdown['blood_type']['desc'] = 'Incompatible';
            }
        }

        // Medical urgency (Low=10, Medium=20, High=30, Critical=35)
        if (isset($recipient->medical_urgency_score)) {
            $urgency = strtolower($recipient->medical_urgency_score);
            if ($urgency === 'low') {
                $score += 10;
                $pointsBreakdown['urgency']['points'] = 10;
                $pointsBreakdown['urgency']['desc'] = 'Low';
            } elseif ($urgency === 'medium') {
                $score += 20;
                $pointsBreakdown['urgency']['points'] = 20;
                $pointsBreakdown['urgency']['desc'] = 'Medium';
            } elseif ($urgency === 'high') {
                $score += 30;
                $pointsBreakdown['urgency']['points'] = 30;
                $pointsBreakdown['urgency']['desc'] = 'High';
            } elseif ($urgency === 'critical') {
                $score += 35;
                $pointsBreakdown['urgency']['points'] = 35;
                $pointsBreakdown['urgency']['desc'] = 'Critical';
            } else {
                $pointsBreakdown['urgency']['desc'] = ucfirst($urgency);
            }
        }

        return $score;
    }
} 