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
        Schema::create('assistances', function (Blueprint $table) {
            $table->id();
            $table->string('assistance_title');
            $table->date('assistance_date');
            $table->timestamps();
        });

        Schema::create('assistance_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assistance_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assistances');
        Schema::dropIfExists('assistance_user');
    }


    /**
     * Reverse the migrations.
     */

};
