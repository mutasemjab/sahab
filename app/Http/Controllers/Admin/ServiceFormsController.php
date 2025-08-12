<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceForm;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceFormsController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceForm::with('service');
        
        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('message', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Apply service filter
        if ($request->filled('service')) {
            $query->where('service_id', $request->service);
        }
        
        // Apply sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort column for security
        $allowedSortColumns = ['id', 'name', 'email', 'created_at'];
        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            $query->latest();
        }
        
        // Get per_page parameter with default of 25
        $perPage = $request->get('per_page', 25);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 25;
        
        // Paginate results
        $serviceForms = $query->paginate($perPage);
        
        // Get all services for the filter dropdown
        $services = Service::orderBy('title_ar')->get();
        
        return view('admin.serviceForms.index', compact('serviceForms', 'services'));
    }

    public function destroy(ServiceForm $serviceForm)
    {
        $serviceForm->delete();
        
        return redirect()->route('admin.service-forms.index')
                         ->with('success', __('messages.service_form_deleted_successfully'));
    }
}