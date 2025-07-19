<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

use App\Models\OurPart;

class OurPartSeeder extends Seeder
{
    public function run()
    {
        $ourParts = [
            [
                'title_en' => 'Urban Development',
                'title_ar' => 'التنمية الحضرية',
                'description_en' => 'Planning and developing the city\'s infrastructure',
                'description_ar' => 'التخطيط وتطوير البنية التحتية للمدينة',
                'icon' => 'fas fa-city'
            ],
            [
                'title_en' => 'Community Services',
                'title_ar' => 'الخدمات المجتمعية',
                'description_en' => 'Social programs and community support',
                'description_ar' => 'البرامج الاجتماعية ودعم المجتمع',
                'icon' => 'fas fa-users'
            ],
            [
                'title_en' => 'Economic Development',
                'title_ar' => 'التنمية الاقتصادية',
                'description_en' => 'Business growth and economic initiatives',
                'description_ar' => 'نمو الأعمال والمبادرات الاقتصادية',
                'icon' => 'fas fa-chart-line'
            ],
            [
                'title_en' => 'Education & Culture',
                'title_ar' => 'التعليم والثقافة',
                'description_en' => 'Educational programs and cultural events',
                'description_ar' => 'البرامج التعليمية والفعاليات الثقافية',
                'icon' => 'fas fa-book'
            ],
            [
                'title_en' => 'Public Safety',
                'title_ar' => 'السلامة العامة',
                'description_en' => 'Emergency services and public security',
                'description_ar' => 'خدمات الطوارئ والأمن العام',
                'icon' => 'fas fa-shield-alt'
            ],
            [
                'title_en' => 'Environmental Services',
                'title_ar' => 'الخدمات البيئية',
                'description_en' => 'Environmental protection and sustainability',
                'description_ar' => 'حماية البيئة والاستدامة',
                'icon' => 'fas fa-tree'
            ]
        ];

        foreach ($ourParts as $part) {
            OurPart::create($part);
        }
    }
}



