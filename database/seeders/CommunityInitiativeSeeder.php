<?php

namespace Database\Seeders;

use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\CommunityInitiative;
use App\Models\CommunityInitiatives;

class CommunityInitiativeSeeder extends Seeder
{
    public function run()
    {
        $initiatives = [
            [
                'title_en' => 'Green Spaces Development',
                'title_ar' => 'تطوير المساحات الخضراء',
                'description_en' => 'Creating more parks and green spaces in residential areas to improve air quality and provide recreational facilities for families.',
                'description_ar' => 'إنشاء المزيد من الحدائق والمساحات الخضراء في المناطق السكنية لتحسين جودة الهواء وتوفير مرافق ترفيهية للعائلات.',
                'date_finish' => Carbon::now()->addDays(30),
                'name' => 'أحمد محمد الخالدي',
                'phone' => '+962791234567',
                'age' => '26-35',
                'photo' => json_encode(['community/initiatives/green-spaces-1.jpg', 'community/initiatives/green-spaces-2.jpg']),
                'gender' => 1, // Male
                'hide_information' => 2, // Show
                'status' => 1, // Pending
                'created_at' => Carbon::now()->subDays(10),
            ],
            [
                'title_en' => 'Youth Center Renovation',
                'title_ar' => 'تجديد مركز الشباب',
                'description_en' => 'Upgrading facilities at the local youth center to provide better sports and educational programs for young people.',
                'description_ar' => 'ترقية المرافق في مركز الشباب المحلي لتوفير برامج رياضية وتعليمية أفضل للشباب.',
                'date_finish' => Carbon::now()->addDays(45),
                'name' => 'فاطمة سالم النعيمي',
                'phone' => '+962798765432',
                'age' => '18-25',
                'photo' => json_encode(['community/initiatives/youth-center-1.jpg']),
                'gender' => 2, // Female
                'hide_information' => 1, // Hide
                'status' => 2, // Working
                'created_at' => Carbon::now()->subDays(20),
            ],
            [
                'title_en' => 'Digital Literacy Program',
                'title_ar' => 'برنامج محو الأمية الرقمية',
                'description_en' => 'Establishing computer training centers for elderly citizens to help them navigate modern technology.',
                'description_ar' => 'إنشاء مراكز تدريب الكمبيوتر لكبار السن لمساعدتهم على التنقل في التكنولوجيا الحديثة.',
                'date_finish' => Carbon::now()->addDays(60),
                'name' => 'خالد عبدالله الزهراني',
                'phone' => '+962775555555',
                'age' => '36-45',
                'photo' => json_encode(['community/initiatives/digital-literacy.jpg']),
                'gender' => 1, // Male
                'hide_information' => 2, // Show
                'status' => 1, // Pending
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'title_en' => 'Community Safety Enhancement',
                'title_ar' => 'تعزيز السلامة المجتمعية',
                'description_en' => 'Installing better street lighting and security cameras in residential neighborhoods to improve public safety.',
                'description_ar' => 'تركيب إضاءة أفضل للشوارع وكاميرات الأمان في الأحياء السكنية لتحسين السلامة العامة.',
                'date_finish' => Carbon::now()->addDays(90),
                'name' => 'نور الهدى محمود',
                'phone' => '+962791234567',
                'age' => '26-35',
                'photo' => json_encode(['community/initiatives/safety-1.jpg', 'community/initiatives/safety-2.jpg']),
                'gender' => 2, // Female
                'hide_information' => 2, // Show
                'status' => 1, // Pending
                'created_at' => Carbon::now()->subDays(15),
            ],
            [
                'title_en' => 'Local Business Support',
                'title_ar' => 'دعم الأعمال المحلية',
                'description_en' => 'Creating a marketplace for local artisans and small businesses to showcase and sell their products.',
                'description_ar' => 'إنشاء سوق للحرفيين المحليين والشركات الصغيرة لعرض وبيع منتجاتهم.',
                'date_finish' => Carbon::now()->addDays(75),
                'name' => 'محمد علي السويطي',
                'phone' => '+962788888888',
                'age' => '46-55',
                'photo' => json_encode(['community/initiatives/local-business.jpg']),
                'gender' => 1, // Male
                'hide_information' => 1, // Hide
                'status' => 3, // Done
                'created_at' => Carbon::now()->subDays(120),
            ]
        ];

        foreach ($initiatives as $initiative) {
            CommunityInitiatives::create($initiative);
        }
    }
}


