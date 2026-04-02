<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variants = [
            [
                'name'        => 'Original',
                'name_en'     => 'Original',
                'slug'        => 'original',
                'icon'        => '🥛',
                'color_class' => 'from-blue-50 to-indigo-100',
            ],
            [
                'name'        => 'Cokelat',
                'name_en'     => 'Chocolate',
                'slug'        => 'chocolate',
                'icon'        => '🍫',
                'color_class' => 'from-amber-50 to-orange-100',
            ],
            [
                'name'        => 'Pisang',
                'name_en'     => 'Banana',
                'slug'        => 'banana',
                'icon'        => '🍌',
                'color_class' => 'from-yellow-50 to-lime-100',
            ],
        ];

        foreach ($variants as $variant) {
            \App\Models\Variant::updateOrCreate(['slug' => $variant['slug']], $variant);
        }
    }
}
