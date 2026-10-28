<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('project_job_id')->constrained()->cascadeOnDelete();

            $table->foreignId('proposal_id')->constrained()->cascadeOnDelete();

            $table->foreignId('conversation_id')->constrained()->cascadeOnDelete();

            $table->foreignId('employer_id')->constrained('users')->cascadeOnDelete();

            $table->foreignId('freelancer_id')->constrained('users')->cascadeOnDelete();

            $table->decimal('agreed_amount', 12, 2);

            $table->integer('delivery_days');

            $table->enum('status', [
                'active',
                'completed',
                'cancelled',
                'disputed'
            ])->default('active');

            $table->timestamp('started_at')->nullable();

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};