<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Adv;
use App\Models\Banner;
use App\Models\Complaint;
use App\Models\CompleteAbout;
use App\Models\Event;
use App\Models\Law;
use App\Models\MunicipalCouncil;
use App\Models\OurPart;
use App\Models\PlaceComplaint;
use App\Models\PublicSession;
use App\Models\Service;
use App\Models\Projects;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
     public function track(Request $request)
    {
        // If no search term, just show the form
        if (!$request->has('search_term') || empty($request->search_term)) {
            return view('user.track-complaints');
        }

        $searchTerm = $request->search_term;
        
        // Validate search term
        $request->validate([
            'search_term' => 'required|string|max:50',
        ]);

        $query = Complaint::with(['service', 'placeComplaint']);

        // Search by complaint number or phone number
        $query->where(function($q) use ($searchTerm) {
            $q->where('number', 'like', '%' . $searchTerm . '%')
              ->orWhere('phone', 'like', '%' . $searchTerm . '%');
        });

        $complaints = $query->orderBy('created_at', 'desc')->get();

        // If no complaints found, return with error message
        if ($complaints->isEmpty()) {
            return redirect()->back()
                           ->with('error', __('front.no_complaints_found_for_search'))
                           ->withInput();
        }

        return view('user.follow-complaints', compact('complaints'));
    }

    public function trackIndex()
    {
        return view('user.follow-complaints');
    }

    public function index(Request $request)
    {
        $services = Service::all();
        $placeComplaints = PlaceComplaint::all();
        
        $query = Complaint::with(['service', 'placeComplaint']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('complaint_details', 'like', '%' . $search . '%')
                  ->orWhere('number', 'like', '%' . $search . '%');
            });
        }

        $complaints = $query->orderBy('created_at', 'desc')->get();

        return view('user.complaints', compact('complaints', 'services', 'placeComplaints',));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|string',
            'gender' => 'required|in:1,2',
            'hide_information' => 'required|in:1,2',
            'is_complaint_emergency' => 'required|in:1,2',
            'service_id' => 'required|exists:services,id',
            'complaint_details' => 'required|string',
            'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'another_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'place_complaint_id' => 'required|exists:place_complaints,id',
            'address_details' => 'nullable|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        // Generate unique complaint number
        $complaintNumber = $this->generateComplaintNumber();

        // Handle photo uploads
        $photos = [];
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $photos[] = uploadImage('assets/admin/uploads', $file);
            }
        }
      
      
        $anotherPhotos = [];
        if ($request->hasFile('anotherPhoto')) {
            foreach ($request->file('anotherPhoto') as $file) {
                $anotherPhotos[] = uploadImage('assets/admin/uploads', $file);
            }
        }


        Complaint::create([
            'number' => $complaintNumber,
            'video' => $request->video ?? '',
            'name' => $request->name,
            'phone' => $request->phone,
            'age' => $request->age,
            'gender' => $request->gender,
            'hide_information' => $request->hide_information,
            'status' => 1, // Default to pending
            'is_complaint_emergency' => $request->is_complaint_emergency,
            'service_id' => $request->service_id,
            'complaint_details' => $request->complaint_details,
            'photo' => json_encode($photos),
            'another_photo' => json_encode($anotherPhotos),
            'place_complaint_id' => $request->place_complaint_id,
            'address_details' => $request->address_details,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        return redirect()->back()->with('success', __('front.complaint_sent_successfully'));
    }


    public function details(Request $request)
    {
        $services = Service::all();
        $query = Complaint::with(['service', 'placeComplaint']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by service
        if ($request->has('service_id') && $request->service_id != '') {
            $query->where('service_id', $request->service_id);
        }

        // Filter by date range
        if ($request->has('date_range') && $request->date_range != '') {
            $dateRange = $request->date_range;
            if ($dateRange == '7') {
                $query->where('created_at', '>=', Carbon::now()->subDays(7));
            } elseif ($dateRange == '30') {
                $query->where('created_at', '>=', Carbon::now()->subDays(30));
            } elseif ($dateRange == 'month') {
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('complaint_details', 'like', '%' . $search . '%')
                  ->orWhere('number', 'like', '%' . $search . '%');
            });
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('user.complaints-details', compact('complaints', 'services'));
    }

    public function detailsTwo($id)
    {
        $complaint = Complaint::with(['service', 'placeComplaint'])->findOrFail($id);
        return view('user.complaints-details-two', compact('complaint'));
    }

    private function generateComplaintNumber()
    {
        do {
            $number = rand(100000, 999999);
        } while (Complaint::where('number', $number)->exists());
        
        return $number;
    }
}