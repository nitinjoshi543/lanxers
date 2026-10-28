<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_favourites', function (Blueprint $table) {

            // ---------- Columns ----------
            $table->id();
            $table->unsignedBigInteger('employer_id');     // kisne save kiya
            $table->unsignedBigInteger('freelancer_id');   // kisko save kiya
            $table->timestamps();

            // ---------- Rules ----------

            // ek employer ek freelancer ko sirf ek baar save kare
            $table->unique(['employer_id', 'freelancer_id']);

            // "is freelancer ko kitno ne save kiya" queries fast rahein
            $table->index('freelancer_id');

            $table->foreign('employer_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->foreign('freelancer_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_favourites');
    }
};
