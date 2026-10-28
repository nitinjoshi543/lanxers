<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_interview_logs', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('interview_id');

            $table->string('type',50);

            $table->text('remarks')->nullable();

            $table->ipAddress('ip')->nullable();

            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index('interview_id');
            $table->index('type');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_interview_logs');
    }
};
