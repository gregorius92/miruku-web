<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Section;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutSection = Section::where('section_name', 'about')->first();

        if (!$aboutSection) {
            return;
        }

        $features = [
            [
                'section_id' => $aboutSection->id,
                'icon' => '🥛',
                'title' => '0% Lactose',
                'title_en' => '0% Lactose',
                'description' => 'Aman untuk penderita lactose intolerance',
                'description_en' => 'Safe for lactose intolerance sufferers',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section_id' => $aboutSection->id,
                'icon' => '✨',
                'title' => 'Tekstur Creamy',
                'title_en' => 'Creamy Texture',
                'description' => 'Kelezatan premium di setiap tegukan',
                'description_en' => 'Premium deliciousness in every sip',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section_id' => $aboutSection->id,
                'icon' => '💚',
                'title' => 'Mudah Dicerna',
                'title_en' => 'Easy to Digest',
                'description' => 'Nyaman di perut, energi sepanjang hari',
                'description_en' => 'Comfortable for stomach, energy all day long',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($features as $featureData) {
            Feature::updateOrCreate(
                [
                    'section_id' => $featureData['section_id'],
                    'title' => $featureData['title']
                ],
                $featureData
            );
        }
    }
}
