<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

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
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest())
			{
				   if ($request->ajax())
				   {
					return response('Unauthorized.', 401);
				   }
				   else
				   {
					return redirect()->guest(getenv('adminurl').'/auth/login');
				   }
			}
			elseif($this->auth->check())
				{
					if($request->user()->role != '1' && $request->user()->role != '2') {
						flash()->error('You do not have privileges to log into admin dashboard.');
						return redirect('nimdaalf/auth/login');
					}
				}
				
			return $next($request);
    }
}
