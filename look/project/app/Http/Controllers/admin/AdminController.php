<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use DB;
use Illuminate\Http\Request;
use repositories\CommonRepositoryInterface;
use Input;
use Auth;
use Hash;
use Mail;
use App\User;
use App\EmailTemplate;
use Cookie;
use App\Booking;

//use Image;
use Request as AjaxRequest;
//use Flash;

class AdminController extends Controller
{
	protected $common;
	
	public function __construct(Guard $auth, CommonRepositoryInterface $common)
	{
		$this->auth = $auth;
		//$this->registrar = $registrar;
		$this->middleware('admin');
		$this->common = $common;
	}
		
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        //
        try
		{ 
			if(Auth::user()){
				$active = 'dashboard';
				$data=$this->common->getinfo();
			
				return view('admin/dashboard',$data,compact('active'));
			}
			else
			{
				$data['logError'] = 'Login credentials are invalid.';
				return view('admin.auth.login',$data);	
			}
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
				'active' => 'dashboard'
            ];
			return view('errors.error', $result);
        }
    }

    public function getEditProfile()
	{
		try
		{
			$active = 'edit-profile';
			//CommonRepository is used here
			//$states = $this->common->getStates()->toArray();
			//$countries = $this->common->getCountries()->toArray();
			return view('admin/edit',compact('active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
	}
    
    public function postChangeStatus(Request $request)
    {  
        try {
			$ids = \Crypt::decrypt($request->id);
            $request = Input::all();
			$page_status=DB::table($request['table'])->where('id',$ids);
			$page_status->update([
                'status' => $request['status']
            ]);
            
            $result = [
                'success' => true,
				//flash()->success('Status Changed successfully'),
				'redirect_url' => url(getenv('adminurl').'/'.$request['action'])
            ];
        } catch (\Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
				flash()->error('Status cannot be Changed!'),
				'redirect_url' => url(getenv('adminurl').'/'.$request['action'])
            ];
        }
        return $result;
    }
    
    public function postEditProfile(Requests\EditAdminProfile $request)
	{
		try
		{
			$id=Auth::user()->id;			
			$user = User::find($id);
			//print_r($user);die();
			$data = $request->all();
			$data['name'] = $request->name;
			//~ $data['first_name'] = $request->first_name;
			//~ $data['last_name'] = $request->last_name;
			//image upload 
			$img = Input::file('pic');
			if($img != '')
			{ 
			//	$image = rand() . '_'.($img->getClientOriginalName());
				$image = $img->getClientOriginalName();
				$path = 'uploads/';
				//Storing image
				$img->move(base_path('../'.$path), $image);
				$data['photo']=$image;
			}
			//$user->photo=$image;
			$user->update($data);
			if($user->save())
			{
				
				//echo "hi";
				flash()->success('Profile Updated successfully');
				return redirect(getenv('adminurl').'/dashboard/edit-profile');
			}

			else
			{
			
				flash()->error('Profile can not be updated');
				return redirect(getenv('adminurl').'/dashboard/edit-profile');
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
	
	public function getChangePassword()
	{
		try
		{
			$active = 'Change Password';
			return view('admin/change-password',compact('active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
	}
	
	public function postChangePassword(Requests\ResetPassword $request)
	{	
		try
		{
			if(Hash::check($request->old_password, Auth::user()->password))
			{
			   $id = Auth::user()->id;
			   $user = User::find($id);
			  // echo $user->old_password = Hash::make($request->old_password); echo "<br>";
			  echo $user->password=Hash::make($request->password);
			  echo "<br>";
			   echo Auth::user()->password;
			   if(Hash::check($request->password, Auth::user()->password))
			   {
					flash()->error('Sorry, Please choose different password');
					
					return redirect(getenv('adminurl').'/dashboard/change-password');	
				}
				else
				{
				   if($user->save())
				   {
					
					flash()->success('Password Updated successfully, Please login with new credentials!');
					$this->auth->logout();
					$val1 = Cookie::get('email');
					$val2= Cookie::get('password');
					//send cookies with response
					response()->view('admin/auth/login')->withCookie(cookie('email', $val1))->withCookie(cookie('password', $val2));
					return redirect(getenv('adminurl').'/auth/login');
				   }
				   else
				   {
					  // $request->session()->flash('alert-danger', 'Password can not be Changed');
					flash()->error('Sorry, Password can not be Changed');
					
					return redirect(getenv('adminurl').'/dashboard/change-password');
				   }
				}
			}
			else
			{
				//$request->session()->flash('alert-danger', 'Sorry, your old password is not correct');
				
			   flash()->error('Sorry, your old password is not correct');
			  return redirect()->back()->withInput();
			//	return redirect('admin/dashboard/change-password');
			}
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
		//	return view('errors.error', $result);
        }
	//	return redirect('admin/dashboard/change-password');
	}
	
	public function getUsers()
	{
		try {
				$active = 'users';
               $users = User::where('status','!=','2')->get();
              return view('admin.user.index',compact('active','users'));
        } catch (Exception $e) {
            $result = [
            			'exception_message' => $e->getMessage()
            		  ];
			return view("errors.error", $result);            		  
        }
	}

	public function getView($id)
	{
		try {
			$active = 'users';
			//$id = base64_decode($id);
			$id =  \Crypt::decrypt($id);
			$users = User::where('status','!=','2')->find($id);
			
			return view('admin.user.view_detail', compact('active','users'));
			
		} catch (Exception $e) {
			$result = [
				'exception_message' => $e->getMessage()
			];
			return view('errors.error', $result);
		}
	}
	
	public function getAddNewUser()
	{
		
		try
		{
			$active = 'add-new';
		//	$companies = Company::where('status',1)->lists('name','id')->toArray();
			return view('admin.user.addNewUser', compact('active'));
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
	  * Save the user's data in storage.
      * @param int $id            
      * @return Response
	  * Created on: 21/8/2015
	  * Updated on: 21/8/2015
	**/
	
	public function postAddNewUser(Requests\AdminNewUser $request)
	{
	
		
		try
		{
			
			//generate random code
			$confirmation_code= str_random(30);
			$newUser= new User($request->all());
			$newUser->password= Hash::make($newUser->password);
			$newUser->email_verification_code= $confirmation_code; //Save confirmation code
			$newUser->role= 2;
			$newUser->name = lcfirst($request->name);
			//$newUser->company_id = lcfirst($request->company);
			$newUser->phone = lcfirst($request->phone);
			$newUser->email = lcfirst($request->email);
			//Dynamic Email Template
			$template=EmailTemplate::find(39);
			$link="<a href='". url('register/verify/'.$newUser->email_verification_code)."'>Click here</a>";
			$find=array('@name@','@email@','@password@','@Click here@','@sitename@');
			$values=array($newUser->name,$newUser->email,$request->password,$link,config('app.website_name'));
			$body=str_replace($find,$values,$template->content);

			if($newUser->save())
			{	
				//Send Mail
				Mail::send('emails.verify', array('content'=>$body), function($message) use($template)
					{
						$message->to(Input::get('email'))
								->subject($template->subject);
								
					});

				flash()->success("A new user has been added successfully. An email notification has been sent to user's registered email address.");
			}
			else{
				flash()->error('Sorry, something went wrong');
			}
		
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active'=>'dashboard'
            ];
			return view('errors.error', $result);
        }
		return redirect(getenv('adminurl').'/dashboard/users');
	}
	
	
	
	/*
	 * Edit user function
	 * by Jagraj Singh
	 * 18 july 2016
	 * 
	 * 
	 * 
	 * 
	 * */
	public function getEdituser($id)
	{
		
		 try
		{
		$user_id = \Crypt::decrypt($id);
        $active= 'users';
        
			$user = User::findOrfail($user_id);
         return view('admin.user.edit', compact('active','user'));
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'users'
            ];
			return view('errors.error', $result);
        }
		
		
		
		}
		
		public function patchUpdateuser(Requests\AdminUserEdit $request, $id)
		{
			$user_id = \Crypt::decrypt($id);
			   $data = $request->all();
			$user= User::findOrfail($user_id);
			$user->status = $data['status'];
			 $user->update($data);
			return redirect(getenv('adminurl').'/dashboard/users');
		}
		
	
	
	
}
