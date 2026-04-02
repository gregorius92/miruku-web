<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $units = [
            ['name' => '1000ml', 'name_en' => '1000ml', 'slug' => '1000ml', 'sort_order' => 1],
            ['name' => '500ml', 'name_en' => '500ml', 'slug' => '500ml', 'sort_order' => 2],
            ['name' => '250ml', 'name_en' => '250ml', 'slug' => '250ml', 'sort_order' => 3],
        ];

        foreach ($units as $unit) {
            \App\Models\ProductUnit::updateOrCreate(['slug' => $unit['slug']], $unit);
        }
    }
}
