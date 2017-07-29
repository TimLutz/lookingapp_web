<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionFeeFactorRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('transaction_fee_factor', function(Blueprint $collection)
        {
            
            $collection->string('primary_currency');
            $collection->string('payment_method');
            $collection->double('min_net_value');
            
            $collection->double('max_net_value',50);
            $collection->double('transaction_fee_in_primary_currency');
            
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
        Schema::drop('transaction_fee_factor');
    }
}
