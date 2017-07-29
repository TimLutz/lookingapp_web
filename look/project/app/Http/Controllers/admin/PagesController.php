<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use repositories\CommonRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;
use App\Http\Requests\PagesRequest;
use Request as AjaxRequest;
use Flash;
use DB;

class PagesController extends Controller
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
    public function index()
    {
        //
        try {
            $active = 'pages';
            $pages = Page::where('status','!=','2')->orderBy('id','DESC')->get();
            //print_r($pages); die;
             return view('admin.pages.index', compact('active','pages'));
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error', $result);          
        }
    }
    
    
    
    
    
    /********
     * created by: Jagraj Singh
     * Made for: Listing Pages in datatable with filters using ajax 
     * 
     *********/
    public function ListPages(Request $request,CommonRepository $common)
	{
		
	
		
		 $basearray = DB::table('pages')->where('id','!=','');
		  $totalusercount = DB::table('pages')->where('id','!=','')->count();
		
		
		
		/*****************Below code is for filtering ****************/
		if(isset($request->propname) && !empty($request->propname))
		{
			
			$basearray->where('property_name','LIKE','%'.$request->propname.'%');
		}
		

		/*****************Below code is for Sorting ****************/
		//$basearray->orderBy('id','desc');
		$order = $request->get('order');
			if($order[0]['column'] == 1 && $order[0]['dir'] == 'asc')
			{
				
				$basearray->orderBy('title','asc');
			}
				if($order[0]['column'] == 1 && $order[0]['dir'] == 'desc')
			{
				
				$basearray->orderBy('title','desc');
			}
			
			
		$counttotal =  Page::get()->count();
		$length = intval($request->get('length'));
		$length = $length < 0 ? $counttotal : $length; 
		
		    $resultset = $basearray->skip($request->get('start'))->take($length)->get();
		
		
		$i=intval($request->get('start'))+1;
		$GLOBALS['data'] = array();
			
				 $GLOBALS['total']=count($resultset);
				
				foreach($resultset as $task){
					
					
									$userId = \Crypt::encrypt($task->id);
								
					
					 $editurl = url(getenv('adminurl').'/pages/'.$userId.'/edit/');
					$view_link = '<a href="'.$editurl.'" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>';
					
					if($task->status== '1')
					{
						$status='<div class="statuscenter"><a  id="change-common-status" data-table="pages" data-id="'.$task->id.'" data-status="'.$task->status.'" data-action="Plans"><i class="fa fa-circle text-success active"></i><a></div>';
					}
					else{
						$status='<div class="statuscenter"><a  id="change-common-status" data-table="pages" data-id="'.$task->id.'" data-status="'.$task->status.'" data-action="Plans"><i class="fa fa-circle text-danger inactive"></i><a></div>';
					}
					
					$GLOBALS['data'][] = array($i,$task->title,$status,$view_link);

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
     * Created for: getting page for creating cms page
     * created date:November 2016
     */
    public function create()
    {
        try
		{
			$active = 'template';
			return view('admin.pages.create',compact('active'));
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'template'
            ];
			return view('errors.error', $result);
        }
    }

   /**
     * Created By: Jagraj Singh
     * Created for: creating cms page
     * created date:November 2016
     */
    public function store(PagesRequest $request)
    {
	    try
	    {
			$data = $request->all();
			//$testimonials = new Testimonials;
			$data['status'] = lcfirst($request->status);
			$data['title'] = lcfirst($request->title);
			$data['name'] = lcfirst($request->name);
			
			if(Page::create($data))
			{
				flash()->success('Your page has been created!!');
			}
			else
			{
				flash()->error('Sorry! Something went wrong.');
			}
		}
        catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
        return redirect(getenv('adminurl').'/pages');
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
    public function edit($id)
    {
        //
        try
        {
            //$id = base64_decode($id);
            $active = 'pages';
            $id  = \Crypt::decrypt($id);
            $active = 'pages';
            $page = Page::findOrfail($id);
          //  print_r($page); die();
            return view('admin.pages.edit', compact('page','active'));
        }
        catch (\Exception $e) 
		{ 
			if($e->getMessage() == 'The payload is invalid.')
			{
				$result = [
					'exception_message' => 'Page id is not defined',
					'active' => 'pages'
				]; 
			}
			else
			{
				$result = [
					'exception_message' => $e->getMessage(),
					'active' => 'pages'
				]; 
			}
            
			return view('errors.error', $result);
		}
    }

    

    /**
     * Created By: Jagraj Singh
     * Created for: updating a page
     * created date:November 2016
     */
    public function update($id, PagesRequest $request)
    {
        //
        try
        {
            //$id = base64_decode($id);
            $active = 'pages';
            $id = \Crypt::decrypt($id);
            //$check = Page::where('status','!=','2')->where('title',$request->title)->where('id','!=',$id)->count();
            //die();
           // if($check == 0)
            //{
                $pages = Page::findOrfail($id);

                $data = $request->all();

              //  print_r($data); die;
                $pages['title'] = $request->title;
                $pages['name'] = $request->name;
                $pages['content'] = $request->content;
                $pages['meta_title'] = $request->meta_title;
                $pages['alias'] = $request->alias;
                $pages['meta_description'] = $request->meta_description;
                $pages['meta_tags'] = $request->meta_tags;
                $pages['status'] = $request->status;
                if($pages->update())
                {
                    flash()->success('Your page has been updated!!');
                    return redirect(getenv('adminurl').'/pages');
                }
               // else
               // {
                //    flash()->error('Sorry! Something went wrong.');
                //    return redirect('admin/pages/'.base64_encode($id).'/edit');
               // }
            //}
            else
            {
                flash()->error('Page already exist');
                return redirect(getenv('adminurl').'/pages/'.base64_encode($id).'/edit');
            }
        }
        catch (\Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'pages'
           ];
            return view('errors.error', $result);
        }
        return redirect(getenv('adminurl').'/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $id = base64_decode($id);
		try
		{
			if(Page::destroy($id))
			{
				flash()->success('Page has been deleted!!');
			}
			else
			{
				flash()->error('Sorry! Something went wrong.');
			}
		}
        catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage(),
                'action'=>'dashboard'
            ];
			return view('errors.error', $result);
        }
        return redirect(getenv('adminurl').'/pages');
    }
    
    
}
