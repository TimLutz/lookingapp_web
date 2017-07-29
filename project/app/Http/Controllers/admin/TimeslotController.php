<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use repositories\CommonRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Timeslot;
use App\Http\Requests\TimeslotRequest;
use Request as AjaxRequest;
use Flash;
use DB;

class TimeslotController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Created By: Jagraj Singh
     * Created for: Index function for cms pages
     * created date:November 2016
     */
    public function getIndex()
    {
        //
        try {
            $active = 'timeslot';
            $dates = Timeslot::orderBy('id','DESC')->paginate(10);
             return view('admin.dateformats.index', compact('active','dates'));
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error', $result);          
        }
    }
    
    
    
    
    

    /**
     * Created By: Jagraj Singh
     * Created for: getting page for creating cms page
     * created date:November 2016
     */
    public function getCreate()
    {
        try
		{
			$active = 'timeslot';
			return view('admin.dateformats.create',compact('active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'timeslot'
            ];
			return view('errors.error', $result);
        }
    }

   /**
     * Created By: Jagraj Singh
     * Created for: creating cms page
     * created date:November 2016
     */
    public function postStore(TimeslotRequest $request)
    {
	    try
	    {
				$data = $request->all();
				//$testimonials = new Testimonials;
				$data['status'] = $request->Input('status');
				$data['from'] = date('H:i:s',strtotime($request->Input('from')));
				$data['to'] = date('H:i:s',strtotime($request->Input('to')));
			
			
			
			
			if(Timeslot::create($data))
			{
				
				
				$result['success'] = true;
				$result['message'] = 'Data Added Successfully!!';
				return json_encode($result);
			}
			else
			{
				
				$result['success'] = false;
				$result['message'] = 'Data Not Added!!';
				return json_encode($result);
				
			}
			
			
			
		}
        catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'timeslot'
            ];
			return view('errors.error', $result);
        }
        return redirect(getenv('adminurl').'/timeslot');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {	
		//
         
    }

    /**
     * Created By: Jagraj Singh
     * Created for: getting edit page
     * created date:November 2016
     */
    public function getEdit($id)
    {
        //
        try
        {
			
           
            $id  = \Crypt::decrypt($id);
            $active = 'timeslot';
            $timeslot = Timeslot::findOrfail($id);
            return view('admin.dateformats.edit', compact('timeslot','active'));
        }
        catch (\Exception $e) 
		{ 
			 $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'timeslot'
            ];
			return view('errors.error', $result);
		}
    }

    

    /**
     * Created By: Jagraj Singh
     * Created for: updating a page
     * created date:November 2016
     */
    public function postUpdate($id,TimeslotRequest $request)
    {
        //
        try
        {
            
              $id = \Crypt::decrypt($id);
            //$check = Page::where('status','!=','2')->where('title',$request->title)->where('id','!=',$id)->count();
            //die();
           // if($check == 0)
            //{
                $timeslot = Timeslot::findOrfail($id);

                $data = $request->all();

              //  print_r($data); die;
              $timeslot['status'] = $request->Input('status');
				$timeslot['from'] = date('H:i:s',strtotime($request->Input('from')));
				$timeslot['to'] = date('H:i:s',strtotime($request->Input('to')));
                if($timeslot->update())
                {
                   $result['success'] = true;
				$result['message'] = 'Data Updated Successfully!!';
				return json_encode($result);
                }
               
            else
            {
                $result['success'] = false;
				$result['message'] = 'Data Not Updated!!';
				return json_encode($result);
            }
        }
        catch (\Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'timeslot'
           ];
            return view('errors.error', $result);
        }
    }

      /**
     * Created By: Jagraj Singh
     * Created for: deleting a timeslot and its attributes
     * created date:November 2016
     */
    public function getDelete($id,CommonRepository $notification)
    {
		 $id = \Crypt::decrypt($id);
			
		  $active = 'timeslot';
          $delete = Timeslot::where('id',$id)->delete();
		flash()->success('Timeslot has been deleted');       
        return redirect (getenv('adminurl').'/timeslot');
    }
    
    
}
