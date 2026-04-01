<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Manfaat Susu Bebas Laktosa untuk Gaya Hidup Aktif',
                'title_en' => 'Benefits of Lactose-Free Milk for an Active Lifestyle',
                'slug' => 'manfaat-susu-bebas-laktosa-untuk-gaya-hidup-aktif',
                'content' => '
                    <p>Menjalani gaya hidup aktif menuntut asupan nutrisi yang tepat. Bagi banyak orang, susu adalah sumber protein dan kalsium yang ideal, namun masalah intoleransi laktosa seringkali menjadi penghalang.</p>
                    <h3>Kenapa Memilih Bebas Laktosa?</h3>
                    <p>Susu bebas laktosa seperti Miruku memberikan semua kebaikan susu sapi tanpa rasa tidak nyaman di perut. Ini sangat penting bagi mereka yang berolahraga secara rutin. Bayangkan harus berlari atau angkat beban dengan perut kembung—pasti tidak menyenangkan!</p>
                    <img src="https://images.unsplash.com/photo-1550583724-125581cc255b?q=80&w=1587&auto=format&fit=crop" style="width: 100%; border-radius: 20px; margin: 20px 0;">
                    <h3>Nutrisi Tanpa Kompromi</h3>
                    <p>Miruku diproses dengan teknologi laktase alami yang memecah laktosa menjadi glukosa dan galaktosa, membuatnya lebih mudah diserap tubuh namun tetap mempertahankan kandungan protein, vitamin D, dan kalsium yang tinggi.</p>
                    <p>Mulai hari Anda dengan segelas Miruku dingin untuk energi yang tahan lama!</p>
                ',
                'content_en' => '
                    <p>Living an active lifestyle demands the right nutritional intake. For many, milk is an ideal source of protein and calcium, but lactose intolerance issues often stand in the way.</p>
                    <h3>Why Choose Lactose-Free?</h3>
                    <p>Lactose-free milk like Miruku provides all the goodness of cow\'s milk without the stomach discomfort. This is crucial for those who exercise regularly. Imagine having to run or lift weights with a bloated stomach—certainly not fun!</p>
                    <img src="https://images.unsplash.com/photo-1550583724-125581cc255b?q=80&w=1587&auto=format&fit=crop" style="width: 100%; border-radius: 20px; margin: 20px 0;">
                    <h3>Nutrition Without Compromise</h3>
                    <p>Miruku is processed with natural lactase technology that breaks down lactose into glucose and galactose, making it easier for the body to absorb while maintaining high protein, vitamin D, and calcium content.</p>
                    <p>Start your day with a glass of cold Miruku for long-lasting energy!</p>
                ',
                'image' => 'https://images.unsplash.com/photo-1550583724-125581cc255b?q=80&w=1587&auto=format&fit=crop',
                'meta_title' => 'Manfaat Susu Bebas Laktosa - Miruku',
                'meta_title_en' => 'Benefits of Lactose-Free Milk - Miruku',
                'meta_description' => 'Temukan alasan mengapa susu bebas laktosa adalah kunci untuk performa maksimal dalam gaya hidup aktif Anda.',
                'meta_description_en' => 'Discover why lactose-free milk is the key to peak performance in your active lifestyle.',
                'view_count' => 1250,
            ],
            [
                'title' => 'Mengapa Miruku Aman untuk Semua Anggota Keluarga?',
                'title_en' => 'Why is Miruku Safe for All Family Members?',
                'slug' => 'mengapa-miruku-aman-untuk-semua-anggota-keluarga',
                'content' => '
                    <p>Kesehatan keluarga adalah prioritas utama. Seringkali, sikecil atau lansia di rumah mengalami kesulitan mencerna susu biasa. Di sinilah Miruku hadir sebagai solusi nutrisi keluarga Indonesia.</p>
                    <img src="https://images.unsplash.com/photo-1540479859555-17af45c78602?q=80&w=1470&auto=format&fit=crop" style="width: 100%; border-radius: 20px; margin: 20px 0;">
                    <h3>Aman untuk Anak-anak dan Lansia</h3>
                    <p>Sistem pencernaan anak-anak yang masih berkembang dan lansia yang mulai menurun produksinya akan enzim laktase membutuhkan perhatian khusus. Miruku menghilangkan risiko diare atau perut bergas setelah minum susu.</p>
                    <h3>Rasa yang Lebih Lezat dan Manis Alami</h3>
                    <p>Tahukah Anda? Susu bebas laktosa terasa sedikit lebih manis secara alami. Ini dikarenakan pemecahan laktosa menjadi gula yang lebih sederhana, sehingga anak-anak pasti menyukainya tanpa perlu tambahan gula berlebih.</p>
                    <p>Jadikan Miruku bagian dari sarapan keluarga setiap pagi untuk tulang yang lebih kuat dan hari yang lebih ceria.</p>
                ',
                'content_en' => '
                    <p>Family health is the top priority. Often, little ones or the elderly at home have difficulty digesting regular milk. This is where Miruku comes in as the nutritional solution for Indonesian families.</p>
                    <img src="https://images.unsplash.com/photo-1540479859555-17af45c78602?q=80&w=1470&auto=format&fit=crop" style="width: 100%; border-radius: 20px; margin: 20px 0;">
                    <h3>Safe for Children and Seniors</h3>
                    <p>Children\'s developing digestive systems and seniors with declining lactase enzyme production need special attention. Miruku eliminates the risk of diarrhea or bloating after drinking milk.</p>
                    <h3>Tastier and Naturally Sweeter</h3>
                    <p>Did you know? Lactose-free milk tastes slightly sweeter naturally. This is due to the breakdown of lactose into simpler sugars, making it a hit with kids without needing excess added sugar.</p>
                    <p>Make Miruku part of the family breakfast every morning for stronger bones and a brighter day.</p>
                ',
                'image' => 'https://images.unsplash.com/photo-1540479859555-17af45c78602?q=80&w=1470&auto=format&fit=crop',
                'meta_title' => 'Susu Aman untuk Keluarga - Miruku',
                'meta_title_en' => 'Safe Milk for Family - Miruku',
                'meta_description' => 'Miruku adalah pilihan aman untuk anak-anak hingga lansia. Nutrisi lengkap tanpa gangguan pencernaan.',
                'meta_description_en' => 'Miruku is a safe choice for children to seniors. Complete nutrition without digestive issues.',
                'view_count' => 980,
            ],
            [
                'title' => 'Tips Cooking: Membuat Smoothie Creamy dengan Miruku',
                'title_en' => 'Cooking Tips: Making Creamy Smoothies with Miruku',
                'slug' => 'tips-cooking-membuat-smoothie-creamy-dengan-miruku',
                'content' => '
                    <p>Siapa bilang hidup sehat itu membosankan? Dengan Miruku, Anda bisa berkreasi di dapur dan menciptakan minuman lezat yang ramah di perut!</p>
                    <img src="https://images.unsplash.com/photo-1528751011210-982d5473199c?q=80&w=1587&auto=format&fit=crop" style="width: 100%; border-radius: 20px; margin: 20px 0;">
                    <h3>Resep Berry Blast Smoothie</h3>
                    <p>Bahan-bahan yang Anda butuhkan:</p>
                    <ul>
                        <li>1 cangkir Miruku Original dingin</li>
                        <li>1/2 cangkir strawberry beku</li>
                        <li>1 buah pisang matang</li>
                        <li>1 sendok makan madu (opsional)</li>
                    </ul>
                    <h3>Cara Membuat:</h3>
                    <p>Masukkan semua bahan ke dalam blender. Proses hingga benar-benar halus dan creamy. Karena Miruku sudah memiliki rasa manis alami yang lembut, Anda mungkin tidak membutuhkan banyak tambahan pemanis.</p>
                    <p>Smoothie ini sangat cocok untuk post-workout atau sekadar teman bersantai di sore hari. Selamat mencoba!</p>
                ',
                'content_en' => '
                    <p>Who says healthy living has to be boring? With Miruku, you can get creative in the kitchen and create delicious drinks that are gentle on your stomach!</p>
                    <img src="https://images.unsplash.com/photo-1528751011210-982d5473199c?q=80&w=1587&auto=format&fit=crop" style="width: 100%; border-radius: 20px; margin: 20px 0;">
                    <h3>Berry Blast Smoothie Recipe</h3>
                    <p>Ingredients you\'ll need:</p>
                    <ul>
                        <li>1 cup of cold Miruku Original</li>
                        <li>1/2 cup frozen strawberries</li>
                        <li>1 ripe banana</li>
                        <li>1 tablespoon honey (optional)</li>
                    </ul>
                    <h3>How to Make:</h3>
                    <p>Put all ingredients in a blender. Process until completely smooth and creamy. Since Miruku already has a gentle natural sweetness, you might not need much added sweetener.</p>
                    <p>This smoothie is perfect for post-workout or just as an afternoon companion. Good luck!</p>
                ',
                'image' => 'https://images.unsplash.com/photo-1528751011210-982d5473199c?q=80&w=1587&auto=format&fit=crop',
                'meta_title' => 'Resep Smoothie Creamy - Miruku',
                'meta_title_en' => 'Creamy Smoothie Recipe - Miruku',
                'meta_description' => 'Belajar cara membuat smoothie sehat yang lezat dengan Miruku Lactose-Free Milk.',
                'meta_description_en' => 'Learn how to make delicious healthy smoothies with Miruku Lactose-Free Milk.',
                'view_count' => 2100,
            ],
        ];

        foreach ($posts as $index => $data) {
            Post::create(array_merge($data, [
                'is_active' => true,
                'published_at' => Carbon::now()->subDays($index * 2),
            ]));
        }
    }
}
