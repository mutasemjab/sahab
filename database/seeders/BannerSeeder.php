<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run()
    {
        DB::table('banners')->insert([
            [
                'title_en' => 'Welcome to Our Platform',
                'title_ar' => 'مرحباً بكم في منصتنا',
                'description_en' => 'Discover amazing services and connect with our community of professionals.',
                'description_ar' => 'اكتشف خدمات مذهلة وتواصل مع مجتمعنا من المحترفين.',
                'photo' => 'banners/banner1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_en' => 'Join Our Events',
                'title_ar' => 'انضم إلى فعالياتنا',
                'description_en' => 'Participate in our upcoming events and workshops to enhance your skills.',
                'description_ar' => 'شارك في فعالياتنا وورش العمل القادمة لتطوير مهاراتك.',
                'photo' => 'banners/banner2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_en' => 'Expert Consultation',
                'title_ar' => 'استشارة خبراء',
                'description_en' => 'Get professional advice from our certified experts in various fields.',
                'description_ar' => 'احصل على نصائح مهنية من خبرائنا المعتمدين في مختلف المجالات.',
                'photo' => 'banners/banner3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
