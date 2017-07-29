<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Contact;
use App\EmailTemplate;
use Mail;
use Input;
use DB;
use Flash;


class ContactusController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('admin');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try 
       {
		$active = 'contactus';
		$contact = Contact::where('status','!=','2')->orderBy('status', 'desc')->get(); 
		return view('admin.contact.contactus',compact('active','contact'));    
		} 
		catch (Exception $e) {
		$e->getMessage('page cannot be found');
		}
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		try{
		$id_con = \Crypt::decrypt($id); 
        $contactData = Contact::find($id_con);
		$active = 'contactus';
	    return view('admin.contact.show',compact('contactData','active'));
	    }
	    catch (\Exception $e) 
          {
			$result = [
			'exception_message' => $e->getMessage(),
			'active'=>'contact'
			];
			return response()->json($result,500);
		  }
    }

    
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Requests\ReplyUserRequest $request)
    {
		
		try {
			$data = $request->all();
			$conatct_id = \Crypt::decrypt($request->userid); 
			$emailuser = $request->email;
			$message = $request->message;
			$Contact = Contact::findOrfail($conatct_id); 
			$Contact->update([
			'status' => 1,
			'message' => $message
             ]);
	        if($Contact){
						$name = Contact::where('id',$conatct_id)->pluck('name');
                        $template=EmailTemplate::find(36);
                        $find=array('@name@','@reply@','@sitename@');
                        $values=array($name,$message,config('app.website_name'));
						$body=str_replace($find,$values,$template->content);
                        //Send Mail
						Mail::send('emails.verify', array('content'=>$body), function($message) use($template,$emailuser)
						{
						$message->to($emailuser)
						->subject($template->subject);
						});
						return response()->json(array('success' => 'true'));
				} 
				else 
				{
					 return response()->json(array('success' => 'false'));
		  	   }
			}
			catch (\Exception $e) {
			$result = [
			'exception_message' => $e->getMessage(),
			'active'=>'contact'
			];
			return response()->json($result,500);
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

    public function postChangeStatus(Request $request)
    {  
        try {

            $id = \Crypt::decrypt($request->id); 
            $request = Input::all();
            //print_r($request); die();
            $page_status=DB::table($request['table'])->where('id',$id);
            $page_status->update([
                'status' => $request['status']
            ]);
            
            $result = [
                'success' => true,
              flash()->success('Status Changed successfully'),
                'redirect_url' => url('admin/'.$request['action'])
            ];
        } catch (\Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'redirect_url' => url('admin/'.$request['action'])
            ];
        }
        return $result;
    }
}
