<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mal_id')->unique()->nullable(); 
            $table->string('slug')->unique()->nullable(); 
            $table->string('title')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('image_url')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('animes');
    }
}