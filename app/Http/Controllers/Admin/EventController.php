<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = DB::table('events')->orderBy('date_of_event', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_of_event' => 'required|date',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'link_google_meet' => 'required|url',
        ]);

        DB::table('events')->insert([
            'date_of_event' => $request->date_of_event,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'link_google_meet' => $request->link_google_meet,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('events.index')->with('success', __('messages.event_created'));
    }

    public function edit($id)
    {
        $event = DB::table('events')->where('id', $id)->first();
        if (!$event) {
            return redirect()->route('events.index')->with('error', __('messages.event_not_found'));
        }
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_of_event' => 'required|date',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'link_google_meet' => 'required|url',
        ]);

        DB::table('events')->where('id', $id)->update([
            'date_of_event' => $request->date_of_event,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'link_google_meet' => $request->link_google_meet,
            'updated_at' => now(),
        ]);

        return redirect()->route('events.index')->with('success', __('messages.event_updated'));
    }

    public function destroy($id)
    {
        DB::table('events')->where('id', $id)->delete();
        return redirect()->route('events.index')->with('success', __('messages.event_deleted'));
    }
}