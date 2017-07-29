<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('url')->nullable();
            $table->boolean('type');
            $table->integer('cat_id');
            $table->integer('sub_cat_id');
            $table->integer('size');
            $table->string('name',255)->nullable();
            $table->string('image',255)->nullable();
            $table->text('description');
            $table->integer('color_picker');
            $table->boolean('featured')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::drop('products');
    }
}
