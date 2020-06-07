<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->refernces('id')->on('users');
            $table->string('title');
            $table->longText('description');
            $table->foreignId('category_id')->refernces('id')->on('categories');
            $table->string('location');
            $table->string('time');
            $table->double('reward');
            $table->integer('phone');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posters');
    }
}
