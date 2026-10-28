<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();                                    // id (bigint, auto-increment PK)
            $table->string('name');                          // name
            $table->string('position')->nullable();          // position / designation
            $table->string('image')->nullable();             // image path
            $table->text('description');                     // testimonial text
            $table->tinyInteger('status')->default(1);       // 1 = active, 0 = inactive
            $table->timestamp('created_on')->nullable();     // created_on
            $table->timestamp('updated_on')->nullable();     // updated_on
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};