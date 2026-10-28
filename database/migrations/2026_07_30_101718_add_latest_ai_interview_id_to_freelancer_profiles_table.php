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
        Schema::table('freelancer_profiles', function (Blueprint $table) {

            $table->unsignedBigInteger('latest_ai_interview_id')
                ->nullable()
                ->after('ai_interview_at');

            $table->foreign('latest_ai_interview_id')
                ->references('id')
                ->on('ai_interviews')
                ->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {

            $table->dropForeign(['latest_ai_interview_id']);

            $table->dropColumn('latest_ai_interview_id');

        });
    }
};