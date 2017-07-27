<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_albums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->string('photo_name',255)->nullable();
            $table->integer('file_type')->nullable(false)->comment('0=>image 1=>vedio')->default(0);
            $table->string('caption',100)->nullable(false);
            $table->integer('album_type')->nullable(false)->comment('4=>default 1=>verify')->default(4);
            $table->timestamps();
            $table->integer('status')->nullable(false);
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
