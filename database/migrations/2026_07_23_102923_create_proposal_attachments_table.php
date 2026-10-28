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
        Schema::create('proposal_attachments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proposal_id')
                ->constrained('proposals')
                ->cascadeOnDelete();

            $table->string('file_name')->nullable();      // Original file name
            $table->string('file_path');                  // Storage path
            $table->string('file_type')->nullable();      // pdf, docx, jpg...
            $table->unsignedBigInteger('file_size')->nullable(); // bytes

            $table->timestamps();

            $table->index('proposal_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_attachments');
    }
};
