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
        Schema::table('job_attachments', function (Blueprint $table) {

            $table->dropColumn([
                'file_name',
                'original_name',
                'file_size',
            ]);

            $table->string('file_path')->after('project_job_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_attachments', function (Blueprint $table) {

            $table->string('file_name');
            $table->string('original_name');
            $table->bigInteger('file_size')->nullable();

            $table->dropColumn('file_path');

        });
    }
};
