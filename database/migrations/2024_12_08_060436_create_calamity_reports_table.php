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
        Schema::create('calamity_reports', function (Blueprint $table) {
            $table->id();
            $table->string('calamity');
            $table->string('farmer_type');
            $table->string('rsbsa_ref_number')->nullable();
            $table->string('crops_or_livestocks');
            $table->json('proof_images');  // For storing multiple images as JSON
            $table->text('remarks')->nullable();

            // Dynamic fields for crops
            $table->string('partial_damage_area')->nullable();
            $table->string('totally_damage_area')->nullable();
            $table->string('total_area')->nullable();

            // Dynamic fields for livestocks
            $table->string('farm_type')->nullable();
            $table->string('animal_type')->nullable();
            $table->string('age_classification')->nullable();
            $table->integer('no_of_heads')->nullable();

            // Personal info fields (for individual)
            $table->string('surname')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('extension_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('region')->nullable();
            $table->string('municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('barangay')->nullable();

            // Group info fields (for group)
            $table->string('org_name')->nullable();
            $table->integer('male_count')->nullable();
            $table->integer('female_count')->nullable();

            // Indigenous info fields
            $table->string('sex')->nullable();
            $table->string('tribe_name')->nullable();
            $table->enum('pwd', ['yes', 'no'])->nullable();
            $table->enum('arb', ['yes', 'no'])->nullable();
            $table->enum('four_ps', ['yes', 'no'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calamity_reports');
    }
};
