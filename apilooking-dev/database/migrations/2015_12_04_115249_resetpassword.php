<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Resetpassword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('password_reset', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->string('email',255);
            $collection->string('token_reset',255)->nullable();
            $collection->boolean('status')->default('1');
            
            
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
         Schema::drop('password_reset');
    }
}
