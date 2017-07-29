<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function(Blueprint $collection)
        {
            $collection->increments('id');
            $collection->string('transaction_id')->nullable();
            
            $collection->string('account_type')->nullable();
            $collection->string('transaction_type',255);
            $collection->double('amount');
            $collection->string('primary_currency',255);
            $collection->dateTime('transaction_date_and_time');
            $collection->string('payment_method')->nullable();
            $collection->string('order_id')->nullable();
            $collection->longText('comments')->nullable();
            $collection->integer('invoice_number')->nullable();
            
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction');
    }
}
