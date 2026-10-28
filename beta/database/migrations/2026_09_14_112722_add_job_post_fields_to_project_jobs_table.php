<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_jobs', function (Blueprint $table) {

            // Job / Internship / Freelancer
            $table->enum('opportunity_type', [
                'job',
                'internship',
                'freelancer'
            ])
            ->default('job')
            ->after('employer_id');

            // Required experience: 0, 1 or 2 years
            $table->unsignedTinyInteger('experience')
                ->nullable()
                ->after('description');

            // Locations entered by employer
            // Example: Delhi,Noida,Pune
            $table->string('job_location', 500)
                ->nullable()
                ->after('location_type');
        });
    }

    public function down(): void
    {
        Schema::table('project_jobs', function (Blueprint $table) {

            $table->dropColumn([
                'opportunity_type',
                'experience',
                'job_location',
            ]);

        });
    }
};