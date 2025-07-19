<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Projects::query();

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title_en', 'like', '%' . $search . '%')
                  ->orWhere('title_ar', 'like', '%' . $search . '%')
                  ->orWhere('description_en', 'like', '%' . $search . '%')
                  ->orWhere('description_ar', 'like', '%' . $search . '%');
            });
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $projects = $query->get();

        return view('user.projects', compact('projects'));
    }

    public function show($id)
    {
        $project = Projects::findOrFail($id);
        return view('user.project-details', compact('project'));
    }
}