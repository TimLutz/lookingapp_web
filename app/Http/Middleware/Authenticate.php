<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Flash;
class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
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

        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/');
            }
        }
        elseif($this->auth->check())
        {
            if($request->user()->role != 3) 
            {
                flash()->error('You do not have privileges to log into user dashboard.');
                return redirect('/');
            }
            if($request->user()->role == 3)
            {
                if($request->user()->approved==2){  
                   return redirect('employer/logout');
                }
            }
        }    
        return $next($request);
    }
}
