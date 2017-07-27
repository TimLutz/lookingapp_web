<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Validation;
use Validator;

class ValidationServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Validator::resolver(function($translator, $data, $rules, $messages)
    	{
        	return new Validation($translator, $data, $rules, $messages);
    	});


	

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
