<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable(false);
            $table->string('profile_name',120)->nullable(false);
            $table->string('location',255)->nullable(false);
            $table->text('identity')->nullable(false);
            $table->text('ethnicity')->nullable(false);
            $table->string('position',120)->nullable(false);
            $table->string('behaviour',120)->nullable(false);
            $table->string('latitude',20)->nullable(false);
            $table->string('longitude',20)->nullable(false);
            $table->string('travel_plans',60)->nullable(false);
            $table->string('orientation',60)->nullable(false);
            $table->string('safe_sex',60)->nullable(false);
            $table->string('HIV_status',60)->nullable(false);
            $table->string('cock_size',60);
            $table->string('cock_type',60)->nullable(false);
            $table->string('kinks_and_fetishes',60)->nullable(false);
            $table->dateTime('birthday')->nullable(false);
            $table->string('race',120)->nullable(false);
            $table->string('height',60)->nullable(false);
            $table->integer('height_cm')->comment('for filtering')->nullable(false);
            $table->string('weight',60)->nullable(false);
            $table->integer('Weight_kg')->comment('for filtering now change kg value to lbs value')->nullable(false);
            $table->string('hair_color',60)->nullable(false);
            $table->string('body_hair',60)->nullable(false);
            $table->string('facial_hair',60)->nullable(false);
            $table->string('eye_color',60)->nullable(false);
            $table->string('body_type',60)->nullable(false);
            $table->string('drugs',60)->nullable(false);
            $table->string('drinking',60)->nullable(false);
            $table->string('smoking',60)->nullable(false);
            $table->text('about_me')->nullable(false);
            $table->text('his_identitie')->nullable(false);
            $table->string('relationship_status',100)->nullable(false);
            $table->string('where_I_leave',255)->nullable(false);
            $table->string('facebook_link',100)->nullable(false);
            $table->string('twitter_link',100)->nullable(false);
            $table->string('linkedin_link',100)->nullable(false);
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
