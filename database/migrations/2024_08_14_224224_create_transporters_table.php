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
        Schema::create('transporters', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->longText('email');
            $table->longText('password');
            $table->longText('image');
            $table->longText('phone');
            $table->timestamp('phone_verified_at');
            $table->string('email_otp');
            $table->longText('aadhaar_number');
            $table->longText('pan_number');
            $table->longText('rc_number');
            $table->boolean('phone_verified')->default(false);
            $table->boolean('aadhaar_verified')->default(false);
            $table->boolean('pan_verified')->default(false);
            $table->boolean('bank_verified')->default(false);
            $table->boolean('email_verified')->default(false);
            $table->boolean('rc_verified')->default(false);
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transporters');
    }
};
