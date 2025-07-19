<?php

namespace Database\Seeders;

use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class TenderSeeder extends Seeder
{
    public function run()
    {
        $tenders = [
            [
                'number' => 'TEN2025-001',
                'title_en' => 'Road Infrastructure Development Project',
                'title_ar' => 'مشروع تطوير البنية التحتية للطرق',
                'description_en' => 'Major project for building and maintaining roads in the Sahab industrial area',
                'description_ar' => 'مشروع كبير لبناء وصيانة الطرق في منطقة سحاب الصناعية',
                'cost' => '850,000 USD',
                'date_publish' => Carbon::now()->subDays(20),
                'date_close' => Carbon::now()->addDays(10),
                'photo' => 'tenders/road-infrastructure.jpg',
                'pdf' => 'tenders/tender-001-documents.pdf',
                'pdf_file' => json_encode(['tenders/tender-001-specs.pdf', 'tenders/tender-001-requirements.pdf'])
            ],
            [
                'number' => 'TEN2025-002',
                'title_en' => 'Public Park Landscaping Project',
                'title_ar' => 'مشروع تنسيق الحدائق العامة',
                'description_en' => 'Complete landscaping and beautification of central public parks with modern facilities',
                'description_ar' => 'تنسيق وتجميل كامل للحدائق العامة المركزية مع مرافق حديثة',
                'cost' => '450,000 USD',
                'date_publish' => Carbon::now()->subDays(15),
                'date_close' => Carbon::now()->addDays(25),
                'photo' => 'tenders/park-landscaping.jpg',
                'pdf' => 'tenders/tender-002-documents.pdf',
                'pdf_file' => json_encode(['tenders/tender-002-landscape-plans.pdf'])
            ],
            [
                'number' => 'TEN2025-003',
                'title_en' => 'Water Treatment Plant Upgrade',
                'title_ar' => 'ترقية محطة معالجة المياه',
                'description_en' => 'Modernization and capacity expansion of existing water treatment facilities',
                'description_ar' => 'تحديث وتوسيع طاقة مرافق معالجة المياه الحالية',
                'cost' => '1,200,000 USD',
                'date_publish' => Carbon::now()->subDays(30),
                'date_close' => Carbon::now()->addDays(5),
                'photo' => 'tenders/water-treatment.jpg',
                'pdf' => 'tenders/tender-003-documents.pdf',
                'pdf_file' => json_encode(['tenders/tender-003-technical-specs.pdf', 'tenders/tender-003-environmental-report.pdf'])
            ],
            [
                'number' => 'TEN2025-004',
                'title_en' => 'Street Lighting LED Conversion',
                'title_ar' => 'تحويل إنارة الشوارع إلى LED',
                'description_en' => 'City-wide conversion of street lighting to energy-efficient LED systems',
                'description_ar' => 'تحويل إنارة الشوارع في جميع أنحاء المدينة إلى أنظمة LED موفرة للطاقة',
                'cost' => '320,000 USD',
                'date_publish' => Carbon::now()->subDays(10),
                'date_close' => Carbon::now()->addDays(20),
                'photo' => 'tenders/led-lighting.jpg',
                'pdf' => 'tenders/tender-004-documents.pdf',
                'pdf_file' => json_encode(['tenders/tender-004-lighting-plan.pdf'])
            ],
            [
                'number' => 'TEN2025-005',
                'title_en' => 'Municipal Building Construction',
                'title_ar' => 'بناء المبنى البلدي',
                'description_en' => 'Construction of new municipal administrative building with modern facilities',
                'description_ar' => 'بناء مبنى إداري بلدي جديد مع مرافق حديثة',
                'cost' => '2,500,000 USD',
                'date_publish' => Carbon::now()->subDays(45),
                'date_close' => Carbon::now()->subDays(5), // Expired
                'photo' => 'tenders/municipal-building.jpg',
                'pdf' => 'tenders/tender-005-documents.pdf',
                'pdf_file' => json_encode(['tenders/tender-005-architectural-plans.pdf', 'tenders/tender-005-structural-plans.pdf'])
            ],
            [
                'number' => 'TEN2025-006',
                'title_en' => 'Waste Management System Overhaul',
                'title_ar' => 'إصلاح شامل لنظام إدارة النفايات',
                'description_en' => 'Complete modernization of waste collection and recycling infrastructure',
                'description_ar' => 'تحديث كامل لبنية جمع النفايات وإعادة التدوير',
                'cost' => '680,000 USD',
                'date_publish' => Carbon::now()->subDays(5),
                'date_close' => Carbon::now()->addDays(30),
                'photo' => 'tenders/waste-management.jpg',
                'pdf' => 'tenders/tender-006-documents.pdf',
                'pdf_file' => json_encode(['tenders/tender-006-waste-plan.pdf'])
            ],
            [
                'number' => 'TEN2025-007',
                'title_en' => 'Digital Infrastructure Upgrade',
                'title_ar' => 'ترقية البنية التحتية الرقمية',
                'description_en' => 'Implementation of smart city technologies and digital service platforms',
                'description_ar' => 'تنفيذ تقنيات المدينة الذكية ومنصات الخدمات الرقمية',
                'cost' => '950,000 USD',
                'date_publish' => Carbon::now()->subDays(25),
                'date_close' => Carbon::now()->addDays(15),
                'photo' => 'tenders/digital-infrastructure.jpg',
                'pdf' => 'tenders/tender-007-documents.pdf',
                'pdf_file' => json_encode(['tenders/tender-007-tech-specs.pdf', 'tenders/tender-007-implementation-plan.pdf'])
            ],
            [
                'number' => 'TEN2025-008',
                'title_en' => 'Public Transportation Hub',
                'title_ar' => 'مركز النقل العام',
                'description_en' => 'Development of central public transportation hub with modern amenities',
                'description_ar' => 'تطوير مركز النقل العام المركزي مع وسائل الراحة الحديثة',
                'cost' => '1,800,000 USD',
                'date_publish' => Carbon::now()->subDays(35),
                'date_close' => Carbon::now()->addDays(40),
                'photo' => 'tenders/transport-hub.jpg',
                'pdf' => 'tenders/tender-008-documents.pdf',
                'pdf_file' => json_encode(['tenders/tender-008-transport-plan.pdf'])
            ]
        ];

        foreach ($tenders as $tender) {
            Tender::create($tender);
        }
    }
}


