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
        Schema::create('user_profiles', function(Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('maiden_name')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('image')->nullable();
            $table->decimal('height', total: 5, places: 2)->nullable();
            $table->decimal('weight', total: 5, places: 2)->nullable();
            $table->string('eye_color')->nullable();
            $table->string('domain')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->macAddress('mac_address')->nullable();
            $table->text('university')->nullable();
            $table->string('ein')->nullable();
            $table->string('ssn')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
