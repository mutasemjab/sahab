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
        $newListens = NewListenSession::get();
        return view('user.newListens', compact('newListens'));
    }
    
    public function showNewListen($id)
    {
        $newListen = NewListenSession::where('id',$id)->first();
        return view('user.newListensDetails', compact('newListen'));
    }

  
}