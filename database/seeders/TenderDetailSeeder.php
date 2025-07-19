<?php

namespace Database\Seeders;

use App\Models\TenderDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class TenderDetailSeeder extends Seeder
{
    public function run()
    {
        $tenderDetails = [
            [
                'tender_id' => 1, // Road Infrastructure
                'video' => 'https://www.youtube.com/embed/sample1',
                'description_en' => 'Comprehensive road infrastructure development including new road construction, existing road maintenance, traffic management systems, and safety improvements.',
                'description_ar' => 'تطوير شامل للبنية التحتية للطرق بما في ذلك بناء طرق جديدة، صيانة الطرق الحالية، أنظمة إدارة المرور، وتحسينات السلامة.',
                'condition' => 'Previous experience in road construction projects minimum 5 years. Valid construction license. Insurance coverage required. Environmental impact assessment compliance.',
                'required_file' => 'Company registration certificate, Previous project portfolio, Financial statements, Insurance documents, Technical team qualifications, Environmental compliance certificate'
            ],
            [
                'tender_id' => 2, // Public Park Landscaping
                'video' => 'https://www.youtube.com/embed/sample2',
                'description_en' => 'Complete landscaping project including plant selection, irrigation systems, walkways, recreational facilities, and ongoing maintenance plan.',
                'description_ar' => 'مشروع تنسيق حدائق كامل بما في ذلك اختيار النباتات، أنظمة الري، الممرات، المرافق الترفيهية، وخطة الصيانة المستمرة.',
                'condition' => 'Landscaping certification required. Minimum 3 years experience in public park projects. Plant warranty for 2 years. Irrigation system maintenance for 1 year.',
                'required_file' => 'Landscaping certification, Portfolio of previous parks, Plant sourcing plan, Irrigation system specifications, Maintenance schedule, Cost breakdown'
            ],
            [
                'tender_id' => 3, // Water Treatment Plant
                'video' => 'https://www.youtube.com/embed/sample3',
                'description_en' => 'Advanced water treatment plant upgrade with latest technology, increased capacity, and environmental compliance standards.',
                'description_ar' => 'ترقية محطة معالجة المياه المتقدمة بأحدث التقنيات، زيادة الطاقة الإنتاجية، ومعايير الامتثال البيئي.',
                'condition' => 'Water treatment engineering expertise required. International certification for treatment equipment. Environmental compliance mandatory. 10-year maintenance agreement.',
                'required_file' => 'Engineering certification, Equipment specifications, Environmental impact study, Maintenance agreement terms, Quality assurance plan, Training program outline'
            ],
            [
                'tender_id' => 4, // LED Street Lighting
                'video' => 'https://www.youtube.com/embed/sample4',
                'description_en' => 'City-wide LED conversion project with smart lighting controls, energy monitoring, and automated maintenance systems.',
                'description_ar' => 'مشروع تحويل LED على مستوى المدينة مع أنظمة التحكم الذكية في الإضاءة، مراقبة الطاقة، وأنظمة الصيانة الآلية.',
                'condition' => 'LED technology certification. Energy efficiency guarantee. 5-year warranty on all equipment. Smart system integration capability.',
                'required_file' => 'LED certification, Energy efficiency calculations, Warranty documentation, Smart system specifications, Installation timeline, Cost analysis'
            ],
            [
                'tender_id' => 5, // Municipal Building (Expired)
                'video' => 'https://www.youtube.com/embed/sample5',
                'description_en' => 'Modern municipal administrative building with sustainable design, accessibility features, and advanced technology integration.',
                'description_ar' => 'مبنى إداري بلدي حديث بتصميم مستدام، ميزات إمكانية الوصول، وتكامل التكنولوجيا المتقدمة.',
                'condition' => 'Architectural license required. LEED certification preferred. Accessibility compliance mandatory. Local building code adherence.',
                'required_file' => 'Architectural license, LEED documentation, Accessibility compliance plan, Building code verification, Construction timeline, Material specifications'
            ],
            [
                'tender_id' => 6, // Waste Management
                'video' => 'https://www.youtube.com/embed/sample6',
                'description_en' => 'Comprehensive waste management system including collection optimization, recycling facility upgrade, and waste-to-energy integration.',
                'description_ar' => 'نظام إدارة النفايات الشامل بما في ذلك تحسين الجمع، ترقية مرافق إعادة التدوير، وتكامل النفايات إلى طاقة.',
                'condition' => 'Waste management certification. Environmental permits required. Recycling technology expertise. Community engagement plan.',
                'required_file' => 'Waste management certification, Environmental permits, Technology specifications, Community engagement strategy, Operations plan, Sustainability report'
            ],
            [
                'tender_id' => 7, // Digital Infrastructure
                'video' => 'https://www.youtube.com/embed/sample7',
                'description_en' => 'Smart city digital infrastructure including IoT sensors, data analytics platform, mobile applications, and citizen service portals.',
                'description_ar' => 'البنية التحتية الرقمية للمدينة الذكية بما في ذلك أجهزة استشعار إنترنت الأشياء، منصة تحليل البيانات، تطبيقات الهاتف المحمول، وبوابات خدمة المواطنين.',
                'condition' => 'IT certification required. Cybersecurity compliance. Data privacy protection. 24/7 technical support capability.',
                'required_file' => 'IT certification, Cybersecurity plan, Data privacy policy, Technical support structure, System architecture, Implementation roadmap'
            ],
            [
                'tender_id' => 8, // Transportation Hub
                'video' => 'https://www.youtube.com/embed/sample8',
                'description_en' => 'Modern transportation hub with multi-modal connectivity, passenger amenities, commercial spaces, and sustainable design features.',
                'description_ar' => 'مركز نقل حديث مع اتصال متعدد الوسائط، وسائل راحة الركاب، المساحات التجارية، وميزات التصميم المستدام.',
                'condition' => 'Transportation infrastructure experience. Safety compliance certification. Accessibility standards adherence. Sustainable design implementation.',
                'required_file' => 'Transportation project portfolio, Safety certification, Accessibility compliance, Sustainability plan, Design specifications, Construction schedule'
            ]
        ];

        foreach ($tenderDetails as $detail) {
            TenderDetail::create($detail);
        }
    }
}