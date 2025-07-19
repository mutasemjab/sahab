<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'title_en' => 'Business Consultation',
                'title_ar' => 'استشارات الأعمال',
                'description_en' => 'Professional business advice to help you grow your company and achieve your goals.',
                'description_ar' => 'نصائح مهنية للأعمال لمساعدتك في تنمية شركتك وتحقيق أهدافك.',
                'icon' => 'fas fa-cog',
                'pdf' => 'services/business-consultation.pdf',
                'target_audience' => 'Small to medium businesses',
                'duration_service' => '2 hours',
                'service_channel' => 'Online/In-person',
                'service_cost' => '$150',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_en' => 'Digital Marketing',
                'title_ar' => 'التسويق الرقمي',
                'description_en' => 'Comprehensive digital marketing strategies to boost your online presence.',
                'description_ar' => 'استراتيجيات التسويق الرقمي الشاملة لتعزيز وجودك عبر الإنترنت.',
                'icon' => 'fas fa-cog',
                'pdf' => 'services/digital-marketing.pdf',
                'target_audience' => 'Businesses of all sizes',
                'duration_service' => '3 months',
                'service_channel' => 'Online',
                'service_cost' => '$500/month',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_en' => 'Technical Training',
                'title_ar' => 'التدريب التقني',
                'description_en' => 'Hands-on technical training programs to enhance your team\'s skills.',
                'description_ar' => 'برامج التدريب التقني العملي لتطوير مهارات فريقك.',
                'icon' => 'fas fa-cog',
                'pdf' => 'services/technical-training.pdf',
                'target_audience' => 'IT professionals and students',
                'duration_service' => '6 weeks',
                'service_channel' => 'Hybrid',
                'service_cost' => '$300',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
