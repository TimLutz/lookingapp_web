<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Timeslot;
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

use Illuminate\Support\Facades\Lang;

class TimeslotController extends Controller {
	
	protected $hashKey;
	
	public function __construct(){
      $this->middleware('jwt.auth', ['except' => ['postLogin']]);
    }
    
    

	public function alltimeslot(Request $request){
		
		
		$timeslots = Timeslot::orderBy('id','desc')->get();
		
		if($timeslots){
			$response['status']		= 1;
		 $response['timeslots'] = $timeslots;
		}
		else{
			$response['message']='Some error occured';
			$response['status']=0;
		}
		return response()->json($response);
		
		
		
    }   
    
       
   

	
}
