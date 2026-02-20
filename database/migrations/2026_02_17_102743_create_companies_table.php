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
        Schema::create('companies', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('slug')->unique();

            $table->foreignId('industry_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('company_type_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('company_size_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('city_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Important indexes
            $table->index('industry_id');
            $table->index('city_id');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
