<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $table = 'donors';

    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        // 'birthday', 
        // 'nationality',
        'contact_number',
        'contact_information', //email address
        'goverment_id_number',
        // 'address',
    //next of kin information
        //'kin_fullname',
        //'relationship_to_donor',
        //'kin_contact_number',
        //'kin_email',
        //'kin_address',
        //'kin_consent',
    //Medical Information
        'blood_type',
        //'height',
        //'weight',
        //'cause_of_death',
        //'brain_death_confirmation',
        'medical_history',
        //'communicable_diseases',
        //'organ_viability_status',
        'status', //donor status
        //'consent_type',
    //Organ-Specific Information:
        'organ_needed', //Organ Available
        //'organ_size',
        //'ogran_function',
        //'retrieval_time',
        //'organ_preservation_status',
        //'condition_of_organs',
        //'organ_compability',
        //'organ_recovery_team',
    //System Information
        //'donor_card_registration_date',
        //'registration_method',
        //'notification_set_to_family',
        //'donor_card_qr_code',
        //'donor_status',

        'waiting_time',
        'donation_preferences',
        'encoded_by',
        'encoded_date',

        'age'
    ];
}
