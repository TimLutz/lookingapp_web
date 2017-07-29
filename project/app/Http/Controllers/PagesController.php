<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;

class PagesController extends Controller
{
    /**
     * Created by: Jagraj Singh	
     * Created on: 7 dec 2016
     * purpose: privacy policy page
     */
    public function getPrivacypolicy()
    {
        $privacy = Page::where('id',2)->first();
        return view('pages.privacy',compact('privacy'));
    }
    
    /**
     * Created by: Jagraj Singh	
     * Created on: 7 dec 2016
     * purpose: Terms and Condition page
     */
    public function getTandc()
    {
        $privacy = Page::where('id',4)->first();
        return view('pages.privacy',compact('privacy'));
    }
    
     /**
     * Created by: Jagraj Singh	
     * Created on: 7 dec 2016
     * purpose: Terms and Condition page
     */
    public function getLicense()
    {
        $privacy = Page::where('id',5)->first();
        return view('pages.privacy',compact('privacy'));
    }

}
