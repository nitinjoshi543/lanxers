<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employer_hiring_preferences', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->json('preferred_roles')->nullable();
            $table->json('work_modes')->nullable();
            $table->json('preferred_locations')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employer_hiring_preferences');
    }
};