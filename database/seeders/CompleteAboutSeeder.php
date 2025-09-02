<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompleteAbout;

class CompleteAboutSeeder extends Seeder
{
    public function run()
    {
        $completeAbouts = [
            [
                'title_en' => 'Values',
                'title_ar' => 'القيم',
                'description_en' => 'Transparency, innovation, community service, and environmental responsibility.',
                'description_ar' => 'الشفافية، الابتكار، خدمة المجتمع، والمسؤولية البيئية.',
                'icon' => '⭐',
            ],
            [
                'title_en' => 'Mission',
                'title_ar' => 'المهمة',
                'description_en' => 'Providing excellent municipal services while promoting community engagement and sustainable development.',
                'description_ar' => 'تقديم خدمات بلدية ممتازة مع تعزيز المشاركة المجتمعية والتنمية المستدامة.',
                'icon' => '🎯',
            ],
            [
                'title_en' => 'Vision',
                'title_ar' => 'الرؤية',
                'description_en' => 'Transforming Sahab into a sustainable smart city that provides the highest quality of life for its residents.',
                'description_ar' => 'تحويل سحاب إلى مدينة ذكية مستدامة توفر أعلى جودة للحياة لسكانها.',
                'icon' => '👁️',
           
            ]
        ];

        foreach ($completeAbouts as $about) {
            CompleteAbout::create($about);
        }
    }
}