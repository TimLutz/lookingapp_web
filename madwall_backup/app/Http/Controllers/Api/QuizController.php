<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MasterHearAboutAndIdProof;
use App\Model\User;
use App\Model\Quiz;
use Validator;
use JWTAuth;

class QuizController extends Controller
{
    public function __construct()
    {
    	
        
        $this->middleware('jwtcustom');
    }

    public function saveQuiz(Request $request){
        $validator = Validator::make( $request->all()  ,      [

            'question'          => 'required',
            'answer'            => 'required',
            'options'           => 'required|array',
            'type'              => 'required'

        ]);
        if ($validator->fails()) {

            $response['errors']     = $validator->errors();
            $http_status            = 400;
            $response['status']     = 0;
        }else{
            $data=$request->all();
            $data['status']=true;
            $data['is_deleted']=false;
            $quiz=new Quiz($data);
            if($quiz->save()){
                $response['message'] ='Question saved successfully.';
                $response['status']  =1;
                $http_status         = 400;
            }else{
                $response['message'] ='Something went wrong.';
                $response['status']  =0;
                $http_status            = 400;
            }

        }
        return response()->json($response,$http_status);
    }


    /*=============================================================================================
    Function for verify master quiz madwall
    ===============================================================================================
    */
    public function postMadwallQuiz(Request $request){
		$validator = Validator::make( $request->all()  ,      [

			'result' 			=> 'required|array',
			
			
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors()->first();
           	$http_status            = 400;
			$response['status']		= 0;
        }else{
    		$data=$request->all();
    		$percentage=0;
            $i=0;
            foreach($data['result'] as $result){
               
                $quizObj = Quiz::where(array('_id'=>$result['question'],'type'=>'madwall_quiz'))->first();
                if($quizObj && $quizObj->answer===$result['answer']){
                    $quiz[$i] = $quizObj->toArray();
                    $quiz[$i]['quiz_result']=true;
                    $quiz[$i]['answer']=$result['answer'];
                    $percentage=$percentage+10;
                    
                }else{
                    $quiz[$i] = $quizObj->toArray();
                    $quiz[$i]['quiz_result']=false;
                    $quiz[$i]['answer']=$result['answer'];
                }
                $i++;
            }
           
           $response['response']['over_all_percentage']=$percentage;
           $response['response']['over_all_result']=$percentage >= 50 ? 'PASS':"FAIL";
            
           $response['response']['quiz']=$quiz;
           self::updatePercentage($percentage,'madwall_quiz',$response['response']['over_all_result'],$response['response']);
           $response['message']=$response['response']['over_all_result'] =='PASS' ? 'Congrats! You have passed the quiz. You can proceed further in the application' :'Sorry! You haven’t obtained minimum 50% to pass this test';
           $response['status']=1;
           $http_status=200;
    		
    	}
    	return response()->json($response,$http_status);
    }
    /*===============================================================================================
    Update User marks obtained by him in test
    ===================================================================================================
    */
    static function updatePercentage($percentage,$type,$result,$quiz){
        if($type=='madwall_quiz'){
            $update_array['madwall_quiz_percentage']=$percentage;
            $update_array['madwall_quiz_answer']=$quiz;
            if($result=='PASS'){
                $update_array['profile_complete']=5;
            }
            return User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->update($update_array);
        }else{
            $user=User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->first();
            $update_array['health_quiz_percentage']=$percentage;
            $update_array['madwall_health_answer']=$quiz;
            if($user->health_quiz_attempt){
               $user->decrement('health_quiz_attempt',1);
               if(!$user->health_quiz_attempt){
                $update_array['healt_quiz_blocked_until']=\Carbon\Carbon::now()->addHours('48');
               } 
            }
            if($result=='PASS'){
                $update_array['profile_complete']=6;
            }
            
            $user->update($update_array);
        }
        
    }

    /*=============================================================================================
    Function for get list of  master quiz of madwall
    ===============================================================================================
    */
    public function getMadwallQuiz(){
    	if($quiz=Quiz::where(array('type'=>'madwall_quiz'))->get()){
            $response['data']    =self::randomArray($quiz->toArray(),10);
            $response['status']     =1;
        }else{
            $response['data']    ='No Data found';
            $response['status']     =1;
        }
    	
        $response['status']=1;
    	return response()->json($response,200);
    }

    /*=============================================================================================
    Function for getting random array from an object
    ===============================================================================================
    */
    static function randomArray($quiz,$number){
        $keys = array_rand($quiz,$number);
        foreach($keys as $key){
            $random_quiz[]=$quiz[$key];
        }
        return $random_quiz; 
    }

    /*=============================================================================================
    Function for get list of  master quiz of health test part 2
    ===============================================================================================
    */
    public function getMadwallHealthQuiz(){
        $user=User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->first();
        if(!$user->health_quiz_attempt){
            $response['errors']='You have utilized all 3 attempts. You will be notified when you can retake this test again';
            $response['status']=1;
           
        }else{
            $quiz=Quiz::where(array('type'=>'madwall_health_hquiz'))->get();
            if($quiz){
                $response['data']    =self::randomArray($quiz->toArray(),25);
                $response['status']     =1;   
            }else{
                $response['data']    ='No Data found';
                $response['status']     =1;   
            }
            
            
            
        }
        $response['video']=env('HEALTHQUIZVIDEO');
        $response['attempt']=$user->health_quiz_attempt;
        return response()->json($response,200);
        
    }


    /*=============================================================================================
    Function for verify master quiz madwall health test part2 
    ===============================================================================================
    */
    public function postMadwallHealthQuiz(Request $request){
        $validator = Validator::make( $request->all()  ,      [

            'result'            => 'required|array|attempt_count',
            
            
            
        ]);
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors()->first();
            $http_status            = 400;
            $response['status']     = 0;
        }else{
            $data=$request->all();
            $percentage=0;
            $i=0;
            foreach($data['result'] as $result){
               
                $quizObj = Quiz::where(array('_id'=>$result['question'],'type'=>'madwall_health_hquiz'))->first();
                if($quizObj && $quizObj->answer===$result['answer']){
                    $quiz[$i] = $quizObj->toArray();
                    $quiz[$i]['quiz_result']=true;
                    $percentage=$percentage+4;
                    
                }else{
                    $quiz[$i] = $quizObj->toArray();
                    $quiz[$i]['quiz_result']=false;
                }
                $i++;
            }
           
           $response['response']['over_all_percentage']=$percentage;
           $response['response']['over_all_result']=$percentage >= 80 ? 'PASS':"FAIL";
           
           $response['response']['quiz']=$quiz;
           self::updatePercentage($percentage,'health_quiz',$response['response']['over_all_result'],$response['response']);
           $response['message']=$response['response']['over_all_result'] =='PASS' ? 'Congrats! You have passed the quiz. You can proceed further in the application' :'Sorry! You haven’t obtained minimum 80% to pass this test';
           $response['status']=1;
           $http_status=200;
            
        }
        return response()->json($response,$http_status);
    }

    

    
}
