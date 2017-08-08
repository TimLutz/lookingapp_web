<?php 
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Hash;
use App\Http\Repositary\Repositary;
use App\Model\EmailTemplate;
use Laravel\Lumen\Routing\DispatchesJobs;
use Queue;
use Input;
use App\Models\TrialModel;
use App\Models\ProfileModel;
use App\Models\UserpartnerModel;
use DB;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest');
    }
    
    /**
    * Name: postRegister
    * Purpose: function to user registration
    * created By: Lovepreet
    * Created on :- 1 Aug 2017
    **/
    public function postRegister(Request $request,Repositary $common){
        //\DB::beginTransaction();  
        $validator = Validator::make( $request->all()  ,      [
           
            'screen_name'           => 'required|Min:4|Max:16|alpha_num|unique:users,screen_name',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|Min:8|confirmed',
            'password_confirmation' => 'required',
            'country'               => 'required|Min:2|Max:40',
            "city"                  => 'required|Min:2|Max:40',
            "device_token"          => 'required',
            "device_type"           => 'required',
            "accuracy"              => 'required|numeric',
            "lat"                   => 'required',
            "long"                  => 'required',
        //    "birthday"              => 'age_restriction'
        ],
        [
            "screen_name.required"      =>'Please enter your username',
            "screen_name.min"           =>'Username must not be lessthen 4 character.',
            "screen_name.max"           =>'Username should not be greaterthen 16 character.',
            "screen_name.alpha_num"     =>'Username name may only contain letters and numbers.',
            "screen_name.unique"        =>"Username already exist.",
            "email.required"            =>'Please enter your Email.',
            "password.required"         =>'Please enter Password.',
            "email.email"               =>'Please enter a valid Email.',
            "email.unique"              =>'Email already exists.',
            "country.required"          => 'Country is required.',
            "city.required"             => 'City is required.',
            "lat.required"              => 'Latitude is required.',
            "long.required"             => 'Longitude is required.',
            'password.min'              => 'Please enter minimum 8 character.',
            'password.confirmed'        => 'Password donot matched.',
            'country.max'               => 'Country name should not be greater then 40 character',
            'country.min'               => ' Country name must be atleast 8 character',
            'city.max'                  => 'City name must be atleast 8 character',
            'city.min'                  => 'City name should not be greater then 40 character',
            'accuracy.numeric'          => 'Accuracy must be number'
        ]
        );
        if ($validator->fails()) {
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=422;
        }else{
				$trial_details = TrialModel::first();
				$trial_month = 0;
				$member_type = 0;
				$is_trial = 0;
				if ($trial_details) {
					$trial_month = $trial_details->month; //month change to day as per client request
					if ($trial_month > 0)
					{
						$member_type = 1;
						$is_trial = 1;
					}
				}
				$data = $request->all();
				$data['profile_status'] = 1;
				$data['registration_status'] = 1;
				$data['accuracy'] = (int) $request->accuracy;
				$data['member_type'] = $member_type; //for first 1 month free
				$data['valid_upto'] = Carbon::now()->addDays(intval($trial_month)); //for first 1 month free
				$data['is_trial'] = $is_trial; //for first 1 month free  trial preiod
				$data['profiletext_change'] = 1;
				$data['photo_change'] = 1;
				$data['password']=Hash::make($request->password);
				$data['profile_id']=$common->randomGeneratorRefferal();
				$data['password_reset_requested']=false;
				$data['remember_token']=false;
				$data['online_status']=0;
				$data['role']=2;
				$data['status']=1;
                
                
 				if($user=User::create($data)){
					/* Save user id into profile table */
					//   ProfileModel::create(['user_id'=>$user->id]);

					/* Save user id into partner table */
					//    UserpartnerModel::create(['user_id'=>$user->id]);

					//\DB::commit();    
					$response['message'] ="Registration done successfully";
					$response['success']  =1;
					$response['data']    =$user;
					$http_status=200;
					}else{
					//\DB::rollback();
					$response['message']="Something went wrong";
					$response['success']=0;
					$http_status=400;
				}
        }        
        return response()->json($response,$http_status);
    }
}
    
