<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MasterHearAboutAndIdProof;
use App\Model\User;
use App\Model\TimeSlot;
use App\Model\Quiz;
use Validator;
use JWTAuth;

class TimeSlotController extends Controller
{
    public function __construct()
    {
    	
        
        $this->middleware('jwtcustom');
    }
    /*=============================================================================================
    Function for getting madwall timeslots from admin
    ===============================================================================================
    */
    public function getTimeSlot(){
    	$response['timeslot']=TimeSlot::where(array('user_id'=>JWTAuth::parseToken()->authenticate()->_id,'status'=>"pending","accepted"=>false))->get();
    	$response['status']=1;
		/*if(!$timeslots->isEmpty()){
			$response['timeslot']=$timeslots;
			$response['status']=1;
		}else{
			$response['errors']='Please wait while madwall provide time to call with you.Thanks';
			$response['status']=1;
		}*/
		return response()->json($response);
    	
    }
    /*=============================================================================================
    Function for getting madwall timeslots from admin
    ===============================================================================================
    */
    static function createTimeSlot(){
    	// $save12=new TimeSlot(array('user_id'=>JWTAuth::parseToken()->authenticate()->_id, 'status'=> true,'start_time'=>\Carbon\Carbon::now(),'end_time'=>\Carbon\Carbon::now()->addMinutes('15')));
    	// return $save12->save();
    	$data = array(
		    array('user_id'=>JWTAuth::parseToken()->authenticate()->_id, 'status'=> true,'start_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000),'end_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000)),
		    array('user_id'=>JWTAuth::parseToken()->authenticate()->_id, 'status'=> true,'start_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000),'end_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000)),
		    array('user_id'=>JWTAuth::parseToken()->authenticate()->_id, 'status'=> true,'start_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000),'end_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000)),
		    array('user_id'=>JWTAuth::parseToken()->authenticate()->_id, 'status'=> true,'start_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000),'end_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000)),
		    array('user_id'=>JWTAuth::parseToken()->authenticate()->_id, 'status'=> true,'start_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000),'end_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000)),
		    array('user_id'=>JWTAuth::parseToken()->authenticate()->_id, 'status'=> true,'start_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000),'end_time'=>new \MongoDB\BSON\UTCDateTime(strtotime("now") * 1000)),
		    //...
		);
    	return TimeSlot::insert($data); 

    }
    /*=============================================================================================
    Function for getting madwall timeslots from admin
    ===============================================================================================
    */
    public function setTimeSlot(Request $request){
      
    	$validator = Validator::make( $request->all()  ,      [

			'slots' 			=> 'required|array',
			
			
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors()->first();
           	$http_status            = 400;
			$response['status']		= 0;
        }else{

        	//on successfull submission of time slot profile status is becoming 7 here
            if(TimeSlot::whereIn('_id',$request->input('slots'))->update(array('accepted'=>true)) && User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->update(array('profile_complete'=>7,'user_slot_accepted'=>true))){
        		$response['message']='You will get a call sooon';
        		$response['status']=1;
        	}else{
        		$response['message']='no such data found';
        		$response['status']=1;
        	}
        }
        return response()->json($response);
    }
    /*=============================================================================================
    Function for requesting new timeslot
    ===============================================================================================
    */

    public function resetTimeSlot(Request $request){
        
        if($user=User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->update(array('slot_requested_additional'=>true))){
            TimeSlot::where(array('user_id'=>JWTAuth::parseToken()->authenticate()->_id))->delete();
            $response['message']='Request accepted successfully';
            $response['status']=1;
        }else{
           $response['errors']='No such user found';
            $response['status']=0; 
        }
        return response()->json($response);
    }
}
