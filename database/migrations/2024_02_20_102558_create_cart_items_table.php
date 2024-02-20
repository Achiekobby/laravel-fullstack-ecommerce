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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id');
            $table->foreign('cart_id')->references('id')->on('carts')->cascadeOnDelete();
            $table->unsignedBigInteger('product_id');
            $table->string('name');
            $table->json('details')->nullable();
            $table->string('quantity')->default(0);
            $table->string('item_price')->default(0);
            $table->string('sales_price')->default(0);
            $table->string('discount')->nullable();
            $table->string('currency')->nullable('GHS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
