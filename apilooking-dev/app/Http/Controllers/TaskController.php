<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Models\EmailTemplate;
use App\Models\Document;
use App\Models\PropertyAttribute;
use App\Models\Task;
use App\Models\Notificationadmin;
use App\Models\Cronejob;
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
use Image;
use Carbon\Carbon;

use Illuminate\Support\Facades\Lang;

class TaskController extends Controller {
	
	protected $hashKey;
	
	public function __construct(){
      $this->middleware('jwt.auth', ['except' => ['postLogin']]);
    }
    
    /*********** 
	* created By:Jagraj Singh
	* create date: 10-11-2016
	* Purpose: For fetching all the properties associated with property and attribute
	* 
	* ********/
	public function todolist(Request $request){
		
		
		$validator = Validator::make( $request->all()  ,      [
		
           'property_id' => 'required|numeric',
			'attribute_id' => 'required|numeric',
			'start' => 'required|numeric',
			'end' => 'required|numeric',
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
		
		
		  $prop_id = $request->property_id;
		 $attr_id = $request->attribute_id;
		 $user_id = JWTAuth::parseToken()->authenticate()->id;
		$properties = Property::where('id',$prop_id)->where('user_id',$user_id)->first();
		if($properties){
			    $end = $request->Input('end');
				$start = $request->Input('start');
				
			$tasks = Task::where('property_id',$prop_id)->where('client_id',$user_id)->where('attribute_id',$attr_id)->orderBy('id','desc')->take($end)->skip($start)->with('task_documents')->get();
			if($tasks){
			$response['status']=1;
			$response['message']='Success';
			$response['tasks'] = $tasks;
		}else{
			$response['status']=0;
			$response['message']='No Data found';
		}
			
		}else{
			$response['message']='you are not authorized';
			$response['status']=0;
		}
		
	}
	return response()->json($response);
}

/*********** 
	* created By:Jagraj Singh
	* create date: 10-11-2016
	* Purpose: For Creating new task
	* 
	* ********/
public function taskcreate(Request $request){
	
	
	if($request->has('document')){
	$validator = Validator::make( $request->all(),[
			'task_name'=> 'required',
			'priority' => 'numeric',
			'property_id' => 'numeric',
			'attribute_id' => 'numeric',
			//'start_datetime' => 'required',
			//'end_datetime' => 'required',
			'document'=> 'document|doctypenumber'
			
		]);
	}else{
		$validator = Validator::make( $request->all(),[
			'task_name'=> 'required',
			'priority' => 'numeric',
			'property_id' => 'numeric',
			'attribute_id' => 'numeric',
			//'start_datetime' => 'required',
			//'end_datetime' => 'required',
		]);
		
	}
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
			$data = $request->all();
			$data['client_id'] = $client_id;
			$data['status'] = 1;
			$data['scheduled_date'] = $request->Input('start_datetime');
			$task = Task::create($data);
			
			if(isset($request->document)){
				foreach($request->document as $doc){
					$doc['type_id']= $task->id;
					$doc = Document::create($doc);
					}
			}
			
			
			$task_name = $request->Input('task_name');
			$user_data = User::where('id',$client_id)->first();
			$username = $user_data->name;
			$useremail = $user_data->email;
			if($user_data->type == '1'){
				$usertype = 'Realtor';
			}
			elseif($user_data->type == '2'){
				$usertype = 'Houseowner';
			}
			
			if($request->Input('priority') == '1'){
				$priority = 'High';
			}
			elseif($request->Input('priority') == '2'){
				$priority = 'Medium';
			}
			elseif($request->Input('priority') == '3'){
				$priority = 'Low';
			}
			
			//code for admin notifications start here
			$notification = new Notificationadmin;
			$notification->from_id = $client_id;
			$notification->type = 'task_requested';
			$notification->content = $username.' requested task '.$task_name;
			$notification->status = 1;
			$notification->save();
			//code for admin notifications end here
			
			
			$response['status'] = 1;
			$response['message'] = "success";
			$response['task'] = Task::where('id',$task->id)->with('task_documents')->get();
			
			/******* Saving data for crone job Code start******/
			$crone = new Cronejob;
			$crone->type = 'task';
			$crone->status = 'created';
			$crone->description = $response['task']->toJson();
			$crone->save();
			/******* Saving data for crone job Code end******/
		}
	return response()->json($response);
}




/*********** 
	* created By:Jagraj Singh
	* create date: 11-11-2016
	* Purpose: For Creating new task
	* 
	* ********/
public function taskupdate(Request $request){
	
	
	
	if($request->has('document')){
	$validator = Validator::make( $request->all(),[
			'task_id' => 'required',
			'task_name'=> 'required',
			'priority' => 'numeric',
			'property_id' => 'numeric',
			'attribute_id' => 'numeric',
			//'start_datetime' => 'required',
			//'end_datetime' => 'required',
			'document'=> 'document|doctypenumber'
			
		]);
	}else{
		$validator = Validator::make( $request->all(),[
			'task_id' => 'required',
			'task_name'=> 'required',
			'priority' => 'numeric',
			'property_id' => 'numeric',
			'attribute_id' => 'numeric',
			//'start_datetime' => 'required',
			//'end_datetime' => 'required',
		]);
		
	}
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
			$data = $request->all();
			
			//$data['status'] = 1;
			$data['scheduled_date'] = $request->Input('start_datetime');
			$task = Task::find($request->Input('task_id'));
			
			 // if less than 24 hours left for task start_datetime then task cannot be deleted/rescheduled
			 $currentdate = date('Y-m-d H:i:s');
			 $currenttime = strtotime($currentdate);
			 $tasktime = strtotime($task->start_datetime);
			  $datediff = $currenttime - $tasktime;
			if($datediff < 86400 && $datediff > -86400){
				$response['message'] 	= 'Cannot change task information because less than 24 Hours left for execution';
				$response['status']		= 0;
				return response()->json($response);
			}
			
			
			
			 $task_id = $task->id;
			// for checking the authorized user
			if($client_id != $task->client_id){
				$response['Message'] 	= 'You are not authorized to do the changes';
				$response['status']		= 0;
				return response()->json($response);
			}
			
			$data['client_id'] = $client_id;
			$data['status'] = 1;
			$data['technician_id'] = 0;
			$task->update($data);
			
			if(isset($request->document) && !empty($request->document)){
				foreach($request->document as $doc){
					$filenamearray[] = $doc['filename'];
					$doc = Document::updateOrCreate(['type_id' => $task_id,'type' => $doc['type'],'filename' => $doc['filename']]);
					}
					   Document::where('type_id',$task_id)->whereNotIn('filename',$filenamearray)->delete();
			}
			else{
				 Document::where('type_id',$task_id)->delete();
			}
			$response['status'] = 1;
			$response['message'] = "success";
			$response['task'] = Task::where('id',$task->id)->with('task_documents')->get();
		}
		
		
	return response()->json($response);
}











