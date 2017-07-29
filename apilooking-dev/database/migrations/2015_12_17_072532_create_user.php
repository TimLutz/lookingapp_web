<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->string('first_name',32)->nullable();
            $collection->string('email',255)->unique();
            $collection->string('last_name',32)->nullable();
            $collection->string('user_home_country',100)->nullable();
            $collection->string('phone_number_country_code')->nullable();
            $collection->string('phone_number_without_country_code')->nullable();
            $collection->string('password', 255);
            $collection->boolean('user_phone_confirmed')->nullable();
            $collection->boolean('user_email_confirmed')->nullable();
            $collection->boolean('active_as_user')->nullable();
            $collection->boolean('active_as_buyer')->nullable();
            $collection->float('rating_as_buyer')->nullable();
            $collection->integer('buyer_demerit_points')->nullable();
            $collection->dateTime('buyer_blocked_until')->nullable();
            $collection->integer('pending_review_order_id')->nullable();
            $collection->integer('personal_referral_code')->nullable();
            $collection->integer('referral_code_used_at_registration')->nullable();
            $collection->date('dob');
            $collection->integer('referred_by_user_id')->nullable(); //user_id_of_parent_seller
            
            $collection->integer('number_of_referral_codes_left')->nullable();
            $collection->boolean('seller_approved')->nullable();
            $collection->boolean('active_as_seller')->nullable();
            $collection->dateTime('seller_blocked_until')->nullable();
            $collection->boolean('active_as_messenger')->nullable();
            $collection->boolean('multi_seller_deliveries')->nullable();
            $collection->integer('user_id_of_parent_seller')->nullable();
            
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
        Schema::drop('users');
    }
}
