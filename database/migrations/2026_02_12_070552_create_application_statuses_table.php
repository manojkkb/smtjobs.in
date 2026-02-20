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
        Schema::create('application_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->smallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);    
            $table->timestamps();
        });
        DB::statement("
            CREATE INDEX application_statuses_active_idx
            ON application_statuses (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS application_statuses_active_idx");
        Schema::dropIfExists('application_statuses');
    }
};
