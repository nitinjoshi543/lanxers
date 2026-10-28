<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_jobs', function (Blueprint $table) {

            $table->unsignedBigInteger('assigned_freelancer_id')
                ->nullable()
                ->after('employer_id');

            $table->foreign('assigned_freelancer_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('project_jobs', function (Blueprint $table) {

            $table->dropForeign(['assigned_freelancer_id']);
            $table->dropColumn('assigned_freelancer_id');

        });
    }
};