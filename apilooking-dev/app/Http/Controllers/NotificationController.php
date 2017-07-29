<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notificationlog;
use App\Models\Device;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Repositary\Repositary;
use Illuminate\Support\Str;
use DateTime;
use DB;
use Hash;
use Auth;
use Mail;
use Image;

use Illuminate\Support\Facades\Lang;

class NotificationController extends Controller {
	
	protected $hashKey;
	
	public function __construct(){
      $this->middleware('jwt.auth', ['except' => ['postLogin']]);
    }
    
    /*********** 
	* created By:Jagraj Singh
	* create date: 09-12-2016
	* Purpose: For fetching all Notification log for the user
	* 
	* ********/
	public function allnotifications(Request $request){
		$validator = Validator::make( $request->all(),[
			'start' => 'required|numeric',
			'end' => 'required|numeric',
			
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }
        else{
		$user_id = JWTAuth::parseToken()->authenticate()->id;
		$response['status'] = 1;
		$end = $request->Input('end');
		$start = $request->Input('start');
		$response['allnotification'] = Notificationlog::where('sent_to_id',$user_id)->orderBy('id','desc')->take($end)->skip($start)->get();
		
		}
		
		return response()->json($response);
}

/*********** 
	* created By:Jagraj Singh
	* create date: 09-12-2016
	* Purpose: For Resetting badge
	* 
	* ********/
public function updatebadge(Request $request){
	
	
	
	$validator = Validator::make( $request->all(),[
			'device_token'=> 'required',
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			 $client_id = JWTAuth::parseToken()->authenticate()->id;
			$device_token = $request->Input('device_token');
			$devicedata = Device::where('user_id',$client_id)->where('device_token',$device_token)->first();
			$devicedata->badge_count = 0;
			
			
			
			if($devicedata->update()){
				
			$response['status'] = 1;
			$response['message'] = "success";
			}
			else{
				$response['status'] = 0;
			$response['message'] = "Fail";
			}
			
		}
	return response()->json($response);
}


/*********** 
	* created By:Jagraj Singh
	* create date: 09-12-2016
	* Purpose: For disabling/Enabling notifications on app
	* 
	* ********/
public function updateNotifyType(Request $request){
	
	
	
	$validator = Validator::make( $request->all(),[
			'notify_type'=> 'required',
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
			$type = $request->Input('notify_type');
			$userupdate = User::where('id',$client_id)->first();
			$userupdate->notify_type = $type; 
			
			
			if($userupdate->update()){
				
			$response['status'] = 1;
			$response['message'] = "success";
			}
			else{
				$response['status'] = 0;
			$response['message'] = "Fail";
			}
			
		}
	return response()->json($response);
}
	
	
	
	
	
	
	
}
