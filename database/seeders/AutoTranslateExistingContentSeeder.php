<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Review;
use App\Models\StoreLocation;
use App\Models\Section;
use App\Models\Carousel;

class AutoTranslateExistingContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Products
        $products = [
            'miruku-original' => [
                'name_en' => 'Miruku Original',
                'description_en' => 'Premium lactose-free milk with a creamy natural taste. Enjoy the deliciousness of milk without digestive discomfort.',
                'body_en' => '<p>Miruku Original is the perfect choice for those who want to enjoy high-quality milk without the side effects of lactose. Made from selected cow\'s milk with a special lactase process that removes 99% of lactose content.</p><p><strong>Advantages:</strong></p><ul><li>0% Lactose – Safe for lactose intolerance sufferers</li><li>Rich in calcium & vitamin D</li><li>Premium creamy texture</li><li>No artificial preservatives</li></ul>',
                'meta_title_en' => 'Miruku Original – Premium Lactose-Free Milk',
                'meta_description_en' => 'Buy Miruku Original, a creamy and healthy premium lactose-free milk. Lactose-free, rich in calcium, without preservatives.',
            ],
            'miruku-chocolate' => [
                'name_en' => 'Miruku Chocolate',
                'description_en' => 'The perfect blend of premium chocolate and lactose-free milk. Enjoy the deliciousness of quality cocoa without lactose effects.',
                'body_en' => '<p>Miruku Chocolate brings a lux chocolate milk experience without the discomfort. Using premium cocoa beans from local Indonesian farmers.</p><p><strong>Why you\'ll love it:</strong></p><ul><li>Real cocoa – not synthetic flavor</li><li>0% Lactose like all Miruku variants</li><li>Naturally sweet with pure cane sugar</li></ul>',
                'meta_title_en' => 'Miruku Chocolate – Lactose-Free Chocolate Milk',
                'meta_description_en' => 'Miruku Chocolate, premium lactose-free chocolate milk with real cocoa. Delicious, healthy, lactose-free.',
            ],
            'miruku-banana' => [
                'name_en' => 'Miruku Banana',
                'description_en' => 'Fresh banana sensation in premium lactose-free milk. A refreshing tropical flavor for your daily activities.',
                'body_en' => '<p>Miruku Banana is inspired by the richness of Indonesian tropical fruits. Using selected Cavendish banana extract blended with our premium lactose-free milk.</p><p><strong>Perfect for:</strong></p><ul><li>Post-workout recovery</li><li>Refreshing breakfast</li><li>Healthy snacks for children</li></ul>',
                'meta_title_en' => 'Miruku Banana – Lactose-Free Banana Milk',
                'meta_description_en' => 'Miruku Banana, premium fresh lactose-free banana milk. Refreshing tropical taste, lactose-free.',
            ],
        ];

        foreach ($products as $slug => $data) {
            Product::where('slug', $slug)->update($data);
        }

        // 2. Sections
        $sections = [
            'about' => [
                'title_en' => 'Meet Miruku',
                'subtitle_en' => 'Healthy Milk Solution for Modern Lifestyle',
                'content_en' => 'Miruku is the answer to your need for high-quality premium milk that is friendly to the digestive system. We believe everyone deserves to enjoy the deliciousness of milk without worrying about the side effects of lactose. With the latest processing technology and the best selected ingredients, Miruku brings a perfect milk drinking experience.',
            ],
            'benefits' => [
                'title_en' => 'Why Miruku?',
                'subtitle_en' => 'Designed for your health and enjoyment',
                'content_en' => 'Miruku is more than just milk. It is our commitment to providing the best for your health and your family.',
            ],
            'cta' => [
                'title_en' => 'Switch to Better Milk Today',
                'subtitle_en' => 'Join thousands of customers who have already experienced the benefits of Miruku',
                'content_en' => 'Start your healthy journey with Miruku. Available at selected stores and trusted e-commerce platforms.',
            ],
        ];

        foreach ($sections as $name => $data) {
            Section::where('section_name', $name)->update($data);
        }

        // 3. Carousels (using title as key as per original seeder updateOrCreate)
        $carousels = [
            'Susu Premium Tanpa Batas' => [
                'title_en' => 'Unlimited Premium Milk',
                'subtitle_en' => 'Enjoy the deliciousness of high-quality lactose-free milk. Creamy, delicious, and friendly to your digestion.',
                'button_text_en' => 'Explore Products',
                'button2_text_en' => 'Why Lactose-Free?',
            ],
            'Hidup Sehat, Mulai dari Susu' => [
                'title_en' => 'Healthy Life, Starts with Milk',
                'subtitle_en' => '0% Lactose. 100% Nutrition. Miruku is here to support your active and healthy lifestyle every day.',
                'button_text_en' => 'Find Miruku',
                'button2_text_en' => 'Find Nearest Store',
            ],
            'Rasa yang Kamu Suka, Pencernaan yang Kamu Jaga' => [
                'title_en' => 'Taste You Love, Digestion You Protect',
                'subtitle_en' => 'Available in Original, Chocolate, and Banana variants. Which one is your favorite?',
                'button_text_en' => 'Choose Your Favorite Variant',
                'button2_text_en' => 'Read Reviews',
            ],
        ];

        foreach ($carousels as $id_title => $data) {
            Carousel::where('title', $id_title)->update($data);
        }

        // 4. Store Locations
        $stores = [
            'Miruku Store Jakarta Selatan' => [
                'name_en' => 'Miruku Store South Jakarta',
                'address_en' => 'Sudirman St. No. 123, Kebayoran Baru',
                'city_en' => 'Jakarta',
            ],
            'Miruku Store Bandung' => [
                'name_en' => 'Miruku Store Bandung',
                'address_en' => 'Braga St. No. 45, Sumur Bandung',
                'city_en' => 'Bandung',
            ],
            'Miruku Store Surabaya' => [
                'name_en' => 'Miruku Store Surabaya',
                'address_en' => 'Tunjungan St. No. 7, Genteng',
                'city_en' => 'Surabaya',
            ],
        ];

        foreach ($stores as $name => $data) {
            StoreLocation::where('name', $name)->update($data);
        }

        // 5. Reviews (Generic automated translation for existing samples)
        $reviewsMap = [
            'Endorasan banget! Perut saya yang biasanya kembung setelah minum susu, sekarang fine-fine aja. Rasa creamy-nya juara!' => 'Highly recommended! My stomach usually gets bloated after drinking milk, but now it\'s perfectly fine. The creamy taste is the champion!',
            'Sudah 3 bulan pakai Miruku. Kualitasnya konsisten, rasa enak, dan harga terjangkau untuk susu premium.' => 'Been using Miruku for 3 months. Consistent quality, great taste, and affordable price for premium milk.',
            'Anakku yang lactose intolerance akhirnya bisa minum susu tanpa masalah. Terima kasih Miruku!' => 'My lactose-intolerant child can finally drink milk without issues. Thank you Miruku!',
            'Rasanya bahkan lebih enak dari susu biasa. Creamy dan tidak meninggalkan rasa pahit. Recommended!' => 'It tastes even better than regular milk. Creamy and doesn\'t leave any bitter aftertaste. Recommended!',
            'Packaging cantik, rasa enak, dan lebih sehat. Perfect!' => 'Beautiful packaging, great taste, and healthier. Perfect!',
        ];

        foreach ($reviewsMap as $id_comment => $en_comment) {
            Review::where('comment', $id_comment)->update(['comment_en' => $en_comment]);
        }
    }
}
