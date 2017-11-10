<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\FlagModel;

class UserReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //
        try
        {
            $active= 'current';
            $reports = FlagModel::paginate(10);
            return view('admin.reports.index',compact('reports','active'));
        }
        catch (\Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'current'
            ];
            return view('errors.error', $result);
        }
    }

    public function postAllCurrentUsers(Request $request)
    {
        /*try {*/
        $data = $request->all();
        $basearray = FlagModel::whereHas('flagUser',function($q) use ($data){
              if(isset($data['senderemail']) && !empty($data['senderemail']))
              {
                    $q->where('email','LIKE','%'.$data['senderemail'].'%');
              }  
            })->whereHas('flagReceiverUser',function($q) use ($data){
                if(isset($data['recevieremail']) && !empty($data['recevieremail']))
                {
                    $q->where('email','LIKE','%'.$data['recevieremail'].'%');
                }
              $q->where('status',1);
            })->with(['flagUser'=>function($q1) use ($data){
                $q1->where(['status'=>1])->select('id','email');//->get();
            }
            ,'flagReceiverUser'=>function($q2) use ($data){
                $q2->where(['status'=>1])->select('id','email','status');//->get();
            }])->where(['archive'=>0]);

        $totalusercount = FlagModel::whereHas('flagUser',function($q){
                              $q->where('status',1);
                            })->whereHas('flagReceiverUser',function($q){
                              $q->where('status',1);
                            })->where(['archive'=>0])->count(); 
        if(isset($request->flag) && !empty($request->flag))
        {
            $basearray->where('flag','LIKE','%'.$request->flag.'%');
        }

        $order = $request->get('order');
        if($order[0]['column'] == 3)
        {
            $basearray->orderBy('flag',$order[0]['dir']);
        }
        else
        {
            $basearray->orderBy('id','desc');
        }                    

        $counttotal =  FlagModel::whereHas('flagUser',function($q){
                              $q->where('status',1);
                            })->whereHas('flagReceiverUser',function($q){
                              $q->where('status',1);
                            })->where(['archive'=>0])->count();
        $length = intval($request->get('length'));
        $length = $length < 0 ? $counttotal : $length; 
        
        $resultset = $basearray->skip($request->get('start'))->take($length)->get();
        
        
        $i=intval($request->get('start'))+1;
        $GLOBALS['data'] = array();
            
        $GLOBALS['total']=count($resultset);
        
        foreach($resultset as $value){
            $r_Id = \Crypt::encrypt($value->id);
            $url = url(getenv('adminurl').'/userrestriction/edit/'.$r_Id); 
        
            
            $userId = \Crypt::encrypt($value->flagReceiverUser->id);         

            $emailTo = $emailrece = $userReceiver = '';
            if($value->flagUser)
            {
                $emailTo = $value->flagUser->email;
            }
            if($value->flagReceiverUser)
            {
                $emailrece = $value->flagReceiverUser->email;
                $userReceiver = $value->flagReceiverUser->id;
            }
            $status='<div class="statuscenter"><a  id="change-common-archive" data-table="users" data-id="'.$r_Id.'" data-status="'.$value->archive.'" data-action="Plans" class="current_users" title="Move to archive"><i class="fa fa-archive"></i><a><a  id="change-common-status" data-table="users" data-id="'.$userReceiver.'" data-status="'.$value->flagReceiverUser->status.'" data-action="Plans"><i class="fa fa-check-circle text-success" title="Change Status to ban"></i><a></div>';
            
            $GLOBALS['data'][] = array($i,$emailTo,$emailrece,$value->flag,date('Y-m-d H:i:s',strtotime($value->created_at)),$status);
            $i++;
        }
        $result = array();
        $result['data'] = $GLOBALS['data'];
        $result['draw'] = intval($request->get('draw'));
        $result['recordsTotal'] = $basearray->count();
        $result['recordsFiltered'] =$totalusercount;            
        return json_encode($result);
        /*} catch (Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'profiletext'
            ];
            return view('errors.error', $result);
        }*/
    }

    public function postArchiveStatus(Request $request)
    {
        try {
            $data = $request->all();
            $id = \Crypt::decrypt($data['id']);
            $archive = FlagModel::findOrfail($id); 
            if($archive)
            {
                if($archive->update(['archive'=>1]))
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
                
            }
        } catch (Exception $e) {
            return response()->json(['success'=>false,'action' => $request['action']]);
        }
    }

    public function getArchiveindex()
    {
        try
        {
            $active= 'Archive';
            $reports = FlagModel::paginate(10);
            return view('admin.reports.archiveindex',compact('reports','active'));
        }
        catch (\Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'free'
            ];
            return view('errors.error', $result);
        }
    }

    public function postAllArchivesUsers(Request $request)
    {
        /*try {*/
        $data = $request->all();
        $basearray = FlagModel::whereHas('flagUser',function($q) use ($data){
              if(isset($data['senderemail']) && !empty($data['senderemail']))
              {
                    $q->where('email','LIKE','%'.$data['senderemail'].'%');
              }  
            })->whereHas('flagReceiverUser',function($q) use ($data){
                if(isset($data['recevieremail']) && !empty($data['recevieremail']))
                {
                    $q->where('email','LIKE','%'.$data['recevieremail'].'%');
                }
              $q->where('status',1);
            })->with(['flagUser'=>function($q1) use ($data){
                $q1->where(['status'=>1])->select('id','email');//->get();
            }
            ,'flagReceiverUser'=>function($q2) use ($data){
                $q2->where(['status'=>1])->select('id','email','status');//->get();
            }])->where(['archive'=>1]);

        $totalusercount = FlagModel::whereHas('flagUser',function($q){
                            })->whereHas('flagReceiverUser',function($q){
                              $q->where('status',1);
                            })->where(['archive'=>1])->count(); 

        if(isset($request->flag) && !empty($request->flag))
        {
            $basearray->where('flag','LIKE','%'.$request->flag.'%');
        }

        $order = $request->get('order');
        if($order[0]['column'] == 3)
        {
            $basearray->orderBy('flag',$order[0]['dir']);
        }
        else
        {
            $basearray->orderBy('id','desc');
        }                    

        $counttotal =  FlagModel::whereHas('flagUser',function($q){
                            })->whereHas('flagReceiverUser',function($q){
                              $q->where('status',1);
                            })->where(['archive'=>0])->count();

        $length = intval($request->get('length'));
        $length = $length < 0 ? $counttotal : $length; 
        
        $resultset = $basearray->skip($request->get('start'))->take($length)->get();
        
        
        $i=intval($request->get('start'))+1;
        $GLOBALS['data'] = array();
            
        $GLOBALS['total']=count($resultset);
        
        foreach($resultset as $value){
            $emailTo = $emailrece = $userReceiver = '';
            if($value->flagUser)
            {
                $emailTo = $value->flagUser->email;
            }
            if($value->flagReceiverUser)
            {
                $emailrece = $value->flagReceiverUser->email;
                $userReceiver = $value->flagReceiverUser->id;
            }
            $status='<div class="statuscenter"><a id="change-common-status" data-table="users" data-id="'.$userReceiver.'" data-status="'.$value->flagReceiverUser->status.'" data-action="Plans"><i class="fa fa-check-circle text-success"></i><a></div>';
            $GLOBALS['data'][] = array($i,$emailTo,$emailrece,$value->flag,date('Y-m-d H:i:s',strtotime($value->created_at)),$status);
            $i++;
        }
        $result = array();
        $result['data'] = $GLOBALS['data'];
        $result['draw'] = intval($request->get('draw'));
        $result['recordsTotal'] = $basearray->count();
        $result['recordsFiltered'] =$totalusercount;            
        return json_encode($result);
        /*} catch (Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'profiletext'
            ];
            return view('errors.error', $result);
        }*/
    }
}
