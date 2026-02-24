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
        Schema::create('locations', function (Blueprint $table) {
            

            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('label');
            $table->json('meta')->nullable(); // state_id, city_id, area_id etc.
            // Optional but useful
            $table->string('pincode', 20)->nullable();
            // For radius search (important for future)
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Metro boost logic
            $table->boolean('is_metro')->default(false);

           

            $table->timestamps();

            // 🔥 Important Indexes (10M+ Ready)
            $table->index('label');
            $table->index('meta');
            $table->index(['latitude', 'longitude']);

          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
