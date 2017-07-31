<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfileModel;
use App\Models\EmailTemplate;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Exceptions\JWTException;  
use Validator;
use App\Http\Repositary\Repositary;
use Illuminate\Support\Str;
use DateTime;
use DB;
use Hash;
use Auth;
use Mail;
use Image;
use Carbon\Carbon;

use Illuminate\Support\Facades\Lang;

class UserController extends Controller {
	
	protected $hashKey;
	
	public function __construct(){
      $this->middleware('jwt.auth', ['except' => ['postLogin','ForgetPassword']]);
    }
    

	  /*********** 
	* created By:Jagraj Singh
	* create date: 15-11-2016
	* Purpose: For fetching user profile date
	* 
	* ********/
	public function profiledata(Request $request){
		
		$user_id = JWTAuth::parseToken()->authenticate()->id;
		$userdata =  User::where('id',$user_id)->first();
		if($userdata)
					{
					$response['userdata'] 	= $userdata;
					$response['message'] 	= 'Success';
           			$response['status']		= 1;
           			
					}
					else{
						$response['errors'] 	= 'Something went wrong.';
						$response['status']		= 0;
					}
					return response()->json($response);
			}

      /*********** 
	* created By:Jagraj Singh
	* create date: 15-11-2016
	* Purpose: change password
	* 
	* ********/
	public function changepassword(Request $request){
		$validator = Validator::make( $request->all(),[
			'password' => 'required',
			'oldpassword' =>'required',
			
			
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			
		$user_id = JWTAuth::parseToken()->authenticate()->id;
		$userdata =  User::where('id',$user_id)->first();
		$oldpassword= $request['oldpassword'];
		$email = $userdata['email'];
		
		$credentials = ["email" => $email,"password" => $oldpassword];
		
		if ($token = JWTAuth::attempt($credentials,array())) {

					 $userdata->password =  Hash::make($request['password']);
		if($userdata->update())
					{
					$response['userdata'] 	= $userdata;
					$response['message'] 	= 'Password changed';
           			$response['status']		= 1;
           			
					}
					else{
						$response['errors'] 	= 'Something went wrong.';
						$response['status']		= 0;
					}
				
				}
		else{
					$response['errors'] 	= 'Please enter a valid current password';
					$response['status']		= 0;
	   	 }
		}
return response()->json($response);
}


  /*********** 
	* created By:Jagraj Singh
	* create date: 15-11-2016
	* Purpose: change password
	* 
	* ********/
	public function changename(Request $request){
		$validator = Validator::make( $request->all(),[
			'name' => 'required',
			
			
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
		$user_id = JWTAuth::parseToken()->authenticate()->id;
		$userdata =  User::where('id',$user_id)->first();
		 $userdata->name =  $request['name'];
		if($userdata->update())
					{
					$response['userdata'] 	= $userdata;
					$response['message'] 	= 'Name changed';
           			$response['status']		= 1;
           			
					}
					else{
						$response['errors'] 	= 'Something went wrong.';
						$response['status']		= 0;
					}
					
			}
return response()->json($response);
}




/*********** 
	* created By:Jagraj Singh
	* create date: 18-11-2016
	* Purpose: For uploading an Image
	* 
	* ********/
	public function uploadimage(Request $request)
	{
		
		$file = Input::file('doc_up');
		
		$info = getimagesize($file);
		// $ratio = $info[0]/$info[1]; // width/height
		  $new_height = $info[1] * (300 / $info[0]);
		
		$timecurrent = time();
		$extension = $file->getClientOriginalExtension(); // getting file extension
		$allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
		$ext=Input::file('doc_up')->getMimeType(); 
		if(in_array($ext,$allowedMimeTypes))
		{
			$filenamethumb = 'thumb_'.$timecurrent. '.' . $extension; // renameing file
		$destinationPaththumb = env('FRONTLINE_URL').'uploads/clients/'.$filenamethumb; // upload path
		 $imagethumb = Image::make($file->getRealPath())->resize(300, $new_height)->save($destinationPaththumb);
		$response['thumb'] = $destinationPaththumb;
		
		if(!empty($file)){
					$destinationPath = env('FRONTLINE_URL').'uploads/clients';
					$fileName = 'userfile_'.$timecurrent. '.' . $extension; 
					$path = $destinationPath . '/' . $fileName;
					$file->move($destinationPath, $fileName);
					
					
					$pathtosave = $destinationPath.'/'.$fileName;
					$client_id = JWTAuth::parseToken()->authenticate()->id;
					$user = User::where('id',$client_id)->first();
					$user->photo = 'uploads/clients/'.$fileName;
					$user->thumb_photo = 'uploads/clients/'.$filenamethumb;
					$updateduser = $user->update();
					
					if($updateduser)
					{
					$response['file_path'] 	= $pathtosave;
					$response['message'] 	= 'Success.';
           			$response['status']		= 1;
           			
					}
					else{
						$response['errors'] 	= 'Something went wrong.';
						$response['status']		= 0;
					}
	        	
				}	
				else{
					$response['errors'] 	= 'File Not found';
						$response['status']		= 0;
				}
		}
			else{
					$response['errors'] 	= 'Only Image is allowed';
						$response['status']		= 0;
				}
		
				
	return response()->json($response);

	}
	

//Function for forget password jobseekers
	//Input request
	// return true if validated without error 
	// craeted_at 11/09/2016

	public function ForgetPassword(Request $request)
	{
		
		
		$validator = Validator::make( $request->all()  ,      [
           
			'email' => 'required|email|exists:users',
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	
			$response['status']		= 0;
        }else{
        	
        		
        		$user=User::where(array('email'=>$request->input('email')))->first();
        		if(!$user){
        			$response['success'] = 0;
        			$response['message'] = 'Email entered doesn`t match our records, please check your email and try again';
        			$http_status = 400;
        		}
        		
        		else{
					
        		$name = User::where('email',$request->email)->pluck('screen_name');
        		$token = hash_hmac('sha256', Str::random(40), $this->hashKey);
        		$email = Input::get('email');
        		$template=EmailTemplate::find(24);
        		 $url = url('../reset-password/'.$token);
        		$link="<a href='$url'>Click here</a>";
			$find=array('@company@','@click here@','@email@','@name@');
			$values=array(env('SITENAME'),$link,$email,$name);
			 $body=str_replace($find,$values,$template->content);

			//Send Mail
			 Mail::send('emails.verify', array('content'=>$body), function($m) use($template)
			{
				$m->to(Input::get('email'))
					->subject($template->subject);
			});
			$user->remember_token = $token;
			$user->update();
        		
        		$response['message']	= 'Recovery password link has been sent on your email address';
				$response['status']		= 1;
				$http_status = 200;
        		
			}
        		
        		
        		
        		

        	
        }
		return response()->json($response);
	}

	/*=====================================
    Function for create profile
    =======================================*/
    public function postUserProfile(Request $request)
    {
      $data = $request->all();	
      $validator = Validator::make( $data  ,      [

            //'start_time'               => 'required|date_format:"Y-m-d H:i:s" ',
            //'end_time'            => 'required|date_format:"Y-m-d H:i:s"',
            //'profile_name'                => 'required|alpha',
            //'location'        => 'required',
            'identity'         => 'required',
            'ethnicity'        => 'required', 
            //'position'        => 'required', 
          //  'behaviour'        => 'required', 
        //    'latitude'        => 'required', 
      //      'longitude'        => 'required', 
       //     'travel_plans'        => 'required', 
       //     'orientation'        => 'required', 
       //     'safe_sex'        => 'required', 
      //      'HIV_status'        => 'required', 
      //      'cock_size'        => 'required', 
    //        'cock_type'        => 'required', 
      //      'kinks_and_fetishes'        => 'required', 
              'birthday'        => 'required|date_format:"Y-m-d"', 
      //      'race'        => 'required', 
              'height'        => 'required', 
       //     'height_cm'        => 'required|numeric',
              'weight'        => 'required',
        //    'Weight_kg'        => 'required',
        //    'hair_color'        => 'required',
        //    'body_hair'        => 'required',
        //    'facial_hair'        => 'required',
        //    'eye_color'        => 'required',
        //    'body_type'        => 'required',
        //    'drugs'        => 'required',
        //    'drinking'        => 'required',
       //     'smoking'        => 'required',
        //    'about_me'        => 'required',
            'his_identitie'        => 'required',
            'relationship_status'        => 'required',
         //   'where_I_leave'        => 'required',

        ]);

        if ($validator->fails()) {

            //$response['errors']   = $validator->errors()->first();
            $response['success']   = 0;
            $response['errors']   = $validator->errors();
            $http_status=422;

        }else{
            $clientId=JWTAuth::parseToken()->authenticate()->id;
            if($clientId)
            {
            	$data = $request->all();
            	/*$hight = explode(',', $data['height']);
            	$weight = explode(',', $data['weight']);*/
            	/*$data['height'] = $hight[0];
            	$data['height_cm'] = $hight[1];
            	$data['weight'] = $weight[0];
            	$data['Weight_kg'] = $weight[1];*/
            	$is_completed = 0;
            	foreach($data AS $k => $val)
            	{
            		if(trim($val)=='')
            		{
            			$is_completed = 0;
            		}
            	}
            	$finish = ($is_completed == 0) ? 1 : 0;
            	//print_r($finish);
                $chk = ProfileModel::where(array('user_id'=>$clientId))->first();
                
                if(empty($chk))
                {
                	$data['user_id'] = $clientId; 
                    User::where(array('id'=>$clientId))->update(['is_completed'=>$finish, 'registration_status'=>2]);
                    ProfileModel::create($data);
                    $response['success'] = 1;
                    $response['message'] = 'Data has been successfully saved';
                    $http_status = 200;
                }
                else
                {
                	//print_r($data); die;
                	if(ProfileModel::where(['user_id'=>$clientId])->update($data))
                	{
	                	if (isset($data['about_me']) && $chk['Profile']['about_me'] != $data['about_me']) {
	                        $ret = User::where(['id'=>$clientId])->update(array('profiletext_change' => 1, 'User.profile_text_change_date' => "'" . Carbon::now() . "'"));
	                    }

	                    $response['success'] = 1;
	                    $response['message'] = 'Data has been successfully updated';
	                    $http_status = 200;
                		
                	}
                	else
                	{

	                    $response['success'] = 0;
	                    $response['message'] = 'Data not updated successfully ';
	                    $http_status = 400;	
                	}
                }
            }
            else
            {
            	$response['success'] = 0;
                $response['message'] = 'error in update';
                $http_status = 400;
            }

        }
        return response()->json($response,$http_status);
    }

    public function postProfilePicture(Request $request)
    {
    	$data = $request->all();
    	$validator = Validator::make( $data  ,      [

            
            'profile_pic_type'         => 'required|numeric',
            'profile_pic'        => 'required',
            'profie_type' =>  'required'
        ]);		 
        if ($validator->fails()) {

            //$response['errors']   = $validator->errors()->first();
            $response['success']   = 0;
            $response['errors']   = $validator->errors();
            $http_status=422;

        }else{
            $clientId=JWTAuth::parseToken()->authenticate()->id;
            if($clientId)
            {
            	if($data['profile_pic_type'] == '')
            		$data['profile_pic_type'] = 0;

            	$data['profile_pic_date'] = Carbon::now();
            	$data['photo_change'] = 1;
            	$data['registration_status'] = 3;
            	if($data['profie_type']=='profile')
            	{
            		unset($data['profie_type']);
            		$user = User::where(array('id'=>$clientId))->first();
            		if($user)
            		{
	            		if($user->where(array('id'=>$clientId))->update($data))
	            		{
	            			$response['success'] = 1;
			                $response['message'] = 'profile picture has been successfully uploaded';
			                $http_status = 200;
	            		}
	            		else
	            		{
	            			$response['success'] = 0;
			                $response['message'] = 'error in update';
			                $http_status = 400;
	            		}
            		}
            		else
            		{
            			$response['success'] = 0;
		                $response['message'] = 'No record found';
		                $http_status = 400;
            		}
            	}
            }
            else
            {
            	$response['success'] = 0;
                $response['message'] = 'error in update';
                $http_status = 400;
            }

        }
        return response()->json($response,$http_status);
    }

    public function getUserProfileDetail(Request $request)
    {
    	/*if(JWTAuth::parseToken()->authenticate()->id)
    	{*/
	    	$id = $request->member_id;
	    	$userdata = User::with('ProfileModel')->where(['id'=>$id,'status'=>1])->first();
	    	print_r($userdata); die;
    	/*}*/
    	
    }

}
