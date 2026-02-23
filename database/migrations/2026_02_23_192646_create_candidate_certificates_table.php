<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidate_certificates', function (Blueprint $table) {
            $table->bigIncrements('id');

            // 🔥 Important for scale
            $table->unsignedBigInteger('candidate_id');

            $table->string('certificate_name', 150);
            $table->string('issuing_organization', 150)->nullable();

            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();

            $table->string('credential_id', 100)->nullable();
            $table->string('credential_url', 255)->nullable();

            $table->string('certificate_file', 255)->nullable();

            $table->boolean('does_not_expire')->default(false);

            $table->timestamps();
        });

        DB::statement('CREATE INDEX idx_cert_candidate ON candidate_certificates (candidate_id)');
        DB::statement('CREATE INDEX idx_cert_expiry ON candidate_certificates (expiry_date)');
        DB::statement('CREATE INDEX idx_cert_name ON candidate_certificates (certificate_name)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS idx_cert_candidate');
        DB::statement('DROP INDEX IF EXISTS idx_cert_expiry');
        DB::statement('DROP INDEX IF EXISTS idx_cert_name');
        Schema::dropIfExists('candidate_certificates');
    }
};
