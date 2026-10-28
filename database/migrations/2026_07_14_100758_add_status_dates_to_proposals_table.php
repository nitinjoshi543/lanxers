<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {

            $table->timestamp('accepted_at')
                ->nullable()
                ->after('status');

            $table->timestamp('rejected_at')
                ->nullable()
                ->after('accepted_at');

            $table->timestamp('withdrawn_at')
                ->nullable()
                ->after('rejected_at');

            $table->enum('status', [
                'pending',
                'shortlisted',
                'accepted',
                'rejected',
                'withdrawn',
                'completed',
                'cancelled'
            ])->default('pending')->change();

        });
    }

    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {

            $table->dropColumn([
                'accepted_at',
                'rejected_at',
                'withdrawn_at'
            ]);

            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'withdrawn'
            ])->default('pending')->change();

        });
    }
};