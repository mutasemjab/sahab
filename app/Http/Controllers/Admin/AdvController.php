<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdvController extends Controller
{
    public function index()
    {
        $advs = DB::table('advs')->orderBy('date_of_adv', 'desc')->get();
        return view('admin.advs.index', compact('advs'));
    }

    public function create()
    {
        return view('admin.advs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_of_adv' => 'required|date',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = uploadImage('assets/admin/uploads', $request->photo);

        DB::table('advs')->insert([
            'date_of_adv' => $request->date_of_adv,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'photo' => $photoPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('advs.index')->with('success', __('messages.adv_created'));
    }

    public function edit($id)
    {
        $adv = DB::table('advs')->where('id', $id)->first();
        if (!$adv) {
            return redirect()->route('advs.index')->with('error', __('messages.adv_not_found'));
        }
        return view('admin.advs.edit', compact('adv'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_of_adv' => 'required|date',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $adv = DB::table('advs')->where('id', $id)->first();
        if (!$adv) {
            return redirect()->route('advs.index')->with('error', __('messages.adv_not_found'));
        }

        $updateData = [
            'date_of_adv' => $request->date_of_adv,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'updated_at' => now(),
        ];

        if ($request->hasFile('photo')) {
            $updateData['photo'] = uploadImage('assets/admin/uploads', $request->photo);
        }

        DB::table('advs')->where('id', $id)->update($updateData);

        return redirect()->route('advs.index')->with('success', __('messages.adv_updated'));
    }

    public function destroy($id)
    {
        DB::table('advs')->where('id', $id)->delete();
        return redirect()->route('advs.index')->with('success', __('messages.adv_deleted'));
    }
}