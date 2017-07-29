<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemImageDatabaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_image', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->integer('item_id');
            $collection->string('image',255)->nullable();
            $collection->string('thumbnail_image',255)->nullable();
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
        Schema::drop('item_image');
    }
}
