<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('iso_code', 5)->unique();
            $table->string('phone_code')->nullable();

            // Coordinates
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::statement("
            CREATE INDEX countries_active_idx
            ON countries (id)
            WHERE is_active = true
        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS countries_active_idx");
        Schema::dropIfExists('countries');
    }
};
