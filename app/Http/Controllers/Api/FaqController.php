<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MasterHearAboutAndIdProof;
use App\Model\User;
use App\Model\Faqs;
use App\Model\Quiz;
use Validator;
use JWTAuth;

class FaqController extends Controller
{
    public function __construct()
    {
    	$this->middleware('jwtcustom');
    }

    /*========================================================================================
    Function for getting list of faq
    ==========================================================================================*/
    public function getFaq(){
    	$faq=Faqs::where(array('status'=>true,'is_deleted'=>false))->orderBy('updated_at','DESC')->get();
    	
    	if(!$faq->isEmpty()){
    		$response['response']=$faq->toArray();
    		$response['status']=1;
    		$http_status=200;
    	}else{
    		$response['errors']='No content available to display';
    		$response['status']=0;
    		$http_status=400;
    	}
    	return response()->json($response,$http_status);
    }
}
