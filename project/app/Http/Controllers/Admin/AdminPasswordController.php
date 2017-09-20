<?php namespace App\Http\Controllers\Admin;

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
use Flash;
//use App\Models\EmailTemplate;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use DB;
use App\EmailTemplate;

class AdminPasswordController extends Controller {

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
		$this->middleware('admin.auth', ['except' => 'getLogout']);
	}
	
	/**
	  * Render the view to send email for reset password.
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	
	public function getEmail()
	{
		try
		{
			$user = User::where(['role'=>1,'status'=>1])->find(1)->toArray();
			
			return view('admin/reset_password',['user'=>$user]);
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
	  * Send reset link.
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	
	public function postEmail(Requests\EmailValidation $request)
	{
		try
		{
			//call sendResetLink function
			$users = User::where('role','1')->where('status','1')->where('email',$request->email)->get()->toArray();
			if(count($users) > 0)
			{
				switch ($response = $this->sendResetLink($request->only('email')))
				{
					case PasswordBroker::INVALID_USER:
					flash()->success('Invalid user!');
						return redirect()->back()->withErrors(['email' =>trans($response)]);
			
					case PasswordBroker::RESET_LINK_SENT:
						flash()->success('Reset Link has been sent to your Email Address!!');
						//return redirect()->back()->with('status', trans($response));
						return Redirect(getenv('adminurl').'/auth/login');
				}
				return Redirect(getenv('adminurl').'/auth/reset');
				
			}
			else
			{
				flash()->error('You are not authorised person!');
				return Redirect(getenv('adminurl').'/password/email');
			//	return redirect()->back()->with('status', trans($response));
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
	
	/**
	  * Send reset link to registered user after verification.
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
			//call emailResetLink function
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
			//print_r(Input::get('email')); die;
		    /*$link="<a href='". url(getenv('adminurl').'/password/reset/'.$token)."'>Click here</a>";*/
		    $url = url(env('adminurl').'/password/reset/'.$token);
		    $link="<a href='$url' style='text-decoration:none;'>https://www.lookingmobileapp.com/resetpassword</a>";
			$find=array('@click here@');
			$values=array($link); 
			$body=str_replace($find,$values,$template->content);

			//Send Mail
			return Mail::send('emails.verify', array('content'=>$body), function($m)use($template)
			{
				$m->to(trim(Input::get('email')))
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
	
	/**
	  * Render the view to reset password.
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	
	public function getReset($token = null)
	{
		try
		{
			if(DB::table('password_resets')->where('token',$token)->exists())
			{
				return view('admin.auth.reset')->with('token', $token);
			}
			else
			{
				abort(404);
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
		try
		{
			//print_r($request->all);
			$credentials = $request->only(
				'email', 'password', 'password_confirmation', 'token'
			);
			
			$response = $this->passwords->reset($credentials, function($user, $password)
			{
				//Reset password after credentials matched
				$user->password = Hash::make($password);
				$user->save();
				if($user->save())
				{
					flash()->success('Your password has been updated');
				}
				else
				{
					flash()->error('Sorry, password not updated. Please try again.');
				}
				return Redirect(getenv('adminurl').'/auth/login');
			});
			
			switch ($response)
			{
				case PasswordBroker::PASSWORD_RESET:
					return redirect(getenv('adminurl').'/auth/login');

				default:
					return redirect()->back()
								->withInput($request->only('email'))
								->withErrors(['email' => trans($response)]);
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
