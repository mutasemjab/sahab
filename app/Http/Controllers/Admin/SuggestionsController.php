<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use App\Models\Service;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    public function index(Request $request)
    {
        $query = Suggestion::with('service');
        
        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                  ->orWhere('note', 'like', '%' . $searchTerm . '%')
                  ->orWhere('question', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Apply gender filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        
        // Apply opinion filter
        if ($request->filled('opinion')) {
            $query->where('opinion', $request->opinion);
        }
        
        // Apply service filter
        if ($request->filled('service')) {
            $query->where('service_id', $request->service);
        }
        
        // Apply sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort column for security
        $allowedSortColumns = ['id', 'name', 'created_at'];
        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            $query->latest();
        }
        
        // Get per_page parameter with default of 25
        $perPage = $request->get('per_page', 25);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 25;
        
        // Paginate results
        $suggestions = $query->paginate($perPage);
        
        // Get all services for the filter dropdown
        $services = Service::orderBy('title_ar')->get();
        
        return view('admin.suggestions.index', compact('suggestions', 'services'));
    }

    public function destroy(Suggestion $suggestion)
    {
        $suggestion->delete();
        
        return redirect()->route('admin.suggestions.index')
                         ->with('success', __('messages.suggestion_deleted_successfully'));
    }
}