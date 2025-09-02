<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = DB::table('abouts')->orderBy('created_at', 'desc')->get();
        return view('admin.abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_of_organizational_structure' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = uploadImage('assets/admin/uploads', $request->photo);
        $photoStructurePath = uploadImage('assets/admin/uploads', $request->photo_of_organizational_structure);

        DB::table('abouts')->insert([
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'photo' => $photoPath,
            'photo_of_organizational_structure' => $photoStructurePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('abouts.index')->with('success', __('messages.about_created'));
    }

    public function edit($id)
    {
        $about = DB::table('abouts')->where('id', $id)->first();
        if (!$about) {
            return redirect()->route('abouts.index')->with('error', __('messages.about_not_found'));
        }
        return view('admin.abouts.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_of_organizational_structure' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $about = DB::table('abouts')->where('id', $id)->first();
        if (!$about) {
            return redirect()->route('abouts.index')->with('error', __('messages.about_not_found'));
        }

        $updateData = [
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'updated_at' => now(),
        ];

        if ($request->hasFile('photo')) {
            $updateData['photo'] = uploadImage('assets/admin/uploads', $request->photo);
        }

        if ($request->hasFile('photo_of_organizational_structure')) {
            $updateData['photo_of_organizational_structure'] = uploadImage('assets/admin/uploads', $request->photo_of_organizational_structure);
        }

        DB::table('abouts')->where('id', $id)->update($updateData);

        return redirect()->route('abouts.index')->with('success', __('messages.about_updated'));
    }

    public function destroy($id)
    {
        $about = DB::table('abouts')->where('id', $id)->first();
        if ($about) {
            DB::table('abouts')->where('id', $id)->delete();
        }
        return redirect()->route('abouts.index')->with('success', __('messages.about_deleted'));
    }
}