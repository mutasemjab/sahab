<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
         $this->call([
            BannerSeeder::class,
            AboutSeeder::class,
            CompleteAboutSeeder::class,
            EventSeeder::class,
            ServiceSeeder::class,
            ServiceDetailSeeder::class,
            PublicSessionSeeder::class,
            ProjectSeeder::class,
            AdvSeeder::class,
            NewsSeeder::class,
            QuestionSeeder::class,
            SettingSeeder::class,
            OurPartSeeder::class,
            MunicipalCouncilSeeder::class,
            LawSeeder::class,
            TenderSeeder::class,
            TenderDetailSeeder::class,
            CommunityInitiativeSeeder::class,
            ImportantLinkSeeder::class,
            NewListenSessionSeeder::class
        ]);
    }
}
