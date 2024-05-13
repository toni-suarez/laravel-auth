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
        Schema::create('hairs', function (Blueprint $table) {
            $table->id();
            $table->string('color')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->json('coordinates')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('state')->nullable();
            $table->timestamps();
        });

        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('card_expire')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_type')->nullable();
            $table->string('currency')->nullable();
            $table->string('iban')->nullable();
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('department')->nullable();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamps();
        });

        Schema::create('cryptos', function (Blueprint $table) {
            $table->id();
            $table->string('coin')->nullable();
            $table->string('wallet')->nullable();
            $table->string('network')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hairs');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('cryptos');
    }
};
