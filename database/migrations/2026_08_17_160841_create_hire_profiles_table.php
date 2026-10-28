<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hire_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('looking_for', ['job', 'internship', 'freelancer']);
            $table->string('qualification', 150);
            $table->json('skills');
            $table->timestamps();
    
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
    
            $table->unique('user_id');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('hire_profiles');
    }
};
