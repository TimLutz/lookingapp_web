<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLooksexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('user_looksexes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->text('profile_name')->nullable(false);
            $table->text('description')->nullable(false);
            $table->text('my_physical_appearance')->nullable(false);
            $table->text('his_physical_appearance')->nullable(false);
            $table->text('my_sextual_preferences')->nullable(false);
            $table->text('his_sextual_preferences')->nullable(false);
            $table->text('my_social_habits')->nullable(false);
            $table->text('his_social_habits')->nullable(false);
            $table->dateTime('start_time')->nullable(false);
            $table->dateTime('end_time')->nullable(false);
            $table->string('duration',255)->nullable(false);
            $table->dateTime('notification_time')->nullable(false);
            $table->integer('is_notify')->comment('0=>default 1=> sent notification')->nullable(false)->default(0);
            $table->timestamps();
            $table->integer('is_active')->comment('0=>inactive 1=> deactive')->nullable(false);
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
