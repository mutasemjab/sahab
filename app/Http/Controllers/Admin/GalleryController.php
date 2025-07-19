<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
   public function index()
    {
        $galleries = DB::table('galleries')->orderBy('created_at', 'desc')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video.*' => 'required|url',
        ]);

        $photos = [];
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $photos[] = uploadImage('assets/admin/uploads', $file);
            }
        }

        $videos = $request->video ?? [];

        DB::table('galleries')->insert([
            'photo' => json_encode($photos),
            'video' => json_encode($videos),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('galleries.index')->with('success', __('messages.gallery_created'));
    }

    public function edit($id)
    {
        $gallery = DB::table('galleries')->where('id', $id)->first();
        if (!$gallery) {
            return redirect()->route('galleries.index')->with('error', __('messages.gallery_not_found'));
        }
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video.*' => 'nullable|url',
        ]);

        $gallery = DB::table('galleries')->where('id', $id)->first();
        if (!$gallery) {
            return redirect()->route('galleries.index')->with('error', __('messages.gallery_not_found'));
        }

        $updateData = [
            'updated_at' => now(),
        ];

        if ($request->hasFile('photo')) {
            $photos = [];
            foreach ($request->file('photo') as $file) {
                $photos[] = uploadImage('assets/admin/uploads', $file);
            }
            $updateData['photo'] = json_encode($photos);
        }

        if ($request->video) {
            $updateData['video'] = json_encode($request->video);
        }

        DB::table('galleries')->where('id', $id)->update($updateData);

        return redirect()->route('galleries.index')->with('success', __('messages.gallery_updated'));
    }

    public function destroy($id)
    {
        DB::table('galleries')->where('id', $id)->delete();
        return redirect()->route('galleries.index')->with('success', __('messages.gallery_deleted'));
    }
}