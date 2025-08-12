<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
       public function index(Request $request)
    {
        $query = Complaint::with('service', 'placeComplaint');
        
        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                  ->orWhere('complaint_details', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Apply emergency filter
        if ($request->filled('emergency')) {
            $query->where('is_complaint_emergency', $request->emergency);
        }
        
        // Apply gender filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        
        // Apply sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort column for security
        $allowedSortColumns = ['id', 'name', 'created_at', 'status', 'number'];
        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        // Get per_page parameter with default of 25
        $perPage = $request->get('per_page', 25);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 25;
        
        // Paginate results
        $complaints = $query->paginate($perPage);
        
        return view('admin.complaints.index', compact('complaints'));
    }

  
}