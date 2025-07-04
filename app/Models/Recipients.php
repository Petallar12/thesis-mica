<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipients extends Model
{
    use HasFactory;

    protected $table = 'recipients';

        protected $fillable = [
    //Personal Information: (Tab)
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'birthday',
            'age',
            'nationality',
            'contact_number',
            'contact_information', //email address
            'goverment_id_number',
            'address',

    //Next of Kin Information: (Tab)
            'kin_fullname',
            'relationship_to_recipient',
            'kin_contact_number',
            'kin_email',
            'kin_address',

        //Medical Information:(Tab)
            'blood_type',
            'hla_typing',
            'medical_condition',
            'medical_urgency_score',
            'date_listed',
            'medical_history',
            'immunologic_sensitization',   
            'priority_score',
    
    //Transplant information (Tab)
            'organ_needed',
            'match_attempts',
            'transplant_status',

    // Transplant Scheduling (Tab)
            'scheduled_transplant_date',
            'transplantation_time',
            'operating_room_availaility',
            'transplant_surgeon',
            'surgical_team_availability',
            'hospital_location',
            'transport_arrangement',


    //others (Tab)        
            'waiting_time',
            'donation_preferences',
            'status',
            'encoded_by',
            'encoded_date'
    ];
}
