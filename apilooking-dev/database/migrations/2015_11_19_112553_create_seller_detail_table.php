<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller', function(Blueprint $collection)
        {
            
            $collection->integer('Seller_id');
            $collection->string('company_registered_name',100)->nullable();
            $collection->string('seller_company_registration_number',50);
            
            $collection->string('seller_designation_as_shown_to_buyers',50);
            $collection->string('seller_type',100);
            $collection->float('rating_as_seller')->nullable();
            $collection->string('seller_business_address_line_1',255);
            $collection->string('seller_business_address_line_2',255);
            $collection->integer('seller_business_address_postcode')->nullable();
            $collection->string('seller_business_address_city',100)->nullable();
            $collection->string('seller_business_address_state',30)->nullable();
            $collection->string('seller_business_address_country',50)->nullable();
            $collection->string('seller_primary_currency',10)->nullable();
            $collection->double('seller_sale_account_balance_in_primary_currency')->nullable();
            $collection->double('seller_sale_account_minimum_balance_in_primary_currency')->nullable();
            $collection->double('seller_fee_account_balance_in_primary_currency')->nullable();
            $collection->double('seller_transaction_fee_factor')->nullable();
            $collection->string('seller_payment_methods_accepted',20)->nullable();
            
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
        Schema::drop('seller');
    }
}
