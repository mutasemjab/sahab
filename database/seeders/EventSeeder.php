<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

// database/seeders/EventSeeder.php
class EventSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'date_of_event' => '2025-08-15',
                'title_en' => 'Digital Marketing Workshop',
                'title_ar' => 'ورشة التسويق الرقمي',
                'link_google_meet' => 'https://meet.google.com/abc-defg-hij',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date_of_event' => '2025-08-22',
                'title_en' => 'Business Development Seminar',
                'title_ar' => 'ندوة تطوير الأعمال',
                'link_google_meet' => 'https://meet.google.com/xyz-uvwx-yzd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date_of_event' => '2025-09-05',
                'title_en' => 'Technology Innovation Conference',
                'title_ar' => 'مؤتمر ابتكار التكنولوجيا',
                'link_google_meet' => 'https://meet.google.com/tech-conf-2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
