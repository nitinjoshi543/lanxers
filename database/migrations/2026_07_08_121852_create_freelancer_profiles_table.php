<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->longText('bio')->nullable();

            $table->decimal('hourly_rate',10,2)->default(0);

            $table->unsignedTinyInteger('experience')->default(0);

            $table->string('country',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();

            $table->string('profile_image')->nullable();
            $table->string('resume')->nullable();

            $table->boolean('available_for_work')->default(true);

            $table->string('website')->nullable();

            $table->string('linkedin')->nullable();

            $table->string('github')->nullable();

            $table->string('portfolio')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_profiles');
    }
};