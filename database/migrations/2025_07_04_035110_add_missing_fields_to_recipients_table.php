<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('recipients', function (Blueprint $table) {
            // Personal Information fields
            $table->string('nationality')->nullable()->after('age');
            $table->text('address')->nullable()->after('nationality');
            
            // Next of Kin Information fields
            $table->string('kin_fullname')->nullable()->after('address');
            $table->string('relationship_to_recipient')->nullable()->after('kin_fullname');
            $table->string('kin_contact_number')->nullable()->after('relationship_to_recipient');
            $table->string('kin_email')->nullable()->after('kin_contact_number');
            $table->text('kin_address')->nullable()->after('kin_email');
            
            // Medical Information fields
            $table->string('hla_typing')->nullable()->after('blood_type');
            $table->string('medical_condition')->nullable()->after('hla_typing');
            $table->integer('medical_urgency_score')->nullable()->after('medical_condition');
            $table->date('date_listed')->nullable()->after('medical_urgency_score');
            $table->string('immunologic_sensitization')->nullable()->after('date_listed');
            $table->integer('priority_score')->nullable()->after('immunologic_sensitization');
            
            // Transplant Information fields
            $table->integer('match_attempts')->nullable()->after('organ_needed');
            $table->string('transplant_status')->nullable()->after('match_attempts');
            
            // Transplant Scheduling fields
            $table->date('scheduled_transplant_date')->nullable()->after('transplant_status');
            $table->time('transplantation_time')->nullable()->after('scheduled_transplant_date');
            $table->string('operating_room_availaility')->nullable()->after('transplantation_time');
            $table->string('transplant_surgeon')->nullable()->after('operating_room_availaility');
            $table->string('surgical_team_availability')->nullable()->after('transplant_surgeon');
            $table->string('hospital_location')->nullable()->after('surgical_team_availability');
            $table->string('transport_arrangement')->nullable()->after('hospital_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipients', function (Blueprint $table) {
            // Personal Information fields
            $table->dropColumn('nationality');
            $table->dropColumn('address');
            
            // Next of Kin Information fields
            $table->dropColumn('kin_fullname');
            $table->dropColumn('relationship_to_recipient');
            $table->dropColumn('kin_contact_number');
            $table->dropColumn('kin_email');
            $table->dropColumn('kin_address');
            
            // Medical Information fields
            $table->dropColumn('hla_typing');
            $table->dropColumn('medical_condition');
            $table->dropColumn('medical_urgency_score');
            $table->dropColumn('date_listed');
            $table->dropColumn('immunologic_sensitization');
            $table->dropColumn('priority_score');
            
            // Transplant Information fields
            $table->dropColumn('match_attempts');
            $table->dropColumn('transplant_status');
            
            // Transplant Scheduling fields
            $table->dropColumn('scheduled_transplant_date');
            $table->dropColumn('transplantation_time');
            $table->dropColumn('operating_room_availaility');
            $table->dropColumn('transplant_surgeon');
            $table->dropColumn('surgical_team_availability');
            $table->dropColumn('hospital_location');
            $table->dropColumn('transport_arrangement');
        });
    }
};
