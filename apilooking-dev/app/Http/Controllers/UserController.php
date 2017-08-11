<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfileModel; 
use App\Models\ViewerModel; 
use App\Models\BlockUserModel; 
use App\Models\UserLooksexModel; 
use App\Models\MatchFilterModel; 
use App\Models\ShareAlbumModel; 
use App\Models\UserIdentityModel; 
use App\Models\NoteModel; 
use App\Models\FavouriteModel; 
use App\Models\BlockChatUserModel; 
use App\Models\ProfileLockModel; 
use App\Models\ChatModel; 
use App\Models\UserLookdateModel; 
use App\Models\UseralbumModel; 

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
use Log;
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
    public function postUserProfile(Request $request,Repositary $common)
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
            if(isset($data['birthday']))
            {
                $data['age']=Carbon::now()->diffInYears(Carbon::parse($data['birthday']));
            }
            
            if(empty($chk))
            {

            	$data['user_id'] = $clientId; 
                User::where(array('id'=>$clientId))->update(['is_completed'=>$finish, 'registration_status'=>2]);
                if(ProfileModel::create($data))
                {
                    $IdentityData = $common->saveIdentites($request->identity,$request->his_identitie,$clientId);
                    UserIdentityModel::Insert($IdentityData);
                }
                
                $response['success'] = 1;
                $response['message'] = 'Data has been successfully saved';
                $http_status = 200;
            }
            else
            {
            	if(ProfileModel::where(['user_id'=>$clientId])->update($data))
            	{
                    UserIdentityModel::where(array('user_id'=>$clientId))->delete();
                    $IdentityData = $common->saveIdentites($request->identity,$request->his_identitie,$clientId);
                    UserIdentityModel::Insert($IdentityData);
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
         //Log::info('Showing user profile for user: '.JWTAuth::parseToken()->authenticate()->id);
        $validator = Validator::make( $request->all(),[
            'age_to' => 'custom_height:'.Input::get('age_from'),
            'height_cm_to' => 'custom_height:'.Input::get('height_cm_from'),
            'weight_cm_to' => 'custom_height:'.Input::get('weight_cm_from')
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
    	$is_view = $is_share = $is_profile_active = $total_unread_message =  0;
        $filter_cache =[];
        $block_id = [];
        $user =User::where('status','!=',0)->where('role',2);
        
        /******Blocked User********/
        $block_user_id = BlockUserModel::where(function($q) use ($clientId){
            $q->orWhere(array('blocked_id'=>$clientId))
              ->orWhere(array('user_id'=>$clientId))
              ->select('id');
        })
        ->select('id','user_id','blocked_id')
        ->get();

        foreach($block_user_id As $k =>$value)
        {
            if($value['user_id']==$clientId)
                $block_id[] = $value['blocked_id'];

            if($value['blocked_id'] == $clientId)
                $block_id[] = $value['user_id'];
        }

        


        /******End********/

        //======get limit for free user or paid user==//
        $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type,'Match');
        $limit = $limit - 1;

        /********Search Filters*********/
        $data = $request->all();
        $finalArr = [];
        if(count($data))
        {
            $arrKey = array_keys($data);
            $arrValue = array_values($data);
            $finalArr = array_combine($arrKey,$arrValue);
        }

        /********Search With username and profile Id*********/
        
        if(isset($finalArr['search_value']))
        {
            $user = $user->where(function($q) use($finalArr){
                $q->orWhere('screen_name','like','%'.$finalArr['search_value'].'%')
                  ->orWhere('profile_id','like','%'.$finalArr['search_value'].'%');
            }); 
        }
        /********End*********/
        Log::info('Showing user profile for user: '.json_encode($finalArr));
        if(isset($finalArr['type']) && $request->Input('type')=='browse')   
        {
            /*$response['success'] = 1;
            $response['data'] =  $request->Input('profile_pic_type');
            $http_status = 200;
            return response()->json($response,$http_status);*/
            //Log::info('Showing user profile for user: '.$request->all());
            /*if(count($data1))
            {
                $arrKeys = array_keys($data1);
                $arrValue = array_values($data1);
                $arrCombine = array_combine($arrKeys, $arrValue);
                
            }*/

            /*if($request->Input('filter')=='on')
            {*/
                /********Search By profile pic*********/
                if(isset($finalArr['profile_pic_type']) && $finalArr['profile_pic_type'] != 'Not Set')
                {
                    $user = $user->whereIn('profile_pic_type',[$finalArr['profile_pic_type']]); 
                } 
                /********End*********/

                /********Search By relationshiptype*********/
                if(isset($finalArr['relationship_status']) && $finalArr['relationship_status'] != 'Not Set')
                {
                    $user = $user->whereHas('Profile',function($q) use ($finalArr){
                        $q->where('relationship_status',$finalArr['relationship_status']);
                    });
                }

                /********Search by Ethnicity*********/
                if(isset($finalArr['ethnicity']) && $finalArr['ethnicity'] != 'Not Set')
                {
                    $user = $user->whereHas('Profile',function($q) use ($finalArr){
                        $q->where('ethnicity',$finalArr['ethnicity']);
                    }); 
                }
                /********End*********/

                /********Search By age*********/
                if(isset($finalArr['age_to']) && isset($finalArr['age_from']) && $finalArr['age_to'] != 'Not Set' && $finalArr['age_from'] != 'Not Set')
                {
                    /********Common function to check age*********/
                    $user = $user->whereHas('Profile',function($q) use ($finalArr){
                        $q->whereBetween('age',[$finalArr['age_to'],$finalArr['age_from']]);
                    });
                }
                /********End*********/

                /********Search By height*********/
                if(isset($finalArr['height_cm_to']) && isset($finalArr['height_cm_from']) && $finalArr['height_cm_to'] != 'Not Set' && $finalArr['height_cm_from'] != 'Not Set')
                {
                    /********Common function to check height*********/
                    $user = $user->whereHas('Profile',function($q) use ($finalArr){
                        $q->whereBetween('height_cm',[$finalArr['height_cm_to'],$finalArr['height_cm_from']]);
                    });
                }
                /********End*********/

                /********Search By weight*********/
                if(isset($finalArr['Weight_kg_to']) && isset($finalArr['Weight_kg_from']) && $finalArr['Weight_kg_to'] != 'Not Set' && $finalArr['Weight_kg_from'] != 'Not Set')
                {
                    /********Common function to check weight*********/
                    $user = $user->whereHas('Profile',function($q) use ($finalArr){
                        $q->whereBetween('weight_kg',[$finalArr['Weight_kg_to'],$finalArr['Weight_kg_from']]);
                    });
                }            
                /********End*********/     

                /********Search By identities*********/
                if(isset($finalArr['his_identitie']) && $finalArr['his_identitie'] != 'Not Set')
                {
                    $user = $user->whereHas('UserIdentity',function($q) use ($finalArr){
                        $q->whereIn('name',explode(',', $finalArr['his_identitie']))
                          ->where(array('type'=>'identity'));
                    });
                }
                /********End*********/

                /********Search By his itentites*********/
                if(isset($finalArr['his_seeking']) && $finalArr['his_seeking'] != 'Not Set')
                {
                    $user = $user->whereHas('UserIdentity',function($q) use ($finalArr){
                        $q->whereIn('name',explode(',', $finalArr['his_seeking']))
                          ->where(array('type'=>'his_identites'));
                    });
                }
                /********End*********/

                if(isset($finalArr['online']) && $finalArr['online_status'] != 'Not Set')
                {
                    //active before one hour
                    if($finalArr['online_status'] == 1)
                    {
                        $user = $user->where(array('online_status'=>2))->where('updated_at','<=',Carbon::now())->where('updated_at','>=',Carbon::now()->subHours(1));
                    }
                    //active before more than 1 hour
                    else if($finalArr['online_status'] == 2)
                    {
                        $user = $user->where(array('online_status'=>2))->where('updated_at','<=',Carbon::now()->subHours(1))->where('updated_at','>=',Carbon::now()->subHours(24));
                    }
                }
            /*}*/
            
            $if_exist_save_filter = MatchFilterModel::where(['user_id'=>$clientId,'type'=>'browse'])->first();
            
            if ($if_exist_save_filter) {
                $filter_cache = $if_exist_save_filter;
            }
        }    

        /******Get result for all User with chat, profile of user********/
        $user_data = $user->with(['ChatUsers','Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity'])
                            ->where(['registration_status'=>3])
                            ->whereNotIn('id',$block_id)
                            ->where('id','!=',$clientId)
                            ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));
        $user_data = $user_data->limit($limit)
        ->orderBy('distance','ASC')
        ->get(); 

        $user_data1 = $user_data;
        Log::info('Output: '.json_encode($user_data1->toArray()));
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
                /*$user_data[$key]['distance1'] = $common->distance(floatval(JWTAuth::parseToken()->authenticate()->lat), floatval(JWTAuth::parseToken()->authenticate()->long), floatval($value->lat), floatval($value->long), 'M');*/
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
        	$response['data'] =  ['is_share_album' => $is_share, 'is_viewed' => $is_view, 'total_unread_message' => $total_unread_message, 'total_view_and_share' => $total_view_and_share, 'user_looking_profile_active' => $is_profile_active, 'accuracy' => $accuracy_max_value, 'login_user_member_type' => JWTAuth::parseToken()->authenticate()->member_type, 'login_user_removead' => JWTAuth::parseToken()->authenticate()->removead, 'login_user_is_trial' => JWTAuth::parseToken()->authenticate()->is_trial, 'userlooksex_data' => $user_looksexdata, 'user' => $user_data,'filter_cache'=>$filter_cache];
        	$http_status = 200;   
            $d1 = $response['data'];
            Log::info('Response: '.json_encode($d1));
        }
        else
        {
        	$response['success'] = 0;
        	$response['message'] = ['data not found'];
        	$http_status = 400;

            Log::info('Response: '.json_encode($response['message']));
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
    public function getUserProfileDetail(Request $request, Repositary $common)
    {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $viewer_id = '';
        if($request->Input('viewer_user_id'))
        {
            $viewer_id = $request->Input('viewer_user_id');
        }
        $userdata = User::with('Profile')->where(['id'=>$viewer_id,'status'=>1])->first();
        if(!empty($clientId) && !empty($viewer_id))
        {
            $Userdetails=[];
            $viewDetail = ViewerModel::where(array('user_id'=>$clientId,'viewer_user_id'=>$viewer_id))->first();
            if ($clientId == $viewer_id) {
                $is_view_profile = 0;
            } else {
                $is_view_profile = 0; //change later not deliver red dot notification
            }
            if(count($viewDetail)==0)
            {
                $data['user_id'] = $clientId;
                $data['viewer_user_id'] = $viewer_id;
                $data['is_view'] = $is_view_profile;
                ViewerModel::create($data);
            }
            else
            {
                $data['user_id'] = $clientId;
                $data['viewer_user_id'] = $viewer_id;
                $data['is_view'] = $is_view_profile;
                $viewDetail->update($data);
            }

            $profile = User::with(['Profile','UserIdentity'])->where(array('id'=>$viewer_id))->first();
            if($profile && $clientId)
            {
                $profile['Profile']['description'] = '';
                $viewer_lat = $profile['lat'];
                $viewer_long = $profile['long'];
                $distance = $common->distance(JWTAuth::parseToken()->authenticate()->lat, JWTAuth::parseToken()->authenticate()->long, $viewer_lat, $viewer_long, 'M');
                if (is_nan($distance) == 1) {
                    $distance = 0;
                }

                $Userdetails['Note'] = array();
                $Userdetails['User'] = array();
                $Userdetails['Profile'] = array();
                $Userdetails['Distance'] = array('miles' => $distance);
                $Userdetails['Favourite'] = array();
                $Userdetails['Viewer_Favourite'] = array();
                $Userdetails['User_Share_Album'] = array(); 
                $Userdetails['Viewer_Share_Album'] = array();
                $Userdetails['Match_Persent'] = array();
                $Userdetails['User_Profile_Lock'] = array();
                $Userdetails['View_User_Profile_Lock'] = array();
                $Userdetails['Over_All_Percentage'] = '';
                $Userdetails['traits'] = '';
                $Userdetails['interest'] = '';
                $Userdetails['physicial_appearance'] = '';
                $Userdetails['sextual_preferences'] = '';
                $Userdetails['social_habits'] = '';
                $Userdetails['identity'] = '';
                $Userdetails['Block_Chat'] = array();
                $Userdetails['Block_Chat_View_User'] = array();
                $Userdetails['Looksex_Profile_Active'] = array();
                $Userdetails['User_Looksex_Profile_Active'] = array();
                $Userdetails['User_Invitation'] = array();
                $Userdetails['Viewer_Invitation'] = array();
                $Userdetails['Lookdate_Profile_Active'] = array();
                $Userdetails['User_Lookdate_Profile_Active'] = array();
                $sharealbum = ShareAlbumModel::where(array('sender_id'=>$clientId,'receiver_id'=>$viewer_id,'is_received'=>1))->first();
                if(count($sharealbum))
                {
                    $Userdetails['User_Share_Album'] = $sharealbum->toArray();
                }
                
                $Viewer_sharealbum = ShareAlbumModel::where(array('sender_id'=>$viewer_id,'receiver_id'=>$clientId,'is_received'=>1))->first();
                if(count($Viewer_sharealbum))
                {
                    $Userdetails['Viewer_Share_Album'] = $Viewer_sharealbum->toArray();

                    $Profile_pic = array(
                        array(
                            'id' => 'profile_pic',
                            'user_id' => $viewer_id,
                            'photo_name' => $profile['profile_pic'],
                            'caption' => '',
                            'album_type' => $profile['profile_pic_type'],
                            'creation_date' => $profile['profile_pic_date']
                    ));

                    $album = UseralbumModel::where(['user_id'=>$viewer_id])->orderBy('album','ASC')->get();
                    //pr($album);
                    if ($album) {
                        $album_picture = $album->toArray();
                        $Userdetails['Viewer_Share_Album']['album_images'] = array_merge($Profile_pic, $album_picture);
                    } else {
                        $Userdetails['Viewer_Share_Album']['album_images'] = $Profile_pic;
                    }
                }
                $note = NoteModel::where(['user_id'=>$clientId,'note_user_id'=>$viewer_id])->first();
                if ($note) {
                    $Userdetails['Note'] = $note['note'];
                } else {
                    $Userdetails['Note'] = '';
                }
                
                $favourite = FavouriteModel::where(['user_id'=>$clientId,'favourite_user_id'=>$viewer_id,'is_favourite'=>1])->first();
                    if ($favourite) {
                        $Userdetails['Favourite'] = $favourite->toArray();
                    }
                    
                $viewer_favourite = FavouriteModel::where(['user_id'=>$viewer_id,'favourite_user_id'=>$clientId,'is_favourite'=>1])->first();
                if ($viewer_favourite) {
                    $Userdetails['Viewer_Favourite'] = $viewer_favourite->toArray();
                }
                
                $block_chat = BlockChatUserModel::where(['user_id'=>$clientId,'block_user_id'=>$viewer_id])->first();
                if ($block_chat) {
                    $Userdetails['Block_Chat'] = $block_chat->toArray();
                }
                
                $block_chat_view = BlockChatUserModel::where(['user_id'=>$viewer_id,'block_user_id'=>$clientId])->first();
                if ($block_chat_view) {
                    $Userdetails['Block_Chat_View_User'] = $block_chat_view->toArray();
                }
                
                $check_looksex_profile = UserLooksexModel::where(['user_id'=>$viewer_id])->where(function($q){
                    $q->where('start_time','<=',Carbon::now())
                      ->where('end_time','>=',Carbon::now());
                })->first();
                

                if (count($check_looksex_profile) > 0) {
                    $check_looksex_active = 1;
                } else {
                    $check_looksex_active = 0;
                
                    ChatModel::where(array('user_id'=>$viewer_id))->update(['invite'=>0]);

                
                    $delete_lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'is_locked'=>1,'browse'=>'looking'])->first();
                    if ($delete_lock_profile) {
                        ProfileLockModel::where(['id'=>$delete_lock_profile->id])->delete();
                    }
                
                }
                $Userdetails['Looksex_Profile_Active'] = $check_looksex_active;
                
                $check_user_looksex_profile = UserLooksexModel::where(['user_id'=>$clientId])->where(function($q){
                    $q->where('start_time','<=',Carbon::now())
                      ->where('end_time','>=',Carbon::now());
                })->first();

                if (count($check_user_looksex_profile) > 0) {
                    $check_user_looksex_active = 1;
                } else {
                    $check_user_looksex_active = 0;
                
                    ChatModel::where(array('user_id'=>$clientId))->update(['invite'=>0]);
                    
                     $delete_lock_profile = ProfileLockModel::where(['user_id'=>$viewer_id,'is_locked'=>1,'browse'=>'looking'])->first();
                    if ($delete_lock_profile) {
                        ProfileLockModel::where(['id'=>$delete_lock_profile->id])->delete();
                    }
                }
                $Userdetails['User_Looksex_Profile_Active'] = $check_user_looksex_active;
               
            
                if (isset($type) && $type == 'looking_sex') {
               
                    $lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'lock_user_id'=>$viewer_id,'is_locked'=>1,'browse'=>'looking'])->first();

                    if ($lock_profile) {
                        $Userdetails['User_Profile_Lock'] = $lock_profile->toArray();
                    }
               
                    $lock_profile_view_user = ProfileLockModel::where(['lock_user_id'=>$clientId,'user_id'=>$viewer_id,'is_locked'=>1,'browse'=>'looking'])->first();
                    if ($lock_profile_view_user) {
                        $Userdetails['View_User_Profile_Lock'] = $lock_profile_view_user->toArray();
                    }
                } else {
               
                    $lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'lock_user_id'=>$viewer_id,'is_locked'=>1])->where('browse','!=','looking')->first();
                    
                    if ($lock_profile) {
                        $Userdetails['User_Profile_Lock'] = $lock_profile->toArray();
                    }
                
                    $lock_profile_view_user = ProfileLockModel::where(['lock_user_id'=>$clientId,'user_id'=>$viewer_id,'is_locked'=>1])->where('browse','!=','looking')->first();
                    if ($lock_profile_view_user) {
                        $Userdetails['View_User_Profile_Lock'] = $lock_profile_view_user->toArray();
                    }
                }
                $UserLookdate = UserLookdateModel::where(['user_id'=>$viewer_id])->get();
                if (count($UserLookdate) > 0) {
                    $check_lookdate_active = 1;
                } else {
                    $check_lookdate_active = 0;
                }
                $Userdetails['Lookdate_Profile_Active'] = $check_lookdate_active;
                
                $UserLookdate = UserLookdateModel::where(['user_id'=>$clientId])->get();
                if (count($UserLookdate) > 0) {
                    $check_user_lookdate_active = 1;
                } else {
                    $check_user_lookdate_active = 0;
                }
                $Userdetails['User_Lookdate_Profile_Active'] = $check_user_lookdate_active;
                
                $chat_invitation = ChatModel::where(['user_id'=>$clientId,'chat_user_id'=>$viewer_id])->first();
                if ($chat_invitation) {
                    $Userdetails['User_Invitation'] = $chat_invitation->toArray();
                }

                $chat_invitation_viewer = ChatModel::where(['user_id'=>$viewer_id,'chat_user_id'=>$clientId])->first();    
                if ($chat_invitation_viewer) {
                    $Userdetails['Viewer_Invitation'] = $chat_invitation_viewer->toArray();
                }
             
                $user_his_identity = UserIdentityModel::where(['user_id'=>$clientId,'type'=>'his_identites'])->get();
                $identity_percent_permatch = $match_identity = 0;
                if(count($user_his_identity))
                {
                    $identity_percent_permatch = 100 / count($user_his_identity);
                }
                $match_identity = 0;
                
                $viewer_identity = UserIdentityModel::where(['user_id'=>$clientId,'type'=>'identity'])->get();
               
                $identity = array();
                $traits = array();
                $interest = array();
                $physicial_appearance = array();
                $sextual_preferences = array();
                $social_habits = array();

                if($user_his_identity && $viewer_identity)
                    foreach ($user_his_identity as $key => $value) {
                        foreach ($viewer_identity as $key1 => $value1) {
                            if (trim(strtolower($value)) == trim(strtolower($value1))) {
                                $match_identity++;
                                $identity[] = trim($value);
                            }
                        }
                    }
                
               $identity_percentage = round($identity_percent_permatch * $match_identity);
               

                if(isset($type) && $type = 'looking_date')
                {

                }
                else if(isset($type) && $type= 'looking_sex')
                {

                }
                else
                {
                    $Userdetails['User'] = $profile;
                }

                $response['success'] = 1;
                $response['message'] = 'success';
                $Userdetails['login_user_member_type'] = JWTAuth::parseToken()->authenticate()->member_type;
                $Userdetails['login_user_removead'] = JWTAuth::parseToken()->authenticate()->removead;
                $Userdetails['login_user_is_trial'] = JWTAuth::parseToken()->authenticate()->idis_trial;
                $Userdetails['chat_history_limit'] = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'chat_history');
                $response['data'] = $Userdetails;
                $http_status = 200;
                
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = 'user id or viewer user id not valid';
                $http_status = 400;
            }

        }  
        else
        {
            $response['success'] = 0;
            $response['message'] = 'user id or viewer user id not found';
            $http_status = 400;
        }  

        return response()->json($response,$http_status);
    }

    /**
     * Name: postFilterCache
     * Purpose: function for save and update the fliter value
     * created By: Lovepreet
     * Created on :- 8 Aug 2017
     *
     **/
    public function postFilterCache(Request $request) {
       
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
        if(!empty($clientId) && !empty($data['type']))
        {
            $data['user_id'] = $clientId;
            $chk = MatchFilterModel::where(array('user_id'=>$clientId,'type'=>$data['type']))->first();
            if(count($chk))
            {
                if($chk->update($data))
                {
                    $response['success'] = 1;
                    $response['message'] = 'success';
                    $response['data'] = $data['type'];
                    $http_status = 200;
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = 'unable to update';
                    $http_status = 400;
                }
            }
            else
            {
                if(MatchFilterModel::create($data))
                {
                    $response['success'] = 1;
                    $response['message'] = 'success';
                    $http_status = 200;
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = 'unable to update';
                    $http_status = 400;
                }
            }
        }
        else
        {
            $response['success'] = 0;
            $response['message'] = 'user id  and type  should not blank';
            $http_status = 400;
        }
        return response()->json($response,$http_status);
    }

}
