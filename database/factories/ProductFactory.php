<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        $variant = $this->faker->randomElement(['original', 'chocolate', 'banana']);
        $unit = $this->faker->randomElement(['1000ml', '500ml', '250ml']);
        
        return [
            'name'           => ucfirst($name),
            'name_en'        => ucfirst($name) . ' (EN)',
            'slug'           => \Illuminate\Support\Str::slug($name) . '-' . \Illuminate\Support\Str::random(6),
            'description'    => $this->faker->sentence(10),
            'description_en' => $this->faker->sentence(10) . ' (EN)',
            'body'           => '<p>' . implode('</p><p>', $this->faker->paragraphs(3)) . '</p>',
            'body_en'        => '<p>' . implode('</p><p>', $this->faker->paragraphs(3)) . '</p> (EN)',
            'price'          => $this->faker->randomElement([25000, 30000, 35000, 45000]),
            'unit'           => $unit,
            'variant'        => $variant,
            'is_featured'    => $this->faker->boolean(20),
            'is_active'      => true,
            'show_on_home'   => $this->faker->boolean(30),
            'is_best_seller' => $this->faker->boolean(10),
            'benefits'       => ['0% Lactose', 'Kaya Kalsium', 'Tanpa Pengawet', 'Mudah Dicerna'],
            'benefits_en'    => ['0% Lactose', 'Rich in Calcium', 'Preservative Free', 'Easy to Digest'],
            'meta_title'     => ucfirst($name),
            'meta_title_en'  => ucfirst($name) . ' (EN)',
            'meta_description' => $this->faker->sentence(15),
            'meta_description_en' => $this->faker->sentence(15) . ' (EN)',
        ];
    }
}
