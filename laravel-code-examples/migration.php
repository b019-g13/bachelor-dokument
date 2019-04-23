<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            // Makes a CHAR 36 column, primary key
            $table->uuid('id')->primary();
            // Makes a VARCHAR column (defaults to 255 in length)
            $table->string('name');
            // Makes a VARCHAR column, must be unique
            $table->string('slug')->unqiue();
            // Makes a TEXT column, can be null, defaults to null
            $table->text('description')->nullable()->default(null);
            // Makes an unsigned INTEGER column
            $table->integer('type_id')->unsigned();
            // Sets a foreign key
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

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
        Schema::dropIfExists('components');
    }
}
