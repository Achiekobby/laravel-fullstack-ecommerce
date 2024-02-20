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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');

            //* ids
            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();

            $table->foreignId('subcategory_id')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->nullOnDelete();

            $table->unsignedBigInteger('admin_id');

            $table->string('brand')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('regular_price')->default("0.00");
            $table->string('sales_price')->default("0.00");
            $table->string('quantity');
            $table->longText('description');
            $table->double('rating')->nullable();
            $table->enum('status',['active', 'inactive'])->default('active');
            $table->string('discount_percentage')->default(0);

            $table->json('details')->nullable();
            $table->json('photos');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
