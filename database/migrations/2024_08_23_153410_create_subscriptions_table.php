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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transporter_id'); // ID of the transporter
            $table->unsignedBigInteger('plan_id'); // Plan ID
            $table->string('subscription_id'); // Razorpay subscription ID
            $table->string('status')->default('active'); // Subscription status
            $table->timestamp('start_date'); // Subscription start date
            $table->timestamp('end_date')->nullable(); // Subscription end date
            $table->timestamps();

            $table->foreign('transporter_id')->references('id')->on('transporters')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
