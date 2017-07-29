<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Settings;


class SettingsController extends Controller
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
            $active = 'settings';
            $settings = Settings::where('type','number')->orWhere('type','address_location')->orWhere('type','text_quote')->orWhere('type','home_page')->orWhere('type','shed_designer')->orWhere('type','financing')->orWhere('type','move_buy_sheds')->orWhere('type','informational_videos')->orWhere('type','text_videos')->get();
            return view('admin.settings.index',compact('active','settings'));
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage() 
                      ];
            return view('errors.error',$result);          
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        try {
            $active= 'settings';
            return view('admin.settings.add',compact('active'));
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage() 
                      ];
            return view('errors.error',$result);          
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\SettingRequest $request)
    {
        //
        try {
            $active = 'settings';
            $data = $request->all();
            $settings = new Settings();
            
            $chk = Settings::where('status','!=',2)
                            ->where('title',$request->title)
                            ->where('mode_type',$request->mode_type)
                            ->count();
                            
            if($chk == 0)
            {
                $data['title'] = lcfirst($request->title);
                $settings = Settings::create($data);
                if($settings)
                {
                  flash()->success('Insert record successfully');
                  return redirect('admin/settings');
                }
                else
                {
                  flash()->error('Record not insert!');
                  return redirect('admin/settings/create');
                }
            }
            else
            {
              flash()->error('Item already exist!');
              return redirect('admin/settings');
            }                            
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage() 
                      ];
            return view('errors.error',$result);          
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
            $id = \Crypt::decrypt($id);
            $active = 'settings';
            $settings = Settings::findOrfail($id);
            return view('admin.settings.edit',compact('active','settings'));
        } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage() 
                      ];
            return view('errors.error',$result); 
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\EditsettingRequest $request, $id)
    {
        
         try {
					$id = \Crypt::decrypt($id);
            
           
                $settings = Settings::findOrfail($id);
                $data = $request->all();
               
                $settings = $settings->update($data);
                if($settings)
                {
                    flash()->success('Update record successfully');
                    return redirect('admin/settings');
                }
                else
                {
                    flash()->error('Record not updated!');
                    return redirect('admin/settings/'.Crypt::decrypt($id).'/edit');
                }
            } catch (Exception $e) {
            $result = [
                        'exception_message'=>$e->getMessage() 
                      ];
            return view('errors.error',$result); 
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
