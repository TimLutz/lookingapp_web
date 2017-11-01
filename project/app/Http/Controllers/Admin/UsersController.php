<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use repositories\CommonRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Response;

class UsersController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('admin');
		//$this->middleware('backbutton');
	}

    /**
     * Created By: Lovepreet Singh
     * Created for: Index All Unban Users
     * created date:August 2017
     */
    public function getIndex()
    {
        try
		{
			$active= 'users';
			$users = User::paginate(10);

			return view('admin.users.index', compact('users','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'users'
            ];
			return view('errors.error', $result);
        }
    }
    
    /********
     * created by: Lovepreet Singh
     * Created for: Listing Unban Users in datatable with filters using ajax 
     * 
     *********/
    public function postListAllUsers(Request $request,CommonRepository $common)
	{
		 $basearray = User::with(['Profile'])->where(['role'=>2]);
		  $totalusercount = DB::table('users')->where(['role'=>2])->count();
		
		/*****************Below code is for filtering ****************/
		if(isset($request->name) && !empty($request->name))
		{
			
			$basearray->where('screen_name','LIKE','%'.$request->name.'%');
		}
		if(isset($request->email) && !empty($request->email))
		{
			
			$basearray->where('email','LIKE','%'.$request->email.'%');
		}
		if(isset($request->profile_id) && !empty($request->profile_id))
		{
			
			$basearray->where('profile_id','LIKE','%'.$request->profile_id.'%');
		}

		/*****************Below code is for Sorting ****************/
		
		$order = $request->get('order');
			
			if($order[0]['column'] == 2)
			{
				$basearray->orderBy('screen_name',$order[0]['dir']);
			}
			elseif($order[0]['column'] == 3)
			{
				$basearray->orderBy('profile_id',$order[0]['dir']);
			}
			else if($order[0]['column'] == 4)
			{
				$basearray->orderBy('email',$order[0]['dir']);
			}
			else if($order[0]['column'] == 5)
			{
				$basearray->orderBy('member_type',$order[0]['dir']);
			}
			else if($order[0]['column'] == 6)
			{
				$basearray->orderBy('created_at',$order[0]['dir']);
			}
			else if($order[0]['column'] == 7)
			{
				$basearray->orderBy('valid_upto',$order[0]['dir']);
			}
			else
			{
				$basearray->orderBy('id','desc');
			}
			
			
		$counttotal =  User::where(['role'=>2])->get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
		$GLOBALS['total']=count($resultset);
		
		foreach($resultset as $value){
			$userId = \Crypt::encrypt($value->id);
			if($value->status== '1')
			{
				$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$value->id.'" data-status="'.$value->status.'" data-action="Plans"><i class="fa fa-check-circle text-success"></i><a></div>';
			}
			else{
				$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$value->id.'" data-status="'.$value->status.'" data-action="Plans"><i class="fa fa-ban text-danger"></i><a></div>';
			}

			$aboutMe = $createDate=$memberType = '';
			if($value->member_type == 1 && strtotime($value->vaild_upto)>=strtotime(date('Y-m-d')) && $value->is_trial == 1){
				$memberType = 'Trial';
			}
			else if($value->member_type == 1 && strtotime($value->vaild_upto)>=strtotime(date('Y-m-d')) && $value->is_trial == 1){
				$memberType = 'Paid';	
			}
			else
			{
				if($value->removead==1 && strtotime($value->removead_valid_upto)>=strtotime(date('Y-m-d'))){
					$memberType = 'Ad Free';
				}
				else
				{
					$memberType = 'Free';
				}
			}

			if(count($value->Profile))
			{
				$aboutMe = $value->Profile->about_me;
			}

			if($value->created_at)
			{
				$createDate = date('Y-m-d H:i:s',strtotime($value->created_at));
			}

			if($value->profile_pic)
			{
				$imagee = '<img class="img-circle" src="'.$value->profile_pic.'" alt="User Image" width="50px" height="50">';
			}
			else
			{
				$imagee = '<img class="img-circle" src="'.url('images/no_image.png').'" alt="User Image" width="50px" height="50">';
			}					
			$GLOBALS['data'][] = array($i,$imagee,preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $value->screen_name),$value->profile_id,$value->email,$memberType,$createDate,date('Y-m-d',strtotime($value->valid_upto)),$aboutMe,$status);
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
     * Created By: Lovepreet Singh
     * Created for: Genrates Csv File for unban users
     * created date:August 2017
     */
	public function genrateCsv()
	{
		$users = User::where(['status'=>1])->where('role',2);
		$order =  array('S.no','Name','User Id','Email','Member Type','Joined','Expired');
		$users = $users->get();
		$table = [];
		$i = 1;
		foreach($users as $user)
		{
			$table[$i]['s_no'] = $i;
			$table[$i]['screen_name'] = $user->screen_name;
			$table[$i]['profile_id'] = $user->profile_id;
			$table[$i]['email'] = $user->email;
			$joinDate = $valiDate = $memberType = '';
			if($user->member_type == 1 && strtotime($user->vaild_upto)>=strtotime(date('Y-m-d')) && $user->is_trial == 1){
				$memberType = 'Trial';
			}
			else if($user->member_type == 1 && strtotime($user->vaild_upto)>=strtotime(date('Y-m-d'))){
				$memberType = 'Paid';	
			}
			else
			{
					if($user->removead==1 && strtotime($user->removead_valid_upto)>=strtotime(date('Y-m-d'))){
						$memberType = 'Ad Free';
					}else{
						$memberType = 'Free';
					}
			}
			if($user->created_at)
			{
				$joinDate = date('Y-m-d H:i:s',strtotime($user->created_at));
			}
			else
			{
				$joinDate = '---';
			}
			if($user->valid_upto)
			{
				$valiDate = date('Y-m-d',strtotime($user->valid_upto));
			}
			else
			{
				$valiDate = '---';
			}
			$table[$i]['member_type'] = $memberType;
			$table[$i]['created_at'] = $joinDate;
			$table[$i]['expired'] = $valiDate;
			$i++;
		}
		$filename = "uploads/requests.csv";
		$handle = fopen($filename, 'w+');
		fputcsv($handle,$order);

		foreach($table as $row) 
		{
			fputcsv($handle, array($row['s_no'],$row['screen_name'],$row['profile_id'],$row['email'],$row['member_type'],$row['created_at'],$row['expired']));
		}
		fclose($handle);
		$headers = array('Content-Type' => 'text/csv');
		return Response::download($filename, 'requests.csv', $headers);
	}

	 /**
     * Created By: Lovepreet Singh
     * Created for: Function for fetch all banned users
     * created date:August 2017
     */
    public function getBanned()
    {
        try
		{
			$active= 'banned';
			 $users = User::where(['status'=>0])->get();
			return view('admin.users.banneduser', compact('users','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'banned'
            ];
			return view('errors.error', $result);
        }
    }

    /********
     * created by: Lovepreet Singh
     * Created for: Listing Banned user in datatable with filters using ajax 
     * 
     *********/
    public function postListAllBannedUsers(Request $request,CommonRepository $common)
	{
		 $basearray = User::with(['Profile'])->where(['status'=>0,'role'=>2]);
		  $totalusercount = DB::table('users')->where(['status'=>0,'role'=>2])->count();
		
		/*****************Below code is for filtering ****************/
		if(isset($request->name) && !empty($request->name))
		{
			
			$basearray->where('screen_name','LIKE','%'.$request->name.'%');
		}
		if(isset($request->email) && !empty($request->email))
		{
			
			$basearray->where('email','LIKE','%'.$request->email.'%');
		}
		if(isset($request->profile_id) && !empty($request->profile_id))
		{
			
			$basearray->where('profile_id','LIKE','%'.$request->profile_id.'%');
		}

		/*****************Below code is for Sorting ****************/
		
		$order = $request->get('order');
			
		if($order[0]['column'] == 2)
		{
			$basearray->orderBy('screen_name',$order[0]['dir']);
		}
		elseif($order[0]['column'] == 3)
		{
			$basearray->orderBy('profile_id',$order[0]['dir']);
		}
		else if($order[0]['column'] == 4)
		{
			$basearray->orderBy('email',$order[0]['dir']);
		}
		else if($order[0]['column'] == 5)
		{
			$basearray->orderBy('member_type',$order[0]['dir']);
		}
		else if($order[0]['column'] == 6)
		{
			$basearray->orderBy('created_at',$order[0]['dir']);
		}
		else if($order[0]['column'] == 7)
		{
			$basearray->orderBy('valid_upto',$order[0]['dir']);
		}
		else
		{
			$basearray->orderBy('id','desc');
		}			
			
		$counttotal =  User::where(['status'=>0,'role'=>2])->get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		$resultset = $basearray->skip($request->get('start'))->take($length)->get();
				
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
		$GLOBALS['total']=count($resultset);
				
		foreach($resultset as $value){
			$userId = \Crypt::encrypt($value->id);
			if($value->status== '0')
			{
				$status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$value->id.'" data-status="'.$value->status.'" data-action="Plans"><i class="fa fa-ban text-danger"></i><a></div>';
			}

			$aboutMe = $createDate=$memberType = '';
			if($value->member_type == 1 && strtotime($value->vaild_upto)>=strtotime(date('Y-m-d')) && $value->is_trial == 1){
				$memberType = 'Trial';
			}
			else if($value->member_type == 1 && strtotime($value->vaild_upto)>=strtotime(date('Y-m-d')) && $value->is_trial == 1){
				$memberType = 'Paid';	
			}
			else
			{
				if($value->removead==1 && strtotime($value->removead_valid_upto)>=strtotime(date('Y-m-d'))){
					$memberType = 'Ad Free';
				}
				else
				{
					$memberType = 'Free';
				}
			}

			if(count($value->Profile))
			{
				$aboutMe = $value->Profile->about_me;
			}			

			if($value->created_at)
			{
				$createDate = date('Y-m-d H:i:s',strtotime($value->created_at));
			}

			if($value->profile_pic)
			{
				$imagee = '<img class="img-circle" src="'.$value->profile_pic.'" alt="User Image" width="50px" height="50">';
			}
			else
			{
				$imagee = '<img class="img-circle" src="'.url('images/no_image.png').'" alt="User Image" width="50px" height="50">';
			}
			
			$GLOBALS['data'][] = array($i,$imagee,$value->screen_name,$value->profile_id,$value->email,$memberType,$createDate,date('Y-m-d',strtotime($value->valid_upto)),$aboutMe,$status);
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
     * Created By: Lovepreet Singh
     * Created for: Genrates Csv File for Ban users
     * created date:August 2017
     */
	public function genrateCsvBannedUser()
	{
		$users = User::where(['status'=>0])->where('role',2);
		$order =  array('S.no','Name','User Id','Email','Member Type','Joined','Expired');
		$users = $users->get();
		$table = [];
		$i = 1;
		foreach($users as $user)
		{
			$table[$i]['s_no'] = $i;
			$table[$i]['screen_name'] = $user->screen_name;
			$table[$i]['profile_id'] = $user->profile_id;
			$table[$i]['email'] = $user->email;
			$joinDate = $valiDate = $memberType = '';
			if($user->member_type == 1 && strtotime($user->vaild_upto)>=strtotime(date('Y-m-d')) && $user->is_trial == 1){
				$memberType = 'Trial';
			}
			else if($user->member_type == 1 && strtotime($user->vaild_upto)>=strtotime(date('Y-m-d'))){
				$memberType = 'Paid';	
			}
			else
			{
				if($user->removead==1 && strtotime($user->removead_valid_upto)>=strtotime(date('Y-m-d'))){
					$memberType = 'Ad Free';
				}
				else
				{
					$memberType = 'Free';
				}
			}
			if($user->created_at)
			{
				$joinDate = date('Y-m-d H:i:s',strtotime($user->created_at));
			}
			else
			{
				$joinDate = '---';
			}
			if($user->valid_upto)
			{
				$valiDate = date('Y-m-d',strtotime($user->valid_upto));
			}
			else
			{
				$valiDate = '---';
			}
			$table[$i]['member_type'] = $memberType;
			$table[$i]['created_at'] = $joinDate;
			$table[$i]['expired'] = $valiDate;
			$i++;
		}
		$filename = "uploads/requests.csv";
		$handle = fopen($filename, 'w+');
		fputcsv($handle,$order);

		foreach($table as $row) 
		{
			fputcsv($handle, array($row['s_no'],$row['screen_name'],$row['profile_id'],$row['email'],$row['member_type'],$row['created_at'],$row['expired']));
		}
		fclose($handle);
		$headers = array('Content-Type' => 'text/csv');
		return Response::download($filename, 'requests.csv', $headers);
	}

}
