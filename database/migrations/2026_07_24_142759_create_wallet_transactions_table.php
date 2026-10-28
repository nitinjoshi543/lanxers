<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->enum('type', [
                'deposit',      // employer ne wallet me paisa add kiya
                'escrow_out',   // employer ke available se nikla (hold/payment)
                'escrow_in',    // freelancer ke on_hold me aaya (locked)
                'release',      // freelancer ke available me unlock hua
                'withdrawal',   // freelancer ne bank me nikaala
                'refund',       // wapas employer ko
            ]);

            $table->decimal('amount', 12, 2);
            $table->decimal('balance_after', 12, 2);

            $table->unsignedBigInteger('contract_id')->nullable();
            $table->string('reference')->nullable();   // gateway txn id
            $table->string('note')->nullable();

            $table->timestamp('created_at')->nullable();

            $table->index(['user_id', 'created_at']);
            $table->index('contract_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
