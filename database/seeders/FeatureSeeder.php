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
        // 1. About Section Features
        $aboutSection = Section::where('section_name', 'about')->first();
        if ($aboutSection) {
            $aboutFeatures = [
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

            foreach ($aboutFeatures as $featureData) {
                Feature::updateOrCreate(
                    ['section_id' => $featureData['section_id'], 'title' => $featureData['title']],
                    $featureData
                );
            }
        }

        // 2. Benefits Section Features
        $benefitsSection = Section::where('section_name', 'benefits')->first();
        if ($benefitsSection) {
            $benefitsFeatures = [
                [
                    'section_id' => $benefitsSection->id,
                    'icon' => '🧬',
                    'title' => 'Baik untuk Pencernaan',
                    'title_en' => 'Good for Digestion',
                    'description' => 'Bebas laktosa berarti perutmu tidak akan kembung, nyeri, atau tidak nyaman. Nikmati susu tanpa drama pencernaan.',
                    'description_en' => 'Lactose-free means your stomach won\'t get bloated, painful, or uncomfortable. Enjoy milk without digestive drama.',
                    'order' => 1,
                    'is_active' => true,
                ],
                [
                    'section_id' => $benefitsSection->id,
                    'icon' => '🦴',
                    'title' => 'Kaya Kalsium',
                    'title_en' => 'Rich in Calcium',
                    'description' => 'Kandungan kalsium Miruku setara dengan susu biasa. Tulang kuat, gigi sehat — tanpa kompromi nutrisi.',
                    'description_en' => 'Miruku\'s calcium content is equivalent to regular milk. Strong bones, healthy teeth — without compromising nutrition.',
                    'order' => 2,
                    'is_active' => true,
                ],
                [
                    'section_id' => $benefitsSection->id,
                    'icon' => '⚡',
                    'title' => 'Energi Sepanjang Hari',
                    'title_en' => 'Energy Throughout the Day',
                    'description' => 'Protein berkualitas tinggi memberikan energi tahan lama untuk mendukung aktivitas harianmu.',
                    'description_en' => 'High-quality protein provides long-lasting energy to support your daily activities.',
                    'order' => 3,
                    'is_active' => true,
                ],
                [
                    'section_id' => $benefitsSection->id,
                    'icon' => '🌿',
                    'title' => 'Alami & Bersih',
                    'title_en' => 'Natural & Clean',
                    'description' => 'Tanpa pengawet buatan, tanpa warna sintetis. Hanya susu terbaik yang sudah melalui proses laktase alami.',
                    'description_en' => 'No artificial preservatives, no synthetic colors. Only the best milk that has gone through a natural lactase process.',
                    'order' => 4,
                    'is_active' => true,
                ],
                [
                    'section_id' => $benefitsSection->id,
                    'icon' => '👨‍👩‍👧‍👦',
                    'title' => 'Untuk Seluruh Keluarga',
                    'title_en' => 'For the Whole Family',
                    'description' => 'Aman untuk anak-anak, remaja, dewasa, hingga lansia. Miruku adalah susu untuk semua generasi.',
                    'description_en' => 'Safe for children, teenagers, adults, and seniors. Miruku is milk for all generations.',
                    'order' => 5,
                    'is_active' => true,
                ],
                [
                    'section_id' => $benefitsSection->id,
                    'icon' => '🏆',
                    'title' => 'Kualitas Premium',
                    'title_en' => 'Premium Quality',
                    'description' => 'Dipilih dari sapi-sapi terbaik dengan standar kebersihan dan kualitas kelas dunia.',
                    'description_en' => 'Selected from the best cows with world-class standards of cleanliness and quality.',
                    'order' => 6,
                    'is_active' => true,
                ],
            ];

            foreach ($benefitsFeatures as $featureData) {
                Feature::updateOrCreate(
                    ['section_id' => $featureData['section_id'], 'title' => $featureData['title']],
                    $featureData
                );
            }
        }
    }
}
