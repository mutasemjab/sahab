<?php

namespace App\Http\Controllers;

use App\Models\ImportantLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportantLinkController extends Controller
{
    
   public function index(Request $request)
    {
        $query = ImportantLink::query();
        
        // Group links by category if needed
        $categories = [
            'government' => __('front.government_institutions'),
            'municipal' => __('front.municipal_services'),
            'partners' => __('front.partner_organizations')
        ];
        
        // You can add category filtering if you decide to add a category field
        $links = $query->orderBy('created_at', 'desc')->get();
        
        // Group links for better organization (you can customize this logic)
        $groupedLinks = $this->groupLinksByType($links);
        
        return view('user.important-link', compact('groupedLinks', 'categories'));
    }

    private function groupLinksByType($links)
    {
        // You can customize this grouping logic based on your needs
        // For now, I'll create a simple grouping mechanism
        
        $government = collect();
        $municipal = collect();
        $partners = collect();
        $others = collect();

        foreach ($links as $link) {
            // Simple categorization based on title keywords
            $title = strtolower($link->title);
            
            if (str_contains($title, 'وزارة') || str_contains($title, 'ministry') || 
                str_contains($title, 'رئاسة') || str_contains($title, 'government') ||
                str_contains($title, 'حكوم') || str_contains($title, 'دولة')) {
                $government->push($link);
            } elseif (str_contains($title, 'بلدية') || str_contains($title, 'municipal') ||
                     str_contains($title, 'تصاريح') || str_contains($title, 'permits') ||
                     str_contains($title, 'خدمات') || str_contains($title, 'services')) {
                $municipal->push($link);
            } elseif (str_contains($title, 'منظمة') || str_contains($title, 'organization') ||
                     str_contains($title, 'جامعة') || str_contains($title, 'university') ||
                     str_contains($title, 'مدرسة') || str_contains($title, 'school') ||
                     str_contains($title, 'غرفة') || str_contains($title, 'chamber')) {
                $partners->push($link);
            } else {
                $others->push($link);
            }
        }

        return collect([
            [
                'title' => __('front.government_institutions'),
                'links' => $government,
                'class' => 'government'
            ],
            [
                'title' => __('front.municipal_services'),
                'links' => $municipal,
                'class' => 'municipal'
            ],
            [
                'title' => __('front.partner_organizations'),
                'links' => $partners,
                'class' => 'partners'
            ]
        ])->filter(function($group) {
            return $group['links']->count() > 0;
        });
    }
}