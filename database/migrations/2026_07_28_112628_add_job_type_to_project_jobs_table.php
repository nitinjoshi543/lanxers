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
        Schema::table('project_jobs', function (Blueprint $table) {
            $table->enum('job_type', [
                'freelance',
                'full_time',
                'part_time',
                'internship',
                'contract'
            ])->default('freelance')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_jobs', function (Blueprint $table) {
            $table->dropColumn('job_type');
        });
    }
};
