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
            $active= 'free';
            $reports = FlagModel::paginate(10);
            return view('admin.reports.index',compact('reports','active'));
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

    public function postAllCurrentUsers($value='')
    {
        try {
            $data = $request->all();
            $basearray = FlagModel::whereHas('flagUser',function($q){
                  $q->where('status',1);
                })->whereHas('flagReceiverUser',function($q){
                  $q->where('status',1);
                })->with(['flagUser'=>function($q1){
                    $q1->where(['status'=>1])->select('id','email');//->get();
                }
                ,'flagReceiverUser'=>function($q2){
                    $q2->where(['status'=>1])->select('id','email');//->get();
                }])->where(['archive'=>0]);

            $totalusercount = FlagModel::whereHas('flagUser',function($q){
                                  $q->where('status',1);
                                })->whereHas('flagReceiverUser',function($q){
                                  $q->where('status',1);
                                })->where(['archive'=>0])->count(); 

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
                    $status='<div class="statuscenter"><a href="'.$url.'"><i class="fa fa-pencil"></i><a></div>';
                    $status='<div class="statuscenter"><a ></a><a  id="change-common-status" data-table="users" data-id="'.$value->id.'" data-status="'.$value->status.'" data-action="Plans"><i class="fa fa-check-circle text-success"></i><a></div>';
                $fromEmail = $toEmail = '';
                if($value->flagUser)
                {
                    $fromEmail = $value->flagUser->email;    
                }

                if($value->flagUser)
                {
                    $toEmail = $value->flagReceiverUser->email;    
                }              
                $GLOBALS['data'][] = array($i,$fromEmail,$toEmail,$value->flag,$status);
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
}
