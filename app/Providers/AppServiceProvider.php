<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositary\CustomValidation;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        
        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new CustomValidation($translator, $data, $rules, $messages);
        });

        /* Alphabet with space validation */
        Validator::extend('alpha_spaces', function( $attribute, $value ) {
           return preg_match('/^[\pL\s]+$/u', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
