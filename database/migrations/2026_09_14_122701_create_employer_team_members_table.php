<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employer_team_members', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->string('name', 255);
            $table->string('designation', 255)->nullable();
            $table->year('joining_year')->nullable();
            $table->string('employment_type', 100)->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employer_team_members');
    }
};