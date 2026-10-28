<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_favourites', function (Blueprint $table) {

            // ---------- Columns ----------
            $table->id();                                   // row ka apna id
            $table->unsignedBigInteger('user_id');          // kisne save kiya
            $table->unsignedBigInteger('project_job_id');   // kaunsi job save ki
            $table->timestamps();                           // created_at + updated_at

            // ---------- Rules ----------

            // ek user ek job ko sirf ek baar save kare
            $table->unique(['user_id', 'project_job_id']);

            // "is job ko kitno ne save kiya" queries fast rahein
            $table->index('project_job_id');

            // user delete → uske saare favourites bhi delete
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            // job delete → uske saare favourites bhi delete
            $table->foreign('project_job_id')
                ->references('id')->on('project_jobs')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_favourites');
    }
};
