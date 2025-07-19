<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicSession;

class SessionController extends Controller
{
   
    public function show($id)
    {
        $session = PublicSession::findOrFail($id);
        return view('user.public-sessions-details', compact('session'));
    }

}