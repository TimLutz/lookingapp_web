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
        if($request->has('phone')){
            $match=array('role'=>2,'phone'=>$request->input('phone'));
        }else{
            $match=array('role'=>2,'email'=>$data['email']);
        }

            $user=User::where($match)->first();
            if($user) {
                if($user->approved==2)
                {
                    $response['errors']  ='Sorry, your profile has been declined by the Madwall administrator.';
                    $response['status']  =0;
                    $http_status=200;    
                }
            } else{
                $validator = Validator::make( $data  ,      [
           
            'first_name'            => 'required|Min:2|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'last_name'             => 'required|Min:2|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'email'                 => 're-register|required|email|unique:users,email',
            'phone'                 => 'required|unique:users,phone|max:10',
            'password'              => 'required|Min:6|Max:25|confirmed',
            'password_confirmation' => 'required',
            'country_code'          => 'required',
            "refference_code"       => 'exists:users,refferal_code'
        ],
        [
            "first_name.required" =>'Please enter your first Name',
            "last_name.required" =>'Please enter your last Name',
            "email.required" =>'Please enter your Email',
            "phone.required" =>'Please enter your Mobile Number',
            "password.required" =>'Please enter Password',
            "first_name.regex" =>'Please enter a valid first name without numbers or special characters',
            "last_name.regex" =>'Please enter a valid last name without numbers or special characters',
            "email.email" =>'Please enter a valid Email',
            'phone.max'=>'Please enter a valid mobile number',
            "email.unique" =>'Email already exists',
            "phone.unique" =>'Mobile Number already exists',
            'password.Max'=>'Password should be at least 6 characters long containing at least 1 number and 1 alphabet',

        ]
        );
        if ($validator->fails()) {
            
            $response['errors']     = $validator->errors()->first();
            $response['status']     = 0;
            $http_status=400;
        }else{
            //if user enetered a refferal code at the time of registration
            if($request->has('refference_code')){
               $data['reffered_by']=User::where(array('refferal_code'=>$request->input('refference_code')))->value('_id');
            
            }
            
            $otp=$common->randomGenerator();
            $data['password']=Hash::make($request->input('password'));
            $data['refferal_code']=$common->randomGeneratorRefferal();
            $data['password_reset_requested']=false;
            $data['otp']=$otp;
            $data['notification']=true;
            $data['otp_expire']=\Carbon\Carbon::now()->addMinutes(env('OTPEXPIRE'));
            $data['rating']=5;
            $data['role']=2;
            $data['health_quiz_attempt']=3;
            $data['user_slot_accepted'] = false;
            $data['slot_requested_additional']=false; //slot_requested_additional
            $data['approved']=0; //0->pending,1->approved,2->disapproved
            $data['status']=false;
            $data['profile_complete']=1;
            $data['is_deleted']=false;
            $user=new User($data);
            if($user->save()){
                $this->sendOtpMail($request,$otp);
                $common->sendText($user->country_code.$user->phone,'Hello! Welcome to MadWall. Here is the code: '.$user->otp.'. Please confirm it in the app. Thanks!');
                $response['message'] ="Registration done successfully";
                $response['status']  =1;
                $response['data']    =$user;
                $http_status=200;
            }else{
                $response['errors']="Something went wrong";
                $response['status']=0;
                $http_status=200;
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
