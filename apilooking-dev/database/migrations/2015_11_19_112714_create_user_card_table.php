<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_card', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->string('card_type',32)->nullable();
            $collection->integer('user_id');
            $collection->integer('card_last_four_digits');
            $collection->integer('card_expiration_date_month');
            $collection->integer('card_expiration_date_year');
            $collection->boolean('card_active')->nullable();
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
        Schema::drop('user_card');
    }
}
