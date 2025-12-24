<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => '7 Makanan yang Bikin Kurus, Cocok untuk Menu Diet Harian',
                'slug' => '7-makanan-yang-bikin-kurus-cocok-untuk-menu-diet-harian',
                'excerpt' => 'Makanan yang bikin kurus menjadi incaran banyak orang yang ingin menurunkan berat badan tanpa rasa lapar atau tersiksa. Dengan memilih makanan yang tepat, proses diet bisa menjadi lebih menyenangkan dan efektif.',
                'quote' => 'Makanan sehat bukan tentang membatasi diri, tetapi tentang memberikan nutrisi terbaik untuk tubuh Anda.',
                'content' => '<p>Makanan yang bikin kurus menjadi incaran banyak orang yang ingin menurunkan berat badan tanpa rasa lapar atau tersiksa. Dengan memilih makanan yang tepat, proses diet bisa menjadi lebih menyenangkan dan efektif.</p>

<h2>1. Sayuran Hijau</h2>
<p>Sayuran hijau seperti bayam, kangkung, selada, dan sawi hijau adalah pilihan sempurna untuk diet. Mereka mengandung serat tinggi namun sangat rendah kalori.</p>

<h2>2. Telur</h2>
<p>Telur adalah superfood yang sempurna untuk diet. Satu butir telur mengandung sekitar 6 gram protein berkualitas tinggi dan hanya 70 kalori.</p>

<h2>3. Ikan Salmon</h2>
<p>Salmon adalah ikan berlemak yang sangat baik untuk diet karena kaya akan protein dan omega-3.</p>

<h2>4. Dada Ayam</h2>
<p>Dada ayam tanpa kulit adalah sumber protein tanpa lemak yang ideal untuk diet.</p>

<h2>5. Alpukat</h2>
<p>Meskipun tinggi lemak dan kalori, alpukat sebenarnya membantu penurunan berat badan.</p>

<h2>6. Kacang-kacangan</h2>
<p>Kacang almond, kenari, kacang tanah, dan kacang mede mengandung kombinasi protein, serat, dan lemak sehat.</p>

