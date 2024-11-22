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
        Schema::table('calamity_reports', function (Blueprint $table) {
            $table->boolean('viewed')->default(false)->after('created_at'); // Add a 'viewed' column
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
