<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Generalnote;
use App\Models\EmailTemplate;
use App\Models\Cronejob;
use App\Models\Property;
use App\Models\PropertyAttribute;
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


use Illuminate\Support\Facades\Lang;

class CronejobController extends Controller {
	
	protected $hashKey;
	
	
    
    /*********** 
	* created By:Jagraj Singh
	* create date: 13-12-2016
	* Purpose: For Running Crone job
	* 
	* ********/
	public function cronejob(Request $request){
		
	$crones = Cronejob::where('action_status',0)->get();
	foreach($crones as $crone){
		$description =  json_decode($crone->description,true);
		$admin = User::where('role',1)->first();
        $adminemail = $admin->email;
		/************************ Mails for Task Related changes ***********************/
		/************************ Created By Jagraj Singh ***********************/
		
		if($crone->type == 'task'){
			
			$task_name = $description[0]['task_name'];
			$clientid  = $description[0]['client_id'];
			$client = User::where('id',$clientid)->first();
			$propid = $description[0]['property_id'];
			 $propertydata = Property::where('id',$propid)->first();
			$propertyname = $propertydata['property_name'];
			$attrid = $description[0]['attribute_id'];
			$propattr = PropertyAttribute::where('id',$attrid)->first();
			$attrname = $propattr['attribute_name'];
			
		/************************ When New Task is Created ***********************/
		
			if($crone->status == 'created'){
				  
			$updatestatus = Cronejob::where('id',$crone->id)->update(['action_status'=>1]);
			
			
			if($client['type'] == '1'){
				$usertype = 'Realtor';
			}
			elseif($client['type'] == '2'){
				$usertype = 'Houseowner';
			}
			
			if($description[0]['priority'] == '1'){
				$priority = 'High';
			}
			elseif($description[0]['priority'] == '2'){
				$priority = 'Medium';
			}
			elseif($description[0]['priority'] == '3'){
				$priority = 'Low';
			}
			
        		
        		$template=EmailTemplate::find(43);
			$find=array('@taskname@','@name@','@email@','@type@','@propertyname@','@attribute@','@startdatetime@','@enddatetime@','@priority@','@company@');
			$values=array($task_name,$client['name'],$client['email'],$usertype,$propertyname,$attrname,$description[0]['start_datetime'],$description[0]['end_datetime'],$priority,env('SITENAME'));
			
			 $body=str_replace($find,$values,$template->content);

			//Send Mail
			 Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
			{
				$m->to($adminemail)
					->subject($template->subject);
			});
				
				
				$delete = Cronejob::where('id',$crone->id)->delete();
			}
			
			
			
			
			/************************ When Task is Rescheduled ***********************/
			if($crone->status == 'rescheduled'){
				$updatestatus = Cronejob::where('id',$crone->id)->update(['action_status'=>1]);
				$newstart = $description[0]['start_datetime'];
				$newend = $description[0]['end_datetime'];
				
				$template=EmailTemplate::find(50);
				$find=array('@taskname@','@username@','@propertyname@','@attribute@','@newstart@','@newend@','@company@');
				$values=array($task_name,$client['name'],$propertyname,$attrname,$attrname,$newstart,$newend,env('SITENAME'));
				$body=str_replace($find,$values,$template->content);

				//Send Mail
				Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				{
				$m->to($adminemail)
				->subject($template->subject);
				});
				$delete = Cronejob::where('id',$crone->id)->delete();
			}
			
			/************************ When Task is Completed***********************/
			if($crone->status == 'completed'){
				$updatestatus = Cronejob::where('id',$crone->id)->update(['action_status'=>1]);
				$rating = $description[0]['rating'];
				$currentdate = $crone['created_at'];
				
				$template=EmailTemplate::find(45);
				$find=array('@taskname@','@client@','@email@','@property@','@attribute@','@completeddate@','@company@','@rating@');
				$values=array($task_name,$client['name'],$client['email'],$propertyname,$attrname,$currentdate,env('SITENAME'),$rating);
				$body=str_replace($find,$values,$template->content);

				//Send Mail
				Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				{
				$m->to($adminemail)
				->subject($template->subject);
				});
				$delete = Cronejob::where('id',$crone->id)->delete();
			}
			
			/************************ When Task is Deleted***********************/
			if($crone->status == 'deleted'){
				
				$updatestatus = Cronejob::where('id',$crone->id)->update(['action_status'=>1]);
				$template=EmailTemplate::find(46);
				$find=array('@taskname@','@username@','@otheruseone@','@company@');
				$values=array($task_name,$client['name'],$client['email'],env('SITENAME'));
				$body=str_replace($find,$values,$template->content);

				//Send Mail
				Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				{
				$m->to($adminemail)
				->subject($template->subject);
				});
				$delete = Cronejob::where('id',$crone->id)->delete();
			}
			
		}
		if($crone->type == 'note'){
			
				$user_data = User::where('id',$description[0]['user_id'])->first();
				$username = $user_data['name'];
				$title = $description[0]['title'];
				$descriptionnotes = $description[0]['client_notes'];
			/************************ When Note is created***********************/
			if($crone->status == 'created'){
				$updatestatus = Cronejob::where('id',$crone->id)->update(['action_status'=>1]);
				$template=EmailTemplate::find(47);
				$find=array('@otheruseone@','@title@','@description@','@company@');
				$values=array($username,$title,$descriptionnotes,env('SITENAME'));
				$body=str_replace($find,$values,$template->content);

				//Send Mail
				Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				{
				$m->to($adminemail)
				->subject($template->subject);
				});
				$delete = Cronejob::where('id',$crone->id)->delete();
			}
			
			/************************ When Note is Updated***********************/
			if($crone->status == 'updated'){
				
				$updatestatus = Cronejob::where('id',$crone->id)->update(['action_status'=>1]);
				$template=EmailTemplate::find(48);
				$find=array('@otheruse@','@title@','@description@','@company@');
				$values=array($username,$title,$descriptionnotes,env('SITENAME'));
				$body=str_replace($find,$values,$template->content);

				//Send Mail
				Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				{
				$m->to($adminemail)
				->subject($template->subject);
				});
				$delete = Cronejob::where('id',$crone->id)->delete();
			}
			
			/************************ When Note is deleted***********************/
			if($crone->status == 'deleted'){
				$updatestatus = Cronejob::where('id',$crone->id)->update(['action_status'=>1]);
				$template=EmailTemplate::find(49);
				$find=array('@username@','@title@','@description@','@company@');
				$values=array($username,$title,$descriptionnotes,env('SITENAME'));
				$body=str_replace($find,$values,$template->content);

				//Send Mail
				Mail::send('emails.verify', array('content'=>$body), function($m) use($template,$adminemail)
				{
				$m->to($adminemail)
				->subject($template->subject);
				});
				$delete = Cronejob::where('id',$crone->id)->delete();
			}
		}
	}
	
		$response['status'] = 1;
		$response['message'] = 'Success';
	
	return response()->json($response);
	}


	
	
	
	
	
}
