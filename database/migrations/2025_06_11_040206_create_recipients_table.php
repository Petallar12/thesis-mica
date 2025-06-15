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
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('gender');
            $table->date('birthday');
            $table->string('goverment_id_number')->unique();
            $table->text('contact_information')->nullable();
            $table->string('blood_type');
            $table->integer('age');
            $table->string('organ_needed');
            $table->text('medical_history')->nullable();
            $table->integer('waiting_time')->nullable();
            $table->text('donation_preferences')->nullable();
            $table->string('status', 100)->default('Active');
            $table->string('encoded_by', 100);
            $table->date('encoded_date');
            $table->string('contact_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipients');
    }
};
