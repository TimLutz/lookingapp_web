<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('viewers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->integer('viewer_user_id')->nullable(false);
            $table->integer('is_view')->comment('0=>yes 1=>no')->nullable(false);
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
