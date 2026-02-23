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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            // aws_certified, pmp, ccna

            $table->string('label');
            // AWS Certified Solutions Architect
            $table->string('category');

            $table->string('issuing_authority')->nullable();
            // Amazon, PMI, Cisco

            $table->string('icon')->nullable();

            $table->smallInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        DB::statement("
            CREATE INDEX certificates_active_idx
            ON certificates (sort_order)
            WHERE is_active = true
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS certificates_active_idx");
        Schema::dropIfExists('certificates');
    }
};
