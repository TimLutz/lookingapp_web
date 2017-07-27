<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLookdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_lookdates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->string('profile_name',100)->nullable(false);
            $table->text('my_traits')->nullable(false);
            $table->text('his_traits')->nullable(false);
            $table->text('my_interest')->nullable(false);
            $table->text('my_physical_appearance')->nullable(false);
            $table->text('his_physical_appearance')->nullable(false);
            $table->text('my_sextual_preferences')->nullable(false);
            $table->text('his_sextual_preferences')->nullable(false);
            $table->text('my_social_habits')->nullable(false);
            $table->text('his_social_habits')->nullable(false);
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
