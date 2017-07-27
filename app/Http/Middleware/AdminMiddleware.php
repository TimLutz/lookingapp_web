<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Flash;
class AdminMiddleware
{
	protected $auth;

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
    public function handle($request, Closure $next) {
        if ( $this->auth->guest() ) {
			if ($request->ajax()){
				return response('Unauthorized.', 401);
			   } else {
				return redirect()->guest('/login');
			   }
		}elseif($this->auth->check()) {
			/*if($request->user()->role != '1' ) {
				flash()->error('You do not have privileges to log into admin dashboard.');
				return redirect('/login');
			}*/
		}
		return $next($request);
    }
}
