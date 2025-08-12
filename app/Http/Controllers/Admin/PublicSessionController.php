<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PublicSessionController extends Controller
{
      public function index()
    {
        $publicSessions = DB::table('public_sessions')->orderBy('date_of_event', 'desc')->get();
        return view('admin.public_sessions.index', compact('publicSessions'));
    }

    public function create()
    {
        return view('admin.public_sessions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_of_event' => 'required|date',
            'from_time' => 'nullable|string|max:255',
            'to_time' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'type' => 'required|in:1,2',
            'video' => 'nullable|url',
            'what_expect' => 'nullable|string',
        ]);

        DB::table('public_sessions')->insert([
            'date_of_event' => $request->date_of_event,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type' => $request->type,
            'video' => $request->video,
            'what_expect' => $request->what_expect,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('public-sessions.index')->with('success', __('messages.public_session_created'));
    }

    public function edit($id)
    {
        $publicSession = DB::table('public_sessions')->where('id', $id)->first();
        if (!$publicSession) {
            return redirect()->route('public-sessions.index')->with('error', __('messages.public_session_not_found'));
        }
        return view('admin.public_sessions.edit', compact('publicSession'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_of_event' => 'required|date',
             'from_time' => 'nullable|string|max:255',
            'to_time' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'type' => 'required|in:1,2',
            'video' => 'nullable|url',
            'what_expect' => 'nullable|string',
        ]);

        DB::table('public_sessions')->where('id', $id)->update([
            'date_of_event' => $request->date_of_event,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type' => $request->type,
            'video' => $request->video,
            'what_expect' => $request->what_expect,
            'updated_at' => now(),
        ]);

        return redirect()->route('public-sessions.index')->with('success', __('messages.public_session_updated'));
    }

    public function destroy($id)
    {
        DB::table('public_sessions')->where('id', $id)->delete();
        return redirect()->route('public-sessions.index')->with('success', __('messages.public_session_deleted'));
    }
}