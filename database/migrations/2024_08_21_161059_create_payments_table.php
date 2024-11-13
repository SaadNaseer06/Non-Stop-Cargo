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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('transporter_id');
            $table->unsignedBigInteger('request_truck_id');
            $table->decimal('amount', 10, 2); // Payment amount
            $table->string('payment_status')->default('pending'); // e.g., pending, successful, failed
            $table->string('payment_method')->nullable(); // e.g., Razorpay, etc.
            $table->string('transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('transporter_id')->references('id')->on('transporters')->onDelete('cascade');
            $table->foreign('request_truck_id')->references('id')->on('request_trucks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
