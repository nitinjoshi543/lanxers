<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_interview_questions', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('interview_id');

            $table->longText('question');

            $table->string('expected_skill')->nullable();

            $table->integer('question_order');

            $table->timestamps();

            $table->index('interview_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_interview_questions');
    }
};