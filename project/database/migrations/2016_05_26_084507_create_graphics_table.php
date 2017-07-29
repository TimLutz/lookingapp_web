<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraphicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graphics', function (Blueprint $table) {
            $table->increments('id');
            $table->text('value')->nullable();
            $table->string('image_name',125)->nullable();
             $table->string('redirect_url',255)->nullable();
             $table->dateTime('start_time');
             $table->dateTime('endtime');
             $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('graphics');
    }
}
