<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Generalnote;
use App\Models\EmailTemplate;
use App\Models\Cronejob;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Repositary\Repositary;
use Illuminate\Support\Str;
use App\Models\Notificationadmin;
use DateTime;
use DB;
use Hash;
use Auth;
use Mail;
use Image;

use Illuminate\Support\Facades\Lang;

class NotesController extends Controller {
	
	protected $hashKey;
	
	public function __construct(){
      $this->middleware('jwt.auth', ['except' => ['postLogin']]);
    }
    
    /*********** 
	* created By:Jagraj Singh
	* create date: 07-12-2016
	* Purpose: For fetching all the General notes
	* 
	* ********/
	public function generalnotes(Request $request){
		
		$validator = Validator::make( $request->all(),[
			'start' => 'required|numeric',
			'end' => 'required|numeric',
			
		]);
	
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }
        else{
		$user_id = JWTAuth::parseToken()->authenticate()->id;
		$response['status'] = 1;
		$end = $request->Input('end');
		$start = $request->Input('start');
		$response['allnotes'] = Generalnote::where('user_id',$user_id)->orderBy('id','desc')->take($end)->skip($start)->get();
		}
		return response()->json($response);
}

/*********** 
	* created By:Jagraj Singh
	* create date: 07-12-2016
	* Purpose: For Creating new note
	* 
	* ********/
