<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use repositories\CommonRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InterestRequest;
use App\User;
use App\EmailTemplate;
use Input;
use Mail;
use DB;
use Hash;


class UsersController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('admin');
	}
    /**
     * Created By: Jagraj Singh
     * Created for: Index Realtors
     * created date:November 2016
     */
    public function getIndex()
    {
        try
		{
			
			$active= 'realtors';
			$users = User::where('type','1')->paginate(10);
			return view('admin.clients.indexrealtor', compact('users','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'realtors'
            ];
			return view('errors.error', $result);
        }
    }
    
    
    
    
    /********
     * created by: Jagraj Singh
     * Created for: Listing Realtors in datatable with filters using ajax 
     * 
     *********/
    public function postListRealtor(Request $request,CommonRepository $common)
	{
		 $basearray = DB::table('users')->where('id','!=','')->whereIn('type',[1,2,4]);
		  $totalusercount = DB::table('users')->where('id','!=','')->whereIn('type',[1,2,4])->count();
		
		
		
		/*****************Below code is for filtering ****************/
		if(isset($request->name) && !empty($request->name))
		{
			
			$basearray->where('name','LIKE','%'.$request->name.'%');
		}
		if(isset($request->email) && !empty($request->email))
		{
			
			$basearray->where('email','LIKE','%'.$request->email.'%');
		}
		if(isset($request->address) && !empty($request->address))
		{
			
			$basearray->where('address','LIKE','%'.$request->address.'%');
		}
		if(isset($request->address) && !empty($request->address))
		{
			
			$basearray->where('address','LIKE','%'.$request->address.'%');
		}
		
		if(isset($request->phone) && !empty($request->phone))
		{
			
			$basearray->where('phone','LIKE','%'.$request->phone.'%');
		}
		if(isset($request->type) && !empty($request->type))
		{
			$basearray->where('type',$request->type);
		}
		if(isset($request->status))
		{
			
			if($request->status == '1'){
				
				$basearray->where('status',1);
			}
			elseif($request->status == '0'){
				
				$basearray->where('status',0);
			}
			else{
				
			}
			
		}
		/*****************Below code is for Sorting ****************/
		
		$order = $request->get('order');
			
			if($order[0]['column'] == 1 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('name','asc');
			}
			elseif($order[0]['column'] == 1 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('name','desc');
			}
			elseif($order[0]['column'] == 2 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('email','asc');
			}
			elseif($order[0]['column'] == 2 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('email','desc');
			}
			else{
				$basearray->orderBy('id','desc');
			}
			
			
		$counttotal =  User::get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
				foreach($resultset as $realtor){
					
					
									$userId = \Crypt::encrypt($realtor->id);
									//$type = \Crypt::encrypt('realtor');
									$type = \Crypt::encrypt($realtor->type);
								
					
					$urlproperty = url('/'.getenv("adminurl").'/properties/create/'.$userId);
					if($realtor->type==1)
					{
						$view_link = '<a userid="'.$userId.'" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail" ><span class="icon-eye" style="color:blue;"></span></a><a href="users/edit/'.$type.'/'.$userId.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a> <a href="properties/'.$userId.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:brown" title="Property" class="glyphicon glyphicon-home" aria-hidden="true"></span></a>';
					}
					else if($realtor->type==2)
					{
						$view_link = '<a userid="'.$userId.'" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail"><span class="icon-eye" style="color:blue;"></span></a><a href="users/edit/'.$type.'/'.$userId.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a><a href="'.$urlproperty.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:brown" title="Property" class="glyphicon glyphicon-home" aria-hidden="true"></span></a>';
					}
					else if($realtor->type==4)
					{
						$view_link = '<a userid="'.$userId.'" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail" ><span class="icon-eye" style="color:blue;"></span></a><a href="users/edit/'.$type.'/'.$userId.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a> <a href="properties/'.$userId.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:brown" title="Property" class="glyphicon glyphicon-home" aria-hidden="true"></span></a> <a href="'.$urlproperty.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:green" title="Property" class="glyphicon glyphicon-home" aria-hidden="true"></span></a>';
					}
					
					if(isset($realtor->address) && !empty($realtor->address)){
						$addresslength = strlen($realtor->address);
						$add = $realtor->address;
						if($addresslength > 30){
							
						$address = substr($add,0,30).'...';
						}
						else{
							
						 $address = substr($add,0,30);
						}
					}
					if(isset($realtor->name) && !empty($realtor->name)){
						$namelength = strlen($realtor->name);
						if($namelength>30){
							$name = substr($realtor->name,0,30).'...';
						}
						
						else{
							$name = substr($realtor->name, 0, 30);
						}
						
					}
				
					
					if(isset($realtor->email) && !empty($realtor->email)){
						$emaillength = strlen($realtor->email);
						if($emaillength > 30)
						$email = substr($realtor->email,0,30)."...";
						else
						$email = substr($realtor->email,0,30);
					}
					$userType = '';
					if(isset($realtor->type) && !empty($realtor->type)){
						if($realtor->type==1)	
							$userType = 'Realtor';
						else if($realtor->type==2)
							$userType = 'House Owner';
						else if($realtor->type==4)
							$userType = 'Both';
						
					}
					
					if($realtor->status== '1')
					{
						$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$realtor->id.'" data-status="'.$realtor->status.'" data-action="Plans"><i class="fa fa-circle text-success active"></i><a></div>';
					}
					else{
						$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$realtor->id.'" data-status="'.$realtor->status.'" data-action="Plans"><i class="fa fa-circle text-danger inactive"></i><a></div>';
					}


					
					$GLOBALS['data'][] = array($i,$name,$email,$address,$realtor->phone,$userType,$status,$view_link);

					$i++;
					
				}
	
	
	
	
		$result = array();
		$result['data'] = $GLOBALS['data'];
		$result['draw'] = intval($request->get('draw'));
		$result['recordsTotal'] = $basearray->count();
		$result['recordsFiltered'] =$totalusercount;
		
		return json_encode($result);
	}
    
    
    
    
      /**
     * Created By: Jagraj Singh
     * Created for: For getting the view for creating realtor or houseowner or technician.
     * created date:November 2016
     */
    public function getCreateUser($checktype = '')
    {
        try
		{
			$typeuser = $checktype;
			
			switch($typeuser){
			
			case "Realtor":
			$active= 'realtors';
			return view('admin.clients.createuser', compact('active','typeuser'));
			break;
			
			case "Houseowner":
			$active= 'houseowners';
			return view('admin.clients.createuser', compact('active','typeuser'));
			break;
			
			case "Technician":
			$active= 'technicians';
			return view('admin.technicians.createuser', compact('active'));
			break;
			
			default:
			return 'Error';
			break;
		 }
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'realtors'
            ];
			return view('errors.error', $result);
        }
    }
    
      /**
     * Created By: Jagraj Singh
     * Created for: Index function for houseowner
     * created date:November 2016
     */
    public function getIndexHouse()
    {
        try
		{
			$active= 'houseowners';
			 $users = User::where('type','2')->get();
			return view('admin.clients.indexhouseowner', compact('users','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'houseowners'
            ];
			return view('errors.error', $result);
        }
    }
    
    
     /********
     * created by: Jagraj Singh
     * Made for: Listing Realtors in datatable with filters using ajax 
     * 
     *********/
    public function postListHouseowner(Request $request,CommonRepository $common)
	{
		
		 $basearray = DB::table('users')->where('id','!=','')->where('type',2);
		  $totalusercount = DB::table('users')->where('id','!=','')->where('type',2)->count();
		
		
		
		/*****************Below code is for filtering ****************/
		if(isset($request->name) && !empty($request->name))
		{
			
			$basearray->where('name','LIKE','%'.$request->name.'%');
		}
		if(isset($request->email) && !empty($request->email))
		{
			
			$basearray->where('email','LIKE','%'.$request->email.'%');
		}
		if(isset($request->address) && !empty($request->address))
		{
			
			$basearray->where('address','LIKE','%'.$request->address.'%');
		}
		if(isset($request->address) && !empty($request->address))
		{
			
			$basearray->where('address','LIKE','%'.$request->address.'%');
		}
		
		if(isset($request->phone) && !empty($request->phone))
		{
			
			$basearray->where('phone','LIKE','%'.$request->phone.'%');
		}
		if(isset($request->status))
		{
			
			if($request->status == '1'){
				
				$basearray->where('status',1);
			}
			elseif($request->status == '0'){
				
				$basearray->where('status',0);
			}
			else{
				
			}
			
		}
		/*****************Below code is for Sorting ****************/
		
		$order = $request->get('order');
		
			if($order[0]['column'] == 1 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('name','asc');
			}
			elseif($order[0]['column'] == 1 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('name','desc');
			}
			elseif($order[0]['column'] == 2 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('email','asc');
			}
			elseif($order[0]['column'] == 2 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('email','desc');
			}
			else{
				$basearray->orderBy('id','desc');
			}
			
		$counttotal =  User::get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
			foreach($resultset as $houseowner){

			$userId = \Crypt::encrypt($houseowner->id);
			$type = \Crypt::encrypt('houseowner');

			$urlproperty = url('/'.getenv("adminurl").'/properties/create/'.$userId);
			$view_link = '<a userid="'.$userId.'" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail"><span class="icon-eye" style="color:blue;"></span></a><a href="edit/'.$type.'/'.$userId.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a><a href="'.$urlproperty.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:brown" title="Property" class="glyphicon glyphicon-home" aria-hidden="true"></span></a>';




			if(isset($houseowner->address) && !empty($houseowner->address)){
			$addresslength = strlen($houseowner->address);
			$add = $houseowner->address;
			if($addresslength > 30){

			$address = substr($add,0,30).'...';
			}
			else{

			$address = substr($add,0,30);
			}
			}
			if(isset($houseowner->name) && !empty($houseowner->name)){
			$namelength = strlen($houseowner->name);
			if($namelength>30){
			$name = substr($houseowner->name,0,30).'...';
			}

			else{
			$name = substr($houseowner->name, 0, 30);
			}

			}


			if(isset($houseowner->email) && !empty($houseowner->email)){
			$emaillength = strlen($houseowner->email);
			if($emaillength > 30)
			$email = substr($houseowner->email,0,30)."...";
			else
			$email = substr($houseowner->email,0,30);
			}

			if($houseowner->status== '1')
			{
			$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$houseowner->id.'" data-status="'.$houseowner->status.'" data-action="Plans"><i class="fa fa-circle text-success active"></i><a></div>';
			}
			else{
			$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$houseowner->id.'" data-status="'.$houseowner->status.'" data-action="Plans"><i class="fa fa-circle text-danger inactive"></i><a></div>';
			}

			$GLOBALS['data'][] = array($i,$name,$email,$address,$houseowner->phone,$status,$view_link);

			$i++;

			}
	
	
	
	
		$result = array();
		$result['data'] = $GLOBALS['data'];
		$result['draw'] = intval($request->get('draw'));
		$result['recordsTotal'] = $basearray->count();
		$result['recordsFiltered'] = $totalusercount;
		
		return json_encode($result);
	}

    /**
     * Created By: Jagraj Singh
     * Created for: creating Realtor or Houseowner
     * created date:November 2016
     */
    public function postCreateUser(Requests\ClientRequest $request)
    {
		try
		{
		$data = $request->all();
		//~ $filename = "";
		//~ if (Input::hasFile('photo')) {
		  //~ 
		  //~ $file = $request->file('photo');
		  //~ $destination_path = 'uploads/clients/';
		  //~ $filename = time().'_'.$file->getClientOriginalName();
		  //~ $file->move($destination_path, $filename);
		//~ }
		
		if($request->type == '1'){
			$type = 'Realtor';
		}
		if($request->type == '2'){
			$type = 'House Owner';
		}
		if($request->type == '3'){
			$type = 'Both';
		}
	//~ 
		//~ if ($filename) {
		 //~ $data['photo'] = 'uploads/clients/'.$filename;
		//~ }
		 $data['status'] = (int)$request['status'];
		  $data['password'] =  Hash::make($request['password']);
		  $user = new User($data);
		if($user->save()){
						$name = $request->name;
						$email = $request->email;
						$password = $request->password;
						$url = 'www.frontlineapp.com';
						$company = config('app.website_name');
						$typeuser = $type; 	
						$subject = $typeuser." Registration on ".$company;
                        $template=EmailTemplate::find(41);
                        $find=array('@name@','@username@','@password@','@type@','@link@','@company@');
                        $values=array($name,$email,$password,$typeuser,$url,$company);
						$body=str_replace($find,$values,$template->content);
                        //Send Mail
						Mail::send('emails.verify', array('content'=>$body), function($message) use($template,$email,$subject)
						{
						$message->to($email)
						->subject($subject);
						});
						/*if($type == 'Realtor'){*/
							  flash()->success('User created successfully');
							 return response()->json(['success'=>true,'clienttype'=>'realtor']);
						/*}*/
			
						/*elseif($type == 'House Owner'){
							  flash()->success('Houseowner created successfully');
							  return response()->json(['success'=>true,'clienttype'=>'realtor']);
						 }
						 elseif($type == 'Both'){
							  flash()->success('User can be Relator and Houseowner created successfully');
							  return response()->json(['success'=>true,'clienttype'=>'realtor']);
						 }*/
			
		}
		else{
			 flash()->error('Something went wrong');
			 return response()->json(['success'=>false]);
		}
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'realtors'
            ];
			return view('errors.error', $result);
        }
    }

    

   /**
     * Created By: Jagraj Singh
     * Created for: detail page for Realtor and Houseowner
     * created date:November 2016
     */
     public function postShowrealtor(Request $request)
	{
		$id = \Crypt::decrypt($request->id);
			
         $data['reslutset'] = User::where('id',$id)->first();
			if(!count($data['reslutset']))
			{
				$result = [
					'error' => 'error',
					'exception_message' => 'Record does not exist.',
					
				];
				return json_encode($result);
			}
			else
			{
				return json_encode($data);
				
				
			}
	
	}
    //~ public function getShow($type = null,$id)
    //~ {
		//~ 
		 //~ $type = \Crypt::decrypt($type);
		 //~ if($type == 'realtor'){
			 //~ $client = 'Realtor';
			 //~ $active = 'realtors';
		 //~ }
		  //~ if($type == 'houseowner'){
			 //~ $client = 'Houseowner';
			 //~ $active = 'houseowners';
		 //~ }
		 //~ $userid = \Crypt::decrypt($id);
		//~ 
         //~ $detail = User::where('id',$userid)->first();
        //~ return view('admin.clients.showclient', compact('detail','client','active'));
    //~ }

   /**
     * Created By: Jagraj Singh
     * Created for: getting the edit page for realtro or houseowner
     * created date:November 2016
     */
    public function getEdit($type = null,$id)
    {
	
        try
		{
			$type = \Crypt::decrypt($type);
			 $client_id = \Crypt::decrypt($id);
			 $edit = 'yes';
		 $active = 'realtors';
		 /*if($typeuser == 'realtor'){
			 $type = '1';
			 $active = 'realtors';
			 
		 }
		  if($typeuser == 'houseowner'){
			 $type = '2';
			 $active = 'houseowners';
			 
		 }*/
          $user = User::where('id',$client_id)->where('type',$type)->first();
         return view('admin.clients.edituser', compact('user','active','type','edit','id'));
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'realtors'
            ];
			return view('errors.error', $result);
        }
    }

  /**
     * Created By: Jagraj Singh
     * Created for: updating realtor or houseowner
     * created date:November 2016
     */
    public function postUpdateUser(Requests\ClientRequest $request, $id)
    {
        try
		{
			
			$user_id = \Crypt::decrypt($id);
			$user = User::find($user_id);
			$type = $user->type;
			 $data = $request->all();
			//~ $filename = "";
		//~ if (Input::hasFile('photo')) {
		  //~ 
		  //~ $file = $request->file('photo');
		  //~ $destination_path = 'uploads/clients/';
		  //~ $filename = time().'_'.$file->getClientOriginalName();
		  //~ $file->move($destination_path, $filename);
		  //~ $path=$user->photo;
		  //~ if(isset($path)){
			//~ unlink($path);
		  //~ }
		//~ 
		//~ }
		$user->name = $request->name;
		$user->address = $request->address;
		$user->phone = $request->phone;
		$user->status = (int)$request['status'];
		
			//~ if ($filename) {
		//~ $user->photo = 'uploads/clients/'.$filename;
		//~ }
		
		if(isset($request->password) && !empty($request->password)){
			$user->password = \Crypt::encrypt($request['password']);
		}
		
		$complete =  $user->update();
			
			if($complete){
				/*if($type == '1'){*/
					 flash()->success('User updated successfully');
					 return response()->json(['success'=>true,'clienttype' => 'realtor']);
					/*}*/
				/*elseif($type == '2'){
					 flash()->success('Houseowner updated successfully');
					 return response()->json(['success'=>true,'clienttype' => 'houseowner']);
					
				}*/
			
		}
		else{
			 flash()->error('Something went wrong');
			 return response()->json(['success'=>false]);
		}
			
			
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'realtors'
            ];
			return view('errors.error', $result);
        }       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
   /**
     * Created By: Jagraj Singh
     * Created for: Index function for technician
     * created date:November 2016
     */
    public function getIndexTechnician()
    {
        try
		{
			$active= 'technicians';
			 $users = User::where('type','3')->get();
			return view('admin.technicians.index', compact('users','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'technicians'
            ];
			return view('errors.error', $result);
        }
    }
    
    
    
    /**
     * Created By: Jagraj Singh
     * Created for: for creating technician
     * created date:November 2016
     */
    public function postCreateTechnician(Requests\TechnicianRequest $request)
    {
		try
		{
		$data = $request->all();
		$filename = "";
		if (Input::hasFile('photo')) {
		  
		  $file = $request->file('photo');
		  $destination_path = 'uploads/technicians/';
		  $filename = time().'_'.$file->getClientOriginalName();
		  $file->move($destination_path, $filename);
		}
	 
		if ($filename) {
		 $data['photo'] = 'uploads/technicians/'.$filename;
		}
		 $data['status'] = (int)$request['status'];
		 $data['type'] = 3;
		  $user = new User($data);
		if($user->save()){
						$name = $request->name;
						$email = $request->email;
						$password = $request->password;
						$url = 'www.frontlineapp.com';
						$company = config('app.website_name');
						
						$typeuser = 'Technician'; 
						
						$subject = $typeuser." Registration on ".$company;
						
                        $template=EmailTemplate::find(41);
                        $find=array('@name@','@username@','@password@','@type@','@link@','@company@');
                        $values=array($name,$email,$password,$typeuser,$url,$company);
						$body=str_replace($find,$values,$template->content);
                        //Send Mail
						Mail::send('emails.verify', array('content'=>$body), function($message) use($template,$email,$subject)
						{
						$message->to($email)
						->subject($subject);
						});
							 flash()->success('Technician created successfully');
							 return response()->json(['success'=>true]);
						
			
						
			
		}
		else{
			 flash()->success('Something went wrong');
			 return response()->json(['success'=>false]);
		}
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'technicians'
            ];
			return view('errors.error', $result);
        }
    }
    
    
    
    
    
    /********
     * created by: Jagraj Singh
     * Made for: Listing Technicians in datatable with filters using ajax 
     * 
     *********/
    public function postListTechnician(Request $request,CommonRepository $common)
	{
		
	
		
		 $basearray = DB::table('users')->where('id','!=','')->where('type',3);
		  $totalusercount = DB::table('users')->where('id','!=','')->where('type',3)->count();
		
		
		
		/*****************Below code is for filtering ****************/
		if(isset($request->name) && !empty($request->name))
		{
			
			$basearray->where('name','LIKE','%'.$request->name.'%');
		}
		if(isset($request->email) && !empty($request->email))
		{
			
			$basearray->where('email','LIKE','%'.$request->email.'%');
		}
		if(isset($request->address) && !empty($request->address))
		{
			
			$basearray->where('address','LIKE','%'.$request->address.'%');
		}
		if(isset($request->domain) && !empty($request->domain))
		{
			
			$basearray->where('domain','LIKE','%'.$request->domain.'%');
		}
		if(isset($request->address) && !empty($request->address))
		{
			
			$basearray->where('address','LIKE','%'.$request->address.'%');
		}
		
		if(isset($request->phone) && !empty($request->phone))
		{
			
			$basearray->where('phone','LIKE','%'.$request->phone.'%');
		}
		if(isset($request->status))
		{
			
			if($request->status == '1'){
				
				$basearray->where('status',1);
			}
			elseif($request->status == '0'){
				
				$basearray->where('status',0);
			}
			else{
				
			}
			
		}
		/*****************Below code is for Sorting ****************/
		
		$order = $request->get('order');
			if($order[0]['column'] == 1 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('name','asc');
			}
			elseif($order[0]['column'] == 1 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('name','desc');
			}
			elseif($order[0]['column'] == 2 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('email','asc');
			}
			elseif($order[0]['column'] == 2 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('email','desc');
			}
			else{
				$basearray->orderBy('id','desc');
			}
			
		$counttotal =  User::get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
				foreach($resultset as $realtor){
					
					
									$userId = \Crypt::encrypt($realtor->id);
									
								
					
					
					$view_link = '<a userid="'.$userId.'" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail"><span class="icon-eye" style="color:blue;"></span></a><a href="edit-technician/'.$userId.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>';
					
					if(isset($realtor->address) && !empty($realtor->address)){
						$addresslength = strlen($realtor->address);
						$add = $realtor->address;
						if($addresslength > 30){
							
						$address = substr($add,0,30).'...';
						}
						else{
							
						 $address = substr($add,0,30);
						}
					}
					if(isset($realtor->name) && !empty($realtor->name)){
						$namelength = strlen($realtor->name);
						if($namelength>30){
							$name = substr($realtor->name,0,30).'...';
						}
						
						else{
							$name = substr($realtor->name, 0, 30);
						}
						
					}
					
					
					
					if(isset($realtor->domain) && !empty($realtor->domain)){
						$domainlength = strlen($realtor->domain);
						if($domainlength>30){
							$domain = substr($realtor->domain,0,30).'...';
						}
						
						else{
							$domain = substr($realtor->domain, 0, 30);
						}
						
					}
				
					
					if(isset($realtor->email) && !empty($realtor->email)){
						$emaillength = strlen($realtor->email);
						if($emaillength > 30)
						$email = substr($realtor->email,0,30)."...";
						else
						$email = substr($realtor->email,0,30);
					}
					
					if($realtor->status== '1')
					{
						$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$realtor->id.'" data-status="'.$realtor->status.'" data-action='.getenv("adminurl").'"/users/index-technician"><i class="fa fa-circle text-success active"></i><a></div>';
					}
					else{
						$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$realtor->id.'" data-status="'.$realtor->status.'" data-action='.getenv("adminurl").'"/users/index-technician"><i class="fa fa-circle text-danger inactive"></i><a></div>';
					}
					
					$GLOBALS['data'][] = array($i,$name,$email,$domain,$address,$realtor->phone,$status,$view_link);

					$i++;
					
				}
	
	
	
	
		$result = array();
		$result['data'] = $GLOBALS['data'];
		$result['draw'] = intval($request->get('draw'));
		$result['recordsTotal'] = $basearray->count();
		$result['recordsFiltered'] = $totalusercount;
		
		return json_encode($result);
	}
    
    
    
    /**
     * Created By: Jagraj Singh
     * Created for: getting edit form for technician
     * created date:November 2016
     */
    public function getEditTechnician($id)
    {
	
        try
		{
			 
			 $client_id = \Crypt::decrypt($id);
			 $edit = 'yes';
			 $active = 'technicians';
			 
		 
           $user = User::where('id',$client_id)->where('type',3)->first();
         return view('admin.technicians.edituser', compact('user','active','edit','id'));
         }
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'technicians'
            ];
			return view('errors.error', $result);
        }
    }

    /**
     * Created By: Jagraj Singh
     * Created for: for updating technician
     * created date:November 2016
     */
    public function postUpdateTechnician(Requests\TechnicianRequest $request, $id)
    {
        try
		{
			 $request->all();
			$user_id = \Crypt::decrypt($id);
			$user = User::find($user_id);
			
			 $data = $request->all();
			$filename = "";
		if (Input::hasFile('photo')) {
		  
		  $file = $request->file('photo');
		  $destination_path = 'uploads/technicians/';
		  $filename = time().'_'.$file->getClientOriginalName();
		  $file->move($destination_path, $filename);
		  $path=$user->photo;
		  //~ if(isset($path)){
			//~ unlink($path);
		  //~ }
		
		}
		$user->name = $request->name;
		$user->type = 3;
		$user->address = $request->address;
		$user->domain = $request->domain;
		$user->phone = $request->phone;
		$user->status = (int)$request['status'];
		
			if ($filename) {
		 $user->photo = 'uploads/technicians/'.$filename;
		}
		
		$complete =  $user->update();
		if($complete){
				 flash()->success('Technician updated successfully');
		return response()->json(['success'=>true]);
					
		}
		else{
			 flash()->error('Something went wrong');
			 return response()->json(['success'=>false]);
		}
			
			
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'technicians'
            ];
			return view('errors.error', $result);
        }       
    }
    
    
   /**
     * Created By: Jagraj Singh
     * Created for: getting detail page of technician
     * created date:November 2016
     */
    //~ public function getShowTechnicians($id)
    //~ {
		//~ 
		 //~ 
		//~ 
			 //~ $active = 'technicians';
	//~ 
		 //~ $userid = \Crypt::decrypt($id);
		//~ 
         //~ $detail = User::where('id',$userid)->first();
        //~ return view('admin.technicians.showclient', compact('detail','active'));
    //~ }
    
    
    
    
    
}
