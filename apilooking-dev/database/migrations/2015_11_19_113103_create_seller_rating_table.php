<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_rating', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->integer('buyer_user_id');
            $collection->integer('seller_user_id');
            $collection->string('rater_first_name',32)->nullable();
            $collection->date('rating_date');
            $collection->string('order_id',255);
            $collection->string('item_id', 255);
            $collection->double('rating')->nullable();
            $collection->longText('issue_type')->nullable();
            $collection->longText('comments')->nullable();
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
        Schema::drop('seller_rating');
    }
}
