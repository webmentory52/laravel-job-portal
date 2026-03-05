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
        Schema::create('candidate_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('location');
            $table->mediumText('description');
            $table->string('salary')->nullable();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ["pending", "approved", "rejected", "expired"])->default("pending");
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('job_type_id')->nullable()->constrained('job_types')->nullOnDelete();
            $table->foreignId('work_place_id')->nullable()->constrained('work_places')->nullOnDelete();
            $table->boolean('agreement_accepted')->default(false);
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_jobs');
    }
};
