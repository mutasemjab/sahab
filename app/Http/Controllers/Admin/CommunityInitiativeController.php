<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommunityInitiatives;
use Illuminate\Http\Request;

class CommunityInitiativeController extends Controller
{
    /**
     * Display a listing of community initiatives
     */
    public function index()
    {
        $initiatives = CommunityInitiatives::orderBy('created_at', 'desc')->get();
        return view('admin.community-initiatives.index', compact('initiatives'));
    }

    /**
     * Show the form for creating a new community initiative
     */
    public function create()
    {
        return view('admin.community-initiatives.create');
    }

    /**
     * Store a newly created community initiative in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'date_finish' => 'nullable|date|after_or_equal:today',
        ]);

        try {
            CommunityInitiatives::create($request->all());

            return redirect()->route('admin.community-initiatives.index')
                ->with('success', __('messages.initiative_created_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.error_creating_initiative'));
        }
    }

    /**
     * Display the specified community initiative
     */
    public function show(CommunityInitiatives $communityInitiative)
    {
        return view('admin.community-initiatives.show', compact('communityInitiative'));
    }

    /**
     * Show the form for editing the specified community initiative
     */
    public function edit(CommunityInitiatives $communityInitiative)
    {
        return view('admin.community-initiatives.edit', compact('communityInitiative'));
    }

    /**
     * Update the specified community initiative in storage
     */
    public function update(Request $request, CommunityInitiatives $communityInitiative)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'date_finish' => 'nullable|date|after_or_equal:today',
        ]);

        try {
            $communityInitiative->update($request->all());

            return redirect()->route('admin.community-initiatives.index')
                ->with('success', __('messages.initiative_updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.error_updating_initiative'));
        }
    }

    /**
     * Remove the specified community initiative from storage
     */
    public function destroy(CommunityInitiatives $communityInitiative)
    {
        try {
            $communityInitiative->delete();
            return redirect()->route('admin.community-initiatives.index')
                ->with('success', __('messages.initiative_deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', __('messages.error_deleting_initiative'));
        }
    }

    /**
     * Get initiative status based on finish date
     */
    public function getStatus(CommunityInitiatives $initiative)
    {
        if (!$initiative->date_finish) {
            return [
                'status' => 'ongoing',
                'label' => __('messages.ongoing'),
                'class' => 'success'
            ];
        }

        $finishDate = \Carbon\Carbon::parse($initiative->date_finish);
        $now = \Carbon\Carbon::now();

        if ($finishDate->isFuture()) {
            return [
                'status' => 'active',
                'label' => __('messages.active'),
                'class' => 'primary'
            ];
        } else {
            return [
                'status' => 'completed',
                'label' => __('messages.completed'),
                'class' => 'secondary'
            ];
        }
    }
}