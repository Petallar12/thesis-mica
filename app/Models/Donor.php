<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $table = 'donors';

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
    //next of kin information (tab)
        'kin_fullname',
        'relationship_to_donor',
        'kin_contact_number',
        'kin_email',
        'kin_address',
        'kin_consent',
    //Medical Information (tab) 
        'blood_type',
        'height',
        'weight',
        'cause_of_death',
        'brain_death_confirmation',
        'medical_history',
        'communicable_diseases',
        'organ_viability_status',
        'donor_status',
        'transplant_status',
        'status', 
        'consent_type',
    //Organ-Specific Information:(tab)
        'organ_needed', //Organ Available
        'organ_size',
        'ogran_function',
        'retrieval_time',
        'organ_preservation_status',
        'condition_of_organs',
        'organ_compability',
        'organ_recovery_team',
    //System Information(tab)
        'donor_card_registration_date',
        'registration_method',
        'notification_set_to_family',
        'donor_card_qr_code',
    //Others (tab)
        'donation_type',
        'donation_purpose',
        'condition_for_donation',
        'signature',
        'todays_date',
        'waiting_time',
        'donation_preferences',
        'encoded_by',
        'encoded_date',
    ];
}
