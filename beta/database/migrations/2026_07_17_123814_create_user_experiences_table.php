<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_experiences', function (Blueprint $table) {

            // ---------- Columns ----------
            $table->id();
            $table->unsignedBigInteger('user_id');            // kiska experience
            $table->string('position');                       // Front end Developer
            $table->string('employment_type', 30);            // Full time / Freelance
            $table->date('start_date');
            $table->date('end_date')->nullable();             // NULL = abhi kaam kar raha hai
            $table->text('description')->nullable();
            $table->timestamps();

            // ---------- Rules ----------

            // "is user ka experience dikhao" — har profile view pe chalegi
            $table->index('user_id');

            // user delete → uske saare experiences bhi delete
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_experiences');
    }
};
