<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OurPartController extends Controller
{
    public function index()
    {
        $ourParts = DB::table('our_parts')->orderBy('created_at', 'desc')->get();
        return view('admin.our_parts.index', compact('ourParts'));
    }

    public function create()
    {
        return view('admin.our_parts.create');
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

        DB::table('our_parts')->insert([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('our-parts.index')->with('success', __('messages.our_part_created'));
    }

    public function edit($id)
    {
        $ourPart = DB::table('our_parts')->where('id', $id)->first();
        if (!$ourPart) {
            return redirect()->route('our-parts.index')->with('error', __('messages.our_part_not_found'));
        }
        return view('admin.our_parts.edit', compact('ourPart'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'required|string|max:255',
        ]);

        DB::table('our_parts')->where('id', $id)->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'updated_at' => now(),
        ]);

        return redirect()->route('our-parts.index')->with('success', __('messages.our_part_updated'));
    }

    public function destroy($id)
    {
        DB::table('our_parts')->where('id', $id)->delete();
        return redirect()->route('our-parts.index')->with('success', __('messages.our_part_deleted'));
    }
}