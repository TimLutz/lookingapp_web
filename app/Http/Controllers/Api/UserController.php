<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MasterHearAboutAndIdProof;
use App\Model\User;
use App\Model\ContactUs;
use Validator;
use JWTAuth;
use App\Http\Repositary\CommonRepositary;
use App\Model\EmailTemplate;
use App\Model\EmailVerification;
use App\Jobs\SendOtpEmail;

class UserController extends Controller
{
    //
    public function __construct()
    {
    	//$this->middleware('jwtcustom');
    }

    /*=============================================================================================
    Function for get master hear about us and id proof data
    ===============================================================================================
    */
    public function getHearAboutIdProof(){
    	if($response['data']['hear_about_us']= MasterHearAboutAndIdProof::where(array('status'=>true,'type'=>1))->get()){
    			$response['data']['id_proof']=MasterHearAboutAndIdProof::where(array('status'=>true,'type'=>2))->get();
    			$response['status']=1;
    			$http_status=200;
    	}else{
    		$response['errors']='No Data found!!!';
    		$response['status']=0;
    		$http_status=200;
    	}
    	return response()->json($response,$http_status);
    }
    /*=============================================================================================
    Function for save general information
    ===============================================================================================
    */
    public function postGeneralInfo(Request $request){
    	$validator = Validator::make( $request->all()  ,      [
           
			'address' 			=> 'required',
			'sin_number' 		=> 'required',
			'dob' 		        => 'required',
			'source' 		    => 'required',
			'id_proofs'         => 'required|array',
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$http_status            =400;
			$response['status']		= 0;
        }else{

	    	$user=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first();
	    	$data=$request->all();
	    	$data['dob']=\Carbon\Carbon::createFromFormat('d-m-Y',$request->input('dob'));
	    	$data['profile_complete']=4;
	    	if($user && $user->update($data)){
	    		$response['message']='Info saved successfully.';
	    		$response['status']=1;
	    		$http_status=200;
	    	}else{
	    		$response['message']='No such user found.';
	    		$response['status']=0;
	    		$http_status=200;
	    	}
    	}
    	return response()->json($response,$http_status);
    }


    /*=============================================================================================
    Function for get general information
    ===============================================================================================
    */
    public function getGeneralInfo(){
    	$response['data'] =User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first();
    	$response['status']   =1;
    	return response()->json($response,200);
    }

    /*=============================================================================================
    Function for get that user is approved or not
    ===============================================================================================
    */
    public function getApprovedInfo(){
        $response['approved'] =User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->value('approved');
        $response['status']   =1;
        return response()->json($response,200);
    }

    /*=============================================================================================
    Function for edit Profile
    ===============================================================================================
    */
    public function EditProfile(Request $request,CommonRepositary $common){
        $validator = Validator::make( $request->all()  ,
            [
                'phone'     => 'required|unique:users,phone,'.JWTAuth::parseToken()->authenticate()->_id.',_id',
    			'email' 	=> 'email|unique:users,email,'.JWTAuth::parseToken()->authenticate()->_id.',_id'
            ],
            [
                'email.email'       => 'Please fill valid email',
                'email.unique'      => 'Sorry email already exists',
                'phone.unique'      => 'Mobile number already exists',
                'phone.required'    => 'Mobile number is required'
            ]

        );
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors()->first();
           	$http_status            =400;
			$response['status']		= 0;
        }else{
        	
	        $user=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first();
	        $user_ref=$user;
	        $data=$request->all();
	        if($request->has('dob')){
	            $data['dob']=\Carbon\Carbon::createFromFormat('d-m-Y',$request->input('dob'));
	        }

            if($request->has('email')){
                $code=str_random(30);
                $emal_verification=new EmailVerification(array('code'=>$code,'status'=>true,'email'=>$request->input('email') ));
                if($emal_verification->save()){
                    $template=EmailTemplate::find('596866ddb098f0348a7995e7');
                    $link='<a href='.url('/email_verification/'.$code).'>Click Here</a>';
                    $find=array('@name@','@company@', '@link@' );
                    $values=array($user['first_name'],env('MAIL_COMPANY'),$link);
                    $body=str_replace($find,$values,$template->content);
                    $this->dispatch(new SendOtpEmail($body,$request->input('email'),$template));
                }
            }

	        if($request->has('phone_update') && $request->has('country_code')){
	            $data['otp']=$common->randomGenerator();
	            $response['otp']=$data['otp'];
	            $common->sendText($request->input('country_code').$request->input('phone_update'),'Hello! Welcome to MadWall. Here is the code: '.$data['otp'].'. Please confirm it in the app. Thanks!');
	        }
	        if($user->update($data)){
	            $response['message']='Profile updated successfully';
	            
	            $response['status']=1;
	            $http_status=200;
	        }else{
	            $response['errors']='Something went wrong';
	            $response['status']=0;
	            $http_status=400;
	        }
	    }
        return response()->json($response,$http_status);
    }



