<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->decimal('advance_percent', 5, 2)->default(10.00)->after('agreed_amount');
            $table->decimal('advance_amount', 12, 2)->default(0)->after('advance_percent');
            $table->timestamp('advance_paid_at')->nullable()->after('advance_amount');

            $table->decimal('remaining_amount', 12, 2)->default(0)->after('advance_paid_at');
            $table->timestamp('remaining_paid_at')->nullable()->after('remaining_amount');

            $table->timestamp('released_at')->nullable()->after('remaining_paid_at');
            $table->string('payment_status')->default('advance_paid')->after('released_at');

            $table->index('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropIndex(['payment_status']);

            $table->dropColumn([
                'advance_percent',
                'advance_amount',
                'advance_paid_at',
                'remaining_amount',
                'remaining_paid_at',
                'released_at',
                'payment_status',
            ]);
        });
    }
};
