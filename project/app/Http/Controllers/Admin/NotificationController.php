<?php

namespace App\Http\Controllers\Admin;


use repositories\CommonRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;
use repositories\CommonRepositoryInterface;

use App\models\Notificationadmin;

use App\User;
use App\models\Document;
use DB;
use Input;
use Mail;
use View;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Created By: Jagraj Singh
     * Created for: for changing notification status
     * created date:Jan 2017
     */
    public function changestatus(Request $request)
    {
     
			$id = \Crypt::decrypt($request->id);
			$notification = Notificationadmin::find($id);
			$notification->status = 0;
			$notification->update();
			
			 
			
			$notifications = Notificationadmin::where('status','=',1)->orderBy('id','desc')->get();
			 $view = view('admin.notificationpopup',compact('notifications'))->render();
			 $response['htmlnoti'] = $view;
			 $response['success'] = true;
			return response()->json($response);
		
    }
    

}
