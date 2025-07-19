<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\MunicipalCouncil;

class MunicipalCouncilSeeder extends Seeder
{
    public function run()
    {
        $councilMembers = [
            [
                'title_en' => 'Sarah Khalil',
                'title_ar' => 'سارة خليل',
                'description_en' => 'Mayor',
                'description_ar' => 'العمدة',
                'icon' => 'council-members/sarah-khalil.jpg'
            ],
            [
                'title_en' => 'Mohammed Khalil',
                'title_ar' => 'محمد خليل',
                'description_en' => 'Deputy Mayor',
                'description_ar' => 'نائب العمدة',
                'icon' => 'council-members/mohammed-khalil.jpg'
            ],
            [
                'title_en' => 'Mohammed Hassan',
                'title_ar' => 'محمد حسن',
                'description_en' => 'Council Member',
                'description_ar' => 'عضو المجلس',
                'icon' => 'council-members/mohammed-hassan.jpg'
            ],
            [
                'title_en' => 'Layla Omar',
                'title_ar' => 'ليلى عمر',
                'description_en' => 'Council Member',
                'description_ar' => 'عضو المجلس',
                'icon' => 'council-members/layla-omar.jpg'
            ]
        ];

        foreach ($councilMembers as $member) {
            MunicipalCouncil::create($member);
        }
    }
}



