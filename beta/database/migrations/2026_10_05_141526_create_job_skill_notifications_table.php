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
        Schema::create('job_skill_notifications', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('project_job_id');
            $table->unsignedBigInteger('user_id');
        
            $table->timestamp('sent_at')->nullable();
        
            $table->timestamps();
        
            $table->unique(
                ['project_job_id', 'user_id'],
                'job_user_unique'
            );
        
            $table->index('project_job_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_skill_notifications');
    }
};
