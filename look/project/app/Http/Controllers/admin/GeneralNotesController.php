<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use repositories\CommonRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;
use App\User;
use App\models\Generalnote;
use Request as AjaxRequest;
use Flash;
use DB;
use Carbon\Carbon;

class GeneralNotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Created By: Jagraj Singh
     * Created for: Index function for general notes
     * created date:November 2016
     */
    public function getIndex()
    {
        try {
            $active = 'notes';
             $properties = Generalnote::where('id','!=','')->paginate(10);
             return view('admin.notes.index', compact('active','properties'));
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage(),
                        'active' => 'notes'
                      ];
            return view('errors.error', $result);          
        }
    }
    
    
    /********
     * created by: Jagraj Singh
     * Made for: Listing General Notes in datatable with filters using ajax 
     * 
     *********/
    public function postListNotes(Request $request,CommonRepository $common)
	{
		
	
		
		 $basearray = DB::table('general_notes')->where('id','!=','');
		  $totalusercount = DB::table('general_notes')->where('id','!=','')->count();
		
		
		
		/*****************Below code is for filtering ****************/
	
	//filtering on the basis of user type realtor/houseowner
		if(isset($request->typeuser) && !empty($request->typeuser)){
			  $userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('user_id',$userstype);
		}
		
		//filtering on the basis of technician assigned
		if(isset($request->clientname) && !empty($request->clientname)){
			  $technicianlist = User::where('name','LIKE','%'.$request->clientname.'%')->lists('id')->toArray();
			  //$userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('user_id',$technicianlist);
		}
		if(isset($request->title) && !empty($request->title))
		{
			 //return $request->scheduled_at_to;die;
			 $basearray->where('title','LIKE','%'.$request->title.'%'); 
		}
		
		/*****************Below code is for Sorting ****************/
		
		$order = $request->get('order');
			if($order[0]['column'] == 4 && $order[0]['dir'] == 'asc')
			{
				$basearray->orderBy('created_at','asc');
			}
			if($order[0]['column'] == 4 && $order[0]['dir'] == 'desc')
			{
				$basearray->orderBy('created_at','desc');
			}
			
		$counttotal =  Generalnote::get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
				foreach($resultset as $task){
					
					
									$userId = \Crypt::encrypt($task->id);
								
					
					
					$view_link = '<a class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail" href="show/'.$userId.'"><span class="icon-eye" style="color:blue;"></span></a>';
					
					
					
					if(isset($task->user_id) && !empty($task->user_id)){
							$userdata = User::where('id',$task->user_id)->first();
							$username = $userdata->name;
							$usertype =  $userdata->type;
							if($usertype == 1){
								$typeuser = 'Realtor';
							}
							if($usertype == 2){
								$typeuser = 'Houseowner';
							}
						
					}
					if(isset($task->created_at) && !empty($task->created_at)){
						
					$notedate = Carbon::parse($task->created_at);
					}
						if(isset($task->title) && !empty($task->title)){
						
					$title = $task->title;
					}
					else{
						$title = '';
					}
					$GLOBALS['data'][] = array($i,$username,$typeuser,$title,$task->client_notes,$notedate->format('Y-m-d'),$view_link);
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
     * Created for: getting detail page for general notes
     * created date:November 2016
     */
    public function getShow($id)
    {	
		
		
			 $active = 'notes';
		 
		 $userid = \Crypt::decrypt($id);
		
         $notes = Generalnote::where('id',$userid)->first();
        return view('admin.notes.show', compact('notes','active'));
         
    }

  
    
    
    
    
}
