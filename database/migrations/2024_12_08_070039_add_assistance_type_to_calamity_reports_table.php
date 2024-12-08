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
            Schema::table('calamity_reports', function (Blueprint $table) {
                $table->string('assistance_type')->nullable(); // Adding assistance_type field
            });
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