public function notecreate(Request $request){
	
	
	
	$validator = Validator::make( $request->all(),[
			'client_notes'=> 'required',
			'title'=> 'required',
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
			$data = $request->all();
			$data['user_id'] = $client_id;
			$data['client_notes'] = $request->Input('client_notes');
			$data['title'] = $request->Input('title');
			$note = Generalnote::create($data);
			
			if($note){
				
				//Sending mail to Admin after creating Note start here
				
				//~ $user_data = User::where('id',$client_id)->first();
				//~ $username = $user_data->name;
				//~ $title = $request->Input('title');
				//~ $description = $request->Input('client_notes');
				//~ 
				//~ $admin = User::where('role',1)->first();
				//~ $adminemail = $admin->email;
				//~ 
				//~ $template=EmailTemplate::find(47);
				//~ $find=array('@otheruseone@','@title@','@description@','@company@');
				//~ $values=array($username,$title,$description,env('SITENAME'));
				//~ $body=str_replace($find,$values,$template->content);
//~ 
				//~ //Send Mail
				//~ Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				//~ {
				//~ $m->to($adminemail)
				//~ ->subject($template->subject);
				//~ });

				//Sending mail to Admin after creating Note end here
				
				
			$response['status'] = 1;
			$response['message'] = "success";
			$response['notes'] = Generalnote::where('id',$note->id)->orderBy('id','desc')->get();
			
			/******* Saving data for crone job Code start******/
			$crone = new Cronejob;
			$crone->type = 'note';
			$crone->status = 'created';
			$crone->description = $response['notes']->toJson();
			$crone->save();
			/******* Saving data for crone job Code end******/
			}
			
			
			$user_data = User::where('id',$client_id)->first();
			$username = $user_data->name;
			
			//code for admin notifications start here
			$notification = new Notificationadmin;
			$notification->from_id = $client_id;
			$notification->type = 'note_created';
			$notification->content = $username.' created a note';
			$notification->status = 1;
			$notification->save();
			//code for admin notifications end here
		}
	return response()->json($response);
}




/*********** 
	* created By:Jagraj Singh
	* create date: 07-12-2016
	* Purpose: For updating note
	* 
	* ********/
public function noteupdate(Request $request){
	
	
	$validator = Validator::make( $request->all(),[
			'note_id' => 'required|numeric'
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
			$data = $request->all();
			
			
			$note = Generalnote::find($request->Input('note_id'));
			if(!empty($note)){
				 $note_id = $note->id;
			// for checking the authorized user
			if($client_id != $note->user_id){
				$response['Message'] 	= 'You are not authorized to do the changes';
				$response['status']		= 0;
				return response()->json($response);
			}
			
			$data['user_id'] = $client_id;
			
			if($note->update($data)){
				
				//Sending mail to Admin after updating Note start here
				
				//~ $user_data = User::where('id',$client_id)->first();
				//~ $username = $user_data->name;
				//~ $title = $note->title;
				//~ $description = $note->client_notes;
				//~ 
				//~ $admin = User::where('role',1)->first();
				//~ $adminemail = $admin->email;
				//~ 
				//~ $template=EmailTemplate::find(48);
				//~ $find=array('@otheruse@','@title@','@description@','@company@');
				//~ $values=array($username,$title,$description,env('SITENAME'));
				//~ $body=str_replace($find,$values,$template->content);
//~ 
				//~ //Send Mail
				//~ Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				//~ {
				//~ $m->to($adminemail)
				//~ ->subject($template->subject);
				//~ });

				//Sending mail to Admin after updating Note end here
				
				
				
				
				
			$response['status'] = 1;
			$response['message'] = "success";
			$response['notes'] = Generalnote::where('id',$note->id)->orderBy('id','desc')->get();
			
			$user_data = User::where('id',$client_id)->first();
				$username = $user_data->name;
				$title = $note->title;
			
			//code for admin notifications start here
			$notification = new Notificationadmin;
			$notification->from_id = $client_id;
			$notification->type = 'note_updated';
			$notification->content = $username.' edited note '.$title;
			$notification->status = 1;
			$notification->save();
			//code for admin notifications end here
			
			/******* Saving data for crone job Code start******/
			$crone = new Cronejob;
			$crone->type = 'note';
			$crone->status = 'updated';
			$crone->description = $response['notes']->toJson();
			$crone->save();
			/******* Saving data for crone job Code end******/
			}
			}
			else{
					$response['status']		= 0;
					$response['message'] = "Note with this note id does not exist";
			}
			
		}
	return response()->json($response);
}





/*********** 
	* created By:Jagraj Singh
	* create date: 07-12-2016
	* Purpose: for deleting a note
	* 
	* ********/
	public function notedelete(Request $request){
	$validator = Validator::make( $request->all(),[
			'note_id' => 'required',
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			$client_id = JWTAuth::parseToken()->authenticate()->id;
		
			 $note = Generalnote::find($request->Input('note_id'));
			 if(!empty($note)){
			// for checking the authorized user
			if($client_id != $note->user_id){
				$response['Message'] 	= 'You are not authorized to do the changes';
				$response['status']		= 0;
				return response()->json($response);
			}
				
				
				$title = $note->title;
				$description = $note->client_notes;
				 if($note->delete()){
					 
					 
					 
					 //Sending mail to Admin after updating Note start here
				
				//~ $user_data = User::where('id',$client_id)->first();
				//~ $username = $user_data->name;
				//~ 
				//~ 
				//~ $admin = User::where('role',1)->first();
				//~ $adminemail = $admin->email;
				//~ 
				//~ $template=EmailTemplate::find(49);
				//~ $find=array('@username@','@title@','@description@','@company@');
				//~ $values=array($username,$title,$description,env('SITENAME'));
				//~ $body=str_replace($find,$values,$template->content);
//~ 
				//~ //Send Mail
				//~ Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				//~ {
				//~ $m->to($adminemail)
				//~ ->subject($template->subject);
				//~ });

				//Sending mail to Admin after updating Note end here
					 
					 
					 
					 
					 
			$response['status'] = 1;
			$response['message'] = "Note Deleted";
			
			 /******* Saving data for crone job Code start******/
			$crone = new Cronejob;
			$crone->type = 'note';
			$crone->status = 'deleted';
			$crone->description = $note->toJson();
			$crone->save();
			/******* Saving data for crone job Code end******/
		}
		}else{
			$response['Message'] 	= 'Note with this note id does not exist';
				$response['status']		= 0;
		}
			
		}
		  
	return response()->json($response);
}
	
	
	
	
	
	
	
}
