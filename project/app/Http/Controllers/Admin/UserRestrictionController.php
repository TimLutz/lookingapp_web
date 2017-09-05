<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\RestrictionModel;
use DB;
use App\Http\Requests\RestrictionRequest;
class UserRestrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        try
        {
            $active= 'free';
            $restrictions = RestrictionModel::paginate(10);
            return view('admin.user_restriction.index',compact('restrictions','active'));
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

    public function postListAllRestrictions(Request $request)
    {
        try {
            $data = $request->all();
            $basearray = RestrictionModel::where(['member_type'=>$data['type']]);
            $totalusercount = DB::table('user_restrictions')->where(['member_type'=>$data['type']])->count();   
            $counttotal =  RestrictionModel::where(['member_type'=>$data['type']])->get()->count();
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
                $limit = $value->limit;    
                if($value->limit==0)
                {
                    $limit = 'Unlimited';
                }                 
                $GLOBALS['data'][] = array($i,$value->limit_type,$limit,$status);
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

    public function getEdit($id)
    {
        try {
            $active = 'trials';
            $id = \Crypt::decrypt($id);
            $restriction = RestrictionModel::find($id);
            return view('admin.user_restriction.edit',compact('active','restriction'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            if($message == 'The payload is invalid.')
            {
                $message = "Invalid Id";
            }
            $result = [
                'exception_message' => $message,
                'active' => 'trials'
            ];
            return view('errors.error', $result);
        }
    }

    public function postUpdate(RestrictionRequest $request,$id)
    {
        try
        {
            $active= 'free';
            $id = \Crypt::decrypt($id);
            $data = $request->all();
            
            $restriction = RestrictionModel::findOrfail($id);
            if($restriction->update($request->all()))
            {
                flash()->success('Trails has been updated!!');
            }
            else
            {
                flash()->error('Trails can not be updated!!');
            }
        }
        catch (\Exception $e) 
        {
            $message = $e->getMessage();
            if($message == 'The payload is invalid.')
            {
                $message = 'Invalid Id';
            }
            $result = [
                'exception_message' => $message,
                'active' => 'free'
            ];
            return view('errors.error', $result);
        }
        return redirect(getenv('adminurl').'/userrestriction');
    }

    public function getPaid()
    {
        try
        {
            $active= 'free';
            $restrictions = RestrictionModel::paginate(10);
            return view('admin.user_restriction.paidindex',compact('restrictions','active'));
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
    
}
