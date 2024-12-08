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
        Schema::table('calamity_reports', function (Blueprint $table) {
            $table->boolean('viewed')->default(false); // Default value is false (not viewed)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calamity_reports', function (Blueprint $table) {
            //
        });
    }
};