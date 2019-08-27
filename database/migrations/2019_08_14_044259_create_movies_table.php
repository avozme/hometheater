<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('title',500);
            $table->integer('year')->nullable();
            $table->integer('duration')->nullable();
            $table->date('dateAdded')->nullable();
            $table->date('datePlayed')->nullable();
            $table->integer('rating')->nullable();
            $table->string('cover', 500)->nullable();
            $table->string('fileDirName', 1000)->nullable();
            $table->string('fileName', 500)->nullable();
            $table->string('link', 1000)->nullable();
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
        Schema::dropIfExists('movies');
    }
}
