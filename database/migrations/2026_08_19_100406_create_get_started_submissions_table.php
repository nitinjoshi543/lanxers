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
        Schema::create('get_started_submissions', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('user_id')->nullable();
        
            $table->string('name', 30);
            $table->string('email', 255);
            $table->string('phone', 20);
            $table->string('role', 100);
        
            $table->string('resume')->nullable();
        
            $table->timestamps();
        
            $table->index('user_id');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_started_submissions');
    }
};
