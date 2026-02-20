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
        Schema::create('company_types', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            // startup, mnc, government, ngo, private, public

            $table->string('label');
            // Startup, MNC, Government Organization

            $table->text('description')->nullable();

            $table->smallInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        DB::statement("
            CREATE INDEX company_types_active_idx
            ON company_types (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS company_types_active_idx");
        Schema::dropIfExists('company_types');
    }
};
