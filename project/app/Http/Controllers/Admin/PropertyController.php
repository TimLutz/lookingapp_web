<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use repositories\CommonRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;
use App\User;
use App\models\Task;
use App\models\Notificationlog;
use App\Property;
use App\PropertyAttribute;
use Request as AjaxRequest;
use Flash;
use DB;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

  /**
     * Created By: Jagraj Singh
     * Created for: Index function for property
     * created date:November 2016
     */
    public function getIndex($userid=Null)
    {
        try {
			 $properties = Property::where('id','!=','')->paginate(10);
			 $active = 'properties';
			if(!empty($userid))
             {
			return view('admin.properties.index', compact('active','properties','userid'));
			   }
            return view('admin.properties.index', compact('active','properties'));
            
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage(),
                        'active' => 'properties'
                      ];
            return view('errors.error', $result);          
        }
    }
   
    
    /********
     * created by: Jagraj Singh
     * Made for: Listing Properties in datatable with filters using ajax 
     * 
     *********/
    public function postListProperties(Request $request,CommonRepository $common,$userid=Null)
	{
		if(isset($userid)){
		$realtorid = \Crypt::decrypt($userid);
	   }
		if(isset($realtorid)){
		$basearray = DB::table('properties')->where('user_id','=',$realtorid)->orderBy('id','desc');
	   }
		else{
			$basearray = DB::table('properties')->where('id','!=','')->orderBy('id','desc');
		}
		 
		  $totalusercount = DB::table('properties')->where('id','!=','')->count();
		
		
		
		/*****************Below code is for filtering ****************/
		if(isset($request->propname) && !empty($request->propname))
		{
			
			$basearray->where('property_name','LIKE','%'.$request->propname.'%');
		}
		
		
		if(isset($request->propaddress) && !empty($request->propaddress))
		{
			
			$basearray->where('property_address','LIKE','%'.$request->propaddress.'%');
		}
		//filtering on the basis of user type realtor/houseowner
		if(isset($request->typeuser) && !empty($request->typeuser)){
			  $userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('user_id',$userstype);
		}
		
		//filtering on the basis of username
		if(isset($request->username) && !empty($request->username)){
			  $usernamelist = User::where('name','LIKE','%'.$request->username.'%')->lists('id')->toArray();
			  //$userstype = User::where('type',$request->typeuser)->lists('id')->toArray();
				$basearray->whereIn('user_id',$usernamelist);
		}
		
		if(isset($request->status))
		{
			
			if($request->status == '1'){
				
				$basearray->where('status',1);
			}
			elseif($request->status == '2'){
				
				$basearray->where('status',0);
			}
			else{
				
			}
			
		}
		/*****************Below code is for Sorting ****************/
		//$basearray->orderBy('id','desc');
		$order = $request->get('order');
			if($order[0]['column'] == 0 && $order[0]['dir'] == 'asc')
			{
				
				$basearray->orderBy('id','asc');
			}
			if($order[0]['column'] == 0 && $order[0]['dir'] == 'desc')
			{
				
				$basearray->orderBy('id','desc');
			}
			if($order[0]['column'] == 3 && $order[0]['dir'] == 'asc')
			{
				
				$basearray->orderBy('property_name','asc');
			}
			if($order[0]['column'] == 3 && $order[0]['dir'] == 'desc')
			{
				
				$basearray->orderBy('property_name','desc');
			}
			
		$counttotal =  Property::get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		//print_r($resultset);die;
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
				foreach($resultset as $task){
					
					
									$userId = \Crypt::encrypt($task->id);
									$userdata = User::where('id',$task->user_id)->first();
									$usertype =  $userdata->type;
					
					
					
					if($usertype == 2){
					$view_link = '<a userid="'.$userId.'" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail"><span class="icon-eye" style="color:blue;"></span></a>
					 <a href="properties/edit/'.$userId.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>
					 <a deleteLink="properties/delete/'.$userId.'" class="btn btn-circle btn-icon-only btn-default" id="deletetask"><span style="color:brown" title="Delete" class="icon-trash" aria-hidden="true"></span></a>';
					}else{$url = url(getenv('adminurl').'/properties/show/'.$userId);
						$view_link = '<a userid="'.$userId.'" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail"><span class="icon-eye" style="color:blue;"></span></a>
					 
					 <a deleteLink="properties/delete/'.$userId.'" class="btn btn-circle btn-icon-only btn-default" id="deletetask"><span style="color:brown" title="Delete" class="icon-trash" aria-hidden="true"></span></a>';
					}
					
					
					if(isset($task->user_id) && !empty($task->user_id)){
							$username = User::where('id',$task->user_id)->pluck('name');
						
					}
					if(isset($task->user_id) && !empty($task->user_id)){
							//$userdata = User::where('id',$task->user_id)->first();
							$username = $userdata->name;
							//$usertype =  $userdata->type;
							$typeuser= '';
							if($usertype == 1){
								$typeuser = 'Realtor';
							}
							if($usertype == 2){
								$typeuser = 'Houseowner';
							}
							if($usertype == 4){
								$typeuser = 'Both';
							}
						
					}
					if(isset($task->property_name) && !empty($task->property_name)){
							$propname = $task->property_name;
						
					}
					if(isset($task->property_address) && !empty($task->property_address)){
							$propaddress = $task->property_address;
						
					}
					$attributes = PropertyAttribute::where('prop_id',$task->id)->get();
					$countall = count($attributes); 
					if($countall != 0){
						$attr = '';
						foreach($attributes as $key => $attribute)
						{
							if($key+1<$countall){
								$attr .= $attribute->attribute_name.", ";
							}
							else{
								$attr .= $attribute->attribute_name;
							}
							
						}
					}
					else{
						$attr = '';
					}
					if(isset($attr) && !empty($attr)){
							$attrname = strlen($attr);
							
								if($attrname>30){
									$attrname = substr($attr,0,15).'...';
								}
								else{
									$attrname = substr($attr,0,15);
								}
						
					}
					$GLOBALS['data'][] = array($i,$username,$typeuser,$propname,$propaddress,$attrname,$view_link);
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
     * Created for: getting page for creating property
     * created date:November 2016
     */
    public function getCreate($id)
    {
        try
		{
			
			 $user_id = \Crypt::decrypt($id);
			 $prop_count = Property::where('user_id',$user_id)->count();
			 if($prop_count > 0){
				 $prop_id = \Crypt::encrypt(Property::where('user_id',$user_id)->pluck('id'));
				
				  return redirect(getenv('adminurl').'/properties/show/'.$prop_id); 
			 }
			$active = 'properties';
			$selected = User::where('id',$user_id)->first();
			$users = User::where('status','1')->whereIN('type',[2,4])->lists('name','id')->toArray();
			return view('admin.properties.createprop',compact('active','users','user_id'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'properties'
            ];
			return view('errors.error', $result);
        }
    }
    
    /**
     * Created By: Jagraj Singh
     * Created for: creating property
     * created date:November 2016
     */
    public function postCreate(Requests\PropertyRequest $request,CommonRepository $notification)
    {
        try
		{
			 $data = $request->all();
			$property = Property::create($data);
			
			$options = $request->option;
			foreach($options as $key=>$option){
			$attribute = new PropertyAttribute;
			$attribute->prop_id = $property->id;
			$attribute->attribute_name = $option;
			$attribute->status = '1';
			
			$saved = $attribute->save();
			}
			if($saved){
		   $message = 'One property with name: "'.$property->property_name.'" has been Created by the Admin';
		   $title = 'One Property Created';
		   $this->getNotify($property->user_id,$message,$title,$notification);
				
				
				//Code for saving notification log in database start
			   $notificationlog = new Notificationlog;
		       $notificationlog->task_id = $property->id;
		       $notificationlog->task_type = 'Property Added';
		       $notificationlog->title = $property->property_name;
		       $notificationlog->sent_to_id = $property->user_id;
		       $notificationlog->save();
		       //Code for saving notification log in database end
				
				
				
				 flash()->success('Property created successfully');
				 return response()->json(['success'=>true]);
						}
			
						else{
							 flash()->error('something went wrong');
							  return response()->json(['success'=>false]);
						 }
			
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'properties'
            ];
			return view('errors.error', $result);
        }
    }

   
/**
     * Created By: Jagraj Singh
     * Created for: detail page for property
     * created date:November 2016
     */
     public function postShowprop(Request $request)
	{
		$id = \Crypt::decrypt($request->id);
			
         $data['reslutset'] = Property::where('id',$id)->first();
         $prop_attrs = $data['reslutset']->property_attributes()->get();
        //~ // $countall = count($prop_attrs);
         $prefix = $data['propattrs'] = '';
         foreach($prop_attrs as $key=>$attribute)
         {
     //    $data['propattrs'] .= $prefix . '"' . $attribute->attribute_name . '"';
           $data['propattrs'] .= $prefix." ".$attribute->attribute_name;
          $prefix = ', ';
		//~ //$attribute->attribute_name if($key+1 < $countall), @else @endif
	     }
         $data['user'] = User::where('id',$data['reslutset']->user_id)->first();
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
    public function getShow($id)
    {	
		
		
			 $active = 'properties';
		 
		 $userid = \Crypt::decrypt($id);
		
         $property = Property::where('id',$userid)->first();
        return view('admin.properties.show', compact('property','active'));
         
    }
    
      
      
      
      

    /**
     * Created By: Jagraj Singh
     * Created for: getting edit page for property
     * created date:November 2016
     */
    public function getEdit($id)
    {
       
        try
        {
            
            $active = 'properties';
            $id  = \Crypt::decrypt($id);
            $users = User::where('status','1')->where('type','2')->lists('name','id')->toArray();
            $property = Property::findOrfail($id);
        
            return view('admin.properties.editprop', compact('property','active','users'));
        }
        catch (\Exception $e) 
		{ 
			
				$result = [
					'exception_message' => $e->getMessage(),
					'active' => 'properties'
				]; 
			
            
			return view('errors.error', $result);
		}
    }

    

    /**
     * Created By: Jagraj Singh
     * Created for: updating property
     * created date:November 2016
     */
    public function postUpdate(Requests\PropertyRequest $request,$id,CommonRepository $notification)
    {
        try
        {
			 $data = $request->all();
           
            $active = 'properties';
             $prop_id = \Crypt::decrypt($id);
           
                $property = Property::findOrfail($prop_id);


				$property->update($data);
                
                 $options = $request->option;
                 //~ foreach($options as $option)
                 //~ {
					  //~ $prop_attributes = PropertyAttribute::updateOrCreate(['prop_id' => $prop_id,'attribute_name' => $option,'status' => '1']);
					  //~ 
				 //~ }
				 //~ PropertyAttribute::where('prop_id',$prop_id)->whereNotIn('attribute_name',$options)->delete();
				//~ 
                $oldcount = PropertyAttribute::where('prop_id',$prop_id)->get()->count();
                 $newcount = count($options);
                 $oldattributes = PropertyAttribute::where('prop_id',$prop_id)->get();
				if($oldcount == $newcount){
					for ($x = 1; $x <= $oldcount; $x++) {
						$prop = PropertyAttribute::findOrfail($oldattributes[$x-1]->id);
						$prop->attribute_name = $options[$x];
						$prop->update();
					} 
				}
				
				if($oldcount < $newcount){
					for ($x = 1; $x <= $newcount; $x++) {
					if($x <= $oldcount){
						$prop = PropertyAttribute::findOrfail($oldattributes[$x-1]->id);
						$prop->attribute_name = $options[$x];
						$prop->update();
						}
						else{
							$attribute = new PropertyAttribute;
							$attribute->prop_id = $prop_id;
							$attribute->attribute_name = $options[$x];
							$attribute->status = '1';
							$attribute->save();
						}
						} 
					}
				
				if($oldcount > $newcount){
					for ($x = 1; $x <= $oldcount; $x++) {
						
						if($x <= $newcount){
						$prop = PropertyAttribute::findOrfail($oldattributes[$x-1]->id);
						$prop->attribute_name = $options[$x];
						$prop->update();
						}
						else{
							$delete = PropertyAttribute::where('id',$oldattributes[$x-1]->id)->delete();
						}
						} 
					}
				
				$message = '"'.$property->property_name.'" Property has been Updated by the Admin';
		   $title = 'One Property Updated';
		   $this->getNotify($property->user_id,$message,$title,$notification);
		   
		       //Code for saving notification log in database start
			   $notificationlog = new Notificationlog;
		       $notificationlog->task_id = $property->id;
		       $notificationlog->task_type = 'Property Updated';
		       $notificationlog->title = $property->property_name;
		       $notificationlog->sent_to_id = $property->user_id;
		       $notificationlog->save();
		       //Code for saving notification log in database end
		   
			 flash()->success('Property updated successfully');
				 return response()->json(['success'=>true]);
						
        }
        catch (\Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'properties'
           ];
            return view('errors.error', $result);
        }
       
    }

    
    
    
     /**
     * Created By: Jagraj Singh
     * Created for: deleting a property and its attributes
     * created date:November 2016
     */
    public function getDelete($id,CommonRepository $notification)
    {
		  $propid = \Crypt::decrypt($id);
			
		  $active = 'properties';
		  $deleteAttribute = PropertyAttribute::where('prop_id',$propid)->delete();
		  $deletetask = Task::where('property_id',$propid)->delete();
		   $property = Property::where('id',$propid)->first();
          $delete = Property::where('id',$propid)->delete();
          
           $message = '"'.$property->property_name.'" Property has been Deleted by the Admin';
		   $title = 'One Property Deleted';
		   $this->getNotify($property->user_id,$message,$title,$notification);
		   
               //Code for saving notification log in database start
			   $notificationlog = new Notificationlog;
		       $notificationlog->task_id = $property->id;
		       $notificationlog->task_type = 'Property Deleted';
		       $notificationlog->title = $property->property_name;
		       $notificationlog->sent_to_id = $property->user_id;
		       $notificationlog->save();
		       //Code for saving notification log in database end
		       
        return redirect (getenv('adminurl').'/properties');
    }
    
     //function to send notification
		public function getNotify($user,$message,$title,$notification){
			$user_data['message'] = $message;
			$user_data['title'] = $title;       
			$user_data['user_ids'] = [$user];       
			return $notification->send_notification($user_data);
		}
    
    
}
