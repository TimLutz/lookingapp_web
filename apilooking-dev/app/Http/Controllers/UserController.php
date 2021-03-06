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
use App\Models\PhraseModel; 
use App\Models\FlagModel;   
use App\Models\Page; 
use App\Models\SubcriptionModel; 
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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PushNotification;
use App\Models\ChatroomModel;
use App\Models\UserLooksexdateModel;
use App\Models\UserLokDatesexTypeModel;
use App\Models\ArchiveModel;

class UserController extends Controller {
	
	protected $hashKey;
	
	public function __construct(Request $request){      
      /******Update User last seen*******/  
      $headerAuth = $request->header('Authorization');
      if($headerAuth)
      {
        User::where(['id'=>JWTAuth::parseToken()->authenticate()->id])->update(['last_seen'=>Carbon::now()]);
      }
      /*****End*********/
  }
    
  /**
  * Name: ForgetPassword
  * Purpose: function for user forgot our password
  * created By: Lovepreet
  * Created on :- 1 Aug 2017
  *
  **/
	public function ForgetPassword(Request $request){
		try {
      $validator = Validator::make( $request->all()  ,      [
      'email' => 'required|email|exists:users',
      ],
      [
        'email.required' => 'Please enter your registered email.',
        'email.email'    => 'Please enter valid email.',
        'email.exists'   =>  'Email doesn`t exist in the our record.'  
      ]);
      if ($validator->fails()) {
          $response['success']   = 0;
          $response['errors']   = $validator->errors();
          $http_status=422;
      }else{
        $user=User::where(['email'=>$request->input('email'),'role'=>2])->first();
        if(!$user){
          $response['success'] = 0;
          $response['message'] = 'Email entered doesn`t match our records, please check your email and try again';
          $http_status = 400;
        }
        else{
          if($user->status==0)
          {
            $response['message']    = 'You profile banned by the admin.';
            $response['status']     = 0;
            $http_status = 400; 
          }
          else
          {
            $name = User::where('email',$request->email)->pluck('screen_name');
            $token = hash_hmac('sha256', Str::random(40), $this->hashKey);
            $email = Input::get('email');
            $template=EmailTemplate::find(24);
            $url = env('EMAIL_URL').'/reset-password/'.$token;
            $link="<a href='$url' style='text-decoration:none;'>https://www.lookingmobileapp.com/resetpassword</a>";
            $find=array('@company@','@click here@','@email@');
            $values=array(env('SITENAME'),$link,$email);
            $body=str_replace($find,$values,$template->content);
            $user->remember_token = $token;

            /*** Mail expired after 72 hours ***/
            $user->reset_exp_date = Carbon::now()->addHours(72);
            /*** End ****/
            
            $user->update();
            Mail::send('emails.verify', array('content'=>$body), function($m) use($template)
            {
                $m->to(Input::get('email'))
                    ->subject($template->subject);
            });
            $response['message']    = 'Recovery password link has been sent on your email address';
            $response['status']     = 1;
            $http_status = 200; 
          }
        }   
      }   
    } catch (\Exception $e) {
        $response['message']    = $e->getMessage();
        $response['success']     = 0;
        $http_status = 400; 
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
  public function postUserProfile(Request $request,Repositary $common){
    try {
      $validator = Validator::make( $request->all()  ,      [
       'identity'            => 'required',
       'ethnicity'           => 'required', 
       'birthday'            => 'required|date_format:"Y-m-d"|age_restriction', 
       'height'              => 'required', 
       'weight'              => 'required',
       'about_me'            => 'Max:1000',
       'his_identitie'       => 'required',
       'relationship_status' => 'required',
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
       'birthday.age_restriction'     =>  'Age must be greater then 18 years.',
       'about_me.required'            =>  'About me field is required.',
       'about_me.Min'                 =>  'About me field can`t be less then 5 character.',
       'about_me.Max'                 =>  'About me field can`t be greater then 1000 character.',
      ]
      );

      if ($validator->fails()) {
        $response['success']   = 0;
        $response['errors']   = $validator->errors();
        $http_status=422;

      }else{
        $data = $request->all();    
        $clientId=JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
        $is_completed = 0;  
        
        $data['start_time'] = isset($data['start_time']) ? $data['start_time'] : '0000-00-00 00:00:00';
        $data['end_time'] = isset($data['end_time']) ? $data['end_time'] : '0000-00-00 00:00:00';
        $data['birthday'] = isset($data['birthday']) ? $data['birthday'] : '0000-00-00 00:00:00';

        if(in_array('', $data))
        {
          $is_completed = 1;
        }

        $finish = ($is_completed == 0) ? 1 : 0;

        $chk = ProfileModel::where(array('user_id'=>$clientId))->first();
   
        if(empty($chk))
        {

          $data['user_id'] = $clientId; 
          User::where(array('id'=>$clientId))->update(['is_completed'=>$finish, 'registration_status'=>2]);
          /*****Create user profile*******/
          if(ProfileModel::create($data))
          {
            $IdentityData = $common->saveIdentites($request->identity,$request->his_identitie,$clientId);
            UserIdentityModel::Insert($IdentityData);
            $response['success'] = 1;
            $response['message'] = 'Data has been successfully saved';
            $http_status = 200;
          }
          else
          {
            $response['success'] = 0;
            $response['message'] = 'Data not be successfully saved';
            $http_status = 200;
          }
          /*****End******/
        }
        else
        {
          /*****Update user profile*******/
          if(ProfileModel::updateOrCreate(['user_id'=>$clientId],$data))
          {
            UserIdentityModel::where(array('user_id'=>$clientId))->delete();
            $IdentityData = $common->saveIdentites($request->identity,$request->his_identitie,$clientId);
            UserIdentityModel::Insert($IdentityData);
            if (isset($data['about_me']) && $chk['Profile']['about_me'] != $data['about_me']) {
                $ret = User::where(['id'=>$clientId])->update(array('profiletext_change' => 1, 'profile_text_change_date' => "'" . Carbon::now() . "'"));
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
          /*****End*****/
        }
      }
    } catch (\Exception $e) {
        $response['message']    = $e->getMessage();
        $response['success']     = 0;
        $http_status = 400; 
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
  public function postProfilePicture(Request $request){
    try {
      $data = $request->all();
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
        if(empty($data['profile_pic_type']))
            $data['profile_pic_type'] = 0;

        $data['profile_pic_date'] = Carbon::now();
        $data['photo_change'] = 1;
        $data['registration_status'] = 3;
        $data['profile_exp_date'] = Carbon::now()->addMonths(6);
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
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400; 
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
  public function postUpdateLocation(Request $request,Repositary $common){
  	try {
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
      }else{
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all(); 
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
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400; 
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
  public function getFilterValue(Request $request,Repositary $common){
    try 
    {
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
        $data = $request->all();
        $current_date = Carbon::now();
        $is_view = $is_share = $is_profile_active = $total_unread_message =  0;
        $filter_cache =[];
        $block_id = [];
        $type = isset($data['type'])?$data['type']:''; 
        $user =User::where('status','!=',0)->where('role',2);
        $user2 =User::where('status','!=',0)->where('role',2);              
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

        /********Search Filters*********/
        $finalArr = [];
        if(count($data))
        {
          $arrKey = array_keys($data);
          $arrValue = array_values($data);
          $finalArr = array_combine($arrKey,$arrValue);
        }

        /********Search With username and profile Id*********/
        
        if(isset($finalArr['search_value']) && !empty($finalArr['search_value']))
        {
          $user = $user->where(function($q) use($finalArr){
            $q->orWhere('screen_name','like','%'.$finalArr['search_value'].'%')
                ->orWhere('profile_id','like','%'.$finalArr['search_value'].'%');
          }); 
      //    $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'Search');
        }
        else
        {
    //      $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'Match');
        }
        $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'Match');
        /********End*********/
        Log::info('Showing user profile for user: '.json_encode($finalArr));
      //  if(isset($finalArr['type']) && $request->Input('type')=='browse')   
        if(isset($finalArr['type']) && ($request->Input('type')=='browse' || $request->Input('type')=='looking' || $request->Input('type')=='dating'))   
        {
          /********Search By profile pic*********/
          if(isset($finalArr['profile_pic_type']) && $finalArr['profile_pic_type'] != 'Not Set')
          {
            if($finalArr['profile_pic_type']==1)
            {
              $user = $user->whereIn('profile_pic_type',[1,2]); 
            }
            else
            {
              $user = $user->whereIn('profile_pic_type',[$finalArr['profile_pic_type']]); 
            }
          } 
          /********End*********/

          /********Search By relationshiptype*********/
          if(isset($finalArr['relationship_status']) && $finalArr['relationship_status'] != 'Not Set')
          {
            $user = $user->whereHas('Profile',function($q) use ($finalArr){
            $q->whereIn('relationship_status',explode(',',$finalArr['relationship_status']));
            });
          }

          /********Search by Ethnicity*********/
          if(isset($finalArr['ethnicity']) && $finalArr['ethnicity'] != 'Not Set')
          {
            $user = $user->whereHas('Profile',function($q) use ($finalArr){
            $q->whereIn('ethnicity',explode(',',$finalArr['ethnicity']));
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
              $q->whereIn('name',explode(',', str_replace([', ',' ,',' , '], ',', trim($finalArr['his_identitie']))))
                  ->where(array('type'=>'identity'));
            });
          }
          /********End*********/

          /********Search By his itentites*********/
          if(isset($finalArr['his_seeking']) && $finalArr['his_seeking'] != 'Not Set')
          {
            $user = $user->whereHas('UserIdentity',function($q) use ($finalArr){
              $q->whereIn('name',explode(',', str_replace([', ',' ,',' , '], ',', trim($finalArr['his_seeking']))))
                  ->where(array('type'=>'his_identites'));
            });
          }
          /********End*********/

          if(isset($finalArr['online']) && $finalArr['online'] != 'Not Set')
          {
            //active before one hour
            if($finalArr['online'] == "Recently")
            {
              $user = $user->where('last_seen','<=',Carbon::now())->where('last_seen','>=',Carbon::now()->subHours(24));
            }
            //active before more than 1 hour
            elseif($finalArr['online'] == "Right Now")
            {
              $user = $user->where('last_seen','<=',Carbon::now())->where('last_seen','>=',Carbon::now()->subHours(1));
            }
          }
        }    
        //print_r($user->get()->toArray()); die;
        if ($type == 'looking') {
          /*                 * *******userlook date profile ************* */
          $if_exist_looking_profile = UserLooksexdateModel::with(['Userdatesextype'])->where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->where(['user_id'=>$clientId,'look_type'=>'sex'])->first();
          /*                 * ********End************** */

          /******Get result for all User with chat, profile of user********/
          $user = $user->whereHas('UserLooKSexType',function($q2) use ($current_date){
                    
                    $q2->where('start_time','<=',$current_date)
                       ->where('end_time','>=',$current_date)
                       ->where(['look_type'=>'sex']); 
                     })
                       ->with(['ChatFromUser'=>function($cf) use ($clientId){
                         $cf->where(function($c) use($clientId) {
                         // $c->OrWhere(['from_user'=>$clientId])
                            $c->OrWhere(['to_user'=>$clientId]);
                         });
                       },'ChatToUser'=>function($ct) use ($clientId){
                         $ct->where(function($c1) use ($clientId){
                          $c1->OrWhere(['from_user'=>$clientId]);
                           // ->OrWhere(['to_user'=>$clientId]);
                         });
                       },'Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity','UserLooKSexType'])
                     ->where(['registration_status'=>3])
                     ->whereNotIn('id',$block_id)
                            //->where('id','!=',$clientId)
                     ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));

                $user_data = $user->limit($limit)
              //  ->orderBy('distance','ASC')
                ->get();               

          $total_unread_message = 0;
        
          /*                 * ********End*********** */
          //***************for filter chache**********//
          $if_exist_save_filter = MatchFilterModel::where(['user_id'=>$clientId,'type'=>'looking'])->first();
          if ($if_exist_save_filter) {
              $filter_cache = $if_exist_save_filter;
          }
        }
        else if($type == 'dating')
        {
          $if_exist_looking_profile = UserLooksexdateModel::with(['Userdatesextype'])->where(['user_id'=>$clientId,'look_type'=>'date'])->first();

           /******Get result for all User with chat, profile of user********/
          $user = $user->whereHas('UserLooKSexType',function($q2) use ($current_date){
                      $q2->where(['look_type'=>'date']);
          })         ->with(['ChatFromUser'=>function($cf) use ($clientId){
                         $cf->where(function($c) use($clientId) {
                         // $c->OrWhere(['from_user'=>$clientId])
                            $c->OrWhere(['to_user'=>$clientId]);
                         });
                       },'ChatToUser'=>function($ct) use ($clientId){
                         $ct->where(function($c1) use ($clientId){
                          $c1->OrWhere(['from_user'=>$clientId]);
                        //    ->OrWhere(['to_user'=>$clientId]);
                         });
                       },'Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity','UserLooKSexType'=>function($q1) use ($current_date){
                          $q1->where(['look_type'=>'date']); 
                         }])
                       ->where(['registration_status'=>3])
                       ->whereNotIn('id',$block_id)
                              //->where('id','!=',$clientId)
                       ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));

              $user_data = $user->limit($limit)
              //  ->orderBy('distance','ASC')
                  ->get();     
          $total_unread_message = 0;      
          $if_exist_save_filter = MatchFilterModel::where(['user_id'=>$clientId,'type'=>'dating'])->first();
          if ($if_exist_save_filter) {
              $filter_cache = $if_exist_save_filter;
          }
        }   
        else
        {
          /******Get result for all User with chat, profile of user********/
          $user_data = $user->with(['ChatFromUser'=>function($cf) use ($clientId){
                         $cf->where(function($c) use($clientId) {
                          $c->OrWhere(['from_user'=>$clientId])
                            ->OrWhere(['to_user'=>$clientId]);
                         });
                       },'ChatToUser'=>function($ct) use ($clientId){
                         $ct->where(function($c1) use ($clientId){
                          $c1->OrWhere(['from_user'=>$clientId])
                            ->OrWhere(['to_user'=>$clientId]);
                         });
                       },'Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity'])
                              ->where(['registration_status'=>3])
                              ->whereNotIn('id',$block_id)
                             // ->where('id','!=',$clientId)
                              ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));

          $user_data = $user_data->limit($limit)
          ->orderBy('distance','ASC')
          ->get(); 
          /******End*****/
          $if_exist_save_filter = MatchFilterModel::where(['user_id'=>$clientId,'type'=>'browse'])->first();
          if ($if_exist_save_filter) {
            $filter_cache = $if_exist_save_filter;
          }
        }

        $UserData = array();  
        $UserData1 = array();  
        
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
          if($type == 'dating')
          {
              $user_his_identitie = User::with(['UserIdentity'=>function($q){
                  $q->where(['type'=>'his_identites']);
              }])->where(['id'=>$clientId])->first();
          }
          
          foreach ($user_data as $key => $value) {
            /*if(count($value['ChatUsers']))
            {
                foreach($value['ChatUsers'] As $k => $val)
                {
                    if($val->invite > 0)
                        $invite = 1;
                    else
                        $invite = 0;

                    $total_unread_message+=($value->count + $invite);
                }
            }*/
            $percentage = 0;
            if ($type == 'looking') 
            {
              if(count($if_exist_looking_profile))
              {
                if(isset($value['UserLooKSexType']))
                {
                   foreach($value['UserLooKSexType'] AS $val)
                    {
                      $percentage = $common->calculatepercentage($if_exist_looking_profile['Userdatesextype'],$val['Userdatesextype']);
                    }
                } 
              }   
              if($percentage>0)
              {
                $percentage = round(($percentage * 100) / 400);   
              }
              else
              {
                $percentage = 0;
              }
              $user_data[$key]['percentage'] = $percentage ;
            }
            elseif($type == 'dating') 
            {
              if(count($if_exist_looking_profile))
              {
                if(isset($value['UserLooKSexType']))
                {
                  foreach($value['UserLooKSexType'] AS $val)
                  {
                    $percentage1 = $common->calculatepercentage($if_exist_looking_profile['Userdatesextype'],$val['Userdatesextype']);
                    $percentage2 = $common->calculatepercentage($user_his_identitie['UserIdentity'],$value['UserIdentity']);
                    
                    $percentage = $percentage1 + $percentage2;
                  }
                }
              }
              if($percentage>0)
              {
                $percentage = round(($percentage * 100) / 600);   
              }
              else
              {
                $percentage = 0;
              }
              $user_data[$key]['percentage'] = $percentage ;
            }
            if(!empty($value->last_seen))
            {
              $user_data[$key]['lastseen'] = $value->last_seen;
              $user_data[$key]['last_seen'] = $common->check_difference_in_hours($value->last_seen);
            }
            else
            {
              $user_data[$key]['lastseen'] = '0000-00-00 00:00:00';
              $user_data[$key]['last_seen'] = 2;
            }
            $user_data[$key]['looking_profile_active'] = $common->check_profile_active($current_date, $value['User']['id']);
             $accuracy_value[] = $value['accuracy'];
             $user_data[$key]['chatroomid'] = '';
             if(count($value->ChatFromUser))
             {
               $user_data[$key]['chatroomid'] = $value->ChatFromUser->id;
             }
             else if(count($value->ChatToUser))
             {
               $user_data[$key]['chatroomid'] = $value->ChatToUser->id;
             }
             
          }

          /********End******** */

          /********Calculate Distance between login user and another user ******** */
         //  print_r($user_data->toArray() ); die;
          $arrKey = '';
          if($user_data)
          {
            $arrKey = in_array($clientId, array_column($user_data->toArray(), 'id')); 
          }
          $loggedInUser = [];
          if($arrKey)
          {
            if($type=='looking')
            {
              $loggedInUser = $user2->whereHas('UserLooKSexType',function($q2){})                  ->with(['ChatFromUser'=>function($cf) use ($clientId){
                         $cf->where(function($c) use($clientId) {
                         // $c->OrWhere(['from_user'=>$clientId])
                            $c->OrWhere(['to_user'=>$clientId]);
                         });
                       },'ChatToUser'=>function($ct) use ($clientId){
                         $ct->where(function($c1) use ($clientId){
                          $c1->OrWhere(['from_user'=>$clientId]);
                          //  ->OrWhere(['to_user'=>$clientId]);
                         });
                       },'Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity','UserLooKSexType'=>function($q1) use ($current_date){
                $q1->where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->where(['look_type'=>'sex']); }])
                               ->where(['id'=>$clientId])
                               ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));
            }
            elseif($type=='dating')
            {
              $loggedInUser = $user2->whereHas('UserLooKSexType',function($q2){})                  ->with(['ChatFromUser'=>function($cf) use ($clientId){
                         $cf->where(function($c) use($clientId) {
                         // $c->OrWhere(['from_user'=>$clientId])
                            $c->OrWhere(['to_user'=>$clientId]);
                         });
                       },'ChatToUser'=>function($ct) use ($clientId){
                         $ct->where(function($c1) use ($clientId){
                          $c1->OrWhere(['from_user'=>$clientId]);
                         //   ->OrWhere(['to_user'=>$clientId]);
                         });
                       },'Profile'=>function($q){                $q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity','UserLooKSexType'=>function($q1) use ($current_date){
                                $q1->where(['look_type'=>'date']); }])
                                   ->where(['id'=>$clientId])
                                   ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));
            }
            else
            {
              $loggedInUser = $user2->with(['ChatFromUser'=>function($cf) use ($clientId){
                         $cf->where(function($c) use ($clientId){
                          $c->OrWhere(['from_user'=>$clientId])
                            ->OrWhere(['to_user'=>$clientId]);
                         });
                       },'ChatToUser'=>function($ct) use ($clientId){
                         $ct->where(function($c1) use ($clientId){
                          $c1->OrWhere(['from_user'=>$clientId])
                            ->OrWhere(['to_user'=>$clientId]);
                         });
                       },'Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity'])
              ->where(['id'=>$clientId])
              ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));
            }
            $loggedInUser = $loggedInUser->get();
            if(count($loggedInUser)>0)
            {
              foreach($loggedInUser As $key1 => $value1)
              {
                $percentage = 0;
                if ($type == 'looking') {
                 if(count($if_exist_looking_profile))
                 {
                    if(isset($value1['UserLooKSexType']))
                    {
                     foreach($value1['UserLooKSexType'] AS $val)
                      {
                        $percentage = $common->calculatepercentage($if_exist_looking_profile['Userdatesextype'],$val['Userdatesextype']);
                      }
                    } 
                  }   
                  if($percentage>0)
                  {
                    $percentage = round(($percentage * 100) / 400);   
                  }
                  else
                  {
                    $percentage = 0;
                  }
                  $loggedInUser[$key1]['percentage'] = $percentage ;
                }   
                elseif($type == 'dating') {
                  if(count($if_exist_looking_profile))
                  {
                    if(isset($value1['UserLooKSexType']))
                    {
                      foreach($value1['UserLooKSexType'] AS $val)
                      {
                        $percentage1 = $common->calculatepercentage($if_exist_looking_profile['Userdatesextype'],$val['Userdatesextype']);
                        $percentage2 = $common->calculatepercentage($user_his_identitie['UserIdentity'],$value1['UserIdentity']);
                        
                        $percentage = $percentage1 + $percentage2;
                      }
                    }
                  }
                  if($percentage>0)
                  {
                    $percentage = round(($percentage * 100) / 600);   
                  }
                  else
                  {
                    $percentage = 0;
                  }
                  $loggedInUser[$key1]['percentage'] = $percentage ;
                }
                if(!empty($value1->last_seen))
                {
                  $loggedInUser[$key1]['lastseen'] = $value1->last_seen;
                  $loggedInUser[$key1]['last_seen'] = $common->check_difference_in_hours($value1->last_seen);
                }
                else
                {
                  $loggedInUser[$key1]['lastseen'] = '0000-00-00 00:00:00';
                  $loggedInUser[$key1]['last_seen'] = 2;
                }
                $loggedInUser[$key1]['looking_profile_active'] = $common->check_profile_active($current_date, $value1['User']['id']);

                $loggedInUser[$key1]['chatroomid'] = '';

                if(count($value1['ChatFromUser']))
                {
                 $loggedInUser[$key1]['chatroomid'] = $value1['ChatFromUser']['id'];
                }
                else if(count($value1['ChatToUser']))
                {
                 $loggedInUser[$key1]['chatroomid'] = $value1['ChatToUser']['id'];
                }
              } 
              $accuracy_value[] = $value1['accuracy'];  
            }

