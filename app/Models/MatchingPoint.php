<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchingPoint extends Model
{
    use HasFactory;

    protected $table = 'matching_points'; // Adjust to your table name

    protected $fillable = [
        'waiting_time_less_than_12',
        'waiting_time_12_to_35',
        'waiting_time_more_than_36',
        'age_less_than_18',
        'age_more_than_18',
        'blood_type',
        'urgency_low',
        'urgency_medium',
        'urgency_high',
        'urgency_critical',
    ];
}
