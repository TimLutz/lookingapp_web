<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Response;
use App\User;

class ProfiletextController extends Controller
{

    public function getIndex()
    {
        try
        {
            $active= 'profiletext';
            $users = User::where(['role'=>2,'profiletext_change'=>1])->paginate(10);
            return view('admin.users.profileindex',compact('users','active'));
        }
        catch (\Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'profiletext'
            ];
            return view('errors.error', $result);
        }
    }

    public function postListAllProfile(Request $request)
    {
        try {
            $basearray = User::with(['Profile'])->where(['role'=>2,'profiletext_change'=>1]);
            $totalusercount = DB::table('users')->where(['role'=>2,'profiletext_change'=>1])->count();
            
            /*****************Below code is for filtering ****************/
            
            if(isset($request->email) && !empty($request->email))
            {
                $basearray->where(function($q) use ($request){
                    $q->OrWhere('email','LIKE','%'.$request->email.'%')
                      ->orWhere('screen_name','LIKE','%'.$request->email.'%');
                });    
            }
            
            /*****************Below code is for Sorting ****************/
            
            $order = $request->get('order');
                
                
            if($order[0]['column'] == 3)
            {
                $basearray->orderBy('email',$order[0]['dir']);
            }
            else if($order[0]['column'] == 4)
            {
                $basearray->orderBy('profile_text_change_date',$order[0]['dir']);
            }
            else
            {
                $basearray->orderBy('id','desc');
            }
                
                
            $counttotal =  User::where(['role'=>2,'profiletext_change'=>1])->get()->count();
            $length = intval($request->get('length'));
            $length = $length < 0 ? $counttotal : $length; 
            
                $resultset = $basearray->skip($request->get('start'))->take($length)->get();
            
            
            $i=intval($request->get('start'))+1;
            $GLOBALS['data'] = array();
                
            $GLOBALS['total']=count($resultset);
            
            foreach($resultset as $value){
                $userId = \Crypt::encrypt($value->id);
                     
                    $status='<div class="statuscenter"><a  id="change-profiletex-status" data-table="users" data-id="'.$userId.'" data-profilestatus="'.$value->profiletext_change.'" data-action="Plans" class="current_users" title="Change Status to Approve"><i class="fa fa-check-circle"></i><a><a  id="change-common-status" data-table="users" data-id="'.$value->id.'" data-status="'.$value->status.'" data-action="Plans" title="Change Status to Ban"><i class="fa fa-ban"></i><a></div>';
                

                $aboutMe = $createDate = '';
                

                if(count($value->Profile))
                {
                    if(strlen($value->Profile->about_me) > 47)
                    {
                        $encrypt = \Crypt::encrypt($value->Profile->id);
                        $aboutMe = substr($value->Profile->about_me,0,47)."<br><a href='javascript:void(0)' class='profiledata' profile='".$encrypt."'>read more..</a>";
                    }
                    else
                    {
                        $aboutMe = $value->Profile->about_me;
                    }
                }

                if($value->profile_text_change_date)
                {
                    $createDate = date('Y-m-d H:i:s',strtotime($value->profile_text_change_date));
                }

                if($value->profile_pic)
                {
                    $imagee = '<img class="img-circle" src="'.$value->profile_pic.'" alt="User Image" width="50px" height="50">';
                }
                else
                {
                    $imagee = '<img class="img-circle" src="'.url('images/no_image.png').'" alt="User Image" width="50px" height="50">';
                }                   
                $GLOBALS['data'][] = array($i,$imagee,$aboutMe,$value->email,$createDate,$status);
                $i++;
            }
            $result = array();
            $result['data'] = $GLOBALS['data'];
            $result['draw'] = intval($request->get('draw'));
            $result['recordsTotal'] = $basearray->count();
            $result['recordsFiltered'] =$totalusercount;
            
            return json_encode($result);
        } catch (\Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'profiletext'
            ];
            return view('errors.error', $result);
        }
    }

    public function postChangeStatus(Request $request) {

        try {
            $data = $request->all();
            $id = \Crypt::decrypt($data['id']);
            if(!empty($id))
            {
                $status = User::find($id);
                if($status)
                {
                    if($data['status'] == 0)
                    {
                        $data['status']= 1;
                    }
                    else
                    {
                        $data['status']= 0;   
                    }
                    
                    if($status->update(['status'=>$data['status'],'profiletext_change'=>0]))
                    {
                        return response()->json(['success'=>true,'action' => $request['action']]);
                    }
                    else
                    {
                        return response()->json(['success'=>false,'action' => $request['action']]);
                    }
                }
                else
                {
                    return response()->json(['success'=>false,'action' => $request['action']]);
                }
            }
            else
            {
                return response()->json(['success'=>false,'action' => $request['action']]);
            }
        } catch (Exception $e) {
            return response()->json(['success'=>false,'action' => $request['action']]);
        }

        return response()->json($response,$http_status);
    }

    public function postChangeText(Request $request) {
        
        try {
            $data = $request->all();
            $id = \Crypt::decrypt($data['id']);
            if(!empty($id))
            {
                $status = User::find($id);
                if($status)
                {
                    if($data['status'] == 0)
                    {
                        $data['status']= 1;
                    }
                    else
                    {
                        $data['status']= 0;   
                    }
                    
                    if($status->update(['profiletext_change'=>0]))
                    {
                        return response()->json(['success'=>true,'action' => $request['action']]);
                    }
                    else
                    {
                        return response()->json(['success'=>false,'action' => $request['action']]);
                    }
                }
                else
                {
                    return response()->json(['success'=>false,'action' => $request['action']]);
                }
            }
            else
            {
                return response()->json(['success'=>false,'action' => $request['action']]);
            }
        } catch (Exception $e) {
            return response()->json(['success'=>false,'action' => $request['action']]);
        }

        return response()->json($response,$http_status);
    }

}
