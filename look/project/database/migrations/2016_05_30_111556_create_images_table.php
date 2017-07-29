<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
             $table->string('image_name',255)->nullable();
             $table->enum('type', array('0', '1'));
             $table->integer('sort_num');
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
        Schema::drop('images');
    }
}
