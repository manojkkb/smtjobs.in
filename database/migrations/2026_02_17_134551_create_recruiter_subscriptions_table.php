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
        Schema::create('recruiter_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('recruiter_id')
                ->constrained('recruiters')
                ->cascadeOnDelete()
                ->index();

            $table->foreignId('subscription_plan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamp('starts_at')->index();
            $table->timestamp('expires_at')->index();

            $table->smallInteger('status')->default(1)->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiter_subscriptions');
    }
};
