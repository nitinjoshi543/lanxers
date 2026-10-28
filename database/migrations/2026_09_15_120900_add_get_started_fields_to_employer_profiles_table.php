<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employer_profiles', function (Blueprint $table) {

            // Step 2
            $table->boolean('is_freelancer')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('employer_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'is_freelancer',
            ]);
        });
    }
};