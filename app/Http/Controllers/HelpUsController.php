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

class HelpUsController  extends Controller
{
      public function index()
    {
        $services = Service::all();
        return view('user.help-us', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|string',
            'gender' => 'required|integer|in:1,2',
            'service_id' => 'required|exists:services,id',
            'opinion' => 'required|integer|in:1,2,3,4,5',
            'question' => 'required|string',
            'how_much_use_this_service' => 'required|integer|in:1,2,3,4',
            'Do_you_need_accessibility' => 'required|array',
            'note' => 'nullable|string',
            'hide_information' => 'boolean'
        ]);

        // Convert accessibility array to integer
        $accessibility = 0;
        if (in_array('1', $request->Do_you_need_accessibility)) $accessibility += 1;
        if (in_array('2', $request->Do_you_need_accessibility)) $accessibility += 2;
        if (in_array('3', $request->Do_you_need_accessibility)) $accessibility += 4;
        if (in_array('4', $request->Do_you_need_accessibility)) $accessibility = 0;

        Suggestion::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'age' => $request->age,
            'gender' => $request->gender,
            'service_id' => $request->service_id,
            'opinion' => $request->opinion,
            'question' => $request->question,
            'how_much_use_this_service' => $request->how_much_use_this_service,
            'Do_you_need_accessibility' => $accessibility,
            'note' => $request->note ?? '',
            'hide_information' => $request->has('hide_information') ? 2 : 1,
            'status' => 1
        ]);

        return redirect()->route('helpus')->with('success', __('front.suggestion_submitted_successfully'));
    }
  
   
}