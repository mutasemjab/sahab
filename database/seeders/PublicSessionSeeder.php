<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PublicSessionSeeder extends Seeder
{
    public function run()
    {
        DB::table('public_sessions')->insert([
            [
                'date_of_event' => '2025-08-10',
                'from_time' => '14:00',
                'to_time' => '16:00',
                'title_en' => 'Introduction to Entrepreneurship',
                'title_ar' => 'مقدمة في ريادة الأعمال',
                'description_en' => 'Learn the basics of starting your own business and entrepreneurial mindset.',
                'description_ar' => 'تعلم أساسيات بدء عملك التجاري الخاص وعقلية ريادة الأعمال.',
                'type' => 1, // open
                'video' => 'https://www.youtube.com/watch?v=sample1',
                'what_expect' => 'Basic entrepreneurship concepts, business planning, and Q&A session',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date_of_event' => '2025-08-25',
                'from_time' => '14:00',
                'to_time' => '16:00',
                'title_en' => 'Financial Planning for Startups',
                'title_ar' => 'التخطيط المالي للشركات الناشئة',
                'description_en' => 'Essential financial planning strategies for new businesses.',
                'description_ar' => 'استراتيجيات التخطيط المالي الأساسية للشركات الجديدة.',
                'type' => 2, // soon
                'video' => null,
                'what_expect' => 'Budgeting techniques, funding options, and financial forecasting',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date_of_event' => '2025-07-20',
                'from_time' => '14:00',
                'to_time' => '16:00',
                'title_en' => 'Digital Transformation Trends',
                'title_ar' => 'اتجاهات التحول الرقمي',
                'description_en' => 'Explore the latest trends in digital transformation and their impact on businesses.',
                'description_ar' => 'استكشف أحدث اتجاهات التحول الرقمي وتأثيرها على الأعمال.',
                'type' => 1, // open
                'video' => 'https://www.youtube.com/watch?v=sample2',
                'what_expect' => 'Technology trends, implementation strategies, and case studies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
