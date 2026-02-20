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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('native_name')->nullable();
            $table->string('iso_code', 10)->unique();
            $table->boolean('is_rtl')->default(false);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        DB::statement("
                CREATE INDEX languages_active_idx
                ON languages (sort_order)
                WHERE is_active = true
            ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS languages_active_idx");
        Schema::dropIfExists('languages');
    }
};
