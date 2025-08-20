<?php

namespace App\Http\Controllers;

use App\Models\CommunityInitiatives;
use App\Models\CommunityInitiativesUser;
use App\Models\PublicSession;
use App\Models\TopicDiscussion;
use App\Models\TopicDiscussionUser;
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

        // Get topic discussions with vote count
        $topicDiscussions = TopicDiscussion::withCount('votingUsers')
                                         ->orderBy('voting_users_count', 'desc')
                                         ->take(6)
                                         ->get();

        return view('user.community', compact('initiatives', 'publicSessions', 'topicDiscussions'));
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

    public function voteOnTopic(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => __('front.login_required')
            ]);
        }

        $topic = TopicDiscussion::findOrFail($id);
        
        // Check if user already voted for this topic
        $existingVote = TopicDiscussionUser::where('user_id', Auth::id())
                                         ->where('topic_discussion_id', $id)
                                         ->first();
        
        if ($existingVote) {
            return response()->json([
                'success' => false,
                'message' => __('front.already_voted')
            ]);
        }

        // Create new vote record
        TopicDiscussionUser::create([
            'user_id' => Auth::id(),
            'topic_discussion_id' => $id,
        ]);

        // Get updated vote count
        $newVoteCount = TopicDiscussionUser::where('topic_discussion_id', $id)->count();
        
        return response()->json([
            'success' => true,
            'message' => __('front.vote_recorded'),
            'new_count' => $newVoteCount
        ]);
    }
}