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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->text('address');
            $table->string('mobile_number');
            $table->json('cart_items'); // Storing product details as JSON
            $table->string('delivery_option');
            $table->string('payment_method');
            $table->json('payment_details')->nullable(); // For bKash/Nagad number and TrxID
            $table->decimal('subtotal', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('delivery_charge', 8, 2);
            $table->decimal('final_total', 8, 2);
            $table->string('status')->default('Pending'); // e.g., Pending, Processing, Shipped, Delivered, Canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
