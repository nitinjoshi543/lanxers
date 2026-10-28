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
        Schema::table('ai_interviews', function (Blueprint $table) {

            $table->decimal('overall_rating', 3, 2)
                ->nullable()
                ->after('overall_score');

            $table->decimal('communication_score', 5, 2)
                ->nullable()
                ->after('overall_rating');

            $table->decimal('technical_score', 5, 2)
                ->nullable()
                ->after('communication_score');

            $table->decimal('problem_solving_score', 5, 2)
                ->nullable()
                ->after('technical_score');

            $table->decimal('confidence_score', 5, 2)
                ->nullable()
                ->after('problem_solving_score');

            $table->decimal('professionalism_score', 5, 2)
                ->nullable()
                ->after('confidence_score');

            $table->string('recommendation', 100)
                ->nullable()
                ->after('professionalism_score');

            $table->json('strengths')
                ->nullable()
                ->after('recommendation');

            $table->json('weaknesses')
                ->nullable()
                ->after('strengths');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_interviews', function (Blueprint $table) {

            $table->dropColumn([
                'overall_rating',
                'communication_score',
                'technical_score',
                'problem_solving_score',
                'confidence_score',
                'professionalism_score',
                'recommendation',
                'strengths',
                'weaknesses',
            ]);

        });
    }
};