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
        try {
           $validator = Validator::make( $request->all()  ,      [
               
              //  'screen_name'           => 'required|Min:4|Max:16|alpha_num',
                'screen_name'           => 'required',
                'email'                 => 'required|email|unique:users,email',
                'password'              => 'required|Min:8|Max:16|confirmed',
                'password_confirmation' => 'required',
                "device_token"          => 'required',
                "device_type"           => 'required',
            ],
            [
                "screen_name.required"      => config('customregister.required'),
                "screen_name.min"           => config('customregister.min'),
                "screen_name.max"           => config('customregister.max'),
            //    "screen_name.alpha_num"     => config('customregister.alpha_num'),
                "screen_name.unique"        => config('customregister.unique'),
                "email.required"            => config('customcommon.emailrequired'),
                "password.required"         => config('customcommon.password'),
                "email.email"               => config('customcommon.email'),
                "email.unique"              => config('customcommon.emailunique'),
                'password.min'              => config('customcommon.passwordmin'),
                'password.max'              => config('customcommon.passwordmax'),
                'password.confirmed'        => config('customcommon.passwordconfirm'),
            ]
            );
            if ($validator->fails()) {
                $response['errors']     = $validator->errors();
                $response['success']     = 0;
                $http_status=422;
            }else{
                    /******One month for the trial period************/
                    $trial_details = TrialModel::value('days');
                    $trial_month = $member_type = $is_trial = 0;
                    
                    if ($trial_details) {
                        $trial_month = $trial_details; //month change to day as per client request
                        if ($trial_month > 0)
                        {
                            $member_type = $is_trial = 1;
                        }
                    }
                    $data = $request->all();
                    $data['profile_status'] = 1;
                    $data['registration_status'] = 1;
                    $data['member_type'] = $member_type; //for first 1 month free

                    if($trial_month)
                    {
                        $data['valid_upto'] = Carbon::now()->addDays(intval($trial_month)); //for first 1 month free
                    }

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

                        
                        $response['message'] ="Registration done successfully";
                        $response['success']  =1;
                        $response['data']    =$user;
                        $http_status=200;
                        }else{
                        $response['message']="Something went wrong";
                        $response['success']=0;
                        $http_status=400;
                    }
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = 0;
            $http_status = 400; 
        }        
        return response()->json($response,$http_status);
    }
}
    
