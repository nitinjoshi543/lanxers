<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('project_job_id')
                ->constrained('project_jobs')
                ->cascadeOnDelete();

            $table->foreignId('proposal_id')
                ->constrained('proposals')
                ->cascadeOnDelete();

            $table->foreignId('employer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('freelancer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamp('last_message_at')->nullable();

            $table->boolean('is_closed')->default(false);

            $table->timestamps();

            $table->unique('proposal_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};