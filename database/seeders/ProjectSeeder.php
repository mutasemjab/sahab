<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([
            [
                'time' => '6 months',
                'title_en' => 'Smart City Initiative',
                'title_ar' => 'مبادرة المدينة الذكية',
                'description_en' => 'A comprehensive project to digitize city services and improve citizen experience.',
                'description_ar' => 'مشروع شامل لرقمنة خدمات المدينة وتحسين تجربة المواطنين.',
                'photo' => 'projects/smart-city.jpg',
                'type' => 1, // done
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '9 months',
                'title_en' => 'E-Learning Platform Development',
                'title_ar' => 'تطوير منصة التعلم الإلكتروني',
                'description_en' => 'Building a comprehensive online learning platform for educational institutions.',
                'description_ar' => 'بناء منصة تعلم شاملة عبر الإنترنت للمؤسسات التعليمية.',
                'photo' => 'projects/elearning-platform.jpg',
                'type' => 2, // ongoing
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '12 months',
                'title_en' => 'Healthcare Management System',
                'title_ar' => 'نظام إدارة الرعاية الصحية',
                'description_en' => 'Developing an integrated healthcare management system for hospitals and clinics.',
                'description_ar' => 'تطوير نظام إدارة رعاية صحية متكامل للمستشفيات والعيادات.',
                'photo' => 'projects/healthcare-system.jpg',
                'type' => 3, // planned
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

