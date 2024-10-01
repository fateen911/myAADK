<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingV1(){
        return view('landing_page.version_1');
    }
    public function landingV2(){
        return view('landing_page.version_2');
    }
    public function landingV3(){
        return view('landing_page.version_3');
    }
}
