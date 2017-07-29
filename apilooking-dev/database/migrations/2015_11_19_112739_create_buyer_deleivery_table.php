<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerDeleiveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_delivery', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->integer('buyer_id');
            $collection->string('address_label',32)->nullable();
            $collection->string('delivery_address_line_1',100)->nullable();
            $collection->string('delivery_address_line_2',100)->nullable();
            $collection->integer('delivery_address_postcode')->nullable();
            $collection->string('delivery_address_city',100)->nullable();
            $collection->string('delivery_address_state',100)->nullable();
            $collection->string('delivery_address_country',100)->nullable();
            $collection->string('delivery_address_comments',100)->nullable();
            $collection->double('latitude')->nullable();
            $collection->double('longitude')->nullable();
            
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
        Schema::drop('buyer_deleivery');
    }
}
