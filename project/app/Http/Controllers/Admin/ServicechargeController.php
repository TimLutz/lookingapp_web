<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Servicecharge;

class ServicechargeController extends Controller
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
            $active = 'charges';
            
            $charges = Servicecharge::where('status','1')->first();
            if($charges)
            {
                return view('admin.charges.index',compact('active','charges'));
            } 
            else
            {
                return view('admin.charges.index',compact('active','charges'));
            }
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error',$result);          
        }
    }

    public function postUpdatecharges(Requests\ChargesRequest $request)
    {
        try {
               $charge = Servicecharge::where('status','1')->first();
               if($charge)
               {
                $charge->charges = $request->charges;
                if($charge->update())
                {
                    flash()->success('Charges has been updated!!');
                            
                }
                else
                {
                    flash()->error('Charges not be updated!!');
                }
               }
               else
               {
                    $charge1 = new Servicecharge();
                    $charge1->charges = $request->charges;
                    $charge1->status = '1';
                    if($charge1->save())
                    {
                        flash()->success('Charges has been updated!!');
                    }
               }
           } catch (Exception $e) {
               $result = [
                            'exception_message'=>$e->getMessage()
                         ];
                return view('errors.error',$result);         
           }   
        return redirect('admin/charges');
    }
   
}
