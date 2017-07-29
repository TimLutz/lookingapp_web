<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Addresslocation;
use App\Http\Requests\AddresslocationRequest;
use App\Http\Requests\AddresslocationeditRequest;

class AddresslocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $active = 'location';
            $locations = Addresslocation::where('status','!=',2)->get();
            
            return view('admin/locations/index',compact('active','locations'));
        } catch (\Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'dashboard'
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
            $active = 'location';
            return view('admin/locations/create',compact('active'));
        } catch (Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'dashboard'
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
    public function store(AddresslocationRequest $request)
    {
        //
        try {
            $check_name = $request->loc_name;
            $check_about = Addresslocation::where('loc_name',$check_name)->count();
            if($check_about == 0)
            {
               $data = $request->all();
               $img = $data['imagepro'];
               
                $dir = 'tmp/';
                rename($dir.$img,'uploads/'.$img);
                $data['image'] = $img;
               $location = Addresslocation::create($data);
               
               flash()->success('Your location has been created!!');
               return redirect('admin/location');     
           }
            else
            {
            flash()->error('Fail!! Location already taken');
            return back()->withInput();
            }
        } catch (Exception $e) {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'dashboard'
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
         try
        {
        $loc_id = \Crypt::decrypt($id);
        $active= 'location';
        
            $location = Addresslocation::findOrfail($loc_id);
         return view('admin.locations.edit', compact('active','location'));
         }
        catch (\Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'staff'
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
    public function update(Addresslocationeditrequest $request, $id)
    {
        //
         try
        {
            $loc_id = \Crypt::decrypt($id);
            
             $check_name = $request->loc_name;
        $check_about = Addresslocation::where('loc_name',$check_name)->where('id','!=',$loc_id)->count();
         
         if($check_about == 0)
        {
        
            $data = $request->all();
            $location= Addresslocation::findOrfail($loc_id);
            if(isset($data['imagepro']))
            {    
                $img = $data['imagepro'];
                if($location->image)
                {
                    if(file_exists('uploads/'.$location->image))
                    {
                        $deleted_image = unlink('uploads/'.$location->image);
                    } 
                }
                $dir = 'tmp/';
                rename($dir.$img,'uploads/'.$img);
                $data['image']= $img;
            }
            $result = $location->update($data);
            if($result)
            {
                flash()->success('Location has been updated!!');
            }
            else
            {
                flash()->error('Something went wrong!! updation failed');
            }
            return redirect('admin/location'); 
            }
            else
            {
            flash()->error('Fail!! Location already taken');
            return back()->withInput();
            }
            
            
        
        }
        catch (Exception $e) 
        {
            $result = [
                'exception_message' => $e->getMessage(),
                'active' => 'staff'
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
