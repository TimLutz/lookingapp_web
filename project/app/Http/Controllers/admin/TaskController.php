<?php

namespace App\Http\Controllers\admin;


use repositories\CommonRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;
use repositories\CommonRepositoryInterface;
use App\models\Task;
use App\models\Notificationlog;
use App\PropertyAttribute;
use App\User;
use App\models\Document;
use DB;
use Input;
use Mail;
use View;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Created By: Jagraj Singh
     * Created for: Index function for tasks
     * created date:November 2016
     */
    public function getIndex()
    {
        try
		{
			
			$active= 'tasks';
			$tasks = Task::where('id','!=','')->paginate(10);
			return view('admin.tasks.index', compact('tasks','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'tasks'
            ];
			return view('errors.error', $result);
        }
    }
    

    /********
     * created by: Jagraj Singh
     * Made for: Listing Realtors in datatable with filters using ajax 
     * 
     *********/
    public function postListTasks(Request $request,CommonRepository $common)
	{
		
	
		
		 $basearray = DB::table('tasks')->where('id','!=','');
		  $totalusercount = DB::table('tasks')->where('id','!=','')->count();
		
		
		
		/*****************Below code is for filtering ****************/
		if(isset($request->task_name) && !empty($request->task_name))
		{
			
			$basearray->where('task_name','LIKE','%'.$request->task_name.'%');
		}
		//filtering on the basis of user type realtor/houseowner
		if(isset($request->typeuser) && !empty($request->typeuser)){
			  $userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('client_id',$userstype);
		}
		
		//filtering on the basis of requestedby or clientname
		if(isset($request->requestedby) && !empty($request->requestedby)){
			  $usernamelist = User::where('name','LIKE','%'.$request->requestedby.'%')->lists('id')->toArray();
			  //$userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('client_id',$usernamelist);
		}
		
		//filtering on the basis of technician assigned
		if(isset($request->technicianassigned) && !empty($request->technicianassigned)){
			  $technicianlist = User::where('name','LIKE','%'.$request->technicianassigned.'%')->lists('id')->toArray();
			  //$userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('technician_id',$technicianlist);
		}
		
		if(isset($request->requested_at_from) && !empty($request->requested_at_from))
		{
			
			 $basearray->where('scheduled_date','>=',$request->requested_at_from);
		}
		if(isset($request->requested_at_to) && !empty($request->requested_at_to))
		{
			
			 $basearray->where('scheduled_date','<=',$request->requested_at_to); 
		}
		
		if(isset($request->status))
		{
			
			if($request->status == '1'){
				
				$basearray->where('status',1);
			}
			elseif($request->status == '2'){
				
				$basearray->where('status',2);
			}
			elseif($request->status == '3'){
				
				$basearray->where('status',3);
			}
				elseif($request->status == '4'){
				
				$basearray->where('status',4);
			}
			else{
				
			}
		}
		
		
		
		if(isset($request->priority))
		{
			
			if($request->priority == '1'){
				
				$basearray->where('priority',1);
			}
			elseif($request->priority == '2'){
				
				$basearray->where('priority',2);
			}
			elseif($request->priority == '3'){
				
				$basearray->where('priority',3);
			}
			else{
				
			}
			
		}
		
		
	
		/*****************Below code is for Sorting ****************/
		
		$order = $request->get('order');
		
			if($order[0]['column'] == 1 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('task_name','asc');
			}
			elseif($order[0]['column'] == 1 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('task_name','desc');
			}
			elseif($order[0]['column'] == 3 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('start_datetime','desc');
			}
			elseif($order[0]['column'] == 3 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('start_datetime','asc');
			}
			else{
				$basearray->orderBy('id','desc');
			}
			
		
	       	$counttotal =  Task::get()->count();
		    $length = intval($request->get('length'));
		    $length = $length < 0 ? $counttotal : $length; 
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
				foreach($resultset as $task){
					
					
									$userId = \Crypt::encrypt($task->id);
								
					
					
					$view_link = '<a class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail" href="tasks/show/'.$userId.'"><span class="icon-eye" style="color:blue;"></span></a><a data-id="'.$userId.'"  class="btn btn-circle btn-icon-only btn-default changestatus"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a> <a deleteLink="tasks/delete/'.$userId.'" class="btn btn-circle btn-icon-only btn-default" id="deletetask"><span style="color:brown" title="Delete" class="icon-trash" aria-hidden="true"></span></a><a data-id="'.$userId.'" class="btn btn-circle btn-icon-only btn-default assigntechnician"><span style="color:orange" title="Add Technician" class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>';
					
					if(isset($task->client_id) && !empty($task->client_id)){
						$client = User::where('id',$task->client_id)->first();
						if($client->type == 1){
							$typeclient = 'Realtor';
						}
						if($client->type == 2){
							$typeclient = 'Houseowner';
						}
						
					}
					
					if(isset($task->technician_id) && !empty($task->technician_id)){
						
						$techname = User::where('id',$task->technician_id)->pluck('name');
					}
					else
					{
						$techname = 'Not Assigned';
					}
				
					
					if(isset($task->priority) && !empty($task->priority)){
						switch($task->priority){
							case 1:
							$priority = 'High';
							break;
							case 2:
							$priority = 'Medium';
							break;
							case 3:
							$priority = 'Low';
							break;
							default:
							$priority = '';
						}
					}
					
					if(isset($task->status) && !empty($task->status)){
						
						switch($task->status){
							case 1:
							$status='Pending';
							
							break;
							case 2:
							$status='Declined';
							
							break;
							case 3:
							$status='Accepted';
							
							break;
							case 4:
							$status='Completed';
							
							break;
							default:
							$status='Pending';
							
						
					}
						
					}
					if(isset($task->attribute_id) && !empty($task->attribute_id)){
					$attrname = PropertyAttribute::where('id',$task->attribute_id)->pluck('attribute_name');
					}else{
						$attrname = '';
					}
					
					//$start = Carbon::parse($common->converttimezone($task->start_datetime));
					$start = Carbon::parse($task->start_datetime);
					//$end = Carbon::parse($common->converttimezone($task->end_datetime));
					$end = Carbon::parse($task->end_datetime);
					//####
					if($start->format('Y-m-d') == '-0001-11-30'){
					$startdate = 'NA';
					}
					else{
					$startdate = $start->format('Y-m-d');
					}
					//###
					if($start->format('H:i:s') == '00:00:00'){
					$starttime = 'NA';
					}
					else{
					$starttime = $start->format('H:i:s');
					}
					
					//###
					if($end->format('H:i:s') == '00:00:00'){
					$endtime = 'NA';
					}
					else{
					$endtime = $start->format('H:i:s');
					}
					
					$GLOBALS['data'][] = array($i,$task->task_name,$client->name,$startdate.' ('.$starttime.' - '.$endtime.')',$typeclient,$attrname,$techname,$priority,$status,$view_link);

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

 /**
     * Created By: Jagraj Singh
     * Created for: Detail page for a task
     * created date:November 2016
     */
    public function getShow($id)
    {
		
		 
			 $active = 'tasks';
		
		  
		 $taskid = \Crypt::decrypt($id);
		
           $detail = Task::where('id',$taskid)->with('task_documents')->first();
           $documents = Document::where('type_id',$taskid)->get();
        return view('admin.tasks.showtask', compact('detail','active','documents'));
    }


    /**
     * Created By: Jagraj Singh
     * Created for: for getting a task data to show in status popup
     * created date:November 2016
     */
    public function status(Request $request)
    {
         $id = \Crypt::decrypt($request->id);
          $task = Task::where('id',$id)->first();
          if(isset($task) && !empty($task)){
			  $response['status']= true;
			  $response['task']= $task;
			  
		  }
		  else{
			  $response['status'] = 'error';
		  }
		  return response()->json($response);
    }
    
    /**
     * Created By: Jagraj Singh
     * Created for: for getting technician drop down in popup
     * created date:November 2016
     */
    public function technicianAssigned(Request $request)
    {
          $id = \Crypt::decrypt($request->id);
          $task = Task::where('id',$id)->first();
          if(isset($task) && !empty($task)){
			  $data['status']= true;
			  $data['technician']= $task->technician_id;
			   $assigneddate= $task->scheduled_date;
			    $data['technicians']= User::where('type',3)->lists('name','id')->toArray();
			    
			    
			     $html = View::make('admin/tasks/techniciandropdown', $data);
				return response()->json(array('success' => 'true', 'message' => "$html",'assigned_date'=>$assigneddate,'task'=>$task));
		  }
		  else{
			  $response['status'] = 'error';
		  }
		
    }
    
    /**
     * Created By: Jagraj Singh
     * Created for: for updating task status
     * created date:November 2016
     */
    public function updatestatus(Request $request,CommonRepository $notification)
    {
		//return $request->all();die;
        //return $id = \Crypt::decrypt($request->tasktime);
        $taskid = $request->tasktime;
        $status = $request->status;
          $task = Task::find($taskid);
          
        if($task->status == 4){
			$response['status'] = 'taskcompleted';
			 return response()->json($response);
		}
          $task->status = $status;
          if($task->update()){
			  
			  $notify_type = User::where('id',$task->client_id)->pluck('notify_type');
			  if($notify_type == 0){
				  
			  if($request->status == '2'){
			  $message = '"'.$task->task_name.'" has been Declined by the Admin';
			  $title = '"'.$task->task_name.'" Task Declined';
			  $tasktype = 'Task Declined';
			  $taskstatus = 'Declined';
			  $taskname = $task->task_name;
		      $this->getNotify($task->client_id,$message,$title,$notification);
			  }
			  if($request->status == '3'){
			  $message = '"'.$task->task_name.'" has been Accepted by the Admin';
			  $title = '"'.$task->task_name.'" Task Accepted';
			  $tasktype = 'Task Accepted';
			  $taskstatus = 'Accepted';
			  $taskname = $task->task_name;
		      $this->getNotify($task->client_id,$message,$title,$notification);
			  }	
			  
			  //Code for saving notification log in database start
			   $notificationlog = new Notificationlog;
		       $notificationlog->task_id = $taskid;
		       $notificationlog->task_type = $taskstatus;
		       $notificationlog->title = $taskname;
		       $notificationlog->sent_to_id = $task->client_id;
		       $notificationlog->save();
		       //Code for saving notification log in database end
			   }
			   flash()->success('Status has been updated');
			  $response['status']= true;
			  
		  }
		  else{
			   flash()->error('Something went wrong');
			  $response['status'] = 'error';
		  }
		  return response()->json($response);
    }
    
    //function to send notification
		public function getNotify($user,$message,$title,$notification){
			$user_data['message'] = $message;
			$user_data['title'] = $title;       
			$user_data['user_ids'] = [$user];       
			return $notification->send_notification($user_data);
		}
    
    /**
     * Created By: Jagraj Singh
     * Created for: for updating technician
     * created date:November 2016
     */
    public function technicianupdate(Requests\UpdatetechRequest $request,CommonRepository $notification)
    {
		 $date= date("Y-m-d");
		//return $request->all();die;
         $id = \Crypt::decrypt($request->tasktime);
        $taskupdate = Task::where('id',$id)->first();
        if($taskupdate->status == 4){
			$response['status'] = 'taskcompleted';
			 return response()->json($response);
		}
         $userstatus =  User::find($taskupdate['client_id']);
        if($userstatus->status == 0){
			$response['status'] = 'inactiveuser';
			 return response()->json($response);
		}
		
        $taskupdate->technician_id = $request->technician;
        $taskupdate->assigned_date = $date;
        $taskupdate->priority = $request->priority;
         $taskupdate->note_detail = $request->note_detail;
         $taskupdate->start_datetime = $request->start_datetime;
         $taskupdate->end_datetime = $request->end_datetime;
          $taskupdate->scheduled_date = $request->start_datetime;
         $taskupdate->status = 3;
     
          if($taskupdate->update()){
			
			  $notify_type = User::where('id',$taskupdate->client_id)->pluck('notify_type');
			  if($notify_type == 0){
			  $message = 'Technician has been assigned to task "'.$taskupdate->task_name.'"';
			  $title = 'Technician Assigned to task "'.$taskupdate->task_name.'"';
			 
			  $taskname = $taskupdate->task_name;
		      $this->getNotify($taskupdate->client_id,$message,$title,$notification);
		      
		      
		      //Code for saving notification log in database start
			   $notificationlog = new Notificationlog;
		       $notificationlog->task_id = $id;
		       $notificationlog->task_type = 'Technician Assigned';
		       $notificationlog->title = $taskname;
		       $notificationlog->sent_to_id = $taskupdate->client_id;
		       $notificationlog->save();
		       //Code for saving notification log in database end
		      
			  }
			  
			  
			  
			  
			     flash()->success('Technician has been updated');
			  $response['status']= true;
			  
		  }
		  else{
			   flash()->error('Something went wrong');
			  $response['status'] = 'error';
		  }
		  return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
     * Created for: for deleting a task
     * created date:November 2016
     */
    public function getDelete($id,CommonRepository $notification)
    {
		  $taskid = \Crypt::decrypt($id);
		
			 $active = 'tasks';
		$task = Task::where('id',$taskid)->first();
		if($task->status != 2){
		if($task->technician_id != 0 && $task->technician_id != ''){
			if($task->status != 4){
		flash()->error('Cannot delete a task with assigned Technician');
		return redirect (getenv('adminurl').'/tasks');
			}
		}
	}
		if($task->status == 3){
		flash()->error('Cannot delete an accepted task');
		return redirect (getenv('adminurl').'/tasks');
		}
		
		$clientid = $task->client_id;
         $delete = Task::where('id',$taskid)->delete();
         
          $notify_type = User::where('id',$clientid)->pluck('notify_type');
			  if($notify_type == 0){
           $message = $task->task_name.' has been Deleted by the Admin';
		   $title = '"'.$task->task_name.'" Task Deleted';
		   $taskname = $task->task_name;
		   $this->getNotify($task->client_id,$message,$title,$notification);
		   
		   //Code for saving notification log in database start
			   $notificationlog = new Notificationlog;
		       $notificationlog->task_id = $taskid;
		       $notificationlog->task_type = 'Task Deleted';
		       $notificationlog->title = $taskname;
		       $notificationlog->sent_to_id = $task->client_id;
		       $notificationlog->save();
		       //Code for saving notification log in database end
	   }
         flash()->Success('The task has been deleted');
        return redirect (getenv('adminurl').'/tasks');
    }
    
     /**
     * Created By: Jagraj Singh
     * Created for: for deleting a technincian task
     * created date:November 2016
     */
    public function getDeletetechtask($id)
    {
		  $taskid = \Crypt::decrypt($id);
		
			 $active = 'tech-tasks';
			$task =  Task::where('id',$taskid)->first();
		if($task->status == 4){
			 $delete = Task::where('id',$taskid)->delete();
		}
		elseif($task->status == 3){
			flash()->error('Cannot delete an accepted task');
		}
		elseif($task->technician_id != 0 && $task->technician_id != ''){
			
		flash()->error('Cannot delete a task with assigned Technician');
		
		}
        
         
        return redirect (getenv('adminurl').'/tasks/index-techtask');
    }
    
    
    
    
     /**
     * Created By: Jagraj Singh
     * Created for: Index function for technian's tasks
     * created date:November 2016
     */
      public function getIndexTechtask()
    {
        try
		{
			
			$active= 'tech-tasks';
			$tasks = Task::where('id','!=','')->where('technician_id','!=','')->paginate(10);
			return view('admin.techtasks.index', compact('tasks','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'tech-tasks'
            ];
			return view('errors.error', $result);
        }
    }
    

    /********
     * created by: Jagraj Singh
     * Made for: Listing Technician Tasks in datatable with filters using ajax 
     * 
     *********/
    public function postListTechTasks(Request $request,CommonRepository $common)
	{
		
	
		
		 $basearray = DB::table('tasks')->where('id','!=','')->where('technician_id','!=','');
		  $totalusercount = DB::table('tasks')->where('id','!=','')->where('technician_id','!=','')->count();
		
		
		
		/*****************Below code is for filtering ****************/
	
	
	
			//filtering on the basis of user type realtor/houseowner
		if(isset($request->typeuser) && !empty($request->typeuser)){
			  $userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('client_id',$userstype);
		}
		
		//filtering on the basis of requestedby or clientname
		if(isset($request->requestedby) && !empty($request->requestedby)){
			  $usernamelist = User::where('name','LIKE','%'.$request->requestedby.'%')->lists('id')->toArray();
			  //$userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('client_id',$usernamelist);
		}
		
		//filtering on the basis of technician assigned
		if(isset($request->technicianassigned) && !empty($request->technicianassigned)){
			  $technicianlist = User::where('name','LIKE','%'.$request->technicianassigned.'%')->lists('id')->toArray();
			  //$userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('technician_id',$technicianlist);
		}
		
		if(isset($request->scheduled_at_from) && !empty($request->scheduled_at_from))
		{
			//return $request->scheduled_at_from;die;
			 $basearray->where('scheduled_date','>=',$request->scheduled_at_from);
		}
		if(isset($request->scheduled_at_to) && !empty($request->scheduled_at_to))
		{
			 //return $request->scheduled_at_to;die;
			 $basearray->where('scheduled_date','<=',$request->scheduled_at_to); 
		}
	
		
		if(isset($request->techassign_at_from) && !empty($request->techassign_at_from))
		{
			$basearray->where('assigned_date','>=',$request->techassign_at_from);
		}
		if(isset($request->techassign_at_to) && !empty($request->techassign_at_to))
		{
			$basearray->where('assigned_date','<=',$request->techassign_at_to);
		}
	
	
	
		if(isset($request->status))
		{
			
			if($request->status == '1'){
				
				$basearray->where('status',1);
			}
			elseif($request->status == '2'){
				
				$basearray->where('status',2);
			}
			elseif($request->status == '3'){
				
				$basearray->where('status',3);
			}
				elseif($request->status == '4'){
				
				$basearray->where('status',4);
			}
			else{
				
			}
		}
		
		
		
		if(isset($request->priority))
		{
			
			if($request->priority == '1'){
				
				$basearray->where('priority',1);
			}
			elseif($request->priority == '2'){
				
				$basearray->where('priority',2);
			}
			elseif($request->priority == '3'){
				
				$basearray->where('priority',3);
			}
			else{
				
			}
			
		}
		/*****************Below code is for Sorting ****************/
		
		$order = $request->get('order');
			if($order[0]['column'] == 2 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('assigned_date','asc');
			}
			elseif($order[0]['column'] == 2 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('assigned_date','desc');
			}
			elseif($order[0]['column'] == 3 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('scheduled_date','asc');
			}
			elseif($order[0]['column'] == 3 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('scheduled_date','desc');
			}
			else{
				$basearray->orderBy('id','desc');
			}
			
			
			
			
			
			
			
			
			
			
		$counttotal =  Task::where('technician_id','!=','')->get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
				foreach($resultset as $task){
					
					
									$userId = \Crypt::encrypt($task->id);
								
					
					
					$view_link = '<a class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail" href="show-tech/'.$userId.'"><span class="icon-eye" style="color:blue;"></span></a> <a deleteLink="deletetechtask/'.$userId.'" class="btn btn-circle btn-icon-only btn-default" id="deletetask"><span style="color:brown" title="Delete" class="icon-trash" aria-hidden="true"></span></a>';
					
					if(isset($task->client_id) && !empty($task->client_id)){
						$client = User::where('id',$task->client_id)->first();
						if($client->type == 1){
							$typeclient = 'Realtor';
						}
						if($client->type ==2){
							$typeclient = 'Houseowner';
						}
						
					}
					
					if(isset($task->technician_id) && !empty($task->technician_id)){
						
						$techname = User::where('id',$task->technician_id)->pluck('name');
					}
					else
					{
						$techname = 'Not Assigned';
					}
				
					
					if(isset($task->priority) && !empty($task->priority)){
						switch($task->priority){
							case 1:
							$priority = 'High';
							break;
							case 2:
							$priority = 'Medium';
							break;
							case 3:
							$priority = 'Low';
							break;
							default:
							$priority = '';
						}
					}
					else{
						$priority = '';
					}
					
					if(isset($task->status) && !empty($task->status)){
						
						switch($task->status){
							case 1:
							$status='Pending';
							
							break;
							case 2:
							$status='Declined';
							
							break;
							case 3:
							$status='Accepted';
							
							break;
							case 4:
							$status='Completed';
							
							break;
							default:
							$status='Pending';
							
						
					}
						
					}
					if(isset($task->attribute_id) && !empty($task->attribute_id)){
					$attrname = PropertyAttribute::where('id',$task->attribute_id)->pluck('attribute_name');
					}else{
						$attrname = '';
					}
					
					$GLOBALS['data'][] = array($i,$techname,$task->assigned_date,$task->scheduled_date,$client->name,$typeclient,$attrname,$priority,$status,$view_link);

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
     * Created for: detail page for technician's task
     * created date:November 2016
     */
    public function getShowTech($id)
    {
		
		 
			 $active= 'tech-tasks';
		
		  
		 $taskid = \Crypt::decrypt($id);
		
         $detail = Task::where('id',$taskid)->first();
        return view('admin.techtasks.showtask', compact('detail','active'));
    }
    
    
    
    
    
     /**
     * Created By: Jagraj Singh
     * Created for: Index function for feedback
     * created date:November 2016
     */
      public function getIndexFeedback()
    {
        try
		{
			
			$active= 'client-feedback';
			$tasks = Task::where('id','!=','')->where('status','=','4')->paginate(10);
			return view('admin.feedback.index', compact('tasks','active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'client-feedback'
            ];
			return view('errors.error', $result);
        }
    }
    
    
    
    
     /********
     * created by: Jagraj Singh
     * Made for: Listing Client feedback in datatable with filters using ajax 
     * 
     *********/
    public function postListFeedback(Request $request,CommonRepository $common)
	{
		
	
		
		 $basearray = DB::table('tasks')->where('id','!=','')->where('status','=','4')->orderBy('id','desc');
		  $totalusercount = DB::table('tasks')->where('id','!=','')->where('status','=','4')->count();
		
		
		
		/*****************Below code is for filtering ****************/
		
			//filtering on the basis of user type realtor/houseowner
		if(isset($request->client_type) && !empty($request->client_type)){
			  $userstype = User::where('type',$request->client_type)->lists('id')->toArray();
				$basearray->whereIn('client_id',$userstype);
		}
		
		if(isset($request->techassign_at_from) && !empty($request->techassign_at_from))
		{
			$basearray->where('task_completed_date','>=',$request->techassign_at_from);
		}
		if(isset($request->techassign_at_to) && !empty($request->techassign_at_to))
		{
			$basearray->where('task_completed_date','<=',$request->techassign_at_to); 
		}
	
		if(isset($request->rating))
		{
			
			if($request->rating == '1'){
				
				$basearray->where('rating',1);
			}
			elseif($request->rating == '2'){
				
				$basearray->where('rating',2);
			}
			elseif($request->rating == '3'){
				
				$basearray->where('rating',3);
			}
			elseif($request->rating == '4'){
				
				$basearray->where('rating',4);
			}
			elseif($request->rating == '5'){
				
				$basearray->where('rating',5);
			}
			
			if($request->rating == '1.5'){
				
				$basearray->where('rating',1.5);
			}
			elseif($request->rating == '2.5'){
				
				$basearray->where('rating',2.5);
			}
			elseif($request->rating == '3.5'){
				
				$basearray->where('rating',3.5);
			}
			elseif($request->rating == '4.5'){
				
				$basearray->where('rating',4.5);
			}
			elseif($request->rating == '5.5'){
				
				$basearray->where('rating',5.5);
			}
			else{
				
			}
			
			
			
		}
		/*****************Below code is for Sorting ****************/
		$basearray->orderBy('id','desc');
		$order = $request->get('order');
			if($order[0]['column'] == 5 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('task_completed_date','asc');
			}
			if($order[0]['column'] == 5 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('task_completed_date','desc');
			}
			
		$counttotal =  Task::where('technician_id','!=','')->get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
				foreach($resultset as $task){
					
					
									$userId = \Crypt::encrypt($task->id);
								
					
					
					$view_link = '<a class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail" href="show-feedback/'.$userId.'"><span class="icon-eye" style="color:blue;"></span></a>';
					
					if(isset($task->client_id) && !empty($task->client_id)){
						 $client = User::where('id',$task->client_id)->first();
						if($client['type'] == 1){
							$typeclient = 'Realtor';
						}
						elseif($client['type'] ==2){
							$typeclient = 'Houseowner';
						}
						
					}
					else{
						$typeclient = '';
					}
					
					if(isset($task->comments) && !empty($task->comments)){
						$commentcount = strlen($task->comments);
						
						if($commentcount > 30){
							$comment = substr($task->comments, 0, 30).'...';
						}
						else{
							$comment = substr($task->comments, 0, 30);
						}
						
					}
					else{
						$comment = '';
					}
				
				
					if(isset($task->rating) && !empty($task->rating)){
					$ratingtopass = $task->rating;
						
						 $rating = '<input type="hidden" class="myrating rating-loading" value="'.$ratingtopass.'" data-readonly="true">';
							//$rating = $ratingtopass;
					}
					else{
						$rating = 'Not Assigned';
					}
					if(isset($task->task_completed_date) && !empty($task->task_completed_date)){
						$completed_date = Carbon::parse($task->task_completed_date);
					}
					else{
						$completed_date = '';
					}
					
					
					$GLOBALS['data'][] = array($i,$client->name,$typeclient,$rating,$comment,$completed_date->format('Y-m-d'),$view_link);

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
     * Created for: detail page for feedback
     * created date:November 2016
     */
    public function getShowFeedback($id)
    {
		
		 
				$active= 'client-feedback';
		  
		 $taskid = \Crypt::decrypt($id);
		
         $detail = Task::where('id',$taskid)->first();
        return view('admin.feedback.showtask', compact('detail','active'));
    }
    
}
