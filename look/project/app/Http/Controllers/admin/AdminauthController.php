<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests;


use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\User;
use Input;
use Cookie;


class AdminauthController extends Controller
{
	use AuthenticatesAndRegistersUsers; 
	
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		$this->middleware('admin.auth', ['except' => 'getLogout']);
	}
	
		
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        //
        try
        {
			return view('admin.auth.login');
		}
		catch(\Exception $e)
		{
			$result = [
						'exception_message'=>$e->getMessage()
					  ];
			return view('errors.error',$result);		  
		}
    }
    
    public function postLogin(Requests\AuthenticateUser $request)
    {
			try
			{
			    $data['email'] = $request->email;
				$data['password'] = $request->password;
				$data['status'] = '1';
			//	print_r($data); die();
				$remember = (Input::has('remember')) ? true : false;
				if($remember == "1")
				{
					
					if ($this->auth->attempt($data))
					{
						//Generate cookies.
						return redirect(getenv('adminurl'))->withCookie(cookie('email', $request->email,60))->withCookie(cookie('password', $request->password,60));
					}
				}
				else
				{
					if ($this->auth->attempt($data))
					{
						//Forget cookies.
						$cookie_email = Cookie::forget('email');
						$cookie_password = Cookie::forget('password');
						return redirect(getenv('adminurl'))->withCookie($cookie_email)->withCookie($cookie_password);
						
					}
				}
			}
			catch(\Exception $e)
			{
				$result = [
							'exception_message'=>$e->getMessage()
						  ];
				return view('errors.error', $result);		  
			}
			//Redirect after successful login.
			return redirect(getenv('adminurl').'/auth/login')
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
			//send cookies with response
			response()->view('admin/auth/login')->withCookie(cookie('email', $val1))->withCookie(cookie('password', $val2));
			return redirect(getenv('adminurl').'/auth/login');
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
