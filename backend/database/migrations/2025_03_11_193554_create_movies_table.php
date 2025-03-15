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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('year'); 
            $table->string('rated');
            $table->string('released'); 
            $table->string('runtime');
            $table->string('genre'); 
            $table->string('director'); 
            $table->text('writer'); 
            $table->text('actors'); 
            $table->text('plot'); 
            $table->string('language');
            $table->string('country'); 
            $table->string('awards'); 
            $table->string('poster')->nullable(); 
            $table->string('type'); 
            $table->text('images')->nullable(); // JSON or serialized images, multiple images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
