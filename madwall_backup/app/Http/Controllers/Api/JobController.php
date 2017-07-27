<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MasterHearAboutAndIdProof;
use App\Model\User;
use App\Model\JobsModel;
use App\Model\CategoryModel;
use App\Model\Token;
use App\Model\JobsapplicationModel;
use App\Model\ShiftModel;
use App\Model\ViewJobsModel;
use App\Model\WorkHistory;
use Validator;
use Carbon\Carbon;
use JWTAuth;

class JobController extends Controller
{
    public function __construct() {
    	$this->middleware('jwtcustom');
    }
        
    /*=============================================
    Function for getting Mannual and Automatic jobs
    ===============================================*/
    public function getMannualAutomaticJobs(Request $request){

        $end = intval( $request->Input('end') );
        $start = intval($request->Input('start'));
        $user_ids = User::where(array( 'approved' => 1, 'role' => 3 ))->pluck('_id')->toArray();
        $data=JobsModel::with('userjobs')->whereIn('user_id',$user_ids)->with(['jobapplied', 'jobshifts'])->where(array('is_deleted'=>false) )->whereIn('job_published_type' ,[0,1])->whereIn('job_status' ,[0,1,2,3])->take($end)->skip($start)->get()->toArray();
        $offered_jobs=JobsModel::with('userjobs')->whereIn('user_id',$user_ids)->with(['jobapplied', 'jobshifts'])->where(array('is_deleted'=>false) )->where( array('job_published_type'=> 2 ) )->whereIn('job_status' ,[0,1,2,3])->take($end)->skip($start)->get()->toArray();
        $user=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first()->toArray();
        
        foreach( $data as $key => $dt ){
            $applied=0;
            if( count($dt['jobapplied'] )){
                foreach( $dt['jobapplied'] as $jobapplied ){
                    if($jobapplied['jobseeker_id'] == $user['_id'] ){
                        $applied = 1;
                    }
                }
            }
            $data[$key]['applied'] = $applied;
        }

        foreach( $offered_jobs as $key => $offered_job ){
            $applied=0;
            $new_job = true;
            if( count($offered_job['jobapplied'] )){
                foreach( $offered_job['jobapplied'] as $jobapplied ){
                    if($jobapplied['jobseeker_id'] == $user['_id'] ){
	                    if(isset($jobapplied['job_status'])){
                            if( $jobapplied['job_status']==1 ){ // When Accepted
                            $applied = 2; 
                        } 
                            if($jobapplied['job_status']==3){ // When Rejected
                                $applied = 3;
                            }
                        }
                        if( isset( $jobapplied['new_job'] ) ){
                        	if( ! $jobapplied['new_job']){
                            	$new_job = false;
                        	}
                        }
                        
                	}
                }
            }
            $offered_jobs[$key]['applied'] = $applied;
            $offered_jobs[$key]['new_job'] = $new_job;
        }

   			
        if( count($data) || count($offered_jobs) ) {
            $response['response'] = $data;
    		$response['offered_jobs']=$offered_jobs;
    		$response['status']=1;
    		$http_status=200;
    	}elseif(!count($offered_jobs) || !count($data) ){
    		$response['response']=$data;
    		$response['offered_jobs']=$offered_jobs;
    		$response['status']=1;
    		$http_status=200;
    	} else{
            $response['errors']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }

    /*============================================
    Function for getting Applied and Acceptedjobs
    ==============================================*/
    public function getAppliedAcceptedJobs(Request $request){
        $end = intval( $request->Input('end') );
        $start = intval($request->Input('start'));
        $jobseeker=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first()->toArray();
        $applied_jobs=JobsapplicationModel::where(array('jobseeker_id' => $jobseeker['_id'] ) )->whereIn('job_status',[0,3])->get()->toArray(); 
        $accepted_jobs=JobsapplicationModel::where(array ('jobseeker_id' => $jobseeker['_id'], 'job_type' => 2 ) )->whereIn('job_status',[1,3])->get()->toArray();
        
        $accepted_job_ids = array();
        foreach( $accepted_jobs as $accepted_job ){
            $accepted_job_ids[] = $accepted_job['job_id'];
        }

        $applied_job_ids = array();
        foreach( $applied_jobs as $applied_job ){
            $applied_job_ids[] = $applied_job['job_id'];
        }
        $user_ids = User::where(array( 'approved' => 1, 'role' => 3 ))->pluck('_id')->toArray();
        $applied_job_data=JobsModel::with('userjobs')->whereIn('user_id',$user_ids)->with('jobapplied')->where(array('is_deleted'=>false) )->whereIn('_id' ,$applied_job_ids )->whereIn('job_published_type' ,[0,1])->whereIn('job_status' ,[0,1,2,3])->take($end)->skip($start)->get()->toArray();
        $accepted_job_data=JobsModel::with('userjobs')->whereIn('user_id',$user_ids)->with('jobapplied')->where(array('is_deleted'=>false,'job_published_type'=> 2 ) )->whereIn('_id' ,$accepted_job_ids )->whereIn('job_status' ,[0,1,2,3])->take($end)->skip($start)->get()->toArray();
        foreach( $applied_job_data as $key => $dt ){
            $applied=0;
            if( count($dt['jobapplied'] )){
                foreach( $dt['jobapplied'] as $jobapplied ){
                    if($jobapplied['jobseeker_id'] == $jobseeker['_id'] ){
                        if( $jobapplied['job_status']==0 ){ // 2-> When rejected ny employer 3-> cancelled by jobseeker
                            $applied = 0;
                        }
                        if( $jobapplied['job_status']==2 || $jobapplied['job_status']==3  ){ // 2-> When rejected ny employer 3-> cancelled by jobseeker
                            $applied = 4;
                        }
                    }
                }
            }
            $applied_job_data[$key]['applied'] = $applied;
        }

        foreach( $accepted_job_data as $key => $offered_job ){
            $applied=0;
            $new_job = true;
            if( count($offered_job['jobapplied'] )){
                foreach( $offered_job['jobapplied'] as $jobapplied ){
                    if($jobapplied['jobseeker_id'] == $jobseeker['_id'] ){
	                    if( $jobapplied['job_status']==1 ){ // 2-> When rejected ny employer 3-> cancelled by jobseeker
                            $applied = 0;
                        }
                        if( $jobapplied['job_status']==3 ){ // 2-> When rejected ny employer 3-> cancelled by jobseeker
	                        $applied = 4;
	                    }
	                    if( isset( $jobapplied['new_job'] ) ){
                        	if( ! $jobapplied['new_job']){
                            	$new_job = false;
                        	}
                        }
                	}
                }
            }
            $accepted_job_data[$key]['new_job'] = $new_job;
            $accepted_job_data[$key]['applied'] = $applied;
        }        

        if( count($applied_job_data) || count($accepted_job_data) ) {
            $response['response'] = $applied_job_data;
            $response['offered_jobs']=$accepted_job_data;
            $response['status']=1;
            $http_status=200;
        }elseif(  !count($applied_job_data) || !count($accepted_job_data) ){
            $response['response']=$applied_job_data;
            $response['offered_jobs']=$accepted_job_data;
            $response['status']=1;
            $http_status=200;
        } else{
            $response['errors']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }

    /*=======================================
    Function for getting category for search
    =========================================*/
    public function getCategoriesForSearch(){
        if( $response['response']=CategoryModel::where( array( 'is_deleted' => false, 'type'=>'category', 'status' => true ) )->get()){
            $response['status']=1;
            $http_status=200;
        }else{
            $response['errors']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }

    /*===========================================
    Function for searching category to apply job
    =============================================*/
    public function postJobsByCategory( Request $request ){
        $catId = $request->input('catId');
        $user_ids = User::where(array( 'role' => 3, 'approved' => 1 ))->pluck('_id')->toArray();
        $data=JobsModel::with('userjobs')->whereIn('user_id',$user_ids)->where(array('is_deleted'=>false, 'job_category' => $catId ) )->whereIn('job_status' ,[0,1,2,3])->get()->toArray();
        if(count($data)) {
            $response['response'] = $data;
            $response['status']=1;
            $http_status=200;
        }else{
            $response['response']=$data;
            $response['status']=1;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }


    /*==============================
    Function for getting job detail
    ================================*/
    public function getJobDetail( Request $request ){
        $id = $request['id'];
        $user_ids = User::where(array( 'approved' => 1, 'role' => 3 ))->pluck('_id')->toArray();
        $data[]=JobsModel::with('userjobs')->whereIn('user_id',$user_ids)->where(array('is_deleted'=>false, '_id' => $id ) )->first();
        if(count($data)) {
            $response['response'] = $data;
            $response['status']=1;
            $http_status=200;
        }else{
            $response['errors']='No Job Found';
            $response['status']=0;
            $http_status=400;
        }
        return response()->json($response,$http_status);
    }
    
    /*===============================================
    Function for applying Mannual and Automatic Jobs
    ================================================*/
    public function postApplyJob( Request $request ){
        $job_id = $request['jobId'];
        $total_applied = 0;
        $job_detail =JobsModel::where('_id',$job_id)->first()->toArray();
        $jobseeker_data = User::where(array( '_id' => JWTAuth::parseToken()->authenticate()->_id ))->first()->toArray();    
        $carbondate = Carbon::now()->addHours(1);
        if( $carbondate->toDateTimeString() > $job_detail['start_date']) {
            return response()->json(['errors' => "Sorry! You cannot apply to this job as this job is started now.",'status'=>2]);
        }

        if( $jobseeker_data['rating'] < 4 ){		// Check Rating of User
        	return response()->json(['errors' => "Sorry! You cannot apply to this job as your rating is below 4 stars. Please contact administrator through contact us form",'status'=>3]);
        }
        if( $jobseeker_data['approved'] == 3 ){	//Check User is Blocked?
        	return response()->json(['errors' => "You have been blocked by administrator. Please contact them through contact us form",'status'=>4]);
        }
        if( $job_detail['total_hired'] >= $job_detail['number_of_worker_required'] ){  //Check to see job applied 
 			return response()->json(['errors' => "Sorry! This job vacancy is full",'status'=>5]);
        }

        $data['jobseeker_id']   = JWTAuth::parseToken()->authenticate()->_id;
        $data['job_id']         = $job_id;
        $data['employer_id']    = $job_detail['user_id'];
        $data['job_type']       = $job_detail['job_published_type'];
        $data['is_deleted']     = false;
        $data['is_applied']     = true;
        $data['job_status']     = 0;
        $job_detail['total_applied']  = $job_detail['total_applied']+1;
        
        $is_applied =JobsapplicationModel::where(array( 'jobseeker_id' => $data['jobseeker_id'], 'job_id' => $data['job_id'] )) ->value('is_applied');
        
        if( $is_applied ){
            return response()->json(['errors' => "Sorry! You already Applied for this job.",'status'=>6]);
        }

        $job = new JobsapplicationModel($data);

        if($job->save()){
        	JobsModel::where( '_id', $job_id )->update( array('total_applied' => $job_detail['total_applied']) );
            $response['message'] ="Job Applied successfully";
            $response['status']  =1;
			//$response['data']    =$user;
            $http_status=200;
        }else{
            $response['errors']="Something went wrong";
            $response['status']=0;
            $http_status=200;
        }
        return response()->json($response,$http_status);
    }

    /*=================================================
    Function for Accept Offered Jobs in case of Rehire
    ===================================================*/
    public function postAcceptJob( Request $request ){
        $job_id = $request['jobId'];
        $total_applied = 0;
        $job_detail =JobsModel::where('_id',$job_id)->first()->toArray();
        $user=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first()->toArray();
      	$jobseeker_data = User::where(array( '_id' => $user['_id'] ))->first()->toArray();
        
        $carbondate = Carbon::now()->addHours(1);
        if( $carbondate->toDateTimeString() > $job_detail['start_date']) {
            return response()->json(['errors' => "Sorry! You cannot apply to this job as this job is started now.",'status'=>2]);
        }

        if( $jobseeker_data['rating']< 4 ){ // Check Rating of User
            return response()->json(['errors' => "Sorry! You cannot apply to this job as your rating is below 4 stars. Please contact administrator through contact us form",'status'=>3]);
        }
        if( $jobseeker_data['approved'] == 3 ){  //Check User is Blocked?
            return response()->json(['errors' => "You have been blocked by administrator. Please contact them through contact us form",'status'=>4]);
        }
        if( $job_detail['total_hired'] > $job_detail['number_of_worker_required'] ){  //Check to see job applied 
            return response()->json(['errors' => "Sorry! This job vacancy is full",'status'=>5]);
        }
        
        $job_detail['total_applied']  = $job_detail['total_applied']+1;
        $is_applied =JobsapplicationModel::where(array( 'jobseeker_id' => $user['_id'], 'job_id' => $job_id ))->value('is_applied');
        if( $is_applied ){
            return response()->json(['errors' => "Sorry! You already Applied for this job.",'status'=>6]);
        }
        if( JobsapplicationModel::where( array( 'job_id' => $job_id, 'jobseeker_id' => $user['_id'] ) )->update( array('job_status' => 3, 'employer_id' => $job_detail['user_id'], 'job_type'=> $job_detail['job_published_type'], 'is_deleted' => false, 'is_applied' => true, 'job_status' => 1 ,'new_job' => true ) ) ){
            JobsModel::where( '_id', $job_id )->update( array('total_applied' => $job_detail['total_applied']) );
            $response['message'] ="Job Accepted successfully";
            $response['status']  =1;
            //$response['data']    =$user;
            $http_status=200;
        }else{
            $response['errors']="Something went wrong";
            $response['status']=0;
            $http_status=200;
        }
        return response()->json($response,$http_status);
    }

    /*============================================
    Function for Deline Offered Jobs by jobseeker
    ===============================================*/
    public function postDeclineJob( Request $request ){
        $job_id = $request['jobId'];
        $job_detail =JobsModel::where('_id',$job_id)->first()->toArray();
        
        $user=User::where(array("_id"=>JWTAuth::parseToken()->authenticate()->_id))->first()->toArray();
        $jobseeker_data = User::where(array( '_id' => $user['_id'] ))->first()->toArray();
        if( $job_detail['job_published_type']==2){ 
            $data['job_status'] =3;  // 2->Declined by jobseeker 
        }

        if( $jobseeker_data['approved'] == 3 ){  //Check User is Blocked?
            return response()->json(['errors' => "You have been blocked by administrator. Please contact them through contact us form",'status'=>4]);
        }
        
        $is_declined =JobsapplicationModel::where(array( 'jobseeker_id' => $user['_id'], 'job_id' => $job_id ))->value('job_status');
        if( $is_declined == 3 ){
            return response()->json(['errors' => "Sorry! You already Declined this job.",'status'=>6]);
        }
       
        if( JobsapplicationModel::where( array( 'job_id' => $job_id, 'jobseeker_id' => $user['_id'] ) )->update( array('job_status' => 3, 'employer_id' => $job_detail['user_id'], 'job_type'=> $job_detail['job_published_type'], 'is_deleted' => false, 'is_applied' => true, 'job_status' => 3 ) ) ){
            $response['message'] ="Job declined successfully";
            $response['status']  =1;
            //$response['data']    =$user;
            $http_status=200;
        }else{
            $response['errors']="Something went wrong";
            $response['status']=0;
            $http_status=200;
        }
        return response()->json($response,$http_status);
    }

    /*=======================
    Function for Cancel Jobs
    =========================*/
    public function postCancelJob( Request $request ){
        $job_id = $request['jobId'];
        $job_detail =JobsModel::where('_id',$job_id)->first()->toArray();
        $data['jobseeker_id']   = JWTAuth::parseToken()->authenticate()->_id;
        $data['job_id']         = $job_id;
        $data['employer_id']    = $job_detail['user_id'];
        $data['job_type']       = $job_detail['job_published_type'];
        $data['is_deleted']     = false;
        $data['start_time']		= $job_detail['start_date'];
        $data['end_time'] 		= $job_detail['end_date'];
        $data['leaving_on']     = $carbondate = Carbon::now()->toDateTimeString();
        $data['is_deleted']     = false;
        $is_cancel =WorkHistory::where(array( 'job_id' => $data['job_id'] ))->count('jobseeker_id');
        if( $is_cancel == 1 ){
            return response()->json(['errors' => "Sorry! You already cancelled this job.",'status'=>7]);
        }
        $cancelJob = new WorkHistory($data);
        if($cancelJob->save()){
        	JobsapplicationModel::where( array( 'job_id' => $data['job_id'], 'jobseeker_id' => $data['jobseeker_id'] ) )->update( array('job_status' => 3 ) );
            
            $response['message'] ="Job cancelled successfully";
            $response['status']  =1;
            $http_status=200;
        }else{
            $response['errors']="Something went wrong";
            $response['status']=0;
            $http_status=200;
        }
        return response()->json($response,$http_status);
    }


    /*=========================
    Function for View New Jobs 
    ==========================*/
    public function postViewNewJobs(Request $request){
        $job_id = $request['jobId'];
        $user_ids = User::where(array( 'approved' => 1, 'role' => 3 ))->pluck('_id')->toArray();
        $job_detail=JobsModel::with('userjobs')->whereIn('user_id',$user_ids)->where(array( '_id' => $job_id ,'job_published_type'=>2 ) )->whereIn('job_status' ,[0,1,2,3])->first()->toArray();
        $data['jobseeker_id'] = JWTAuth::parseToken()->authenticate()->_id;
        $data['job_id'] = $job_id;
        $data['new_job'] = false;
        $is_already_viewed=JobsapplicationModel::where(array( 'job_id' => $job_id ,'jobseeker_id'=>$data['jobseeker_id'] ) )->count();
        if( $is_already_viewed > 0 ){
            $job_update = JobsapplicationModel::where( array( 'job_id' => $job_id, 'jobseeker_id' => $data['jobseeker_id'] ) )->update( array('new_job' => false ) );
        } else{
            $job = new JobsapplicationModel($data);
            $job_save = $job->save();
        }
        
        if( isset($job_save) || isset( $job_update ) ){
            $response['message'] = "Job is viewed";
            $response['status']=1;
            $http_status=200;
        } else {
            $response['errors']='Something went wrong';
            $response['status']=0;
            $http_status=400;
        }
        
        return response()->json($response,$http_status);
    }


    /*================================
    Function for Getting Job Schedule 
    ==================================*/
    public function getJobSchedule(Request $request){
        $end = intval( $request->Input('end') );
        $start = intval($request->Input('start'));
        $jobs = JobsapplicationModel::where( array( 'jobseeker_id' => JWTAuth::parseToken()->authenticate()->_id, 'job_status' => 1   ) )->get()->toArray();
        $job_ids = array();
        foreach( $jobs as $job ){
            $job_ids[] = new \MongoDB\BSON\ObjectId($job['job_id']);
        }
        $user_ids = User::where(array( 'approved' => 1, 'role' => 3 ))->pluck('_id')->toArray();
        $job_data=JobsModel::with('userjobs')->whereIn('user_id',$user_ids)->with(['jobapplied','jobshifts'])->where(array('is_deleted'=>false) )->whereIn('_id' ,$job_ids )->whereIn('job_status' ,[0,1,2,3])->take($end)->skip($start)->get()->toArray();
        foreach( $job_data as $job ){
            $job_schedule[] = $job;
        }
        if( isset($job_schedule) ){
            $response['data'] = $job_schedule;
            $response['status']=1;
            $http_status=200;
        } else {
            $response['errors']='No Job';
            $response['status']=0;
            $http_status=400;
        }
        
        return response()->json($response,$http_status);

        //print_r(new \MongoDB\BSON\ObjectId('596eeecab098f02dd5642985'));
        //die('hrrr');
        /*$job_schedule = JobsModel::raw( function($collection) use($job_ids) {
            return $collection->aggregate(
                [
                    
                    [
                        '$match' => [
                            '_id' => [
                                '$in' => $job_ids
                                ]a
                            ]
                    ],

                    // group the results by user id
                    [
                        '$group' => [
                            '_id'=> '_id',
                            'job_details' => [
                                '$addToSet' => [ 'start_date' => '$start_date', 'end_date' => '$end_date' ,'title' => '$title', 'address' => '$address', 'shifts' => '$shifts', 'shifts' => '$shifts', 'category' => '$category' ] 
                                ]
                            ]
                    ],

                ]
            );
        });*/
    }

    public function getMyEarnings(Request $request){
        /*$current_date = $request->input('current_date');
        echo $current_date;
        die('here');*/
    	$applied_job_detail = JobsapplicationModel::with(array('job_shift', 'job'))->where( array( 'jobseeker_id' => JWTAuth::parseToken()->authenticate()->_id ) )->get()->toArray();
    	echo "<pre>";
    	print_r( $applied_job_detail);
    }

}
