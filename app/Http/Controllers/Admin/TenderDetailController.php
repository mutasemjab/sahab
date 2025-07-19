<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TenderDetailController extends Controller
{
   public function index()
    {
        $tenderDetails = DB::table('tender_details')
            ->join('tenders', 'tender_details.tender_id', '=', 'tenders.id')
            ->select('tender_details.*', 'tenders.title_en as tender_title')
            ->orderBy('tender_details.created_at', 'desc')
            ->get();
        return view('admin.tender_details.index', compact('tenderDetails'));
    }

    public function create()
    {
        $tenders = DB::table('tenders')->select('id', 'title_en', 'title_ar')->get();
        return view('admin.tender_details.create', compact('tenders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tender_id' => 'required|exists:tenders,id',
            'video' => 'required|url',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'condition' => 'required|string',
            'required_file' => 'required|string',
        ]);

        DB::table('tender_details')->insert([
            'tender_id' => $request->tender_id,
            'video' => $request->video,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'condition' => $request->condition,
            'required_file' => $request->required_file,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tender-details.index')->with('success', __('messages.tender_detail_created'));
    }

    public function edit($id)
    {
        $tenderDetail = DB::table('tender_details')->where('id', $id)->first();
        if (!$tenderDetail) {
            return redirect()->route('tender-details.index')->with('error', __('messages.tender_detail_not_found'));
        }
        
        $tenders = DB::table('tenders')->select('id', 'title_en', 'title_ar')->get();
        return view('admin.tender_details.edit', compact('tenderDetail', 'tenders'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tender_id' => 'required|exists:tenders,id',
            'video' => 'required|url',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'condition' => 'required|string',
            'required_file' => 'required|string',
        ]);

        DB::table('tender_details')->where('id', $id)->update([
            'tender_id' => $request->tender_id,
            'video' => $request->video,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'condition' => $request->condition,
            'required_file' => $request->required_file,
            'updated_at' => now(),
        ]);

        return redirect()->route('tender-details.index')->with('success', __('messages.tender_detail_updated'));
    }

    public function destroy($id)
    {
        DB::table('tender_details')->where('id', $id)->delete();
        return redirect()->route('tender-details.index')->with('success', __('messages.tender_detail_deleted'));
    }
}