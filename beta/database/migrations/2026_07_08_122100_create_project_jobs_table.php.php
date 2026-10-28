<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_jobs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('employer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('title');

            $table->string('slug')->unique();

            $table->longText('description');

            $table->enum('budget_type', [
                'fixed',
                'hourly'
            ]);

            $table->decimal('budget_min',12,2)->nullable();

            $table->decimal('budget_max',12,2)->nullable();

            $table->enum('experience_level',[
                'entry',
                'intermediate',
                'expert'
            ]);

            $table->enum('duration',[
                'less_than_1_month',
                '1_to_3_months',
                '3_to_6_months',
                '6_plus_months'
            ]);

            $table->enum('location_type',[
                'remote',
                'onsite',
                'hybrid'
            ])->default('remote');

            $table->unsignedInteger('total_proposals')->default(0);

            $table->unsignedInteger('views')->default(0);

            $table->enum('status',[
                'draft',
                'open',
                'assigned',
                'completed',
                'closed',
                'cancelled'
            ])->default('draft');

            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_jobs');
    }
};