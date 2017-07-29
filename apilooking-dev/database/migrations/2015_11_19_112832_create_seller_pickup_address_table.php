<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerPickupAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_pickup_address', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->integer('seller_user_id');
            $collection->string('address_label',32)->nullable();
            $collection->string('pick_up_or_delivery',32)->nullable();
            $collection->string('pickup_address_line_1',100)->nullable();
            $collection->string('pickup_address_line_2',100)->nullable();
            $collection->integer('pickup_address_postcode')->nullable();
            $collection->string('pickup_address_city',50);
            $collection->string('pickup_address_state', 50);
            $collection->string('pickup_address_country',100);
            $collection->string('pickup_address_comments',255)->nullable();
            $collection->double('latitude')->nullable();
            $collection->double('longitude')->nullable();
            $collection->string('time_zone',32)->nullable();
            $collection->double('deleivery_radius_in_km')->nullable();
            $collection->string('phone_number',25)->nullable();
            $collection->boolean('address_active')->nullable();
            
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
        Schema::drop('seller_pickup_address');
    }
}
