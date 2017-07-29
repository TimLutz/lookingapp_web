<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use JWTAuth;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\EmployerloginRequest;
use Flash;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Token;
use App\Http\Repositary\CommonRepositary;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Lang; 
use Cookie;
use Carbon\Carbon;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout','getEmployerLogout');
        $this->redirectTo = 'admin/dashboard';
        $this->middleware('jwtcustom', ['only' => ['getAgrement']]);
    }
    /*=============================================================================================
    Function for api login
    ===============================================================================================
    */
    public function apiLogin(Request $request,CommonRepositary $common){
        
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
            $response['errors']   = $validator->errors()->first();
            $http_status=422;

        }else{
        // grab credentials from the request
            
            $credentials=$request->only('email', 'password');
            $credentials['email']=strtolower($credentials['email']);
            
            $credentials['status']=1;
            try {
                $credentials = $request->only('email','password','role');
                $credentials['status']=1;

                // verify the credentials and create a token for the user
                if ($token = JWTAuth::attempt($credentials,array())) {
                  
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
    /*==================================================================================================
    Function for otp verification
    ====================================================================================================
    */
    public function otpVerification(Request $request,CommonRepositary $common){
    	$validator = Validator::make( $request->all()  ,      [

            'otp'               => 'required|exists:users,otp|otp_expire'],['otp.exists'=>'Invalid OTP']);

        if ($validator->fails()) {
        	$response['errors']   = $validator->errors()->first();
            $response['status']   = 0;
            $http_status=400;

        }else{
        	$user=User::where(array('otp'=>$request->input('otp')))->first();
        	$data['status']=true;
            if($user->profile_complete==1){
               $data['profile_complete'] =2;
            }
            if($user && $user->update( $data)){
        		$response['token'] = JWTAuth::fromUser($user);
                $response['user_id'] =$user->id;
                $response['message'] ='Verified';
	            $response['status']=1;
	            $http_status=200;
                $common->getManageToken($response['token'],$response['user_id']);
        	}else{
        		$response['message'] ='Something went wrong';
	            $response['status']=1;
	            $http_status=200;
        	}
        	
        }
        return response()->json($response,$http_status);
    }

    /*==================================================================================================
    Function for resending otp
    ====================================================================================================
    */
    public function otpResend(Request $request,CommonRepositary $common){
        $data=$request->All();
        if($request->has('email')){
           $data['email']=strtolower($request->input('email')); 
        }
        $validator = Validator::make( $request->all()  ,      [

            'email'               => 'required_without:phone|email',
            'phone'               => 'required_without:email|exists:users,phone']);

        if ($validator->fails()) {
            $response['errors']   = $validator->errors()->first();
            $response['status']   = 0;
            $http_status=400;

        }else{
            $user=User::where(array('email'=>$request->input('email')))->orWhere('phone',$request->input('phone'))->first();
            $otp=$common->randomGenerator();
            $user_data=$user;
            if($user && $user->update(array('otp'=>$otp,'otp_expire'=>\Carbon\Carbon::now()->addMinutes(env('OTPEXPIRE'))))){
                $common->sendText($user_data->country_code.$user_data->phone,'Hello! Welcome to MadWall. Here is the code: '.$otp.'. Please confirm it in the app. Thanks!');
                $response['message'] ='generated';
                $response['otp'] =$otp;
                $response['status']=1;
                $http_status=200;
            }else{
                $response['message'] ='No such user found';
                $response['status']=1;
                $http_status=200;
            }
            
        }
        return response()->json($response,$http_status);
    }

    /*==================================================================================================
    Function for get agrement
    ====================================================================================================
    */

    public function getAgrement(){
         
        if(User::where('_id',JWTAuth::parseToken()->authenticate()->_id)->update(array('profile_complete'=>3))){
                $response['message'] ='agrement done';
                
                $response['status']=1;
                $http_status=200;
        }else{
                $response['message'] ='Something went wrong';
                
                $response['status']=0;
                $http_status=400;
        }
        return response()->json($response,$http_status);
    }


    //vikas code started here

    /**
     * Custom Login Messages
     * @param   App\Http\Requests\Auth\LoginRequest;
     */
    public function login(LoginRequest $request) {
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            /*if(Auth::user()->role==1){*/
                $this->redirectTo = 'admin/dashboard';
            /*}else{
                die('apply another role url here ');
            }*/
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request) {
        $data=$request->only($this->username(), 'password');
        //$data['role'] = 1;
        return $data;
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request){
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect( '/login' );
    }
    
    public function postEmployelogin(EmployerloginRequest $request)
    {

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptEmployerLogin($request)) {
            
            if(Auth::user()->role==3){
                    if(Auth::user()->approved==1 || Auth::user()->approved==0 || Auth::user()->approved==3){
                        $result['status']=1;
                        //$result['message']=url('employer/dashboard');
                        $url = url('employer/dashboard');
                        if($request->has('remember'))
                        {
                        //return response()->json($result)->withCookie(cookie('password', $request->password,60))->withCookie(cookie('email', $request->email,60));
                            return redirect($url)->withCookie(cookie('email', $request->email,60))->withCookie(cookie('password', $request->password,60));
                        }
                        else
                        {
                              $cookie_email=  Cookie::forget('email');
                              $cookie_password= Cookie::forget('password');
                           // return response()->json($result);
                                return redirect($url)->withCookie($cookie_email)->withCookie($cookie_password);
                        }
                    }
                    else if(Auth::user()->approved==2)
                    {
                        $this->guard()->logout();
                     /*   $request->session()->flush();
                        $request->session()->regenerate();*/
                       // $result = ['password'=>'Your profile has been declined by Adminstrator.'];
                       // return response()->json($result,422);
                        return redirect('/')
                                ->withInput($request->only('email', 'remember'))
                                ->withErrors([
                                    'password' => 'Your profile has been declined by Adminstrator.',
                                ]);
                    }
                }
                else
                {
                    $this->guard()->logout();
                   /* $request->session()->flush();
                    $request->session()->regenerate();*/
                  //  $result = ['password'=>'Invalid Email/Password'];
                  //  return response()->json($result,422);
                    return redirect('/')
                                ->withInput($request->only('email', 'remember'))
                                ->withErrors([
                                    'password' => 'Invalid Email/Password',
                                ]);
                }
            }else{
               // $result = ['password'=>'Invalid Email/Password'];
              //  return response()->json($result,422);
                return redirect('/')
                                ->withInput($request->only('email', 'remember'))
                                ->withErrors([
                                    'password' => 'Invalid Email/Password',
                                ]);
            }

            //return $this->sendLoginResponse($request);
        

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        
        //return $this->sendFailedLoginResponse($request);
        if($this->sendFailedLoginResponse($request))
        {
           // $result = ['password'=>'Invalid Email/Password'];
          //  return response()->json($result,422);
            return redirect('/')
                                ->withInput($request->only('email', 'remember'))
                                ->withErrors([
                                    'password' => 'Invalid Email/Password',
                                ]);
        }
    }

     /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function attemptEmployerLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->Employercredentials($request), $request->has('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function Employercredentials(Request $request) {
        
        $data=$request->only($this->username(), 'password');
        $data['role'] = 3;
        $data['email']=trim(strtolower($data['email']));
        //print_r($data); die;
        return $data;
    }
    

    /**
     * Function Logout employer From the application.
     * @param  None
     * @return Login View
     */

    public function getEmployerLogout(Request $request)
    {
        if(Auth::check()){
           // die('bcvnvn');
        $user = '';    
        if(Auth::user()->approved==2)
        {
            $user = 2;
        }
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        if($user==2)
        {
            flash()->error('Your profile was declined by administrator.');
        }
        return redirect( '/' );
        }
        
    }
    
}