            if(count($loggedInUser) > 0)
            {
              $UserData = $loggedInUser->toArray();
            }

          }
          if(count($user_data) > 0)
          {
            $UserData1    = $user_data->toArray();
          }

          /********End******** */
          

          
          $user_data = array_merge($UserData,$UserData1); 
          //print_r($user_data); die;
          $user_data = array_values(array_map("unserialize", array_unique(array_map("serialize", $user_data))));
    

          /********Get Maximum accuracy for the users.******** */
          if(count($accuracy_value))
          {
            $accuracy_max_value = (int) max($accuracy_value);
          }
          /********End******** */
          /********for give user looksex data******** */
          $user_looksexdata = array();
          $user_looksex = UserLooksexdateModel::where([
                                                      'user_id'=>$clientId,
                                                      'look_type'=>'sex'])
                                                  ->where('start_time','<=',Carbon::now())
                                                  ->where('end_time','>=',Carbon::now())
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

    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400; 
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
  public function getUserProfileDetail(Request $request, Repositary $common){
    try {
      $validator = Validator::make($request->all(),[
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
          $current_date = Carbon::now();
          $type = isset($data['type']) ? $data['type'] : '';
          /*******Add or update view user************/
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

          /*******Get user profile data************/
          $profile = User::with(['Profile'=>function($qq){ $qq->select(DB::raw("FLOOR(DATEDIFF (NOW(), profiles.birthday)/365) AS Age,profiles.*")); },'UserIdentity'=>function($q){ $q->groupBy('type')->select(DB::raw("user_id,type,GROUP_CONCAT(name) AS name")); }])->where(array('id'=>$viewer_id))->first();

          if(count($profile))
          {
            $profile['Profile']['description'] = '';
            $viewer_lat = $profile['lat'];
            $viewer_long = $profile['long'];
            $distance = $common->distance(JWTAuth::parseToken()->authenticate()->lat, JWTAuth::parseToken()->authenticate()->long, $viewer_lat, $viewer_long, 'M');
            /*if (is_nan($distance) == 1) {
                $distance = 0;

            }*/

            $distance = ($distance>=0 && $distance<=1) ? 1: $distance;

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
            if(!empty($profile->last_seen))
            {
              $Userdetails['lastseen'] = $profile->last_seen;
              $Userdetails['last_seen'] = $common->check_difference_in_hours($profile->last_seen);
            }
            else
            {
              $Userdetails['lastseen'] = '0000-00-00 00:00:00';
              $Userdetails['last_seen'] = 2;
            }

            /*******Sharealbum by sender************/
            $sharealbum = ShareAlbumModel::where(array('sender_id'=>$clientId,'receiver_id'=>$viewer_id,'is_received'=>1))->first();
            if(count($sharealbum))
            {
              $Userdetails['User_Share_Album'] = $sharealbum->toArray();
            }
            
            /*******Share album by receiver************/
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
              /*******Get all album by receiver************/
              $album = UseralbumModel::where(['user_id'=>$viewer_id])->orderBy('album_type','ASC')->get();
              //pr($album);
              if ($album) {
                $album_picture = $album->toArray();
                $Userdetails['Viewer_Share_Album']['album_images'] = array_merge($Profile_pic, $album_picture);
              } else {
                $Userdetails['Viewer_Share_Album']['album_images'] = $Profile_pic;
              }
            }

            /*******Get note records send to receiver************/
            $note = NoteModel::where(['user_id'=>$clientId,'note_user_id'=>$viewer_id])->first();
            if ($note) {
              $Userdetails['Note'] = $note['note'];
            } else {
              $Userdetails['Note'] = '';
            }
            
            /*******Get favourite information to sender************/
            $favourite = FavouriteModel::where(['user_id'=>$clientId,'favourite_user_id'=>$viewer_id,'is_favourite'=>1])->first();
              if ($favourite) {
                $Userdetails['Favourite'] = $favourite->toArray();
              }
            
            /*******Get favourite information of receiver************/    
            $viewer_favourite = FavouriteModel::where(['user_id'=>$viewer_id,'favourite_user_id'=>$clientId,'is_favourite'=>1])->first();
            if ($viewer_favourite) {
              $Userdetails['Viewer_Favourite'] = $viewer_favourite->toArray();
            }
            
            /*******Get block chat user information of sender************/
            $block_chat = BlockChatUserModel::where(['user_id'=>$clientId,'block_user_id'=>$viewer_id])->first();
            if ($block_chat) {
              $Userdetails['Block_Chat'] = $block_chat->toArray();
            }
            
            /*******Get block chat user information of receiver************/
            $block_chat_view = BlockChatUserModel::where(['user_id'=>$viewer_id,'block_user_id'=>$clientId])->first();
            if ($block_chat_view) {
              $Userdetails['Block_Chat_View_User'] = $block_chat_view->toArray();
            }
            
            /*******Check user sex profile of receiver************/
            $check_looksex_profile = UserLooksexdateModel::where(['user_id'=>$viewer_id,'look_type'=>'sex'])->where(function($q){
                $q->where('start_time','<=',Carbon::now())
                  ->where('end_time','>=',Carbon::now());
            })->first();
            

            if (count($check_looksex_profile) > 0) {
              $check_looksex_active = 1;
            } else {
              $check_looksex_active = 0;
            
            //    ChatModel::where(array('user_id'=>$viewer_id))->update(['invite'=>0]);

            
                /*$delete_lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'is_locked'=>1,'browse'=>'looking'])->first();
                if ($delete_lock_profile) {
                    ProfileLockModel::where(['id'=>$delete_lock_profile->id])->delete();
                }*/
            
            }
            $Userdetails['Looksex_Profile_Active'] = $check_looksex_active;
            
            /*******Check user profile of sender************/
            $check_user_looksex_profile = UserLooksexdateModel::where(['user_id'=>$clientId,'look_type'=>'sex'])->where(function($q){
                $q->where('start_time','<=',Carbon::now())
                  ->where('end_time','>=',Carbon::now());
            })->first();

            if (count($check_user_looksex_profile) > 0) {
              $check_user_looksex_active = 1;
            } else {
              $check_user_looksex_active = 0;
            
           //     ChatModel::where(array('user_id'=>$clientId))->update(['invite'=>0]);
                
                 /*$delete_lock_profile = ProfileLockModel::where(['user_id'=>$viewer_id,'is_locked'=>1,'browse'=>'looking'])->first();
                if ($delete_lock_profile) {
                    ProfileLockModel::where(['id'=>$delete_lock_profile->id])->delete();
                }*/
            }
            $Userdetails['User_Looksex_Profile_Active'] = $check_user_looksex_active;
           
        
            if (isset($type) && $type == 'looking_sex') {
              /*******Get information receiver profile lock or not by sender************/
              $lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'lock_user_id'=>$viewer_id,'is_locked'=>1,'browse'=>'looking'])->first();

              if ($lock_profile) {
                  $Userdetails['User_Profile_Lock'] = $lock_profile->toArray();
              }
              
              /*******Get information receiver profile lock or not by receiver************/
              $lock_profile_view_user = ProfileLockModel::where(['lock_user_id'=>$clientId,'user_id'=>$viewer_id,'is_locked'=>1,'browse'=>'looking'])->first();
              if ($lock_profile_view_user) {
                $Userdetails['View_User_Profile_Lock'] = $lock_profile_view_user->toArray();
              }
            } else {
                
              /*******Get information sender profile lock or not by receiver************/
              $lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'lock_user_id'=>$viewer_id,'is_locked'=>1])->where('browse','!=','looking')->first();
              
              if ($lock_profile) {
                $Userdetails['User_Profile_Lock'] = $lock_profile->toArray();
              }
              
              /*******Get information receiver profile lock or not by sender************/
              $lock_profile_view_user = ProfileLockModel::where(['lock_user_id'=>$clientId,'user_id'=>$viewer_id,'is_locked'=>1])->where('browse','!=','looking')->first();
              if ($lock_profile_view_user) {
                $Userdetails['View_User_Profile_Lock'] = $lock_profile_view_user->toArray();
              }
            }

            /*******Set receiver profile active or not************/
            $UserLookdate = UserLooksexdateModel::where(['user_id'=>$viewer_id,'look_type'=>'date'])->get();
            if (count($UserLookdate) > 0) {
              $check_lookdate_active = 1;
            } else {
              $check_lookdate_active = 0;
            }
            $Userdetails['Lookdate_Profile_Active'] = $check_lookdate_active;
            
            /*******Set sender profile active or not************/
            $UserLookdate = UserLooksexdateModel::where(['user_id'=>$clientId,'look_type'=>'date'])->get();
            if (count($UserLookdate) > 0) {
              $check_user_lookdate_active = 1;
            } else {
              $check_user_lookdate_active = 0;
            }
            $Userdetails['User_Lookdate_Profile_Active'] = $check_user_lookdate_active;
            
            /*******Check invitation send to receiver by sender************/
            $chat_invitation = ChatroomModel::where(function($q) use ($clientId,$viewer_id){
                $q->OrWhere(['from_user'=>$clientId,'to_user'=>$viewer_id]);
              //  ->OrWhere(['from_user'=>$viewer_id,'to_user'=>$clientId]);
            })->first();
            if ($chat_invitation) {
              $Userdetails['User_Invitation'] = $chat_invitation->toArray();
            }


            /*******Check invitation send to sender by receiver************/
            $chat_invitation_viewer = ChatroomModel::where(function($q) use ($clientId,$viewer_id){
                $q->OrWhere(['from_user'=>$viewer_id,'to_user'=>$clientId]);
              //  ->OrWhere(['from_user'=>$clientId,'to_user'=>$viewer_id]);
            })->first();
            if ($chat_invitation_viewer) {
              $Userdetails['Viewer_Invitation'] = $chat_invitation_viewer->toArray();
            }
            
            /*******Check user identities of sender************/
            $user_his_identity = UserIdentityModel::where(['user_id'=>$clientId,'type'=>'his_identites'])->lists('name');
            
            $identity_percent_permatch = $match_identity = 0;
            if(count($user_his_identity))
            {
              $identity_percent_permatch = 100 / count($user_his_identity);
            }
            $match_identity = 0;
            
            /*******Check user identities of receiver************/
            $viewer_identity = UserIdentityModel::where(['user_id'=>$clientId,'type'=>'identity'])->lists('name');
           
            $identity = array();
            $traits = array();
            $interest = array();
            $physicial_appearance = array();
            $sextual_preferences = array();
            $social_habits = array();
            
            if(count($user_his_identity) && count($viewer_identity))
            {
              $identity = array_intersect($user_his_identity->toArray(), $viewer_identity->toArray());
              if(count($identity))
              {
                $match_identity = count($identity);
              }
            }
                /*foreach ($user_his_identity as $key => $value) {
                    foreach ($viewer_identity as $key1 => $value1) {
                        if (trim(strtolower($value)) == trim(strtolower($value1))) {
                            $match_identity++;
                            $identity[] = trim($value);
                        }
                    }
                }*/

            $identity_percentage = round($identity_percent_permatch * $match_identity);

            if(isset($profile['UserIdentity']))
            {
              $ide =  $hisitde = '';
              foreach($profile['UserIdentity'] AS $k => $val)
              {
                if(isset($val->type) && $val->type == 'identity') 
                {
                  $ide = $val->name;
                }
                if(isset($val->type) && $val->type == 'his_identites') 
                {
                  $hisitde = $val->name;
                }
              }
              $profile['profile']['identity'] = $ide;
              $profile['profile']['his_identitie'] = $hisitde;
              $profile['profile']['age'] = $profile['Profile']['Age'];
            }

            /*************User Itdentity*******************/
            if(isset($type) && $type == 'looking_date')
            {
              $lookdateuser = UserLooksexdateModel::with(['Userdatesextype'=>function($q){
                                      //  ->get(['lookdatesex_id','type','name']);
                                          $q->groupBy('type')
                                          ->select(DB::raw("lookdatesex_id,type,GROUP_CONCAT(name) AS name"));
                                     }])
                                     ->where(['user_id'=>$clientId,'look_type'=>'date'])->first();
              if(count($lookdateuser->Userdatesextype))
              {
                $my_interest = $his_traits = $his_physical_appearance = $his_sextual_preferences = $his_social_habits = '';
                $match_his_physical_appearance = $match_his_sextual_preferences = $match_his_social_habits = $match_interest = $match_traits = $his_physical_appearance_percent_permatch = $his_sextual_preferences_percent_permatch = $his_social_habits_percent_permatch = $interest_percent_permatch = $traits_percent_permatch = 0;
                foreach($lookdateuser->Userdatesextype AS $key => $val1)
                {
                  if($val1->type == 'his_physical_appearance')
                  {
                    $his_physical_appearance = explode(',', $val1->name);
                    $his_physical_appearance_percent_permatch = 100 / count($his_physical_appearance);
                  }
                  elseif($val1->type == 'his_sextual_preferences')
                  {
                    $his_sextual_preferences = explode(',', $val1->name);
                    $his_sextual_preferences_percent_permatch = 100 / count($his_sextual_preferences);
                  }
                  elseif($val1->type == 'his_social_habits')
                  {
                    $his_sextual_preferences = explode(',', $val1->name);
                    $his_social_habits_percent_permatch = 100 / count($his_social_habits);
                  }
                  elseif($val1->type == 'his_traits')
                  {
                    $his_traits = explode(',', $val1->name);
                    $traits_percent_permatch = 100 / count($his_traits);
                  }
                  elseif($val1->type == 'my_interest')
                  {
                    $my_interest = explode(',', $val1->name);
                    $interest_percent_permatch = 100 / count($my_interest);
                  }
                }
              }    


              $lookdateviewer = UserLooksexdateModel::with(['Userdatesextype'=>function($q){
                                      //  ->get(['lookdatesex_id','type','name']);
                                        $q->groupBy('type')
                                          ->select(DB::raw("lookdatesex_id,type,GROUP_CONCAT(name) AS name"));
                                     }])
                                     ->where(['user_id'=>$data['viewer_user_id'],'look_type'=>'date'])->first();
                                                                 
              if(count($lookdateviewer->Userdatesextype))
              {
                $my_physical_appearance = $my_sextual_preferences = $my_social_habits = $my_interest_view = $my_traits = '';
                foreach($lookdateviewer->Userdatesextype AS $key => $val1)
                {
                  if($val1->type == 'my_physical_appearance')
                  {
                    $my_physical_appearance = explode(',', $val1->name);
                  }
                  elseif($val1->type == 'my_sextual_preferences')
                  {
                    $my_sextual_preferences = explode(',', $val1->name);
                  }
                  elseif($val1->type == 'my_social_habits')
                  {
                    $my_social_habits = explode(',', $val1->name);
                  }
                  elseif($val1->type == 'my_traits')
                  {
                    $my_traits = explode(',', $val1->name);
                  }
                  elseif($val1->type == 'my_interest')
                  {
                    $my_interest_view = explode(',', $val1->name);
                  }
                }
              }

              if(count($lookdateuser) && count($lookdateviewer))
              {
                $physicial_appearance = array_intersect($his_sextual_preferences, $his_sextual_preferences);
                if(count($physicial_appearance))
                {
                  $match_his_physical_appearance = count($physicial_appearance);
                }
                $Userdetails['physicial_appearance'] = implode(',', $physicial_appearance);
                $physical = round($his_physical_appearance_percent_permatch * $match_his_physical_appearance);


                $sextual_preferences = array_intersect($his_physical_appearance, $his_physical_appearance);
                if(count($sextual_preferences))
                {
                  $match_his_sextual_preferences = count($sextual_preferences);
                }
                $Userdetails['sextual_preferences'] = implode(',', $sextual_preferences);
                $sextual = round($his_sextual_preferences_percent_permatch * $match_his_sextual_preferences);



                $social_habits = array_intersect($his_physical_appearance, $his_physical_appearance);
                if(count($social_habits))
                {
                  $match_his_social_habits = count($social_habits);
                }

                $Userdetails['social_habits'] = implode(',', $social_habits);
                $social_habits = round($his_social_habits_percent_permatch * $match_his_social_habits);


                $traits_percentage = array_intersect($his_traits, $my_traits);
                if(count($traits_percentage))
                {
                  $match_traits = count($traits_percentage);
                }


                $Userdetails['traits'] = implode(',', $traits_percentage);
                $traits_percentage = round($traits_percent_permatch * $match_traits);

                $interest = array_intersect($my_interest, $my_interest_view);
                if(count($interest))
                {
                  $match_interest = count($interest);
                }


                $Userdetails['interest'] = implode(',', $interest);
                $interest = round($interest_percent_permatch * $match_interest);
                
                $Userdetails['identity'] = implode(',', $identity);
              }
              else
              {
                $traits_percentage = $interest = $physical = $sextual = $social_habits = $identity_percentage = 0;
              }

              $overall_per_sum = ($traits_percentage + $interest + $physical + $sextual + $social_habits + $identity_percentage);
              if ($overall_per_sum > 0) {
                  $Userdetails['Over_All_Percentage'] = round(($overall_per_sum * 100) / 600);
              } else {
                  $Userdetails['Over_All_Percentage'] = 0;
              }
              $Userdetails['User'] = $profile;
                  $Userdetails['Profile'] = $profile['Profile'];
                  $Userdetails['Match_Persent'] = array(
                      'traits' => $traits_percentage,
                      'interest' => $interest,
                      'physical' => $physical,
                      'sextual' => $sextual,
                      'social_habits' => $social_habits,
                      'identity' => $identity_percentage
                  );
            }
            else if(isset($type) && $type == 'looking_sex')
            {
              $looksexuser = UserLooksexdateModel::with(['Userdatesextype'=>function($q){
                                      $q->whereIn('type',['his_physical_appearance','his_sextual_preferences','his_social_habits'])
                                      //  ->get(['lookdatesex_id','type','name']);
                                          ->groupBy('type')
                                          ->select(DB::raw("lookdatesex_id,type,GROUP_CONCAT(name) AS name"));
                                     }])
                                     ->where(['user_id'=>$clientId,'look_type'=>'sex'])->where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->first();
              if(isset($looksexuser->Userdatesextype) && count($looksexuser->Userdatesextype))
              {
                  $his_physical_appearance = $his_sextual_preferences = $his_social_habits = '';
                  $match_his_physical_appearance = $match_his_sextual_preferences = $match_his_social_habits = $his_physical_appearance_percent_permatch = $his_sextual_preferences_percent_permatch = $his_social_habits_percent_permatch = 0;
                  foreach($looksexuser->Userdatesextype AS $key => $val1)
                  {
                      if($val1->type == 'his_physical_appearance')
                      {
                          $his_physical_appearance = explode(',', $val1->name);
                          $his_physical_appearance_percent_permatch = 100 / count($his_physical_appearance);
                      }
                      elseif($val1->type == 'his_sextual_preferences')
                      {
                          $his_sextual_preferences = explode(',', $val1->name);
                          $his_sextual_preferences_percent_permatch = 100 / count($his_sextual_preferences);
                      }
                      elseif($val1->type == 'his_social_habits')
                      {
                          $his_sextual_preferences = explode(',', $val1->name);
                          $his_social_habits_percent_permatch = 100 / count($his_social_habits);
                      }
                  }
              }    


              $looksexviewer = UserLooksexdateModel::with(['Userdatesextype'=>function($q){
                                      $q->whereIn('type',['my_physical_appearance','my_sextual_preferences','my_social_habits'])
                                      //  ->get(['lookdatesex_id','type','name']);
                                          ->groupBy('type')
                                          ->select(DB::raw("lookdatesex_id,type,GROUP_CONCAT(name) AS name"));
                                     }])
                                     ->where(['user_id'=>$data['viewer_user_id'],'look_type'=>'sex'])->where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->first();
                                                                 
              if(isset($looksexviewer->Userdatesextype) && count($looksexviewer->Userdatesextype))
              {
                $my_physical_appearance = $my_sextual_preferences = $my_social_habits = '';
                foreach($looksexviewer->Userdatesextype AS $key => $val1)
                {
                  if($val1->type == 'my_physical_appearance')
                  {
                      $my_physical_appearance = explode(',', $val1->name);
                  }
                  elseif($val1->type == 'my_sextual_preferences')
                  {
                      $my_sextual_preferences = explode(',', $val1->name);
                  }
                  elseif($val1->type == 'my_social_habits')
                  {
                      $my_social_habits = explode(',', $val1->name);
                  }
                }
              }

              if(count($looksexuser) && count($looksexviewer))
              {
                $physicial_appearance = array_intersect($his_sextual_preferences, $his_sextual_preferences);
                if(count($physicial_appearance))
                {
                    $match_his_physical_appearance = count($physicial_appearance);
                }
                $Userdetails['physicial_appearance'] = implode(',', $physicial_appearance);
                $physical = round($his_physical_appearance_percent_permatch * $match_his_physical_appearance);


                $sextual_preferences = array_intersect($his_physical_appearance, $his_physical_appearance);
                if(count($sextual_preferences))
                {
                    $match_his_sextual_preferences = count($sextual_preferences);
                }
                $Userdetails['sextual_preferences'] = implode(',', $sextual_preferences);
                $sextual = round($his_sextual_preferences_percent_permatch * $match_his_sextual_preferences);



                $social_habits = array_intersect($his_physical_appearance, $his_physical_appearance);
                if(count($social_habits))
                {
                    $match_his_social_habits = count($social_habits);
                }

                $Userdetails['social_habits'] = implode(',', $social_habits);
                $social_habits = round($his_social_habits_percent_permatch * $match_his_social_habits);
                
                $Userdetails['identity'] = implode(',', $identity);
              }
              else
              {
                  $physical = $sextual = $social_habits = $identity_percentage = 0;
              }

              $overall_per_sum = ($physical + $sextual + $social_habits + $identity_percentage);
              if ($overall_per_sum > 0) {
                  $Userdetails['Over_All_Percentage'] = round(($overall_per_sum * 100) / 400);
              } else {
                  $Userdetails['Over_All_Percentage'] = 0;
              }

              $Userdetails['User'] = $profile;
              $Userdetails['Profile'] = $profile['Profile'];
              //Aded by mahadev //
              $Userdetails['Profile']['where_I_leave'] = $profile['profile']['where_I_leave'];
              $Userdetails['Profile']['about_me'] = $profile['profile']['about_me'];
              $Userdetails['Match_Persent'] = array(
                  'physical' => $physical,
                  'sextual' => $sextual,
                  'social_habits' => $social_habits,
                  'identity' => $identity_percentage
              );

            }  /******End*******/
            else
            {
              $Userdetails['User'] = $profile;
              $Userdetails['Profile'] = $profile['profile'];
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

      } catch (Exception $e) {
        $response['message']    = $e->getMessage();
        $response['success']     = 0;
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
    try {
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
    } catch (\Exception $e) {
        $response['message']    = $e->getMessage();
        $response['success']     = 0;
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
    try {
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
      ]);
  
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else{
        //======get limit for free user or paid user==//
        $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'Favorite');
        //=======End============//
       
        $Favorite = FavouriteModel::where(['user_id'=>$clientId,'favourite_user_id'=>$data['favourite_user_id']])->first();

        $data['user_id'] = $clientId;
        $data['is_favourite'] = 1;
        $data['updated_at'] = Carbon::now();
        $data['is_favourite'] = 1;
        $data['id'] = '';
        if($Favorite)
        {
          if ($Favorite['is_favourite'] == 1) {
              $is_favourite = 2;
          } else {
              $is_favourite = 1;
          }
          $data['is_favourite'] = $is_favourite;
          $data['id'] = $Favorite->id; 
        }
        else
        {
          $data['created_at'] = Carbon::now();
        }
        if($data['is_favourite'] == 1)
        {
          $count_favourite = FavouriteModel::where(['user_id'=>$clientId,'is_favourite'=>1,'browse'=>$data['browse']])->count();

          if ($count_favourite >= $limit) {
            $response['success'] = 0;
            $response['message'] = 'You have reached your Favorite limit of ' . number_format($limit) . ' guys. Please remove a Favorite if you would like to add a new one.';
            $http_status = 400;
            return response()->json($response,$http_status);
          }
        }
        /*****Update or create favorite users******/
        if(FavouriteModel::updateOrCreate(['id'=>$data['id']],$data))
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
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
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
  public function postSentInvitation1(Request $request,Repositary $common) {
    try {
      $data = $request->all();
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $validator = Validator::make( $request->all(),[
          'receiver_id' => 'required|numeric',
          'accept' => 'numeric'
      ],
      [
          'receiver_id.required' => 'Recevier user id not found.', 
          'receiver_id.numeric' => 'Recevier id must must be numeric.', 
          'accept.numeric' => 'Accept have only numeric value.'
      ]

      );
  
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else{
        $data = $request->all();
        $chat_count_message = $common->commonChatUser($clientId,$data['receiver_id']);
        $chat_count_message1 = $common->commonChatUser($data['receiver_id'],$clientId);
        if(isset($data['accept']) && $data['accept']==1)
        {
          if(count($chat_count_message))
          {
            $chat_count_message->update(['count'=>($chat_count_message['count']+1),'created_at'=>carbon::now()]);
          }

          if(count($chat_count_message1))
          {
            $chat_count_message1->update(['invite'=>2]);
          }
        }
        else
        {
          if(count($chat_count_message))
          {
            $chat_count_message->update(['invite'=>1,'check_invitaion_sent'=>1]);
          }
          else
          {
            if(count($chat_count_message1)==0)
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
            ChatModel::create($data);
          }
        }
        // Pending push notification
        
        $userdetails =  User::find($data['receiver_id']); 
        if(count($userdetails))
        {
          /*                 * ***********total count message ************ */
         
          $chatusers = ChatModel::where(['chat_user_id'=>$data['receiver_id']])->get();
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

          /***** Send Pushnotification   *****/
          if($userdetails->online_status==1)
          {
            try {
              $device_token = $userdetails->device_token; 
              if (isset($data['accept']) && $data['accept']==1) {
                $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' accept invitation';
                $type = 'accept_invitation';
              } else {
                $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' send invitation';
                $type = 'sent_invitation';
              }

              if($userdetails->device_type=='android')
              {
                $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' send message for you';
                $notification = ['sound'=>'default'];
              }   
              else
              {
                $notification = ['badge'=>$total_unread_message,'type'=>$type,'sound'=>'default'];
              }

              $common->sentNotification($device_token,$userdetails->device_type,$msg,$notification);

            } catch (\Exception $e) {
              $response['success'] = 0;
              $response['message'] = 'Invaid device token.';
              $http_status = 400;
            }
          }
        }
        else
        {
          $response['success'] = 0;
          $response['message'] = 'user details not found.';
          $http_status = 400;
        }
        $response['success'] = 1;
        $response['message'] = 'Success';
        $http_status = 200;
      }
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
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
    try {
      $data = $request->all();
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $validator = Validator::make( $request->all(),[
          'receiver_id' => 'required|numeric',
          'accept' => 'numeric'
      ],
      [
          'receiver_id.required' => 'Recevier user id not found.', 
          'receiver_id.numeric' => 'Recevier id must must be numeric.', 
          'accept.numeric' => 'Accept have only numeric value.'
      ]

      );
  
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else{
        $data = $request->all();
        $chat_count_message = ChatroomModel::where(function($q) use ($clientId,$data){
            $q->OrWhere(['from_user'=>$clientId,'to_user'=>$data['receiver_id']])
            ->OrWhere(['to_user'=>$clientId,'from_user'=>$data['receiver_id']]);
        })
        //->where('invite','!=',2)
        ->orderBY('id','desc')->first();
        if(isset($data['accept']) && $data['accept']==1)
        {
          $chat_count_message1 = ChatroomModel::where(['to_user'=>$clientId,'from_user'=>$data['receiver_id']])->where('invite','!=',2)->orderBY('id','desc')->first();
          if(count($chat_count_message1))
          {
            if($chat_count_message1->invite == 0)
            {
                $chat_count_message1->update(['invite'=>1]);
            }
            else if($chat_count_message1->invite==1)
            {
              $response['message']     = 'You are already connected.';
              $response['success']     = 1;
              $response['data']     = $chat_count_message1->id;
              $http_status=400;
              return response()->json($response,$http_status);
            }
          }
          else
          {
            $response['errors']     = 'Something wrong.';
            $response['success']     = 0;
            $http_status=400;
            return response()->json($response,$http_status);
          }
        }
        else
        {
          if(count($chat_count_message))
          {
            if($chat_count_message->invite==1)
            {
              $response['message']     = 'You are already connected.';
              $response['success']     = 1;
              $response['data']     = $chat_count_message->id;
              $http_status=400;
              return response()->json($response,$http_status);
            }
            else if($chat_count_message->invite==2)
            {
              $chat_count_message->update(['invite'=>0]);   
            }
            else
            {
              $response['message']     = 'invitation already send.';
              $response['success']     = 1;
              $response['data']     = $chat_count_message->id;
              $http_status=400;
              return response()->json($response,$http_status);
            }
          }
          else
          {
            $data['from_user'] = $clientId;
            $data['to_user'] = $data['receiver_id'];
            $data['invite'] = 0;
            ChatroomModel::create($data);
          }
        }
        // Pending push notification
        
        $userdetails =  User::find($data['receiver_id']); 
        if(count($userdetails))
        {
            /*                 * ***********total count message ************ */
           
          //  $chatusers = ChatroomModel::where(['to_user'=>$data['receiver_id']])->first();
            $total_unread_message = 0;
            /*if ($chatusers) {

            foreach ($chatusers as $key => $value) {
                    if ($value['invite'] > 0) {
                        $invite = 1;
                    } else {
                        $invite = 0;
                    }
                    $total_unread_message+=($value['count'] + $invite);
                }
            }*/

            /*if ($total_unread_message == 0) {
                $total_unread_message = '';
            }*/

            /***** Send Pushnotification   *****/
            if($userdetails->online_status==1)
            {
              try {
                $device_token = $userdetails->device_token; 
                if (isset($data['accept']) && $data['accept']==1) {
                  $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' accept invitation';
                  $type = 'accept_invitation';
                } else {
                  $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' send invitation';
                  $type = 'sent_invitation';
                }

                if($userdetails->device_type=='android')
                {
                  $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' send message for you';
                  $notification = ['sound'=>'custom_notify_sound.wav'];
                }   
                else
                {
                  $notification = ['badge'=>$total_unread_message,'type'=>$type,'sound'=>'custom_notify_sound.wav'];
                }

                $common->sentNotification($device_token,$userdetails->device_type,$msg,$notification);

              } catch (\Exception $e) {
                $response['success'] = 0;
                $response['message'] = 'Invaid device token.';
                $http_status = 400;
              }
            }
        }
        else
        {
          $response['success'] = 0;
          $response['message'] = 'user details not found.';
          $http_status = 400;
        }
        $response['success'] = 1;
        $response['message'] = 'Success';
        $http_status = 200;
      }
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
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
    try {

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

        $data['id'] = '';
        $data['user_id'] = $clientId;
        if(count($note))
        {
          $data['id'] = $note->id;
        }

        if(NoteModel::updateOrCreate(['id'=>$data['id']],$data))
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
    } catch (\Exception $e) {
        $response['message']    = $e->getMessage();
        $response['success']     = 0;
        $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postLockUnlockProfileDeials
   * Purpose: function for Lock and unlock profile
   * created By: Lovepreet
   * Created on :- 12 Aug 2017
   *
   **/   
  public function postLockUnlockProfileDeials(Request $request){
    try {
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
        
        $lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'lock_user_id'=>$data['lock_user_id']]);

        if ($browse == 'looking') 
        {
            $lock_profile = $lock_profile->where('browse','looking');
        }
        else
        {
            $lock_profile = $lock_profile->where('browse','!=','looking');
        }

        $lock_profile = $lock_profile->first();


        $data['user_id'] = $clientId;
        $data['is_locked'] = 1;
        $data['count'] = 1;
        $data['id'] = '';

        if($lock_profile)
        {
          if ($lock_profile['is_locked'] == 1) {
            $is_locked = 2;
            $count = 0;
          } else {
            $is_locked = 1;
            $count = 1;
          }

          /************* lock unlock profile details ************ */
          
          $data['is_locked'] = $is_locked;
          $data['count'] = $count;
          $data['id'] = $lock_profile->id;
        }

        if(ProfileLockModel::updateOrCreate(['id'=>$data['id']],$data))  
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
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postBlockUser
   * Purpose: function for block user
   * created By: Lovepreet
   * Created on :- 12 Aug 2017
   *
   **/   
  public function postBlockUser(Request $request,Repositary $common) {
    try {
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
        /*******Get block user data************/
        $get_model_data = BlockUserModel::where(['user_id'=>$clientId,'blocked_id'=>$data['blocked_id']])->first();
        if(count($get_model_data)==0)
        {
          $data['user_id'] = $clientId;
          $data['block_dt'] = Carbon::now();
          $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'BlockPerDay');
          if ($limit > 0) {
              /*******Count block user if user reach from the maximum limit then send message to info************/
              $count_block = BlockUserModel::where(['user_id'=>$clientId])->count();
              if ($count_block >= $limit) {
                  $response['success'] = 0;
                  $response['message'] = 'You have reached your Block limit of ' . number_format($limit) . ' guys. Please remove a Block if you would like to add a new one.';
                  $http_status = 400;
                  return response()->json($response,$http);
              }
          }
          /*******To remove the sharealbum with receiver************/
          ShareAlbumModel::where(['sender_id'=>$clientId,'receiver_id'=>$data['blocked_id']])->update(['is_received'=>2,'is_view'=>0]);

          /*******To remove the favourite receiver select by sender************/
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
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postShareAlbum
   * Purpose: function for share function
   * created By: Lovepreet
   * Created on :- 12 Aug 2017
   *
   **/ 
  public function postShareAlbum(Request $request,Repositary $common) {
    try {
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
        $count = 0;
        $is_share_count = 1;
        $is_received = '';
        /*******Get album of logged in user************/
        $album = UseralbumModel::where(['user_id'=>$clientId])->get();

        if (count($album)) {
          /*******Get sharealbum information to the user************/
          $sharealbum = ShareAlbumModel::where(['sender_id'=>$clientId,'receiver_id'=>$data['receiver_id']])->first();

          $data['sender_id'] = $clientId;
          if (count($sharealbum)) {
            if ($sharealbum['is_received'] == 1) {
              $is_received = 2;
              $is_view = 0;
            } else {
              $is_received = 1;
              $is_view = 1;
            }
            $data['id'] = $sharealbum->id;
            $data['is_view'] = $is_view;
            $data['is_received'] = $is_received;
              
          } else {
            $is_received = 1;
            $data['is_received'] = $is_received;
            $data['is_view'] = 1;
            $data['id'] = '';
          }
          /*******Check the limit of sharalbum************/
          $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'PrivateAlbumSharePerDay');

          if ($data['is_received'] == 1) {
            if ($limit > 0) {
              /*******Count how many album share with receiver************/
              $count_sharealbum_per_day  = ShareAlbumModel::where(['sender_id'=>$clientId,'is_received'=>1])->whereBetween('created_at',array(carbon::today(),carbon::now()))->count();
              
              if ($count_sharealbum_per_day >= $limit) {
                $response['success'] = 3;
                $response['message'] = 'You have reached your Album Shares limit of ' . number_format($limit) . ' guys per day.';
                $http_status = 400;
                $is_share_count = 0;
              }
            }
          }

          if($is_share_count==1)
          {
            if(ShareAlbumModel::updateOrCreate(['id'=>$data['id']],$data))
            {
              /*$chatusers = ChatModel::where(['chat_user_id'=>$data['receiver_id']])->get();*/
              $total_unread_message = 0;
              /*if ($chatusers) {
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
              }*/

              $userdetails = User::find($data['receiver_id']);

              /***** Send Pushnotification   *****/
              if($userdetails->online_status==1)
              {
                 $device_token = $userdeyails->device_token;
                //   $device_token = 'c50afd3ae826d56fe8179fba5d452c009b30f94d2b61ef0f073933fdc18a91e9';
                $count_view = $common->count_view($data['receiver_id']);
                $count_sharealbum = $common->count_sharealbum($data['receiver_id']);
                $total_view_and_share = (int) $count_view + (int) $count_sharealbum;

                $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' share album with you';
                if($userdetails->device_type=='android')
                {
                  $notification = ['sound'=>'custom_notify_sound.wav'];
                }   
                else
                {
                  $notification = ['badge'=>(int) $total_unread_message,'type'=>'share_album','custom_notify_sound.wav'=>'default','count_unread_msg'=>1,'total_view_and_share'=>$total_view_and_share];
                }

                $common->sentNotification($device_token,$userdetails->device_type,$msg,$notification);
              }

              $response['success'] = 1;
              $response['message'] = 'Success';
              $http_status = 200;
            }
            else
            {
              $response['success'] = 0;
              $response['message'] = 'unable to save database';
              $http_status = 400;   
            }
          }
        } 
        else
        {
          $response['success'] = 4;
          $response['message'] = 'Please add some images';
          $http_status = 400;
        }
      }
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: getUserProfileDetail1
   * Purpose: function for user profile page
   * created By: Lovepreet
   * Created on :- 12 Aug 2017
   *
   **/
  public function getUserProfileDetail1(Request $request, Repositary $common){
    try {
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
    } catch (Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }  
      return response()->json($response,$http_status);
  }

  /**
   * Name: postAddChatUser
   * Purpose: function for save and update the Note
   * created By: Lovepreet
   * Created on :- 12 Aug 2017
   *
   **/
  public function postAddChatUser(Request $request) {
    try { 
      $validator = Validator::make( $request->all(),[
        'chat_user_id' => 'required|numeric'
      ],
      [
        'chat_user_id.required' => 'Chat User id not found.',
        'chat_user_id.numeric' => 'Cjat user id must must be numeric.'
      ]);
 
      if ($validator->fails()) { 
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
          $data = $request->all();
          $chat_users = ChatroomModel::where(function($q) use($clientId,$data){
              $q->OrWhere(['from_user'=>$clientId,'to_user'=>$data['chat_user_id']])
                ->OrWhere(['to_user'=>$clientId,'from_user'=>$data['chat_user_id']]);  
          })->first();
          if(count($chat_users)==0)
          {
            $data['from_user'] = $clientId;
            $data['to_user'] = $data['chat_user_id'];
            $data['invite'] = 2;
            $chatData  = ChatroomModel::create($data);
            if($chatData)
            {
                $response['success'] = 1;
                $response['message'] = 'Success';
                $response['data'] = $chatData->id;
                $http_status = 200;
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = 'unable to save into database';
                $http_status = 400;
            }
        }
        else
        {
            $response['success'] = 1;
            $response['message'] = 'Already save into databse';
            $response['data'] = $chat_users->id;
            $http_status = 400;
        }
      }
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postAddPhrases
   * Purpose: function for save Pharses
   * created By: Lovepreet
   * Created on :- 21 Aug 2017
   *
   **/

  public function postAddPhrases(Request $request) {
    try {
        $validator = Validator::make( $request->all(),[
            'phrases' => 'required'
        ],
        [
            'phrases.required' => 'Please enter atleast one phrase.'
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
          $data1 = [];
         // $arrphrases = explode('~~~', $data['phrases']);
          //print_r($data['phrases']); die;
          foreach ($data['phrases'] as $key => $value) {
            $data1[$key]['user_id'] = $clientId;
            $data1[$key]['phrases'] = $value;
            $data1[$key]['created_at'] = Carbon::now();
            $data1[$key]['updated_at'] = Carbon::now();
          }

          if(PhraseModel::Insert($data1))
          {
            $response['message'] = 'Success';
            $response['success'] = 1;
            $http_status = 200;
          }
          else
          {
            $response['message'] = 'unable to save into database';
            $response['success'] = 0;
            $http_status = 400;
          }
        } 
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postViewPhrases
   * Purpose: function get all phrases
   * created By: Lovepreet
   * Created on :- 21 Aug 2017
   *
   **/

  public function postViewPhrases() {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;

      $phrases = PhraseModel::where(['user_id'=>$clientId])->get();
      if($phrases)
      {
        $response['message'] = 'Success';
        $response['success'] = 1;
        $response['data'] = $phrases;
        $http_status = 200;
      }
      else
      {
        $response['message'] = 'no data founds';
        $response['success'] = 0;
        $http_status = 400;
      }
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }


  /**
   * Name: postDeletePhrases
   * Purpose: delete phrases
   * created By: Lovepreet
   * Created on :- 21 Aug 2017
   *
   **/

  public function postDeletePhrases(Request $request) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $validator = Validator::make( $request->all(),[
        'id' => 'required'
      ],
      [
        'id.required' => 'Phrases id not found.'
      ]

      );
 
      if ($validator->fails()) {
         
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else
      {
        try {
          $data = $request->all();
          $phrase = PhraseModel::findOrFail($data['id']);
          if($phrase)
          {
            if($phrase->delete())
            {
                $response['message'] = 'Success';
                $response['success'] = 1;
                $http_status = 200;
            }
            else
            {
                $response['message'] = 'Unable to delete';
                $response['success'] = 0;
                $http_status = 400;
            }
          }  
        } catch (ModelNotFoundException $e) {
          $response['message'] = 'Record not found';
          $response['success'] = 0;
          $http_status = 400;
        }
      }   
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postUnshareAllAlbumAccess
   * Purpose: function for Unshare album with other person
   * created By: Lovepreet
   * Created on :- 21 Aug 2017
   *
   **/

  public function postUnshareAllAlbumAccess() {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $chk = ShareAlbumModel::where(['sender_id'=>$clientId])->first();
      if($chk)
      {
        if(ShareAlbumModel::where(['sender_id'=>$clientId])->update(['is_received'=>2]))
        {
          $response['message'] = 'album access has been deleted successfully';
          $response['success'] = 1;
          $http_status = 200;
        }
        else
        {
          $response['message'] = 'Something Wrong!';
          $response['success'] = 0;
          $http_status = 400;
        }
      }
      else
      {
        $response['message'] = 'No data found in this id';
        $response['success'] = 0;
        $http_status = 400;
      }

      } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postAddFlag
   * Purpose: function for report the user
   * created By: Lovepreet
   * Created on :- 22 Aug 2017
   *
   **/

  public function postAddFlag(Request $request) {
    try {
      $validator = Validator::make( $request->all(),[
        'receiver_id' => 'required|numeric',
        'flag' => 'required'
      ],
      [
        'receiver_id.required' => 'Receiver not found.',
        'receiver_id.numeric'  => 'Receiver not found.',
        'flag.required' => 'Flag not found'
      ]);
 
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
        $flag_details = FlagModel::where(['sender_id'=>$clientId,'receiver_id'=>$data['receiver_id']])->get();
        if(count($flag_details)==0)
        {
          $data['sender_id'] = $clientId;
          if(FlagModel::create($data))
          {
            $response['message'] = 'Success';
            $response['success'] = 1;
            $http_status = 200;
          }
          else
          {
            $response['message'] = 'Unable to save into database.';
            $response['success'] = 2;
            $http_status = 400;   
          }
        }
        else
        {
          $response['message'] = 'Already exists flag.';
          $response['success'] = 3;
          $http_status = 400;
        }  
      }
    } catch (\Exception $e) {
      $response['message']    = $e->getMessage();
      $response['success']     = 0;
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postDeclainInvitation
   * Purpose: function for Decline the invitation
   * created By: Lovepreet
   * Created on :- 23 Aug 2017
   *
   **/
  public function postDeclainInvitation(Request $request) {
    try {
      $validator = Validator::make( $request->all(),[
        'receiver_id' => 'required|numeric'
      ],
      [
        'receiver_id.required' => 'Receiver not found.',
        'receiver_id.numeric'  => 'Receiver not found.'
      ]);
 
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
    
        $chat_count_message = ChatroomModel::where(['from_user'=>$data['receiver_id'],'to_user'=>$clientId])->first();
        if($chat_count_message)
        {
          if($chat_count_message->update(['invite'=>2]))
          {
            $response['message'] = 'Success';
            $response['success'] = 1;
            $http_status = 200;
          }
          else
          {
            $response['message'] = 'Some thing wrong.';
            $response['success'] = 0;
            $http_status = 400; 
          }
        }
        else
        {
          $response['message'] = 'No found data.';
          $response['success'] = 0;
          $http_status = 400;  
        }
      }
    } catch (\Exception $e) {
      $response['message'] = $e->getMessage();
      $response['success'] = 0;
      $http_status = 400;  
    }
    return response()->json($response,$http_status);        
  }

  /**
   * Name: postChatMessagePushNotification
   * Purpose: function for send notification
   * created By: Lovepreet
   * Created on :- 23 Aug 2017
   *
   **/

  public function postChatMessagePushNotification(Request $request,Repositary $common) {
    try 
    {
      $validator = Validator::make( $request->all(),[
        'receiver_id' => 'required|numeric'
      ],
      [
        'receiver_id.required' => 'Receiver not found.',
        'receiver_id.numeric'  => 'Receiver not found.'
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
        $chat_count_message = ChatroomModel::where(function($q) use($clientId,$data){
            $q->OrWhere((['from_user'=>$clientId,'to_user'=>$data['receiver_id']]))
              ->OrWhere(['from_user'=>$data['receiver_id'],'to_user'=>$clientId]);
        })->first();
        if ($chat_count_message) {
          $chat_count_message->update(['created_at'=>carbon::now()]);
        }
        

        /*             * ***********total count message ************ */
       // $chatusers =ChatModel::where(['chat_user_id'=>$data['receiver_id']])->get();
        $total_unread_message = 0;
       /* $UserData = array();
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
        }*/
        
        $is_active_look_date = UserLooksexdateModel::where(['user_id'=>$clientId,'look_type'=>'date'])->first();
        
        if ($is_active_look_date) {
          $is_active_lookdate_profile = 1;
        } else {
          $is_active_lookdate_profile = 0;
        }
        
        //Pending push notification
        $userdetails = User::find($data['receiver_id']);
        if ($userdetails) {
          //$device_token = $userdetails['User']['device_token'];    
          
          /***** Send Pushnotification   *****/    
          if ($userdetails->online_status == 1) {
              /*                         * ********* send notification for ios ************* */
              $device_token = $userdetails->device_token;
        //     $device_token = 'e27c8776ad37729f91e52150391be63d945029516ef32f006423927dfb44a096';
          //    $device_token = 'e9e7b89b26a15b288f37bf8f90b65dc29e077c63a95acc5caebbdc2eaac2057f';
              //$device_token = $userdetails->device_token; 
              $message = isset($data['message']) && !empty($data['message']) ? $data['message'] : '';
              if ($message == 'send location') {
                $message = $data['message'];
                $msg = 'Location received';
              } elseif($message == 'Detail profile unlocked') {
                $message = $data['message'];
                $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' unlocked ' . ((isset($data['browse']) && $data['browse']) ? $data['browse'] : '') . ' profile';
              } else {
                $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' send message for you'; //'You have a message';
              }

              if($userdetails->device_type=='android')
              {
                $msg = JWTAuth::parseToken()->authenticate()->screen_name . ' send message for you';
                $notification = ['sound'=>'custom_notify_sound.wav'];
              }   
              else
              {
                $notification = ['badge'=>(int) $total_unread_message,'type'=>'chat message','sound'=>'custom_notify_sound.wav','count_unread_msg'=>$total_unread_message,'sender_id'=>$clientId,'receiver_id'=>$data['receiver_id'],'content-available'=>1,'message'=>$message];
              } 
            return $common->sentNotification($device_token,$userdetails->device_type,$msg,$notification); die('zccnvbn');
          }
          $data['success'] = 1;
          $data['msg'] = 'success';
        }else {
            $response['success'] = 0;
            $response['message'] = 'user details not found';
            $http_status = 400;
        }

        $response['message'] = 'Success';
        $response['success'] = 1;
        $http_status = 200;
      }        
    }
    catch (\Exception $e) 
    {
      $response['message'] = 'No data found';
      $response['success'] = 0;
      $http_status = 400;      
    } 
    return response()->json($response,$http_status);
  }

  /**
   * Name: getTermsAndCondition
   * Purpose: function for getting view of term and conditions
   * created By: Lovepreet
   * Created on :- 24 Aug 2017
   *
   **/
  public function getTermsAndCondition(){
    try {
      $content = Page::where(['id'=>6])->first();
      $data =  view('pages.termsandconditions',compact('content'))->render();
      $response['data'] = $data;
      $response['success'] = 1;
      $http_status = 200;    
    } catch (\Exception $e) {
      $response['success'] = 1;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return  response()->json($response,$http_status);
  }

  /**
   * Name: postAddSexRecord
   * Purpose: function for insert or update the sex record
   * created By: Lovepreet
   * Created on :- 18 sept 2017
   *
   **/
  public function postAddSexRecord(Request $request,Repositary $common){
    try {
      $validator = Validator::make( $request->all(),[
        'start_time' => 'required',
        'end_time' => 'required',
        'profile_name' => 'required',
        'my_physical_appearance' => 'required',
        'his_physical_appearance' => 'required',
        'my_sextual_preferences' => 'required',
        'his_sextual_preferences' => 'required',
        'my_social_habits' => 'required',
        'his_social_habits' => 'required',
        'description' => 'required',
        'duration' => 'required'
      ],
      [
        'start_time.required' => 'Start time is required.',
        'profile_name.required' => 'Please enter your profile name.',
        'my_physical_appearance.required' => 'Please enter your Physical Appearance.',
        'his_physical_appearance.required' => 'Please enter His Physical Appearance.',
        'my_sextual_preferences.required' => 'Please enter Your Sexual Preference.',
        'his_sextual_preferences.required' => 'Please enter His Sexual Preference.',
        'my_social_habits.required' => 'Please enter Your Social Habits.',
        'his_social_habits.required' => 'Please enter His Social Habits.',
        'description.required' => 'Description is required.',
        'duration.required' => 'Please enter your duration.',
        'type.required'=> 'Type is required.'
      ]
      );
 
      if ($validator->fails()) {  
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else
      {
        $data = $request->all();
        Log::info('Showing user profile for user: '.json_encode($request->all()));
        $type = isset($data['type']) ? $data['type'] : '';
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        //===for calculate notification time calculate===//
        $actual_date = date('Y-m-d H:i:s', strtotime($data['end_time']));
        $actual_endDate = strtotime($actual_date);
        $getprevDate = $actual_endDate - (60 * 10);
        $notification_time = date("Y-m-d H:i:s", $getprevDate);

        $data1['login_user_member_type'] = JWTAuth::parseToken()->authenticate()->member_type;
        $data1['login_user_removead'] = JWTAuth::parseToken()->authenticate()->removead;
        $data1['login_user_is_trial'] = JWTAuth::parseToken()->authenticate()->is_trial;

        if(JWTAuth::parseToken()->authenticate()->member_type==0)
        {
          $response['message']     = 'Success';
          $response['success']     = 1;
          $response['data'] = $data1;
          $http_status = 200;
          return response($response,$http_status);
        }

        /*             * ******* check user looking profile is active or not if inactive then delete profile lock *********** */
        /*$check_user_looksex_profile = UserLooksexModel::where('start_time','<=',Carbon::now())->where('end_time','>=',Carbon::now())->where(['id'=>$clientId,'look_type'=>'sex'])->first();
        if (count($check_user_looksex_profile) > 0) {
        }
        else
        {
        }*/

        $looksex = UserLooksexdateModel::where(['user_id'=>$clientId,'profile_name'=>$data['profile_name'],'look_type'=>'sex'])->first();

        //$data['start_time'] = Carbon::parse($data['start_time']);
        $data['start_time'] = Carbon::now();
        $data['end_time'] = Carbon::parse($data['end_time']);

        $data['is_active'] = 1;
        $data['notification_time'] = $notification_time;
        $data['is_notify'] = 0;
        //For check exist time//
        $if_exist_profile = UserLooksexdateModel::where('start_time','<=',Carbon::now())->where('end_time','>=',Carbon::now())->where(['id'=>$clientId,'look_type'=>'sex'])->lists('id');
        if($looksex)
        {
          if (empty($type)) {
            $response['success'] = 3;
            $response['message'] = 'profile name already exists';
            $response['data'] = $data1;
            $http_status = 200;
          }
          else
          {
            if (count($if_exist_profile) > 0) {
              $newTime = Carbon::now()->subMinute(1); 
              UserLooksexdateModel::whereIn('id',$if_exist_profile->toArray())->update(['end_time'=>$newTime]);
            }

            UserLooksexdateModel::where(['user_id'=>$clientId,'look_type'=>'sex'])->update(['is_active'=>0]);

            if($looksex->update($data))
            {
              UserLokDatesexTypeModel::where(['user_id'=>$clientId,'lookdatesex_id'=>$looksex->id])->delete();
              $common->saveLooksexvalue($data,$clientId,$looksex->id,'sex');
              $response['success'] = 1;
              $response['message'] = 'success';
              $data1['id'] = $looksex->id;
              $response['data'] = $data1;
              $http_status = 200;
            }
            else
            {
              $response['success'] = 0;
              $response['message'] = 'failure';
              $response['data'] = $data1;
              $http_status = 400;
            }
          }
        }
        else
        {
          if (count($if_exist_profile) > 0) {
          //  $newTime = date("Y-m-d H:i:s", strtotime($current_date . " -1 minutes"));
            $newTime = Carbon::now()->subMinute(1);
            UserLooksexdateModel::whereIn('id',$if_exist_profile->toArray())->update(['end_time'=>$newTime]);
          }

          $update_userlooks = UserLooksexdateModel::where(['user_id'=>$clientId,'look_type'=>'sex'])->update(['is_active'=>0]);

          $data['user_id'] = $clientId;
          $userLok = UserLooksexdateModel::create($data);
          if($userLok)
          {
            $common->saveLooksexvalue($data,$clientId,$userLok->id,'sex');
            $response['success'] = 1;
            $response['message'] = 'success';
            $data['data1'] = $userLok->id;
            $response['data'] = $data1;
            $http_status = 200;
          }
          else
          {
            $response['success'] = 0;
            $response['message'] = 'failure';
            $response['data'] = $data1;
            $http_status = 400;
          }
        }
      } 
    } catch (\Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return  response()->json($response,$http_status);
  }

  /**
   * Name: postViewFavouriteScreen
   * Purpose: function for list the favorite user
   * created By: Lovepreet
   * Created on :- 18 sept 2017
   *
   **/
  public function postViewFavouriteScreen(Request $request, Repositary $common) {
    try {
      $validator = Validator::make( $request->all(),[
          'browse' => 'required'
        ],
        [
          'browse.required' => 'Browse field is required.'
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
        $is_view = $is_share = $is_profile_active = $total_unread_message = $accuracy_max_value = 0;
        $accuracy_value = [];
        $block_id = [];
        $browse = isset($data['browse']) ? $data['browse'] : '';
        $user =User::where('status','!=',0)->where(['role'=>2])->where('id','!=',$clientId);

        $current_date = Carbon::now();
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
        
        $favourite = FavouriteModel::where(['user_id'=>$clientId,'is_favourite'=>1])->lists('favourite_user_id');
        $favourite_user_id = [];
        if($favourite)
        {
          $favourite_user_id = $favourite->toArray();
        }

        if(isset($data['mutual_favorites']))
        {
          $mutualfavourite = FavouriteModel::where(['favourite_user_id'=>$clientId,'is_favourite'=>1])->lists('user_id');
          
          if(count($mutualfavourite))
          {
              $favourite_user_id = array_intersect($favourite_user_id, $mutualfavourite->toArray());
          }
        }

        /** ******for search by name or token ******** */
        if (isset($data['search_value'])) {
          $user = $user->where(function($q) use ($data){
              $q->OrWhere('screen_name','like','%'.$data['search_value'].'%')
                ->OrWhere('profile_id','like','%'.$data['search_value'].'%');
          });
         // $limit_type = 'Search';
        }
        else
        {
         // $limit_type = 'Favorite';
        }
        $limit_type = 'Favorite';
        $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, $limit_type);

        /******Get result for all User with chat, profile of user********/
        $user = $user->whereHas('FavouriteUsers',function($qu) use ($clientId,$favourite_user_id,$data,$browse,$current_date){
                        $qu->where(['user_id'=>$clientId]);
                        if(!empty($browse) && $browse == 'looking')
                        {
                          $UserLookdate = UserLooksexdateModel::where(['look_type'=>'sex'])
                                ->whereIn('user_id',$favourite_user_id)
                                ->where('start_time','<=',$current_date)
                                ->where('end_time','>=',$current_date)
                                ->lists('user_id');
                          $looking_sex_id = [];
                          if(count($UserLookdate))
                          {
                              $looking_sex_id = $UserLookdate->toArray();
                          }                                    
                          $qu->whereIn('users.id',$looking_sex_id);
                        }
                        else if(!empty($browse) && $browse == 'dating')
                        {
                          $UserLookdate = UserLooksexdateModel::where(['look_type'=>'date'])
                                    ->whereIn('user_id',$favourite_user_id)
                                    ->lists('user_id');
                          $looking_sex_id = [];
                          if(count($UserLookdate))
                          {
                              $looking_sex_id = $UserLookdate->toArray();
                          }                                    
                          $qu->whereIn('users.id',$looking_sex_id);
                        }
                        else
                        {
                          $qu->whereIn('users.id',$favourite_user_id);
                        }
                      })
                    ->with(['ChatFromUser','ChatToUser','Profile','Userpartner','UserIdentity','FavouriteUsers'=>function($q1) use ($clientId,$data,$favourite_user_id){
                            
                        //    $q1->where(['user_id'=>$clientId]);
                            if (isset($data['recently_added'])) {
                              $q1 =  $q1->orderBy('updated_at','DESC');
                            }
                    }])
                    ->where(['registration_status'=>3]);
                    $user_data = $user->whereNotIn('id',$block_id)
                    ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));

        $user_data = $user_data->limit($limit);

        if (isset($data['recently_added'])) {

            } else if (isset($data['last_login'])) {
              $user_data =  $user_data->orderBy('updated_at','DESC');
            } else {
              $user_data =  $user_data->orderBy('distance','ASC');
            }
        
        $user_data = $user_data->get();


       
        if (count($user_data)) {

          /** ********check user view my profile ********* */
          $is_view = $common->check_view($clientId);
          /** ********END************ */

          /** ******check any one share album with me******** */
          $is_share = $common->check_sharealbum($clientId);
          /** ******End********* */

          /** ******count total user view my profile******** */
          $count_view = $common->count_view($clientId);
          /** ******End********* */

          /** ******count total user share album with me******** */
          $count_sharealbum = $common->count_sharealbum($clientId);
          $total_view_and_share = $count_view + $count_sharealbum;
          /** ******End********* */

          /*                 * *****check profile active ********* */
          $is_profile_active = $common->check_profile_active(Carbon::now(), $clientId);
          /** ********END***************** */

          /******** Calculates total no. of unread message ******** */
          foreach ($user_data as $key => $value) {
            $accuracy_value[] = $value['accuracy'];
            if(!empty($value->last_seen))
            {
              $user_data[$key]['lastseen'] = $value->last_seen;
              $user_data[$key]['last_seen'] = $common->check_difference_in_hours($value->last_seen);
            }
            else
            {
              $user_data[$key]['lastseen'] = '0000-00-00 00:00:00';
              $user_data[$key]['last_seen'] = 2;
            }
            $user_data[$key]['looking_profile_active'] = $common->check_profile_active(Carbon::now(), $value->id);
            $user_data[$key]['chatroomid'] = '';
            if(count($value->ChatFromUser))
            {
             $user_data[$key]['chatroomid'] = $value->ChatFromUser->id;
            }
            else if(count($value->ChatToUser))
            {
             $user_data[$key]['chatroomid'] = $value->ChatToUser->id;
            }
          }
          /********End******** */

          /********Get Maximum accuracy for the users.******** */
          if(count($accuracy_value))
          {
            $accuracy_max_value = (int) max($accuracy_value);
          }
          /********End******** */

          $user_looksexdata = array();
          $user_looksex = UserLooksexdateModel::where([
                                                  'user_id'=>$clientId,
                                                  'look_type'=>'sex'])
                                              ->where('start_time','<=',Carbon::now())
                                              ->where('end_time','>=',Carbon::now())
                                              ->first();
          
          if ($user_looksex) {
            $user_looksexdata = $user_looksex->toArray();
          }
          $response['success'] = 1;
          $response['data'] =  ['is_share_album' => $is_share, 'is_viewed' => $is_view, 'total_unread_message' => $total_unread_message, 'total_view_and_share' => $total_view_and_share, 'user_looking_profile_active' => $is_profile_active, 'accuracy' => $accuracy_max_value, 'login_user_member_type' => JWTAuth::parseToken()->authenticate()->member_type, 'login_user_removead' => JWTAuth::parseToken()->authenticate()->removead, 'login_user_is_trial' => JWTAuth::parseToken()->authenticate()->is_trial, 'userlooksex_data' => $user_looksexdata, 'user' => $user_data];
          $http_status = 200;
        } else {
          $response['success'] = 0;
          $response['data'] =  ['user_looking_profile_active' => $common->check_profile_active(Carbon::now(), $clientId), 'login_user_member_type' => JWTAuth::parseToken()->authenticate()->member_type, 'login_user_removead' => JWTAuth::parseToken()->authenticate()->removead];
          $response['message'] =  'No record found';
          $http_status = 400;
        }  
      }
    } catch (\Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400; 
    }
    return  response()->json($response,$http_status);
  }

  /**
   * Name: postViewChatusers
   * Purpose: function for list the chat user
   * created By: Lovepreet
   * Created on :- 21 sept 2017
   *
   **/
  public function postViewChatusers(Request $request,Repositary $common){
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $data = $request->all();
      $is_view = $is_share = $is_profile_active = $total_unread_message = $accuracy_max_value =  0;
      $accuracy_value = $block_id = $read_message_user = $unread_message_chatusers = $Userdetails['User_Profile_Lock'] = [];
       
      $current_date = Carbon::now();
      //$user =User::where('status','!=',0)->where(['role'=>2])->where('id','!=',$clientId);

      $favoriteId = [];
      $sentInvite = '';
      if (isset($data['favourite']))
      {
        $favoriteId = FavouriteModel::where(['user_id'=>$clientId,'is_favourite'=>1])->lists('favourite_user_id');
        
      //  $user = $user->whereIn('id',$favourite);
      } 
      elseif(isset($data['sent_invite']))
      {
        //only for looking as per client requirement
        $sentInvite = 1;
      } 
      elseif(isset($data['received_invite'])) 
      {
        $sentInvite = 1;
        //only for browse and dating as per client requirement
      }

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

      
      $looksex_user_id = UserLooksexdateModel::where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->where(['look_type'=>'sex'])->lists('user_id');

      if(count($looksex_user_id))
      {
        $looksex_user_id = $looksex_user_id->toArray();
      }

      //print_r($looksex_user_id); die;
      //pending looking sex and dating functionality

      $user = User::whereHas('ChatFromUser',function( $query ) use ($clientId,$sentInvite,$data,$looksex_user_id){
                  if(!empty($sentInvite))
                  {
                    $query->where(['invite'=>1]);
                  }

                  if(isset($data['browse']) && $data['browse']=='dating')
                  {
                    $query->where(['invite'=>1]);
                  }

                  if(isset($data['browse']) && $data['browse']=='looking')
                  {
                    $query->whereIn('users.id',$looksex_user_id);
                    // $query->whereRaw("users.id IN".$looksex_user_id);
                  }  
                  elseif(isset($data['browse']) && $data['browse']=='dating')
                  {
                      $lookdate_user_id = UserLooksexdateModel::where(['look_type'=>'date'])->lists('user_id');
                      $looksex_check_invite_user_id = [];
                      foreach($lookdate_user_id AS $key => $lookuser) 
                      {
                        $chatuserinvite = ChatroomModel::where(function($q) use ($lookuser,$clientId)
                        {
                          $q->OrWhere(['from_user'=>$lookuser,'to_user'=>$clientId,'invite'=>1])
                            ->OrWhere(['to_user'=>$lookuser,'from_user'=>$clientId,'invite'=>1]);
                        })->get();
                        if (count($chatuserinvite)) {
                            $looksex_check_invite_user_id[] = $lookuser;
                        }
                      }
                      $query->whereIn('users.id',$looksex_check_invite_user_id);
                  }
                  $query->where(['to_user'=>$clientId]);
                      if (isset($data['search_value'])) {
                        $query->where(function($q) use ($data){
                            $q->OrWhere('screen_name','like','%'.$data['search_value'].'%')
                              ->OrWhere('profile_id','like','%'.$data['search_value'].'%');
                          });
                      }
                  $query->orderBy('created_at','DESC');
              })
              ->orWhereHas('ChatToUser',function( $query1 ) use ($clientId,$sentInvite,$data,$looksex_user_id){
                      if(!empty($sentInvite))
                      {
                        $query1->where(['invite'=>1]);
                      }
                      if(isset($data['browse']) && $data['browse']=='dating')
                      {
                        $query1->where(['invite'=>1]);  
                      }

                      if(isset($data['browse']) && $data['browse']=='looking')
                      {
                          $query1->whereIn('users.id',$looksex_user_id);
                      }
                      elseif(isset($data['browse']) && $data['browse']=='dating')
                      {
                          $lookdate_user_id = UserLooksexdateModel::where(['look_type'=>'date'])->lists('user_id');
                          $looksex_check_invite_user_id = [];

                          foreach($lookdate_user_id AS $key => $lookuser) 
                          {
                            $chatuserinvite = ChatroomModel::where(function($q) use ($lookuser,$clientId)
                            {
                              $q->OrWhere(['from_user'=>$lookuser,'to_user'=>$clientId,'invite'=>1])
                                ->OrWhere(['to_user'=>$lookuser,'from_user'=>$clientId,'invite'=>1]);
                            })->get();
                            if (count($chatuserinvite)) {
                                $looksex_check_invite_user_id[] = $lookuser;
                            }
                          }

                          $query1->whereIn('users.id',$looksex_check_invite_user_id);
                      }
                      $query1->where(['from_user'=>$clientId]);
                      if (isset($data['search_value'])) {
                        $query1->where(function($q) use ($data){
                            $q->OrWhere('screen_name','like','%'.$data['search_value'].'%')
                              ->OrWhere('profile_id','like','%'.$data['search_value'].'%');
                          });
                      }   
                      $query1->orderBy('created_at','DESC');
              })
              ->with(['ChatFromUser','ChatToUser','Profile','Userpartner','UserIdentity'])
              ->where(['registration_status'=>3])
              ->where('status','!=',0)
              ->where(['role'=>2])
              ->where('id','!=',$clientId);

             

              
              if(!empty($favoriteId))
              {
                  $user=  $user->whereIn('id',$favoriteId);
              } 
              $user = $user->whereNotIn('id',$block_id);
              $user_data = $user->get();

      /************* check user  alredy lock the view profile user ************ */
      $lock_profile = ProfileLockModel::where(['user_id'=>$clientId,'lock_user_id'=>isset($data['lock_user_id'])?$data['lock_user_id']:'','is_locked'=>1])->first();

      if ($lock_profile) {
          $Userdetails['User_Profile_Lock'] = $lock_profile;
      }  


      if (count($user_data)) {

          /** ********check user view my profile ********* */
          $is_view = $common->check_view($clientId);
          /** ********END************ */

          /** ******check any one share album with me******** */
          $is_share = $common->check_sharealbum($clientId);
          /** ******End********* */

          /** ******count total user view my profile******** */
          $count_view = $common->count_view($clientId);
          /** ******End********* */

          /** ******count total user share album with me******** */
          $count_sharealbum = $common->count_sharealbum($clientId);
          $total_view_and_share = $count_view + $count_sharealbum;
          /** ******End********* */

          /*                 * *****check profile active ********* */
          $is_profile_active = $common->check_profile_active(Carbon::now(), $clientId);
          /** ********END***************** */

          /******** Calculates total no. of unread message ******** */
          
          foreach ($user_data as $key => $value) {
              $user_data[$key]['looking_profile_active'] = $common->check_profile_active($current_date, $value['id']);
              $accuracy_value[] = $value['accuracy'];
              
              if(isset($value->ChatFromUser) || isset($value->ChatToUser))
              {
                  if((isset($value->ChatFromUser->invite) && $value->ChatFromUser->invite > 0) || (isset($value->ChatToUser->invite) && $value->ChatToUser->invite > 0))
                  {

                      $unread_message_chatusers[] = $user_data[$key];
                  }
                  else
                  {
                      $read_message_user[] = $user_data[$key];
                  }
              }

              if(!empty($value->last_seen))
              {
                  $user_data[$key]['lastseen'] = $value->last_seen;
                  $user_data[$key]['last_seen'] = $common->check_difference_in_hours($value->last_seen);
              }
              else
              {
                  $user_data[$key]['lastseen'] = '0000-00-00 00:00:00';
                  $user_data[$key]['last_seen'] = 2;
              }
              $user_data[$key]['chatroomid'] = '';
              if(count($value->ChatFromUser))
              {
               $user_data[$key]['chatroomid'] = $value->ChatFromUser->id;
              }
              else if(count($value->ChatToUser))
              {
               $user_data[$key]['chatroomid'] = $value->ChatToUser->id;
              }
          }
          /********End******** */

          /********Get Maximum accuracy for the users.******** */
          if(count($accuracy_value))
          {
             $accuracy_max_value = (int) max($accuracy_value);
          }
          /********End******** */

          $user_looksexdata = array();
          $user_looksex = UserLooksexdateModel::with(['Userdatesextype'=>function($q1){}])
                                              ->where([
                                                  'user_id'=>$clientId,
                                                  'look_type'=>'sex'])
                                              ->where('start_time','<=',Carbon::now())
                                              ->where('end_time','>=',Carbon::now())
                                              ->first();
          
          if ($user_looksex) {
              $user_looksexdata = $user_looksex->toArray();
          }
          $response['success'] = 1;
          $response['data'] =  ['is_share_album' => $is_share, 'is_viewed' => $is_view, 'total_unread_message' => $total_unread_message, 'total_view_and_share' => $total_view_and_share, 'user_looking_profile_active' => $is_profile_active, 'accuracy' => $accuracy_max_value, 'login_user_member_type' => JWTAuth::parseToken()->authenticate()->member_type, 'login_user_removead' => JWTAuth::parseToken()->authenticate()->removead, 'userlooksex_data' => $user_looksexdata,/* 'user' => $user_data,*/'unread_message_grid'=>$unread_message_chatusers,'read_message_grid'=>$read_message_user,'profile_lock'=>$Userdetails['User_Profile_Lock']];
          $http_status = 200;

      } else {
          $response['success'] = 0;
          $response['data'] =  ['user_looking_profile_active' => $common->check_profile_active(Carbon::now(), $clientId), 'login_user_member_type' => JWTAuth::parseToken()->authenticate()->member_type, 'login_user_removead' => JWTAuth::parseToken()->authenticate()->removead];
          $response['message'] =  'No record found';
          $http_status = 400;
      }
    } catch (Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400; 
    }
    return  response()->json($response,$http_status);
  }

  /**
   * Name: postViewLookingSex
   * Purpose: function for listing of the Looking sex 
   * created By: Lovepreet
   * Created on :- 21 sept 2017
   *
   **/
  public function postViewLookingSex(Request $request) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
   //   $current_date = Carbon::parse($data['current_date']);
      $current_date = Carbon::now();
      $data1['login_user_member_type'] = JWTAuth::parseToken()->authenticate()->member_type;
      $data1['login_user_removead'] = JWTAuth::parseToken()->authenticate()->removead;
      $data1['login_user_is_trial'] = JWTAuth::parseToken()->authenticate()->is_trial;
      if (JWTAuth::parseToken()->authenticate()->member_type == 0) {
        $response['success'] = 1;
        $response['message'] = 'success';
        $response['data'] = $data1;
        $http = '200';
        return response()->json($response,$http);
      }
      $userlooksex = UserLooksexdateModel::with(['Userdatesextype'=>function($q1){
        $q1->where(['looktype'=>'sex'])->groupBy('type')->select(DB::raw("lookdatesex_id,type, GROUP_CONCAT(name) AS name"));
      }])
                                               ->where(['user_id'=>$clientId,'look_type'=>'sex'])
                                               ->orderBy('id','asc')
                                               ->get();
                                             
      foreach ($userlooksex as $key => $value) {
        $if_exist_profile = UserLooksexdateModel::where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->where(['id'=>$value->id,'look_type'=>'sex'])->first();

        if (count($if_exist_profile) > 0) {
          $is_profile_active = 1;
        } else {
          $is_profile_active = 0;
        }
        $userlooksex[$key]['is_profile_active'] = $is_profile_active;

        $my_pref = $his_pref = $my_sext = $his_sext = $my_social = $his_social = '';

        foreach($value['Userdatesextype'] AS $key1 => $val)
        {
          $userlooksex[$key][$val->type] = $val->name;
        }
        unset($value['Userdatesextype']);
      }
 
      if($userlooksex)
      {
        $data1['userlooksex'] = $userlooksex;
        $response['success'] = 1;
        $response['message'] = 'Success';
        $response['data'] = $data1;
        $http_status = 200;
      }
      else
      {
        $response['success'] = 0;
        $response['message'] = 'failure';   
        $response['data'] = $data1;   
        $http_status = 400;
      }
    } catch (\Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }


  /**
   * Name: getBlockedUserList
   * Purpose: function for list of block user
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function getBlockedUserList(Request $request,Repositary $common) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $current_date = Carbon::now();

      // Get all user 
      $user = new User();

      //get block user ids
      $get_lock_user_data = BlockUserModel::where(['user_id'=>$clientId])->orderBy('user_id','desc')->lists('blocked_id');

      $block_user_list = $user->whereIn('id',$get_lock_user_data)->get();

      /*             * ******for give user looksex data******** */
      $user_looksex = UserLooksexdateModel::with('Userdatesextype')->where(['look_type'=>'sex','user_id'=>$clientId])->where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->first();

      if(count($block_user_list))
      {
        $response['success'] = 1;
        $response['message'] = 'No data found';
        $response['data'] = ['login_user_member_type'=>JWTAuth::parseToken()->authenticate()->member_type,'login_user_removead'=>JWTAuth::parseToken()->authenticate()->removead,'user_looking_profile_active'=>$common->check_profile_active($current_date, $clientId),'user_data'=>$block_user_list,'userlooksex_data'=>$user_looksex];
        $http_status = 200;
      }
      else
      {
        $response['success'] = 2;
        $response['message'] = 'No data found';
        $response['data'] = ['login_user_member_type'=>JWTAuth::parseToken()->authenticate()->member_type,'login_user_removead'=>JWTAuth::parseToken()->authenticate()->removead,'user_looking_profile_active'=>$common->check_profile_active($current_date, $clientId)];
        $http_status = 200;
      }

    } catch (\Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: getBlockedUserList
   * Purpose: function for list of block user
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function postTimeExtendLooksexProfile(Request $request) {
    try {
      $validator = Validator::make( $request->all()  ,      [
        'id' => 'required|numeric',
      ],
      [
        'id.required' => 'Please enter profile id.',
        'id.numeric'    => 'Please enter valid id.'
      ]);
      if($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']        = 0;
        $http_status = 422;
      }
      else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();

        $looksex_profile = UserLooksexdateModel::where(['id'=>$data['id'],'look_type'=>'sex'])->first();

        if(count($looksex_profile)>0)
        {
          $start = $looksex_profile->start_time;
          $end = $looksex_profile->end_time;

          $nowtime = Carbon::parse($end)->addMinutes(60);

          $if_exist_profile = UserLooksexdateModel::where(['user_id'=>$clientId])
                                                      ->where('id','!=',$data['id'])
                                                      ->where('start_time','<=',$nowtime)
                                                      ->where('end_time','>=',$start)
                                                      ->first();

          if(count($if_exist_profile))
          {
            $isexitdate = $if_exist_profile->start_time;
            $diff = $end->diff($isexitdate);
            $minutes = $diff->i;
            if ($minutes > 0) {
              $nowtime = Carbon::parse($end)->addMinutes($minutes);
              if ($looksex_profile->update(['end_time'=>$nowtime])) {
              $response['success'] = 1;
              $response['message'] = 'success';
              $response['data'] = ['extend_time'=>$minutes.' minutes','userlooksex_data'=>$looksex_profile];
              $http_status = 200;
              } 
              else 
              {
                $response['success'] = 2;
                $response['message'] = 'unable to update';
                $http_status = 200;
              }
            } 
            else 
            {
              $response['success'] = 3;
              $response['message'] = 'unable to update';
              $http_status = 200;
            }   
          }
          else
          {
            if ($looksex_profile->update(['end_time'=>$nowtime])) {
              $response['success'] = 1;
              $response['message'] = 'success';
              $response['data'] = ['extend_time'=>'1 hour','userlooksex_data'=>$looksex_profile];
              $http_status = 200;
            } 
            else 
            {
              $response['success'] = 2;
              $response['message'] = 'unable to update';
              $http_status = 200;
            }
          }
        }
        else
        {
            throw new \Exception('Data not found');
        }
      }
    }
    catch (\Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
  }

  /**
   * Name: getMemberAlbum
   * Purpose: function for list of Member album
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function getMemberAlbum(Request $request,Repositary $common) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $data = $request->all();
      $login_user_pic = array();
      $all_album = array();
      $login_user_pic[] = array('id' => 'login user',
          'user_id' => $clientId,
          'photo_name' => JWTAuth::parseToken()->authenticate()->profile_pic,
          'file_type' => 0,
          'caption' => '',
          'album_type' => JWTAuth::parseToken()->authenticate()->profile_pic_type,
          'creation_date' => JWTAuth::parseToken()->authenticate()->profile_pic_date
      );

      $check_verified_pic = UseralbumModel::where(['user_id'=>$clientId,'album_type'=>3])                                 ->get();
     
      $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'PrivateAlbum');


      if(count($check_verified_pic)==0)
      {
        $login_user_pic[] = array('id' => '',
            'user_id' => $clientId,
            'photo_name' => '',
            'file_type' => 0,
            'caption' => '',
            'album_type' => '3',
            'creation_date' => ''
        );
      }

      if($limit >= 0)
      {
        $album = UseralbumModel::where(['user_id'=>$clientId])
                                  ->limit($limit + 1)
                                  ->orderBY('album_type','ASC')
                                  ->orderBY('id','ASC')
                                  ->get();
      }
      else
      {
        $album = UseralbumModel::where(['user_id'=>$clientId])
                                  ->orderBY('album_type','ASC')
                                  ->orderBY('id','ASC')
                                  ->get();
      }

      if (isset($data['received_album'])) {
        $all_album = $album->toArray();
      } else {
        $all_album = array_merge($login_user_pic, $album->toArray());
      }

      $response['success'] = 1;
      $response['messsage'] = 'Success';
      $response['data'] = ['login_user_member_type'=>JWTAuth::parseToken()->authenticate()->member_type,'login_user_removead'=>JWTAuth::parseToken()->authenticate()->removead,'login_user_is_trial'=>JWTAuth::parseToken()->authenticate()->is_trial,'screen_name'=>JWTAuth::parseToken()->authenticate()->screen_name,'all_album'=>$all_album];
      $http_status = 200;
    } catch (\Exception $e) {
      $response['success'] = 0;
      $response['messsage'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postRenameCaptionAlbumImage
   * Purpose: function for update caption
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function postRenameCaptionAlbumImage(Request $request, Repositary $common) {
    try {
      $validator = Validator::make( $request->all(),[
        'pic_id' => 'required|numeric'
      ],
      [
        'pic_id.required' => 'Id not found.',
        'pic_id.numeric' => 'Id must must be numeric.'
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
        $album = UseralbumModel::findOrfail($data['pic_id']);
        if(count($album))
        {
          $caption = isset($data['caption']) ? $data['caption'] : '';
          if($album->update(['caption'=>$caption]))
          {
            $response['success'] = 1;
            $response['message'] = 'Success';
            $http_status = 200;
          }
          else
          {
            $response['success'] = 0;
            $response['message'] = 'Wrong Something';
            $http_status = 400;
          }
        }
        else
        {
          $response['success'] = 0;
          $response['message'] = 'Data Not Found.';
          $http_status = 400;
        }
      }

    } catch (\Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postDeleteAlbumPicture
   * Purpose: function for delete user album
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function postDeleteAlbumPicture(Request $request) {
    try {
      $validator = Validator::make( $request->all(),[
        'pic_id' => 'required'
      ],
      [
        'pic_id.required' => 'Id not found.'
      ]

      );

      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else
      {
        $data=$request->all();
        $ids = explode(',',$data['pic_id']);
        if(count($ids)>1)
            $user_delete=DB::table('user_albums')->whereIn('id', $ids)->delete();
        else
            $user_delete=DB::table('user_albums')->where('id', $ids)->delete();

        if($user_delete)
        {
          $response['success'] = 1;
          $response['message'] = 'picture has been successful deleted';
          $http_status = 200;
        }
        else
        {
          $response['success'] = 0;
          $response['message'] = 'No data found';
          $http_status = 400;
        }
      }
    } catch (\Exception $e) {
      $response['success'] = 1;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postMoveArchive
   * Purpose: function for delete user album and move to Archive
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function postMoveArchive(Request $request) {
    try {
        $validator = Validator::make( $request->all(),[
          'id' => 'required'
        ],
        [
          'id.required' => 'Id not found.'
        ]

        );
  
        if ($validator->fails()) {
          
          $response['errors']     = $validator->errors();
          $response['success']     = 0;
          $http_status=422;
        }else
        {
          $data = $request->all();
          $arrpicid = explode(',', $data['id']);
          $count = 0;
          $clientId = JWTAuth::parseToken()->authenticate()->id;   
          foreach($arrpicid AS $key => $value)
          {
            $UserArchive =  UseralbumModel::where(['id'=>$value])->first();
            if($UserArchive)
            {
              $archiveData = array(
                'user_id' => $clientId,
                'photo_name' => $UserArchive->photo_name,
                'caption' => $UserArchive->caption
              );  
              if(ArchiveModel::create($archiveData))
              {
                $count+=1;
                $UserArchive->delete();
              }
            }
          }

          if($count)
          {
            $response['success'] = 1;
            $response['message'] = 'Success';
            $http_status = 200;
          }
          else
          {
            $response['success'] = 0;
            $response['message'] = 'Failure';
            $http_status = 400;
          }
        }
    } catch (\Exception $e) {
      $response['success'] = 1;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: getViewArchive
   * Purpose: function for list of all archives
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function getViewArchive() {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $archive = ArchiveModel::where(['user_id'=>$clientId])->orderBY('id','DESC')->get();
      $archData['login_user_member_type'] = JWTAuth::parseToken()->authenticate()->member_type;
      $archData['login_user_removed'] = JWTAuth::parseToken()->authenticate()->removead;
      $archData['login_user_is_trial'] = JWTAuth::parseToken()->authenticate()->is_trial;
      $archData['screen_name'] = JWTAuth::parseToken()->authenticate()->screen_name;
      if($archive)
      {
        $archData['archive'] = $archive->toArray();
        $response['success'] = 1;
        $response['message'] = 'Success';
        $response['data'] = $archData;
        $http_status = 200;
      }
      else
      {
        $response['success'] = 0;
        $response['message'] = 'No data found';
        $response['data'] = $archive;
        $http_status = 400;
      }
    } catch (\Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postDeleteArchive
   * Purpose: function for delete to archive data
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function postDeleteArchive(Request $request) {
    try
    {
      $validator = Validator::make( $request->all(),[
        'id' => 'required'
      ],
      [
        'id.required' => 'Id not found.'
      ]

      );

      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']     = 0;
        $http_status=422;
      }else
      {
        $data=$request->all();
        $ids = explode(',',$data['id']);
        if(count($ids)>1)
          $user_delete=DB::table('archives')->whereIn('id', $ids)->delete();
        else
          $user_delete=DB::table('archives')->where('id', $ids)->delete();

        if($user_delete)
        {
          $response['success'] = 1;
          $response['message'] = 'picture has been successful deleted';
          $http_status = 200;
        }
        else
        {
          $response['success'] = 0;
          $response['message'] = 'picture has been not deleted successful';
          $http_status = 400;
        }
      }  
    }
    catch (\Exception $e) {
      $response['success'] = 0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: getViewReceiveAlbum
   * Purpose: function for list of user which have share album detail
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function getViewReceiveAlbum(Repositary $common) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      ShareAlbumModel::where(['receiver_id'=>$clientId])->update(['is_view'=>0]);

      $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'AlbumReceived');

      //Pending limit and order
      $receivealbum = User::with(['Profile','ShareAlbum'])->where(['role'=>2,'status'=>1]);
      $receivealbum = $receivealbum->whereHas('ShareAlbum',function($q1) use ($clientId){
          $q1->where(['is_received'=>1,'receiver_id'=>$clientId]);
      });    
      $receivealbum = $receivealbum->get();
      if(count($receivealbum))
      {
        $response['success']=1;
        $response['message'] = 'Success';
        $response['data'] = $receivealbum;
        $http_status = 200;
      }
      else
      {
        $response['success']=0;
        $response['message'] = 'No data found';
        $http_status = 400;   
      }

    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postUnblockAllUsers
   * Purpose: function for unblock all user these related user id
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/ 
  public function postUnblockAllUsers() {
    try { 
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      if(BlockUserModel::where(['user_id'=>$clientId])->delete())
      {
        $response['success'] = 0;
        $response['message'] = 'success';
        $http_status = 200;
      }
      else
      {
        $response['success'] = 0;
        $response['message'] = 'Unable to unblock';
        $http_status = 400;
      }
    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }

    return response()->json($response,$http_status);
  }

  /**
   * Name: getMyProfile
   * Purpose: function for getting own profile detail
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function getMyProfile() {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $userDetail = User::with(['Profile','Userpartner'])->where(['id'=>$clientId])->first();
      if($userDetail)
      {
        $response['success'] = 1;
        $response['message'] = 'Success';
        $response['data'] = ['user_data'=>$userDetail];
        $http_status = 200;
      }
      else
      {
        $response['success'] = 0;
        $response['message'] = 'Failure';
        $http_status = 400;   
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postAddLookingDate
   * Purpose: function for insert the detail of looking type
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postAddLookingDate(Request $request,Repositary $common) {
    try {
      $validator = Validator::make( $request->all(),[
        'my_traits' => 'required',
        'his_traits' => 'required',
        'my_interest' => 'required',
        'profile_name' => 'required',
        'my_physical_appearance' => 'required',
        'his_physical_appearance' => 'required',
        'my_sextual_preferences' => 'required',
        'his_sextual_preferences' => 'required',
        'my_social_habits' => 'required',
        'his_social_habits' => 'required',
      ],
      [
        'my_traits.required' => 'Please enter your traits.',
        'his_traits.required' => 'Please enter his traits',
        'my_interest.required' => 'Please enter your traits.',
        'profile_name.required' => 'Please enter your profile name.',
        'my_physical_appearance.required' => 'Please enter your Physical Appearance.',
        'his_physical_appearance.required' => 'Please enter His Physical Appearance.',
        'my_sextual_preferences.required' => 'Please enter Your Sexual Preference.',
        'his_sextual_preferences.required' => 'Please enter His Sexual Preference.',
        'my_social_habits.required' => 'Please enter Your Social Habits.',
        'his_social_habits.required' => 'Please enter His Social Habits.',
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
        $type = isset($data['type']) ? $data['type'] : ''; 
        $lookdate = UserLooksexdateModel::where(['user_id'=>$clientId,'look_type'=>'date'])->first();

        if(count($lookdate))
        {
          if (empty($type)) {
            $response['success'] = 2;
            $response['message'] = 'profile name already exists';
            $http_status = 200;
          }
          else
          {
            if($lookdate->update($data))
            {
              UserLokDatesexTypeModel::where(['user_id'=>$clientId,'lookdatesex_id'=>$lookdate->id])->delete();
              $common->saveLooksexvalue($data,$clientId,$lookdate->id,'date');
              $response['success'] = 1;
              $response['message'] = 'success';
              $data1['id'] = $lookdate->id;
              $response['data'] = $data1;
              $http_status = 200;
            }
            else
            {
              $response['success'] = 0;
              $response['message'] = 'failure';
              $http_status = 400;
            }
          }
        }
        else
        {
          $data['user_id'] = $clientId;
          $data['look_type'] = 'date';
          $userLok = UserLooksexdateModel::create($data);
          if($userLok)
          {
            $common->saveLooksexvalue($data,$clientId,$userLok->id,'date');
            $response['success'] = 1;
            $response['message'] = 'success';
            $data['data1'] = $userLok->id;
            $response['data'] = $data1;
            $http_status = 200;
          }
          else
          {
            $response['success'] = 0;
            $response['message'] = 'failure';
            $response['data'] = $data1;
            $http_status = 400;
          }
        }
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }

    return response()->json($response,$http_status);
  }

  /**
   * Name: getViewLookingDate
   * Purpose: function for list of all the looking date
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function getViewLookingDate() {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $UserLookdate = UserLooksexdateModel::with(['Userdatesextype'=>function($q){ $q->where(['looktype'=>'date'])->get(['lookdatesex_id','type','name']); }])->where(['user_id'=>$clientId,'look_type'=>'date'])->get();

      if(count($UserLookdate))
      {
        $response['success'] = 1;
        $response['message'] = 'success';
        $response['data'] = $UserLookdate;
        $http_status = 200;
      }
      else
      {
        $response['success']=0;
        $response['message'] = 'No data found.';
        $http_status = 400;
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postRenameProfileLookingdates
   * Purpose: function for update profile name for looking date
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postRenameProfileLookingdates(Request $request) {
    try {
      $data = $request->all();
      $id = isset($data['id']) ? $data['id'] : ''; 
    //  $unique =  (isset($id) && !empty($id)) ? 'unique:user_look_datesex,profile_name,'.$id.',id,look_type,date' :'';
      $validator = Validator::make( $request->all()  ,      [
        'id' => 'required',
        'profile_name' => 'required|'.(isset($id) && !empty($id)) ? 'unique:user_look_datesex,profile_name,'.$id.',id,look_type,date' :'',
   //     'profile_name' => 'required|customlookingsex:'$data,
      ],
      [
        'id.required' => 'Please provide looking date id',
        'profile_name.required' => 'Please enter your profile name.',
        'profile_name.unique'    => 'Name already exist.'
      ]);
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']        = 0;
        $http_status = 422;
      }
      else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $lookdate = UserLooksexdateModel::where(['id'=>$data['id'],'look_type'=>'date'])->first();
        if($lookdate)
        {
          if($lookdate->update(['profile_name'=>$data['profile_name']]))   
          {
            $response['success']=1;
            $response['message'] = 'Data update successfully.';
            $http_status = 200;
          }
          else
          {
            $response['success']=0;
            $response['message'] = 'No data update successfully.';
            $http_status = 400;       
          }
        }
        else
        {
          $response['success']=0;
          $response['message'] = 'No data found';
          $http_status = 400;
        }
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postRenameProfileLookingsex
   * Purpose: function for update profile name for looking sex
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postRenameProfileLookingsex(Request $request) {
    try {
      $data = $request->all();
      $id = isset($data['id']) ? $data['id'] : ''; 
    //  $unique =  (isset($id) && !empty($id)) ? 'unique:user_look_datesex,profile_name,'.$id.',id,look_type,date' :'';
      $validator = Validator::make( $request->all()  ,      [
        'id' => 'required',
        'profile_name' => 'required|'.(isset($id) && !empty($id)) ? 'unique:user_look_datesex,profile_name,'.$id.',id,look_type,sex' :'',
        //'profile_name' => 'required|customlookingsex:'$data,
      ],
      [
          'id.required' => 'Please provide looking date id',
          'profile_name.required' => 'Please enter your profile name.',
          'profile_name.unique'    => 'Name already exist.'
      ]);
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']        = 0;
        $http_status = 422;
      }
      else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;

        $lookdate = UserLooksexdateModel::where(['id'=>$data['id'],'look_type'=>'sex'])->first();
        if($lookdate)
        {
          if($lookdate->update(['profile_name'=>$data['profile_name']]))   
          {
            $response['success']=1;
            $response['message'] = 'Data update successfully.';
            $http_status = 200;
          }
          else
          {
            $response['success']=0;
            $response['message'] = 'No data update successfully.';
            $http_status = 400;       
          }
        }
        else
        {
          $response['success']=0;
          $response['message'] = 'No data found';
          $http_status = 400;
        }
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postUpdateProfilelockCount
   * Purpose: function for update count = 0 of lock profile
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postUpdateProfilelockCount(Request $request) {
    try {
      $validator = Validator::make( $request->all()  ,      [
        'viewer_user_id' => 'required'
      ],
      [
        'id.required' => 'Please provide viewer id'
      ]);
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']        = 0;
        $http_status = 422;
      }
      else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
        $ProfileLock = ProfileLockModel::where(['user_id'=>$data['viewer_user_id'],'lock_user_id'=>$clientId])->first();

        if(count($ProfileLock))
        {
            if($ProfileLock->update(['count'=>0]))
            {
              $response['success']=1;
              $response['message'] = 'Data update successfully.';
              $http_status = 200;
            }
            else
            {
              $response['success']=0;
              $response['message'] = 'No data update successfully.';
              $http_status = 400;
            }
        }
        else
        {
          $response['success']=0;
          $response['message'] = 'No data found.';
          $http_status = 400;
        }
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;   
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postLockDetailProfile
   * Purpose: function for update profile detail according to user id.
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postLockDetailProfile(Request $request) {
    try {
      $data = $request->all();
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $browse = isset($data['browse']) ? $data['browse'] : '';

      $ProfileLock = ProfileLockModel::where(['user_id'=>$clientId])->get();
      if($browse)
        $condition = ['user_id'=>$clientId,'browse'=>$browse];
      else
        $condition = ['user_id'=>$clientId];

      if(count($ProfileLock))
      {
        //   if(ProfileLockModel::where($condition)->update(['is_locked'=>1,'count'=>0]))
        if(ProfileLockModel::where($condition)->update(['is_locked'=>2,'count'=>0]))
        {
          $response['success']=1;
          $response['message'] = 'Success';
          $http_status = 200;
        }
        else
        {
          $response['success']=2;
          $response['message'] = 'unable to lock private album';
          $http_status = 200;
        }
      }
      else
      {
        $response['success']=0;
        $response['message'] = 'No data found.';
        $http_status = 400;
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postMoveArchiveToPrivate
   * Purpose: function for move archive image to user ablem
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/

  public function postMoveArchiveToPrivate(Request $request) {
    try {
      $validator = Validator::make( $request->all()  ,      [
        'id' => 'required'
      ],
      [
        'id.required' => 'Please provide picture id'
      ]);
      if ($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']        = 0;
        $http_status = 422;
      }
      else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
        $arrpicid = explode(',', $data['id']);
        foreach ($arrpicid as $key => $value) {
          $UserArchive = ArchiveModel::where(['id'=>$value])->first();
          if ($UserArchive) 
          {
            $photoname = $UserArchive->photo_name;
            $caption = $UserArchive->caption;
            $data1 = array(
                'user_id' => $clientId,
                'photo_name' => $UserArchive->photo_name,
                'caption' => $UserArchive->caption,
                    //'creation_date' => date('Y-m-d H:i:s')
            );
            

            if (UseralbumModel::create($data1)) 
            {
              $UserArchive->delete();
              $response['success'] = 1;
              $response['message'] = 'success';
              $http_status = 200;
            }
            else {
              $response['success'] = 0;
              $respo0nse['message'] = 'failure';
              $http_status = 400;
            }
          } 
          else 
          {
            $response['success'] = 2;
            $response['message'] = 'pic id not valid';
            $http_status = 200;
          }
        }
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postManageAlbumAccess
   * Purpose: function for manage album access
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postManageAlbumAccess() {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $user = User::with(['Profile','Sharealbum'])->where(['role'=>2,])->where('status','!=',2);
      
      $accesslist = $user->whereHas('Sharealbum',function($q1) use ($clientId){
        $q1->where(['sender_id'=>$clientId,'is_received'=>1]);
      })->get();
     
     if(count($accesslist))
     {
        $response['success'] = 1;
        $response['message'] = 'success';
        $response['data'] = $accesslist;
        $http_status = 200;
     }
     else
     {
        $response['success'] = 0;
        $response['message'] = 'No data found.';
        $http_status = 400;
     }   
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postManageAlbumAccess
   * Purpose: function for add recently image inti archive table
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postAddRecentImage(Request $request) {
    try {
      $validator = Validator::make( $request->all()  ,      [
        'image' => 'required'
      ],
      [
        'image.required' => 'Please provide image.'
      ]);
      if($validator->fails()) {
        $response['errors']     = $validator->errors();
        $response['success']        = 0;
        $http_status = 422;
      }
      else
      {
        $data = $request->all();
        $recent_image['user_id'] = JWTAuth::parseToken()->authenticate()->id;
        $recent_image['photo_name'] = $data['image'];
        if(ArchiveModel::create($recent_image))
        {
          $response['success'] = 1;
          $response['message'] = 'Successfully save into database.';
          $http_status = 200;
        }
        else
        {
          $response['success'] = 0;
          $response['message'] = 'Unable to save into database.';
          $http_status = 400;
        }
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postManageAlbumAccess
   * Purpose: function for list of profile view
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function getProfileViewersDetails(Repositary $common) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $block_id = [];
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

      $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'viewed_you');  

      /*             * *********update viewer table is_view********** */
      ViewerModel::where(['viewer_user_id'=>$clientId])->update(['is_view'=>0]);
      /*             * ************END*************** */  

      //$user = User::where('status','!=',0)->where(['role'=>2]);

      $profile_viewers = User::whereHas('viewerDetail',function($q) use ($clientId){
                                           $q->where(['viewer_user_id'=>$clientId])
                                             ->orderBy('created_at','ASC');
                                      })
                                      ->with(['Profile','viewerDetail'])
                                      ->where('id','!=',$clientId)
                                      ->whereNotIn('id',$block_id)
                                      ->where('status','!=',0)
                                      ->where(['role'=>2])
                                      ->limit($limit)
                                      ->get();

      if(count($profile_viewers))
      {
        $response['success']=1;
        $response['message'] = 'Success.';
        $response['data'] = $profile_viewers;
        $http_status = 200; 
      }
      else
      {
        $response['success']=0;
        $response['message'] = 'No data found.';
        $http_status = 400;   
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postManageAlbumAccess
   * Purpose: function for list of profile view
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function getProfileViewedDetails(Repositary $common) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $block_id = [];
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

      $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'you_viewed');  

      /*             * *********update viewer table is_view********** */
      ViewerModel::where(['viewer_user_id'=>$clientId])->update(['is_view'=>0]);
      /*             * ************END*************** */  

      // $user = User::where('status','!=',0)->where(['role'=>2]);

      $profile_viewers = User::whereHas('viewedDetail',function($q) use ($clientId){
                                           $q->where(['user_id'=>$clientId])
                                             ->orderBy('created_at','ASC');
                                      })
                                      ->with(['Profile','viewerDetail'])
                                      ->where('id','!=',$clientId)
                                      ->whereNotIn('id',$block_id)
                                      ->where('status','!=',0)
                                      ->where(['role'=>2])
                                      ->limit($limit)
                                      ->get();

      if(count($profile_viewers))
      {
        $response['success']=1;
        $response['message'] = 'Success.';
        $response['data'] = $profile_viewers;
        $http_status = 200; 
      }
      else
      {
        $response['success']=0;
        $response['message'] = 'No data found.';
        $http_status = 400;   
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: getUseProfileLooksex
   * Purpose: function for list of looking users
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postUseProfileLooksex(request $request,Repositary $common){
      try {
          $validator = Validator::make( $request->all()  ,      [
              'id' => 'required'
              ],
              [
                  'id.required' => 'Please enter id.'
              ]);
          if ($validator->fails()) {
              $response['errors']     = $validator->errors();
              $response['success']        = 0;
              $http_status = 422;
          }
          else
          {
              $clientId = JWTAuth::parseToken()->authenticate()->id;
              $data = $request->all();
              $current_date = Carbon::now();
              $is_view = $is_share = $is_profile_active = $total_unread_message =  0;
              $filter_cache =[];
              $block_id = [];
              $type = isset($data['type'])?$data['type']:''; 
              $user =User::where('status','!=',0)->where('role',2);
              $user2 =User::where('status','!=',0)->where('role',2);              
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
              $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'Match');
              $limit = $limit - 1;
              //=========End================//

              $checklookingSex = UserLooksexdateModel::where(['id'=>$data['id'],'look_type'=>'sex'])->first();
              if(count($checklookingSex))
              {
                  /*                 * *******userlook date profile ************* */
                  $if_exist_looking_profile = UserLooksexdateModel::with(['Userdatesextype'])->where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->where(['user_id'=>$clientId,'look_type'=>'sex'])->first();
                  /*                 * ********End************** */

                  /******Get result for all User with chat, profile of user********/
                  $user = $user->whereHas('UserLooKSexType',function($q2) use ($current_date){})         ->with(['ChatFromUser'=>function($q3) use ($clientId){
                      $q3->where(['from_user'=>$clientId]);
                  },'ChatToUser'=>function($q4) use ($clientId){
                      $q4->where(['to_user'=>$clientId]);
                  },'Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity','UserLooKSexType'=>function($q1) use ($current_date){
                      $q1->where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->where(['look_type'=>'sex']); }])
                               ->where(['registration_status'=>3])
                               ->whereNotIn('id',$block_id)
                                      //->where('id','!=',$clientId)
                               ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));

                          $user_data = $user->limit($limit)
                          ->orderBy('distance','ASC')
                          ->get();     

                  $total_unread_message = 0;
                  
                  /*                 * ********End*********** */
                  //***************for filter chache**********//
                  $if_exist_save_filter = MatchFilterModel::where(['user_id'=>$clientId,'type'=>'looking'])->first();
                      if ($if_exist_save_filter) {
                          $filter_cache = $if_exist_save_filter;
                      }
                  /*                 * ********End*********** */
                      
                  $UserData = array();  
                  $UserData1 = array();  


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

                      /*                 * *****check profile active ********* */
                      $is_profile_active = $common->check_profile_active($current_date, $clientId);
                      /*                 * ********END***************** */
                      
                      foreach ($user_data as $key => $value) {
                          $percentage = 0;
                         $user_his_identitie = User::with(['UserIdentity'=>function($q){
                              $q->where(['type'=>'his_identites']);
                          }])->where(['id'=>$clientId])->first(); 

                         if(count($if_exist_looking_profile))
                         {

                              if(isset($value['UserLooKSexType']))
                              {
                                 foreach($value['UserLooKSexType'] AS $val)
                                  {
                                      $percentage1 = $common->calculatepercentage($if_exist_looking_profile['Userdatesextype'],$val['Userdatesextype']);
                                      $percentage2 = $common->calculatepercentage($user_his_identitie['UserIdentity'],$value['UserIdentity']);
                                      $percentage = $percentage1 + $percentage2;
                                  }
                              } 
                          }   
                          if($percentage>0)
                          {
                              $percentage = round(($percentage * 100) / 400);   
                          }
                          else
                          {
                              $percentage = 0;
                          }
                          $user_data[$key]['percentage'] = $percentage ;
                          
                          if(!empty($value->last_seen))
                          {
                              $user_data[$key]['lastseen'] = $value->last_seen;
                              $user_data[$key]['last_seen'] = $common->check_difference_in_hours($value->last_seen);
                          }
                          else
                          {
                              $user_data[$key]['lastseen'] = '0000-00-00 00:00:00';
                              $user_data[$key]['last_seen'] = 2;
                          }
                          $user_data[$key]['looking_profile_active'] = $common->check_profile_active($current_date, $value['User']['id']);
                           $accuracy_value[] = $value['accuracy'];
                      }

                      /********End******** */

                      /********Calculate Distance between login user and another user ******** */
                      $arrKey = '';
                      if($user_data)
                      {
                           $arrKey = in_array($clientId, array_column($user_data->toArray(), 'id'));   
                      }
                      $loggedInUser = [];
                      if($arrKey)
                      {
                          
                          $loggedInUser = $user2->whereHas('UserLooKSexType',function($q2){})                  ->with(['ChatFromUser','ChatToUser','Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity','UserLooKSexType'=>function($q1) use ($current_date){
                                  $q1->where('start_time','<=',$current_date)->where('end_time','>=',$current_date)->where(['look_type'=>'sex']); }])
                                              ->where(['id'=>$clientId])
                                              ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));
                          
                          $loggedInUser = $loggedInUser->get();
                          if(count($loggedInUser)>0)
                          {
                              foreach($loggedInUser As $key1 => $value1)
                              {
                                 $percentage = 0; 
                                 if(count($if_exist_looking_profile))
                                 {
                                      if(isset($value1['UserLooKSexType']))
                                      {
                                         foreach($value1['UserLooKSexType'] AS $val)
                                          {
                                              $percentage1 = $common->calculatepercentage($if_exist_looking_profile['Userdatesextype'],$val['Userdatesextype']);
                                              $percentage2 = $common->calculatepercentage($user_his_identitie['UserIdentity'],$value1['UserIdentity']);
                                              $percentage = $percentage1 + $percentage2;
                                          }
                                      } 
                                  }   
                                  if($percentage>0)
                                  {
                                      $percentage = round(($percentage * 100) / 400);   
                                  }
                                  else
                                  {
                                      $percentage = 0;
                                  }
                                  $loggedInUser[$key1]['percentage'] = $percentage ;
                              }

                              if(!empty($value1->last_seen))
                              {
                                  $loggedInUser[$key1]['lastseen'] = $value1->last_seen;
                                  $loggedInUser[$key1]['last_seen'] = $common->check_difference_in_hours($value1->last_seen);
                              }
                              else
                              {
                                  $loggedInUser[$key1]['lastseen'] = '0000-00-00 00:00:00';
                                  $loggedInUser[$key1]['last_seen'] = 2;
                              }
                              $loggedInUser[$key1]['looking_profile_active'] = $common->check_profile_active($current_date, $value1['User']['id']);
                              $accuracy_value[] = $value1['accuracy'];
                          }

                          if(count($loggedInUser) > 0)
                          {
                              $UserData = $loggedInUser->toArray();
                          }

                          if(count($user_data) > 0)
                          {
                              $UserData1    = $user_data->toArray();
                          }
                      }

                      /********End******** */
                      
                      $user_data = array_merge($UserData,$UserData1); 

                      $user_data = array_values(array_map("unserialize", array_unique(array_map("serialize", $user_data))));

                      /********Get Maximum accuracy for the users.******** */
                      if(count($accuracy_value))
                      {
                         $accuracy_max_value = (int) max($accuracy_value);
                      }
                      /********End******** */
                      /********for give user looksex data******** */
                      $user_looksexdata = array();
                      $user_looksex = UserLooksexdateModel::where([
                                                                  'user_id'=>$clientId,
                                                                  'look_type'=>'sex'])
                                                              ->where('start_time','<=',$current_date)
                                                              ->where('end_time','>=',$current_date)
                                                              ->first();
                      if(count($user_looksex))
                      {
                          $user_looksexdata = $user_looksex;
                          $is_profile_active = 1;
                      }       
                      else
                      {
                          $is_profile_active =0;
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
              }     
              else
              {
                  $response['success'] = 0;
                  $response['message'] = ['data not found'];
                  $http_status = 400;
              }      
          }
      } catch (\Exception $e) {
          $response['success']=0;
          $response['message'] = $e->getMessage();
          $http_status = 400;
      }

      return response()->json($response,$http_status);
  }

  /**
   * Name: getUseProfileLooksex
   * Purpose: function for list of looking users
   * created By: Lovepreet
   * Created on :- 10 Oct 2017
   *
   **/
  public function postUseProfileLookdate(request $request,Repositary $common){
    try {
        $validator = Validator::make( $request->all()  ,      [
            'id' => 'required'
            ],
            [
                'id.required' => 'Please enter id.'
            ]);
        if ($validator->fails()) {
            $response['errors']     = $validator->errors();
            $response['success']        = 0;
            $http_status = 422;
        }
        else
        {
            $clientId = JWTAuth::parseToken()->authenticate()->id;
            $data = $request->all();
            $current_date = Carbon::now();
            $is_view = $is_share = $is_profile_active = $total_unread_message =  0;
            $filter_cache =[];
            $block_id = [];
            $type = isset($data['type'])?$data['type']:''; 
            $user =User::where('status','!=',0)->where('role',2);
            $user2 =User::where('status','!=',0)->where('role',2);              
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
            $limit = $common->getlimit(JWTAuth::parseToken()->authenticate()->member_type, 'Match');
            $limit = $limit - 1;
            //=========End================//

            $checklookingdate = UserLooksexdateModel::where(['id'=>$data['id'],'look_type'=>'date'])->first();
            if(count($checklookingdate))
            {
                /*                 * *******userlook date profile ************* */
                $if_exist_looking_profile = UserLooksexdateModel::with(['Userdatesextype'])->where(['user_id'=>$clientId,'look_type'=>'date'])->first();
                /*                 * ********End************** */

                /******Get result for all User with chat, profile of user********/
                $user = $user->whereHas('UserLooKSexType',function($q2) use ($current_date){})         ->with(['ChatFromUser'=>function($q3) use ($clientId){
                    $q3->where(['from_user'=>$clientId]);
                },'ChatToUser'=>function($q4) use ($clientId){
                    $q4->where(['to_user'=>$clientId]);
                },'Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity','UserLooKSexType'=>function($q1) use ($current_date){
                          $q1->where(['look_type'=>'date']); 
                      }])
                             ->where(['registration_status'=>3])
                             ->whereNotIn('id',$block_id)
                                    //->where('id','!=',$clientId)
                             ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));

                        $user_data = $user->limit($limit)
                        ->orderBy('distance','ASC')
                        ->get();     

                $total_unread_message = 0;
                
                /*                 * ********End*********** */
                //***************for filter chache**********//
                $if_exist_save_filter = MatchFilterModel::where(['user_id'=>$clientId,'type'=>'dating'])->first();
                    if ($if_exist_save_filter) {
                        $filter_cache = $if_exist_save_filter;
                    }
                /*                 * ********End*********** */
                    
                $UserData = array();  
                $UserData1 = array();  


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
                    
                    foreach ($user_data as $key => $value) {
                        if(!empty($value->last_seen))
                        {
                            $user_data[$key]['lastseen'] = $value->last_seen;
                            $user_data[$key]['last_seen'] = $common->check_difference_in_hours($value->last_seen);
                        }
                        else
                        {
                            $user_data[$key]['lastseen'] = '0000-00-00 00:00:00';
                            $user_data[$key]['last_seen'] = 2;
                        }
                        $user_data[$key]['looking_profile_active'] = $common->check_profile_active($current_date, $value['User']['id']);
                         $accuracy_value[] = $value['accuracy'];
                    }

                    /********End******** */

                    /********Calculate Distance between login user and another user ******** */
                    $arrKey = '';
                    if($user_data)
                    {
                         $arrKey = in_array($clientId, array_column($user_data->toArray(), 'id'));   
                    }
                    $loggedInUser = [];
                    if($arrKey)
                    {
                        
                        $loggedInUser = $user2->whereHas('UserLooKSexType',function($q2){})                  ->with(['ChatFromUser','ChatToUser','Profile'=>function($q){$q->select('id','user_id','identity','his_identitie','relationship_status');},'Userpartner','UserIdentity','UserLooKSexType'=>function($q1) use ($current_date){
                                         $q1->where(['look_type'=>'date']); 
                                        }])
                                            ->where(['id'=>$clientId])
                                            ->select(DB::raw("( 6371 * acos( cos( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * cos( radians( users.lat ) ) * cos( radians(users.long) - radians(" . JWTAuth::parseToken()->authenticate()->long . ") ) + sin( radians(" . JWTAuth::parseToken()->authenticate()->lat . ") ) * sin( radians( users.lat ) ) ) ) AS distance , users.*"));
                        
                        $loggedInUser = $loggedInUser->get();
                        if(count($loggedInUser)>0)
                        {
                            foreach($loggedInUser As $key1 => $value1)
                            {
                                if(!empty($value1->last_seen))
                                {
                                    $loggedInUser[$key1]['lastseen'] = $value1->last_seen;
                                    $loggedInUser[$key1]['last_seen'] = $common->check_difference_in_hours($value1->last_seen);
                                }
                                else
                                {
                                    $loggedInUser[$key1]['lastseen'] = '0000-00-00 00:00:00';
                                    $loggedInUser[$key1]['last_seen'] = 2;
                                }
                                $loggedInUser[$key1]['looking_profile_active'] = $common->check_profile_active($current_date, $value1['User']['id']);
                                $accuracy_value[] = $value1['accuracy'];
                            }
                            
                        }

                        if(count($loggedInUser) > 0)
                        {
                            $UserData = $loggedInUser->toArray();
                        }

                        if(count($user_data) > 0)
                        {
                            $UserData1    = $user_data->toArray();
                        }
                    }

                    /********End******** */
                    
                    $user_data = array_merge($UserData,$UserData1); 

                    $user_data = array_values(array_map("unserialize", array_unique(array_map("serialize", $user_data))));

                    /********Get Maximum accuracy for the users.******** */
                    if(count($accuracy_value))
                    {
                       $accuracy_max_value = (int) max($accuracy_value);
                    }
                    /********End******** */
                    /********for give user looksex data******** */
                    $user_looksexdata = array();
                    $user_looksex = UserLooksexdateModel::where([
                                                                'user_id'=>$clientId,
                                                                'look_type'=>'sex'])
                                                            ->where('start_time','<=',$current_date)
                                                            ->where('end_time','>=',$current_date)
                                                            ->first();
                    if(count($user_looksex))
                    {
                        $user_looksexdata = $user_looksex;
                        $is_profile_active = 1;
                    }       
                    else
                    {
                        $is_profile_active =0;
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
            }     
            else
            {
                $response['success'] = 0;
                $response['message'] = ['data not found'];
                $http_status = 400;
            }      
        }
    } catch (\Exception $e) {
        $response['success']=0;
        $response['message'] = $e->getMessage();
        $http_status = 400;
    }

    return response()->json($response,$http_status);
  }

  /**
   * Name: postProfileDetail
   * Purpose: function for profile detail of current details.
   * created By: Lovepreet
   * Created on :- 25 Oct 2017
   *
   **/
  public function postProfileDetail(Request $request){
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $user_data = User::with('Profile','Userpartner')
                  ->where(['id'=>$clientId])
                  ->first();
      if(count($user_data))
      {
        $response['success'] = 1;
        $response['data'] =  ['user' => $user_data];
        $http_status = 200;   
      }   
      else
      {
        $response['success'] = 0;
        $response['message'] = ['data not found'];
        $http_status = 400;
      }
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: getPaymentDetails
   * Purpose: function for get detail of user and subscription.
   * created By: Lovepreet
   * Created on :- 25 Oct 2017
   *
   **/
  public function getPaymentDetails(Request $request) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $subscriptions_arr = [];
      $login_user = User::with(['Profile','Userpartner'])->where(['id'=>$clientId])->get();
      $subscriptions = SubcriptionModel::orderBy('month','ASC')->get();
      if(count($subscriptions)>0)
      {
          $subscriptions_arr = $subscriptions->toArray();
      }
      $response['success'] = 1;
      $response['success'] = 'success';
      $response['data'] = ['server_time_zone'=>Carbon::now()->timezoneName,'subscription'=>$subscriptions_arr,'login_user'=>$login_user];
      $http_status = 200;
    } catch (\Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postPaymentSuccess
   * Purpose: function for Update the user detail.
   * created By: Lovepreet
   * Created on :- 25 Oct 2017
   *
   **/
  public function postPaymentSuccess(Request $request) {
    try {
      $validator = Validator::make( $request->all()  ,      [
          'payment_for' => 'required',
          'amount'=>'required',
          'month'=>'required'
      ],
      [
          'payment_for.required' => 'Payment for should not be blank.',
          'amount.required'    => 'Amount should not be blank.',
          'month.required'   => 'Month should not be blank.'  
      ]);
      if ($validator->fails()) {
          $response['success']   = 0;
          $response['errors']   = $validator->errors();
          $http_status=422;
      }else{
        $data = $request->all();

        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $user = User::where(['id'=>$clientId])->first();
        if(count($user))
        {
          if(Carbon::now()->parse(JWTAuth::parseToken()->authenticate()->valid_upto) >Carbon::now())
          {
              $valid_upto = Carbon::now()->parse(JWTAuth::parseToken()->authenticate()->valid_upto)->addMonths($data['month']);
          }
          else
          {
              $valid_upto = Carbon::now()->addMonths($data['month']);
          }

          if($data['payment_for'] == 1)
          {
              if($user->update(['is_trial'=>0,'member_type'=>1,'valid_upto'=>$valid_upto]))
              {
                  $response['success'] = 1;
                  $response['message'] = 'Success';
                  $http_status = 200;
              }
              else
              {
                  $response['success'] = 0;
                  $response['message'] = 'Faliure';
                  $http_status = 400;
              }
          }
          else
          {
              if($user->update(['removead'=>1,'removead_valid_upto'=>$valid_upto]))
              {
                  $response['success'] = 1;
                  $response['message'] = 'Success';
                  $http_status = 200;
              }
              else
              {
                  $response['success'] = 0;
                  $response['message'] = 'Faliure';
                  $http_status = 400;
              }
          }
        }
        else
        {
            $response['success'] = 0;
            $response['message'] = 'No data found.';
            $http_status = 400;
        }
      }
    } catch (Exception $e) {
        $response['success']=0;
        $response['message'] = $e->getMessage();
        $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postStopCurrentSearch
   * Purpose: function for stop the current profile.
   * created By: Lovepreet
   * Created on :- 25 Oct 2017
   *
   **/
  public function postStopCurrentSearch(Request $request) {
    try {
      $validator = Validator::make( $request->all()  ,      [
          'id' => 'required'
      ],
      [
          'id.required' => 'Profile id not be blank.' 
      ]);
      if ($validator->fails()) {
          $response['success']   = 0;
          $response['errors']   = $validator->errors();
          $http_status=422;
      }else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
        $if_exist_profile = UserLooksexdateModel::where(['user_id'=>$clientId,'id'=>$data['id'],'look_type'=>'sex'])->first();

        if(count($if_exist_profile))
        {
          if($if_exist_profile->update(['end_time'=>Carbon::now()->addMinutes(-1)]))
          {
            $response['success'] = 1;
            $response['message'] = 'success';
            $http_status = 200;
          }
          else
          {
            $response['success'] = 2;
            $response['message'] = 'unable to update';
            $http_status = 400;
          }
        }
        else
        {
          $response['success'] = 3;
          $response['message'] = 'profile not exists';
          $http_status = 400;
        }
      }
    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postEditProfile
   * Purpose: function for edit profile.
   * created By: Lovepreet
   * Created on :- 30 Oct 2017
   *
   **/
  public function postEditProfile(Request $request) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $data = $request->all();
      $data['birthday'] = isset($data['birthday']) ? $data['birthday'] : '0000-00-00 00:00:00';
      $data['start_time'] = isset($data['start_time']) ? $data['start_time'] : '0000-00-00 00:00:00';
      $data['end_time'] = isset($data['end_time']) ? $data['end_time'] : '0000-00-00 00:00:00';

      $profile = ProfileModel::where(['user_id'=>$clientId])->first();
      if(count($profile))
      {
        $profile->update($data);
      }
      $data1['screen_name'] = $data['screen_name']; 
      $data1['email'] = $data['email'];
      User::where(['id'=>$clientId])->update($data1);
      if($profile['about_me'] != $data['about_me'])
      {
        User::where(['id'=>$clientId])->update(['profiletext_change'=>1,'profile_text_change_date'=>Carbon::now()]);
      }
      $response['success']=1;
      $response['message'] = 'Success';
      $http_status = 200;
    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postPartnerProfile
   * Purpose: function for add or update partner profile.
   * created By: Lovepreet
   * Created on :- 30 Oct 2017
   *
   **/
  public function postPartnerProfile(Request $request) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $data = $request->all();
      $userPartner = UserpartnerModel::where(['user_id'=>$clientId])->first();
      $data['id'] = '';
      if($userPartner)
      {
        $data['id'] = $userPartner->id;
      }
      if(UserpartnerModel::updateOrCreate(['id'=>$data['id']],$data))
      {
        $response['success'] = 1;
        $response['message'] = 'Success';
        $http_status = 200;
      }
      else
      {
        $response['success'] = 0;
        $response['message'] = 'Failure';
        $http_status = 400;
      }
    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postBlockChatUser
   * Purpose: function for add or update block user.
   * created By: Lovepreet
   * Created on :- 25 Oct 2017
   *
   **/
  public function postBlockChatUser(Request $request) {
    try {
      $validator = Validator::make( $request->all()  ,      [
          'block_user_id' => 'required'
      ],
      [
          'block_user_id.required' => 'Block user id not be blank.' 
      ]);
      if ($validator->fails()) {
          $response['success']   = 0;
          $response['errors']   = $validator->errors();
          $http_status=422;
      }else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $current_date = Carbon::now();
        $data = $request->all();
        $block_chat = BlockChatUserModel::where(['user_id'=>$clientId,'block_user_id'=>$data['block_user_id']])->first();
        $data['id'] = '';
        $data['user_id'] = $clientId;
        $data['is_blocked'] = 1;
        if($block_chat)
        {
          $data['id'] = $block_chat->id;
          if ($block_chat->is_blocked == 1) 
          {
            $data['is_blocked'] = 2;
          }
        }
        if(BlockChatUserModel::updateOrCreate(['id'=>$data['id']],$data))
        {
          $response['success'] = 1;
          $response['message'] = 'Success';
          $http_status = 200;
        }
        else
        {
          $response['success'] = 0;
          $response['message'] = 'Success';
          $http_status = 400;
        }
      }

    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400; 
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: getSetting
   * Purpose: function for settings.
   * created By: Lovepreet
   * Created on :- 25 Oct 2017
   *
   **/
  public function getSetting(Repositary $common) {
    try {
      $clientId = JWTAuth::parseToken()->authenticate()->id;
      $user = User::with('Userpartner','Profile')->where(['id'=>$clientId])->first();
      $count_view = $common->count_view($clientId);
      $count_sharealbum = $common->count_sharealbum($clientId);
      if(count($user))
      {
        $response['success'] = 1;
        $response['data'] = ['user'=>$user,'count_view'=>$count_view,'count_album'=>$count_sharealbum];
        $http_status = 200;
      }
      else
      {
        $response['success'] = 0;
        $response['message'] = 'No data found';
        $http_status = 400;
      }
    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400; 
    }
    return response()->json($response,$http_status);
  }  

  /**
   * Name: postCheckIsActive
   * Purpose: function for update the notify.
   * created By: Lovepreet
   * Created on :- 25 Oct 2017
   *
   **/
  public function postCheckIsActive() {
    try {
      $current_date = Carbon::now();
      $if_exist_profile = UserLooksexdateModel::where('notification_time','<=',$current_date)->where(['is_notify'=>0,'look_type'=>'sex'])->lists('id');
     // print_r($if_exist_profile); die;
      if(count($if_exist_profile))
      {
        UserLooksexdateModel::whereIn('id',$if_exist_profile->toArray())->update(['is_notify'=>1]);
        $response['success']=1;
        $response['message'] = 'Success';
        $http_status = 400; 
      }
      else
      {
        $response['success']=0;
        $response['message'] = 'Failure';
        $http_status = 400;   
      }
    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400; 
    }
    return response()->json($response,$http_status);
  }

  /**
   * Name: postChangePassword
   * Purpose: function for update password.
   * created By: Lovepreet
   * Created on :- 25 Oct 2017
   *
   **/
  public function postChangePassword(Request $request) {
    try {
      $validator = Validator::make( $request->all()  ,      [
          'password' => 'required|confirmed|min:8|max:16',
          'password_confirmation'=>'required'
      ],
      [
          'password.required' => 'Password field not be blank.', 
          'password_confirmation.required' => 'Confirm password field not be blank.'
      ]);
      if ($validator->fails()) {
          $response['success']   = 0;
          $response['errors']   = $validator->errors();
          $http_status=422;
      }else
      {
        $clientId = JWTAuth::parseToken()->authenticate()->id;
        $data = $request->all();
        $user = User::find($clientId);
        $user->password=Hash::make($data['password']);
        if(Hash::check($data['password'], Auth::user()->password))
        {
          $response['success'] = 3;
          $response['message'] = 'old password and new password same';
          $http_status = 200;
        }
        else
        {
         if($user->save())
         {
          $response['success'] = 1;
          $response['message'] = 'successfully change password';
          $http_status = 200;
         }
         else
         {
          $response['success'] = 0;
          $response['message'] = 'password can not be Changed';
          $http_status = 400;
         }
        }
      }
    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400; 
    }
    return response()->json($response,$http_status);
  }

  public function postChatNotification(Request $request)
  {
    try {
      
      $response['success']=1;
      $response['message'] = 'Succcess';
      $http_status = 200;
    } catch (Exception $e) {
      $response['success']=0;
      $response['message'] = $e->getMessage();
      $http_status = 400;  
    }
    return response()->json($response,$http_status);
  }
}
