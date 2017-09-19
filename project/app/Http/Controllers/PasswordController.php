<?php namespace App\Http\Controllers;

use App\Repositories\CommonRepositoryInterface;
use App\Repositories\CommonRepository;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\EmailTemplate;
use App\User;
use Auth;
use Flash;
use Input;
use DB;
use Mail;
use Hash;
use Carbon\Carbon;
use App\Http\Requests\ForgetPasswordappRequest;

class PasswordController extends Controller {


	
	
	
	/**
	  * Render the view to reset password.
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	
	public function reset($token)
	{
		 $token = $token;
		 $user = User::where('remember_token',$token)->where('reset_exp_date','>=',Carbon::now())->first();
		
		  if(isset($user) && !empty($user)){
			  
		  }else{
			  $message = "This link has expired";
			  $heading = "ERROR";
			  return view('admin.auth.successpage',compact('message','heading'));
		  }
		  //$userdata = User::where('id','=',$id)->first();
			
				//return view('admin.auth.resetapipassword',compact('token'));
				return view('auth.resetpasswordapi',compact('token'));
		
		
	}
	
	/**
	  * Reset the password.
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	
	public function Resetpassword(ForgetPasswordappRequest $request)
	{
		try
		{
			//print_r($request->all);
			 $credentials = $request->only(
				'email', 'password', 'password_confirmation','token'
			);
			
			  $user = User::where('remember_token','=',$request->token)->where('email',$request->email)->first();
			if(isset($user) && !empty($user)){ 
				 $user->password = Hash::make($request->password);
				 $user->remember_token = null;
				 $user->reset_exp_date = null;
				$savedpassword = $user->save();
				if($savedpassword)
				{
			  $message = "Your password has been reset";
			  $heading = "SUCCESS";
			  $signIn = 1;
			  return view('admin.auth.successpage',compact('message','heading','signIn'));
				}
				else
				{
					flash()->error('Sorry, password not updated. Please try again.');
					 $message = "password not updated. Please try again.";
					$heading = "Awww!!";
			  return view('admin.auth.successpage',compact('message','heading'));
				}
				
			}
			else{
				return Redirect::back()->withErrors('Eamil does not exist');
				//~ $message = "Email does not exist";
			  //~ $heading = "Oops!!";
			  //~ return view('admin.auth.thankyoupage',compact('message','heading'));
			}
			
		}
		catch (\Exception $e) 
		{
			
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
	}	
			
}

			 

			 
			
			
