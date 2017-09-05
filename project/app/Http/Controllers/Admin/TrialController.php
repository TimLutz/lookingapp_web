<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\TrialModel;
use Response;
use DB;
use App\Http\Requests\TrailsRequest;
class TrialController extends Controller
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
            $active= 'trials';
            $users = TrialModel::paginate(10);

            return view('admin.trial.index', compact('users','active'));
        } catch (\Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'trials'
            ];
            return view('errors.error', $result);
        }
    }

    /********
     * created by: Lovepreet Singh
     * Created for: Listing Trails 
     * 
     *********/
    public function postListAllTrials(Request $request)
    {
        $basearray = DB::table('trials');
        $totalusercount = DB::table('trials')->count();
        $counttotal =  TrialModel::get()->count();
        $length = intval($request->get('length'));
        $length = $length < 0 ? $counttotal : $length; 
        $resultset = $basearray->skip($request->get('start'))->take($length)->get();
        $i=intval($request->get('start'))+1;
        $GLOBALS['data'] = array();
        $GLOBALS['total']=count($resultset);
        foreach($resultset as $value){
            $trialId = \Crypt::encrypt($value->id);
                $url = url(getenv('adminurl').'/trials/edit/'.$trialId);
                $edit = '<div class="statuscenter"><a href="'.$url.'"><i class="fa fa-pencil text-warning"></i><a></div>';
            $GLOBALS['data'][] = array($i,$value->days,$edit);
            $i++;
        }
        $result = array();
        $result['data'] = $GLOBALS['data'];
        $result['draw'] = intval($request->get('draw'));
        $result['recordsTotal'] = $basearray->count();
        $result['recordsFiltered'] =$totalusercount;
        
        return json_encode($result);
    }

    /********
     * created by: Lovepreet Singh
     * Created for: function for load the edit view
     * 
     *********/
    public function getEdit($id)
    {
        try {
            $active = 'trials';
            $id = \Crypt::decrypt($id);
            $trials = TrialModel::find($id);
            return view('admin.trial.edit',compact('active','trials'));
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

    /********
     * created by: Lovepreet Singh
     * Created for: function for update record
     * 
     *********/
    public function postUpdate(TrailsRequest $request,$id)
    {
        try
        {
            $active= 'trials';
            $id = \Crypt::decrypt($id);
            $data = $request->all();
            
            $trials = TrialModel::findOrfail($id);
            if($trials->update($request->all()))
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
                'active' => 'trials'
            ];
            return view('errors.error', $result);
        }
        return redirect(getenv('adminurl').'/trials');
    }
}
