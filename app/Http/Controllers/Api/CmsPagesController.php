<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MasterHearAboutAndIdProof;
use App\Model\User;
use App\Model\CmsPages;
use App\Model\GeneralInfoModel;
use Validator;
use JWTAuth;

class CmsPagesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('jwtcustom');
    }
    /*===============================================================================================
    Function for creating CMSpages 
    =================================================================================================*/

    public function createCMSPage(Request $request){
    	$cms=new CmsPages($request->all());
    	$cms->save();
    }
    /*===============================================================================================
    Function for getting terms and conditions
    =================================================================================================*/
    public function getTermsAndConditions(){
    	if($response['response']=CmsPages::where(array('alias'=>'terms_conditions'))->first()){
    		$response['status']=1;
    		$http_status=200;
    	}else{
    		$response['errors']='Something went wrong';
    		$response['status']=0;
    		$http_status=400;
    	}
    	
    	return response()->json($response,$http_status);
    }
    /*===============================================================================================
    Function for getting terms and conditions
    =================================================================================================*/
    public function getPrivacyPolicy(){
    	if($response['response']=CmsPages::where(array('alias'=>'privacy_policy'))->first()){
    		$response['status']=1;
    		$http_status=200;
    	}else{
    		$response['errors']='Something went wrong';
    		$response['status']=0;
    		$http_status=400;
    	}
    	
    	return response()->json($response,$http_status);
    }

    /*===============================================================================================
    Function for getting about madwall
    =================================================================================================*/

    public function getAboutMadwall(){
    	if($response['response']=CmsPages::where(array('alias'=>'about_madwall'))->first()){
    		$response['status']=1;
    		$http_status=200;
    	}else{
    		$response['errors']='Something went wrong';
    		$response['status']=0;
    		$http_status=400;
    	}
    	
    	return response()->json($response,$http_status);
    }

    /*===============================================================================================
    Function for gettomg more options
    =================================================================================================*/

    public function getMore(){
        $more=GeneralInfoModel::where(array('status'=>true))->get();
        if(!$more->isEmpty()){
            $response['response']=$more->toArray();
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
