<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LawController extends Controller
{
    public function index()
    {
        $laws = DB::table('laws')->orderBy('created_at', 'desc')->get();
        return view('admin.laws.index', compact('laws'));
    }

    public function create()
    {
        return view('admin.laws.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'pdf' => 'required|file|mimes:pdf|max:10240',
        ]);

        $pdfPath = uploadImage('assets/admin/uploads', $request->pdf);

        DB::table('laws')->insert([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'pdf' => $pdfPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('laws.index')->with('success', __('messages.law_created'));
    }

    public function edit($id)
    {
        $law = DB::table('laws')->where('id', $id)->first();
        if (!$law) {
            return redirect()->route('laws.index')->with('error', __('messages.law_not_found'));
        }
        return view('admin.laws.edit', compact('law'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $law = DB::table('laws')->where('id', $id)->first();
        if (!$law) {
            return redirect()->route('laws.index')->with('error', __('messages.law_not_found'));
        }

        $updateData = [
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'updated_at' => now(),
        ];

        if ($request->hasFile('pdf')) {
            $updateData['pdf'] = uploadImage('assets/admin/uploads', $request->pdf);
        }

        DB::table('laws')->where('id', $id)->update($updateData);

        return redirect()->route('laws.index')->with('success', __('messages.law_updated'));
    }

    public function destroy($id)
    {
        DB::table('laws')->where('id', $id)->delete();
        return redirect()->route('laws.index')->with('success', __('messages.law_deleted'));
    }
}