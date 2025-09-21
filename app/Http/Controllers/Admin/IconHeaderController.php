<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\IconHeader;
use Illuminate\Http\Request;

class IconHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iconHeaders = IconHeader::latest()->get();
        return view('admin.icon_headers.index', compact('iconHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.icon_headers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        IconHeader::create([
            'icon' => $request->icon,
            'link' => $request->link,
        ]);

        return redirect()->route('icon_headers.index')
                         ->with('success', __('messages.icon_header_created'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IconHeader $iconHeader)
    {
        return view('admin.icon_headers.edit', compact('iconHeader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IconHeader $iconHeader)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        $iconHeader->update([
            'icon' => $request->icon,
            'link' => $request->link,
        ]);

        return redirect()->route('icon_headers.index')
                         ->with('success', __('messages.icon_header_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IconHeader $iconHeader)
    {
        $iconHeader->delete();

        return redirect()->route('icon_headers.index')
                         ->with('success', __('messages.icon_header_deleted'));
    }
}