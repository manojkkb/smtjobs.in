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
        Schema::create('notice_periods', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            // immediate, 15_days, 30_days, 60_days

            $table->string('label');
            // Immediate Joiner, 30 Days

            $table->integer('days')->nullable();
            // 0, 15, 30, 60, 90

            $table->smallInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::statement("
            CREATE INDEX notice_periods_active_idx
            ON notice_periods (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS notice_periods_active_idx");
        Schema::dropIfExists('notice_periods');
    }
};
