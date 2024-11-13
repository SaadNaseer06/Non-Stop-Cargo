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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->longText('email');
            $table->longText('phone');
            $table->longText('password');
            $table->longText('image');
            $table->string('email_otp');
            $table->timestamp('phone_verified_at');
            $table->longText('aadhaar_number');
            $table->longText('pan_number');
            $table->boolean('phone_verified')->default(false);
            $table->boolean('aadhaar_verified')->default(false);
            $table->boolean('pan_verified')->default(false);
            $table->boolean('email_verified')->default(false);
            $table->timestamp('phone_verified_at');
            $table->boolean('phone_verified')->default(false);
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
