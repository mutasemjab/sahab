<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TopicDiscussionController extends Controller
{
   public function index()
    {
        $topicDiscussions = DB::table('topic_discussions')->orderBy('created_at', 'desc')->get();
        return view('admin.topic_discussions.index', compact('topicDiscussions'));
    }

    public function create()
    {
        return view('admin.topic_discussions.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        DB::table('topic_discussions')->insert([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('topic-discussions.index')->with('success', __('messages.topic_discussion_created'));
    }

    public function edit($id)
    {
        $topicDiscussion = DB::table('topic_discussions')->where('id', $id)->first();
        if (!$topicDiscussion) {
            return redirect()->route('topic-discussions.index')->with('error', __('messages.topic_discussion_not_found'));
        }
        return view('admin.topic_discussions.edit', compact('topicDiscussion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        DB::table('topic_discussions')->where('id', $id)->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'updated_at' => now(),
        ]);

        return redirect()->route('topic-discussions.index')->with('success', __('messages.topic_discussion_updated'));
    }

    public function destroy($id)
    {
        DB::table('topic_discussions')->where('id', $id)->delete();
        return redirect()->route('topic-discussions.index')->with('success', __('messages.topic_discussion_deleted'));
    }
}