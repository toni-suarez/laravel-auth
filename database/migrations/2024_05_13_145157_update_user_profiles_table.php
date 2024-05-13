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
        Schema::table('user_profiles', function(Blueprint $table) {
            $table->unsignedInteger('address_id')->nullable()->after('age');
            $table->unsignedInteger('hair_id')->nullable();
            $table->unsignedInteger('bank_id')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('crypto_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
