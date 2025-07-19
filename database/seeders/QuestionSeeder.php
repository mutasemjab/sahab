<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        DB::table('questions')->insert([
            [
                'question_en' => 'How do I register for an event?',
                'question_ar' => 'كيف يمكنني التسجيل في فعالية؟',
                'answer_en' => 'You can register for events through our website by clicking on the event you\'re interested in and filling out the registration form.',
                'answer_ar' => 'يمكنك التسجيل في الفعاليات من خلال موقعنا الإلكتروني بالنقر على الفعالية التي تهمك وملء نموذج التسجيل.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_en' => 'What are your service fees?',
                'question_ar' => 'ما هي رسوم خدماتكم؟',
                'answer_en' => 'Our service fees vary depending on the type and duration of the service. Please contact us for detailed pricing information.',
                'answer_ar' => 'تختلف رسوم خدماتنا حسب نوع ومدة الخدمة. يرجى الاتصال بنا للحصول على معلومات تفصيلية عن الأسعار.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_en' => 'Do you offer online consultations?',
                'question_ar' => 'هل تقدمون استشارات عبر الإنترنت؟',
                'answer_en' => 'Yes, we offer both online and in-person consultations. You can choose the format that works best for you.',
                'answer_ar' => 'نعم، نقدم استشارات عبر الإنترنت وشخصياً. يمكنك اختيار الصيغة التي تناسبك.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_en' => 'How can I access session recordings?',
                'question_ar' => 'كيف يمكنني الوصول إلى تسجيلات الجلسات؟',
                'answer_en' => 'Session recordings are available to registered participants. You will receive access links via email after the session.',
                'answer_ar' => 'تسجيلات الجلسات متاحة للمشاركين المسجلين. ستتلقى روابط الوصول عبر البريد الإلكتروني بعد الجلسة.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
