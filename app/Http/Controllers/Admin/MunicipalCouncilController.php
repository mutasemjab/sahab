<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MunicipalCouncilController extends Controller
{
    public function index()
    {
        $municipalCouncils = DB::table('municipal_councils')->orderBy('created_at', 'desc')->get();
        return view('admin.municipal_councils.index', compact('municipalCouncils'));
    }

    public function create()
    {
        return view('admin.municipal_councils.create');
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

        DB::table('municipal_councils')->insert([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('municipal-councils.index')->with('success', __('messages.municipal_council_created'));
    }

    public function edit($id)
    {
        $municipalCouncil = DB::table('municipal_councils')->where('id', $id)->first();
        if (!$municipalCouncil) {
            return redirect()->route('municipal-councils.index')->with('error', __('messages.municipal_council_not_found'));
        }
        return view('admin.municipal_councils.edit', compact('municipalCouncil'));
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

        DB::table('municipal_councils')->where('id', $id)->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'updated_at' => now(),
        ]);

        return redirect()->route('municipal-councils.index')->with('success', __('messages.municipal_council_updated'));
    }

    public function destroy($id)
    {
        DB::table('municipal_councils')->where('id', $id)->delete();
        return redirect()->route('municipal-councils.index')->with('success', __('messages.municipal_council_deleted'));
    }
}