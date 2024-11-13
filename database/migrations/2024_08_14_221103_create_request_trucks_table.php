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
        Schema::create('request_trucks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->longText('type');
            $table->longText('weight');
            $table->longText('quantity');
            $table->longText('origin');
            $table->longText('destination');
            $table->longText('status')->default(0);
            $table->timestamp('bidding_ends_at')->nullable();
            $table->unsignedBigInteger('winning_bid_id')->nullable();

            $table->foreign('winning_bid_id')->references('id')->on('bids')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_trucks');
    }
};
