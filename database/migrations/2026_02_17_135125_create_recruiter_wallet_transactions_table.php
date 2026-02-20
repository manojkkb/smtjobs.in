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
        Schema::create('recruiter_wallet_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('recruiter_id')
                ->constrained('recruiters')
                ->cascadeOnDelete()
                ->index();

            $table->smallInteger('credit_type')->index();
            // 1=job,2=database,3=ai

            $table->bigInteger('amount');
            $table->bigInteger('balance_after');

            $table->string('transaction_type')->index();

            $table->unsignedBigInteger('reference_id')->nullable();

            $table->jsonb('meta_json')->nullable();

            $table->timestamps();

            $table->index(['recruiter_id', 'credit_type', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiter_wallet_transactions');
    }
};
