<?php

namespace App\Http\Controllers;

use App\Models\Adv;
use App\Models\News;
use App\Models\Gallery;
use App\Services\FacebookService;

class MediaCenterController extends Controller
{
   protected $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    
    public function index()
    {
        // Get latest advertisements with pagination (6 per page)
        $advertisements = Adv::orderBy('date_of_adv', 'desc')
                            ->paginate(6);
        
        // Get Facebook posts (limit to 3 for display)
        $facebookPosts = $this->facebookService->getPagePosts(3);
        
        return view('user.media-center', compact('advertisements', 'facebookPosts'));
    }

    // Add this new method for showing individual advertisement details
    public function show($id)
    {
        $advertisement = Adv::findOrFail($id);
        return view('user.adv-details', compact('advertisement'));
    }

}