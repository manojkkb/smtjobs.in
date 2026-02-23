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
        Schema::create('education_degrees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_level_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('label');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('education_level_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_degrees');
    }
};
