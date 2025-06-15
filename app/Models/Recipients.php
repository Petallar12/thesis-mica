<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipients extends Model
{
    use HasFactory;

    protected $table = 'recipients';

    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthday',
        'goverment_id_number',
        'contact_information',
        'blood_type',
        'age',
        'organ_needed',
        'medical_history',
        'waiting_time',
        'donation_preferences',
        'status',
        'encoded_by',
        'encoded_date',
        'contact_number'
    ];
}
