<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->string('nonce',255)->nullable(false);
            $table->string('transaction_id',255)->nullable(false);
            $table->string('payment_status',255)->nullable(false);
            $table->string('payment_type',255)->nullable(false);
            $table->decimal('amount', 10, 2)->nullable(false);
            $table->string('currency',20)->nullable(false);
            $table->string('merchant_acc_id')->nullable(false);
            $table->string('customer_email')->nullable(false);
            $table->string('card_type',255)->nullable(false);
            $table->string('last4_digit',100)->nullable(false);
            $table->string('exp_month',100)->nullable(false);
            $table->string('exp_year')->nullable(false);
            $table->integer('payment_for')->comment('0=>default 1=> subscription 2=> removeads')->nullable(false);
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
