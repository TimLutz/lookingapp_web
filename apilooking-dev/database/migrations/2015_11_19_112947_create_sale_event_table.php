<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_event', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->boolean('status')->nullable();
            $collection->integer('seller_user_id');
            $collection->double('seller_rating')->nullable();
            $collection->integer('item_id');
            $collection->string('title',255);
            $collection->longText('description')->nullable();
            $collection->string('primary_currency',255);
            $collection->string('price_in_primary_currency',255)->nullable();
            $collection->string('image',255)->nullable();
            $collection->string('image_thumbnail',255)->nullable();
            $collection->string('type',255)->nullable();
            $collection->longText('restriction')->nullable();
            $collection->integer('quantity_available');
            $collection->integer('quantity_ordered')->default(0);
            $collection->integer('quantity_delivered')->default(0);
            $collection->double('sale_event_latitude');
            $collection->double('sale_event_longitude');
            $collection->string('pick_up_or_delivery');
            $collection->double('delivery_radius_in_km');
            $collection->integer('seller_address_id');
            $collection->dateTime('pickup_date_delivery_and_time_from');
            $collection->dateTime('pickup_delivery_date_and_time_to');
            $collection->boolean('repeat_every_monday')->nullable();
            $collection->boolean('repeat_every_tuesday')->nullable();
            $collection->boolean('repeat_every_wednesday')->nullable();
            $collection->boolean('repeat_every_thursday')->nullable();
            $collection->boolean('repeat_every_friday')->nullable();
            $collection->boolean('repeat_every_saturday')->nullable();
            $collection->boolean('repeat_every_sunday')->nullable();
            
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
        Schema::drop('sale_event');
    }
}
