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
use App\User;
use DB;
use App\EmailTemplate;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;

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
	public function __construct(TokenRepositoryInterface $tokens,Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;
		$this->tokens = $tokens;
		$this->middleware('guest');
	}

	public function getEmail()
	{
		try {
			return view('auth.password');
		} catch (Exception $e) {
			$result = [
						'exception_message'=>$e->getMessage()	
					  ];
			return view('errors.error',$result);		  
		}
	}
	
	public function postEmail(Requests\EmailValidation $request)
	{
		try
		{
			$users = User::where('role','2')->where('status','1')->where('email',$request->email)->get()->toArray();
			if(count($users) > 0)
			{
				switch ($response = $this->sendResetLink($request->only('email')))
				{
					case PasswordBroker::INVALID_USER:
						return redirect()->back()->withErrors(['email' =>trans($response)]);
			
					case PasswordBroker::RESET_LINK_SENT:
						flash()->success('Reset Link has been sent to your Email Address');
						//return redirect()->back()->with('status', trans($response));
						return Redirect('auth/login');
				}
				return Redirect('auth/reset');
			}
			else
			{
				flash()->error('You are not authorised person!');
				return Redirect('password/email');
			}
		}
		catch (\Exception $e) 
		{ 
            abort(404);
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
			{
				return PasswordBroker::INVALID_USER;
			}
			$token = $this->tokens->create($user);
			$this->emailResetLink($user, $token);
			return PasswordBroker::RESET_LINK_SENT;
		}
		catch (\Exception $e) 
		{ 
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
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
			$template=EmailTemplate::find('24');
			//$link="<a href='http://bookke.debutinfotech.com/password/reset/$token'>Click here</a>";
			$link="<a href='". url('password/reset/'.$token)."'>Click here</a>";
			
			$find=array('@click here@');
			$values=array($link);
			
			$body=str_replace($find,$values,$template->content);

			return Mail::send('emails.verify', array('content'=>$body), function($m) use($template)
			{
				$m->to(Input::get('email'))
					->subject($template->subject);
			});
		}
		catch (\Exception $e) 
		{ 
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
	}

	public function getReset($token = null)
	{
		try
		{
			if(DB::table('password_resets')->where('token',$token)->exists())
			{
				return view('auth.reset')->with('token', $token);
			}
			else
			{
				$result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
			}
		}
		catch (\ErrorException $e) 
		{ 
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
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
				'email' => 'required|email',
				'password' => 'required|confirmed',
			]);
		try
		{
			$credentials = $request->only(
				'email', 'password', 'password_confirmation', 'token'
			);
			$response = $this->passwords->reset($credentials, function($user, $password)
			{
				$user->password = Hash::make($password);
				if($user->save())
				{

					flash()->success('Password Updated Successfully');
					
				}
				else
				{
					flash()->error('Sorry, password can not be updated. Please try again.');
				}
				return redirect('auth/login');
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
		catch (\Exception $e) 
		{ 
            abort(404);
        }
	}
}
