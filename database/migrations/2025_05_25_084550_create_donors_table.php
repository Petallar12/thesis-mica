<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('gender');
            $table->string('goverment_id_number')->unique();
            $table->string('contact_information');
            $table->string('blood_type');
            $table->integer('age');
            $table->string('organ_needed');
            $table->string('medical_history', 255);
            $table->string('waiting_time', 255);
            $table->string('donation_preferences', 255);
            $table->date('birthday')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->string('kin_fullname')->nullable();
            $table->string('relationship_to_donor')->nullable();
            $table->string('kin_contact_number')->nullable();
            $table->string('kin_email')->nullable();
            $table->string('kin_address')->nullable();
            $table->string('kin_consent')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('cause_of_death')->nullable();
            $table->string('brain_death_confirmation')->nullable();
            $table->string('communicable_diseases')->nullable();
            $table->string('organ_viability_status')->nullable();
            $table->string('donor_status')->nullable();
            $table->string('consent_type')->nullable();
            $table->string('organ_size')->nullable();
            $table->string('ogran_function')->nullable();
            $table->time('retrieval_time')->nullable();
            $table->string('organ_preservation_status')->nullable();
            $table->string('condition_of_organs')->nullable();
            $table->string('organ_compability')->nullable();
            $table->string('organ_recovery_team')->nullable();
            $table->date('donor_card_registration_date')->nullable();
            $table->string('registration_method')->nullable();
            $table->string('notification_set_to_family')->nullable();
            $table->string('donor_card_qr_code')->nullable();
            $table->string('donation_type')->nullable();
            $table->string('donation_purpose')->nullable();
            $table->string('condition_for_donation')->nullable();
            $table->string('signature')->nullable();
            $table->date('todays_date')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
