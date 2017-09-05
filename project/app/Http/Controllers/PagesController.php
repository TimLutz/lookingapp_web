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
    /*public function getTandc()
    {
        $privacy = Page::where('id',6)->first();
        return view('pages.privacy',compact('privacy'));

    }*/
    
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

    /**
     * Name: getTermsAndCondition
     * Purpose: function for getting view of term and conditions
     * created By: Lovepreet
     * Created on :- 24 Aug 2017
     *
     **/
    public function getTandc()
    {
        $privacy = Page::where(['id'=>6])->first();
        return  view('pages.privacy',compact('privacy'));
    }

}
