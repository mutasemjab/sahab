<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\Law;

class LawSeeder extends Seeder
{
    public function run()
    {
        $laws = [
            [
                'title_en' => 'Municipal Law',
                'title_ar' => 'القانون البلدي',
                'description_en' => 'Complete set of municipal orders and regulations',
                'description_ar' => 'مجموعة كاملة من الأوامر واللوائح البلدية',
                'pdf' => 'laws/municipal-law.pdf'
            ],
            [
                'title_en' => 'Zoning Laws',
                'title_ar' => 'قوانين تقسيم المناطق',
                'description_en' => 'Regulations regarding land use and development',
                'description_ar' => 'لوائح بشأن استخدام الأراضي والتنمية',
                'pdf' => 'laws/zoning-laws.pdf'
            ],
            [
                'title_en' => 'Environmental Guidelines',
                'title_ar' => 'إرشادات بيئية',
                'description_en' => 'Policies for environmental protection',
                'description_ar' => 'سياسات لحماية البيئة',
                'pdf' => 'laws/environmental-guidelines.pdf'
            ],
            [
                'title_en' => 'Building Code',
                'title_ar' => 'قانون البناء',
                'description_en' => 'Building and renovation standards',
                'description_ar' => 'معايير البناء والتجديد',
                'pdf' => 'laws/building-code.pdf'
            ]
        ];

        foreach ($laws as $law) {
            Law::create($law);
        }
    }
}




