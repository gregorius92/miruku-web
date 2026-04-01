<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Review;
use App\Models\StoreLocation;
use App\Models\Section;
use App\Models\Carousel;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(['email' => 'admin@miruku.com'], [
            'name' => 'Miruku Admin',
            'email' => 'admin@miruku.com',
            'password' => Hash::make('MirukuAdmin2024!'),
        ]);

        // Products
        $products = [
            [
                'name' => 'Miruku Original',
                'slug' => 'miruku-original',
                'description' => 'Susu lactose-free premium dengan rasa alami yang creamy. Nikmati kelezatan susu tanpa disertai gangguan pencernaan.',
                'body' => '<p>Miruku Original adalah pilihan sempurna untuk Anda yang ingin menikmati susu berkualitas tinggi tanpa efek samping lactose. Dibuat dari susu sapi pilihan dengan proses lactase khusus yang menghilangkan 99% kandungan lactose.</p><p><strong>Keunggulan:</strong></p><ul><li>0% Lactose – Aman untuk penderita lactose intolerance</li><li>Kaya kalsium & vitamin D</li><li>Tekstur creamy premium</li><li>Tanpa pengawet buatan</li></ul>',
                'price' => 35000,
                'variant' => 'original',
                'stock' => 500,
                'is_featured' => true,
                'is_active' => true,
                'meta_title' => 'Miruku Original – Susu Lactose-Free Premium',
                'meta_description' => 'Beli Miruku Original, susu lactose-free premium yang creamy dan menyehatkan. Bebas laktosa, kaya kalsium, tanpa pengawet.',
            ],
            [
                'name' => 'Miruku Chocolate',
                'slug' => 'miruku-chocolate',
                'description' => 'Perpaduan sempurna cokelat premium dan susu lactose-free. Nikmati kelezatan kakao berkualitas tanpa efek lactose.',
                'body' => '<p>Miruku Chocolate menghadirkan pengalaman minum susu cokelat yang lux tanpa rasa tidak nyaman. Menggunakan biji kakao premium dari petani lokal Indonesia.</p><p><strong>Why you\'ll love it:</strong></p><ul><li>Real cocoa – bukan perisa sintetis</li><li>0% Lactose seperti semua varian Miruku</li><li>Manis alami dengan gula tebu murni</li></ul>',
                'price' => 38000,
                'variant' => 'chocolate',
                'stock' => 350,
                'is_featured' => true,
                'is_active' => true,
                'meta_title' => 'Miruku Chocolate – Susu Cokelat Lactose-Free',
                'meta_description' => 'Miruku Chocolate, susu cokelat premium lactose-free dengan kakao asli. Lezat, menyehatkan, bebas laktosa.',
            ],
            [
                'name' => 'Miruku Banana',
                'slug' => 'miruku-banana',
                'description' => 'Sensasi pisang segar dalam susu lactose-free premium. Cita rasa tropis yang menyegarkan untuk aktivitas harianmu.',
                'body' => '<p>Miruku Banana terinspirasi dari kekayaan buah tropis Indonesia. Menggunakan ekstrak pisang Cavendish pilihan yang dipadukan dengan susu lactose-free premium kami.</p><p><strong>Perfect for:</strong></p><ul><li>Post-workout recovery</li><li>Sarapan pagi yang menyegarkan</li><li>Camilan sehat anak-anak</li></ul>',
                'price' => 38000,
                'variant' => 'banana',
                'stock' => 300,
                'is_featured' => true,
                'is_active' => true,
                'meta_title' => 'Miruku Banana – Susu Pisang Lactose-Free',
                'meta_description' => 'Miruku Banana, susu pisang segar lactose-free premium. Rasa tropis yang menyegarkan, bebas laktosa.',
            ],
        ];

        foreach ($products as $productData) {
            $product = Product::firstOrCreate(['slug' => $productData['slug']], $productData);

            // Add reviews for each product
            $reviewsData = [
                ['name' => 'Siti Rahayu', 'rating' => 5, 'comment' => 'Endorasan banget! Perut saya yang biasanya kembung setelah minum susu, sekarang fine-fine aja. Rasa creamy-nya juara!', 'approved' => true],
                ['name' => 'Budi Santoso', 'rating' => 5, 'comment' => 'Sudah 3 bulan pakai Miruku. Kualitasnya konsisten, rasa enak, dan harga terjangkau untuk susu premium.', 'approved' => true],
                ['name' => 'Dewi Kusuma', 'rating' => 4, 'comment' => 'Anakku yang lactose intolerance akhirnya bisa minum susu tanpa masalah. Terima kasih Miruku!', 'approved' => true],
                ['name' => 'Ahmad Fauzi', 'rating' => 5, 'comment' => 'Rasanya bahkan lebih enak dari susu biasa. Creamy dan tidak meninggalkan rasa pahit. Recommended!', 'approved' => true],
                ['name' => 'Nur Hidayah', 'rating' => 4, 'comment' => 'Packaging cantik, rasa enak, dan lebih sehat. Perfect!', 'approved' => true],
            ];

            foreach ($reviewsData as $reviewData) {
                Review::firstOrCreate(
                    ['name' => $reviewData['name'], 'product_id' => $product->id],
                    array_merge($reviewData, ['product_id' => $product->id])
                );
            }
        }

        // Store Locations
        $stores = [
            [
                'name' => 'Miruku Store Jakarta Selatan',
                'address' => 'Jl. Sudirman No. 123, Kebayoran Baru',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126933.05742700316!2d106.68964478742934!3d-6.229728756000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1699999999999!5m2!1sid!2sid',
                'phone' => '021-5555-1234',
                'open_time' => '08:00:00',
                'close_time' => '21:00:00',
                'is_active' => true,
            ],
            [
                'name' => 'Miruku Store Bandung',
                'address' => 'Jl. Braga No. 45, Sumur Bandung',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126574.62618756218!2d107.53661378753507!3d-6.903396156000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9aed03f2023%3A0x750bc43cc65bbfed!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1699999999999!5m2!1sid!2sid',
                'phone' => '022-4444-5678',
                'open_time' => '09:00:00',
                'close_time' => '20:00:00',
                'is_active' => true,
            ],
            [
                'name' => 'Miruku Store Surabaya',
                'address' => 'Jl. Tunjungan No. 7, Genteng',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126502.14688956125!2d112.60455978751563!3d-7.265675656000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac47f%3A0x3d2ad6e1e0e9bcc8!2sSurabaya%2C%20Kota%20SBY%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1699999999999!5m2!1sid!2sid',
                'phone' => '031-3333-9012',
                'open_time' => '08:30:00',
                'close_time' => '21:30:00',
                'is_active' => true,
            ],
        ];

        foreach ($stores as $store) {
            StoreLocation::firstOrCreate(['name' => $store['name']], $store);
        }

        // Sections (CMS content)
        $sections = [
            [
                'section_name' => 'about',
                'title' => 'Kenali Miruku',
                'subtitle' => 'Solusi Susu Sehat untuk Gaya Hidup Modern',
                'content' => 'Miruku hadir sebagai jawaban atas kebutuhan Anda akan susu berkualitas premium yang ramah bagi sistem pencernaan. Kami percaya bahwa setiap orang berhak menikmati kelezatan susu tanpa khawatir akan efek samping lactose. Dengan teknologi pemrosesan terkini dan bahan-bahan pilihan terbaik, Miruku menghadirkan pengalaman minum susu yang sempurna.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section_name' => 'benefits',
                'title' => 'Mengapa Miruku?',
                'subtitle' => 'Dirancang untuk kesehatan dan kenikmatan Anda',
                'content' => 'Miruku bukan sekadar susu. Ini adalah komitmen kami untuk memberikan yang terbaik bagi kesehatan Anda dan keluarga.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section_name' => 'cta',
                'title' => 'Beralih ke Susu yang Lebih Baik Hari Ini',
                'subtitle' => 'Bergabung dengan ribuan pelanggan yang sudah merasakan manfaat Miruku',
                'content' => 'https://www.youtube.com/watch?v=CH3rulpG7ac',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            Section::firstOrCreate(['section_name' => $section['section_name']], $section);
        }

        $this->call(FeatureSeeder::class);
        $this->call(PostSeeder::class);

        // Carousels
        $carousels = [
            [
                'title' => 'Susu Premium Tanpa Batas',
                'subtitle' => 'Nikmati kelezatan susu lactose-free berkualitas tinggi. Creamy, lezat, and ramah untuk pencernaanmu.',
                'image' => 'images/carousel/slide-1.png',
                'button_text' => 'Jelajahi Produk',
                'button_link' => '/products',
                'button2_text' => 'Mengapa Lactose-Free?',
                'button2_link' => '/benefits-lactose-free',
                'text_color' => 'white',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Hidup Sehat, Mulai dari Susu',
                'subtitle' => '0% Lactose. 100% Nutrisi. Miruku hadir untuk mendukung gaya hidup aktif dan sehatmu setiap hari.',
                'image' => 'images/carousel/slide-2.png',
                'button_text' => 'Temukan Miruku',
                'button_link' => '/products',
                'button2_text' => 'Cari Toko Terdekat',
                'button2_link' => '/#stores',
                'text_color' => 'white',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Rasa yang Kamu Suka, Pencernaan yang Kamu Jaga',
                'subtitle' => 'Tersedia dalam varian Original, Chocolate, dan Banana. Mana favoritmu?',
                'image' => 'images/carousel/slide-3.png',
                'button_text' => 'Pilih Varian Favoritmu',
                'button_link' => '/products',
                'button2_text' => 'Baca Review',
                'button2_link' => '/#reviews',
                'text_color' => 'white',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($carousels as $carousel) {
            Carousel::updateOrCreate(['title' => $carousel['title']], $carousel);
        }

        // Settings
        $settings = [
            // SEO
            ['key' => 'meta_title', 'value' => 'Miruku – Susu Lactose-Free Premium Indonesia', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Miruku adalah susu lactose-free premium terbaik di Indonesia. 0% lactose, kaya kalsium, tekstur creamy, tersedia varian Original, Chocolate, dan Banana.', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'susu lactose free, susu sehat, miruku, susu tanpa laktosa, susu terbaik, lactose intolerance', 'group' => 'seo'],
            ['key' => 'og_image', 'value' => '', 'group' => 'seo'],
            // General
            ['key' => 'site_name', 'value' => 'Miruku', 'group' => 'general'],
            ['key' => 'tagline', 'value' => 'Susu Premium Tanpa Laktosa', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'hello@miruku.id', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '+62 812-3456-7890', 'group' => 'general'],
            ['key' => 'contact_address', 'value' => 'Jakarta, Indonesia', 'group' => 'general'],
            // Social Media
            ['key' => 'instagram', 'value' => 'https://instagram.com/miruku.id', 'group' => 'social'],
            ['key' => 'tiktok', 'value' => 'https://tiktok.com/@miruku.id', 'group' => 'social'],
            ['key' => 'youtube', 'value' => 'https://youtube.com/miruku', 'group' => 'social'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/miruku_id', 'group' => 'social'],
            // Shopee/Tokopedia links
            ['key' => 'shopee_link', 'value' => 'https://shopee.co.id/miruku', 'group' => 'ecommerce'],
            ['key' => 'tokopedia_link', 'value' => 'https://tokopedia.com/miruku', 'group' => 'ecommerce'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
