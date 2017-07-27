<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Repositary\CommonRepositary;
use App\Model\User;
use Validator;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\Password;
use Input;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /*==================================================================================================
    Function for send otp for forget password
    ====================================================================================================
    */
    public function getApiForgetPassword(Request $request,CommonRepositary $common){
        
        $data=$request->All();
        
        if($request->has('email')){
           $data['email']=strtolower($request->input('email')); 
        }
        
        $validator = Validator::make( $data  ,      [

            'email'               => 'required_without:phone|email|exists:users,email',
            'phone'             => 'required_without:email|exists:users,phone'
            

        ],
        [
            'email.exists'=>"We couldn't find you.Please check your credentials.",
            'phone.exists'=>"We couldn't find you.Please check your credentials.",
            'email.otp_verified'=>"We couldn't find you.Please check your credentials.",
            'phone.otp_verified'=>"We couldn't find you.Please check your credentials.",
        ]

        );

        if ($validator->fails()) {
            
            $response['errors']   = $validator->errors()->first();
            $response['status']   = 0;
            $http_status=400;
        }else{
            if($request->has('phone')){
                $match=array('role'=>2,'phone'=>$request->input('phone'));
            }else{
                $match=array('role'=>2,'email'=>strtolower($request->input('email')));
            }

            $user=User::where($match)->first();
            if($user)
            {
                if($user->approved==2)
                {
                    $response['errors']   ='Sorry, your profile has been declined by the administrator.';
                    $response['status']     =0;
                    $http_status=200;    
                }
                else
                {
                    $otp=$common->randomGenerator();
                    $user_data=$user;
                    if($user && $user->update(array('otp'=>$otp,'otp_expire'=>\Carbon\Carbon::now()->addMinutes(env('OTPEXPIRE'))))){
                        $common->sendText($user_data->country_code.$user_data->phone,'Hello! Welcome to MadWall. Here is the code: '.$otp.'. Please confirm it in the app. Thanks!');
                        $response['otp']   =$otp;
                        $response['status']     =1;
                        $http_status=200;
                    }else{
                        $response['errors']   ='No such user found.';
                        $response['status']     =0;
                        $http_status=200;
                    }
                }
                
            }
            else
            {
                $response['errors']   ='No such user found.';
                $response['status']     =0;
                $http_status=200;
            }
        }
        return response()->json($response,$http_status);
    }

    /***
        Function to reset the password for employer
    *************/
    public function postEmployerForgotPassword(ForgotRequest $request)
    {
        $data = $request->all(); 
        $user = User::where(array('email'=>$data['email'],'role'=>3))->first();
        if($user){
            if($user['approved'] != 2)
            {
                app('auth.password')->broker('sellers');
                $response = Password::sendResetLink(['email'=>$data['email']]);
                if($response=='passwords.sent')
                {
                    flash()->success('Success ! Verification link to reset your password has been sent to your registered email id');
                    $result = ['msg'=>'Success ! Verification link to reset your password has been sent to your registered email id'];
                    $http=200;
                }
                else{
                    $result['email'] = ['msg'=>'We couldn`t find you, please check your email'];
                    $http=422;
                }
            } 
            else
            {
                $http=422;
                $result['email'] = 'Your profile was declined by administrator';
            }      
        }
        else
        {
            $http=422;
            $result['email'] = 'We couldn`t find you, please check your email';
        }
        return response()->json($result,$http);
    }
}