<h2>7. Oatmeal</h2>
<p>Oatmeal adalah sumber karbohidrat kompleks yang sempurna untuk sarapan.</p>',
                'category' => 'Hidup Sehat',
                'category_color' => 'green',
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&h=500&fit=crop',
                'read_time' => '5 min read',
                'author' => 'Dr. Sarah Nutritionist',
            ],
            [
                'title' => 'Tips Olahraga yang Efektif untuk Kesehatan Jantung',
                'slug' => 'tips-olahraga-efektif-untuk-kesehatan-jantung',
                'excerpt' => 'Olahraga teratur sangat penting untuk menjaga kesehatan jantung. Pelajari jenis olahraga yang paling efektif untuk meningkatkan fungsi kardiovaskular.',
                'quote' => 'Jantung yang sehat dimulai dari langkah pertama Anda untuk berolahraga.',
                'content' => '<p>Olahraga teratur sangat penting untuk menjaga kesehatan jantung. Aktivitas fisik membantu memperkuat otot jantung, meningkatkan sirkulasi darah, dan menurunkan risiko penyakit kardiovaskular.</p>

<h2>Jenis Olahraga untuk Kesehatan Jantung</h2>
<p><strong>1. Jalan Cepat</strong> - Mudah dilakukan dan cocok untuk pemula. Lakukan 30 menit sehari.</p>
<p><strong>2. Berenang</strong> - Olahraga low-impact yang baik untuk jantung tanpa membebani sendi.</p>
<p><strong>3. Bersepeda</strong> - Meningkatkan detak jantung dan memperkuat otot kaki.</p>
<p><strong>4. Aerobik</strong> - Meningkatkan kapasitas kardiovaskular secara efektif.</p>

<h2>Tips Berolahraga dengan Aman</h2>
<ul>
<li>Mulai dengan pemanasan 5-10 menit</li>
<li>Tingkatkan intensitas secara bertahap</li>
<li>Jangan lupa pendinginan setelah olahraga</li>
<li>Minum air yang cukup</li>
<li>Konsultasi dokter jika memiliki kondisi kesehatan tertentu</li>
</ul>',
                'category' => 'Olahraga',
                'category_color' => 'blue',
                'image' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=800&h=500&fit=crop',
                'read_time' => '7 min read',
                'author' => 'Dr. Ahmad Cardio',
            ],
            [
                'title' => 'Mengelola Diabetes dengan Pola Makan Sehat',
                'slug' => 'mengelola-diabetes-dengan-pola-makan-sehat',
                'excerpt' => 'Pola makan yang tepat sangat penting bagi penderita diabetes. Temukan panduan lengkap tentang makanan yang aman dan nutrisi yang dibutuhkan.',
                'quote' => 'Diabetes bukan akhir dari segalanya, tapi awal dari hidup yang lebih sehat.',
                'content' => '<p>Pola makan yang tepat sangat penting bagi penderita diabetes. Dengan mengontrol asupan makanan, kadar gula darah dapat terjaga dengan baik.</p>

<h2>Makanan yang Dianjurkan</h2>
<ul>
<li>Sayuran hijau (bayam, brokoli, kangkung)</li>
<li>Buah-buahan dengan indeks glikemik rendah (apel, pir, berry)</li>
<li>Protein tanpa lemak (ikan, ayam tanpa kulit, tahu)</li>
<li>Karbohidrat kompleks (nasi merah, oatmeal, quinoa)</li>
<li>Lemak sehat (alpukat, minyak zaitun, kacang-kacangan)</li>
</ul>

<h2>Makanan yang Harus Dibatasi</h2>
<ul>
<li>Gula dan makanan manis</li>
<li>Nasi putih dan roti putih</li>
<li>Minuman bersoda dan jus kemasan</li>
<li>Makanan olahan dan fast food</li>
<li>Gorengan dan makanan tinggi lemak trans</li>
</ul>

<h2>Tips Pola Makan Sehat</h2>
<p>Makan dalam porsi kecil tapi sering, hindari melewatkan waktu makan, dan selalu cek kadar gula darah secara teratur.</p>',
                'category' => 'Diabetes',
                'category_color' => 'orange',
                'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=800&h=500&fit=crop',
                'read_time' => '6 min read',
                'author' => 'Dr. Endocrine Specialist',
            ],
            [
                'title' => 'Pentingnya Vitamin dan Mineral untuk Tubuh',
                'slug' => 'pentingnya-vitamin-dan-mineral-untuk-tubuh',
                'excerpt' => 'Vitamin dan mineral adalah nutrisi esensial yang dibutuhkan tubuh. Pelajari manfaat masing-masing vitamin dan sumber makanan terbaik.',
                'quote' => 'Tubuh yang sehat membutuhkan keseimbangan vitamin dan mineral yang tepat.',
                'content' => '<p>Vitamin dan mineral adalah nutrisi esensial yang dibutuhkan tubuh untuk berfungsi dengan optimal. Kekurangan nutrisi ini dapat menyebabkan berbagai masalah kesehatan.</p>

<h2>Vitamin Penting</h2>
<p><strong>Vitamin A</strong> - Kesehatan mata dan kulit. Sumber: wortel, ubi, bayam.</p>
<p><strong>Vitamin B Complex</strong> - Energi dan metabolisme. Sumber: daging, telur, kacang-kacangan.</p>
<p><strong>Vitamin C</strong> - Imunitas dan antioksidan. Sumber: jeruk, paprika, strawberry.</p>
<p><strong>Vitamin D</strong> - Tulang dan imunitas. Sumber: sinar matahari, ikan, susu.</p>
<p><strong>Vitamin E</strong> - Antioksidan dan kulit. Sumber: kacang almond, minyak zaitun.</p>

<h2>Mineral Penting</h2>
<p><strong>Kalsium</strong> - Tulang dan gigi. Sumber: susu, keju, brokoli.</p>
<p><strong>Zat Besi</strong> - Darah dan energi. Sumber: daging merah, bayam, kacang.</p>
<p><strong>Zinc</strong> - Imunitas dan penyembuhan. Sumber: daging, kerang, biji labu.</p>
<p><strong>Magnesium</strong> - Otot dan saraf. Sumber: pisang, kacang, dark chocolate.</p>',
                'category' => 'Nutrisi',
                'category_color' => 'yellow',
                'image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800&h=500&fit=crop',
                'read_time' => '8 min read',
                'author' => 'Dr. Nutrition Expert',
            ],
            [
                'title' => 'Cara Mengatasi Stres dan Menjaga Kesehatan Mental',
                'slug' => 'cara-mengatasi-stres-dan-menjaga-kesehatan-mental',
                'excerpt' => 'Kesehatan mental sama pentingnya dengan kesehatan fisik. Temukan strategi efektif untuk mengelola stres dan meningkatkan kesejahteraan.',
                'quote' => 'Kesehatan mental adalah fondasi dari kehidupan yang bahagia dan produktif.',
                'content' => '<p>Kesehatan mental sama pentingnya dengan kesehatan fisik. Di tengah kehidupan yang penuh tekanan, penting untuk mengetahui cara mengelola stres dengan efektif.</p>

<h2>Tanda-tanda Stres</h2>
<ul>
<li>Sulit tidur atau tidur berlebihan</li>
<li>Mudah marah atau tersinggung</li>
<li>Sulit berkonsentrasi</li>
<li>Perubahan nafsu makan</li>
<li>Merasa lelah terus-menerus</li>
</ul>

<h2>Cara Mengatasi Stres</h2>
<p><strong>1. Olahraga Teratur</strong> - Aktivitas fisik melepaskan endorfin yang membuat perasaan lebih baik.</p>
<p><strong>2. Meditasi dan Mindfulness</strong> - Melatih pikiran untuk fokus pada saat ini.</p>
<p><strong>3. Tidur yang Cukup</strong> - 7-9 jam tidur berkualitas setiap malam.</p>
<p><strong>4. Berbicara dengan Orang Terdekat</strong> - Berbagi beban dengan keluarga atau teman.</p>
<p><strong>5. Hobi dan Aktivitas Menyenangkan</strong> - Luangkan waktu untuk hal yang disukai.</p>
<p><strong>6. Konsultasi Profesional</strong> - Jangan ragu mencari bantuan psikolog jika diperlukan.</p>',
                'category' => 'Kesehatan Mental',
                'category_color' => 'purple',
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=500&fit=crop',
                'read_time' => '10 min read',
                'author' => 'Dr. Psychology',
            ],
            [
                'title' => 'Tips Tidur Berkualitas untuk Kulit Sehat dan Bercahaya',
                'slug' => 'tips-tidur-berkualitas-untuk-kulit-sehat-dan-bercahaya',
                'excerpt' => 'Tidur yang cukup dan berkualitas sangat penting untuk kesehatan kulit. Pelajari bagaimana tidur mempengaruhi kecantikan dan tips untuk tidur lebih baik.',
                'quote' => 'Beauty sleep bukan hanya mitos, tapi kenyataan ilmiah.',
                'content' => '<p>Tidur yang cukup dan berkualitas sangat penting untuk kesehatan kulit. Saat tidur, tubuh melakukan regenerasi sel dan memperbaiki kerusakan kulit.</p>

<h2>Manfaat Tidur untuk Kulit</h2>
<ul>
<li>Regenerasi sel kulit baru</li>
<li>Produksi kolagen meningkat</li>
<li>Perbaikan kerusakan akibat UV</li>
<li>Mengurangi kantung mata dan lingkaran hitam</li>
<li>Kulit lebih cerah dan bercahaya</li>
</ul>

<h2>Tips Tidur Berkualitas</h2>
<p><strong>1. Jadwal Tidur Teratur</strong> - Tidur dan bangun di waktu yang sama setiap hari.</p>
<p><strong>2. Hindari Layar Gadget</strong> - Matikan gadget 1 jam sebelum tidur.</p>
<p><strong>3. Ruangan yang Nyaman</strong> - Pastikan kamar gelap, sejuk, dan tenang.</p>
<p><strong>4. Rutinitas Malam</strong> - Bersihkan wajah dan gunakan skincare malam.</p>
<p><strong>5. Hindari Kafein</strong> - Jangan konsumsi kafein setelah jam 2 siang.</p>
<p><strong>6. Gunakan Sarung Bantal Sutra</strong> - Mengurangi gesekan dan mencegah keriput.</p>

<h2>Durasi Tidur Ideal</h2>
<p>Orang dewasa membutuhkan 7-9 jam tidur setiap malam untuk kesehatan optimal.</p>',
                'category' => 'Kecantikan',
                'category_color' => 'pink',
                'image' => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=800&h=500&fit=crop',
                'read_time' => '6 min read',
                'author' => 'Dr. Dermatology',
            ],
        ];
        
        foreach ($articles as $article) {
            Article::updateOrCreate(['slug' => $article['slug']], $article);
        }
    }
}
