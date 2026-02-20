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
        Schema::create('industries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('label');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            // Basic indexes
            $table->index('is_active');
        });
        DB::statement("
            CREATE INDEX industries_active_idx
            ON industries (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS industries_active_idx");
        Schema::dropIfExists('industries');
    }
};
