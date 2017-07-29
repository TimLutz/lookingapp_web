<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'transactions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['employer_id','transaction_type','transaction_cost','job_id'];

	
    
	

	
	
}
