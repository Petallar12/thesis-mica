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

        // Group donors and recipients by organ
        $donorsByOrgan = $donors->groupBy('organ_needed');
        $recipientsByOrgan = $recipients->groupBy('organ_needed');

        // Create matches grouped by donor
        $matches = [];

        foreach ($donorsByOrgan as $organ => $donorsGroup) {
            if (isset($recipientsByOrgan[$organ])) {
                $recipientsGroup = $recipientsByOrgan[$organ];

                foreach ($donorsGroup as $donor) {
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
        $score = 0;
        $pointsBreakdown = [
            'waiting_time' => ['label' => 'Waiting Time', 'points' => 0, 'max' => 30, 'desc' => ''],
            'age' => ['label' => 'Age', 'points' => 0, 'max' => 10, 'desc' => ''],
            'blood_type' => ['label' => 'Blood Type', 'points' => 0, 'max' => 25, 'desc' => ''],
            'urgency' => ['label' => 'Urgency', 'points' => 0, 'max' => 35, 'desc' => ''],
        ];

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

        if ($donor->blood_type && $recipient->blood_type) {
            if ($this->checkBloodTypeCompatibility($donor->blood_type, $recipient->blood_type)) {
                $score += 25;
                $pointsBreakdown['blood_type']['points'] = 25;
                $pointsBreakdown['blood_type']['desc'] = 'Compatible';
            } else {
                $pointsBreakdown['blood_type']['desc'] = 'Incompatible';
            }
        }

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
