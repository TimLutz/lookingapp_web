<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class PhotosController extends Controller
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
            $active = 'photos';
            $photos = User::where(['role'=>2])->paginate(10);
            return view('admin.photos.index', compact('photos','active'));
        } catch (Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'photos'
            ];
            return view('errors.error', $result);
        }
    }


    /********
     * created by: Lovepreet Singh
     * Created for: Listing Unban Users in datatable with filters using ajax 
     * 
     *********/
    public function postListAllPhotos(Request $request)
    {
         $basearray = User::where(['role'=>2,'photo_change'=>1]);
          $totalusercount = DB::table('users')->where(['role'=>2,'photo_change'=>1])->count();
        
        /*****************Below code is for filtering ****************/
        /*if(isset($request->name) && !empty($request->name))
        {
            
            $basearray->where('screen_name','LIKE','%'.$request->name.'%');
        }
        if(isset($request->email) && !empty($request->email))
        {
            
            $basearray->where('email','LIKE','%'.$request->email.'%');
        }
        if(isset($request->profile_id) && !empty($request->profile_id))
        {
            
            $basearray->where('profile_id','LIKE','%'.$request->profile_id.'%');
        }*/

        /*****************Below code is for Sorting ****************/
        
        /*$order = $request->get('order');
            
            if($order[0]['column'] == 2)
            {
                $basearray->orderBy('screen_name',$order[0]['dir']);
            }
            elseif($order[0]['column'] == 3)
            {
                $basearray->orderBy('profile_id',$order[0]['dir']);
            }
            else if($order[0]['column'] == 4)
            {
                $basearray->orderBy('email',$order[0]['dir']);
            }
            else if($order[0]['column'] == 5)
            {
                $basearray->orderBy('member_type',$order[0]['dir']);
            }
            else if($order[0]['column'] == 6)
            {
                $basearray->orderBy('created_at',$order[0]['dir']);
            }
            else if($order[0]['column'] == 7)
            {
                $basearray->orderBy('valid_upto',$order[0]['dir']);
            }
            else
            {
                $basearray->orderBy('id','desc');
            }*/
            
            
        $counttotal =  User::where(['role'=>2,'photo_change'=>1])->get()->count();
        $length = intval($request->get('length'));
        $length = $length < 0 ? $counttotal : $length; 
        
            $resultset = $basearray->skip($request->get('start'))->take($length)->get();
        
        
        $i=intval($request->get('start'))+1;
        $GLOBALS['data'] = array();
            
        $GLOBALS['total']=count($resultset);
        
        foreach($resultset as $value){
            $userId = \Crypt::encrypt($value->id);
            $status = $createDate = '';
            /*if($value->status== '1')
            {
                $status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$value->id.'" data-status="'.$value->status.'" data-action="Plans"><i class="fa fa-check-circle text-success active"></i><a></div>';
            }
            else{
                $status='<div class="statuscenter"><a  id="change-common-status" data-table="users" data-id="'.$value->id.'" data-status="'.$value->status.'" data-action="Plans"><i class="fa fa-check-circle text-danger inactive"></i><a></div>';
            }*/

            
            if($value->profile_pic_date)
            {
                $createDate = date('Y-m-d H:i:s',strtotime($value->profile_pic_date));
            }

            if($value->profile_pic)
            {
                $imagee = '<img class="img-circle" src="'.$value->profile_pic.'" alt="User Image" width="50px" height="50">';
            }
            else
            {
                $imagee = '<img class="img-circle" src="'.url('images/no_image.png').'" alt="User Image" width="50px" height="50">';
            }                   
            $GLOBALS['data'][] = array($i,$imagee,$value->email,$createDate,$status);
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
}
