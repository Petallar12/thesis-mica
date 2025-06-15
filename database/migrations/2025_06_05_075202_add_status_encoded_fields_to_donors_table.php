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
        Schema::table('donors', function (Blueprint $table) {
            $table->string('status', 100)->nullable();
            $table->string('encoded_by', 100)->nullable();
            $table->date('encoded_date')->nullable();
            $table->string('contact_number', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('encoded_by');
            $table->dropColumn('encoded_date');
            $table->dropColumn('contact_number');
        });
    }
};
