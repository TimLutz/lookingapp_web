<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\models\SubCategory;
use App\models\Category;
use App\models\Product;
use App\models\Homepage;
use App\Contact;
use View;
use DB;
use Flash;
use Crypt;
use App\Booking;
use App\Faq;

class MultideleteController extends Controller {

	
	public function __construct(Guard $auth)
		{
			/*View::share('test', 'Welcome!');
			$this->user = $user_rep;
			$this->auth = $auth;
			$this->registrar = $registrar;

			$this->middleware('admin.dash');*/
			$this->middleware('admin');
	}
	/**
     * Deletes multiple records from a table.
     * created by: Jagraj singh
     * created on: 28-9-2015
     * Updated By:
     */
	public function postDelete(Request $request)
	{		
		
		try
		{
		$ids = explode(',',$request->id);
		
		$id_value = array();
		foreach($ids as $key => $value)
		{
			$id_value[] = Crypt::decrypt($ids[$key]);
		}
		
		if(count($ids)>1)
			$user_delete=DB::table($request->table)->whereIn('id', $id_value)->delete();
		else
		switch ($request->table) {
		case "sub_categories":
		 $countprod = Product::where('sub_cat_id',$id_value)->count();
		if($countprod > 0)
			{
				flash()->error('Sub category could not be deleted as used in products!!');
				return response()->json(['success'=>'sentback','message'=>'This record is associated with some other table']);	
			}
			else{
			$user_delete=DB::table($request->table)->where('id', $id_value)->delete();
			flash()->success('Sub category deleted successfully!!');
			return response()->json(['success'=>true]);	
			}
				
        break;
		case "categories":
			 $countprod = Product::where('cat_id',$id_value)->count();
			 $countcat = SubCategory::where('category_id',$id_value)->count();
			
			if($countprod > 0)
			{
				
				flash()->error('category could not be deleted as used in products!!');
				return response()->json(['success'=>'sentback']);	
			}
			elseif($countcat > 0)
			{
				flash()->error('category could not be deleted as used in Sub-categories!!');
				return response()->json(['success'=>'sentback']);	
			}
			else{
				$user_delete=DB::table($request->table)->where('id', $id_value)->delete();
			flash()->success('category deleted successfully!!');
			return response()->json(['success'=>true]);	
			}
			
			
		break;
		
		
		
		case "products":
		$counthome =  Homepage::where('product_id',$id_value)->count();
			 $countcontact =  Contact::where('product_id',$id_value)->count();
			
			if($counthome > 0)
			{
				
				flash()->error('Product could not be deleted as it is used in Grid!!');
				return response()->json(['success'=>'sentback']);	
			}
			elseif($countcontact > 0)
			{
				
				flash()->error('Product could not be deleted as it is used in Queries!!');
				return response()->json(['success'=>'sentback']);	
			}
			
			else{
				$user_delete=DB::table($request->table)->where('id', $id_value)->delete();
			flash()->success('Product deleted successfully!!');
			return response()->json(['success'=>true]);	
			}
			
			
		break;
		
		
		
		
		
		
		default:
		
		$user_delete=DB::table($request->table)->where('id', $id_value)->delete();
		flash()->success('Records deleted!!');
			return response()->json(['success'=>true]);	
		
		}
			
			flash()->success('Records deleted!!');
			return response()->json(['success'=>true]);		
			
			
				
		}
		catch(\Exception $e)
		{
			flash()->error($e->getMessage());
			return response()->json(['success'=>false, 'message' => $e->getMessage()]); 
		}
		
	}

	public function postQuotedelete(Request $request)
	{				
		try
		{
		
		$id= \Crypt::decrypt($request->id);
	
			
			$user_delete = DB::table($request->table)->where('id',$id)->update(array('status' => '2'));
			if($request->type == '3')
			{
				$booking = Booking::where('quotation_id',$id)->first();
				//$booking = DB::table('booking_detail')->where('quotation_id',$id);
				//print_r($booking->id);
				if($booking->transactions)
				{
					$booking->transactions->where('id',$booking->transactions->id)->update(array('status' => '2'));
				}
				//$transactions = DB::table('transactions')->where('booking_id',$booking->id)->update(array('status'=>'2'));
				$user_booking = DB::table('booking_detail')->where('quotation_id',$id)->update(array('status' => '2'));
			} 
			flash()->success('Records deleted!!');
			return response()->json(['success'=>true]);		
		}
		catch(\Exception $e)
		{
			flash()->error('Something went wrong!!');
			return response()->json(['success'=>false]); 
		}
	}

	public function postBookeddelete(Request $request)
	{				
		try
		{
		$id= \Crypt::decrypt($request->id);
		//$ids = explode(',',$request->id);
		
		/*if(count($ids)>1)
			$user_delete=DB::table($request->table)->whereIn('id', $ids)->update(array('status' => '2'));
		else*/
			
		$booking = Booking::where('status','!=','2')->find($id);
		//print_r($booking);
		if($booking->quotatio)
		{
			$booking->quotatio->where('id',$booking->quotatio->id)->update(array('status' => '2'));
		}

		if($booking->transactions)
		{
			$booking->transactions->where('id',$booking->transactions->id)->update(array('status' => '2'));
		}

		$user_delete = DB::table($request->table)->where('id',$id)->update(array('status' => '2'));
			//$user_delete = DB::table($request->table)->where('id',$ids)->update(array('status' => '2'));
			
				//$user_booking = DB::table('quotation')->where('id',$ids)->update(array('status' => '2'));
		
			flash()->success('Records deleted!!');
			return response()->json(['success'=>true]);		
		}
		catch(\Exception $e)
		{
			flash()->error('Something went wrong!!');
			return response()->json(['success'=>false]); 
		}
	}
}
