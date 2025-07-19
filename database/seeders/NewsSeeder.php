<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class NewsSeeder extends Seeder
{
    public function run()
    {
        DB::table('news')->insert([
            [
                'date_of_news' => '2025-07-15',
                'photo' => 'newss/summer-workshop.jpg',
                'title_en' => 'Summer Workshop Registration Open',
                'title_ar' => 'فتح التسجيل لورشة الصيف',
                'description_en' => 'Join our intensive summer workshop on digital skills and innovation. Limited seats available!',
                'description_ar' => 'انضم إلى ورشة الصيف المكثفة حول المهارات الرقمية والابتكار. مقاعد محدودة متاحة!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date_of_news' => '2025-07-10',
                'photo' => 'newss/scholarship-program.jpg',
                'title_en' => 'Scholarship Program Announcement',
                'title_ar' => 'إعلان برنامج المنح الدراسية',
                'description_en' => 'We are pleased to announce our new scholarship program for outstanding students.',
                'description_ar' => 'يسعدنا أن نعلن عن برنامج المنح الدراسية الجديد للطلاب المتميزين.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date_of_news' => '2025-07-05',
                'photo' => 'newss/partnership-announcement.jpg',
                'title_en' => 'New Strategic Partnership',
                'title_ar' => 'شراكة استراتيجية جديدة',
                'description_en' => 'We are excited to announce our partnership with leading technology companies.',
                'description_ar' => 'نحن متحمسون للإعلان عن شراكتنا مع شركات التكنولوجيا الرائدة.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
