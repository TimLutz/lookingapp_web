<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use DB;
//use App\models\ContactModel;
class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //
        try {
            $active = 'contact';
            $contact = \App\models\ContactModel::where(['status'=>1])->paginate(10);
            return view('admin.contact.index', compact('contact','active'));
        } catch (Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'photos'
            ];
            return view('errors.error', $result);
        }

    }


    public function postListAllContact(Request $request)
    {
        $basearray = \App\models\ContactModel::where(['status'=>1]);
        $totalusercount = \DB::table('contactus')->where(['status'=>1])->count();
        /*****************Below code is for filtering ****************/
        if(isset($request->name) && !empty($request->name))
        {
            
            $basearray->where('name','LIKE','%'.$request->name.'%');
        }
        if(isset($request->email) && !empty($request->email))
        {
            
            $basearray->where('email','LIKE','%'.$request->email.'%');
        }
        if(isset($request->phone) && !empty($request->phone))
        {
            
            $basearray->where('phone','LIKE','%'.$request->profile_id.'%');
        }

        /*****************Below code is for Sorting ****************/
        $order = $request->get('order');
            
        if($order[0]['column'] == 1)
        {
            $basearray->orderBy('name',$order[0]['dir']);
        }
        elseif($order[0]['column'] == 2)
        {
            $basearray->orderBy('email',$order[0]['dir']);
        }
        else if($order[0]['column'] == 3)
        {
            $basearray->orderBy('message',$order[0]['dir']);
        }
        else if($order[0]['column'] == 4)
        {
            $basearray->orderBy('phone',$order[0]['dir']);
        }
        else
        {
            $basearray->orderBy('id','desc');
        }
            
            
        $counttotal =  \App\models\ContactModel::where(['status'=>1])->get()->count();
        $length = intval($request->get('length'));
        $length = $length < 0 ? $counttotal : $length; 
        
        $resultset = $basearray->skip($request->get('start'))->take($length)->get();
        
        
        $i=intval($request->get('start'))+1;
        $GLOBALS['data'] = array();
            
        $GLOBALS['total']=count($resultset);
        
        foreach($resultset as $value){
            $contactId = \Crypt::encrypt($value->id);
            $message = $phone = 'NA';
            if(!empty($value->message))
            {
                $message = $value->message;
            }
            if(!empty($value->phone))
            {
                $phone = $value->phone;
            }
            $GLOBALS['data'][] = array($i,$value->name,$value->email,$message,$phone,"<a href='javascript:void(0)' class='viewquery' id='".$contactId."'><i class='fa fa-eye'></i></a>");
            $i++;
        }
        $result = array();
        $result['data'] = $GLOBALS['data'];
        $result['draw'] = intval($request->get('draw'));
        $result['recordsTotal'] = $basearray->count();
        $result['recordsFiltered'] =$totalusercount;
        
        return json_encode($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function update(Request $request, $id)
    {
        //
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

    public function postViewquery(Request $request)
    {
        try {
            $data = $request->all();
            $id = \Crypt::decrypt($data['type']);
            $contact = \App\models\ContactModel::find($id);
            $component = view('admin.contact.viewquery',compact('contact'))->render();
            $response['status'] = 1;
            $response['content'] = $component;
            return response()->json($response,200);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            if($message == 'The payload is invalid.')
            {
                $message = 'Invalid Id';
            }
            $response['status'] = 0;
            $response['message'] = $message;
            return response()->json($response,422);   
        }
    }
}
