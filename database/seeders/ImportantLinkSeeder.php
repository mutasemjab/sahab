<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImportantLink;

class ImportantLinkSeeder extends Seeder
{
    public function run()
    {
        $links = [
            // Government Institutions
            [
                'title_ar' => 'رئاسة الوزراء',
                'title_en' => 'Prime Ministry',
                'description_ar' => 'الموقع الرسمي لرئاسة الوزراء الأردنية',
                'description_en' => 'Official website of the Jordanian Prime Ministry',
                'icon' => '🏛️',
                'link' => 'https://www.pm.gov.jo'
            ],
            [
                'title_ar' => 'وزارة الداخلية',
                'title_en' => 'Ministry of Interior',
                'description_ar' => 'بوابة الخدمات والمعلومات الداخلية',
                'description_en' => 'Interior services and information portal',
                'icon' => '🏛️',
                'link' => 'https://www.moi.gov.jo'
            ],
            [
                'title_ar' => 'وزارة العدل',
                'title_en' => 'Ministry of Justice',
                'description_ar' => 'الموارد والخدمات القانونية',
                'description_en' => 'Legal resources and services',
                'icon' => '⚖️',
                'link' => 'https://www.moj.gov.jo'
            ],
            [
                'title_ar' => 'ديوان الخدمة المدنية',
                'title_en' => 'Civil Service Bureau',
                'description_ar' => 'خدمات الموظفين والوظائف الحكومية',
                'description_en' => 'Government employee services and jobs',
                'icon' => '👥',
                'link' => 'https://www.csb.gov.jo'
            ],

            // Municipal Services
            [
                'title_ar' => 'جدول الاجتماعات',
                'title_en' => 'Meeting Schedule',
                'description_ar' => 'تقويم الاجتماعات العامة والبلدية',
                'description_en' => 'Public and municipal meetings calendar',
                'icon' => '🗓️',
                'link' => '/meetings'
            ],
            [
                'title_ar' => 'التصاريح والرخص',
                'title_en' => 'Permits and Licenses',
                'description_ar' => 'خدمات التقديم والتجديد للتصاريح',
                'description_en' => 'Application and renewal services for permits',
                'icon' => '📄',
                'link' => '/permits'
            ],
            [
                'title_ar' => 'الملاحظات العامة',
                'title_en' => 'Public Feedback',
                'description_ar' => 'تقديم الاستفسارات والملاحظات للبلدية',
                'description_en' => 'Submit inquiries and feedback to the municipality',
                'icon' => '💬',
                'link' => '/suggestions/create'
            ],
            [
                'title_ar' => 'خدمات الطوارئ',
                'title_en' => 'Emergency Services',
                'description_ar' => 'أرقام الطوارئ والخدمات العاجلة',
                'description_en' => 'Emergency numbers and urgent services',
                'icon' => '🚨',
                'link' => '/emergency'
            ],
            [
                'title_ar' => 'دفع الفواتير',
                'title_en' => 'Bill Payment',
                'description_ar' => 'دفع فواتير الخدمات البلدية إلكترونياً',
                'description_en' => 'Pay municipal service bills online',
                'icon' => '💳',
                'link' => '/payments'
            ],

            // Partner Organizations
            [
                'title_ar' => 'جامعة الأردن',
                'title_en' => 'University of Jordan',
                'description_ar' => 'الموقع الرسمي لجامعة الأردن',
                'description_en' => 'Official website of University of Jordan',
                'icon' => '🏫',
                'link' => 'https://www.ju.edu.jo'
            ],
            [
                'title_ar' => 'غرفة تجارة عمان',
                'title_en' => 'Amman Chamber of Commerce',
                'description_ar' => 'موارد تطوير الأعمال والتجارة',
                'description_en' => 'Business development and trade resources',
                'icon' => '💼',
                'link' => 'https://www.ammanchamber.org.jo'
            ],
            [
                'title_ar' => 'جمعية البيئة الأردنية',
                'title_en' => 'Jordan Environment Society',
                'description_ar' => 'منظمة بيئية غير حكومية',
                'description_en' => 'Environmental non-governmental organization',
                'icon' => '🌱',
                'link' => 'https://www.jes.org.jo'
            ],
            [
                'title_ar' => 'الصليب الأحمر الأردني',
                'title_en' => 'Jordan Red Crescent',
                'description_ar' => 'المنظمة الإنسانية الوطنية',
                'description_en' => 'National humanitarian organization',
                'icon' => '❤️',
                'link' => 'https://www.jrcs.org.jo'
            ],
            [
                'title_ar' => 'مؤسسة التدريب المهني',
                'title_en' => 'Vocational Training Corporation',
                'description_ar' => 'برامج التدريب والتأهيل المهني',
                'description_en' => 'Professional training and qualification programs',
                'icon' => '🔧',
                'link' => 'https://www.vtc.gov.jo'
            ],
            [
                'title_ar' => 'مجلس محافظة الزرقاء',
                'title_en' => 'Zarqa Governorate Council',
                'description_ar' => 'الخدمات والمعلومات على مستوى المحافظة',
                'description_en' => 'Governorate-level services and information',
                'icon' => '🏢',
                'link' => 'https://www.zarqa.gov.jo'
            ]
        ];

        foreach ($links as $link) {
            ImportantLink::create($link);
        }
    }
}