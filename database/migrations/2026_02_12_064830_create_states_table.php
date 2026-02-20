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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('code', 10)->nullable();

            // Coordinates
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['country_id', 'name']);
            $table->index('country_id');
        });

        DB::statement("
            CREATE INDEX states_active_idx
            ON states (id)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS states_active_idx");
        Schema::dropIfExists('states');
    }
};
