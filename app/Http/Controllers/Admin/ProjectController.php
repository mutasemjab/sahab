<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
     public function index()
    {
        $projects = DB::table('projects')->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'time' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:1,2,3',
        ]);

        $photoPath = uploadImage('assets/admin/uploads', $request->photo);

        DB::table('projects')->insert([
            'time' => $request->time,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'photo' => $photoPath,
            'type' => $request->type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('projects.index')->with('success', __('messages.project_created'));
    }

    public function edit($id)
    {
        $project = DB::table('projects')->where('id', $id)->first();
        if (!$project) {
            return redirect()->route('projects.index')->with('error', __('messages.project_not_found'));
        }
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'time' => 'nullable|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:1,2,3',
        ]);

        $project = DB::table('projects')->where('id', $id)->first();
        if (!$project) {
            return redirect()->route('projects.index')->with('error', __('messages.project_not_found'));
        }

        $updateData = [
            'time' => $request->time,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type' => $request->type,
            'updated_at' => now(),
        ];

        if ($request->hasFile('photo')) {
            $updateData['photo'] = uploadImage('assets/admin/uploads', $request->photo);
        }

        DB::table('projects')->where('id', $id)->update($updateData);

        return redirect()->route('projects.index')->with('success', __('messages.project_updated'));
    }

    public function destroy($id)
    {
        $project = DB::table('projects')->where('id', $id)->first();
        if ($project) {
            DB::table('projects')->where('id', $id)->delete();
        }
        return redirect()->route('projects.index')->with('success', __('messages.project_deleted'));
    }
}