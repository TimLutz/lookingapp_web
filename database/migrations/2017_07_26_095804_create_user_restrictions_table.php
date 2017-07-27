<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_restrictions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_type')->comment('0=>free 1=>paid')->nullable(false);
            $table->string('limit_type',100)->comment('limit which portion matches,favaorite,message')->nullable(false);
            $table->integer('limit')->nullable(false);
            $table->string('name',255)->nullable(false);
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
