<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscriptions,email'
        ]);

        // Option A: Save to database (create migration first)
        NewsletterSubscription::create(['email' => $request->email]);
        
        // Option B: Or just send email directly
        // Mail::to('admin@yoursite.com')->send(new NewSubscriber($request->email));

        return response()->json([
            'success' => true,
            'message' => __('front.subscribed_successfully')
        ]);
    }
}