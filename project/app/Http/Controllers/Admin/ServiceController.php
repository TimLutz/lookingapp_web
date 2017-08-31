<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use Request as AjaxRequest;
use Flash;
use App\Services;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try
        {
            $active= 'services';
            $services = Services::where('status','!=','2')->get();       
            //print_r($services); die();
            return view('admin.services.index', compact('services','active'));
        }
        catch (\Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage()
            ];
            return view('errors.error', $result);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try {
            $active= 'services';
            return view('admin.services.create', compact('active'));    
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error', $result);          
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        //
        try 
        {  
            $services = new Services; 
            $services->name = $request->name;
            $chck_num = Services::where('status','!=','2')->where('name',$services->name)->count();
            if($chck_num == 0)
            {
                $services->price = $request->price;
                $services->description = $request->description;
                $services->eta = $request->eta;
                $services->status = $request->status;
                if($services->save())
                {
                    flash()->success('Your Service has been created!!');
                    return redirect('admin/services');    
                }
                else
                {
                    flash()->error('Your Service has not be created!!');
                    return redirect('admin/services/create');
                }
            }
            else
            {
                flash()->error('Service already exist!!');
                return redirect('admin/services');
            }
            //$services = Services::create($request->all());
                
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error', $result);          
        }
        
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
        try {
            //$id=base64_decode($id);
            $id = \Crypt::decrypt($id);
            $active= 'services';
            $services = Services::findOrfail($id);
            return view('admin.services.edit', compact('services','active'));    
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error', $result);  
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        //
        try {
            //$id=base64_decode($id);
            $id = \Crypt::decrypt($id);
            $chck_num = Services::where('status','!=','2')->where('name',$request->name)->where('id','!=',$id)->count();
            if($chck_num == 0)
            {
                $services = Services::findOrfail($id);
                $services->name = $request->name;
                $services->price = $request->price;
                $services->description = $request->description;
                $services->eta = $request->eta;
                $services->status = $request->status;
                $services->update();
                flash()->success('Your services has been updated!!');
                return redirect('admin/services');   
            }
            else
            {
                flash()->error('services aleardy exist!!');
                return redirect('admin/services/'.base64_encode($id).'/edit');      
            }
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage()
                      ];
            return view('errors.error', $result);  
        }
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
