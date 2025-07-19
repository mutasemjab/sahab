<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Adv;
use App\Models\Banner;
use App\Models\Event;
use App\Models\PublicSession;
use App\Models\Service;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
       $about = About::first();
       $banners = Banner::get();
       $services = Service::get();
       $publicSessions = PublicSession::get();
       $projects = Projects::get();
       $advs = Adv::get();
       $locale = app()->getLocale();
        return view('user.home',compact('banners','about','services','publicSessions','projects','advs','locale'));
    }
    
    public function getAboutUs()
    {
        $about = About::first();
        return view('user.about');
    }



   
}