<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_interviews', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('candidate_id');

            $table->enum('status', [
                'pending',
                'started',
                'completed',
                'expired',
                'cancelled'
            ])->default('pending');

            $table->integer('total_questions')->default(10);
            $table->integer('current_question')->default(1);

            $table->decimal('overall_score', 5, 2)->nullable();

            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->index('job_id');
            $table->index('proposal_id');
            $table->index('employer_id');
            $table->index('candidate_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_interviews');
    }
};