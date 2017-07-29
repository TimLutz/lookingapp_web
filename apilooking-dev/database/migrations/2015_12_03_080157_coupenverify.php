<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coupenverify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_verify', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->string('parent_user_country');
            $collection->integer('coupen_value');
            $collection->string('coupon_currency',100);
            $collection->string('coupon_country', 255);
            $collection->string('country_code', 255);
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
        //
    }
}
