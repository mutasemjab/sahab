<?php

namespace App\Http\Controllers;

use App\Models\CommunityInitiatives;
use App\Models\CommunityInitiativesUser;
use App\Models\PublicSession;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CommunityController extends Controller
{
    public function index()
    {
        // Get initiatives with supporter count
        $initiatives = CommunityInitiatives::withCount('supportingUsers')
                                        ->orderBy('created_at', 'desc')
                                        ->take(6)
                                        ->get();

        $publicSessions = PublicSession::orderBy('date_of_event', 'asc')
                                     ->take(6)
                                     ->get();

        return view('user.community', compact('initiatives', 'publicSessions'));
    }

    public function supportInitiative(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false, 
                'message' => __('front.login_required')
            ]);
        }

        $initiative = CommunityInitiatives::findOrFail($id);
        
        // Check if user already supports this initiative
        $existingSupport = CommunityInitiativesUser::where('user_id', Auth::id())
                                                 ->where('community_initiative_id', $id)
                                                 ->first();
        
        if ($existingSupport) {
            return response()->json([
                'success' => false, 
                'message' => __('front.already_supported')
            ]);
        }

        // Create new support record
        CommunityInitiativesUser::create([
            'user_id' => Auth::id(),
            'community_initiative_id' => $id,
        ]);

        // Get updated supporter count
        $newSupporterCount = CommunityInitiativesUser::where('community_initiative_id', $id)->count();
        
        return response()->json([
            'success' => true, 
            'message' => __('front.initiative_supported'),
            'new_count' => $newSupporterCount
        ]);
    }

}