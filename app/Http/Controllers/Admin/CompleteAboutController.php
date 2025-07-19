<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompleteAboutController extends Controller
{
    public function index()
    {
        $complete_abouts = DB::table('complete_abouts')->orderBy('created_at', 'desc')->get();
        return view('admin.complete_abouts.index', compact('complete_abouts'));
    }

    public function create()
    {
        return view('admin.complete_abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'required|string|max:255',
        ]);


        DB::table('complete_abouts')->insert([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('complete_abouts.index')->with('success', __('messages.complete_about_created'));
    }

    public function edit($id)
    {
        $completeAbout = DB::table('complete_abouts')->where('id', $id)->first();
        if (!$completeAbout) {
            return redirect()->route('complete_abouts.index')->with('error', __('messages.complete_about_not_found'));
        }
        return view('admin.complete_abouts.edit', compact('completeAbout'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'nullable',
        ]);

        $completeAbout = DB::table('complete_abouts')->where('id', $id)->first();
        if (!$completeAbout) {
            return redirect()->route('complete_abouts.index')->with('error', __('messages.complete_about_not_found'));
        }

        $updateData = [
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'icon' => $request->icon,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'updated_at' => now(),
        ];


        DB::table('complete_abouts')->where('id', $id)->update($updateData);

        return redirect()->route('complete_abouts.index')->with('success', __('messages.complete_about_updated'));
    }

    public function destroy($id)
    {
        $completeAbout = DB::table('complete_abouts')->where('id', $id)->first();
        if ($completeAbout) {
            DB::table('complete_abouts')->where('id', $id)->delete();
        }
        return redirect()->route('complete_abouts.index')->with('success', __('messages.complete_about_deleted'));
    }
}