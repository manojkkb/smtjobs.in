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
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes
            $table->index('state_id');
            $table->index('district_id');
            $table->index('name');
            $table->unique(['state_id','slug']);

            // Foreign keys
            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->cascadeOnDelete();

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
