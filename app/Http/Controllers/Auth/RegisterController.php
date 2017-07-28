<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Hash;
use App\Http\Repositary\CommonRepositary;
use App\Model\EmailTemplate;
use App\Jobs\SendOtpEmail;
use App\Model\EmailVerification;
use App\Model\NotificationModel;
use App\Model\Industry;
use Laravel\Lumen\Routing\DispatchesJobs;
use Queue;
use App\Http\Requests\EmployerRequest;
use Input;
use Flash;
use App\Model\TrialModel;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'dsflksdfj';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:7|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name'    => $data['name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'role'          => 1,
        ]);
    }
    public function postRegister(Request $request,CommonRepositary $common){
        $data=$request->all();
        $data['email']=strtolower($request->input('email'));
        if($request->has('email')){
            $match=array('role'=>2,'email'=>$data['email']);
        }

            $user=User::where($match)->first();
            if($user) {
                    $response['errors']  ='Email already exist.';
                    $response['status']  =0;
                    $http_status=200;    
            } else{
                $validator = Validator::make( $data  ,      [
           
            'screen_name'           => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'country'               => 'required',
            "city"                  => 'required',
            "device_token"          => 'required',
            "device_type"           => 'required',
            "accuracy"              => 'required',
        ],
        [
            "screen_name.required" =>'Please enter your username',
            "email.required" =>'Please enter your Email',
            "password.required" =>'Please enter Password',
            "email.email" =>'Please enter a valid Email',
            "email.unique" =>'Email already exists',
            "country"      => 'Country is required',
            "city"      => 'City is required',
        ]
        );
        if ($validator->fails()) {
            
          //  $response['errors']     = $validator->errors()->first();
            $response['errors']     = $validator->errors();
            $response['success']     = 0;
            $http_status=400;
        }else{
            //if user enetered a refferal code at the time of registration
            
            
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
            $valid_upto = date('Y-m-d', strtotime('+' . $trial_month . ' days', strtotime(date('Y-m-d'))));
            $data['original_password'] = base64_encode($password);
            $data['profile_status'] = 1;
            $data['registration_status'] = 1;
            $data['accuracy'] = (int) $accuracy;
            $data['member_type'] = $member_type; //for first 1 month free
            $data['valid_upto'] = $valid_upto; //for first 1 month free
            $data['is_trial'] = $is_trial; //for first 1 month free  trial preiod
            
            $data['User']['profiletext_change'] = 1;
            $data['User']['photo_change'] = 1;
            $data['password']=Hash::make($request->input('password'));
            $data['token']=$common->randomGeneratorRefferal();
            $data['password_reset_requested']=false;
            $data['remember_token']=false;
            $data['role']=2;
            $data['status']=1;
            
            $user=new User($data);
            if($user->save()){
                $response['message'] ="Registration done successfully";
                $response['success']  =1;
                $response['data']    =$user;
                $http_status=200;
            }else{
                $response['errors']="Something went wrong";
                $response['status']=0;
                $http_status=400;
            }
            
        }
            }

        
        return response()->json($response,$http_status);
    }

    private function sendOtpMail($request,$otp){
            $code=str_random(30);
            $emal_verification=new EmailVerification(array('code'=>$code,'status'=>true,'email'=>$request->input('email')));
            if($emal_verification->save()){
                $template=EmailTemplate::find('59115d57b098f07cae0661c2');
                $link='<a href='.url('/email_verification/'.$code).'>Click Here</a>';
                $find=array('@name@','@otp@','@link@','@company@');
                $values=array($request->input('first_name'),$otp,$link,env('MAIL_COMPANY'));
                $body=str_replace($find,$values,$template->content);
                $this->dispatch(new SendOtpEmail($body,$request->input('email'),$template));
            }
            
            //Mail::to($request->input('email'))->queue(new OtpSent($body,$template));
    }

    /**/
     public function postEmployeregister(EmployerRequest $request,CommonRepositary $common){
        $data=$request->all();
        $confirm_code = str_random(30);
        $data['password']=Hash::make($request->input('password'));
        $data['email']=strtolower($request->input('email'));
        $data['role']=3;
        $data['status']=false;
        $data['is_deleted']=false;
        $data['approved']=0;
        $data['password_reset_requested']=false;
        $data['email_verification_code'] = $confirm_code;
        $data['location'] = $data['company_address'];
        if($request->has('industry_type') && count($data['industry_type']) && is_array($data['industry_type']))
        {
            $i=1;
            $data1=[];
            foreach($data['industry_type'] AS $k => $row)
            {
                $data1[$i]=new \MongoDB\BSON\ObjectID($row);
                $i+=1;
            }
            $data['industry_object']=$data1;
            $data['industry'] = Industry::whereIn('_id',$data['industry_type'])->get()->toArray();
        }
        $user = new User();
        if($user->create($data))
        {
            $adminData = $common->getAdminDetail();
            $notify['from'] =  new \MongoDB\BSON\ObjectID($user->_id);
            $notify['to'] =  new \MongoDB\BSON\ObjectID($adminData->_id);
            $notify['type'] = 1;
            $notify['title'] = $data['first_name'].' has been send new signup request.';
            $notify['status'] = true;
            $notification  = new NotificationModel();

            $notification->create($notify);
            $template=EmailTemplate::find('59115c8bb098f07a8f7594c2');
            $link="<a style='text-decoration:none;' href='". url('register/verify/'.$data['email_verification_code'])."'>confirm account</a>";
            $find=array('@name@','@Company@','@link@');
             $values=array($request->input('first_name').' '.$request->input('last_name'),env('MAIL_COMPANY'),$link);
            $body=str_replace($find,$values,$template->content); 
            $this->dispatch(new SendOtpEmail($body,$request->input('email'),$template));

            flash()->success('Thanks for the registration an email link with verification link has been sent to your register email for verification');
               
            $response['message'] ="Thanks for the registration an email link with verification link has been sent to your register email for verification";
            $response['status']  =1;
            $response['data']    =$user;
            $http_status=200;
        }
        else
        {
            $response['errors']="Something went wrong";
            $response['status']=0;
            $http_status=200;
        }
        

        return response()->json($response,$http_status);
    }


}