/*********** 
	* created By:Jagraj Singh
	* create date: 10-11-2016
	* Purpose: For uploading a file
	* 
	* ********/
	public function Uploadfile(Request $request)
	{
		//return getenv('FRONTLINE_URL');DIE;
		$file = Input::file('doc_up');
		
		$timecurrent = time();
		$extension = $file->getClientOriginalExtension(); // getting file extension
		$allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
		$ext=Input::file('doc_up')->getMimeType(); 
		if(in_array($ext,$allowedMimeTypes))
		{
			$filenamethumb = 'thumb_'.$timecurrent. '.' . $extension; // renameing file
		$destinationPaththumb = env('FRONTLINE_URL').'uploads/userfiles/'.$filenamethumb; // upload path
		 $imagethumb = Image::make($file->getRealPath())->resize(300, 200)->save($destinationPaththumb);
		$response['thumb'] = $destinationPaththumb;
		}
			
		
				if(!empty($file)){
					$destinationPath = env('FRONTLINE_URL').'uploads/userfiles'; // upload path
					//$extension = $file->getClientOriginalExtension(); // getting file extension
					//$timecurrent = time();
					$fileName = 'userfile_'.$timecurrent. '.' . $extension; // renameing file
					//$filenamethumb = 'thumb_'.$timecurrent. '.' . $extension; // renameing file
					$path = $destinationPath . '/' . $fileName;
					$file->move($destinationPath, $fileName);
					
					
					$pathtosave = $destinationPath.'/'.$fileName;
					
					if($pathtosave)
					{
					$response['file_path'] 	= $pathtosave;
					$response['message'] 	= 'Success.';
           			$response['status']		= 1;
           			
					}
					else{
						$response['errors'] 	= 'Something went wrong.';
						$response['status']		= 0;
					}
	        	
				}	
				else{
					$response['errors'] 	= 'File Not found';
						$response['status']		= 0;
				}
	return response()->json($response);

	}
	
	/*********** 
	* created By:Jagraj Singh
	* create date: 11-11-2016
	* Purpose: for marking a task as completed
	* 
	* ********/
