<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
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

use Illuminate\Support\Facades\Lang;

class PropertyController extends Controller {
	
	protected $hashKey;
	
	public function __construct(){
      $this->middleware('jwt.auth', ['except' => ['postLogin']]);
    }
    
    

	public function allproperty(Request $request){
		
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
		 $end = $request->Input('end');
		$start = $request->Input('start');
		$properties = Property::where(array('user_id'=>$user_id,'status'=>1))->orderBy('id','desc')->take($end)->skip($start)->with('property_attributes')->get();
		if($properties){
			$response['status']		= 1;
		 $response['properties'] = $properties;
		}
		else{
			$response['message']='Some error occured';
			$response['status']=0;
		}
	}
		  return response()->json($response);
    }   
    
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProperty(Request $request)
    {
      
      
		$validator = Validator::make( $request->all()  ,      [
           
			'property_name' => 'required',
			'property_address' => 'required',
			'latitude' => 'required|numeric',
			'longitude' => 'required|numeric',
			'option' => 'required',
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{

					$user_id = JWTAuth::parseToken()->authenticate()->id;

					$data = $request->all();
					$data['user_id'] = $user_id;
					$data['status'] = '1';
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
					$response['message']	= 'Property has been created successfully';
					$response['status']		= 1;
					$response['properties'] = Property::where(array('id'=>$property->id,'status'=>1))->with('property_attributes')->get();

					} else{
					$response['message']='Some error occured';
					$response['status']=0;
					}

		}
		return response()->json($response);
	}
		
    
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProperty(Request $request)
    {
      
      
		$validator = Validator::make( $request->all()  ,      [
           'property_id' => 'required',
			'property_name' => 'required',
			'property_address' => 'required',
			'latitude' => 'required|numeric',
			'longitude' => 'required|numeric',
			'option' => 'required',
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
       
				$user_id = JWTAuth::parseToken()->authenticate()->id;
       
				$data = $request->all();
				$data['user_id'] = $user_id;
				$prop_id = $request->property_id;
           
                $property = Property::findOrfail($prop_id);
                
                $property->update($data);
                
                 $options = $request->option;
                 foreach($options as $option)
                 {
					  $prop_attributes = PropertyAttribute::updateOrCreate(['prop_id' => $prop_id,'attribute_name' => $option,'status' => '1']);
					  
				 }
                
            PropertyAttribute::where('prop_id',$prop_id)->whereNotIn('attribute_name',$options)->delete();
				
					$response['message']	= 'Property has been Updated successfully';
					$response['status']		= 1;
					$response['properties'] = Property::where(array('id'=>$prop_id,'status'=>1))->with('property_attributes')->get();
                 
				}

				
		return response()->json($response);
	}
	
	
	   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function deleteProperty(Request $request)
	{
		//return $request->all();die;
		$validator = Validator::make( $request->all()  ,      [
           'property_id' => 'required',
			
		]);
		if ($validator->fails()) {
			
			$response['errors'] 	= $validator->errors();
           	$response['status']		= 0;
        }else{
			
		  $user_id = JWTAuth::parseToken()->authenticate()->id;
		  $prop_id = $request->property_id;
		  
		   $property = Property::findOrfail($prop_id);
		  if($property->user_id == $user_id){
		
		 $checkbefordelete = Property::where(array('id'=>$prop_id))->with('property_attributes')->count();
		 if($checkbefordelete == 0){
			  $response['message']='Property does not exist';
			  $response['status']=0;
		 }
		 else{ 
			$deleteAttribute = PropertyAttribute::where('prop_id',$prop_id)->delete();
			$deleteproperty = Property::where(array('id'=>$prop_id))->delete();
		  $checkdelete = Property::where(array('id'=>$prop_id))->with('property_attributes')->count();
		 if($checkdelete == 0){
			$response['message']	= 'Property has been Deleted successfully';
			$response['status']		= 1;
		 }else{
			 $response['message']='Some error has occured!! property not deleted';
			 $response['status']=0;
		 }
		 }
		}else{
			 $response['message']='You are not authorized to Delete property';
			 $response['status']=0;
		}
	 }
	 return response()->json($response);
	}

	
}
