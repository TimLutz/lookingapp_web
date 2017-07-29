<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_image', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->integer('user_id');
            $collection->string('image',100)->nullable();
            $collection->string('thumbnail_image',100)->nullable();
            
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_image');
    }
}
