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
        Schema::create('shift_types', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            // day, night, rotational, flexible

            $table->string('label');
            // Day Shift, Night Shift

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->smallInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

            DB::statement("
                CREATE INDEX shift_types_active_idx
                ON shift_types (sort_order)
                WHERE is_active = true  
            ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS shift_types_active_idx");
        Schema::dropIfExists('shift_types');
    }
};
