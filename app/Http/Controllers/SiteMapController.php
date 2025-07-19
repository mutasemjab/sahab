<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Adv;
use App\Models\Banner;
use App\Models\CompleteAbout;
use App\Models\Event;
use App\Models\Law;
use App\Models\MunicipalCouncil;
use App\Models\OurPart;
use App\Models\PublicSession;
use App\Models\Service;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteMapController extends Controller
{
    public function index()
    {
        return view('user.site-map');
    }
    
   
}