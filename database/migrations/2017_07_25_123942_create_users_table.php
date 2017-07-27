<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('screen_name',255)->nullable(false);
            $table->string('token',120)->nullable();
            $table->string('email',120)->nullable(false);
            $table->string('password',255)->nullable(false);
            $table->string('original_password',255)->nullable(false);
            $table->string('country',60)->nullable();
            $table->string('city',60)->nullable();
            $table->integer('status')->default(0)->comment('0=>inactive 1=>active')->nullable(false);
            $table->integer('profile_status')->comment('0=>default 1=>public 2=>private')->nullable(false);
            $table->integer('online_status')->comment('0=>default 1=>online 2=>offline')->nullable(false);
            $table->string('lat',100)->comment('for search nearest members')->nullable(false);
            $table->string('long',100)->comment('for search nearest members')->nullable(false);
            $table->string('profile_pic',255)->nullable();
            $table->integer('profile_pic_type')->default(0)->comment('0=>default 1=> face pic 2=> verified photo')->nullable(false);
            $table->dateTime('profile_pic_date',255)->comment('0=>default 1=> face pic 2=> verified photo')->nullable(false);
            $table->integer('is_completed')->default(0)->comment('0=>default 1=> face pic 2=> verified photo');
            $table->string('device_token',255)->nullable(false);
            $table->string('device_type',10)->nullable(false);
            $table->integer('registration_status')->comment('0=> default 1=>register 2=>basic profile 3=>photo upload')->nullable(false);
            $table->integer('accuracy')->default(0)->comment('geo location accuricy send from ios and android')->nullable(false);
            $table->integer('member_type')->comment('0=>free 1=>paid')->nullable(false);
            $table->dateTime('valid_upto')->nullable(false);
            $table->integer('is_trial')->comment('0=>default(No) 1=>yes')->nullable(false);
            $table->integer('removead')->comment('0=>no 1=>yes')->nullable(false);
            $table->dateTime('removead_valid_upto')->nullable(false);
            $table->integer('profiletext_change')->default(0)->comment('0=approve/1=change')->nullable(false);
            $table->dateTime('profile_text_change_date')->nullable(false)->change();
            $table->integer('photo_change')->default(0)->comment('0=approve/1=change')->nullable(false);
            $table->integer('role')->comment('1=Admin 2=User')->nullable(false);
            $table->rememberToken();
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
