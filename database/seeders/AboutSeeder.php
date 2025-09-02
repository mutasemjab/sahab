<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class AboutSeeder extends Seeder
{
    public function run()
    {
        DB::table('abouts')->insert([
            'description_en' => 'We are a leading organization dedicated to providing exceptional services and fostering innovation. Our team of experts works tirelessly to deliver solutions that meet the evolving needs of our clients. With years of experience and a commitment to excellence, we continue to set new standards in our industry.',
            'description_ar' => 'نحن منظمة رائدة مكرسة لتقديم خدمات استثنائية وتعزيز الابتكار. يعمل فريق خبرائنا بلا كلل لتقديم حلول تلبي الاحتياجات المتطورة لعملائنا. مع سنوات من الخبرة والالتزام بالتميز، نواصل وضع معايير جديدة في صناعتنا.',
            'photo' => 'about-us.jpg',
            'photo_of_organizational_structure' => 'test.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       
       
    }
}



