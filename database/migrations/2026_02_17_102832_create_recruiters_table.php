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
        Schema::create('recruiters', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');

            $table->string('role')->default('hr'); // owner, hr, interviewer

            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);

            $table->timestamp('last_active_at')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'company_id']);
            $table->index('company_id');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiters');
    }
};
