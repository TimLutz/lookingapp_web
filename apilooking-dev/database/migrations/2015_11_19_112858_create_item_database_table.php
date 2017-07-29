<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemDatabaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->integer('seller_user_id');
            $collection->string('title',50)->nullable();
            $collection->longText('description')->nullable();
            $collection->double('rating')->nullable();
            $collection->boolean('item_active')->nullable();
            $collection->double('price_in_primary_currency')->nullable();
            $collection->string('primary_currency',32)->nullable();
            $collection->string('type')->nullable();
            $collection->longText('restriction')->nullable();
            
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
        Schema::drop('item');
    }
}
