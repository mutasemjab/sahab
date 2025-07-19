<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportantLinkController extends Controller
{
     public function index()
    {
        $importantLinks = DB::table('important_links')->orderBy('created_at', 'desc')->get();
        return view('admin.important_links.index', compact('importantLinks'));
    }

    public function create()
    {
        return view('admin.important_links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        DB::table('important_links')->insert([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'link' => $request->link,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('important-links.index')->with('success', __('messages.important_link_created'));
    }

    public function edit($id)
    {
        $importantLink = DB::table('important_links')->where('id', $id)->first();
        if (!$importantLink) {
            return redirect()->route('important-links.index')->with('error', __('messages.important_link_not_found'));
        }
        return view('admin.important_links.edit', compact('importantLink'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        DB::table('important_links')->where('id', $id)->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'link' => $request->link,
            'updated_at' => now(),
        ]);

        return redirect()->route('important-links.index')->with('success', __('messages.important_link_updated'));
    }

    public function destroy($id)
    {
        DB::table('important_links')->where('id', $id)->delete();
        return redirect()->route('important-links.index')->with('success', __('messages.important_link_deleted'));
    }
}