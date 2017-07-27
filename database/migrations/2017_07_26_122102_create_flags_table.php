<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('flags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id')->nullable(false);
            $table->integer('receiver_id')->nullable(false);
            $table->integer('flag')->nullable(false);
            $table->integer('archive')->comment('o=>default 1=>archive')->nullable(false);
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
        //
    }
}
