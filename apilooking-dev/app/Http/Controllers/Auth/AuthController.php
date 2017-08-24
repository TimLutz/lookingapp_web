<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Exception\HttpResponseException;  
use JWTAuth;  
use App\Models\User;
use App\Models\UserFavoriteSeller;
use App\Models\Order;
use App\Models\Device;
use App\Models\JobSeekers;
use Tymon\JWTAuth\Exceptions\JWTException;  
use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;  
use Illuminate\Http\Response as IlluminateResponse;
use Log;
use DateTime;
use DateTimeZone;
use Validator;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use App\Http\Repository\Repository;

class AuthController extends Controller {
	
  	public function __construct(){
      $this->middleware('jwt.auth', ['except' => ['postLogin','postSocialLogin']]);
    }

     /**
     *
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * Name: postLogin
     * Purpose: function to user login
     * created By: Lovepreet
     * Created on :- 1 Aug 2017
     *
     **/
    public function postLogin(Request $request){
        
        try {

           $data=$request->All();
            // Validation for the messages
            $validator = Validator::make( $data  ,[
                'email'               => 'required|email|exists:users,email',
                'password'            => 'required',
                'device_token'        => 'required',
                'device_type'         => 'required'
            ],
            [
                'email.exists'=>"We couldn't find you.Please check your credentials.",
                'password.required'=>'Please enter password.',
                'device_token.required'=>'Device token is not found.',
                'device_type.required'=>'Device type is not found.',
            ]); 

            if ($validator->fails()) {
                $response['success']   = 0;
                $response['errors']   = $validator->errors();
                $http_status=422;

            }else{
                
              $credentials = $request->only('email','password');
              $credentials['status']=1;
              $credentials['role']=2;

              // verify the credentials and create a token for the user
              if ($token = JWTAuth::attempt($credentials)) 
              {
                 $user = User::where('email',$request['email'])->first();
                 if($user)
                 {
                     /* Update device token and device type */
                     $userdata['device_token'] = $request->Input('device_token');
                     $userdata['device_type'] = $request->Input('device_type');
                     $userdata['modification_date'] = Carbon::now();
                     
                     if($user->update($userdata)){
                         $user['token'] = $token;
                         $http_status=200;
                         $response['success']       = 1;
                         $response['message']      = 'Login Successfull'; 
                         $response['user_data']      = $user;
                     }  
                     else
                     {
                          $response['success']       = 0;
                          $response['message']      = 'Something worng!';
                          $http_status=400;
                     }
                 }
              }
              else{
                  $response['success']       = 0;
                  $response['message']      = 'Invalid Email/Password';
                  $http_status=400;
              }
                
            }

        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = 0;
            $http_status = 400;  
        }
        catch (JWTException $e) {
                    // something went wrong whilst attempting to encode the token
                    $response['success']       = 0;
                    $response['message']      = 'could_not_create_token';
                    $http_status=400;
        }

        return response()->json($response,$http_status);
        
    }
    
    
    
    
     /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogout(Request $request)
    {
      try {

           $validator = Validator::make( $request->all()  ,      [
            'device_token'        => 'required',
            
          ]);
          
          if ($validator->fails()) {
              $response['errors']   = $validator->errors();
              
              $response['status']   = 0;
            }else{
            $user_id = JWTAuth::parseToken()->authenticate()->id;
            $device_token = $request->Input('device_token');
            $delete_device_token = Device::where('user_id',$user_id)->where('device_token',$device_token)->delete();
            if($delete_device_token){
              $response['status']   = 1;
              $response['message']   = "Success";
            }
            else{
              $response['status']   = 0;
              $response['message']   = "Fail";
            }
             
          }

       } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = 0;
            $http_status = 400;  
       } 
     
      return response()->json($response);
    }
}
