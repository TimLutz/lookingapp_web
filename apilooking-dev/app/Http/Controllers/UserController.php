<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfileModel; 
use App\Models\ViewerModel; 
use App\Models\BlockUserModel; 
use App\Models\UserLooksexModel; 

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
	
     /**
     * Name: ForgetPassword
     * Purpose: function for user forgot our password
     * created By: Lovepreet
     * Created on :- 1 Aug 2017
     *
     **/

	public function ForgetPassword(Request $request)
	{
		
		
		$validator = Validator::make( $request->all()  ,      [
			'email' => 'required|email|exists:users',
		],
        [
            'email.required' => 'Please enter your registered email.',
            'email.email'    => 'Please enter valid email.',
            'email.exists'   =>  'Email doesn`t exist in the our record.'  
        ]);
		if ($validator->fails()) {
			$response['errors'] 	= $validator->errors();
			$response['success']		= 422;
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

	/**
     * Name: postUserProfile
     * Purpose: function for update and create  user basic profile
     * created By: Lovepreet
     * Created on :- 1 Aug 2017
     *
     **/
    public function postUserProfile(Request $request)
    {
      $data = $request->all();	
      $validator = Validator::make( $data  ,      [
             'identity'            => 'required',
             'ethnicity'           => 'required', 
             'birthday'            => 'required|date_format:"Y-m-d"', 
             'height'              => 'required', 
             'weight'              => 'required',
             //'about_me'            => 'required|Min:5|Max:500',
             'his_identitie'       => 'required',
             'relationship_status' => 'required',
             'birthday'            => 'age_restriction' 
        ],
        [
           'identity.required'            =>  'Please enter your Identity.',
           'ethnicity.required'           =>  'Please enter your ethnicity.',
           'birthday.required'            =>  'Please enter birthday.',
           'birthday.date_format'         =>  'Please enter valid format.',
           'height.required'              =>  'Please enter height.',
           'weight.required'              =>  'Please enter weight.',
           'his_identitie.required'       =>  'Please enter his identity.',
           'relationship_status.required' =>  'Please enter relationship status.',
           'birthday.age_restriction'     =>  'Age must be greater then 18 years.' 
        ]
        );

        if ($validator->fails()) {
            $response['success']   = 0;
            $response['errors']   = $validator->errors();
            $http_status=422;

        }else{
            $clientId=JWTAuth::parseToken()->authenticate()->id;
        	$data = $request->all();
        	$is_completed = 0;
        	foreach($data AS $k => $val)
        	{
        		if(trim($val)=='')
        			$is_completed = 0;

        	}
        	$finish = ($is_completed == 0) ? 1 : 0;
            $chk = ProfileModel::where(array('user_id'=>$clientId))->first();
            if($data['birthday'])
            {
                $data['age']=Carbon::now()->diffInYears(Carbon::parse($data['birthday']));
            }
            print_r($data); die;
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
        return response()->json($response,$http_status);
    }

     /**
     * Name: postProfilePicture
     * Purpose: function for update profile photo
     * created By: Lovepreet
     * Created on :- 1 Aug 2017
     *
     **/
    public function postProfilePicture(Request $request)
    {
    	$data = $request->all();
        //print_r($data); die;
        $validator = Validator::make( $data  ,      [
            'profile_pic_type'         => 'required|numeric',
            'profile_pic'              => 'required',
            'profie_type'              =>  'required'
        ],
        [
            'profile_pic_type.required'  => 'Please enter profile picture type.',
            'profile_pic_type.numeric'   => 'Profile pic type must be numeric.',
            'profile_pic.required'       => 'Please enter image.',
            'profile_type.required'      => 'Please enter profile type.'  
        ]
        );       
        if ($validator->fails()) {
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
	            		if($user->update($data))
	            		{
	            			$response['success'] = 1;
			                $response['message'] = 'Profile picture has been successfully uploaded';
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
    
    /**
     * Name: postUpdateAfterLogin
     * Purpose: function for Lat Long update after user login
     * created By: Lovepreet
     * Created on :- 1 Aug 2017
     *
     **/
    public function postUpdateAfterLogin(Request $request,Repositary $common)
    {
    	$clientId = JWTAuth::parseToken()->authenticate()->id; 
    	if($clientId)
    	{
    		$userDetail = User::where(['id'=>$clientId])->first();
    		if ($userDetail->status == 0) {
                   $response['success'] = -1;
                   $response['msg'] = 'inactive user';
                   $http_status = 400;
                   return response()->json($response,$http_status);
            }
            $valid_upto = $userDetail->valid_upto;
            $removead_valid_upto = $userDetail->removead_valid_upto;
            if ($userDetail->member_type == 1) {
                if (date('Y-m-d') > $valid_upto) {
                    die('member');
                    $userDetail->update(['member_type'=>0,'is_trial'=>0]);
                    //=====Expire loking profile====//
                    $newTime = date("Y-m-d H:i:s", strtotime(Carbon::now() . " -1 minutes"));

                    //$this->UserLooksex->saveField('end_time', $newTime);
                    /*$this->UserLooksex->updateAll(
                            array('UserLooksex.end_time' => "'" . $newTime . "'"), array('UserLooksex.user_id' => $user_id)
                    );*/

                }
            }
            if ($userDetail->removead == 1) {
                if (date('Y-m-d') > $removead_valid_upto) {
                    $this->User->updateAll(
                            array('User.removead' => 0), array('User.id' => $user_id)
                    );
                    $userDetail->update(['removead'=>0]);
                }
            }

            if ($clientId && $request->lat && $request->long && $request->accuracy) {
	            $userdetailsupdate  = User::where(['id'=>$clientId,'status'=>1])->first();

	            if ($userdetailsupdate) {
	                $data = $request->all();
	                $data['accuracy'] = (int) $data['accuracy'];
	                /*                 * ****** update field for online ******** */
	                $userdetailsupdate->update($data) ;
	            }
	        }

    	}

    }

    /**
     * Name: getFilterValue
     * Purpose: function for search the with and without filter
     * created By: Lovepreet
     * Created on :- 3 Aug 2017
     *
     **/
    public function getFilterValue(Request $request,Repositary $common)
    {
    	//print_r($request->header()); die;
        $validator = Validator::make( $request->all(),[
            'age_to' => 'numeric|custom_height:'.Input::get('age_from'),
            'height_cm_to' => 'numeric|custom_height:'.Input::get('height_cm_from'),
            'weight_cm_to' => 'numeric|custom_height:'.Input::get('weight_cm_from'),
            'age_from' =>'numeric'

        ],
        [
            'height_cm_to.custom_height' => 'Please select height to option less then height from option.', 
            'weight_cm_to.custom_height' => 'Please select weight to option less then weight from option.', 
            'age_to.custom_height' => 'Please select age to option less then age from option.' 
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else{

    	$clientId = JWTAuth::parseToken()->authenticate()->id;
    	$current_date = Carbon::now();
    	$is_view = $is_share = $is_profile_active = $total_unread_message = 0;

        $user =new User;
        
        /******Blocked User********/
        $block_user_id = BlockUserModel::where(function($q) use ($clientId){
            $q->orWhere(array('blocked_id'=>$clientId))
              ->orWhere(array('user_id'=>$clientId))
              ->select('id');
        })->get()->toArray();
        /******End********/

        //======get limit for free user or paid user==//
        $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type,'Match');
        $limit = $limit - 1;

        /********Search Filters*********/

        /********Search With username and profile Id*********/
        if($request->Input('search_value'))
        {
            $user = $user->where(function($q) use($request){
                $q->orWhere('screen_name','like','%'.$request->search_value.'%')
                  ->orWhere('profile_id','like','%'.$request->search_value.'%');
            }); 
        }
        /********End*********/

        if($request->Input('online_status'))
        {
            //active before one hour
            if($request->online_status == 1)
            {
                $user = $user->where(array('online_status'=>2))->where('updated_at','<=',Carbon::now())->where('updated_at','>=',Carbon::now()->subHours(1));
            }
            //active before more than 1 hour
            else if($request->Input('online_status') == 2)
            {
                $user = $user->where(array('online_status'=>2))->where('updated_at','<=',Carbon::now()->subHours(1))->where('updated_at','>=',Carbon::now()->subHours(24));
            }
        }

        if($request->Input('type')=='browse')   
        {
            if($request->Input('filter')=='on')
            {
                /********Search By profile pic*********/
                if($request->Input('profile_pic_type'))
                {
                    $user = $user->whereIn('profile_pic_type',$request->profile_pic_type); 
                } 
                /********End*********/

                /********Search By relationshiptype*********/
                if($request->Input('relationship_status'))
                {
                    $user = $user->whereHas('Profile',function($q) use ($request){
                        $q->where('relationship_status',$request->registration_status);
                    });
                }

                /********Search by Ethnicity*********/
                if($request->Input('ethnicity'))
                {
                    $user = $user->whereHas('Profile',function($q) use ($request){
                        $q->where('ethnicity',$request->ethnicity);
                    }); 
                }
                /********End*********/

                /********Search By age*********/
                if($request->Input('age_to') && $request->Input('age_from'))
                {
                    /********Common function to check age*********/
                    $user = $user->whereHas('Profile',function($q) use ($request){
                        $q->whereBetween('age',[$request->Input('age_to'),$request->Input('age_from')]);
                    });
                }
                /********End*********/

                /********Search By height*********/
                if($request->Input('height_cm_to') && $request->Input('height_cm_from'))
                {
                    /********Common function to check height*********/
                    $user = $user->whereHas('Profile',function($q) use ($request){
                        $q->whereBetween('height_cm',[$request->Input('height_cm_to'),$request->Input('height_cm_from')]);
                    });
                }
                /********End*********/

                /********Search By weight*********/
                if($request->Input('Weight_kg_to') && $request->Input('Weight_kg_from'))
                {
                    /********Common function to check weight*********/
                    $user = $user->whereHas('Profile',function($q) use ($request){
                        $q->whereBetween('weight_kg',[$request->Input('Weight_kg_to'),$request->Input('Weight_kg_from')]);
                    });
                }            
                /********End*********/     
            }
        }    

        /******Get result for all User with chat, profile of user********/
        $user_data = $user->with(['ChatUsers','Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner'])
                            ->where(['registration_status'=>3])
                            ->whereNotIn('id',$block_user_id)
                            ->where('id','!=',$clientId)
                            ->where('status','!=',0);

        $user_data = $user_data->limit($limit)->get(); 
        
        if($request->Input('type')=='browse')   
        {
            if($request->Input('filter')=='on')
            {
                //die('cbvcn');
                /** ********check filter for bear bear chaser ********** */
                if ($request->Input('his_identitie')) {

                    $results = array();
                    $his_identitie_value = explode(',', $request->Input('his_identitie'));
                    if ($user_data) {
                        foreach ($user_data as $key => $value) {
                            if(count($value['Profile']))
                            {
                                $identity_value = explode(',', $value['Profile']['identity']);

                                $match_identity = array_intersect($his_identitie_value, $identity_value);
                                
                                if (count($match_identity) > 0) {
                                    $results[] = $user_data[$key];
                                }
                            }
                        }
                    }
                    unset($user_data);
                    $user_data = array();
                    $user_data = $results;
                }
                /* **********END************* */
                
                /********Search By His idenitities*********/
                if ($request->Input('his_seeking')) {
                    $results1 = array();
                    $his_seeking_value = explode(',', $request->Input('his_seeking'));
                    if ($his_seeking_value) {
                        foreach ($user_data as $key => $value) {
                            if(count($value['Profile']))
                            {
                                $identity_value = explode(',', $value['Profile']['his_identitie']);
                                $match_identity = array_intersect($his_seeking_value, $identity_value);
                                if (count($match_identity) > 0) {
                                    $results1[] = $user_data[$key];
                                }
                            }    
                        }
                    }
                    unset($user_data);
                    $user_data = array();
                    $user_data = $results1;
                }
                /********End*********/
            }
        }    

        /********If count greaterthen zreo then successfull message can be done otherwise error message display*********/
        if(count($user_data)) {

            /********check any one view my profile*********/
            $is_view = $common->check_view($clientId);
            /*             * ******End********* */

            /********check any one share album with me*********/
            $is_share = $common->check_sharealbum($clientId);
            /*             * ******End********* */

            /********count total user view my profile*********/
            $count_view = $common->count_view($clientId);
            /*             * ******End********* */

            /********count total user share album with me*********/
            $count_sharealbum = $common->count_sharealbum($clientId);
            $total_view_and_share = $count_view + $count_sharealbum;
            /*             * ******End********* */

            /******check profile active **********/
            $is_profile_active = $common->check_profile_active($current_date, $clientId);  
            /*             * ******End********* */

            /******** Calculates total no. of unread message ******** */
            foreach ($user_data as $key => $value) {
                if(count($value['ChatUsers']))
                {
                	foreach($value['ChatUsers'] As $k => $val)
                	{
                		if($val->invite > 0)
                			$invite = 1;
                		else
                			$invite = 0;

                		$total_unread_message+=($value->count + $invite);
                	}
                }
            	$accuracy_value[] = $value['accuracy'];
            }
            /********End******** */

            /********Get Maximum accuracy for the users.******** */
            if(count($accuracy_value))
            {
               $accuracy_max_value = (int) max($accuracy_value);
            }
            /********End******** */

            /********Calculate Distance between login user and another user ******** */
            foreach ($user_data as $key => $value) {
                $user_data[$key]['distance'] = $common->distance(floatval(JWTAuth::parseToken()->authenticate()->lat), floatval(JWTAuth::parseToken()->authenticate()->long), floatval($value->lat), floatval($value->long), 'M');
                $user_data[$key]['looking_profile_active'] = $common->check_profile_active($current_date, $value->id);
            }
            /********End******** */

            /********for give user looksex data******** */
	        $user_looksexdata = array();
	        $user_looksex = UserLooksexModel::where('user_id',$clientId)
	        								  ->where('start_time','<=',$current_date)
	        								  ->where('end_time','>=',$current_date)
	        								  ->first();
	        if(count($user_looksex))
	        {
	        	$user_looksexdata = $user_looksex;
	        }		
	        //***************END***************//

        	$response['success'] = 1;
        	$response['data'] =  ['is_share_album' => $is_share, 'is_viewed' => $is_view, 'total_unread_message' => $total_unread_message, 'total_view_and_share' => $total_view_and_share, 'user_looking_profile_active' => $is_profile_active, 'accuracy' => $accuracy_max_value, 'login_user_member_type' => JWTAuth::parseToken()->authenticate()->member_type, 'login_user_removead' => JWTAuth::parseToken()->authenticate()->removead, 'login_user_is_trial' => JWTAuth::parseToken()->authenticate()->is_trial, 'userlooksex_data' => $user_looksexdata, 'user' => $user_data];
        	$http_status = 200;   
        }
        else
        {
        	$response['success'] = 0;
        	$response['message'] = ['data not found'];
        	$http_status = 400;
        }
        /********End*********/
        }
        return response()->json($response,$http_status);
    }

    /**
     * Name: getUserProfileDetail
     * Purpose: function for view profile of member
     * created By: Lovepreet
     * Created on :- 5 Aug 2017
     *
     **/
    public function getUserProfileDetail(Request $request)
    {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $viewer_id = '';
        if($request->Input('viewer_user_id'))
        {
            $viewer_id = $request->Input('viewer_user_id');
        }
        $userdata = User::with('Profile')->where(['id'=>$viewer_id,'status'=>1])->first();
        if($clientId != '' && $viewer_id != '')
        {
            $viewDetail = ViewerModel::where(array('user_id'=>$clientId,'viewer_user_id'=>$viewer_id))->first();
            //print_r($viewDetail);die('here');
            if(count($viewDetail)==0)
            {
                $data['user_id'] = $clientId;
                $data['viewer_user_id'] = $viewer_id;
                $data['is_view'] = 1;
                ViewerModel::create($data);
            }

            $profile = User::where(array('id'=>$viewer_id))->get();
            //print_r($profile); die;

            $sharealbum = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $user_id, 'ShareAlbum.receiver_id' => $viewer_user_id, 'ShareAlbum.is_received' => 1)));
                if ($sharealbum) {
                    $Userdetails['User_Share_Album'] = $sharealbum['ShareAlbum'];
                }

        }    

    }



}
