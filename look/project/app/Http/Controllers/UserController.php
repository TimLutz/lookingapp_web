<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Booking;
use App\Transaction;
use App\Services;
use Hash;
use Cookie;
use repositories\CommonRepositoryInterface;
use Session;
use App\Location;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\QuotationRequest;
use Flash;
use DB;
use Input;
use App\EmailTemplate;
use Mail;
use App\Quotation;
use App\Settings;
use App\Modes;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $common;
    public function __construct(Guard $auth,CommonRepositoryInterface $common)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        $this->common = $common;
    }
    
    public function getDashboard()
    {
		try {           
//        echo $this->auth->user()->email; 
      $modes = $this->common->getmodetype();
      /*$i = 0;
      $data = array();
      foreach($modes AS $mode)
      {
        $data[$i]['title'] = $mode['title'];
        $i += 1;
      }

      print_r($data);
      echo "<br>";
      print_r($modes[0]['title']);*/
          if(Session::get('pickup') != '' && Session::get('dropof') != '')
          {
              return redirect('user/booking');
          }
          else
          {
		        return view('user/dashboard');
          }
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage() 
                      ];
            return view('errors.error',$result);          
        }
	}

    public function getEditprofile()
    {
        try {
           $id = $this->auth->user()->id;
            $active = 'user';
            $users = User::where('status','1')->find($id);

            return view('user.editprofile',compact('actiove','users'));  
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error',$result);          
        }
    }

    public function postEditprofile(Requests\EdituserRequest $request)
    {
        //print_r($request->all);
        try {
           $id = $this->auth->user()->id;
           $users = User::where('status','1')->find($id);
           //print_r($users);
           $data['first_name'] = $request->first_name;
           $data['last_name'] = $request->last_name;
           $data['company_name'] = $request->company_name;
           $data['phone_number'] = $request->phone_number;
           $data['address'] = $request->address;
           $users->update($data);
          // $users->update($data);
          if($users->save())
          {
            
            //echo "hi";
            flash()->success('Profile Updated successfully');
            return redirect('user/dashboard');
          }

          else
          {
          
            flash()->error('Profile can not be updated');
            return redirect('user/editprofile');
          }
        } catch (Exception $e) {
          $result = [
                      'exception_message'=>$e->getMessage()
                    ];
          return view('errors.error',$result);          
        }
    }

    public function getChangepassword()
    {
      try {
        return view('user.changepassword');
      } catch (Exception $e) {
        $result = [
                    'exception_message'=> $e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function postChangepassword(Requests\ResetPassword $request)
    {
      try
      {
        if(Hash::check($request->old_password, Auth::user()->password))
        {
           $id = Auth::user()->id;
           $user = User::find($id);
           $user->password=Hash::make($request->password);
           if(Hash::check($request->password, Auth::user()->password))
            {
              flash()->error('Sorry, Please choose different password!');          
              return redirect('user/changepassword'); 
            }
            else
            {
               if($user->save())
               {
                flash()->success('Password Updated successfully, Please login with new condential!');
                $this->auth->logout();
                $val1 = Cookie::get('email');
                $val2= Cookie::get('password');
                //send cookies with response
                response()->view('auth/login')->withCookie(cookie('email', $val1))->withCookie(cookie('password', $val2));
                return redirect('auth/login');
               }
               else
               {
                // $request->session()->flash('alert-danger', 'Password can not be Changed');
              flash()->error('Sorry, Password can not be Changed');
              
              return redirect('user/changepassword');
               }
            }
        }
        else
        {
          //$request->session()->flash('alert-danger', 'Sorry, your old password is not correct');
           flash()->error('Sorry, your old password is not correct');
          
          return redirect('user/changepassword');
        }
      }
      catch (\Exception $e) 
      {
              $result = [
                  'exception_message' => $e->getMessage()
              ];
        return view('errors.error', $result);
          }
      return redirect('user/changepassword');
    }

    public function getBooking(Request $request)
    {
      try { 
        echo $request->session()->get('mode_type');
        echo $request->session()->get('service');
        $modes =$this->common->getmodetype();
        $services = $this->common->getservices();
        $location = $this->common->getPickuplocation(); 
        $pickup = Location::where('status','1')->where('pick_loc','1')->where('user_id',$this->auth->user()->id)->get()->toArray();
        $dropof = Location::where('status','1')->where('drop_loc','1')->where('user_id',$this->auth->user()->id)->get()->toArray();
        $picku = array();
        $dropo = array();
        if($pickup)
        {
          foreach($pickup AS $pick)
          {
            $picku['id']  = $pick['id'];
            $picku['contact_name']  = $pick['contact_name'];
            $picku['street_no']  = $pick['street_no'];
            $picku['street_name']  = $pick['street_name'];
            $picku['email']  = $pick['email'];
            $picku['mobile']  = $pick['mobile'];
          }
        }
        if($dropof)
        {
          foreach($dropof AS $drop)
          {
            $dropo['id']  = $drop['id'];
            $dropo['contact_name']  = $drop['contact_name'];
            $dropo['street_no']  = $drop['street_no'];
            $dropo['street_name']  = $drop['street_name'];
            $dropo['email']  = $drop['email'];
            $dropo['mobile']  = $drop['mobile'];
          }
        }
        
        //print_r($picku);
        return view('user.bookingparcel',compact('modes','services','location','picku','dropo'));
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function postBooking(BookingRequest $request)
    {
      try {

            if($request->mode_type != '')
            {
              $modetype = Modes::where('status',1)->find($request->mode_type);
              //print_r($services); die()
              if($modetype)
              {
                if(is_string($request->service_id) && !empty($request->service_id))
                {
                    $mode_type = $request->mode_type;
                    $services = Settings::where('status',1)
                                      ->where('mode_type',$mode_type)
                                      ->where('title',$request->service_id)
                                      ->first();
                    if($services)
                    {
                      $now = date('Y-m-d H:i:s');
                      $booking = new Booking();
                      $data = $request->all();
                      $center = 'Phase 11, Sahibzada Ajit Singh Nagar, Punjab, India';
                      $request->pic_streetname;
                      $request->session()->put('centerdistance',$center);
                      if($request->pic_streetname != '')
                      {
                       $pickupdistance = $this->common->getDistance($request->pic_streetname,$center);
                      }
                      if($request->del_streetname != '')
                      {
                       $dropofdistance = $this->common->getDistance($request->del_streetname,$center);   
                      }
                      
                      $radius = $this->common->getRadius();
                      /* common function to get amount **/

                      $servicedata = $this->common->getFullCharge($mode_type,$pickupdistance,$dropofdistance,$radius,$services); 
                     
                      $data['pic_companyname'] = $request->pic_companyname;
                      $data['del_companyname'] = $request->del_companyname;
                      $data['order_status'] = 0;
                      $data['status'] = 1;
                      $data['user_id'] = $this->auth->user()->id;
                      if($request->session()->get('quote_id') && $request->session()->get('quote_id') != '')
                      {
                        $data['quotation_id'] = $request->session()->get('quote_id');
                      }
                      $data['atl'] = (Input::has('atl')) ? true : false;
                      $data['amount'] = $servicedata;
                      $data['created_at'] = $now;
                 //     print_r($data); die();
                      $booking = $booking->create($data);
                      if($booking)
                      {
                        $data1['amount'] = $data['amount'];
                        $data1['payment_status'] = '1';
                        $data1['user_id'] = $this->auth->user()->id;
                        $data1['service_id'] = $request->service_id;
                        $data1['transaction_id'] = 'testhgfrgjgf';
                        $data1['remakers'] = 'testsss';
                        $data1['status'] = '1';
                        $trans = new Transaction($data1);
                        $booking->transactions()->save($trans);
                        if($request->session()->get('quote_id') && $request->session()->get('quote_id') != '')
                        {
                          $data2['service_id'] = $request->service_id;
                          $data2['user_id'] = $this->auth->user()->id;
                          $data2['type'] = '3';
                          $data2['pick_location'] = $request->pic_streetname;
                          $data2['drop_location'] = $request->del_streetname;
                          $data2['amount'] = $data['amount'];
                          $booking->quotatio->where('id',$booking->quotation_id)->update($data2);
                        }
                        $template=EmailTemplate::find('34');
                        $name = $this->auth->user()->first_name.' '.$this->auth->user()->last_name;

                        if($data['order_status']== 0)
                        {
                         $order = 'Wait for Pickup';
                        }
                        $email = $this->auth->user()->email;
                        $find=array('@name@','@orderstatus@');
                        $values=array($name,$order);
                        $body=str_replace($find,$values,$template->content);
                        Mail::send('emails.verify', array('content'=>$body), function($m)use($template,$email)
                              {
                                  $m->to($email)->subject($template->subject);
                              //  $m->cc('kairon.love87@gmail.com');
                                  $m->bcc('aarti.debut@gmail.com');
                              });
      					      
                      $request->session()->forget(array('pickup','dropof','amount','email','mobile','mode_type','service','quote_id','servicedata','pickupdistance','dropofdistance'));
                         flash()->success('Thanks for booking');
                         return redirect('user/booking');
                      }
                    }
                    else
                    {
                      flash()->error('Error!');
                      return redirect('user/booking');       
                    }
                  }
                  else
                  {
                    flash()->error('Error!');
                    return redirect('user/booking');       
                  }
              }
              else
              {
                flash()->error('Error!');
                return redirect('user/booking');
              }
            }
            else
            {
              flush()->error('Error!');
              return redirect('user/booking');
            }

      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function postTotalcharge(Request $request)
    {
      try {
        $service = Services::where('status','1')->find($request->id);
        $distance = '';
        if(Session::get('distance') != '')
        {
          $distance = Session::get('distance');
        }
        $total = $service->price*$distance;

        $result = [
                          'success'=>true,
                          'total'=>$total,
                          'available_time'=>$service->eta
                  ];
        //return response()->json(['success'=>true,'total'=>$total]);
      } catch (Exception $e) {
        flash()->error('Something went wrong!!');
        //return response()->json(['success'=>false]);
        $result = [
                    'success'=>false
                  ];

      }
      return $result;
    }

    public function getLocation()
    {
      try {
        $locations = Location::where('status','1')->where('user_id',$this->auth->user()->id)->get();

        return view('location.index',compact('locations'));
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function getAddlocation()
    {
      try {
        return view('location/create');
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function postAddlocation(LocationRequest $request)
    {
      try {
            $check = Location::where('status','1')->where('contact_name',$request->contact_name)->where('user_id',$this->auth->user()->id)->count();
            if($check == 0)
            {
                $locations = new Location();
                $data = $request->all();
                $data['status'] = '1';
                $data['user_id'] = $this->auth->user()->id;
                $data['pick_loc'] = (Input::has('pick_loc')) ? true : false;
                $data['drop_loc'] = (Input::has('drop_loc')) ? true : false;
                if($data['pick_loc'] == 1)
                {
                    $locations->update(array('pick_loc'=>0));
                }
                if($data['drop_loc'] == 1)
                {
                    $locations->update(array('drop_loc'=>0));
                }
            //    print_r($data);
                $locations = Location::create($data);
                if($locations)
                {
                    flash()->success('Your location has been created!');        
                        return redirect('user/location');
                }
                else
                {
                    flash()->success('Your location not be created!');        
                        return redirect('user/addlocation');
                }
            }
            else
            {
                flash()->error('Location already exist!');
                return redirect('user/location');
            }
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error',$result);          
        }
    }

    public function getEditlocation($id)
    {
      try {
        
        $id = \Crypt::decrypt($id);

        $locations = Location::findOrfail($id);
       return view('location.edit',compact('locations'));
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function postEditlocation(LocationRequest $request,$id)
    {
      try {
            $id = \Crypt::decrypt($id);
            $check = Location::where('status','1')->where('contact_name',$request->contact_name)->where('user_id',$this->auth->user()->id)->where('id','!=',$id)->count();
            if($check == 0)
            {
                $location = Location::where('status','1')->findOrfail($id);
                $data = $request->all();
                $data['pick_loc'] = (Input::has('pick_loc')) ? true : false;
                $data['drop_loc'] = (Input::has('drop_loc')) ? true : false;

                if($data['pick_loc'] == 1)
                {
                    $location->where('user_id',$this->auth->user()->id)->where('id','!=',$id)->update(array('pick_loc'=>0));
                }
                if($data['drop_loc'] == 1)
                {
                    $location->where('user_id',$this->auth->user()->id)->where('id','!=',$id)->update(array('drop_loc'=>0));
                }

                if($location->update($data))
                {
                  flash()->success('Location has been updated!');
                  return redirect('user/location');
                }
                else
                {
                  flash()->error('Location not be created');
                  return redirect('user/editlocation/'.base64_encode($id));
                }
            }
            else
            {
              flash()->error('Item already exist');
              return redirect('user/editlocation/'.base64_encode($id));
            }

        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error',$result);   
        }
    } 

    public function postChangepicklocation(Request $request)
    {
      try {

           // $id = \Crypt::decrypt($request->object);
            $id = $request->object;
            if($id != '')
            {
              $location = Location::where('status','1')->where('street_name',$id)->get()->toArray();
              if($location)
              {
                $result = [
                            'success'=>true,
                            'location'=>$location
                          ];
                return $result;
              }
              else
              {
                return $result = ['success'=>false];
              }
            }
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function getHistory()
    {
      try {
            $bookings = Booking::where('status',1)->where('user_id',$this->auth->user()->id)->get();
            return view('user.orderhistory',compact('bookings'));

            /*foreach($bookings AS $booking)
              {
                $endTime = strtotime("+10 minutes", strtotime($booking['created_at']));
                $date = date('Y-m-d H:i:s', $endTime); 
                $now = date('Y-m-d H:i:s');
                if($now < $date)
                {
                  echo $now."<br>";   
                  echo 'cancelled!';
                  echo "<br>";
                }
              }*/

      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function postChangeorderstatus(Request $request)
    {
      /*try {
        $id = \Crypt::decrypt($request->id);die();
        $booking = Booking::where('status',1)->find($id);
        $data['order_status'] = $request->ostatus; 
        $data['comment'] = $request->ostatus; 
        $booking = $booking->update($data);
        if($booking)
        {
          flash()->success('Successfully Cancelled booking!');
          $result = [
                      'status'=>(bool)true
                    ];
        }
        else
        {
          flash()->error('Something wrong!');
          $result = [
                      'status'=>(bool)false
                    ];
        }
        return $result;
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);        
      }*/
      try {
        $id = \Crypt::decrypt($request->id);
        if($id != '')
        {
          //$orderstatus=DB::table('booking_detail')->where('id',$id);
          $orderstatus = Booking::where('status',1)->find($id);
          $template=EmailTemplate::find('29');
          $user = '';
          $email = '';
          if($orderstatus->user)
          {
            $user = $orderstatus->user->first_name;
            $email = $orderstatus->user->email;
          }
          $data['order_status'] = $request->ostatus; 
          switch ($data['order_status']) {
          case 3:
            $status = 'Cancelled by you';
            break;
          default:
            $status = 'Order not cancelled';
          break;            
        }
        $data['order_status'] = $request->order_status;
                $data['comment'] = $request->comment;
                $orderstatus = $orderstatus->update($data);
        $find=array('@user@','@status@');
        $values=array($user,$status);
        /*$body=str_replace($find,$values,$template->content);
            //Send Mail
        if(Mail::send('emails.verify', array('content'=>$body), function($m)use($template,$email)
          {
              $m->to($email)->subject($template->subject);
            //  $m->cc('kairon.love87@gmail.com');
          })){
              
              
            }*/
            $result = [
                      'success' => true,
                flash()->success('Status Changed successfully'),
                    ];
            
            
            }
      } catch (Exception $e) {
         $result = [
                    'success' => false,
            flash()->success('Status cannot be Changed!'),
                ];
      }
      return $result;
    }

    public function getQuote()
    {
      try {
        $modes = $this->common->getmodetype();

        return view('user.quoteme',compact('modes'));
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function postQuote(QuotationRequest $request)
    {
      try {
        $data = $request->all();
        //print_r($data);
        $data['status'] = 1;
        $data['user_id'] = $this->auth->user()->id;
        $data['type'] = '1';
        $quote = new Quotation();
        $quote = $quote->create($data);
        if($quote)
        {
          $quote_id = $quote->id;
          $center = '';
            $pickup = $request->pick_location;
            $dropof = $request->drop_location;
            $mode_type = $request->mode_type;
            $center = 'Phase 11, Sahibzada Ajit Singh Nagar, Punjab, India';
            $request->session()->put('centerdistance',$center);
            if($pickup != '')
            {
               $pickupdistance = $this->common->getDistance($pickup,$center);
            }
            if($dropof != '')
            {
             $dropofdistance = $this->common->getDistance($dropof,$center);   
            }
            $radius = $this->common->getRadius();
            $servicedata = $this->common->getFullCharge($mode_type,$pickupdistance,$dropofdistance,$radius);
          /*
            $request->session()->put('distance',$distance);
          */
          $request->session()->put('pickupdistance',$pickupdistance);
          $request->session()->put('dropofdistance',$dropofdistance);
          $request->session()->put('pickup', $request->pick_location);
          $request->session()->put('dropof',$request->drop_location);
          $request->session()->put('mode_type',$request->mode_type);
          $request->session()->put('email',$request->email);
          $request->session()->put('mobile',$request->mobile);
          $request->session()->put('quote_id',$quote_id);
          $request->session()->put('servicedata',$servicedata);

          $services = $request->session()->get('servicedata');
          //$request->session()->get('distance');
          return view('user.quotation',compact('services'));
        }

      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }


    public function postBooked(Request $request)
    {
      try {
        $mode_type = '';
        if($request->session()->get('mode_type') != '')
        {
          $mode_type = $request->session()->get('mode_type');
        }
        $service = Settings::where('title',$request->service)
                            ->where('mode_type',$mode_type)
                            ->where('status',1)
                            ->first();
                            
        //$total = $request->session()->get('addtional_charges') + $service->value;
        if($service)
        {
          $pickup = $request->session()->get('pickup');
            $dropof = $request->session()->get('dropof');
          $center = $request->session()->get('centerdistance');
          if($pickup != '')
          {
             $pickupdistance = $this->common->getDistance($pickup,$center);
          }
          if($dropof != '')
          {
           $dropofdistance = $this->common->getDistance($dropof,$center);   
          }
          $radius = $this->common->getRadius();
          $servicedata = $this->common->getFullCharge($mode_type,$pickupdistance,$dropofdistance,$radius,$service);
          $request->session()->put('service', $service->title);
          $request->session()->put('amount',$servicedata);
          $request->session()->get('service');
          //die();
          return redirect('user/booking');
        }
        else
        {
          flash()->error('Invalid service!'); 
        }
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function getPayment()
    {
      try {
        $transactions = Transaction::where('payment_status','1')
                                    ->where('status','1')
                                    ->where('user_id',$this->auth->user()->id)
                                    ->get();                           
        return view('user.payment',compact('transactions'));
      } catch (Exception $e) {
        $result = [
                    'exception_message'=>$e->getMessage()
                  ];
        return view('errors.error',$result);          
      }
    }

    public function postTotaldistance(Request $request)
    {
      try 
      {
        /*$dropof = $request->droploc;
        
        $pickup = $request->picloc;
      
        //$request->session()->get('centerdistance');
        
        $request->session()->put('centerdistance',$center);
        if($pickup != '')
        {
           $pickupdistance = $this->common->getDistance($pickup,$center);
        }
        if($dropof != '')
        {
          $dropofdistance = $this->common->getDistance($dropof,$center);   
        }
       
        $result = [
                    'success'=>true,
                    'pickdistance'=>$pickupdistance,
                    'dropdistance'=>$dropofdistance
                   ];
        return $result;    */     
        $pickup = $request->picloc;
        $dropof = $request->droploc;
        $services = '';
        $total = 0;
        $mode_type = '';
        $center = 'Phase 11, Sahibzada Ajit Singh Nagar, Punjab, India';
        if($pickup != '')
        {
          $pickupdistance = $this->common->getDistance($pickup,$center);
          //$request->session()->put('pickup',$pickup); 
        }
        if($dropof != '')
        {
         $dropofdistance = $this->common->getDistance($dropof,$center);   
        // $request->session()->put('dropof',$dropof); 
        }
       
       
      
        $result = [
                    'success'=>true,
                    'dropdistance'=>$dropofdistance,
                    'pickdistance'=>$pickupdistance
                  ];
        return $result; 
      } 
      catch (Exception $e) 
      {
        $result = [
                    'success'=>false,
                    'message'=>$e->getMessage()
                  ];          
      }
    }

    public function postAjaxtotaldistance(Request $request)
    {
      try {
        $pickup = $request->picloc;
        $dropof = $request->droploc;
        $services = '';
        $total = 0;
        $mode_type = '';
        $center = $request->session()->get('centerdistance');
        if($pickup != '')
        {
          $pickupdistance = $this->common->getDistance($pickup,$center);
          //$request->session()->put('pickup',$pickup); 
        }
        if($dropof != '')
        {
         $dropofdistance = $this->common->getDistance($dropof,$center);   
        // $request->session()->put('dropof',$dropof); 
        }
        $mode_type = $request->modetype;
        if($mode_type != '')
        {
          /* common function to get amount **/
          //$request->session()->put('additional_charges',$addtional_charge);
        }
        if(isset($request->service) && $request->service != '')
        {
          $services = Settings::where('status',1)
                                ->where('title',$request->service)
                                ->where('mode_type',$mode_type)
                                ->first(); 
        
        }
        $eta = '';
        if($pickup != '' && $dropof != '' && $mode_type != '' && $request->service != '')
        {
          if($services != '')
          {
            $radius = $this->common->getRadius();
            $addtional_charge = $this->common->getFullCharge($mode_type,$pickupdistance,$dropofdistance,$radius,$services);
            $eta = $services->eta;
            $total = $addtional_charge;
         //   $request->session()->put('service',$services['title']);
         //   $request->session()->put('amount',$addtional_charge);
          }
        }
        $result = [
                    'success'=>true,
                    'dropdistance'=>$dropofdistance,
                    'pickdistance'=>$pickupdistance,
                    'amount'=>$total,
                    'available_time'=>$eta
                  ];
        return $result;

      } catch (Exception $e) {
        $result = [
                    'success'=>false,
                    'message'=>$e->getMessage()
                  ]; 
        return view('errors.error',$result);        
      }
    }

/*    public function getLocation()
    {
      try {
         //   $active='location';
            $locations = Location::where('status','1')->where('user_id',$this->auth->user()->id)->get();
            return view('location.index',compact('locations'));
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error',$result);          
        }
    }*/

}
