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
        Schema::create('assistance_histories', function (Blueprint $table) {
            $table->id();
            Schema::create('assistance_histories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('report_id')->constrained('calamity_reports')->onDelete('cascade');
                $table->string('assistance_type');
                $table->timestamp('date_provided');
                $table->text('remarks')->nullable();
                $table->timestamps();
            });
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistance_histories');
    }
};
