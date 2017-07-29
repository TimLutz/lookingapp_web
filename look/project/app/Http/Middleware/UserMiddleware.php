<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
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
					return redirect()->guest('auth/login');
				   }
			}
			elseif($this->auth->check())
				{
					if($request->user()->role != '1') {
				
					} else {
						flash()->error('You do not have privileges to log into admin dashboard.');
						return redirect('auth/login');
					}
				}
				
			return $next($request);
    }
}
