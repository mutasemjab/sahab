<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewListenSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class NewListenSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sessions = [
            [
                'title_en' => 'Meditation and Mindfulness',
                'title_ar' => 'التأمل واليقظة الذهنية',
                'description_en' => 'Join us for a relaxing meditation session focused on mindfulness and inner peace. This session will help you reduce stress and find mental clarity through guided breathing exercises and peaceful meditation techniques.',
                'description_ar' => 'انضم إلينا في جلسة تأمل مريحة تركز على اليقظة الذهنية والسلام الداخلي. ستساعدك هذه الجلسة على تقليل التوتر وإيجاد الوضوح الذهني من خلال تمارين التنفس الموجهة وتقنيات التأمل المسالمة.',
                'photo' => 'meditation.jpg'
            ],
            [
                'title_en' => 'Classical Music Appreciation',
                'title_ar' => 'تذوق الموسيقى الكلاسيكية',
                'description_en' => 'Explore the beautiful world of classical music with expert commentary and carefully selected pieces from renowned composers. Learn to appreciate the nuances and emotional depth of classical compositions.',
                'description_ar' => 'استكشف عالم الموسيقى الكلاسيكية الجميل مع تعليقات الخبراء والقطع المختارة بعناية من أشهر المؤلفين. تعلم تقدير الفروق الدقيقة والعمق العاطفي للمؤلفات الكلاسيكية.',
                'photo' => 'classical.jpg'
            ],
            [
                'title_en' => 'Nature Sounds Therapy',
                'title_ar' => 'علاج أصوات الطبيعة',
                'description_en' => 'Immerse yourself in the healing power of nature with this therapeutic listening session featuring forest sounds, ocean waves, and gentle rainfall. Perfect for relaxation and stress relief.',
                'description_ar' => 'انغمس في القوة الشافية للطبيعة مع جلسة الاستماع العلاجية هذه التي تضم أصوات الغابة وأمواج المحيط والمطر اللطيف. مثالية للاسترخاء وتخفيف التوتر.',
                'photo' => 'nature.jpg'
            ],
           
        ];

        foreach ($sessions as $sessionData) {
            NewListenSession::create($sessionData);
        }
    }
}