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

        // Country (future expansion ke liye)
        $table->string('country', 100)->default('India');

        // India specific hierarchy
        $table->string('state', 100);
        $table->string('district', 100)->nullable();
        $table->string('city', 100);

        // Optional but useful
        $table->string('pincode', 20)->nullable();

        // For radius search (important for future)
        $table->decimal('latitude', 10, 7)->nullable();
        $table->decimal('longitude', 10, 7)->nullable();

        // Metro boost logic
        $table->boolean('is_metro')->default(false);

        // Slug for SEO pages (jobs-in-mumbai)
        $table->string('slug')->unique();

        $table->timestamps();

        // 🔥 Important Indexes (10M+ Ready)
        $table->index('state');
        $table->index('city');
        $table->index(['state', 'city']);
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
