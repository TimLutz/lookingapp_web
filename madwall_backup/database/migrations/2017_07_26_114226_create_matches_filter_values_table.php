<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesFilterValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('matches_filter_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->string('enable_filters',100)->nullable(false);
            $table->string('online',100)->nullable(false);
            $table->string('match',100)->nullable(false);
            $table->string('user_photos',100)->nullable(false);
            $table->text('his_identities')->nullable(false);
            $table->text('his_seeking')->nullable(false);
            $table->text('ethnicity')->nullable(false);
            $table->text('relationship_status')->nullable(false);
            $table->string('age',100)->nullable(false);
            $table->string('height',100)->nullable(false);
            $table->string('weight',100)->nullable(false);
            $table->string('type',50)->comment('browse,dating,looking')->nullable(false);
            $table->string('list_array',200)->nullable(false);
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
