<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Adv;
use App\Models\Banner;
use App\Models\CommunityInitiatives;
use App\Models\CompleteAbout;
use App\Models\Event;
use App\Models\Law;
use App\Models\MunicipalCouncil;
use App\Models\OurPart;
use App\Models\PublicSession;
use App\Models\Service;
use App\Models\Projects;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuggestionController  extends Controller
{
    public function index()
    {
        return view('user.suggest');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|string',
            'gender' => 'required|integer|in:1,2',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'hide_identity' => 'nullable|boolean',
        ]);

     try {
            CommunityInitiatives::create([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'date_finish' => now()->addMonth(), 
                'from_admin_or_user' => 2, // 2 = from user
                'name' => $request->name,
                'phone' => $request->phone,
                'age' => $request->age,
                'photo' => null, // No photo upload in this form
                'gender' => $request->gender,
                'hide_information' => $request->has('hide_identity') ? 1 : 2, // 1 = yes (hide), 2 = no (show)
                'status' => 1, // 1 = pending
            ]);

            return redirect()->route('suggestions.index')
                           ->with('success', __('front.suggestion_submitted_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', __('front.error_occurred'));
        }
    }
  
   
}