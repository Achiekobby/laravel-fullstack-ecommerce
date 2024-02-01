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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();

            $table->string("first_name");
            $table->string("last_name");
            $table->string("phone_number")->nullable();

            $table->string("address")->nullable();
            $table->string("state")->nullable();
            $table->string("city")->default("Accra");
            $table->string("country")->default("Ghana");
            $table->string("country_abbr")->default("GH");
            $table->json("geolocation")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
