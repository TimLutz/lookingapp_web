<?php namespace App\Http\Controllers;

use App\Repositories\CommonRepositoryInterface;
use App\Repositories\CommonRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\EmailTemplate;
use Auth;
use Flash;
use Input;
use DB;
use Mail;


class CommonController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	
	
	
	 /**
     * Send Mail.
     *
     * @param int $id            
     * @return Response
	 * 
	 * Created on: 25/1/2016
	 * Updated on: 25/1/2016
     */
	public static function postSendMail($template_id, $data, $mail_to)
	{	
		$keys = array_keys($data);
		
		for($i=0; $i<count($keys); $i++)
		{
			$template_keys[$i] = $keys[$i];
		}
		$template_keys['subject'] = '%subject%';
		
		$template = EmailTemplate::where('id', $template_id)->get();
	
		$data['subject'] = $template[0]->subject;
		$values = array_values($data);
		//return $data;
		
		$find=$template_keys;
		$values=$values;
		$content=str_replace($find,$values,$template[0]->content);
		
		$emailcontent = array(
		'content' => $content,
		'subject' => $template[0]->subject
		);
		
		Mail::send('emails.verify', $emailcontent, function($message) use ($data, $mail_to)
		{
			$message->to($mail_to)->subject($data['subject']);
			if(isset($data['mail_cc']))
			{
				$message->cc($data['mail_cc']);
			}
		});
		//return view('emails.verify', $emailcontent);
		//exit;
	}

	  public function postChangeStatus(Request $request)
    {
    	try {
			
			$ids = explode(',',$request->id);
             $request = Input::all();
			 $status=DB::table($request['table'])->whereIn('id',$ids);
			 
			if($request['status'] == '0'){
				 
				$status->update(['status' => '1']);
			}
				
			else{
				
				$status->update(['status' => '0']);
			}  
			return response()->json(['success'=>true,'action' => $request['action']]);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'action' => $request['action']]);
        }
    }
			
			
}

			 

			 
			
			
