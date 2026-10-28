<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_interviews', function (Blueprint $table) {

            $table->enum('interview_type', ['job', 'profile'])
                  ->default('job')
                  ->after('candidate_id');

            $table->decimal('ai_rating', 5, 2)
                  ->nullable()
                  ->after('overall_score');

            $table->enum('ai_level', [
                'Beginner',
                'Intermediate',
                'Advanced',
                'Expert'
            ])->nullable()->after('ai_rating');

            $table->text('ai_feedback')
                  ->nullable()
                  ->after('ai_level');

        });
    }

    public function down(): void
    {
        Schema::table('ai_interviews', function (Blueprint $table) {

            $table->dropColumn([
                'interview_type',
                'ai_rating',
                'ai_level',
                'ai_feedback'
            ]);

        });
    }
};
