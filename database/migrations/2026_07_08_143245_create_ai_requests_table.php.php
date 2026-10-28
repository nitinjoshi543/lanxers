<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_requests', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('conversation_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('message_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('feature',[
                'rewrite',
                'translate',
                'summarize',
                'proposal',
                'grammar',
                'formal',
                'friendly'
            ]);

            $table->longText('input_text');

            $table->longText('output_text');

            $table->string('model')->nullable();

            $table->integer('tokens_used')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_requests');
    }
};