public function taskcomplete(Request $request){
	//return $request->all();die;
	$validator = Validator::make( $request->all(),[
			'task_id' => 'required',
			'rating' => 'required'
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
		
			 $task = Task::find($request->Input('task_id'));
			
			// for checking the authorized user
			if($client_id != $task->client_id){
				$response['message'] 	= 'You are not authorized to do the changes';
				$response['status']		= 0;
				return response()->json($response);
			}
			 $currentdate = date("Y-m-d H:i:s");
			$task->task_completed_date = $currentdate;
			$task->status = 4;
			if(isset($request['rating']) && !empty($request['rating'])){
				$task->rating = $request->rating;
			}
			if(isset($request['comments']) && !empty($request['comments'])){
				$task->comments = $request->comments;
			}
			
			
			
			if($task->update()){
				//code for sending mail to Admin Start here
				//~ $task_name = $task->task_name;
				//~ $user_data = User::where('id',$task->client_id)->first();
				//~ $username = $user_data->name;
				//~ $useremail = $user_data->email;
				//~ 
//~ 
				//~ $propertydata = Property::where('id',$task->property_id)->first();
				//~ $propertyname = $propertydata->property_name;
				//~ $propattr = PropertyAttribute::where('id',$task->attribute_id)->first();
				//~ $attrname = $propattr->attribute_name;
				//~ $rating = $request->Input('rating');
//~ 
				//~ $admin = User::where('role',1)->first();
				//~ $adminemail = $admin->email;
				//~ 
				//~ $template=EmailTemplate::find(45);
				//~ $find=array('@taskname@','@client@','@email@','@property@','@attribute@','@completeddate@','@company@','@rating@');
				//~ $values=array($task_name,$username,$useremail,$propertyname,$attrname,$currentdate,env('SITENAME'),$rating);
				//~ $body=str_replace($find,$values,$template->content);
//~ 
				//~ //Send Mail
				//~ Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				//~ {
				//~ $m->to($adminemail)
				//~ ->subject($template->subject);
				//~ });
				//code for sending mail to Admin End here
				
			
			
				$task_name = $task->task_name;
				$user_data = User::where('id',$task->client_id)->first();
				$username = $user_data->name;
				$useremail = $user_data->email;
			//code for admin notifications start here
			$notification = new Notificationadmin;
			$notification->from_id = $client_id;
			$notification->type = 'task_completed';
			$notification->content = $username.' completed task '.$task_name;
			$notification->status = 1;
			$notification->save();
			//code for admin notifications end here
				
				
			$response['status'] = 1;
			$response['message'] = "success";
			$response['task'] = Task::where('id',$task->id)->with('task_documents')->get();
			
			/******* Saving data for crone job Code start******/
			$crone = new Cronejob;
			$crone->type = 'task';
			$crone->status = 'completed';
			$crone->description = $response['task']->toJson();
			$crone->save();
			/******* Saving data for crone job Code end******/
			
		}
		}
	return response()->json($response);
}

/*********** 
	* created By:Jagraj Singh
	* create date: 11-11-2016
	* Purpose: for deleting a task
	* 
	* ********/
	public function taskdelete(Request $request){
		
		
	$validator = Validator::make( $request->all(),[
			'task_id' => 'required',
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
		
			 $task = Task::find($request->Input('task_id'));
			 
			 // if less than 24 hours left for task start_datetime then task cannot be deleted/rescheduled
			 $currentdate = date('Y-m-d H:i:s');
			 $currenttime = strtotime($currentdate);
			 $tasktime = strtotime($task->start_datetime);
			  $datediff = $currenttime - $tasktime;
			if($datediff < 86400 && $datediff > -86400){
				$response['message'] 	= 'Task cannot be deleted because less than 24 hours left for execution';
				$response['status']		= 0;
				return response()->json($response);
			}
			 
			 
			 
			if(isset($task) && !empty($task)){
			// for checking the authorized user
			if($client_id != $task->client_id){
				$response['Message'] 	= 'You are not authorized to do the changes';
				$response['status']		= 0;
				return response()->json($response);
			}
			 
			Document::where('type_id',$task->id)->delete();
			
			//code for sending mail to Admin Start here
				$task_name = $task->task_name;
				$user_data = User::where('id',$task->client_id)->first();
				$username = $user_data->name;
				$useremail = $user_data->email;
				
			//code for admin notifications start here
			$notification = new Notificationadmin;
			$notification->from_id = $client_id;
			$notification->type = 'task_deleted';
			$notification->content = $username.' deleted task '.$task_name;
			$notification->status = 1;
			$notification->save();
			//code for admin notifications end here
				
				
			if($task->delete()){
				/******* Saving data for crone job Code start******/
			$crone = new Cronejob;
			$crone->type = 'task';
			$crone->status = 'deleted';
			$crone->description = $task->toJson();
			$crone->save();
			/******* Saving data for crone job Code end******/
				
			$response['status'] = 1;
			$response['message'] = "Task Deleted";
		}
	}else{
		$response['status'] = 0;
			$response['message'] = "Task does not exist";
	}
		}
	return response()->json($response);
}
	
	
	
	
	
	
	
	
	
	
	
	/*********** 
	* created By:Jagraj Singh
	* create date: 11-11-2016
	* Purpose: For reschdule a task
	* 
	* ********/
public function taskreschedule(Request $request){
	
	$validator = Validator::make( $request->all(),[
			'task_id' => 'required',
			'start_datetime' => 'required',
			'end_datetime' => 'required',
			
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
			$data = $request->all();
			
			//$data['status'] = 1;
			
			$task = Task::find($request->Input('task_id'));
			
			 // if less than 24 hours left for task start_datetime then task cannot be deleted/rescheduled
			 $currentdate = date('Y-m-d H:i:s');
			 $currenttime = strtotime($currentdate);
			 $tasktime = strtotime($task->start_datetime);
			  $datediff = $currenttime - $tasktime;
			if($datediff < 86400 && $datediff > -86400){
				$response['message'] 	= 'Task cannot be rescheduled because less than 24 Hours left for execution';
				$response['status']		= 0;
				return response()->json($response);
			}
			
			// for checking the authorized user
			if($client_id != $task->client_id){
				$response['Message'] 	= 'You are not authorized to do the changes';
				$response['status']		= 0;
				return response()->json($response);
			}
			
			$task->scheduled_date =  $request->Input('start_datetime');
			$task->start_datetime =  $request->Input('start_datetime');
			$task->end_datetime =  $request->Input('end_datetime');
			$task->status =  1;
			
			if($task->update()){
			$response['status'] = 1;
			$response['message'] = "Task has been Rescheduled";
			$response['task'] = Task::where('id',$task->id)->with('task_documents')->get();
			
			
			
			$task_name = $task->task_name;
			$user_data = User::where('id',$task->client_id)->first();
			$username = $user_data->name;
			$useremail = $user_data->email;
			//code for admin notifications start here
			$notification = new Notificationadmin;
			$notification->from_id = $client_id;
			$notification->type = 'task_rescheduled';
			$notification->content = $username.' rescheduled task '.$task_name;
			$notification->status = 1;
			$notification->save();
			//code for admin notifications end here
			
			
			/******* Saving data for crone job Code start******/
			$crone = new Cronejob;
			$crone->type = 'task';
			$crone->status = 'rescheduled';
			$crone->description = $response['task']->toJson();
			$crone->save();
			/******* Saving data for crone job Code end******/
			}
			
		}
	return response()->json($response);
}
	
	
	
	
/*********** 
	* created By:Jagraj Singh
	* create date: 06-12-2016
	* Purpose: getting all tasks data
	* 
	* ********/
public function alltasks(Request $request){
	
	$validator = Validator::make( $request->all(),[
			'start' => 'required|numeric',
			'end' => 'required|numeric',
			
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
				$client_id = JWTAuth::parseToken()->authenticate()->id;
				$response['status']		= 1;
				$end = $request->Input('end');
				$start = $request->Input('start');
				$response['tasks'] = Task::where('client_id',$client_id)->orderBy('id','desc')->take($end)->skip($start)->get();
		}
			return response()->json($response);
}
	/*********** 
	* created By:Jagraj Singh
	* create date: 06-12-2016
	* Purpose: getting one particular task
	* 
	* ********/
public function particulartask(Request $request){
	$validator = Validator::make( $request->all(),[
			'task_id' => 'required',
			
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
		
			$taskid = $request->Input('task_id');
				$taskcheck = Task::where('id',$taskid)->where('client_id',$client_id)->first();
				if(isset($taskcheck) && !empty($taskcheck)){
					 if($taskcheck->technician_id != 0){
					  $technicianname = User::where('id',$taskcheck->technician_id)->pluck('name');
				 }
				 else{
					 $technicianname = '';
				 }
				
						$response['status']		= 1;
					 $response['task'] = Task::where('id',$taskid)->with('task_documents')->first();
					$response['task']['technician_name'] = $technicianname;
				}
				else{
					$response['status']		= 0;
					$response['message'] = 'Task does not exist';
				}
					
			
			}
			return response()->json($response);
}
	
	/*********** 
	* created By:Jagraj Singh
	* create date: 06-12-2016
	* Purpose: get task as per its current status.for eg. only comleted tasks, etc.
	* ********/
public function taskparstatus(Request $request){
	$validator = Validator::make( $request->all(),[
			'task_status' => 'required',
			'start' => 'required|numeric',
			'end' => 'required|numeric',
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
		
			$status = $request->Input('task_status');
				$response['status']		= 1;
				$end = $request->Input('end');
				$start = $request->Input('start');
		    $response['task'] = Task::where('client_id',$client_id)->orderBy('id','desc')->take($end)->skip($start)->where('status',$status)->get();
				
			
			}
			return response()->json($response);
}
	
	
	/*********** 
	* created By:Lovepreet Singh
	* create date: 06-03-2017
	* Purpose: get task for rejected, completed and expired. etc.
	* ********/
public function taskhistory(Request $request){
	$validator = Validator::make( $request->all(),[
			'start' => 'required|numeric',
			'end' => 'required|numeric',
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
			$now = Carbon::now();
			$response['status']		= 1;
			$end = $request->Input('end');
			$start = $request->Input('start');
		    $response['task'] = Task::where('client_id',$client_id)->whereIn('status',[2,4,1])->where('end_datetime','<',$now)->take($end)->skip($start)->get();
				
			
			}
			return response()->json($response);
	}
	
	
}
