<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_interviews', function (Blueprint $table) {

            $table->string('session_token', 100)->nullable()->after('status');

            $table->boolean('js_initialized')->default(false);

            $table->unsignedTinyInteger('tab_switch_count')->default(0);

            $table->unsignedTinyInteger('fullscreen_exit_count')->default(0);

            $table->timestamp('last_activity')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('ai_interviews', function (Blueprint $table) {

            $table->dropColumn([
                'session_token',
                'js_initialized',
                'tab_switch_count',
                'fullscreen_exit_count',
                'last_activity'
            ]);

        });
    }
};
