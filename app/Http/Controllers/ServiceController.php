<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

use App\Models\ServiceForm;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('user.services', compact('services'));
    }

    public function show($id)
    {
        $service = Service::with('serviceDetails')->findOrFail($id);
        return view('user.service-details', compact('service'));
    }

    public function storeForm(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ServiceForm::create([
            'service_id' => $request->service_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', __('front.service_request_sent_successfully'));
    }
}