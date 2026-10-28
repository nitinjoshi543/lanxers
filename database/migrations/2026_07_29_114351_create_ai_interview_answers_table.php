<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_interview_answers', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('interview_question_id');

            $table->longText('candidate_answer')->nullable();

            $table->decimal('ai_score', 5, 2)->nullable();

            $table->longText('ai_feedback')->nullable();

            $table->longText('ideal_answer')->nullable();

            $table->timestamps();

            $table->index('interview_question_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_interview_answers');
    }
};