<?php

namespace App\Http\Controllers;

use App\Models\Adv;
use App\Models\News;
use App\Models\Gallery;

class MediaCenterController extends Controller
{
    public function index()
    {
        // Get latest advertisements (limit to 6 for display)
        $advertisements = Adv::orderBy('date_of_adv', 'desc')
                                    ->take(6)
                                    ->get();

        // Get latest news (limit to 6 for display)
        $news = News::orderBy('date_of_news', 'desc')
                   ->take(6)
                   ->get();

        // Get gallery data (photos and videos)
        $gallery = Gallery::latest()->first(); // Assuming single gallery record

        return view('user.media-center', compact('advertisements', 'news', 'gallery'));
    }

    public function showAllAdvertisements()
    {
        $advertisements = Adv::orderBy('date_of_adv', 'desc')
                                    ->paginate(12);
        
        return view('advertisements.index', compact('advertisements'));
    }

    public function showAllNews()
    {
        $news = News::orderBy('date_of_news', 'desc')
                   ->paginate(12);
        
        return view('news.index', compact('news'));
    }

    public function showAdvertisement($id)
    {
        $advertisement = Adv::findOrFail($id);
        return view('advertisements.show', compact('advertisement'));
    }

    public function showNews($id)
    {
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }
}