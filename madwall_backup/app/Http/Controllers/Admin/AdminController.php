<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditAdminProfile;
use App\Http\Requests\Admin\ChangeAdminPassword;
use repositories\MadWallGlobalInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
use Hash;
use Auth;
// Admin controller
class AdminController extends Controller
{
    
    protected $common;
    public function __construct( Guard $auth ) {
        $this->auth = $auth;
        $this->middleware('admin');
    }

    /**
    * Show The Form for Editing.
    * @return \Illuminate\Http\Response
    */
    public function index() {
        try { 
            return view( 'admin/edit' );
        } catch( \Exception $e ) {
            $result = [
                'exception_message'		=> $e->getMessage(),
                'active'				=> 'dashboard'
            ];
            return view( 'errors.error', $result );
        }
    }

    /**
    * Update The Username and Profile Pic 
    * @param App\Http\Requests\Auth\EditAdminProfile;
    */  
    public function editProfile( EditAdminProfile $request ) {
        try {
            $user = Auth::user();//->first_name;
            $data = $request->all();
            $data['first_name'] = $request->input( 'first_name');
            $data['last_name'] = $request->input( 'last_name') ;
            $img = Input::file('pic');
            if( $img != '' ) { 
                $image	= $img->getClientOriginalName();
                $path 	= 'uploads/';
                $img->move( base_path( $path ), $image );
                $data['image'] = $image;
            }
            
            if( $user->update( $data ) ) {
                flash()->success( 'Profile Updated successfully' );
                return redirect( url( 'admin/view-profile' ) );
            } else {
                flash()->error( 'Profile can not be updated' );
                return redirect( url( 'admin/view-profile' ) );
            }
        } catch( \Exception $e ) {
            $result = [
                'exception_message'	=> $e->getMessage()
            ];
            return view( 'errors.error', $result );
        }  
    }

    /**
    * Load View for Chage Password
    */ 
    public function ViewChangePassword(){
        try {
            return view( 'admin/change-password' );
        } catch( \Exception $e ) {
            $result = [
                'exception_message'     => $e->getMessage(),
                'active'                => 'dashboard'
            ];
            return view( 'errors.error', $result );
        }
    }

    /**
    * Change Password
    * @param App\Http\Requests\Auth\ChangeAdminPassword;
    */ 
    public function ChangePassword( ChangeAdminPassword $request ) {

        try {
            $user = Auth::user();
            if( Hash::check( $request->old_password, Auth::user()->password ) ) {
                if( Hash::check( $request->password, Auth::user()->password ) ) {
                    flash()->error( 'Sorry, Please choose different password');
                    return redirect( url( 'admin/view-change-password' ) );   
                } else {
                    $data['password'] = bcrypt( $request->password );
                   if( $user->update( $data ) ) {
                        flash()->success( 'Password Updated successfully' );
                        return redirect( url( 'admin/view-change-password') );
                   } else {
                        flash()->error( 'Sorry, Password can not be Changed' );
                        return redirect( url( 'admin/view-change-password' ) );
                    }
                }
            } else {
                flash()->error( 'Old password is not correct.' );
               // return redirect( url( 'admin/view-change-password' ) );
               return redirect()->back()->withInput();
            }
        } catch ( \Exception $e ) {
            $result = [
                'exception_message' => $e->getMessage()
            ];
            return view( 'errors.error', $result );
        }
    }

}
