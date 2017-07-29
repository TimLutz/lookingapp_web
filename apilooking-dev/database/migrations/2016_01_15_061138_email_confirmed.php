<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailConfirmed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('email_confirm', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->string('email',255);
            $collection->string('token',255)->nullable();
            $collection->boolean('status')->default('0');
            
            
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
        Schema::drop('email_confirm');
    }
}
