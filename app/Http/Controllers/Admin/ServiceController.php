<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
     public function index()
    {
        $services = DB::table('services')->orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'required|string|max:255',
            'pdf' => 'required|file|mimes:pdf|max:10240',
            'target_audience' => 'required|string|max:255',
            'duration_service' => 'required|string|max:255',
            'service_channel' => 'required|string|max:255',
            'service_cost' => 'required|string|max:255',
        ]);

        $pdfPath =  uploadImage('assets/admin/uploads', $request->pdf);

        DB::table('services')->insert([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'pdf' => $pdfPath,
            'target_audience' => $request->target_audience,
            'duration_service' => $request->duration_service,
            'service_channel' => $request->service_channel,
            'service_cost' => $request->service_cost,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('services.index')->with('success', __('messages.service_created'));
    }

    public function edit($id)
    {
        $service = DB::table('services')->where('id', $id)->first();
        if (!$service) {
            return redirect()->route('services.index')->with('error', __('messages.service_not_found'));
        }
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'icon' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'target_audience' => 'required|string|max:255',
            'duration_service' => 'required|string|max:255',
            'service_channel' => 'required|string|max:255',
            'service_cost' => 'required|string|max:255',
        ]);

        $service = DB::table('services')->where('id', $id)->first();
        if (!$service) {
            return redirect()->route('services.index')->with('error', __('messages.service_not_found'));
        }

        $updateData = [
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'icon' => $request->icon,
            'target_audience' => $request->target_audience,
            'duration_service' => $request->duration_service,
            'service_channel' => $request->service_channel,
            'service_cost' => $request->service_cost,
            'updated_at' => now(),
        ];

        if ($request->hasFile('pdf')) {
          
            $updateData['pdf'] = uploadImage('assets/admin/uploads', $request->pdf);
        }

        DB::table('services')->where('id', $id)->update($updateData);

        return redirect()->route('services.index')->with('success', __('messages.service_updated'));
    }

    public function destroy($id)
    {
        $service = DB::table('services')->where('id', $id)->first();
        if ($service) {
            DB::table('services')->where('id', $id)->delete();
        }
        return redirect()->route('services.index')->with('success', __('messages.service_deleted'));
    }

    // New methods for service details
    public function createDetails($serviceId)
    {
        $service = DB::table('services')->where('id', $serviceId)->first();
        if (!$service) {
            return redirect()->route('services.index')->with('error', __('messages.service_not_found'));
        }
        
        return view('admin.services.create-details', compact('service'));
    }

    public function storeDetails(Request $request, $serviceId)
    {
        $request->validate([
            'video' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'steps' => 'required|string',
            'condition' => 'required|string',
            'required_file' => 'required|string',
        ]);

        $service = DB::table('services')->where('id', $serviceId)->first();
        if (!$service) {
            return redirect()->route('services.index')->with('error', __('messages.service_not_found'));
        }

        DB::table('service_details')->insert([
            'service_id' => $serviceId,
            'video' => $request->video,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'steps' => $request->steps,
            'condition' => $request->condition,
            'required_file' => $request->required_file,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('services.index')->with('success', __('messages.service_details_created'));
    }

    public function showDetails($serviceId)
    {
        $service = DB::table('services')->where('id', $serviceId)->first();
        $serviceDetails = DB::table('service_details')->where('service_id', $serviceId)->get();
        
        if (!$service) {
            return redirect()->route('services.index')->with('error', __('messages.service_not_found'));
        }

        return view('admin.services.details', compact('service', 'serviceDetails'));
    }

    public function editDetails($serviceId, $detailId)
    {
        $service = DB::table('services')->where('id', $serviceId)->first();
        $serviceDetail = DB::table('service_details')
            ->where('id', $detailId)
            ->where('service_id', $serviceId)
            ->first();

        if (!$service || !$serviceDetail) {
            return redirect()->route('services.index')->with('error', __('messages.service_detail_not_found'));
        }

        return view('admin.services.edit-details', compact('service', 'serviceDetail'));
    }

    public function updateDetails(Request $request, $serviceId, $detailId)
    {
        $request->validate([
            'video' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'steps' => 'required|string',
            'condition' => 'required|string',
            'required_file' => 'required|string',
        ]);

        $serviceDetail = DB::table('service_details')
            ->where('id', $detailId)
            ->where('service_id', $serviceId)
            ->first();

        if (!$serviceDetail) {
            return redirect()->route('services.index')->with('error', __('messages.service_detail_not_found'));
        }

        DB::table('service_details')
            ->where('id', $detailId)
            ->where('service_id', $serviceId)
            ->update([
                'video' => $request->video,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'steps' => $request->steps,
                'condition' => $request->condition,
                'required_file' => $request->required_file,
                'updated_at' => now(),
            ]);

        return redirect()->route('services.details', $serviceId)->with('success', __('messages.service_details_updated'));
    }

    public function destroyDetails($serviceId, $detailId)
    {
        $serviceDetail = DB::table('service_details')
            ->where('id', $detailId)
            ->where('service_id', $serviceId)
            ->first();

        if ($serviceDetail) {
            DB::table('service_details')
                ->where('id', $detailId)
                ->where('service_id', $serviceId)
                ->delete();
        }

        return redirect()->route('services.details', $serviceId)->with('success', __('messages.service_details_deleted'));
    }
}