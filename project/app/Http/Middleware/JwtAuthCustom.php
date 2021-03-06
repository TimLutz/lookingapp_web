<?php
namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtAuthCustom
{
    /**
     * Handle an incoming request. Custom class created by pankaj cheema to handle smart messaging of jwt token
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	print_r(JWTAuth::parseToken()->authenticate()); die('hfggfgdere');
    try {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json([
                    'status' => -1,
                    'message'    => 'Your session has been expired.',
                    
                ],404);
        }
        } catch (TokenExpiredException $e) {

           return response()->json([
                    'status' => -1,
                    'message'    => 'Your session has been expired.',
                    
                ],404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                    'status' => -1,
                    'message'    => 'Your session has been expired.',
                    
                ],404);
 
        } catch (JWTException $e) {

            return response()->json([
                    'status' => -1,
                    'message'    => 'Your session has been expired.',
                    
                ],404);

        }
        return $next($request);
    }
}
