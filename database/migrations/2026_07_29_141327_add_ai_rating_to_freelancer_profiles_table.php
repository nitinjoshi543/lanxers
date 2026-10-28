<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {

            $table->decimal('ai_rating', 5, 2)
                  ->default(0)
                  ->after('updated_at');

            $table->enum('ai_level', [
                'Beginner',
                'Intermediate',
                'Advanced',
                'Expert'
            ])->nullable()->after('ai_rating');

            $table->timestamp('ai_interview_at')
                  ->nullable()
                  ->after('ai_level');

        });
    }

    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {

            $table->dropColumn([
                'ai_rating',
                'ai_level',
                'ai_interview_at'
            ]);

        });
    }
};
