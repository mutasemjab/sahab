<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Adv;
use App\Models\Banner;
use App\Models\CompleteAbout;
use App\Models\Event;
use App\Models\Law;
use App\Models\MunicipalCouncil;
use App\Models\OurPart;
use App\Models\PublicSession;
use App\Models\Service;
use App\Models\Projects;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TenderController extends Controller
{
    public function index(Request $request)
    {
        $query = Tender::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title_en', 'like', '%' . $search . '%')
                  ->orWhere('title_ar', 'like', '%' . $search . '%')
                  ->orWhere('description_en', 'like', '%' . $search . '%')
                  ->orWhere('description_ar', 'like', '%' . $search . '%')
                  ->orWhere('number', 'like', '%' . $search . '%');
            });
        }

        // Filter by category (if you add categories later)
        if ($request->has('category') && $request->category != '') {
            // Add category filtering logic here when needed
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('date_publish', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('date_publish', 'asc');
                    break;
                case 'closing_soon':
                    $query->orderBy('date_close', 'asc');
                    break;
                case 'value_high':
                    $query->orderBy('cost', 'desc');
                    break;
                case 'value_low':
                    $query->orderBy('cost', 'asc');
                    break;
                default:
                    $query->orderBy('date_publish', 'desc');
            }
        } else {
            $query->orderBy('date_publish', 'desc');
        }

        $tenders = $query->paginate(10);

        return view('user.tenders', compact('tenders'));
    }

    public function show($id)
    {
        $tender = Tender::with('tenderDetails')->findOrFail($id);
        return view('user.tenders-details', compact('tender'));
    }

    public function downloadDocuments($id)
    {
        $tender = Tender::findOrFail($id);
        
        if ($tender->pdf) {
            return response()->download(storage_path('app/public/' . $tender->pdf));
        }
        
        return redirect()->back()->with('error', __('front.no_documents_available'));
    }

    public function downloadFiles($id)
    {
        $tender = Tender::findOrFail($id);
        
        if ($tender->pdf_file && count(json_decode($tender->pdf_file)) > 0) {
            $files = json_decode($tender->pdf_file);
            // For multiple files, you might want to create a zip
            // For now, download the first file
            $firstFile = $files[0];
            return response()->download(storage_path('app/public/' . $firstFile));
        }
        
        return redirect()->back()->with('error', __('front.no_files_available'));
    }
}