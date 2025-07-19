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
            'gender' => 'required|in:1,2',
            'note' => 'required|string',
            'hide_information' => 'required|in:1,2',
        ]);

        Suggestion::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'age' => $request->age,
            'gender' => $request->gender,
            'note' => $request->note,
            'hide_information' => $request->hide_information,
            'status' => 1, // Default to pending
        ]);

        return redirect()->back()->with('success', __('front.suggestion_sent_successfully'));
    }

  
   
}