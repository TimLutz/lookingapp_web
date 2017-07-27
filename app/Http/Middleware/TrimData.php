<?php
namespace App\Http\Middleware;
use Closure;

class TrimData
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
		if(!empty($request->all())){
			$trim_if_string = function ($var) { return is_string($var) ? trim($var) : $var; };
			$request->merge(array_map($trim_if_string, array_filter($request->all())));
			//change inputs to lower case
			$request->merge(array_map('strtolower', array_filter($request->only(['email','name']))));
		}
		return $next($request);
    }
}
