<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Model\User;
use Validator;
use Illuminate\Http\Request;
use Hash;
use JWTAuth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('jwtcustom',['only'=>['apiChnagePassword']]);
    }

    public function apiResetPassword(Request $request){
        $validator = Validator::make( $request->all()  ,      [

            'email'               => 'required_without:phone|exists:users,email',
            'password'          => 'required',
            'phone'             => 'required_without:email|exists:users,phone'

            ]);

        if ($validator->fails()) {
            $response['errors']   = $validator->errors()->first();
            $response['status']   = 0;
            $http_status=400;

        }else{
            if($request->has('phone')){
                $match=array('phone'=>$request->input('phone'));
            }else{
                $match=array('email'=>$request->input('email'));
            }
            $user=User::where($match)->first();
            if($user && $user->update(array('password'=>Hash::make($request->input('password'))))){
                $response['message']   = 'Password reset successfully.';
                $response['status']   = 1;
                $http_status=200;
            }else{
                $response['message']   = 'No Such user found..';
                $response['status']   = 0;
                $http_status=200;
            }
        }
        return response()->json($response,$http_status);
    } 
    /*======================================================================================
    Function for chnage password api
    ========================================================================================*/

    public function apiChnagePassword(Request $request){
        $validator = Validator::make( $request->all()  ,      [

            'password'                  => 'required|confirmed',
            'password_confirmation'     => 'required',
            'old_password'             => 'required'

            ]);

        if ($validator->fails()) {
            $response['errors']   = $validator->errors()->first();
            $response['status']   = 0;
            $http_status=400;

        }else{
            $user=User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->first();
            $credentials['email']=$user->email;
            $credentials['password']=$request->input('old_password');
            try {
                if(JWTAuth::attempt($credentials)){
                    if($user->update(array('password'=>Hash::make($request->input('password'))))){
                        $response['message']='Password updated successfully';
                        $response['status']=1;
                        $http_status=200;
                    }else{
                        $response['errors']='Something went wrong';
                        $response['status']=0;
                        $http_status=400;
                    }
                }else{
                    $response['errors']='Please enter correct old password';
                    $response['status']=1;
                    $http_status=200;
                }
               
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                throw new \Exception('Jwt Exception');
            }
            
        }
        return response()->json($response,$http_status);
    }
}
