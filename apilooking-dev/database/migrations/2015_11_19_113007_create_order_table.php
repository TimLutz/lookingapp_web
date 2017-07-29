<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->integer('sale_random_reference_number');
            $collection->integer('buyer_id');
            $collection->string('buyer_first_name',32)->nullable();
            $collection->string('buyer_last_name',32)->nullable();
            $collection->integer('seller_user_id');
            $collection->string('seller_designation_as_shown_to_buyers', 255);
            $collection->string('buyer_phone_number_country_code',50)->nullable();
            $collection->string('buyer_phone_number',32)->nullable();
            $collection->integer('sale_event_id');
            $collection->integer('item_id');
            $collection->string('item_title',32);
            $collection->longText('item_description')->nullable();
            $collection->integer('quantity');
            $collection->double('total_price');
            $collection->string('order_currency',32);
            $collection->double('coupon_value')->nullable();
            $collection->integer('coupon_id')->nullable();
            $collection->double('net_price');
            $collection->string('payment_method');
            $collection->date('card_expiry_date')->nullable();
            $collection->string('payment_reference')->nullable();
            $collection->string('order_status');
            $collection->dateTime('pickup_date_delivery_and_time_from');
            $collection->dateTime('pickup_date_delivery_and_time_to');
            $collection->string('pickup_or_delivery');
            $collection->string('pickup_delivery_address_line_1',100);
            $collection->string('pickup_delivery_address_line_2',100);
            $collection->integer('pickup_delivery_address_postcode');
            $collection->string('pickup_delivery_address_city',100);
            $collection->string('pickup_delivery_address_state',50);
            $collection->string('pickup_delivery_address_country',50);
            $collection->longText('pickup_delivery_address_comments')->nullable();
            $collection->double('pickup_delivery_address_lattitude');
            $collection->double('pickup_delivery_address_longitude');
            $collection->dateTime('order_confirm_date_and_time')->nullable();
            $collection->dateTime('order_cancel_date_and_time')->nullable();
            $collection->dateTime('order_complete_date_and_time')->nullable();
            $collection->longText('order_cancel_reason')->nullable();
            $collection->longText('order_canceled_comments',500)->nullable();
            $collection->double('transaction_fee_in_primary_currency')->nullable();
            $collection->integer('bussiness_address_id');
            $collection->integer('deleivery_address_id');
            
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
       Schema::drop('orders');
    }
}
