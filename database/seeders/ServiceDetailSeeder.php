<?php

namespace Database\Seeders;

use App\Models\ServiceDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ServiceDetailSeeder extends Seeder
{
    public function run()
    {
        $serviceDetails = [
            [
                'service_id' => 1, // Building Permits
                'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'description_en' => 'Complete guide for building permit application process including all required steps and documentation.',
                'description_ar' => 'دليل شامل لعملية تقديم طلب تصريح البناء بما في ذلك جميع الخطوات والوثائق المطلوبة.',
                'condition' => 'Property ownership documents required. Building plans must be approved by licensed engineer. Compliance with zoning regulations mandatory.',
                'required_file' => 'Property deed, Engineering plans, Survey certificate, Identity documents, Municipal clearance certificate',
                'steps' => 'Property deed, Engineering plans, Survey certificate, Identity documents, Municipal clearance certificate'
            ],
            [
                'service_id' => 2, // Waste Management
                'video' => 'https://www.youtube.com/embed/sample2',
                'description_en' => 'Comprehensive waste collection and recycling service scheduling system.',
                'description_ar' => 'نظام شامل لجدولة خدمات جمع النفايات وإعادة التدوير.',
                'condition' => 'Valid address verification required. Compliance with waste separation guidelines.',
                'required_file' => 'Address verification document, Identity card, Property registration',
                'steps' => 'Property deed, Engineering plans, Survey certificate, Identity documents, Municipal clearance certificate'

            ],
            [
                'service_id' => 3, // Business Licenses
                'video' => 'https://www.youtube.com/embed/sample3',
                'description_en' => 'Business license application and renewal process for all types of commercial activities.',
                'description_ar' => 'عملية تقديم طلب ترخيص الأعمال والتجديد لجميع أنواع الأنشطة التجارية.',
                'condition' => 'Valid commercial registration required. Compliance with safety regulations. Fire safety certificate mandatory for certain business types.',
                'required_file' => 'Commercial registration, Fire safety certificate, Identity documents, Lease agreement, Professional certificates (if applicable)',
                'steps' => 'Property deed, Engineering plans, Survey certificate, Identity documents, Municipal clearance certificate'

            ],
           
        ];

        foreach ($serviceDetails as $detail) {
            ServiceDetail::create($detail);
        }
    }
}
