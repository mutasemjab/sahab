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
       $publicSessions = PublicSession::orderBy('date_of_event','asc')->get();
       $projects = Projects::get();
       $advs = Adv::orderBy('date_of_adv','asc')->get();
       $locale = app()->getLocale();

        $events = Event::get()->map(function($event) use ($locale) {
            return [
                'date' => $event->date_of_event,
                'title' => $locale === 'ar' ? $event->title_ar : $event->title_en,
                'link_google_meet' => $event->link_google_meet
            ];
        });
    

        return view('user.home',compact('events','banners','about','services','publicSessions','projects','advs','locale'));
    }
    
    public function getAboutUs()
    {
        $about = About::first();
        return view('user.about');
    }



   
}