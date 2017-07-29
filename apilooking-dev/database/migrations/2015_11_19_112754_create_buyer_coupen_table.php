<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerCoupenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_coupon', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->integer('user_id')->nullable();
            $collection->string('coupon_name')->nullable();
            $collection->dateTime('coupon_expiry_date')->nullable();
            $collection->integer('coupen_value');
            $collection->string('coupon_currency',100)->nullable();
            $collection->string('coupon_country', 100)->nullable();
            $collection->string('coupon_status',50)->nullable();
            $collection->boolean('funded_by_seller')->nullable();
            $collection->dateTime('last_status_change')->nullable();
            $collection->integer('order_id');
            
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
        Schema::drop('buyer_coupen');
    }
}
