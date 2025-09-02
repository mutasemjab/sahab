<?php

namespace App\Http\Controllers;

use App\Models\Adv;
use App\Models\News;
use App\Models\Gallery;
use App\Models\NewListenSession;

class NewListenSessionController extends Controller
{
    public function showAllNewListen()
    {
        // Add pagination - 6 items per page
        $newListens = NewListenSession::orderBy('created_at', 'desc')
                                     ->paginate(6);
        return view('user.newListens', compact('newListens'));
    }
         
    public function showNewListen($id)
    {
        $newListen = NewListenSession::findOrFail($id);
        return view('user.newListensDetails', compact('newListen'));
    }

  
}