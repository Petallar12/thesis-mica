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
    Schema::create('matching_points', function (Blueprint $table) {
        $table->id();
        $table->integer('waiting_time_less_than_12')->default(10);
        $table->integer('waiting_time_12_to_35')->default(20);
        $table->integer('waiting_time_more_than_36')->default(30);
        $table->integer('age_less_than_18')->default(0);
        $table->integer('age_more_than_18')->default(10);
        $table->integer('blood_type')->default(25);
        $table->integer('urgency_low')->default(10);
        $table->integer('urgency_medium')->default(20);
        $table->integer('urgency_high')->default(30);
        $table->integer('urgency_critical')->default(35);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matching_points');
    }
};