    /*=============================================================================================
    Function for verify mobile if updated
    ===============================================================================================
    */
    public function updateMobile(Request $request){
    	$validator = Validator::make( $request->all()  ,      [
           
			'phone_update' 		=> 'required',
			'otp' 				=> 'required',
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$http_status            =400;
			$response['status']		= 0;
        }else{
    		$user=User::where(array("otp"=>$request->input('otp')))->first();
    		if($user && $user->update(array('phone'=>$request->input('phone_update')))){
    			
    			$response['status']=1;
    			$http_status=200;
    		}else{
    			$response['errors']='Invalid OTP';
    			$response['status']=0;
    			$http_status=200;
    		}
    	}
    	return response()->json($response,$http_status);
    }
    /*=============================================================================================
    Function for resend otp on profile screen
    ===============================================================================================
    */
    public function updateMobileOtp(Request $request,CommonRepositary $common){
    	$validator = Validator::make( $request->all()  ,      [
           
			'phone_update' 		=> 'required',
			'country_code'		=> 'required',
			
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$http_status            =400;
			$response['status']		= 0;
        }else{
    		$user=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first();
    		$otp=$common->randomGenerator();
    		$common->sendText($request->input('country_code').$request->input('phone_update'),'Hello! Welcome to MadWall. Here is the code: '.$otp.'. Please confirm it in the app. Thanks!');
    		if($user && $user->update(array('otp'=>$otp))){
    			$response['otp']=$otp;
    			$response['status']=1;
    			$http_status=200;
    		}else{
    			
    			$response['status']=0;
    			$http_status=400;
    		}
    	}
    	return response()->json($response,$http_status);
    }


    /*=============================================================================================
    Function for get user  Profile
    ===============================================================================================*/
    public function getProfile(Request $request){
        
        
        if($response['response']=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first()){
            
            $response['status']=1;
            $http_status=200;
        }else{
            $response['errors']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }
    
    /*=============================================================================================
    Function for get dashboard info
    ===============================================================================================
    */
    public function DashboardInfo(Request $request){
        if($response['user']=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first()){
            $response['applications']   =46;
            $response['earnings']       =234;
            $response['jobs_offered']    =245;
            $response['status']         =1;
            $http_status=200;
        }else{
            $response['errors']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        
        return response()->json($response,$http_status);
    }
    /*=================================================================================
    function for contact us api
    ===================================================================================*/
    public function saveContactUs(Request $request){
        $validator = Validator::make( $request->all()  ,      [
            'subject'           => 'required',
            'content'           => 'required',
            'type'              => 'required'
            
        ]);
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors()->first();
            $http_status            =400;
            $response['status']     = 0;
        }else{
            $data=$request->all();
            $data['user_id']=JWTAuth::parseToken()->authenticate()->_id;
            $data['is_deleted'] = false;
            $data['subject'] = $request->input('subject');
            $data['file_name'] = $request->input('file_name');
            $data['file_url'] = $request->input('file_url');
            $contactus=new ContactUs($data);
            if($contactus->save()){
                $response['message']="Message saved successfully";
                $response['status']=1;
                $http_status=200;
            }else{
                $response['errors']="Something went wrong";
                $response['status']=0;
                $http_status=400;
            }
        }
        return response()->json($response,$http_status);
    }
    /*=================================================================================
    enable disable notification
    ===================================================================================*/
    public function manageNotification(Request $request){
        $validator = Validator::make( $request->all()  ,      [
           
            'notification'           => 'required'
            
            
        ]);
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors()->first();
            $http_status            =400;
            $response['status']     = 0;
        }else{
            $data=$request->all();
            if(User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->update($data)){
                $response['message']="Changes saved successfully";
                $response['status']=1;
                $http_status=200;
            }else{
                $response['errors']="Something went wrong";
                $response['status']=0;
                $http_status=400;
            }
        }
        return response()->json($response,$http_status);
    }
    /*=======================================================================================
    Function checking that tutoraila is watched or not by user
    =========================================================================================*/
    public function tutorialWatched(){
        if(User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->update(array('profile_complete'=>8))){
            $response['message']='Data updated successfully';
            $response['status']=1;
            $http_status=200;
        }else{
            $response['message']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }

    /*==============================
    Function for Email Verification 
    ================================*/
    public function postEmailVerification( Request $request ){
        $code=str_random(30);
        $jobseeker=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first()->toArray();
        $emal_verification=new EmailVerification(array('code'=>$code,'status'=>true,'email'=>$jobseeker['email'] ));
        if($emal_verification->save()){
            $template=EmailTemplate::find('596866ddb098f0348a7995e7');
            $link='<a href='.url('/email_verification/'.$code).'>Click Here</a>';
            $find=array('@name@','@company@', '@link@' );
            $values=array($jobseeker['first_name'],env('MAIL_COMPANY'),$link);
            $body=str_replace($find,$values,$template->content);
            $this->dispatch(new SendOtpEmail($body,$jobseeker['email'],$template));
           // $this->dispatch(new SendOtpEmail($body,'debutinfo12@gmail.com',$template));
            $response['message'] = "Email sent successfully";
            $response['status']=1;
            $http_status=200;
        } else {
            $response['errors']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }

    /*=====================================
    Function for Uploading other Documents 
    =======================================*/
    public function uploadOtherDocuments( Request $request ){
        $jobseeker=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first();
        $document = array();
        if( $request->has('doc_name') && $request->has('doc_url') ) {
            if( $jobseeker['other_documents'] ){
                $other_documents = $jobseeker['other_documents'];
                $document['name']=$request->input('doc_name');
                $document['url']=$request->input('doc_url');
                $other_documents[] = $document;
            } else {
                $document['name']=$request->input('doc_name');
                $document['url']=$request->input('doc_url');
                $other_documents[] = $document;
            }
            if( $jobseeker->update( array( 'other_documents' => $other_documents ) ) ) {
                $response['message'] = "Documents uploaded successfully";
                $response['status']=1;
                $http_status=200;
            }
        } else {
            $response['errors']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }

    /*=====================================
    Function for create profile
    =======================================*/
    public function postUserProfile(Request $request)
    {
        die('fcvnmbn');
      $validator = Validator::make( $data  ,      [

            'start_time'               => 'required|date_format:"d-m-Y H:i:s" ',
            'end_time'            => 'required|date_format:"d-m-Y H:i:s"',
            'profile_name'                => 'required|alpha',
            'location'        => 'required',
            'identity'         => 'required',
            'ethnicity'        => 'required', 
            'position'        => 'required', 
            'behaviour'        => 'required', 
            'latitude'        => 'required', 
            'longitude'        => 'required', 
            'travel_plans'        => 'required', 
            'orientation'        => 'required', 
            'safe_sex'        => 'required', 
            'HIV_status'        => 'required', 
            'cock_size'        => 'required', 
            'cock_type'        => 'required', 
            'kinks_and_fetishes'        => 'required', 
            'birthday'        => 'required', 
            'race'        => 'required|date_format:"d-m-Y H:i:s"', 
            'height'        => 'required', 
            'height_cm'        => 'required|numeric',
            'weight'        => 'required',
            'Weight_kg'        => 'required',
            'hair_color'        => 'required',
            'body_hair'        => 'required',
            'facial_hair'        => 'required',
            'eye_color'        => 'required',
            'body_type'        => 'required',
            'drugs'        => 'required',
            'drinking'        => 'required',
            'smoking'        => 'required',
            'about_me'        => 'required',
            'his_identitie'        => 'required',
            'relationship_status'        => 'required',
            'where_I_leave'        => 'required',

        ]);

        if ($validator->fails()) {

            //$response['errors']   = $validator->errors()->first();
            $response['success']   = 0;
            $response['errors']   = $validator->errors()->first();
            $http_status=422;

        }else{
            $clientId=JWTAuth::parseToken()->authenticate()->_id;
            if($clientId)
            {
                $data['start_time'] = $request->start_time;
                $data['end_time'] = $request->end_time;
                $data['profile_name'] = $request->profile_name;
                $data['location'] = $request->location;
                $data['identity'] = $request->identity;
                $data['ethnicity'] = $request->ethnicity;
                $data['position'] = $request->position;
                $data['behaviour'] = $request->behaviour;
                $data['latitude'] = $request->latitude;
                $data['longitude'] = $request->longitude;
                $data['travel_plans'] = $request->travel_plans;
                $data['orientation'] = $request->orientation;
                $data['sale_sex'] = $request->safe_sex;
                $data['HIV_status'] = $request->HIV_status;
                $data['cock_type'] = $request->cock_type;
                $data['cock_size'] = $request->cock_size;
                $data['kinks_and_fetishes'] = $request->kinks_and_fetishes;
                $data['birthday'] = $request->birthday;
                $data['race'] = $request->race;
                $data['height'] = $request->height;
                $data['height_cm'] = $request->height_cm;
                $data['weight'] = $request->weight;
                $data['Weight_kg'] = $request->Weight_kg;
                $data['hair_color'] = $request->hair_color;
                $data['body_hair'] = $request->body_hair;
                $data['facial_hair'] = $request->facial_hair;
                $data['eye_color'] = $request->eye_color;
                $data['body_type'] = $request->body_type;
                $data['drugs'] = $request->drugs;
                $data['drinking'] = $request->drinking;
                $data['smoking'] = $request->smoking;
                $data['about_me'] = $request->about_me;
                $data['his_identitie'] = $request->his_identitie;
                $data['relationship_status'] = $request->relationship_status;
                $data['where_I_leave'] = $request->where_I_leave;
                $data['facebook_link'] = $request->facebook_link;
                $data['twitter_link'] = $request->twitter_link;
                $data['linkedin_link'] = $request->linkedin_link;

                $chk = ProfileModel::where(array('user_id'=>$clientId))->first();
                if($chk)
                {
                    User::where(array('id'=>$clientId))->update(['is_completed'=>$finish, 'registration_status'=>2]);
                    $chk->update($data);

                }
                else
                {
                    $userdata['Profile']['id'] = $chk['Profile']['id'];
                    $this->Profile->save($userdata);
                    if ($chk['Profile']['about_me'] != $this->request->data['about_me']) {
                        $ret = $this->User->updateAll(array('User.profiletext_change ' => 1, 'User.profile_text_change_date' => "'" . $current_date . "'"), array('User.id ' => $this->request->data['userid']));
                    }
                    echo json_encode(array('success' => 1, 'msg' => 'Data has been successfully updated'));
                    exit;
                }
            }

        }
    }
}
