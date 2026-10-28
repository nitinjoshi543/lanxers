<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {

            $table->id();

            $table->foreignId('project_job_id')
                ->constrained('project_jobs')
                ->cascadeOnDelete();

            $table->foreignId('freelancer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->longText('cover_letter');

            $table->decimal('bid_amount',12,2);

            $table->integer('delivery_days');

            $table->enum('status',[
                'pending',
                'accepted',
                'rejected',
                'withdrawn'
            ])->default('pending');

            $table->timestamps();

            $table->unique([
                'project_job_id',
                'freelancer_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};