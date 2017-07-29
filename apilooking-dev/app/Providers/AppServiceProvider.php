<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\MyValidation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
    }
    public function boot()
	{
		

		$this->app->validator->resolver(function($translator, $data, $rules, $messages)
    	{
      	return new MyValidation($translator, $data, $rules, $messages);
    	});

	
    }
}
