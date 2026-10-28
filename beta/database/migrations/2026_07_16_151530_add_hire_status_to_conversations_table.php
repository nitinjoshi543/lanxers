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
        Schema::table('conversations', function (Blueprint $table) {
            $table->enum('hire_status', [
                'none',
                'requested',
                'accepted',
                'rejected'
            ])->default('none')->after('updated_at');

            $table->timestamp('hire_requested_at')->nullable()->after('hire_status');

            $table->timestamp('hire_accepted_at')->nullable()->after('hire_requested_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropColumn([
                'hire_status',
                'hire_requested_at',
                'hire_accepted_at',
            ]);
        });

    }
};
