<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TenderController extends Controller
{
    public function index()
    {
        $tenders = DB::table('tenders')->orderBy('date_publish', 'desc')->get();
        return view('admin.tenders.index', compact('tenders'));
    }

    public function create()
    {
        return view('admin.tenders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'cost' => 'required|string',
            'date_publish' => 'required|string',
            'date_close' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'required|file|mimes:pdf|max:10240',
            'pdf_file.*' => 'required|file|mimes:pdf|max:10240',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = uploadImage('assets/admin/uploads', $request->photo);
        }

        $pdfPath = uploadImage('assets/admin/uploads', $request->pdf);

        $pdfFiles = [];
        if ($request->hasFile('pdf_file')) {
            foreach ($request->file('pdf_file') as $file) {
                $pdfFiles[] = uploadImage('assets/admin/uploads', $file);
            }
        }

        DB::table('tenders')->insert([
            'number' => $request->number,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'cost' => $request->cost,
            'date_publish' => $request->date_publish,
            'date_close' => $request->date_close,
            'photo' => $photoPath,
            'pdf' => $pdfPath,
            'pdf_file' => json_encode($pdfFiles),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tenders.index')->with('success', __('messages.tender_created'));
    }

    public function edit($id)
    {
        $tender = DB::table('tenders')->where('id', $id)->first();
        if (!$tender) {
            return redirect()->route('tenders.index')->with('error', __('messages.tender_not_found'));
        }
        return view('admin.tenders.edit', compact('tender'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|integer',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'cost' => 'required|string',
            'date_publish' => 'required|string',
            'date_close' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'pdf_file.*' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $tender = DB::table('tenders')->where('id', $id)->first();
        if (!$tender) {
            return redirect()->route('tenders.index')->with('error', __('messages.tender_not_found'));
        }

        $updateData = [
            'number' => $request->number,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'cost' => $request->cost,
            'date_publish' => $request->date_publish,
            'date_close' => $request->date_close,
            'updated_at' => now(),
        ];

        if ($request->hasFile('photo')) {
            $updateData['photo'] = uploadImage('assets/admin/uploads', $request->photo);
        }

        if ($request->hasFile('pdf')) {
            $updateData['pdf'] = uploadImage('assets/admin/uploads', $request->pdf);
        }

        if ($request->hasFile('pdf_file')) {
            $pdfFiles = [];
            foreach ($request->file('pdf_file') as $file) {
                $pdfFiles[] = uploadImage('assets/admin/uploads', $file);
            }
            $updateData['pdf_file'] = json_encode($pdfFiles);
        }

        DB::table('tenders')->where('id', $id)->update($updateData);

        return redirect()->route('tenders.index')->with('success', __('messages.tender_updated'));
    }

    public function destroy($id)
    {
        DB::table('tenders')->where('id', $id)->delete();
        return redirect()->route('tenders.index')->with('success', __('messages.tender_deleted'));
    }
}