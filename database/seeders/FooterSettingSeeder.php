<?php
// database/seeders/FooterSettingSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterSetting;

class FooterSettingSeeder extends Seeder
{
    public function run()
    {
      

        // About Municipality Section
        $aboutMunicipalityLinks = [
            [
                'section' => 'about_municipality',
                'title' => 'front.about_us',
                'route_name' => 'about',
                'is_active' => true,
                'order' => 1
            ],
            [
                'section' => 'about_municipality',
                'title' => 'front.projects',
                'route_name' => 'projects',
                'is_active' => true,
                'order' => 2
            ],
          
            [
                'section' => 'about_municipality',
                'title' => 'front.services',
                'route_name' => 'services',
                'is_active' => true,
                'order' => 3
            ]
        ];

            // Quick Links Section
        $quickLinks = [
            [
                'section' => 'quick_links',
                'title' => 'front.important_links',
                'route_name' => 'importantLinks.index',
                'is_active' => true,
                'order' => 1
            ],
            [
                'section' => 'quick_links',
                'title' => 'front.faq',
                'route_name' => 'questions',
                'is_active' => true,
                'order' => 2
            ],
            [
                'section' => 'quick_links',
                'title' => 'front.terms_and_conditions',
                'route_name' => 'front.page.terms', // Different route
                'is_active' => true,
                'order' => 3 // Fixed order
            ],
            [
                'section' => 'quick_links',
                'title' => 'front.privacy_policy',
                'route_name' => 'front.page.privacy', // Different route
                'is_active' => true,
                'order' => 4 // Fixed order
            ]
        ];

        // Insert data
        foreach ($aboutMunicipalityLinks as $link) {
            FooterSetting::create($link);
        }

        foreach ($quickLinks as $link) {
            FooterSetting::create($link);
        }
    }
}