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
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female', 'other'])
                ->nullable()
                ->after('user_id');

            $table->unsignedTinyInteger('experience_years')
                ->default(0)
                ->after('experience');

            $table->unsignedTinyInteger('experience_months')
                ->default(0)
                ->after('experience_years');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'experience_years',
                'experience_months',
            ]);
        });
    }
};
