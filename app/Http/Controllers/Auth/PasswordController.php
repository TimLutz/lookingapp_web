<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests;
use Illuminate\Http\Request;
use Mail;
use Hash;
use Input;
use App\Model\User;
use DB;
use App\EmailTemplate;
use Illuminate\Auth\Passwords\TokenRepositoryInterface  as TokenRepositoryInterfaces;
use App\Jobs\SendEmail;

//use Flash;
class PasswordController extends Controller {

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
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @param  \Illuminate\Auth\Passwords\TokenRepositoryInterface  $tokens
	 * @return void
	 */
	
	protected $useremail;
	public function __construct(TokenRepositoryInterfaces $tokens,Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;
		$this->tokens = $tokens;
		//$this->middleware('guest');
		
	}

	/**
     * Function is used to display the forgeting email page.
     *
     */
	public function getEmail()
	{
		try {
			return view('auth.password');
		} catch (\Exception $e) {
			$result = [
						'exception_message'=>$e->getMessage()	
					  ];
			return view('errors.exceptionerror',$result);		  
		}
	}
	
	/**
     * Function is used sending email for requesting new password.
     */
	public function postEmail(Request $request)
	{
		try
		{
				$users = User::where(array('role'=>'3','email'=>$request->email))->get()->toArray();
				if(count($users)) 
				{
					switch ($response = $this->sendResetLink($request->only('email')))
					{
						case PasswordBroker::INVALID_USER:
							return redirect()->back()->withErrors(['email' =>trans($response)]);
				 
						case PasswordBroker::RESET_LINK_SENT:
							flash()->success('Reset Link has been sent to your Email Address');
							//return redirect()->back()->with('status', trans($response));
				//			return Redirect('auth/login');
							$url = redirect('/');
							$result = ['status'=>true,'url'=>$url];
					}
					//return Redirect('auth/reset');
					$url = redirect('/');
					$result = ['status'=>true,'url'=>$url];
				}
				else
				{
					flash()->error('You are not yet registered!');
				//	return Redirect('password/email');
					$url = redirect('/');
					$result = ['status'=>false,'url'=>$url];
				}
			return response()->json($result,422);
		}
		catch (\Exception $e) 
		{ 
            /*$result = [
						'exception_message'=>$e->getMessage()	
					  ];
			return view('errors.exceptionerror',$result);*/
        }
	}
	
	/**
	  * Send reset link to registered user.
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	
	public function sendResetLink(array $credentials)
	{
		try
		{
			$user = $this->passwords->getUser($credentials);
			if (is_null($user))
				return PasswordBroker::INVALID_USER;

			$token = $this->tokens->create($user);
			$this->emailResetLink($user, $token);
			return PasswordBroker::RESET_LINK_SENT;
		}
		catch (\Exception $e) 
		{ 
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.exceptionerror', $result);
        }
	}
	
	/**
	  * Send dynamic email template to user for reset the password
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	
	public function emailResetLink($user, $token)
	{
		try
		{
			$email = Input::get('email');
			$template=EmailTemplate::find('24');
			echo $link="<a href='". url('password/reset/'.\Crypt::encrypt($email).'/'.$token)."'>Change your password now</a>";

			/*$data = $this->common->userDetail($email);
			$find=array('@click here@','@username@');
			$values=array($link,$data->first_name);			
			$body=str_replace($find,$values,$template->content);
			$mailData = array('content'=>$body,'email'=>$email,'subject'=>$template->subject);
			$this->dispatch(new SendEmail($mailData))*/;/*21-07-2016 QUEUE IMPLEMENTED*/
		}
		catch (\Exception $e) 
		{ 
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.exceptionerror', $result);
        }
	}

	/**
     * Displaying the reset page.
     *
     * @param  array  $email $token
     * @return User
     */
	public function getReset($token = null)
	{
		//	echo $email = '"'.$email.'"';
			if($token != null)
			{
				if(DB::table('password_resets')->where('token',$token)->exists()){
					$email = DB::table('password_resets')->where('token',$token)->pluck('email')->first();
					return view('employer.promo.resetpassword',compact('token','email'));
				}
				else				
	            	flash()->error('The Link has been Expired, Please try again with new token!');
	            	return redirect('/');
			}
			else
				flash()->error('Reset Password Link is Expired!');
		            	return redirect('/');	
		
	}
	
	/**
	  * Reset the password.
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	 
	public function postReset(Requests\ResetPassword $request) 
	{
		$this->validate($request, [
				'token' => 'required',
				'password' => 'required|confirmed',
			]);
		
			$credentials = $request->only(
				'email', 'password', 'password_confirmation', 'token'
			);
		$this->useremail = $request->email;
			$response = $this->passwords->reset($credentials, function($user, $password)
			{

				$data = $this->common->userDetail($this->useremail);
				
				$user->password = Hash::make($password);
				if($user->save())
				{
					/*$username = $data->first_name.' '.$data->last_name; 
					$template=EmailTemplate::find('47');
					$find=array('@username@');
					$values=array($username);
					
					$body=str_replace($find,$values,$template->content);
					$mailData = array('content'=>$body,'email'=>$this->useremail,'subject'=>$template->subject);
					$this->dispatch(new SendEmail($mailData));
					$date = date('Y-m-d H:i:s');
					$template1=EmailTemplate::find('45');
					$find1=array('@username@','@date@');
					$values1=array($username,$date);
					
					$body1=str_replace($find1,$values1,$template1->content);
					$mailData1 = array('content'=>$body1,'email'=>$this->useremail,'subject'=>$template1->subject);
					$this->dispatch(new SendEmail($mailData1));*/
					flash()->success('Success! Password has been changed successfully, please proceed with the login now.');
				}
				else
				{
					flash()->error('Sorry, password can not be updated. Please try again.');
				}
				
				return redirect('/');
			});

			switch ($response)
			{
				case PasswordBroker::PASSWORD_RESET:
					return redirect('auth/login');

				default:
					return redirect()->back()
								->withInput($request->only('email'))
								->withErrors(['email' => trans($response)]);
			}
		
	}
}
