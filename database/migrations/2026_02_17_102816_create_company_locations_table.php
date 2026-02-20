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
        Schema::create('company_locations', function (Blueprint $table) {
             $table->bigIncrements('id');

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('address')->nullable();

            $table->timestamps();

            $table->index(['company_id', 'city_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_locations');
    }
};
