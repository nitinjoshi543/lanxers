<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('conversations', function (Blueprint $table) {

            $table->enum('status', [
                'active',
                'closed',
                'archived'
            ])->default('active')->after('last_message_at');

        });

        DB::table('conversations')
            ->where('is_closed', 0)
            ->update(['status' => 'active']);

        DB::table('conversations')
            ->where('is_closed', 1)
            ->update(['status' => 'closed']);

        Schema::table('conversations', function (Blueprint $table) {

            $table->dropColumn('is_closed');

        });
    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {

            $table->boolean('is_closed')
                ->default(false)
                ->after('last_message_at');

        });

        DB::table('conversations')
            ->where('status', 'active')
            ->update(['is_closed' => 0]);

        DB::table('conversations')
            ->where('status', 'closed')
            ->update(['is_closed' => 1]);

        DB::table('conversations')
            ->where('status', 'archived')
            ->update(['is_closed' => 1]);

        Schema::table('conversations', function (Blueprint $table) {

            $table->dropColumn('status');

        });
    }
};