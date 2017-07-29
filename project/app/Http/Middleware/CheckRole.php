<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckRole {


	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
		 {
			 if ($this->auth->check())
			 {
				 if($request->user()->role == '1' || $request->user()->role == '2') 
				 {
					return redirect(getenv('adminurl'));
				 }
			 }
			 return $next($request);
		 }
}
