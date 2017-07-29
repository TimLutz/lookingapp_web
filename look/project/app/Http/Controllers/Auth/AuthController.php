<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use Hash;
use Mail;
use Auth;
use Flash;
use App\EmailTemplate;
use Cookie;
use Session;



class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
		$this->auth = $auth;
	//	$this->registrar = $registrar;
        $this->middleware('guest', ['except' => 'getLogout']);	
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function getRegister()
    {
		try {
			
			return view('auth.register');
		} catch (Exception $e) {
			$result = [
						'exception_message'=>$e->getMessage()
					 ];
			return view('errors.error',$result);		 
		}
	}
	
	public function postRegister(Requests\UserRequest $request)
	{
		try {
			
			$confirm_code = str_random(30);
			$user = new User();
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->email = $request->email;
			$user->company_name = $request->company_name;
			$user->phone_number = $request->phone_number;
			$user->password = Hash::make($request->password);
			$user->email_verification_code = $confirm_code;
			$user->role = '2';
			//Define dynamic email template for use in confirmation mail.
			$template=EmailTemplate::find(20);
			/*$link="<a href='http://localhost/gohusky/register/verify/$user->email_verification_code'>Click here</a>";*/
			$link="<a href='". url('register/verify/'.$user->email_verification_code)."'>Click here</a>";
			$find=array('name','Click here','email','password');
			$values=array($user->first_name,$link,$request->email,$request->password);
			$body=str_replace($find,$values,$template->content);
			if($user->save())
			{
				//Sending Mail...
				Mail::send('emails.verify', array('content'=>$body), function($message) use($template)
				{
					$message->to(Input::get('email'))
							->subject($template->subject);
							
				});
				Flash::success('Thanks for signing up. Your account activation link has been sent to your email.');
			}
			else
			{
				Flash::error('Sorry, something went wrong');
			}
			redirect('auth/register');
		} catch (Exception $e) {
			$result = [
						'exception_message'=>$e->getMessage()
					];
			return view('errors.error',$result);		
		}
	}
	
	public function getLogin()
	{
		try {

            return view('auth.login');
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()    
                      ];       
            return $result;          
        }
	}
	
	public function postLogin(Requests\AuthenticateUser $request)
	{
		try {
			$email = $request->email;
		$exist = User::where('email',$email)->where('status','1')->where('email_verification_code','')->first();
		if($exist){
			if($exist->role == 2){
				$credentials['email'] = $request->email;
				$credentials['password'] = $request->password;
					
				$credentials['role'] = $exist->role;
				
		//	print_r($credentials);
				$remember = (Input::has('remember')) ? true : false;
					if($remember == "on"){
						if ($this->auth->attempt($credentials)){
							//Generate cookies.
							if($credentials['role'] == 2)
							{
								if(Session::get('pickup') != '' && Session::get('dropof') != '' && Session::get('distance') != '' && Session::get('email') != '')
				                {
				                    return redirect('user/booking');
				                }
				                else
				                {
									//return redirect('user/dashboard')->withCookie(cookie('email', $request->email,60))->withCookie(cookie('password', $request->password,60));
								}
							}
						}
					}else{
						if ($this->auth->attempt($credentials)){
							//Forget cookies.
							$cookie_email = Cookie::forget('email');
							$cookie_password = Cookie::forget('password');
							if($credentials['role'] == 2){
								if(Session::get('pickup') != '' && Session::get('dropof') != '' && Session::get('distance') != '' && Session::get('email') != '')
				                {
				                    return redirect('user/booking');
				                }
				                else
				                {
								//	return redirect('user/dashboard')->withCookie($cookie_email)->withCookie($cookie_password);	
									//echo "hi";
								}
							}
						}
						
					}
				}else{
					flash()->error('Sorry! Something went wrong, Please try again later');
					return redirect('auth/login')
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => 'Email does not exist',
					]);	
					//echo "hi";
				}
			}else{
				flash()->error('Sorry! Something went wrong, Please try again later');
				return redirect('auth/login')
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => 'Email does not exist',
					]);	
					//echo "hello";
			}
			
		} catch (Exception $e) {
			$result = [
							'exception_message'=>$e->getMessage()
						  ];
				return view('errors.error', $result);	
		}
		return redirect('auth/login')
						->withInput($request->only('email'))
						->withErrors([
							'email' => $this->getFailedLoginMessage(),
						]);
	}
	
	public function getLogout()
	{
		try
		{
			$this->auth->logout();
			$val1 = Cookie::get('email');
			$val2= Cookie::get('password');
			response()->view('/auth/login')->withCookie(cookie('email', $val1))->withCookie(cookie('password', $val2));		
			Session::forget('distance');
            Session::forget('pickup');
            Session::forget('dropof');
            Session::forget('amount');
            Session::forget('email');
            Session::forget('mobile');
            Session::forget('mode_type');
            Session::forget('service');
            Session::forget('quote_id');
			return redirect('/auth/login');
		//	$request->session()->flush();
		}
		catch (\Exception $e) 
		{ 
            abort(404);
        }
	}
}
