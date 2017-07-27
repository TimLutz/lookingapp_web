<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileLocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('profile_locks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->integer('lock_user_id')->nullable(false);
            $table->integer('is_locked')->comment('0=>default 1=> lock 2=> unlock')->nullable(false);
            $table->integer('count')->comment('0=>default 1=>lock(unread message count))')->nullable(false);
            $table->string('browse',255)->nullable(false);
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
