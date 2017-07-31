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
use App\Http\Requests\EmployerRequest;
use Input;
use Flash;
use App\Models\TrialModel;
use App\Models\ProfileModel;
use App\Models\UserpartnerModel;
use DB;
class RegisterController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest');
    }
    
    public function postRegister(Request $request,Repositary $common){
        \DB::beginTransaction();  
        $validator = Validator::make( $request->all()  ,      [
           
            'screen_name'           => 'required|Min:4|Max:16|alpha_num',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|Min:8|confirmed',
            'password_confirmation' => 'required',
            'country'               => 'required',
            "city"                  => 'required',
            "device_token"          => 'required',
            "device_type"           => 'required',
            "accuracy"              => 'required',
            "lat"              => 'required',
            "long"              => 'required',
        ],
        [
            "screen_name.required" =>'Please enter your username',
            "screen_name.min" =>'Username must not be lessthen 4 character.',
            "screen_name.max" =>'Username should not be greaterthen 16 character.',
            "screen_name.alpha_num" =>'Username name may only contain letters and numbers.',
            "email.required" =>'Please enter your Email.',
            "password.required" =>'Please enter Password.',
            "email.email" =>'Please enter a valid Email.',
            "email.unique" =>'Email already exists.',
            "country.required"      => 'Country is required.',
            "city.required"      => 'City is required.',
            "lat.required"      => 'Latitude is required.',
            "long.required"      => 'Longitude is required.',
            'password.min' => 'Please enter minimum 8 character.',
            'password.confirmed' => 'Password donot matched.'
        ]
        );
        if ($validator->fails()) {
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=400;
        }else{

            $trial_details = TrialModel::first();
            $trial_month = 0;
            $member_type = 0;
            $is_trial = 0;
            if ($trial_details) {
                $trial_month = $trial_details['Trial']['month']; //month change to day as per client request
                if ($trial_month > 0) {
                    $member_type = 1;
                    $is_trial = 1;
                }
            }
            $data = $request->all();
            $data['screen_name'] = $request->screen_name;
            $data['email'] = strtolower($request->email);
            $data['password'] = $request->password;
            $valid_upto = date('Y-m-d', strtotime('+' . $trial_month . ' days', strtotime(date('Y-m-d'))));
            $data['original_password'] = base64_encode($request->password);
            $data['profile_status'] = 1;
            $data['registration_status'] = 1;
            $data['accuracy'] = (int) $request->accuracy;
            $data['member_type'] = $member_type; //for first 1 month free
            $data['valid_upto'] = $valid_upto; //for first 1 month free
            $data['is_trial'] = $is_trial; //for first 1 month free  trial preiod
            
            $data['profiletext_change'] = 1;
            $data['photo_change'] = 1;
            $data['password']=Hash::make($request->input('password'));
            $data['token']=$common->randomGeneratorRefferal();
            $data['password_reset_requested']=false;
            $data['remember_token']=false;
            $data['online_status']=0;
            $data['role']=2;
            $data['status']=1;
            $data['lat']=$request->lat;
            $data['long']=$request->long;
            $user=new User($data);

            if($user->save()){
                
                    /* Save user id into profile table */
                 //   ProfileModel::create(['user_id'=>$user->id]);

                    /* Save user id into partner table */
                //    UserpartnerModel::create(['user_id'=>$user->id]);
                
               \DB::commit();    
                $response['message'] ="Registration done successfully";
                $response['success']  =1;
                $response['data']    =$user;
                $http_status=200;
            }else{
                \DB::rollback();
                $response['errors']="Something went wrong";
                $response['status']=0;
                $http_status=400;
            }
        }        
        return response()->json($response,$http_status);
    }
}
    