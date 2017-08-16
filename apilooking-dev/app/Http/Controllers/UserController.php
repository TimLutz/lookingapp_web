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
    public function postUpdateLocation(Request $request,Repositary $common)
    {
    	$clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all(); 
    	
		/*$userDetail = User::where(['id'=>$clientId])->first();
		if ($userDetail->status == 0) {
               $response['success'] = 0;
               $response['msg'] = 'inactive user';
               $http_status = 400;
               //return response()->json($response,$http_status);
        }
        $valid_upto = $userDetail->valid_upto;
        $removead_valid_upto = $userDetail->removead_valid_upto;
        if ($userDetail->member_type == 1) {
            if (date('Y-m-d') > $valid_upto) {
                $userDetail->update(['member_type'=>0,'is_trial'=>0]);
                //=====Expire loking profile====//
                $newTime = date("Y-m-d H:i:s", strtotime(Carbon::now() . " -1 minutes"));
            }
        }
        if ($userDetail->removead == 1) {
            if (date('Y-m-d') > $removead_valid_upto) {
                $this->User->updateAll(
                        array('User.removead' => 0), array('User.id' => $user_id)
                );
                $userDetail->update(['removead'=>0]);
            }
        }*/

        $validator = Validator::make( $request->all(),[
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'accuracy' => 'required|numeric'
        ],
        [
            'lat.required' => 'Please enter latitude.', 
            'lat.numeric' => 'Please enter numeric value for latitude.', 
            'long.numeric' => 'Please enter numeric value for longitude.', 
            'long.required' => 'Please enter longitude.', 
            'accuracy.required' => 'Please enter accuracy.', 
            'accuracy.numeric' => 'Accuracy must be numeric.' 
        ]

        );
    
        if ($validator->fails()) 
        {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else
        {
            $userdetailsupdate  = User::where(['id'=>$clientId])->first();

            if ($userdetailsupdate) 
            {
                if($userdetailsupdate['status']==1)
                {
                    $data = $request->all();
                    $data['accuracy'] = (int) $data['accuracy'];
                    if($userdetailsupdate->update($data))
                    {
                        $response['success'] = 1;
                        $response['message'] = 'update successfully';
                        $http_status = 200;
                    }
                    else
                    {
                        $response['success'] = 1;
                        $response['message'] = 'Something wrong';
                        $http_status = 400;
                    }
                }
                else
                {
                   $response['success'] = 0;
                   $response['msg'] = 'inactive user';
                   $http_status = 400;
                }
            }
            else
            {
                $response['success'] = 1;
                $response['message'] = 'No data found.';
                $http_status = 400;
            }
        }
        return response()->json($response,$http_status);
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
            'age_from' => 'custom_height:'.Input::get('age_to'),
            'height_cm_from' => 'custom_height:'.Input::get('height_cm_to'),
            'Weight_kg_from' => 'custom_height:'.Input::get('Weight_kg_to')
        ],
        [
            'height_cm_to.custom_height' => 'Please select height from option less then height to option.', 
            'Weight_kg_to.custom_height' => 'Please select weight from option less then weight to option.', 
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
                    $q->whereBetween('age',[$finalArr['age_from'],$finalArr['age_to']]);
                });
            }
            /********End*********/

            /********Search By height*********/
            if(isset($finalArr['height_cm_to']) && isset($finalArr['height_cm_from']) && $finalArr['height_cm_to'] != 'Not Set' && $finalArr['height_cm_from'] != 'Not Set')
            {
                /********Common function to check height*********/
                $user = $user->whereHas('Profile',function($q) use ($finalArr){
                    $q->whereBetween('height_cm',[$finalArr['height_cm_from'],$finalArr['height_cm_to']]);
                });
            }
            /********End*********/

            /********Search By weight*********/
            if(isset($finalArr['Weight_kg_to']) && isset($finalArr['Weight_kg_from']) && $finalArr['Weight_kg_to'] != 'Not Set' && $finalArr['Weight_kg_from'] != 'Not Set')
            {
                /********Common function to check weight*********/
                $user = $user->whereHas('Profile',function($q) use ($finalArr){
                    $q->whereBetween('Weight_kg',[$finalArr['Weight_kg_from'],$finalArr['Weight_kg_to']]);
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
    public function getUserProfileDetail(Request $request, Repositary $common)
    {
        $validator = Validator::make( $request->all(),[
            'viewer_user_id' => 'required|numeric'
        ],
        [
            'recevier_id.required' => 'Viewer user id not found.', 
            'recevier_id.numeric' => 'viewer user id must be numeric.'
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }
        else
        {
            $clientId = JWTAuth::parseToken()->authenticate()->id;
            $data = $request->all();
            $viewer_id = $data['viewer_user_id'];
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
            if(count($profile))
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
                //$Userdetails['Profile'] = array();
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

                    $album = UseralbumModel::where(['user_id'=>$viewer_id])->orderBy('album_type','ASC')->get();
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
               
                /*************User Itdentity*******************/
                if(isset($type) && $type == 'looking_date')
                {

                }
                else if(isset($type) && $type== 'looking_sex')
                {

                }  /******End*******/
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


    /**
     * Name: postAddFavouriteScreen
     * Purpose: function for save and update the fliter value
     * created By: Lovepreet
     * Created on :- 11 Aug 2017
     *
     **/
    public function postAddFavouriteScreen(Request $request,Repositary $common) {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
        $error = 0;
        $validator = Validator::make( $request->all(),[
            'favourite_user_id' => 'required',
            'browse' => 'required'
        ],
        [
            'viewer_user_id.required' => 'Please provide faviourte user.', 
            'browse.required' => 'Please provide type of user.'
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else{
            //======get limit for free user or paid user==//
            $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'Favorite');
            //=======End============//
           
            $Favorite = FavouriteModel::where(['user_id'=>$clientId,'favourite_user_id'=>$data['favourite_user_id']])->first();

                if ($Favorite) {
                    /** ****** if is_favourite=1 then set is_favourite=2 means unfavourite and if  is_favourite=2 then set is_favourite=1 means favourite*** */
                   
                    if ($Favorite['is_favourite'] == 1) {
                        $is_favourite = 2;
                    } else {
                        $is_favourite = 1;
                    }
                    /** ******** un favourite **************** */
                    $data['user_id'] = $clientId;
                    $data['is_favourite'] = $is_favourite;
                } else {
                    $data['user_id'] = $clientId;
                    $data['is_favourite'] = 1;
                }
            if ($Favorite['is_favourite'] == 1) {
               
                $count_favourite = FavouriteModel::where(['user_id'=>$clientId,'is_favourite'=>1,'browse'=>$data['browse']])->count();
                if ($count_favourite >= $limit) {
                    $response['success'] = 0;
                    $response['message'] = 'You have reached your Favorite limit of ' . number_format($limit) . ' guys. Please remove a Favorite if you would like to add a new one.';
                    $http_status = 400;
                    $error = 1;
                }
            }

            if($error==0)
            {
                if($Favorite)
                {
                    if($Favorite->update($data))
                    {
                        $response['success'] = 1;
                        $response['message'] = 'Success';
                        $http_status = 200;
                    }
                    else
                    {
                        $response['success'] = 0;
                        $response['message'] = 'unable to save into database';
                        $http_status = 200;  
                    }
                }
                else
                {
                    if(FavouriteModel::create($data))
                    {
                        $response['success'] = 1;
                        $response['message'] = 'Success';
                        $http_status = 200;
                    }
                    else
                    {
                        $response['success'] = 0;
                        $response['message'] = 'unable to save into database';
                        $http_status = 400;  
                    }
                }
            }
            
        }
        return response()->json($response,$http_status);
    }


    /**
     * Name: postSentInvitation
     * Purpose: function for sent chat notification
     * created By: Lovepreet
     * Created on :- 12 Aug 2017
     *
     **/   
    public function postSentInvitation(Request $request,Repositary $common) {
        $data = $request->all();
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $validator = Validator::make( $request->all(),[
            'recevier_id' => 'required|numeric',
            'accept' => 'numeric'
        ],
        [
            'recevier_id.required' => 'Recevier user id not found.', 
            'recevier_id.numeric' => 'Recevier id must must be numeric.', 
            'accept.numeric' => 'Accept have only numeric value.'
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else{
            if(!empty($clientId) && !empty($data['recevier_id']))
            {
                if(isset($data['accept']) && $data['accept']==1)
                {
                    $chat_count_message = $common->commonChatUser($clientId,$data['recevier_id']);
                    $chat_count_message1 = $common->commonChatUser($data['recevier_id'],$clientId);
                    if(count($chat_count_message))
                    {
                        if($chat_count_message->update(['count'=>($chat_count_message['count']+1),'created_at'=>carbon::now()]))
                        {
                            $response['success'] = 1;
                            $response['message'] = 'success!';
                            $http_status = 200;
                        }
                        else
                        {
                            $response['success'] = 0;
                            $response['message'] = 'Something wrong!';
                            $http_status = 400;
                        }
                    }

                    if(count($chat_count_message1))
                    {
                       if($chat_count_message1->update(['invite'=>2]))
                       {
                            $response['success'] = 1;
                            $response['message'] = 'success!';
                            $http_status = 200;
                       }
                       else
                       {
                            $response['success'] = 0;
                            $response['message'] = 'Something Wrong!';
                            $http_status = 400;
                       }
                    }

                }
                else
                {
                    $chat_count_message = $common->commonChatUser($clientId,$data['recevier_id']);
                    if(count($chat_count_message))
                    {
                        if($chat_count_message['check_invitaion_sent']==1)
                        {
                            $response['success'] = 0;
                            $response['message'] = 'Already send Invitation to recevier';
                            $http_status = 400;
                        }
                        else
                        {
                            if($chat_count_message->update(['invite'=>1,'check_invitaion_sent'=>1]))
                            {
                                $response['success'] = 1;
                                $response['message'] = 'success';
                                $http_status = 200;
                            }
                            else
                            {
                                $response['success'] = 1;
                                $response['message'] = 'Already send Invitation to recevier';
                                $http_status = 400;   
                            }
                        }
                    }
                    else
                    {
                        $chat_users1 = $common->commonChatUser($data['recevier_id'],$clientId);
                        if(count($chat_users1)==0)
                        {
                            $receiverdata['user_id'] = $data['receiver_id'];
                            $receiverdata['chat_user_id'] = $clientId;
                            ChatModel::create($receiverdata);
                        }
                        $data['user_id'] = $clientId;
                        $data['chat_user_id'] = $data['receiver_id'];
                        $data['invite'] = 1;
                        $data['check_invitaion_sent'] = 1;
                        $data['count'] = 0;
                    }
                }
            }    
        }

        return response()->json($response,$http_status);
        

        
    }


    /**
     * Name: postAddNote
     * Purpose: function for save and update the Note
     * created By: Lovepreet
     * Created on :- 12 Aug 2017
     *
     **/    

    public function postAddNote(Request $request) {

        $validator = Validator::make( $request->all(),[
            'note_user_id' => 'required|numeric',
            'note' => 'required|Min:5|Max:500'
        ],
        [
            'recevier_id.required' => 'Note user id not found.', 
            'recevier_id.numeric' => 'Note id must must be numeric.', 
            'note.min' => 'Note must be less then 5 character.',
            'note.max' => 'Note should be greater then 500 character.',
            'note.required' => 'Please enter note.'
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else{
            $clientId = JWTAuth::parseToken()->authenticate()->id;
            $data = $request->all();
            $note = NoteModel::where(['user_id'=>$clientId,'note_user_id'=>$data['note_user_id']])->first();

            if($note)
            {
                if($note->update($data))
                {
                    $response['success'] = 1;
                    $response['message'] = 'success';
                    $http_status = 200;
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = 'Something Wrong!';
                    $http_status = 400;
                }
            }
            else
            {
                if(Note::create($data))
                {
                    $response['success'] = 1;
                    $response['message'] = 'success';
                    $http_status = 200;
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = 'Something Wrong!';
                    $http_status = 400;
                }
            }

        }
        return response()->json($response,$http_status);
    }


    public function postLockUnlockProfileDeials(Request $request)
    {
        $validator = Validator::make( $request->all(),[
            'lock_user_id' => 'required|numeric'
        ],
        [
            'lock_user_id.required' => 'Lock user id not found.', 
            'lock_user_id.numeric' => 'Lock id must must be numeric.'
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else
        {
            $clientId = JWTAuth::parseToken()->authenticate()->id;
            $data = $request->all();
            $browse = '';
            if(isset($data['browse']))
            {
                $browse = $data['browse'];
            }
            $lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'lock_user_id'=>$data['lock_user_id']])->where(function($q){
                $q->orWhere('browse','looking')
                 ->orWhere('browse','!=','looking');
            })
            ->first();                

            if($lock_profile)
            {
                /******* if is_locked=1 then set is_locked=2 means unlock and if  is_locked=2 then set is_locked=1 means lock*** */
                if ($lock_profile['is_locked'] == 1) {
                    $is_locked = 2;
                    $count = 0;
                } else {
                    $is_locked = 1;
                    $count = 1;
                }
                /************* lock unlock profile details ************ */
                $data['user_id'] = $clientId;
                $data['is_locked'] = $is_locked;
                $data['count'] = $count;
                $data['browse'] = $browse;
                if($lock_profile->update($data))
                {
                    $response['success'] = 1;
                    $response['message'] = 'successfully save into database';
                    $http_status = 200;
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = 'Something Wrong!';
                    $http_status = 400;
                }
            }
            else
            {
                $data['user_id'] = $clientId;
                $data['is_locked'] = 1;
                $data['count'] = 1;
                $data['browse'] = $browse;    
                if(ProfileLockModel::create($data))
                {
                    $response['success'] = 1;
                    $response['message'] = 'successfully save into database';
                    $http_status = 200;
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = 'Something Wrong!';
                    $http_status = 400;
                }
            }
        } 
        return response()->json($response,$http_status);
    }


    public function postBlockUser(Request $request,Repositary $common) {
        $validator = Validator::make( $request->all(),[
            'blocked_id' => 'required|numeric'
        ],
        [
            'blocked_id.required' => 'Block user id not found.', 
            'blocked_id.numeric' => 'Block id must must be numeric.'
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else
        {
            $clientId = JWTAuth::parseToken()->authenticate()->id;
            $data = $request->all();
            $get_model_data = BlockUserModel::where(['user_id'=>$clientId,'blocked_id'=>$data['blocked_id']])->first();
            if(count($get_model_data)==0)
            {
                $data['user_id'] = $clientId;
                $data['block_dt'] = Carbon::now();
                $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'BlockPerDay');
                if ($limit > 0) {
                    $count_block = BlockUserModel::where(['user_id'=>$clientId])->count();
                    if ($count_block >= $limit) {
                        $response['success'] = 0;
                        $response['message'] = 'You have reached your Block limit of ' . number_format($limit) . ' guys. Please remove a Block if you would like to add a new one.';
                        $http_status = 400;
                        return response()->json($response,$http);
                    }
                }

                ShareAlbumModel::where(['sender_id'=>$clientId,'receiver_id'=>$data['blocked_id']])->update(['is_received'=>2,'is_view'=>0]);

                FavouriteModel::where(['user_id'=>$clientId,'favourite_user_id'=>$data['blocked_id']])->update(['is_favourite'=>2]);
                
                if (BlockUserModel::create($data)) {
                    $response['success'] = 1;
                    $response['message'] = 'success';
                    $http_status = 200;
                } else {
                    $response['success'] = 0;
                    $response['message'] = 'failure';
                    $http_status = 200;
                }
            }
            else
            {
                
                if($get_model_data->delete())
                {
                    $response['success'] = 1;
                    $response['message'] = 'success';
                    $http_status = 200;
                } 
                else 
                {
                    $response['success'] = 0;
                    $response['msg'] = 'failure';
                    $http_status = 400;
                }
            }    


        }    
        return response()->json($response,$http_status);
    }

    /*public function share_album(Request $request,Repositary $common) {

        $validator = Validator::make( $request->all(),[
            'receiver_id' => 'required|numeric'
        ],
        [
            'receiver_id.required' => 'Receiver user id not found.', 
            'receiver_id.numeric' => 'Receiver id must must be numeric.'
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else
        {
            $clientId = JWTAuth::parseToken()->authenticate()->id;
            $data = $request->all();
            $album = UseralbumModel::where(['user_id'=>$clientId])->get();

            if ($album) {
                $sharealbum = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $sender_id, 'ShareAlbum.receiver_id' => $receiver_id)));

                $sharealbum = ShareAlbumModel::where(['user_id'=>$clientId,'receiver_id'=>$data['receiver_id']])->first();

                if ($sharealbum) {
                    if ($sharealbum['is_received'] == 1) {
                        $is_received = 2;
                        $is_view = 0;
                    } else {
                        $is_received = 1;
                        $is_view = 1;
                    }

                    $data['sender_id'] = $clientId;
                    $data['is_received'] = $is_received;
                    $data['is_view'] = $is_view;

                    
                  //  $data['success'] = 2;
                  //  $data['msg'] = 'already share album';
                } else {
                    $is_received = 1;
                    $data['sender_id'] = $clientId;
                    $data['is_received'] = $is_received;
                    $data['is_view'] = 1;
                }
                $limit = $common->getlimit($member_type, 'PrivateAlbumSharePerDay');
                if ($data['is_received'] == 1) {
                    if ($limit > 0) {
                        $count_sharealbum_per_day  = ShareAlbumModel::where(['sender_id'=>$clientId,'is_received'=>1])->whereBetween('created_at'=>[carbon::today(),carbon::now()])->count();
                        
                        if ($count_sharealbum_per_day >= $limit) {
                            $reponse['success'] = 1;
                            $response['message'] = 'You have reached your Album Shares limit of ' . number_format($limit) . ' guys per day.';
                            $http_status = 400;

                        }
                    }
                }
                if ($this->ShareAlbum->save($user)) 
                {
                    $chatusers = ChatModel::where(['chat_user_id'=>$receiver_id])->get();
                    $total_unread_message = 0;
                    if ($chatusers) {

                        foreach ($chatusers as $key => $value) {
                            if ($value['invite'] > 0) {
                                $invite = 1;
                            } else {
                                $invite = 0;
                            }
                            $total_unread_message+=($value['count'] + $invite);
                        }
                    }
                    if ($total_unread_message == 0) {
                        $total_unread_message = '';
                    }
                } 
                else 
                {
                    $data['success'] = 3;
                    $data['msg'] = 'unable to save database';
                }
            } 
        }


        $this->autoRender = false;
        $sender_id = isset($this->request->data['sender_id']) ? $this->request->data['sender_id'] : ''; //this is current user
        $receiver_id = isset($this->request->data['receiver_id']) ? $this->request->data['receiver_id'] : ''; // who receive album
        $current_date = isset($this->request->data['current_date']) ? $this->request->data['current_date'] : '';
        if ($sender_id && $receiver_id) {
            //======get member type  free user or paid user==//
            $login_user_member = $this->User->find('first', array('conditions' => array('User.id' => $sender_id)));
            $member_type = $login_user_member['User']['member_type'];
            //=======End============//
            $album = $this->User_album->find('all', array('conditions' => array('User_album.user_id' => $sender_id)));
            if ($album) {
                $sharealbum = $this->ShareAlbum->find('first', array('conditions' => array('ShareAlbum.sender_id' => $sender_id, 'ShareAlbum.receiver_id' => $receiver_id)));
                if ($sharealbum) {
                    
                    if ($sharealbum['ShareAlbum']['is_received'] == 1) {
                        $is_received = 2;
                        $is_view = 0;
                    } else {
                        $is_received = 1;
                        $is_view = 1;
                    }
                    $user['ShareAlbum'] = array(
                        'id' => $sharealbum['ShareAlbum']['id'],
                        'sender_id' => $sender_id,
                        'receiver_id' => $receiver_id,
                        'is_received' => $is_received,
                        'is_view' => $is_view,
                        'creation_date' => $current_date
                    );
                    
                    $data['success'] = 2;
                    $data['msg'] = 'already share album';
                } else {
                    $is_received = 1;
                    
                    $user['ShareAlbum'] = array(
                        //'id' => $sharealbum[0]['ShareAlbum']['id'],
                        'sender_id' => $sender_id,
                        'receiver_id' => $receiver_id,
                        'is_view' => 1,
                        'is_received' => $is_received,
                        'creation_date' => $current_date
                    );
                }
                $limit = $this->match_limit($member_type, 'PrivateAlbumSharePerDay');
                if ($user['ShareAlbum']['is_received'] == 1) {
                    if ($limit != 0) {
                        $count_sharealbum_per_day = $this->ShareAlbum->find('count', array('conditions' => array('ShareAlbum.sender_id' => $sender_id, 'ShareAlbum.is_received' => 1, 'DATE(ShareAlbum.creation_date)' => date('Y-m-d', strtotime($current_date)))));
                        
                        if ($count_sharealbum_per_day >= $limit) {
                            echo json_encode(array('success' => 3, 'msg' => 'You have reached your Album Shares limit of ' . number_format($limit) . ' guys per day.'));
                            exit();
                        }
                    }
                }
                if ($this->ShareAlbum->save($user)) {
                    
                    $chatusers = $this->ChatUser->find('all', array('conditions' => array('ChatUser.chat_user_id' => $receiver_id)));
                    $total_unread_message = 0;
                    if ($chatusers) {

                        foreach ($chatusers as $key => $value) {
                            if ($value['ChatUser']['invite'] > 0) {
                                $invite = 1;
                            } else {
                                $invite = 0;
                            }
                            $total_unread_message+=($value['ChatUser']['count'] + $invite);
                        }
                    }
                    if ($total_unread_message == 0) {
                        $total_unread_message = '';
                    }
                    

                    $username = $this->User->findById($sender_id);
                    
                    $userdetails = $this->User->findById($receiver_id);
                    if ($userdetails) {
                        $device_type = $userdetails['User']['device_type'];
                        $device_token = $userdetails['User']['device_token'];
                        $online_status = $userdetails['User']['online_status'];
                        // pr($device_token);
                        
                        $count_view = $this->count_view($receiver_id);
                        
                        $count_sharealbum = $this->count_sharealbum($receiver_id);
                        $total_view_and_share = $count_view + $count_sharealbum;
                       
                        if ($device_type == 'android') {
                            if ($is_received == 1 && $online_status == 1) {
                                $device_token = array($device_token);
                                $msg = $username['User']['screen_name'] . ' share album with you';
                                $message = array("msg" => $msg, 'sound' => 'default');
                                $this->GCM->send_notification($device_token, $message);
                                //$result = $gcm->send_notification($device_ids, $message);
                            }
                        } else {
                            //echo $is_received;
                            if ($is_received == 1 && $online_status == 1) {
                               
                                $pemfile = WWW_ROOT . 'files/looking.pem';
                                $passphrase = 'looking';
                                $msg = $username['User']['screen_name'] . ' share album with you';
                                $ctx = stream_context_create();
                                stream_context_set_option($ctx, 'ssl', 'local_cert', $pemfile);
                                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                                // Open a connection to the APNS server
                                $fp = stream_socket_client(
                                        'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                                if (!$fp)
                                    exit("Failed to connect: $err $errstr" . PHP_EOL);
                                $body['aps'] = array(
                                    'alert' => $msg,
                                    'count_unread_msg' => 1,
                                    //'post_tag' => $post_tag,
                                    //'job_id' => $job_id,
                                    //'msg_id' => $msg_id,
                                    //'unread_msg_count' => $msg_unread_count,
                                    // 'msg_sender_id' => $msg_sender_id,
                                    //'msg_sender_name' => $msg_sender_name,
                                    // 'group_id' => $group_id,
                                    //'group_name' => $group_name,
                                    'sound' => 'default'
                                );
                                $payload = '{"aps":{"alert":"' . $msg . '","count_unread_msg" : 1,"type" : "share_album","total_view_and_share":"' . (int) $total_view_and_share . '","sound":"default","badge":' . (int) $total_unread_message . '}}';
                                $msg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;
                                $result = fwrite($fp, $msg, strlen($msg));
                                $json = array();
                                fclose($fp);
                            }
                        }
                    }
                    $data['success'] = 1;
                    $data['msg'] = 'success';
                } else {
                    $data['success'] = 3;
                    $data['msg'] = 'unable to save database';
                }
            } else {
                $data['success'] = 4;
                $data['msg'] = 'please add some images';
            }
        } else {
            $data['success'] = 0;
            $data['msg'] = 'sender id or receiver id not found';
        }
        echo json_encode($data);
    }*/

    public function getUserProfileDetail1(Request $request, Repositary $common)
    {
        $validator = Validator::make( $request->all(),[
            'viewer_user_id' => 'required|numeric'
        ],
        [
            'recevier_id.required' => 'Viewer user id not found.', 
            'recevier_id.numeric' => 'viewer user id must be numeric.'
        ]

        );
    
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }
        else
        {
            $clientId = JWTAuth::parseToken()->authenticate()->id;
            $data = $request->all();

            $type = isset($data['type']) ? $data['type'] : '';
            $viewer_id = $data['viewer_user_id'];
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

            $profile = User::with(['Profile','Favourite'=>function($q1) use ($clientId){
                $q1->where(['favourite_user_id'=>$clientId,'is_favourite'=>1])->first();
            },'BlockChatUser'=>function($q2) use ($clientId){
                $q2->where(['block_user_id'=>$clientId])->first();
            },'ShareAlbum'=>function($q4) use ($clientId){
                $q4->where(['receiver_id'=>$clientId,'is_received'=>1])->get();
            },
            'UserLooksex'=>function($q5){
                $q5->where('start_time','<=',Carbon::now())->where('end_time','>=',Carbon::now())->first();
            },
            'UserLookdate',
            'ChatUsers'=>function($q6) use ($clientId){
                $q6->where(['chat_user_id'=>$clientId])->first();
            },
            'UserIdentity'=>function($q7){
                $q7->where(['type'=>'identity'])->get();
            },
            'ProfileLock'=>function($q8) use ($clientId,$type){
                $q8->where(['lock_user_id'=>$clientId,'is_locked'=>1]);
                if($type=='looking_sex')
                {
                    $q8->where(['browse'=>'looking']);
                }
                else
                {
                    $q8->where('browse','!=','looking');   
                }
                $q8->first();
            },
            'Useralbum'=>function($q9){
                $q9->orderBy('album_type','ASC')->get();
            }])->where(array('id'=>$viewer_id))->first();


            $userProfile = User::with(['Favourite'=>function($q1) use ($viewer_id){
                $q1->where(['favourite_user_id'=>$viewer_id,'is_favourite'=>1])->first();
            },'BlockChatUser'=>function($q2) use ($viewer_id){
                $q2->where(['block_user_id'=>$viewer_id])->first();
            },'ShareAlbum'=>function($q4) use ($viewer_id){
                $q4->where(['receiver_id'=>$viewer_id,'is_received'=>1])->get();
            },
            'UserLooksex'=>function($q5){
                $q5->where('start_time','<=',Carbon::now())->where('end_time','>=',Carbon::now())->first();
            },
            'UserLookdate',
            'ChatUsers'=>function($q6) use ($viewer_id){
                $q6->where(['chat_user_id'=>$viewer_id])->first();
            },
            'UserIdentity'=>function($q7){
                $q7->where(['type'=>'identity'])->get();
            },
            'Notes'=>function($q8) use ($viewer_id){
                $q8->where(['note_user_id'=>$viewer_id])->first();
            },
            'ProfileLock'=>function($q8) use ($viewer_id,$type){
                $q8->where(['lock_user_id'=>$viewer_id,'is_locked'=>1]);
                if($type=='looking_sex')
                {
                    $q8->where(['browse'=>'looking']);
                }
                else
                {
                    $q8->where('browse','!=','looking');   
                }
                $q8->first();
            }])->where(array('id'=>$clientId))->first();

            
            $profile['Profile']['description'] = '';
            $viewer_lat = $profile['lat'];
            $viewer_long = $profile['long'];
            $distance = $common->distance(JWTAuth::parseToken()->authenticate()->lat, JWTAuth::parseToken()->authenticate()->long, $viewer_lat, $viewer_long, 'M');
            if (is_nan($distance) == 1) {
                $distance = 0;
            }

            $Userdetails['Distance'] = array('miles' => $distance);
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
            $Userdetails['Looksex_Profile_Active'] = array();
            $Userdetails['User_Looksex_Profile_Active'] = array();
            $Userdetails['Lookdate_Profile_Active'] = array();
            $Userdetails['User_Lookdate_Profile_Active'] = array();

            if(count($profile['ShareAlbum']))
            {
                $Profile_pic = array(
                    array(
                        'id' => 'profile_pic',
                        'user_id' => $viewer_id,
                        'photo_name' => $profile['profile_pic'],
                        'caption' => '',
                        'album_type' => $profile['profile_pic_type'],
                        'creation_date' => $profile['profile_pic_date']
                ));

                if ($profile['Useralbum']) {
                    $album_picture = $profile['Useralbum']->toArray();
                    $profile['ShareAlbum']['album_images'] = array_merge($Profile_pic, $album_picture);
                } else {
                    $profile['ShareAlbum']['album_images'] = $Profile_pic;
                }  
            }

            if(count($profile['UserLooksex']))
            {
                $check_looksex_active = 1;
            }
            else
            {
                $check_looksex_active = 0;
                ChatModel::where(array('user_id'=>$viewer_id))->update(['invite'=>0]);
                $delete_lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'is_locked'=>1,'browse'=>'looking'])->first();
                if ($delete_lock_profile) {
                    ProfileLockModel::where(['id'=>$delete_lock_profile->id])->delete();
                }   
            }
            $Userdetails['Looksex_Profile_Active'] = $check_looksex_active;


            if (count($userProfile['UserLooksex']) > 0) {
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

            if(count($profile['UserLookdate']))
            {
                $check_lookdate_active = 1;
            }
            else
            {
                $check_lookdate_active = 0;   
            }
            $Userdetails['Lookdate_Profile_Active'] = $check_lookdate_active;
            if(count($userProfile['UserLookdate']))
            {
                $check_user_lookdate_active = 1;
            }
            else
            {
                $check_user_lookdate_active = 0;   
            }
            $Userdetails['User_Lookdate_Profile_Active'] = $check_user_lookdate_active;

         
            $identity_percent_permatch = $match_identity = 0;
            if(count($userProfile['UserIdentity']))
            {
                $identity_percent_permatch = 100 / count($userProfile['UserIdentity']);
            }
            $match_identity = 0;
     
           
            $identity = array();
            $traits = array();
            $interest = array();
            $physicial_appearance = array();
            $sextual_preferences = array();
            $social_habits = array();

            if(count($userProfile['UserIdentity'])>0 && count($profile['UserIdentity'])>0){
                foreach ($userProfile['UserIdentity'] as $key => $value) {
                    foreach ($profile['UserIdentity'] as $key1 => $value1) {
                        if (trim(strtolower($value)) == trim(strtolower($value1))) {
                            $match_identity++;
                            $identity[] = trim($value);
                        }
                    }
                }
            }    

            $identity_percentage = round($identity_percent_permatch * $match_identity);
            /*************User Itdentity*******************/
            if($type == 'looking_date')
            {

            }
            else if($type== 'looking_sex')
            {

            }  /******End*******/
            else
            {
                $Userdetails['viewer_profile'] = $profile;
                $Userdetails['user_profile'] = $userProfile;
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

          

        return response()->json($response,$http_status);
    }


}
