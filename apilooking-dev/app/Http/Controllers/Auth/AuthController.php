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
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    

    /*=============================================================================================
    Function for api login
    ===============================================================================================
    */
    public function postLogin(Request $request){
        
        $data=$request->All();

        if($request->has('email')){
           $data['email']=strtolower($request->input('email')); 
        }
        $validator = Validator::make( $data  ,      [

            'email'               => 'required|email|exists:users,email',
            'password'            => 'required',
            'role'                => 'required',
            'device_token'        => 'required',
            'device_type'         => 'required'
        ],
        [
            'email.exists'=>"We couldn't find you.Please check your credentials.",
        ]);

        if ($validator->fails()) {

            //$response['errors']   = $validator->errors()->first();
            $response['success']   = 0;
            $response['errors']   = $validator->errors();
            $http_status=422;

        }else{
        // grab credentials from the request
            
            $credentials=$request->only('email', 'password');
            $credentials['email']=strtolower($credentials['email']);
            try {
                $credentials = $request->only('email','password','role');
                $credentials['status']=1;

                // verify the credentials and create a token for the user
                if ($token = JWTAuth::attempt($credentials)) {
                   $response = compact('token');
                   $user = User::where('email',$request['email'])->first();
                   if($user)
                   {
                       /* Update device token and device type */
                       $userdata['device_token'] = $request->Input('device_token');
                       $userdata['device_type'] = $request->Input('device_type');
                       $userdata['modification_date'] = Carbon::now();
                       
                       if($user->update($userdata)){
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
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                $response['success']       = 0;
                $response['errors']      = 'could_not_create_token';
                $http_status=400;
            }
        }
        // all good so return the token
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
       //return $dd = User::where('email','debutinfo5@gmail.com')->get();die;
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
      return response()->json($response);
    }

    /**
     * Handle a social login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function postSocialLogin(Request $request)
    {
        
      $function_enter=date("m-d-Y H:i:s.u");
      $validator = Validator::make( $request->all()  ,      [
           
      'email'               => 'required|email',
      
      
    ]);
    
    if ($validator->fails()) {
      
        $response['errors']   = $validator->errors();
        
        $response['status']   = 0;
      }else{

        $credentials = $request->only('email');
        
        
              // verify the credentials and create a token for the user
           $user=User::where('email',$request->input('email'))->first();
           $data=$request->all();
           $data['user_email_confirmed']=true;
           $data['user_first_login']=false;
           $data['password_reset_requested']=false;
           $data['type']=3;
           $data['status']=true;
           if($request->has('dob'))
            {
              $data['dob']=\Carbon\Carbon::createFromFormat('d/m/Y', $data['dob']);
            }

           if(!$user){
            $user=User::create($data);
            
            
            $jobseekers=User::createJobSeekers($user->id);
           }
            $token = JWTAuth::fromUser($user);
            if (!$token  && $jobseekers) {
                 
               return response()->json(array('errors'=>array('email'=>Lang::get('messages.valid_email_password')),'status'=>0));
             
              }
            
        
        $response = compact('token');
        $response['user']         = User::where('email',$request->input('email'))->with(array('jobseekers'=>function($query)
                                    {
                                      $query->with(array('experience'=>function($q){ $q->where('status',true)->get(); }))->get();
                                    }))->first();
        $response['message']      = 'Success';
        $response['login_update'] = User::where('email',$request->input('email'))->update(array('user_first_login'=>false));
        $response['status']       = 1;
      }
      return response()->json($response);
    }

    


   



	

}
