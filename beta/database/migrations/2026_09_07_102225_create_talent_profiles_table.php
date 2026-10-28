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
        Schema::create('talent_profiles', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->enum('looking_for', [
                'job',
                'internship',
                'freelancer'
            ]);

            $table->string('city', 100);

            $table->enum('current_profile', [
                'student_fresher',
                'freelancer',
                'working_professional',
                'not_working'
            ]);

            $table->json('skills');

            $table->string('preferred_roles', 255);

            // AWS CV path / URL
            $table->string('cv')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_profiles');
    }
};
