<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_partners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->string('sexual_role',60)->nullable(false);
            $table->string('orientation',60)->nullable(false);
            $table->string('safe_sex',60)->nullable(false);
            $table->string('HIV_status',60)->nullable(false);
            $table->string('cock_size',60)->nullable(false);
            $table->string('cock_type',60)->nullable(false);
            $table->string('kinks_and_fetishes',60)->nullable(false);
            $table->string('age_range',60)->nullable(false);
            $table->string('race',60)->nullable(false);
            $table->string('height',60)->nullable(false);
            $table->string('weight',60)->nullable(false);
            $table->string('hair_color',60)->nullable(false);
            $table->string('body_hair',60)->nullable(false);
            $table->string('facial_hair',60)->nullable(false);
            $table->string('eye_color',60)->nullable(false);
            $table->string('body_type',60)->nullable(false);
            $table->string('drugs',60)->nullable(false);
            $table->string('drinking',60)->nullable(false);
            $table->string('smoking',60)->nullable(false);
            $table->string('ethinicity',60)->nullable(false);
            $table->string('identities',60)->nullable(false);
            $table->string('position',60)->nullable(false);
            $table->string('behaviour',60)->nullable(false);
            $table->string('location',60)->nullable(false);
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
