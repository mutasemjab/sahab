<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\NewListenSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewListenSessionController extends Controller
{
    public function index()
    {
        $sessions = NewListenSession::latest()->paginate(10);
        return view('admin.new_listen_sessions.index', compact('sessions'));
    }

    public function create()
    {
        return view('admin.new_listen_sessions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = uploadImage('assets/admin/uploads', $request->hasFile('photo'));
        }

        NewListenSession::create([
            'photo' => $photoPath,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
        ]);

        return redirect()->route('new-listen-sessions.index')
                        ->with('success', __('messages.session_created_successfully'));
    }

    public function show(NewListenSession $newListenSession)
    {
        return view('admin.new_listen_sessions.show', compact('newListenSession'));
    }

    public function edit(NewListenSession $newListenSession)
    {
        return view('admin.new_listen_sessions.edit', compact('newListenSession'));
    }

    public function update(Request $request, NewListenSession $newListenSession)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        $updateData = [
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
        ];

        if ($request->hasFile('photo')) {
            $updateData['photo'] = uploadImage('assets/admin/uploads', $request->hasFile('photo'));
        }

        $newListenSession->update($updateData);

        return redirect()->route('new-listen-sessions.index')
                        ->with('success', __('messages.session_updated_successfully'));
    }

    public function destroy(NewListenSession $newListenSession)
    {
        // Delete photo if exists
        if ($newListenSession->photo) {
            Storage::disk('public')->delete($newListenSession->photo);
        }

        $newListenSession->delete();

        return redirect()->route('new-listen-sessions.index')
                        ->with('success', __('messages.session_deleted_successfully'));
    }
}