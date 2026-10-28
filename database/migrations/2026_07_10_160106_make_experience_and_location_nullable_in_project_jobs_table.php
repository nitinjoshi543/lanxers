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
        Schema::table('project_jobs', function (Blueprint $table) {
            $table->enum('experience_level', ['entry', 'intermediate', 'expert'])
                  ->nullable()
                  ->change();
    
            $table->enum('location_type', ['remote', 'onsite', 'hybrid'])
                  ->nullable()
                  ->default(null)
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_jobs', function (Blueprint $table) {
            //
        });
    }
};
