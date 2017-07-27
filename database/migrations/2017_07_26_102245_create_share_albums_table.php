<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('share_albums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id')->nullable(false)->comment('who send album');
            $table->integer('receiver_id')->nullable(false)->comment('who receive album');
            $table->integer('is_received')->nullable(false)->comment('0=>default 1=>share 2=>unshare');
            $table->integer('is_view')->nullable(false)->comment('0=>yes 1=>no');
            $table->string('album',255)->nullable(false);
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
