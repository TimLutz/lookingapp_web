<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('chat_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->integer('chat_user_id')->nullable(false);
            $table->integer('count')->comment('unread message count')->nullable(false);
            $table->integer('invite')->comment('unread message count')->nullable(false);
            $table->integer('check_invitaion_sent')->comment('0=>default 1=>already sent invitation')->nullable(false);
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
