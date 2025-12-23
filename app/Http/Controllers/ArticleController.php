<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = $this->getArticles();
        return view('articles.index', ['articles' => $articles]);
    }

    public function show($slug)
    {
        $articles = $this->getArticles();
        
        // Convert array to object-like behavior if it's from the array fallback
        $article = collect($articles)->firstWhere('slug', $slug);
        
        if (!$article) {
            abort(404);
        }
        
        // Convert array to collection for consistent access
        $articleData = is_array($article) ? (object)$article : $article;
        
        $relatedArticles = collect($articles)
            ->where('category', $articleData->category)
            ->where('slug', '!=', $slug)
            ->take(3);
        
        $comments = \App\Models\Comment::where('article_slug', $slug)
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->latest()
            ->get();
        
        $likesCount = \App\Models\ArticleLike::where('article_slug', $slug)->count();
        $userHasLiked = auth()->check() 
            ? \App\Models\ArticleLike::where('article_slug', $slug)
                ->where('user_id', auth()->id())
                ->exists()
            : false;
        
        // Get related doctors based on article category
        $relatedDoctors = $this->getRelatedDoctors($articleData->category);

        
        // Determine which calculators to show based on article
        $calculators = $this->getCalculatorsForArticle($article['slug']);
        
        return view('articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'comments' => $comments,
            'likesCount' => $likesCount,
            'userHasLiked' => $userHasLiked,
            'relatedDoctors' => $relatedDoctors,
            'calculators' => $calculators,
        ]);
    }
    
    private function getCalculatorsForArticle($slug)
    {
        // Mapping artikel ke kalkulator yang relevan
        $articleCalculators = [
            '7-makanan-yang-bikin-kurus-cocok-untuk-menu-diet-harian' => ['bmi', 'calorie'],
            'tips-olahraga-efektif-untuk-kesehatan-jantung' => ['bmi', 'water'],
            'mengelola-diabetes-dengan-pola-makan-sehat' => ['bmi', 'calorie'],
            'panduan-lengkap-diet-mediterania-untuk-jantung-sehat' => ['bmi', 'calorie'],
            'manfaat-puasa-intermittent-untuk-kesehatan-dan-berat-badan' => ['bmi', 'calorie'],
            'olahraga-hiit-untuk-membakar-lemak-maksimal' => ['bmi', 'calorie', 'water'],
            'makanan-penurun-kolesterol-tinggi-secara-alami' => ['bmi', 'calorie'],
            'makanan-super-untuk-meningkatkan-imun-tubuh' => ['bmi', 'water'],
            'tips-tidur-berkualitas-untuk-kulit-sehat-dan-bercahaya' => ['water'],
            'cara-mencegah-diabetes-tipe-2-dengan-gaya-hidup-sehat' => ['bmi', 'calorie'],
            'komplikasi-diabetes-yang-harus-diwaspadai-dan-cara-mencegahnya' => ['bmi'],
            'olahraga-aman-untuk-penderita-diabetes-panduan-lengkap' => ['bmi', 'calorie', 'water'],
        ];
        
        return $articleCalculators[$slug] ?? [];
    }
    
    private function getRelatedDoctors($category)
    {
        // Mapping kategori artikel ke spesialisasi dokter
        $categoryToSpecialization = [
            'Hidup Sehat' => ['Dokter Umum', 'Kardiologi'],
            'Olahraga' => ['Orthopedi', 'Kardiologi', 'Dokter Umum'],
            'Diabetes' => ['Dokter Umum', 'Kardiologi'],
            'Nutrisi' => ['Dokter Umum', 'Kardiologi'],
            'Kesehatan Mental' => ['Psikiater', 'Dokter Umum'],
            'Kecantikan' => ['Dermatologi', 'Dokter Umum'],
            'Hipertensi' => ['Kardiologi', 'Dokter Umum'],
            'Kolesterol' => ['Kardiologi', 'Dokter Umum'],
            'Jantung' => ['Kardiologi', 'Dokter Umum'],
            'Kesehatan Wanita' => ['Obstetri & Ginekologi', 'Dokter Umum'],
            'Pediatri' => ['Pediatri', 'Dokter Umum'],
            'Gigi' => ['Dokter Gigi', 'Dokter Umum'],
        ];
        
        $specializations = $categoryToSpecialization[$category] ?? ['Dokter Umum'];
        
        return \App\Models\Doctor::with('user')
            ->where('is_active', true)
            ->whereIn('specialization', $specializations)
            ->orderBy('years_of_experience', 'desc')
            ->take(3)
            ->get();
    }

    public function getArticles()
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('articles')) {
                $dbArticles = \App\Models\Article::latest()->get();
                if ($dbArticles->count() > 0) {
                    return $dbArticles;
                }
            }
        } catch (\Exception $e) {
            // Log error or ignore and fallback
        }

        return [
            // Article 1
            [
                'id' => 1,
                'slug' => '7-makanan-yang-bikin-kurus-cocok-untuk-menu-diet-harian',
                'title' => '7 Makanan yang Bikin Kurus, Cocok untuk Menu Diet Harian',
                'excerpt' => 'Makanan yang bikin kurus menjadi incaran banyak orang yang ingin menurunkan berat badan tanpa rasa lapar atau tersiksa. Dengan memilih makanan yang tepat, proses diet bisa menjadi lebih menyenangkan dan efektif.',
                'quote' => 'Makanan sehat bukan tentang membatasi diri, tetapi tentang memberikan nutrisi terbaik untuk tubuh Anda.',
                'content' => '<div class="article-quote mb-6 p-4 bg-green-50 border-l-4 border-green-500 italic text-gray-700">"Makanan sehat bukan tentang membatasi diri, tetapi tentang memberikan nutrisi terbaik untuk tubuh Anda."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#intro" class="text-blue-600 hover:underline">Pengantar</a></li>
    <li><a href="#sayuran-hijau" class="text-blue-600 hover:underline">Sayuran Hijau</a></li>
    <li><a href="#telur" class="text-blue-600 hover:underline">Telur</a></li>
    <li><a href="#ikan-salmon" class="text-blue-600 hover:underline">Ikan Salmon</a></li>
    <li><a href="#dada-ayam" class="text-blue-600 hover:underline">Dada Ayam</a></li>
    <li><a href="#alpukat" class="text-blue-600 hover:underline">Alpukat</a></li>
    <li><a href="#kacang-kacangan" class="text-blue-600 hover:underline">Kacang-kacangan</a></li>
    <li><a href="#oatmeal" class="text-blue-600 hover:underline">Oatmeal</a></li>
    <li><a href="#tips" class="text-blue-600 hover:underline">Tips Mengonsumsi</a></li>
</ul>

<p id="intro">Makanan yang bikin kurus menjadi incaran banyak orang yang ingin menurunkan berat badan tanpa rasa lapar atau tersiksa. Dengan memilih makanan yang tepat, proses diet bisa menjadi lebih menyenangkan dan efektif.</p>

<p>Banyak orang berpikir bahwa diet harus menyiksa dan membuat lapar sepanjang hari. Namun, faktanya, ada banyak makanan lezat yang dapat membantu Anda menurunkan berat badan sambil tetap merasa kenyang dan puas.</p>

<h2 id="sayuran-hijau">1. Sayuran Hijau</h2>
<p>Sayuran hijau seperti bayam, kangkung, selada, dan sawi hijau adalah pilihan sempurna untuk diet. Mereka mengandung serat tinggi namun sangat rendah kalori, sehingga Anda bisa makan dalam porsi besar tanpa khawatir berat badan naik.</p>

<p><strong>Manfaat Sayuran Hijau:</strong></p>
<ul>
    <li>Kaya akan vitamin A, C, K, dan folat</li>
    <li>Mengandung antioksidan yang melawan radikal bebas</li>
    <li>Membantu detoksifikasi tubuh secara alami</li>
    <li>Meningkatkan metabolisme dan pembakaran lemak</li>
    <li>Mengenyangkan dengan kalori minimal (hanya 20-30 kalori per 100 gram)</li>
</ul>

<p>Cobalah membuat salad hijau dengan berbagai jenis sayuran, atau tumis sayuran hijau dengan sedikit minyak zaitun untuk makan siang atau malam yang sehat.</p>

<h2 id="telur">2. Telur</h2>
<p>Telur adalah superfood yang sempurna untuk diet. Satu butir telur mengandung sekitar 6 gram protein berkualitas tinggi dan hanya 70 kalori. Penelitian menunjukkan bahwa sarapan dengan telur dapat mengurangi asupan kalori sepanjang hari hingga 400 kalori.</p>

<p><strong>Kandungan Nutrisi Telur (per butir):</strong></p>
<ul>
    <li>Protein: 6 gram</li>
    <li>Lemak sehat: 5 gram</li>
    <li>Vitamin B12, D, dan A</li>
    <li>Kolin untuk kesehatan otak</li>
    <li>Selenium dan fosfor</li>
</ul>

<p>Konsumsi telur rebus atau orak-arik dengan sedikit minyak untuk hasil terbaik. Hindari menggoreng dengan banyak minyak atau mentega.</p>

<h2 id="ikan-salmon">3. Ikan Salmon</h2>
<p>Salmon adalah ikan berlemak yang sangat baik untuk diet karena kaya akan protein dan omega-3. Lemak omega-3 dalam salmon membantu mengurangi peradangan, meningkatkan metabolisme, dan membantu pembakaran lemak perut.</p>

<p><strong>Manfaat Salmon untuk Diet:</strong></p>
<ul>
    <li>Protein tinggi (20 gram per 100 gram)</li>
    <li>Omega-3 EPA dan DHA untuk kesehatan jantung</li>
    <li>Vitamin D yang membantu penyerapan kalsium</li>
    <li>Membuat kenyang lebih lama</li>
    <li>Meningkatkan hormon leptin yang mengontrol nafsu makan</li>
</ul>

<p>Panggang atau kukus salmon dengan bumbu sederhana seperti lemon, bawang putih, dan herbs untuk makan yang lezat dan sehat.</p>

<h2 id="dada-ayam">4. Dada Ayam</h2>
<p>Dada ayam tanpa kulit adalah sumber protein tanpa lemak yang ideal untuk diet. Dengan 31 gram protein dan hanya 165 kalori per 100 gram, dada ayam membantu membangun dan mempertahankan massa otot sambil membakar lemak.</p>

<p><strong>Keunggulan Dada Ayam:</strong></p>
<ul>
    <li>Protein sangat tinggi, lemak sangat rendah</li>
    <li>Mengandung vitamin B6 untuk metabolisme</li>
    <li>Sumber niasin dan selenium</li>
    <li>Membantu mempertahankan massa otot saat diet</li>
    <li>Serbaguna dan mudah dimasak</li>
</ul>

<h2 id="alpukat">5. Alpukat</h2>
<p>Meskipun tinggi lemak dan kalori, alpukat sebenarnya membantu penurunan berat badan. Lemak tak jenuh tunggal dalam alpukat meningkatkan rasa kenyang dan membantu tubuh menyerap vitamin larut lemak lebih baik.</p>

<p><strong>Nutrisi Alpukat (per 100 gram):</strong></p>
<ul>
    <li>Kalori: 160</li>
    <li>Lemak sehat: 15 gram</li>
    <li>Serat: 7 gram</li>
    <li>Kalium: lebih banyak dari pisang</li>
    <li>Vitamin E, K, dan C</li>
</ul>

<p>Tambahkan alpukat ke salad, smoothie, atau makan langsung dengan sedikit garam dan lemon.</p>

<h2 id="kacang-kacangan">6. Kacang-kacangan</h2>
<p>Kacang almond, kenari, kacang tanah, dan kacang mede mengandung kombinasi protein, serat, dan lemak sehat yang sempurna untuk diet. Meskipun tinggi kalori, penelitian menunjukkan bahwa orang yang makan kacang secara teratur cenderung lebih langsing.</p>

<p><strong>Porsi Yang Direkomendasikan:</strong></p>
<ul>
    <li>Almond: 23 butir (28 gram) = 160 kalori</li>
    <li>Kenari: 7 butir utuh = 185 kalori</li>
    <li>Kacang tanah: 28 butir = 160 kalori</li>
    <li>Konsumsi sebagai snack di antara waktu makan</li>
</ul>

<h2 id="oatmeal">7. Oatmeal</h2>
<p>Oatmeal adalah sumber karbohidrat kompleks yang sempurna untuk sarapan. Beta-glucan dalam oat meningkatkan rasa kenyang dan membantu mengontrol kadar gula darah, sehingga Anda tidak mudah lapar.</p>

<p><strong>Cara Terbaik Mengonsumsi Oatmeal:</strong></p>
<ul>
    <li>Gunakan rolled oats atau steel-cut oats, bukan instant</li>
    <li>Masak dengan air atau susu rendah lemak</li>
    <li>Tambahkan buah segar dan kayu manis</li>
    <li>Hindari menambahkan gula</li>
    <li>Makan di pagi hari untuk energi sepanjang hari</li>
</ul>

<h2 id="tips">Tips Mengonsumsi Makanan Diet</h2>
<p>Untuk hasil maksimal, ikuti panduan berikut:</p>

<ul>
    <li><strong>Porsi Seimbang:</strong> Gunakan metode piring: 1/2 sayuran, 1/4 protein, 1/4 karbohidrat kompleks</li>
    <li><strong>Metode Memasak:</strong> Kukus, panggang, atau rebus. Hindari menggoreng dengan minyak banyak</li>
    <li><strong>Hidrasi:</strong> Minum minimal 8 gelas air putih per hari, lebih banyak jika berolahraga</li>
    <li><strong>Olahraga:</strong> Kombinasikan dengan latihan kardio dan strength training minimal 3-4 kali seminggu</li>
    <li><strong>Hindari:</strong> Makanan olahan, gula tambahan, minuman manis, dan gorengan</li>
    <li><strong>Jadwal Makan:</strong> Makan 3 kali sehari dengan 2 snack sehat di antaranya</li>
    <li><strong>Tidur Cukup:</strong> 7-9 jam per malam untuk metabolisme optimal</li>
</ul>

<p>Dengan mengombinasikan makanan-makanan di atas dan menjalani pola hidup sehat, target berat badan ideal Anda akan lebih mudah tercapai. Ingat, diet yang sehat adalah diet yang berkelanjutan dan tidak membuat Anda tersiksa. Konsistensi adalah kunci sukses!</p>',
                'category' => 'Hidup Sehat',
                'category_color' => 'green',
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&h=500&fit=crop',
                'read_time' => '8 min read',
                'published_at' => '2 hari lalu',
                'author' => 'Dr. Sarah Nutritionist',
            ],
            
            // Article 2
            [
                'id' => 2,
                'slug' => 'tips-olahraga-efektif-untuk-kesehatan-jantung',
                'title' => 'Tips Olahraga yang Efektif untuk Kesehatan Jantung',
                'excerpt' => 'Olahraga teratur sangat penting untuk menjaga kesehatan jantung. Pelajari jenis olahraga yang paling efektif untuk meningkatkan fungsi kardiovaskular Anda.',
                'quote' => 'Jantung yang sehat adalah kunci kehidupan yang berkualitas dan panjang umur.',
                'content' => '<div class="article-quote mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 italic text-gray-700">"Jantung yang sehat adalah kunci kehidupan yang berkualitas dan panjang umur."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#manfaat" class="text-blue-600 hover:underline">Manfaat Olahraga untuk Jantung</a></li>
    <li><a href="#jalan-cepat" class="text-blue-600 hover:underline">Jalan Cepat</a></li>
    <li><a href="#bersepeda" class="text-blue-600 hover:underline">Bersepeda</a></li>
    <li><a href="#berenang" class="text-blue-600 hover:underline">Berenang</a></li>
    <li><a href="#jogging" class="text-blue-600 hover:underline">Jogging</a></li>
    <li><a href="#tips-aman" class="text-blue-600 hover:underline">Tips Olahraga Aman</a></li>
</ul>

<p>Kesehatan jantung adalah fondasi dari kesejahteraan tubuh secara keseluruhan. Jantung yang kuat dan sehat memompa darah lebih efisien ke seluruh tubuh, memberikan oksigen dan nutrisi yang dibutuhkan setiap sel.</p>

<h2 id="manfaat">Manfaat Olahraga untuk Jantung</h2>
<p>Olahraga teratur memberikan manfaat luar biasa untuk kesehatan kardiovaskular:</p>

<ul>
    <li><strong>Memperkuat Otot Jantung:</strong> Membuat jantung memompa lebih efisien dengan usaha lebih sedikit</li>
    <li><strong>Menurunkan Tekanan Darah:</strong> Mengurangi risiko hipertensi hingga 30%</li>
    <li><strong>Meningkatkan Kolesterol Baik (HDL):</strong> Membantu membersihkan pembuluh darah</li>
    <li><strong>Mengurangi Kolesterol Jahat (LDL):</strong> Menurunkan risiko plak di arteri</li>
    <li><strong>Mengontrol Berat Badan:</strong> Mengurangi beban kerja jantung</li>
    <li><strong>Meningkatkan Sirkulasi:</strong> Darah mengalir lebih lancar ke seluruh tubuh</li>
    <li><strong>Mengurangi Stres:</strong> Stres kronis merusak jantung</li>
</ul>

<h2 id="jalan-cepat">1. Jalan Cepat</h2>
<p>Jalan cepat adalah olahraga paling sederhana namun sangat efektif untuk jantung. Tidak memerlukan peralatan khusus dan bisa dilakukan di mana saja.</p>

<p><strong>Panduan Jalan Cepat:</strong></p>
<ul>
    <li>Durasi: 30-45 menit per sesi</li>
    <li>Frekuensi: 5-7 kali seminggu</li>
    <li>Kecepatan: 5-6 km/jam (langkah cepat tapi masih bisa bicara)</li>
    <li>Target detak jantung: 50-70% dari detak maksimal</li>
    <li>Manfaat: Membakar 150-300 kalori per sesi</li>
</ul>

<p><strong>Tips Efektif:</strong> Gunakan sepatu yang nyaman, jaga postur tubuh tegak, ayunkan lengan secara alami, dan tingkatkan kecepatan secara bertahap.</p>

<h2 id="bersepeda">2. Bersepeda</h2>
<p>Bersepeda adalah olahraga aerobik excellent yang melatih jantung tanpa membebani sendi. Cocok untuk semua usia dan tingkat kebugaran.</p>

<p><strong>Program Bersepeda:</strong></p>
<ul>
    <li>Pemula: 20-30 menit, 3 kali seminggu</li>
    <li>Menengah: 45-60 menit, 4-5 kali seminggu</li>
    <li>Lanjutan: 60-90 menit, 5-6 kali seminggu</li>
    <li>Kecepatan: Sedang, detak jantung 60-80% maksimal</li>
</ul>

<p><strong>Manfaat Khusus:</strong> Meningkatkan stamina kardiovaskular, memperkuat otot kaki, membakar 400-750 kalori per jam, dan ramah lingkungan!</p>

<h2 id="berenang">3. Berenang</h2>
<p>Berenang adalah olahraga total body workout yang luar biasa untuk jantung. Air memberikan resistance alami yang melatih otot dan jantung secara bersamaan.</p>

<p><strong>Gaya Renang Terbaik:</strong></p>
<ul>
    <li><strong>Gaya Bebas:</strong> Paling efisien untuk kardio</li>
    <li><strong>Gaya Punggung:</strong> Bagus untuk postur</li>
    <li><strong>Gaya Dada:</strong> Mudah untuk pemula</li>
    <li><strong>Gaya Kupu-kupu:</strong> Intensitas tinggi</li>
</ul>

<p><strong>Rekomendasi:</strong> Berenang 30-45 menit, 2-3 kali seminggu. Kombinasikan berbagai gaya untuk hasil optimal.</p>

<h2 id="jogging">4. Jogging</h2>
<p>Jogging atau lari pelan adalah cara efektif meningkatkan kapasitas aerobik dan memperkuat jantung.</p>

<p><strong>Panduan Memulai Jogging:</strong></p>
<ul>
    <li>Minggu 1-2: 15 menit jogging + 5 menit jalan</li>
    <li>Minggu 3-4: 20 menit jogging + 5 menit jalan</li>
    <li>Minggu 5-6: 25-30 menit jogging tanpa jeda</li>
    <li>Setelahnya: Tingkatkan durasi 10% per minggu</li>
</ul>

<p><strong>Penting:</strong> Investasi sepatu lari yang baik, jogging di permukaan yang rata, dan dengarkan tubuh Anda.</p>

<h2 id="tips-aman">Tips Berolahraga Aman untuk Jantung</h2>

<p><strong>Sebelum Memulai:</strong></p>
<ul>
    <li>Konsultasi dengan dokter, terutama jika berusia 40+ atau punya riwayat jantung</li>
    <li>Mulai dengan intensitas rendah dan tingkatkan bertahap</li>
    <li>Lakukan pemeriksaan kesehatan rutin</li>
</ul>

<p><strong>Saat Berolahraga:</strong></p>
<ul>
    <li>Selalu pemanasan 5-10 menit sebelum olahraga inti</li>
    <li>Monitor detak jantung (gunakan heart rate monitor atau cek nadi)</li>
    <li>Jaga hidrasi - minum air sebelum, selama, dan setelah olahraga</li>
    <li>Bernapas teratur, jangan menahan napas</li>
    <li>Hentikan jika merasa nyeri dada, pusing, atau sesak napas berlebihan</li>
</ul>

<p><strong>Setelah Olahraga:</strong></p>
<ul>
    <li>Pendinginan 5-10 menit dengan jalan pelan atau stretching</li>
    <li>Catat progress Anda untuk motivasi</li>
    <li>Istirahat cukup untuk recovery</li>
</ul>

<p><strong>Target Detak Jantung:</strong> Untuk manfaat kardiovaskular optimal, targetkan 50-85% dari detak jantung maksimal. Rumus detak maksimal: 220 - usia Anda.</p>

<p>Contoh: Usia 40 tahun = Detak maksimal 180 bpm, Target zona 90-153 bpm</p>

<p>Ingat, konsistensi lebih penting dari intensitas. Lebih baik olahraga ringan secara teratur daripada olahraga berat sekali-sekali. Jadikan olahraga sebagai bagian dari gaya hidup, bukan kewajiban!</p>',
                'category' => 'Olahraga',
                'category_color' => 'blue',
                'image' => 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?w=800&h=500&fit=crop',
                'read_time' => '10 min read',
                'published_at' => '3 hari lalu',
                'author' => 'Dr. Ahmad Kardiologi',
            ],
            
            // Article 3
            [
                'id' => 3,
                'slug' => 'mengelola-diabetes-dengan-pola-makan-sehat',
                'title' => 'Mengelola Diabetes dengan Pola Makan Sehat',
                'excerpt' => 'Pola makan yang tepat sangat penting bagi penderita diabetes. Temukan panduan lengkap tentang makanan yang aman dan nutrisi yang dibutuhkan.',
                'quote' => 'Diabetes bukan akhir dari kehidupan sehat, tetapi awal dari gaya hidup yang lebih bijak.',
                'content' => '<div class="article-quote mb-6 p-4 bg-red-50 border-l-4 border-red-500 italic text-gray-700">"Diabetes bukan akhir dari kehidupan sehat, tetapi awal dari gaya hidup yang lebih bijak."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#pengenalan" class="text-blue-600 hover:underline">Pengenalan Diabetes</a></li>
    <li><a href="#karbohidrat" class="text-blue-600 hover:underline">Mengatur Karbohidrat</a></li>
    <li><a href="#makanan-sehat" class="text-blue-600 hover:underline">Makanan Sehat untuk Diabetes</a></li>
    <li><a href="#hindari" class="text-blue-600 hover:underline">Makanan yang Harus Dihindari</a></li>
    <li><a href="#jadwal-makan" class="text-blue-600 hover:underline">Jadwal Makan</a></li>
</ul>

<h2 id="pengenalan">Memahami Diabetes</h2>
<p>Diabetes adalah kondisi di mana tubuh tidak dapat mengatur gula darah dengan baik. Pola makan yang tepat adalah kunci utama dalam mengelola diabetes dan mencegah komplikasi.</p>

<h2 id="karbohidrat">Mengatur Karbohidrat</h2>
<p>Karbohidrat memiliki dampak terbesar pada gula darah. Pilih karbohidrat kompleks dengan indeks glikemik rendah:</p>
<ul>
    <li>Beras merah lebih baik dari nasi putih</li>
    <li>Roti gandum utuh daripada roti putih</li>
    <li>Pasta whole grain</li>
    <li>Kentang manis daripada kentang putih</li>
    <li>Oatmeal steel-cut untuk sarapan</li>
</ul>

<h2 id="makanan-sehat">Makanan Sehat untuk Diabetes</h2>
<p>Fokus pada makanan yang membantu mengontrol gula darah:</p>
<ul>
    <li><strong>Sayuran non-starchy:</strong> Brokoli, bayam, kembang kol, mentimun</li>
    <li><strong>Protein tanpa lemak:</strong> Ikan, dada ayam, tahu, tempe</li>
    <li><strong>Lemak sehat:</strong> Alpukat, kacang-kacangan, minyak zaitun</li>
    <li><strong>Buah rendah gula:</strong> Apel, pir, beri, jeruk</li>
</ul>

<h2 id="hindari">Makanan yang Harus Dihindari</h2>
<p>Batasi atau hindari makanan ini:</p>
<ul>
    <li>Minuman manis dan soda</li>
    <li>Makanan olahan dan fast food</li>
    <li>Kue, pastry, dan permen</li>
    <li>Gorengan dan makanan berlemak tinggi</li>
    <li>Daging merah berlemak</li>
</ul>

<h2 id="jadwal-makan">Jadwal Makan Teratur</h2>
<p>Makan pada waktu yang sama setiap hari membantu mengatur gula darah:</p>
<ul>
    <li>Sarapan: Dalam 1 jam setelah bangun</li>
    <li>Makan siang: 4-5 jam setelah sarapan</li>
    <li>Makan malam: 4-5 jam setelah makan siang</li>
    <li>Snack sehat di antara waktu makan jika diperlukan</li>
</ul>

<p>Konsultasikan dengan dokter atau ahli gizi untuk rencana makan yang sesuai dengan kondisi Anda.</p>',
                'category' => 'Diabetes',
                'category_color' => 'red',
                'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=800&h=500&fit=crop',
                'read_time' => '6 min read',
                'published_at' => '4 hari lalu',
                'author' => 'Dr. Linda Endokrinologi',
            ],
            
            // Article 4
            [
                'id' => 4,
                'slug' => 'pentingnya-vitamin-dan-mineral-untuk-tubuh',
                'title' => 'Pentingnya Vitamin dan Mineral untuk Tubuh',
                'excerpt' => 'Vitamin dan mineral adalah nutrisi esensial yang dibutuhkan tubuh. Pelajari manfaat masing-masing vitamin dan sumber makanan terbaik.',
                'quote' => 'Vitamin dan mineral adalah kunci untuk kesehatan optimal dan umur panjang.',
                'content' => '<div class="article-quote mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-500 italic text-gray-700">"Vitamin dan mineral adalah kunci untuk kesehatan optimal dan umur panjang."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#vitamin-c" class="text-blue-600 hover:underline">Vitamin C</a></li>
    <li><a href="#vitamin-d" class="text-blue-600 hover:underline">Vitamin D</a></li>
    <li><a href="#kalsium" class="text-blue-600 hover:underline">Kalsium</a></li>
    <li><a href="#zat-besi" class="text-blue-600 hover:underline">Zat Besi</a></li>
    <li><a href="#suplemen" class="text-blue-600 hover:underline">Kapan Perlu Suplemen</a></li>
</ul>

<h2 id="vitamin-c">Vitamin C</h2>
<p>Vitamin C adalah antioksidan kuat yang meningkatkan sistem kekebalan tubuh:</p>
<ul>
    <li><strong>Manfaat:</strong> Melawan infeksi, membantu penyerapan zat besi, menjaga kesehatan kulit</li>
    <li><strong>Sumber:</strong> Jeruk, strawberry, paprika, brokoli, kiwi</li>
    <li><strong>Kebutuhan harian:</strong> 75-90 mg untuk orang dewasa</li>
</ul>

<h2 id="vitamin-d">Vitamin D</h2>
<p>Vitamin D penting untuk kesehatan tulang dan sistem kekebalan:</p>
<ul>
    <li><strong>Manfaat:</strong> Membantu penyerapan kalsium, memperkuat tulang, meningkatkan mood</li>
    <li><strong>Sumber:</strong> Sinar matahari (15-20 menit/hari), ikan salmon, telur, susu fortifikasi</li>
    <li><strong>Kebutuhan harian:</strong> 600-800 IU</li>
</ul>

<h2 id="kalsium">Kalsium</h2>
<p>Kalsium adalah mineral utama untuk tulang dan gigi yang kuat:</p>
<ul>
    <li><strong>Manfaat:</strong> Memperkuat tulang dan gigi, membantu pembekuan darah, fungsi otot</li>
    <li><strong>Sumber:</strong> Susu, yogurt, keju, bayam, kacang almond, ikan sarden</li>
    <li><strong>Kebutuhan harian:</strong> 1000-1200 mg</li>
</ul>

<h2 id="zat-besi">Zat Besi</h2>
<p>Zat besi penting untuk produksi sel darah merah:</p>
<ul>
    <li><strong>Manfaat:</strong> Mengangkut oksigen, mencegah anemia, meningkatkan energi</li>
    <li><strong>Sumber:</strong> Daging merah, hati, bayam, kacang-kacangan, sereal fortifikasi</li>
    <li><strong>Kebutuhan harian:</strong> 8-18 mg (lebih tinggi untuk wanita)</li>
</ul>

<h2 id="suplemen">Kapan Perlu Suplemen</h2>
<p>Suplemen diperlukan jika:</p>
<ul>
    <li>Diet tidak mencukupi kebutuhan nutrisi</li>
    <li>Kondisi medis tertentu (hamil, menyusui, lansia)</li>
    <li>Defisiensi vitamin yang didiagnosis dokter</li>
    <li>Pola makan vegetarian/vegan</li>
</ul>

<p>Konsultasikan dengan dokter sebelum mengonsumsi suplemen untuk dosis yang tepat.</p>',
                'category' => 'Nutrisi',
                'category_color' => 'yellow',
                'image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800&h=500&fit=crop',
                'read_time' => '8 min read',
                'published_at' => '5 hari lalu',
                'author' => 'Dr. Maria Nutrisionis',
            ],
            
            // Article 5
            [
                'id' => 5,
                'slug' => 'cara-mengatasi-stres-dan-menjaga-kesehatan-mental',
                'title' => 'Cara Mengatasi Stres dan Menjaga Kesehatan Mental',
                'excerpt' => 'Kesehatan mental sama pentingnya dengan kesehatan fisik. Temukan strategi efektif untuk mengelola stres dan meningkatkan kesejahteraan mental.',
                'quote' => 'Kesehatan mental adalah fondasi dari kehidupan yang bahagia dan produktif.',
                'content' => '<div class="article-quote mb-6 p-4 bg-purple-50 border-l-4 border-purple-500 italic text-gray-700">"Kesehatan mental adalah fondasi dari kehidupan yang bahagia dan produktif."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#mengenal-stres" class="text-blue-600 hover:underline">Mengenal Stres</a></li>
    <li><a href="#teknik-relaksasi" class="text-blue-600 hover:underline">Teknik Relaksasi</a></li>
    <li><a href="#olahraga-mental" class="text-blue-600 hover:underline">Olahraga untuk Mental</a></li>
    <li><a href="#dukungan-sosial" class="text-blue-600 hover:underline">Dukungan Sosial</a></li>
    <li><a href="#kapan-bantuan" class="text-blue-600 hover:underline">Kapan Perlu Bantuan</a></li>
</ul>

<h2 id="mengenal-stres">Mengenal Stres</h2>
<p>Stres adalah respons alami tubuh terhadap tekanan. Namun, stres berkepanjangan dapat merusak kesehatan fisik dan mental:</p>
<ul>
    <li><strong>Gejala fisik:</strong> Sakit kepala, gangguan tidur, kelelahan</li>
    <li><strong>Gejala emosional:</strong> Cemas, mudah marah, sedih berkepanjangan</li>
    <li><strong>Gejala perilaku:</strong> Perubahan nafsu makan, isolasi sosial</li>
</ul>

<h2 id="teknik-relaksasi">Teknik Relaksasi</h2>
<p>Praktikkan teknik ini secara rutin:</p>
<ul>
    <li><strong>Pernapasan dalam:</strong> Tarik napas 4 detik, tahan 4 detik, buang 4 detik</li>
    <li><strong>Meditasi:</strong> 10-15 menit per hari untuk menenangkan pikiran</li>
    <li><strong>Yoga:</strong> Kombinasi gerakan dan pernapasan untuk relaksasi</li>
    <li><strong>Progressive muscle relaxation:</strong> Tegang dan relaksasi otot secara bertahap</li>
    <li><strong>Mindfulness:</strong> Fokus pada saat ini tanpa menilai</li>
</ul>

<h2 id="olahraga-mental">Olahraga untuk Kesehatan Mental</h2>
<p>Aktivitas fisik sangat efektif mengurangi stres:</p>
<ul>
    <li>Jalan kaki 30 menit setiap hari</li>
    <li>Bersepeda atau berenang</li>
    <li>Olahraga kelompok untuk interaksi sosial</li>
    <li>Yoga atau tai chi untuk keseimbangan</li>
</ul>
<p>Olahraga melepaskan endorfin yang meningkatkan mood dan mengurangi stres.</p>

<h2 id="dukungan-sosial">Pentingnya Dukungan Sosial</h2>
<p>Jangan menghadapi masalah sendirian:</p>
<ul>
    <li>Berbicara dengan keluarga dan teman</li>
    <li>Bergabung dengan komunitas atau kelompok hobi</li>
    <li>Pertahankan hubungan sosial yang sehat</li>
    <li>Jangan ragu meminta bantuan</li>
</ul>

<h2 id="kapan-bantuan">Kapan Perlu Bantuan Profesional</h2>
<p>Segera cari bantuan jika mengalami:</p>
<ul>
    <li>Stres yang mengganggu aktivitas sehari-hari</li>
    <li>Pikiran untuk menyakiti diri sendiri</li>
    <li>Depresi yang berkepanjangan</li>
    <li>Gangguan tidur atau makan yang parah</li>
    <li>Serangan panik berulang</li>
</ul>

<p>Psikolog, psikiater, atau konselor profesional dapat memberikan dukungan yang Anda butuhkan.</p>',
                'category' => 'Kesehatan Mental',
                'category_color' => 'purple',
                'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&h=500&fit=crop',
                'read_time' => '10 min read',
                'published_at' => '1 minggu lalu',
                'author' => 'Dr. Budi Psikolog',
            ],
            
            // Article 6
            [
                'id' => 6,
                'slug' => 'tips-tidur-berkualitas-untuk-kulit-sehat-dan-bercahaya',
                'title' => 'Tips Tidur Berkualitas untuk Kulit Sehat dan Bercahaya',
                'excerpt' => 'Tidur yang cukup dan berkualitas sangat penting untuk kesehatan kulit. Pelajari bagaimana tidur mempengaruhi kecantikan dan tips untuk tidur lebih baik.',
                'quote' => 'Beauty sleep bukan mitos - tidur berkualitas adalah rahasia kulit sehat alami.',
                'content' => '<div class="article-quote mb-6 p-4 bg-indigo-50 border-l-4 border-indigo-500 italic text-gray-700">"Beauty sleep bukan mitos - tidur berkualitas adalah rahasia kulit sehat alami."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#hubungan" class="text-blue-600 hover:underline">Hubungan Tidur dan Kulit</a></li>
    <li><a href="#durasi" class="text-blue-600 hover:underline">Durasi Tidur Ideal</a></li>
    <li><a href="#rutinitas" class="text-blue-600 hover:underline">Rutinitas Sebelum Tidur</a></li>
    <li><a href="#skincare" class="text-blue-600 hover:underline">Skincare Malam</a></li>
    <li><a href="#lingkungan" class="text-blue-600 hover:underline">Lingkungan Tidur</a></li>
</ul>

<h2 id="hubungan">Hubungan Tidur dan Kesehatan Kulit</h2>
<p>Saat tidur, tubuh memperbaiki sel-sel kulit yang rusak:</p>
<ul>
    <li><strong>Produksi kolagen:</strong> Meningkat saat tidur, menjaga elastisitas kulit</li>
    <li><strong>Regenerasi sel:</strong> Sel kulit mati diganti dengan yang baru</li>
    <li><strong>Perbaikan DNA:</strong> Kerusakan akibat UV diperbaiki</li>
    <li><strong>Sirkulasi darah:</strong> Meningkat, memberikan nutrisi ke kulit</li>
</ul>

<h2 id="durasi">Durasi Tidur Ideal</h2>
<p>Kebutuhan tidur berdasarkan usia:</p>
<ul>
    <li><strong>Remaja (14-17 tahun):</strong> 8-10 jam</li>
    <li><strong>Dewasa muda (18-25):</strong> 7-9 jam</li>
    <li><strong>Dewasa (26-64):</strong> 7-9 jam</li>
    <li><strong>Lansia (65+):</strong> 7-8 jam</li>
</ul>
<p>Kurang tidur menyebabkan lingkaran hitam, kulit kusam, dan penuaan dini.</p>

<h2 id="rutinitas">Rutinitas Sebelum Tidur</h2>
<p>Ciptakan rutinitas yang membantu tidur lebih nyenyak:</p>
<ul>
    <li>Tidur dan bangun di waktu yang sama setiap hari</li>
    <li>Hindari kafein 6 jam sebelum tidur</li>
    <li>Matikan gadget 1 jam sebelum tidur</li>
    <li>Mandi air hangat untuk relaksasi</li>
    <li>Baca buku atau dengarkan musik tenang</li>
    <li>Hindari makan berat 2-3 jam sebelum tidur</li>
</ul>

<h2 id="skincare">Skincare Routine Malam</h2>
<p>Maksimalkan waktu tidur dengan skincare yang tepat:</p>
<ul>
    <li><strong>Pembersihan:</strong> Hapus makeup dan kotoran dengan double cleansing</li>
    <li><strong>Toner:</strong> Seimbangkan pH kulit</li>
    <li><strong>Serum:</strong> Gunakan serum repair atau anti-aging</li>
    <li><strong>Eye cream:</strong> Kurangi lingkaran hitam dan kerutan</li>
    <li><strong>Moisturizer:</strong> Kunci kelembaban sepanjang malam</li>
    <li><strong>Sleeping mask:</strong> 2-3 kali seminggu untuk hidrasi ekstra</li>
</ul>

<h2 id="lingkungan">Lingkungan Tidur Ideal</h2>
<p>Ciptakan kamar tidur yang mendukung kualitas tidur:</p>
<ul>
    <li><strong>Suhu:</strong> 18-22°C adalah suhu optimal</li>
    <li><strong>Pencahayaan:</strong> Ruangan gelap atau gunakan eye mask</li>
    <li><strong>Ketenangan:</strong> Gunakan earplug jika perlu</li>
    <li><strong>Kasur dan bantal:</strong> Nyaman dan mendukung postur</li>
    <li><strong>Sarung bantal:</strong> Gunakan sarung bantal sutra atau satin untuk mengurangi gesekan</li>
</ul>

<p>Tidur berkualitas adalah investasi terbaik untuk kulit sehat dan bercahaya alami. Mulai rutinitas tidur yang baik dari malam ini!</p>',
                'category' => 'Kecantikan',
                'category_color' => 'indigo',
                'image' => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=800&h=500&fit=crop',
                'read_time' => '6 min read',
                'published_at' => '1 minggu lalu',
                'author' => 'Dr. Siti Dermatologi',
            ],
            
            // Article 7
            [
                'id' => 7,
                'slug' => 'bahaya-hipertensi-dan-cara-mencegahnya',
                'title' => 'Bahaya Hipertensi dan Cara Mencegahnya',
                'excerpt' => 'Hipertensi atau tekanan darah tinggi adalah silent killer. Kenali bahayanya dan pelajari cara mencegah serta mengelola hipertensi secara efektif.',
                'quote' => 'Tekanan darah normal adalah kunci kesehatan jangka panjang.',
                'content' => '<div class="article-quote mb-6 p-4 bg-red-50 border-l-4 border-red-500 italic text-gray-700">"Tekanan darah normal adalah kunci kesehatan jangka panjang."</div>

<h2>Apa Itu Hipertensi?</h2>
<p>Hipertensi adalah kondisi tekanan darah tinggi (≥140/90 mmHg) yang membebani jantung dan pembuluh darah. Disebut silent killer karena sering tanpa gejala hingga terjadi komplikasi serius.</p>

<h2>Bahaya Hipertensi</h2>
<ul>
    <li>Serangan jantung dan gagal jantung</li>
    <li>Stroke dan kerusakan otak</li>
    <li>Gagal ginjal kronis</li>
    <li>Kerusakan pembuluh darah mata</li>
    <li>Aneurisma (pembengkakan pembuluh darah)</li>
</ul>

<h2>Faktor Risiko</h2>
<ul>
    <li><strong>Usia:</strong> Risiko meningkat seiring bertambahnya usia</li>
    <li><strong>Keturunan:</strong> Riwayat keluarga hipertensi</li>
    <li><strong>Obesitas:</strong> Berat badan berlebih</li>
    <li><strong>Kurang olahraga:</strong> Gaya hidup sedentary</li>
    <li><strong>Stres:</strong> Tekanan psikologis berkepanjangan</li>
    <li><strong>Asupan garam tinggi:</strong> Lebih dari 5 gram per hari</li>
</ul>

<h2>Cara Mencegah Hipertensi</h2>
<p><strong>1. Diet DASH (Dietary Approaches to Stop Hypertension):</strong></p>
<ul>
    <li>Banyak sayur dan buah (8-10 porsi/hari)</li>
    <li>Whole grains (6-8 porsi/hari)</li>
    <li>Protein tanpa lemak</li>
    <li>Kurangi garam hingga kurang dari 1 sendok teh/hari</li>
</ul>

<p><strong>2. Olahraga Teratur:</strong></p>
<ul>
    <li>30 menit aktivitas aerobik, 5 hari seminggu</li>
    <li>Jalan cepat, bersepeda, berenang</li>
    <li>Kombinasi dengan latihan kekuatan 2x seminggu</li>
</ul>

<p><strong>3. Kelola Stres:</strong></p>
<ul>
    <li>Meditasi dan yoga</li>
    <li>Teknik pernapasan dalam</li>
    <li>Hobi dan rekreasi</li>
    <li>Tidur cukup 7-9 jam</li>
</ul>

<p><strong>4. Hindari:</strong></p>
<ul>
    <li>Merokok dan alkohol berlebihan</li>
    <li>Makanan olahan dan fast food</li>
    <li>Begadang dan kurang tidur</li>
</ul>

<p>Cek tekanan darah secara rutin, terutama jika memiliki faktor risiko. Deteksi dini adalah kunci pencegahan komplikasi!</p>',
                'category' => 'Hipertensi',
                'category_color' => 'red',
                'image' => 'https://images.unsplash.com/photo-1584362917165-526a968579e8?w=800&h=500&fit=crop',
                'read_time' => '7 min read',
                'published_at' => '2 minggu lalu',
                'author' => 'Dr. Budi Kardiologi',
            ],
            
            // Article 8
            [
                'id' => 8,
                'slug' => 'manfaat-yoga-untuk-kesehatan-fisik-dan-mental',
                'title' => 'Manfaat Yoga untuk Kesehatan Fisik dan Mental',
                'excerpt' => 'Yoga bukan hanya olahraga, tapi gaya hidup holistik. Temukan manfaat luar biasa yoga untuk tubuh, pikiran, dan jiwa Anda.',
                'quote' => 'Yoga adalah perjalanan diri, melalui diri, menuju diri.',
                'content' => '<div class="article-quote mb-6 p-4 bg-purple-50 border-l-4 border-purple-500 italic text-gray-700">"Yoga adalah perjalanan diri, melalui diri, menuju diri."</div>

<h2>Apa Itu Yoga?</h2>
<p>Yoga adalah praktik kuno dari India yang menggabungkan postur tubuh (asana), pernapasan (pranayama), dan meditasi untuk keseimbangan fisik dan mental.</p>

<h2>Manfaat Fisik Yoga</h2>
<ul>
    <li><strong>Fleksibilitas:</strong> Meningkatkan kelenturan otot dan sendi</li>
    <li><strong>Kekuatan:</strong> Membangun massa otot tanpa beban berat</li>
    <li><strong>Postur:</strong> Memperbaiki alignment tulang belakang</li>
    <li><strong>Keseimbangan:</strong> Meningkatkan koordinasi tubuh</li>
    <li><strong>Kesehatan jantung:</strong> Menurunkan tekanan darah</li>
    <li><strong>Pencernaan:</strong> Melancarkan sistem pencernaan</li>
</ul>

<h2>Manfaat Mental dan Emosional</h2>
<ul>
    <li><strong>Mengurangi stres:</strong> Menurunkan kortisol</li>
    <li><strong>Meningkatkan fokus:</strong> Konsentrasi lebih baik</li>
    <li><strong>Kualitas tidur:</strong> Tidur lebih nyenyak</li>
    <li><strong>Kecemasan:</strong> Mengurangi anxiety dan depresi</li>
    <li><strong>Mindfulness:</strong> Kesadaran diri meningkat</li>
</ul>

<h2>Jenis Yoga untuk Pemula</h2>
<p><strong>1. Hatha Yoga:</strong> Paling cocok untuk pemula, gerakan lambat dan dasar</p>
<p><strong>2. Vinyasa Yoga:</strong> Aliran gerakan yang dinamis</p>
<p><strong>3. Yin Yoga:</strong> Postur ditahan lama untuk relaksasi mendalam</p>
<p><strong>4. Restorative Yoga:</strong> Sangat lembut, fokus pada pemulihan</p>

<h2>Tips Memulai Yoga</h2>
<ul>
    <li>Mulai dengan kelas pemula atau video online</li>
    <li>Gunakan matras yoga yang nyaman</li>
    <li>Pakai pakaian yang fleksibel</li>
    <li>Jangan paksa tubuh, hormati batasannya</li>
    <li>Konsisten 3-4 kali seminggu</li>
    <li>Fokus pada pernapasan</li>
</ul>

<h2>Pose Yoga Dasar</h2>
<ul>
    <li><strong>Mountain Pose (Tadasana):</strong> Postur berdiri dasar</li>
    <li><strong>Downward Dog:</strong> Peregangan seluruh tubuh</li>
    <li><strong>Child Pose:</strong> Relaksasi dan istirahat</li>
    <li><strong>Warrior Pose:</strong> Kekuatan dan keseimbangan</li>
    <li><strong>Tree Pose:</strong> Fokus dan stabilitas</li>
</ul>

<p>Yoga adalah investasi untuk kesehatan jangka panjang. Tidak perlu sempurna, yang penting konsisten dan nikmati prosesnya!</p>',
                'category' => 'Olahraga',
                'category_color' => 'blue',
                'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&h=500&fit=crop',
                'read_time' => '8 min read',
                'published_at' => '2 minggu lalu',
                'author' => 'Instruktur Dewi Yoga',
            ],
            
            // Article 9
            [
                'id' => 9,
                'slug' => 'makanan-super-untuk-meningkatkan-imun-tubuh',
                'title' => 'Makanan Super untuk Meningkatkan Imun Tubuh',
                'excerpt' => 'Sistem imun yang kuat adalah pertahanan terbaik melawan penyakit. Kenali makanan super yang dapat meningkatkan daya tahan tubuh Anda.',
                'quote' => 'Makanan adalah obat terbaik, dan obat terbaik adalah makanan.',
                'content' => '<div class="article-quote mb-6 p-4 bg-green-50 border-l-4 border-green-500 italic text-gray-700">"Makanan adalah obat terbaik, dan obat terbaik adalah makanan."</div>

<h2>Pentingnya Sistem Imun Kuat</h2>
<p>Sistem imun adalah pertahanan alami tubuh melawan virus, bakteri, dan penyakit. Nutrisi yang tepat dapat memperkuat sistem imun Anda.</p>

<h2>Makanan Super Penambah Imun</h2>

<p><strong>1. Jeruk dan Buah Citrus</strong></p>
<ul>
    <li>Tinggi vitamin C (antioksidan kuat)</li>
    <li>Meningkatkan produksi sel darah putih</li>
    <li>Contoh: Jeruk, lemon, grapefruit, limau</li>
</ul>

<p><strong>2. Bawang Putih</strong></p>
<ul>
    <li>Mengandung allicin (antibakteri dan antivirus)</li>
    <li>Meningkatkan respons sel T</li>
    <li>Konsumsi 2-3 siung per hari</li>
</ul>

<p><strong>3. Jahe</strong></p>
<ul>
    <li>Anti-inflamasi alami</li>
    <li>Mengurangi sakit tenggorokan</li>
    <li>Meningkatkan sirkulasi darah</li>
</ul>

<p><strong>4. Bayam</strong></p>
<ul>
    <li>Vitamin C, beta karoten, antioksidan</li>
    <li>Zat besi untuk energi</li>
    <li>Masak sebentar untuk nutrisi maksimal</li>
</ul>

<p><strong>5. Yogurt</strong></p>
<ul>
    <li>Probiotik untuk kesehatan usus</li>
    <li>70% sistem imun ada di usus</li>
    <li>Pilih plain yogurt tanpa gula</li>
</ul>

<p><strong>6. Almond</strong></p>
<ul>
    <li>Vitamin E (antioksidan larut lemak)</li>
    <li>28 gram = 50% kebutuhan vitamin E harian</li>
    <li>Memperkuat respons imun</li>
</ul>

<p><strong>7. Kunyit</strong></p>
<ul>
    <li>Curcumin sebagai anti-inflamasi</li>
    <li>Meningkatkan antibodi</li>
    <li>Kombinasi dengan lada hitam untuk penyerapan optimal</li>
</ul>

<p><strong>8. Teh Hijau</strong></p>
<ul>
    <li>EGCG (antioksidan kuat)</li>
    <li>L-theanine untuk produksi sel T</li>
    <li>Minum 2-3 cangkir per hari</li>
</ul>

<p><strong>9. Paprika Merah</strong></p>
<ul>
    <li>2x lebih banyak vitamin C dari jeruk</li>
    <li>Beta karoten untuk kulit sehat</li>
    <li>Vitamin A untuk mata</li>
</ul>

<p><strong>10. Kiwi</strong></p>
<ul>
    <li>Vitamin C, K, folat, potasium</li>
    <li>Mendukung seluruh fungsi tubuh</li>
    <li>Makan dengan kulitnya untuk serat</li>
</ul>

<h2>Tips Meningkatkan Imun</h2>
<ul>
    <li>Variasi makanan warna-warni</li>
    <li>Minum air 8-10 gelas per hari</li>
    <li>Tidur cukup 7-9 jam</li>
    <li>Olahraga teratur 30 menit/hari</li>
    <li>Kelola stres dengan baik</li>
    <li>Hindari merokok dan alkohol</li>
</ul>

<p>Sistem imun yang kuat dimulai dari piring Anda. Konsumsi makanan bergizi setiap hari untuk pertahanan optimal!</p>',
                'category' => 'Nutrisi',
                'category_color' => 'yellow',
                'image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=800&h=500&fit=crop',
                'read_time' => '9 min read',
                'published_at' => '3 minggu lalu',
                'author' => 'Dr. Lisa Nutrisionis',
            ],
            
            // Article 10
            [
                'id' => 10,
                'slug' => 'panduan-lengkap-kesehatan-mata-di-era-digital',
                'title' => 'Panduan Lengkap Kesehatan Mata di Era Digital',
                'excerpt' => 'Layar digital ada di mana-mana. Pelajari cara melindungi mata dari kelelahan digital dan menjaga kesehatan penglihatan jangka panjang.',
                'quote' => 'Mata adalah jendela jiwa, jaga dengan baik.',
                'content' => '<div class="article-quote mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 italic text-gray-700">"Mata adalah jendela jiwa, jaga dengan baik."</div>

<h2>Digital Eye Strain</h2>
<p>Rata-rata orang menatap layar 7+ jam per hari, menyebabkan Computer Vision Syndrome (CVS) dengan gejala:</p>
<ul>
    <li>Mata kering dan gatal</li>
    <li>Penglihatan kabur</li>
    <li>Sakit kepala</li>
    <li>Nyeri leher dan bahu</li>
    <li>Kesulitan fokus</li>
</ul>

<h2>Aturan 20-20-20</h2>
<p>Metode terbaik mencegah kelelahan mata:</p>
<ul>
    <li>Setiap 20 menit</li>
    <li>Lihat objek 20 kaki (6 meter) jauhnya</li>
    <li>Selama 20 detik</li>
</ul>

<h2>Ergonomi Layar</h2>
<ul>
    <li><strong>Jarak:</strong> 50-70 cm dari mata</li>
    <li><strong>Posisi:</strong> Bagian atas layar sejajar dengan mata</li>
    <li><strong>Pencahayaan:</strong> Hindari silau dan pantulan</li>
    <li><strong>Brightness:</strong> Sesuaikan dengan cahaya ruangan</li>
    <li><strong>Font size:</strong> Cukup besar untuk dibaca tanpa memicingkan mata</li>
</ul>

<h2>Blue Light Protection</h2>
<ul>
    <li>Gunakan mode night shift/dark mode</li>
    <li>Pasang screen filter blue light</li>
    <li>Kacamata anti blue light</li>
    <li>Kurangi screen time 2 jam sebelum tidur</li>
</ul>

<h2>Makanan untuk Mata Sehat</h2>
<p><strong>Vitamin A:</strong> Wortel, ubi jalar, bayam</p>
<p><strong>Lutein & Zeaxanthin:</strong> Kale, bayam, brokoli</p>
<p><strong>Omega-3:</strong> Ikan salmon, tuna, sarden</p>
<p><strong>Vitamin C:</strong> Jeruk, strawberry, paprika</p>
<p><strong>Zinc:</strong> Kacang-kacangan, daging, telur</p>

<h2>Latihan Mata</h2>
<p><strong>1. Blinking:</strong> Berkedip 10-15 kali per menit untuk melembabkan</p>
<p><strong>2. Focus Change:</strong> Fokus objek dekat (15 detik) lalu jauh (15 detik), ulangi 5x</p>
<p><strong>3. Figure Eight:</strong> Gerakkan mata membentuk angka 8, 5x per arah</p>
<p><strong>4. Palming:</strong> Gosok tangan, tutup mata dengan telapak hangat, 30 detik</p>

<h2>Tanda Periksa ke Dokter</h2>
<ul>
    <li>Penglihatan tiba-tiba kabur</li>
    <li>Floaters atau kilatan cahaya</li>
    <li>Nyeri mata persisten</li>
    <li>Mata merah dan berair terus-menerus</li>
    <li>Perubahan penglihatan warna</li>
</ul>

<h2>Tips Perawatan Harian</h2>
<ul>
    <li>Bersihkan kacamata/lensa kontak rutin</li>
    <li>Jangan tidur dengan lensa kontak</li>
    <li>Gunakan kacamata hitam saat di luar (UV protection)</li>
    <li>Cukupi kebutuhan cairan</li>
    <li>Hindari mengucek mata</li>
</ul>

<p>Pemeriksaan mata rutin setiap 1-2 tahun sangat penting, terutama jika bekerja dengan komputer. Deteksi dini masalah mata dapat mencegah kerusakan permanen!</p>',
                'category' => 'Hidup Sehat',
                'category_color' => 'green',
                'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&h=500&fit=crop',
                'read_time' => '7 min read',
                'published_at' => '3 minggu lalu',
                'author' => 'Dr. Rina Oftalmologi',
            ],
            
            // Article 11
            [
                'id' => 11,
                'slug' => 'detoksifikasi-tubuh-secara-alami-dan-aman',
                'title' => 'Detoksifikasi Tubuh Secara Alami dan Aman',
                'excerpt' => 'Tubuh memiliki sistem detoks alami. Pelajari cara mendukung proses detoksifikasi tubuh tanpa diet ekstrem atau produk mahal.',
                'quote' => 'Detoks terbaik dimulai dari dapur, bukan apotek.',
                'content' => '<div class="article-quote mb-6 p-4 bg-teal-50 border-l-4 border-teal-500 italic text-gray-700">"Detoks terbaik dimulai dari dapur, bukan apotek."</div>

<h2>Sistem Detoks Alami Tubuh</h2>
<p>Tubuh memiliki organ detoks alami yang bekerja 24/7:</p>
<ul>
    <li><strong>Hati:</strong> Menyaring racun dari darah</li>
    <li><strong>Ginjal:</strong> Mengeluarkan limbah melalui urin</li>
    <li><strong>Paru-paru:</strong> Mengeluarkan CO2</li>
    <li><strong>Kulit:</strong> Berkeringat mengeluarkan toksin</li>
    <li><strong>Usus:</strong> Membuang limbah pencernaan</li>
</ul>

<h2>Tanda Tubuh Perlu Detoks</h2>
<ul>
    <li>Kelelahan kronis</li>
    <li>Masalah pencernaan (sembelit, kembung)</li>
    <li>Kulit kusam dan berjerawat</li>
    <li>Sulit konsentrasi (brain fog)</li>
    <li>Bau badan atau napas tidak sedap</li>
    <li>Sering sakit kepala</li>
</ul>

<h2>Cara Detoks Alami</h2>

<p><strong>1. Hidrasi Optimal</strong></p>
<ul>
    <li>Minum 8-10 gelas air per hari</li>
    <li>Air lemon hangat di pagi hari</li>
    <li>Teh hijau atau herbal</li>
    <li>Hindari minuman manis dan soda</li>
</ul>

<p><strong>2. Makanan Detoks</strong></p>
<ul>
    <li><strong>Sayuran hijau:</strong> Bayam, kale, brokoli (klorofil)</li>
    <li><strong>Bawang putih & bawang bombay:</strong> Sulfur untuk hati</li>
    <li><strong>Bit:</strong> Membersihkan darah</li>
    <li><strong>Lemon:</strong> Vitamin C dan antioksidan</li>
    <li><strong>Jahe & kunyit:</strong> Anti-inflamasi</li>
</ul>

<p><strong>3. Puasa Intermittent</strong></p>
<ul>
    <li>16:8 (puasa 16 jam, makan 8 jam)</li>
    <li>Memberi istirahat sistem pencernaan</li>
    <li>Meningkatkan autophagy (pembersihan sel)</li>
</ul>

<p><strong>4. Olahraga Teratur</strong></p>
<ul>
    <li>Berkeringat mengeluarkan toksin</li>
    <li>30-60 menit cardio</li>
    <li>Yoga untuk sirkulasi limfatik</li>
    <li>Sauna atau steam bath</li>
</ul>

<p><strong>5. Tidur Berkualitas</strong></p>
<ul>
    <li>7-9 jam per malam</li>
    <li>Otak membersihkan toksin saat tidur</li>
    <li>Tidur konsisten jam yang sama</li>
</ul>

<h2>Hindari Toksin</h2>
<ul>
    <li><strong>Makanan olahan:</strong> Pengawet, pewarna, MSG</li>
    <li><strong>Alkohol berlebihan:</strong> Membebani hati</li>
    <li><strong>Merokok:</strong> Racun masuk paru-paru</li>
    <li><strong>Plastik:</strong> BPA dalam botol dan wadah</li>
    <li><strong>Pestisida:</strong> Pilih organik jika memungkinkan</li>
</ul>

<h2>Jus Detoks Sederhana</h2>
<p><strong>Green Juice:</strong></p>
<ul>
    <li>2 genggam bayam</li>
    <li>1 mentimun</li>
    <li>1 apel hijau</li>
    <li>½ lemon</li>
    <li>Jahe secukupnya</li>
</ul>

<p><strong>Beet Detox:</strong></p>
<ul>
    <li>1 bit merah</li>
    <li>2 wortel</li>
    <li>1 apel</li>
    <li>½ lemon</li>
</ul>

<h2>Mitos Detoks</h2>
<ul>
    <li><strong>Mitos:</strong> Diet jus selama seminggu mendetoks total</li>
    <li><strong>Fakta:</strong> Tubuh detoks setiap hari, tidak perlu ekstrem</li>
    <li><strong>Mitos:</strong> Suplemen detoks mahal diperlukan</li>
    <li><strong>Fakta:</strong> Makanan alami lebih efektif dan aman</li>
</ul>

<p>Detoks adalah gaya hidup, bukan diet sesaat. Konsisten dengan kebiasaan sehat lebih efektif daripada program detoks ekstrem!</p>',
                'category' => 'Hidup Sehat',
                'category_color' => 'green',
                'image' => 'https://images.unsplash.com/photo-1610970881699-44a5587cabec?w=800&h=500&fit=crop',
                'read_time' => '8 min read',
                'published_at' => '1 bulan lalu',
                'author' => 'Dr. Andi Nutrisionis',
            ],
            
            // Article 12
            [
                'id' => 12,
                'slug' => 'manajemen-nyeri-punggung-untuk-pekerja-kantoran',
                'title' => 'Manajemen Nyeri Punggung untuk Pekerja Kantoran',
                'excerpt' => 'Nyeri punggung adalah keluhan umum pekerja kantoran. Temukan cara efektif mencegah dan mengatasi nyeri punggung akibat duduk lama.',
                'quote' => 'Postur yang baik adalah investasi kesehatan jangka panjang.',
                'content' => '<div class="article-quote mb-6 p-4 bg-orange-50 border-l-4 border-orange-500 italic text-gray-700">"Postur yang baik adalah investasi kesehatan jangka panjang."</div>

<h2>Penyebab Nyeri Punggung</h2>
<p>80% pekerja kantoran mengalami nyeri punggung karena:</p>
<ul>
    <li>Duduk berkepanjangan (8+ jam)</li>
    <li>Postur buruk saat bekerja</li>
    <li>Kursi dan meja tidak ergonomis</li>
    <li>Kurang gerak dan olahraga</li>
    <li>Stres dan tegang otot</li>
    <li>Berat badan berlebih</li>
</ul>

<h2>Setup Workstation Ergonomis</h2>

<p><strong>Kursi:</strong></p>
<ul>
    <li>Punggung tegak tersandar dengan baik</li>
    <li>Kaki menapak rata di lantai</li>
    <li>Lutut 90 derajat</li>
    <li>Lumbar support untuk punggung bawah</li>
</ul>

<p><strong>Meja & Monitor:</strong></p>
<ul>
    <li>Monitor sejajar mata (jarak 50-70 cm)</li>
    <li>Keyboard dan mouse dalam jangkauan</li>
    <li>Siku 90 derajat saat mengetik</li>
    <li>Pergelangan tangan netral</li>
</ul>

<h2>Latihan Peregangan di Kantor</h2>

<p><strong>1. Cat-Cow Stretch (di kursi):</strong></p>
<ul>
    <li>Duduk tegak, tangan di lutut</li>
    <li>Lengkungkan punggung (cow), tahan 5 detik</li>
    <li>Bungkukkan punggung (cat), tahan 5 detik</li>
    <li>Ulangi 5-10 kali</li>
</ul>

<p><strong>2. Seated Spinal Twist:</strong></p>
<ul>
    <li>Duduk tegak, kaki menapak</li>
    <li>Putar torso ke kanan, tangan di sandaran</li>
    <li>Tahan 15-30 detik, ulangi sisi lain</li>
</ul>

<p><strong>3. Shoulder Blade Squeeze:</strong></p>
<ul>
    <li>Tarik bahu ke belakang</li>
    <li>Rapatkan tulang belikat</li>
    <li>Tahan 5 detik, lepas</li>
    <li>Ulangi 10-15 kali</li>
</ul>

<p><strong>4. Chest Opener:</strong></p>
<ul>
    <li>Berdiri, tangan di belakang punggung</li>
    <li>Rapatkan jari, angkat lengan</li>
    <li>Buka dada, tahan 15-30 detik</li>
</ul>

<h2>Olahraga untuk Punggung Sehat</h2>
<ul>
    <li><strong>Swimming:</strong> Low-impact, memperkuat core</li>
    <li><strong>Yoga:</strong> Fleksibilitas dan kekuatan</li>
    <li><strong>Pilates:</strong> Core stability</li>
    <li><strong>Walking:</strong> 30 menit per hari</li>
    <li><strong>Planking:</strong> Penguatan otot inti</li>
</ul>

<h2>Tips Harian</h2>
<ul>
    <li><strong>Pomodoro Technique:</strong> Berdiri tiap 25-30 menit</li>
    <li><strong>Walking meeting:</strong> Diskusi sambil jalan</li>
    <li><strong>Tangga vs lift:</strong> Pilih tangga</li>
    <li><strong>Desk exercises:</strong> Peregangan 5 menit/2 jam</li>
    <li><strong>Proper lifting:</strong> Tekuk lutut, bukan punggung</li>
</ul>

<h2>Terapi Nyeri Punggung</h2>
<p><strong>Akut (kurang dari 4 minggu):</strong></p>
<ul>
    <li>Kompres dingin 15-20 menit (48 jam pertama)</li>
    <li>Kompres hangat setelah 48 jam</li>
    <li>Tetap aktif, hindari bed rest lama</li>
    <li>Pain reliever jika perlu (konsultasi dokter)</li>
</ul>

<p><strong>Kronis (lebih dari 3 bulan):</strong></p>
<ul>
    <li>Fisioterapi teratur</li>
    <li>Massage therapy</li>
    <li>Akupuntur</li>
    <li>Latihan kekuatan core</li>
</ul>

<h2>Kapan ke Dokter?</h2>
<ul>
    <li>Nyeri hebat tidak membaik 1-2 minggu</li>
    <li>Menjalar ke kaki (sciatica)</li>
    <li>Mati rasa atau kesemutan</li>
    <li>Kelemahan otot kaki</li>
    <li>Gangguan BAK/BAB</li>
    <li>Demam atau penurunan berat badan</li>
</ul>

<p>Pencegahan lebih baik daripada pengobatan. Investasi di kursi ergonomis dan kebiasaan sehat akan menghemat biaya medis di masa depan!</p>',
                'category' => 'Hidup Sehat',
                'category_color' => 'green',
                'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=800&h=500&fit=crop',
                'read_time' => '9 min read',
                'published_at' => '1 bulan lalu',
                'author' => 'Dr. Hendra Ortopedi',
            ],

            // Article 13
            [
                'id' => 13,
                'slug' => 'panduan-lengkap-diet-mediterania-untuk-jantung-sehat',
                'title' => 'Panduan Lengkap Diet Mediterania untuk Jantung Sehat',
                'excerpt' => 'Diet Mediterania telah terbukti secara ilmiah sebagai salah satu pola makan terbaik untuk kesehatan jantung dan umur panjang.',
                'content' => '<p>Diet Mediterania bukan sekadar diet, melainkan gaya hidup sehat yang telah terbukti menurunkan risiko penyakit jantung hingga 30%. Pola makan ini berasal dari negara-negara di sekitar Laut Mediterania seperti Italia, Yunani, dan Spanyol.</p>

<h2>Prinsip Utama Diet Mediterania</h2>
<p><strong>Makanan Utama:</strong></p>
<ul>
    <li>Sayuran dan buah-buahan segar (5-9 porsi/hari)</li>
    <li>Biji-bijian utuh (whole grains)</li>
    <li>Minyak zaitun sebagai lemak utama</li>
    <li>Kacang-kacangan dan biji-bijian</li>
    <li>Ikan dan seafood (2-3x seminggu)</li>
</ul>

<p><strong>Konsumsi Sedang:</strong></p>
<ul>
    <li>Unggas (ayam, kalkun)</li>
    <li>Telur (3-4 butir/minggu)</li>
    <li>Keju dan yogurt</li>
    <li>Wine merah (opsional, 1 gelas/hari)</li>
</ul>

<p><strong>Batasi:</strong></p>
<ul>
    <li>Daging merah (1-2x per bulan)</li>
    <li>Makanan olahan dan fast food</li>
    <li>Gula tambahan</li>
    <li>Mentega dan margarin</li>
</ul>

<h2>Menu Harian Diet Mediterania</h2>
<p><strong>Sarapan:</strong> Oatmeal dengan buah beri, kacang almond, dan madu</p>
<p><strong>Snack Pagi:</strong> Yogurt Greek dengan walnut</p>
<p><strong>Makan Siang:</strong> Salad quinoa dengan sayuran panggang, olive, dan feta cheese</p>
<p><strong>Snack Sore:</strong> Hummus dengan wortel dan mentimun</p>
<p><strong>Makan Malam:</strong> Ikan salmon panggang dengan brokoli dan sweet potato</p>

<h2>Manfaat Kesehatan</h2>
<ul>
    <li>Menurunkan risiko penyakit jantung 30%</li>
    <li>Mengurangi stroke hingga 25%</li>
    <li>Mencegah diabetes tipe 2</li>
    <li>Meningkatkan fungsi kognitif</li>
    <li>Menurunkan tekanan darah</li>
    <li>Anti-inflamasi alami</li>
</ul>

<p>Penelitian menunjukkan bahwa orang yang mengikuti diet Mediterania memiliki umur lebih panjang dan kualitas hidup lebih baik!</p>',
                'category' => 'Nutrisi',
                'category_color' => 'yellow',
                'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800&h=500&fit=crop',
                'read_time' => '8 min read',
                'published_at' => '3 hari lalu',
                'author' => 'Dr. Maria Nutrisi',
            ],

            // Article 14
            [
                'id' => 14,
                'slug' => 'terapi-musik-untuk-kesehatan-mental-dan-relaksasi',
                'title' => 'Terapi Musik untuk Kesehatan Mental dan Relaksasi',
                'excerpt' => 'Musik memiliki kekuatan luar biasa untuk menyembuhkan jiwa, mengurangi stres, dan meningkatkan kesehatan mental secara keseluruhan.',
                'content' => '<p>Terapi musik adalah pendekatan terapeutik yang menggunakan musik untuk meningkatkan kesehatan fisik, emosional, kognitif, dan sosial. Penelitian menunjukkan bahwa musik dapat mengubah struktur otak dan meningkatkan produksi hormon bahagia.</p>

<h2>Manfaat Terapi Musik</h2>
<p><strong>Kesehatan Mental:</strong></p>
<ul>
    <li>Mengurangi gejala depresi dan kecemasan</li>
    <li>Meningkatkan mood dan emosi positif</li>
    <li>Membantu mengatasi trauma</li>
    <li>Meningkatkan self-esteem</li>
    <li>Mengurangi stres hingga 65%</li>
</ul>

<p><strong>Kesehatan Fisik:</strong></p>
<ul>
    <li>Menurunkan tekanan darah</li>
    <li>Mengurangi detak jantung</li>
    <li>Meningkatkan sistem imun</li>
    <li>Mengurangi nyeri kronis</li>
    <li>Meningkatkan kualitas tidur</li>
</ul>

<h2>Jenis Musik untuk Terapi</h2>
<p><strong>Musik Klasik:</strong> Mozart, Beethoven - Meningkatkan konsentrasi dan kreativitas</p>
<p><strong>Musik Nature Sounds:</strong> Suara ombak, hujan - Relaksasi mendalam</p>
<p><strong>Binaural Beats:</strong> Frekuensi khusus - Meditasi dan fokus</p>
<p><strong>Musik Instrumental:</strong> Piano, gitar - Mengurangi kecemasan</p>

<h2>Cara Melakukan Terapi Musik</h2>
<ul>
    <li>Dengarkan musik 20-30 menit setiap hari</li>
    <li>Pilih musik sesuai kebutuhan emosional</li>
    <li>Gunakan headphone untuk pengalaman immersive</li>
    <li>Kombinasikan dengan meditasi atau yoga</li>
    <li>Buat playlist terapi pribadi</li>
    <li>Mainkan alat musik (lebih efektif)</li>
</ul>

<h2>Waktu Terbaik</h2>
<p><strong>Pagi:</strong> Musik energik untuk motivasi</p>
<p><strong>Siang:</strong> Musik instrumental untuk produktivitas</p>
<p><strong>Sore:</strong> Musik tenang untuk transisi</p>
<p><strong>Malam:</strong> Musik relaksasi untuk tidur berkualitas</p>

<p>Terapi musik adalah cara alami, tanpa efek samping, dan menyenangkan untuk meningkatkan kesehatan mental Anda!</p>',
                'category' => 'Kesehatan Mental',
                'category_color' => 'purple',
                'image' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=800&h=500&fit=crop',
                'read_time' => '7 min read',
                'published_at' => '5 hari lalu',
                'author' => 'Dr. Rina Psikolog',
            ],

            // Article 15
            [
                'id' => 15,
                'slug' => 'manfaat-puasa-intermittent-untuk-kesehatan-dan-berat-badan',
                'title' => 'Manfaat Puasa Intermittent untuk Kesehatan dan Berat Badan',
                'excerpt' => 'Intermittent fasting bukan hanya untuk menurunkan berat badan, tapi juga meningkatkan metabolisme dan memperpanjang umur.',
                'content' => '<p>Intermittent fasting (IF) adalah pola makan yang mengatur waktu makan dan puasa, bukan membatasi jenis makanan. Metode ini terbukti efektif untuk penurunan berat badan dan peningkatan kesehatan metabolik.</p>

<h2>Metode Intermittent Fasting</h2>
<p><strong>16/8 Method (Paling Populer):</strong></p>
<ul>
    <li>Puasa 16 jam, makan 8 jam</li>
    <li>Contoh: Makan jam 12 siang - 8 malam</li>
    <li>Cocok untuk pemula</li>
</ul>

<p><strong>5:2 Diet:</strong></p>
<ul>
    <li>5 hari normal, 2 hari kalori rendah (500-600 kal)</li>
    <li>Fleksibel untuk jadwal sibuk</li>
</ul>

<p><strong>Eat-Stop-Eat:</strong></p>
<ul>
    <li>Puasa 24 jam, 1-2x seminggu</li>
    <li>Untuk yang sudah berpengalaman</li>
</ul>

<p><strong>Alternate Day Fasting:</strong></p>
<ul>
    <li>Puasa dan makan bergantian setiap hari</li>
    <li>Paling intens</li>
</ul>

<h2>Manfaat Kesehatan</h2>
<ul>
    <li><strong>Penurunan Berat Badan:</strong> 3-8% dalam 3-24 minggu</li>
    <li><strong>Metabolisme:</strong> Meningkat 3.6-14%</li>
    <li><strong>Insulin Sensitivity:</strong> Meningkat hingga 31%</li>
    <li><strong>Autophagy:</strong> Pembersihan sel rusak</li>
    <li><strong>Anti-aging:</strong> Memperpanjang umur sel</li>
    <li><strong>Brain Health:</strong> Meningkatkan BDNF</li>
    <li><strong>Inflamasi:</strong> Berkurang signifikan</li>
</ul>

<h2>Apa yang Boleh Dikonsumsi Saat Puasa?</h2>
<p><strong>Diperbolehkan:</strong></p>
<ul>
    <li>Air putih (unlimited)</li>
    <li>Kopi hitam (tanpa gula/susu)</li>
    <li>Teh hijau/herbal</li>
    <li>Air lemon (tanpa gula)</li>
</ul>

<p><strong>Hindari:</strong></p>
<ul>
    <li>Minuman manis</li>
    <li>Susu</li>
    <li>Jus buah</li>
    <li>Makanan padat apapun</li>
</ul>

<h2>Menu Berbuka Puasa IF</h2>
<p><strong>Meal 1 (Berbuka):</strong></p>
<ul>
    <li>Protein tinggi: Telur, dada ayam, ikan</li>
    <li>Sayuran hijau</li>
    <li>Lemak sehat: Alpukat, kacang</li>
</ul>

<p><strong>Meal 2 (Sebelum Mulai Puasa):</strong></p>
<ul>
    <li>Karbohidrat kompleks: Nasi merah, quinoa</li>
    <li>Protein</li>
    <li>Sayuran</li>
</ul>

<h2>Tips Sukses IF</h2>
<ul>
    <li>Mulai bertahap (12 jam dulu)</li>
    <li>Minum banyak air saat puasa</li>
    <li>Tetap aktif tapi jangan overexercise</li>
    <li>Fokus pada kualitas makanan</li>
    <li>Dengarkan tubuh Anda</li>
    <li>Konsisten minimal 2-4 minggu</li>
</ul>

<h2>Siapa yang Tidak Boleh IF?</h2>
<ul>
    <li>Ibu hamil dan menyusui</li>
    <li>Anak-anak dan remaja</li>
    <li>Diabetes tipe 1</li>
    <li>Riwayat eating disorder</li>
    <li>Underweight (BMI &lt; 18.5)</li>
</ul>

<p>Konsultasikan dengan dokter sebelum memulai, terutama jika memiliki kondisi medis tertentu!</p>',
                'category' => 'Nutrisi',
                'category_color' => 'yellow',
                'image' => 'https://images.unsplash.com/photo-1495521821757-a1efb6729352?w=800&h=500&fit=crop',
                'read_time' => '10 min read',
                'published_at' => '1 minggu lalu',
                'author' => 'Dr. Ahmad Gizi',
            ],

            // Article 16
            [
                'id' => 16,
                'slug' => 'olahraga-hiit-untuk-membakar-lemak-maksimal',
                'title' => 'Olahraga HIIT untuk Membakar Lemak Maksimal',
                'excerpt' => 'High Intensity Interval Training (HIIT) adalah cara paling efisien membakar lemak dalam waktu singkat dengan hasil maksimal.',
                'content' => '<p>HIIT (High-Intensity Interval Training) adalah metode latihan yang menggabungkan periode latihan intensitas tinggi dengan periode istirahat singkat. Hanya 20-30 menit HIIT setara dengan 60 menit cardio biasa!</p>

<h2>Apa itu HIIT?</h2>
<p>HIIT adalah latihan interval yang bergantian antara burst intensitas maksimal (80-95% HR max) dengan periode recovery singkat. Contoh: Sprint 30 detik, jalan 30 detik, ulangi 10x.</p>

<h2>Manfaat HIIT</h2>
<ul>
    <li><strong>Pembakaran Kalori:</strong> 25-30% lebih banyak dari latihan biasa</li>
    <li><strong>Afterburn Effect:</strong> Bakar kalori hingga 24 jam setelah latihan</li>
    <li><strong>Metabolisme:</strong> Meningkat hingga 48 jam</li>
    <li><strong>Lemak Perut:</strong> Berkurang signifikan</li>
    <li><strong>Muscle Gain:</strong> Mempertahankan massa otot</li>
    <li><strong>Efisiensi Waktu:</strong> 20 menit = 60 menit cardio</li>
    <li><strong>VO2 Max:</strong> Meningkatkan kapasitas aerobik</li>
</ul>

<h2>Contoh Latihan HIIT untuk Pemula</h2>
<p><strong>HIIT Running (20 menit):</strong></p>
<ul>
    <li>Warm-up: Jalan cepat 5 menit</li>
    <li>Sprint 30 detik (90% effort)</li>
    <li>Jalan 60 detik (recovery)</li>
    <li>Ulangi 8-10 kali</li>
    <li>Cool-down: Jalan santai 5 menit</li>
</ul>

<p><strong>HIIT Bodyweight (15 menit):</strong></p>
<ul>
    <li>Burpees - 40 detik ON, 20 detik OFF</li>
    <li>Mountain climbers - 40 detik ON, 20 detik OFF</li>
    <li>Jump squats - 40 detik ON, 20 detik OFF</li>
    <li>High knees - 40 detik ON, 20 detik OFF</li>
    <li>Ulangi 3 rounds</li>
</ul>

<p><strong>HIIT Tabata (4 menit):</strong></p>
<ul>
    <li>Pilih 1 gerakan (contoh: burpees)</li>
    <li>20 detik all-out effort</li>
    <li>10 detik rest</li>
    <li>Ulangi 8 rounds (total 4 menit)</li>
</ul>

<h2>Program HIIT 4 Minggu</h2>
<p><strong>Week 1-2:</strong> 2x seminggu, 15-20 menit</p>
<p><strong>Week 3-4:</strong> 3x seminggu, 20-25 menit</p>
<p><strong>Week 5+:</strong> 3-4x seminggu, 25-30 menit</p>

<h2>Tips Maksimalkan HIIT</h2>
<ul>
    <li>Warm-up wajib 5-10 menit</li>
    <li>Intensitas interval harus 80-95% HR max</li>
    <li>Recovery aktif, jangan berhenti total</li>
    <li>Fokus pada form yang benar</li>
    <li>Hidrasi sebelum, saat, dan sesudah</li>
    <li>Rest day 48 jam antara session</li>
    <li>Kombinasikan dengan strength training</li>
</ul>

<h2>Kesalahan Umum</h2>
<ul>
    <li>Terlalu sering (daily) - risiko overtraining</li>
    <li>Intensitas kurang - bukan HIIT sejati</li>
    <li>Durasi terlalu lama - bukan interval</li>
    <li>Skip warm-up - risiko cedera</li>
    <li>Form buruk - tidak efektif</li>
</ul>

<h2>Siapa yang Cocok HIIT?</h2>
<p><strong>Cocok untuk:</strong></p>
<ul>
    <li>Yang ingin fat loss cepat</li>
    <li>Jadwal padat, waktu terbatas</li>
    <li>Plateau weight loss</li>
    <li>Fitness level intermediate-advanced</li>
</ul>

<p><strong>Hindari jika:</strong></p>
<ul>
    <li>Baru mulai olahraga (mulai dari LISS dulu)</li>
    <li>Masalah jantung</li>
    <li>Cedera sendi/otot</li>
    <li>Pregnant</li>
</ul>

<p>Konsultasi dokter dulu jika ada kondisi medis sebelum mulai HIIT!</p>',
                'category' => 'Olahraga',
                'category_color' => 'blue',
                'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=800&h=500&fit=crop',
                'read_time' => '9 min read',
                'published_at' => '1 minggu lalu',
                'author' => 'Coach Budi Fitness',
            ],

            // Article 17
            [
                'id' => 17,
                'slug' => 'makanan-penurun-kolesterol-tinggi-secara-alami',
                'title' => 'Makanan Penurun Kolesterol Tinggi Secara Alami',
                'excerpt' => 'Turunkan kolesterol jahat (LDL) dan tingkatkan kolesterol baik (HDL) dengan makanan alami tanpa obat-obatan.',
                'content' => '<p>Kolesterol tinggi adalah silent killer yang meningkatkan risiko serangan jantung dan stroke. Kabar baiknya, Anda bisa menurunkan kolesterol LDL hingga 30% dengan perubahan pola makan!</p>

<h2>Makanan Penurun Kolesterol</h2>
<p><strong>1. Oatmeal dan Serat Larut</strong></p>
<ul>
    <li>Mengandung beta-glucan</li>
    <li>Menurunkan LDL 5-10%</li>
    <li>1-2 mangkuk per hari</li>
    <li>Tambahkan buah beri untuk antioksidan</li>
</ul>

<p><strong>2. Kacang-kacangan</strong></p>
<ul>
    <li>Almond, walnut, pistachio</li>
    <li>Kaya lemak tak jenuh tunggal</li>
    <li>30-45 gram per hari</li>
    <li>Menurunkan LDL hingga 5%</li>
</ul>

<p><strong>3. Ikan Berlemak</strong></p>
<ul>
    <li>Salmon, makarel, sarden</li>
    <li>Omega-3 EPA dan DHA</li>
    <li>2-3 porsi per minggu</li>
    <li>Meningkatkan HDL (kolesterol baik)</li>
</ul>

<p><strong>4. Alpukat</strong></p>
<ul>
    <li>Lemak sehat monounsaturated</li>
    <li>1/2 - 1 buah per hari</li>
    <li>Menurunkan LDL 10-15%</li>
    <li>Meningkatkan HDL</li>
</ul>

<p><strong>5. Minyak Zaitun Extra Virgin</strong></p>
<ul>
    <li>Antioksidan kuat</li>
    <li>2-3 sendok makan per hari</li>
    <li>Gunakan untuk salad dan masakan</li>
</ul>

<p><strong>6. Bawang Putih</strong></p>
<ul>
    <li>Allicin menurunkan kolesterol</li>
    <li>2-3 siung per hari</li>
    <li>Konsumsi mentah lebih efektif</li>
</ul>

<p><strong>7. Teh Hijau</strong></p>
<ul>
    <li>Catechin sebagai antioksidan</li>
    <li>3-4 cangkir per hari</li>
    <li>Menurunkan LDL hingga 5%</li>
</ul>

<p><strong>8. Dark Chocolate (70%+ cocoa)</strong></p>
<ul>
    <li>Flavonoid kuat</li>
    <li>20-30 gram per hari</li>
    <li>Pilih yang minim gula</li>
</ul>

<p><strong>9. Buah-buahan Tinggi Serat</strong></p>
<ul>
    <li>Apel, pir, jeruk, stroberi</li>
    <li>Pectin menurunkan LDL</li>
    <li>2-3 porsi per hari</li>
</ul>

<p><strong>10. Kedelai dan Produknya</strong></p>
<ul>
    <li>Tempe, tahu, edamame</li>
    <li>Protein nabati pengganti daging</li>
    <li>25 gram protein kedelai per hari</li>
</ul>

<h2>Makanan yang Harus Dihindari</h2>
<ul>
    <li><strong>Trans Fat:</strong> Gorengan, margarin, pastry</li>
    <li><strong>Saturated Fat:</strong> Daging berlemak, mentega, santan kental</li>
    <li><strong>Kolesterol Tinggi:</strong> Jeroan, kuning telur berlebih, seafood tertentu</li>
    <li><strong>Gula Berlebih:</strong> Meningkatkan trigliserida</li>
    <li><strong>Fast Food:</strong> Burger, pizza, fried chicken</li>
</ul>

<h2>Menu Harian Anti-Kolesterol</h2>
<p><strong>Sarapan:</strong> Oatmeal + blueberry + walnut + teh hijau</p>
<p><strong>Snack:</strong> Apel + almond</p>
<p><strong>Makan Siang:</strong> Salmon panggang + quinoa + brokoli + salad</p>
<p><strong>Snack:</strong> Edamame</p>
<p><strong>Makan Malam:</strong> Tahu bakar + sayur bayam + nasi merah</p>

<h2>Tips Tambahan</h2>
<ul>
    <li>Olahraga 30 menit 5x seminggu</li>
    <li>Hindari rokok dan alkohol berlebih</li>
    <li>Jaga berat badan ideal</li>
    <li>Kelola stres dengan baik</li>
    <li>Cek kolesterol rutin setiap 3-6 bulan</li>
</ul>

<h2>Target Kolesterol Sehat</h2>
<ul>
    <li>Total Cholesterol: &lt; 200 mg/dL</li>
    <li>LDL (jahat): &lt; 100 mg/dL</li>
    <li>HDL (baik): &gt; 60 mg/dL</li>
    <li>Trigliserida: &lt; 150 mg/dL</li>
</ul>

<p>Perubahan pola makan bisa menurunkan kolesterol dalam 4-6 minggu. Konsistensi adalah kunci!</p>',
                'category' => 'Nutrisi',
                'category_color' => 'yellow',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&h=500&fit=crop',
                'read_time' => '8 min read',
                'published_at' => '2 minggu lalu',
                'author' => 'Dr. Siti Kardiologi',
            ],

            // Article 18
            [
                'id' => 18,
                'slug' => 'cara-mengatasi-insomnia-dan-gangguan-tidur',
                'title' => 'Cara Mengatasi Insomnia dan Gangguan Tidur',
                'excerpt' => 'Tidur berkualitas adalah fondasi kesehatan. Pelajari cara mengatasi insomnia dan gangguan tidur secara alami dan efektif.',
                'content' => '<p>Insomnia mempengaruhi 30% populasi dewasa. Kurang tidur kronis meningkatkan risiko obesitas, diabetes, penyakit jantung, dan depresi. Tidur berkualitas 7-9 jam per malam adalah kebutuhan vital!</p>

<h2>Jenis Gangguan Tidur</h2>
<p><strong>1. Insomnia Akut:</strong> Sulit tidur sementara (kurang dari 3 bulan)</p>
<p><strong>2. Insomnia Kronis:</strong> Gangguan tidur 3+ malam/minggu selama 3+ bulan</p>
<p><strong>3. Sleep Apnea:</strong> Henti napas saat tidur</p>
<p><strong>4. Restless Leg Syndrome:</strong> Dorongan menggerakkan kaki</p>
<p><strong>5. Narcolepsy:</strong> Kantuk berlebihan di siang hari</p>

<h2>Penyebab Insomnia</h2>
<ul>
    <li>Stres dan kecemasan</li>
    <li>Jadwal tidur tidak teratur</li>
    <li>Screen time berlebih</li>
    <li>Kafein dan alkohol</li>
    <li>Lingkungan tidak kondusif</li>
    <li>Kondisi medis tertentu</li>
    <li>Obat-obatan</li>
</ul>

<h2>Sleep Hygiene: Kebiasaan Tidur Sehat</h2>
<p><strong>Jadwal Konsisten:</strong></p>
<ul>
    <li>Tidur dan bangun di waktu yang sama setiap hari</li>
    <li>Termasuk weekend</li>
    <li>Jangan tidur siang lebih dari 20 menit</li>
</ul>

<p><strong>Lingkungan Ideal:</strong></p>
<ul>
    <li>Kamar gelap total (gunakan blackout curtains)</li>
    <li>Suhu sejuk 18-20°C</li>
    <li>Sunyi (gunakan earplugs atau white noise)</li>
    <li>Kasur dan bantal nyaman</li>
    <li>Kamar hanya untuk tidur (bukan kerja)</li>
</ul>

<p><strong>Rutinitas Sebelum Tidur:</strong></p>
<ul>
    <li>Mulai 60-90 menit sebelum tidur</li>
    <li>Redupkan lampu</li>
    <li>Mandi air hangat</li>
    <li>Baca buku (bukan gadget)</li>
    <li>Meditasi atau journaling</li>
    <li>Stretching ringan</li>
</ul>

<h2>Teknik Relaksasi untuk Tidur</h2>
<p><strong>1. 4-7-8 Breathing:</strong></p>
<ul>
    <li>Tarik napas 4 hitungan</li>
    <li>Tahan 7 hitungan</li>
    <li>Buang napas 8 hitungan</li>
    <li>Ulangi 4 siklus</li>
</ul>

<p><strong>2. Progressive Muscle Relaxation:</strong></p>
<ul>
    <li>Tegangkan otot kaki 5 detik, lepas</li>
    <li>Lanjut ke otot betis, paha, perut, dst</li>
    <li>Sampai seluruh tubuh rileks</li>
</ul>

<p><strong>3. Guided Imagery:</strong></p>
<ul>
    <li>Bayangkan tempat damai (pantai, gunung)</li>
    <li>Libatkan semua indera</li>
    <li>Fokus pada detail</li>
</ul>

<p><strong>4. Body Scan Meditation:</strong></p>
<ul>
    <li>Perhatikan sensasi dari ujung kaki ke kepala</li>
    <li>Rasakan tanpa menilai</li>
    <li>10-15 menit</li>
</ul>

<h2>Makanan & Minuman untuk Tidur</h2>
<p><strong>Bantu Tidur:</strong></p>
<ul>
    <li>Chamomile tea (1 jam sebelum tidur)</li>
    <li>Susu hangat (tryptophan)</li>
    <li>Pisang (magnesium, potassium)</li>
    <li>Kacang almond (melatonin alami)</li>
    <li>Oatmeal (meningkatkan serotonin)</li>
    <li>Kiwi (2 buah 1 jam sebelum tidur)</li>
</ul>

<p><strong>Hindari:</strong></p>
<ul>
    <li>Kafein setelah jam 2 siang</li>
    <li>Alkohol (mengganggu REM sleep)</li>
    <li>Makanan berat 3 jam sebelum tidur</li>
    <li>Makanan pedas dan asam</li>
    <li>Gula berlebih</li>
</ul>

<h2>Suplemen Tidur Alami</h2>
<ul>
    <li><strong>Melatonin:</strong> 0.5-5mg, 30 menit sebelum tidur</li>
    <li><strong>Magnesium:</strong> 200-400mg (glycinate form terbaik)</li>
    <li><strong>L-Theanine:</strong> 100-200mg (dari teh hijau)</li>
    <li><strong>Valerian Root:</strong> 300-600mg</li>
    <li><strong>Lavender:</strong> Aromaterapi atau oil</li>
</ul>

<h2>Screen Time dan Blue Light</h2>
<ul>
    <li>Stop gadget 2 jam sebelum tidur</li>
    <li>Gunakan blue light filter (Night Shift/Night Mode)</li>
    <li>Blue light blocking glasses</li>
    <li>Ganti TV/scrolling dengan baca buku</li>
</ul>

<h2>Kapan Harus ke Dokter?</h2>
<ul>
    <li>Insomnia lebih dari 3 bulan</li>
    <li>Kantuk berlebih mengganggu aktivitas</li>
    <li>Mendengkur keras dengan henti napas</li>
    <li>Kaki gelisah setiap malam</li>
    <li>Mimpi buruk berulang</li>
    <li>Mengalami kecelakaan karena kurang tidur</li>
</ul>

<p>Tidur berkualitas adalah investasi kesehatan terbaik. Terapkan sleep hygiene konsisten selama 2-4 minggu untuk hasil optimal!</p>',
                'category' => 'Kesehatan Mental',
                'category_color' => 'purple',
                'image' => 'https://images.unsplash.com/photo-1515894203077-9cd36032142f?w=800&h=500&fit=crop',
                'read_time' => '10 min read',
                'published_at' => '2 minggu lalu',
                'author' => 'Dr. Lisa Sleep Specialist',
            ],

            // Article 19
            [
                'id' => 19,
                'slug' => 'rahasia-kulit-glowing-dengan-perawatan-alami',
                'title' => 'Rahasia Kulit Glowing dengan Perawatan Alami',
                'excerpt' => 'Dapatkan kulit bercahaya, sehat, dan awet muda dengan bahan alami tanpa harus ke klinik kecantikan mahal.',
                'content' => '<p>Kulit glowing bukan hanya tentang skincare mahal. 70% kesehatan kulit ditentukan oleh apa yang Anda konsumsi dan gaya hidup. Berikut rahasia kulit bercahaya dari dalam!</p>

<h2>Prinsip Dasar Kulit Sehat</h2>
<p><strong>Triangle of Glowing Skin:</strong></p>
<ul>
    <li>Nutrisi yang tepat (40%)</li>
    <li>Skincare konsisten (30%)</li>
    <li>Lifestyle sehat (30%)</li>
</ul>

<h2>Makanan untuk Kulit Glowing</h2>
<p><strong>1. Antioksidan Tinggi:</strong></p>
<ul>
    <li>Blueberry, stroberi (vitamin C)</li>
    <li>Dark chocolate 70%+ (flavonoid)</li>
    <li>Teh hijau (EGCG)</li>
    <li>Tomat (lycopene)</li>
</ul>

<p><strong>2. Lemak Sehat:</strong></p>
<ul>
    <li>Salmon (omega-3)</li>
    <li>Alpukat (vitamin E)</li>
    <li>Kacang walnut</li>
    <li>Minyak zaitun</li>
</ul>

<p><strong>3. Vitamin C Booster:</strong></p>
<ul>
    <li>Jeruk, lemon</li>
    <li>Paprika merah</li>
    <li>Kiwi</li>
    <li>Brokoli</li>
</ul>

<p><strong>4. Kolagen Natural:</strong></p>
<ul>
    <li>Bone broth</li>
    <li>Telur</li>
    <li>Ikan</li>
    <li>Vitamin C untuk sintesis kolagen</li>
</ul>

<p><strong>5. Hidrasi Internal:</strong></p>
<ul>
    <li>Air putih 2-3 liter/hari</li>
    <li>Infused water (lemon, mint, timun)</li>
    <li>Coconut water</li>
    <li>Buah tinggi air (semangka, melon)</li>
</ul>

<h2>Skincare Routine Alami</h2>
<p><strong>Morning Routine:</strong></p>
<ul>
    <li>Cleanser ringan</li>
    <li>Toner (rose water/green tea)</li>
    <li>Vitamin C serum (DIY: lemon + vit C powder)</li>
    <li>Moisturizer (aloe vera gel)</li>
    <li>Sunscreen SPF 30+ (wajib!)</li>
</ul>

<p><strong>Night Routine:</strong></p>
<ul>
    <li>Double cleansing (oil + water based)</li>
    <li>Exfoliate 2-3x seminggu (oatmeal scrub)</li>
    <li>Toner</li>
    <li>Serum (vitamin E, rosehip oil)</li>
    <li>Night cream atau sleeping mask (honey mask)</li>
</ul>

<h2>DIY Face Mask Alami</h2>
<p><strong>1. Brightening Mask:</strong></p>
<ul>
    <li>1 sdm yogurt + 1 sdt madu + 1 sdt lemon</li>
    <li>Apply 15 menit, 2x seminggu</li>
</ul>

<p><strong>2. Hydrating Mask:</strong></p>
<ul>
    <li>1 sdm aloe vera gel + 1 sdt honey + 1 sdt minyak zaitun</li>
    <li>Apply 20 menit</li>
</ul>

<p><strong>3. Anti-Aging Mask:</strong></p>
<ul>
    <li>1 putih telur + 1 sdt madu + beberapa tetes lemon</li>
    <li>Apply hingga kering, bilas</li>
</ul>

<p><strong>4. Acne-Fighting Mask:</strong></p>
<ul>
    <li>1 sdm clay mask + tea tree oil</li>
    <li>Apply 10-15 menit</li>
</ul>

<h2>Lifestyle untuk Kulit Sehat</h2>
<p><strong>1. Tidur Berkualitas:</strong></p>
<ul>
    <li>7-9 jam per malam</li>
    <li>Tidur sebelum jam 11 malam</li>
    <li>Silk pillowcase (mengurangi wrinkles)</li>
    <li>Sleep on back (anti aging)</li>
</ul>

<p><strong>2. Olahraga Teratur:</strong></p>
<ul>
    <li>30 menit 4-5x seminggu</li>
    <li>Meningkatkan sirkulasi darah</li>
    <li>Detoksifikasi melalui keringat</li>
    <li>Glow alami dari dalam</li>
</ul>

<p><strong>3. Stress Management:</strong></p>
<ul>
    <li>Meditasi 10-15 menit/hari</li>
    <li>Yoga</li>
    <li>Deep breathing</li>
    <li>Cortisol tinggi = jerawat & penuaan dini</li>
</ul>

<p><strong>4. Sun Protection:</strong></p>
<ul>
    <li>Sunscreen every day (bahkan cloudy/indoor)</li>
    <li>Reapply setiap 2-3 jam</li>
    <li>Topi & kacamata hitam</li>
    <li>Hindari matahari 10 AM - 4 PM</li>
</ul>

<h2>Kebiasaan yang Merusak Kulit</h2>
<ul>
    <li>Merokok (penuaan dini)</li>
    <li>Alkohol berlebih (dehidrasi)</li>
    <li>Gula tinggi (glycation = wrinkles)</li>
    <li>Kurang tidur (dark circles, dull skin)</li>
    <li>Stress kronis (jerawat, eksim)</li>
    <li>Jarang ganti sarung bantal (bakteri)</li>
    <li>Touch face too often (bakteri)</li>
</ul>

<h2>Suplemen untuk Kulit</h2>
<ul>
    <li><strong>Kolagen:</strong> 5-10 gram/hari</li>
    <li><strong>Vitamin C:</strong> 1000mg/hari</li>
    <li><strong>Vitamin E:</strong> 400 IU</li>
    <li><strong>Omega-3:</strong> 1000-2000mg</li>
    <li><strong>Biotin:</strong> 2500-5000 mcg</li>
    <li><strong>Zinc:</strong> 15-30mg (anti-acne)</li>
</ul>

<h2>Timeline Hasil</h2>
<ul>
    <li><strong>2 weeks:</strong> Kulit lebih hydrated</li>
    <li><strong>4 weeks:</strong> Tone lebih merata</li>
    <li><strong>8 weeks:</strong> Fine lines berkurang</li>
    <li><strong>12 weeks:</strong> Glow dari dalam terlihat</li>
</ul>

<h2>Tips Extra</h2>
<ul>
    <li>Jangan pop pimples (scar risk)</li>
    <li>Change pillowcase 2x seminggu</li>
    <li>Clean makeup brushes weekly</li>
    <li>Remove makeup every night</li>
    <li>Facial massage 5 menit/hari</li>
    <li>Ice facial (reduce puffiness)</li>
</ul>

<p>Kulit glowing adalah hasil konsistensi jangka panjang, bukan produk instan. Commit to the routine minimal 3 bulan untuk hasil optimal!</p>',
                'category' => 'Kecantikan',
                'category_color' => 'pink',
                'image' => 'https://images.unsplash.com/photo-1552693673-1bf958298935?w=800&h=500&fit=crop',
                'read_time' => '10 min read',
                'published_at' => '3 minggu lalu',
                'author' => 'Dr. Ayu Dermatologi',
            ],

            // Article 20
            [
                'id' => 20,
                'slug' => 'panduan-hidup-sehat-untuk-penderita-asma',
                'title' => 'Panduan Hidup Sehat untuk Penderita Asma',
                'excerpt' => 'Kelola asma dengan baik agar tidak mengganggu aktivitas sehari-hari. Pelajari trigger, pencegahan, dan cara mengatasi serangan asma.',
                'content' => '<p>Asma mempengaruhi 300 juta orang di dunia. Meski tidak bisa disembuhkan total, asma bisa dikontrol dengan baik sehingga penderita bisa hidup normal tanpa serangan yang mengganggu.</p>

<h2>Apa itu Asma?</h2>
<p>Asma adalah penyakit kronis saluran napas yang menyebabkan:</p>
<ul>
    <li>Inflamasi (peradangan) saluran napas</li>
    <li>Penyempitan bronkus</li>
    <li>Produksi lendir berlebih</li>
    <li>Kesulitan bernapas, mengi, batuk</li>
</ul>

<h2>Gejala Asma</h2>
<p><strong>Gejala Umum:</strong></p>
<ul>
    <li>Napas pendek (sesak)</li>
    <li>Mengi (wheezing) - suara "ngik-ngik"</li>
    <li>Batuk, terutama malam/pagi hari</li>
    <li>Dada terasa sesak/tertekan</li>
    <li>Sulit tidur karena sesak napas</li>
</ul>

<p><strong>Tanda Serangan Berat (Emergency):</strong></p>
<ul>
    <li>Napas sangat cepat</li>
    <li>Bibir/kuku membiru</li>
    <li>Tidak bisa bicara lengkap</li>
    <li>Retraksi dada (dada tertarik ke dalam)</li>
    <li>Tidak ada perbaikan setelah inhaler</li>
</ul>

<h2>Pemicu (Trigger) Asma</h2>
<p><strong>Allergen:</strong></p>
<ul>
    <li>Debu rumah & tungau</li>
    <li>Bulu hewan peliharaan</li>
    <li>Serbuk sari (pollen)</li>
    <li>Jamur dan mold</li>
    <li>Kecoa</li>
</ul>

<p><strong>Irritant:</strong></p>
<ul>
    <li>Asap rokok (aktif & pasif)</li>
    <li>Polusi udara</li>
    <li>Parfum/pewangi kuat</li>
    <li>Asap pembakaran</li>
    <li>Chemical cleaners</li>
</ul>

<p><strong>Lainnya:</strong></p>
<ul>
    <li>Olahraga intensitas tinggi (exercise-induced)</li>
    <li>Udara dingin</li>
    <li>Infeksi pernapasan (flu, COVID)</li>
    <li>Stress emosional</li>
    <li>Obat tertentu (aspirin, beta-blocker)</li>
    <li>GERD (asam lambung naik)</li>
</ul>

<h2>Mengelola Lingkungan</h2>
<p><strong>Di Rumah:</strong></p>
<ul>
    <li>Vacuum dengan HEPA filter 2x seminggu</li>
    <li>Cuci sprei & sarung bantal air panas (60°C) weekly</li>
    <li>Gunakan mattress & pillow cover anti-tungau</li>
    <li>Hindari karpet tebal (sarang debu)</li>
    <li>Jaga kelembaban 30-50% (gunakan dehumidifier)</li>
    <li>Air purifier dengan HEPA filter</li>
    <li>No smoking zone</li>
</ul>

<p><strong>Di Kamar Tidur:</strong></p>
<ul>
    <li>Minimalkan soft toys</li>
    <li>Gorden tipis yang mudah dicuci</li>
    <li>Hindari tanaman indoor</li>
    <li>Jendela tertutup saat pollen season</li>
</ul>

<h2>Obat Asma</h2>
<p><strong>1. Controller (Pencegahan - Daily):</strong></p>
<ul>
    <li>Inhaled Corticosteroid (ICS): Budesonide, Fluticasone</li>
    <li>Long-acting beta agonist (LABA): Salmeterol</li>
    <li>Combination ICS + LABA: Seretide, Symbicort</li>
    <li>Leukotriene modifiers: Montelukast (Singulair)</li>
</ul>

<p><strong>2. Reliever (Pereda - Saat Serangan):</strong></p>
<ul>
    <li>Short-acting beta agonist (SABA): Salbutamol (Ventolin)</li>
    <li>Albuterol inhaler</li>
    <li>Selalu bawa kemana-mana!</li>
</ul>

<h2>Cara Menggunakan Inhaler</h2>
<ul>
    <li>Kocok inhaler 5-10x</li>
    <li>Buang napas penuh</li>
    <li>Posisikan mulut rapat di mouthpiece</li>
    <li>Press inhaler sambil tarik napas dalam</li>
    <li>Tahan napas 10 detik</li>
    <li>Buang napas perlahan</li>
    <li>Tunggu 30-60 detik sebelum puff kedua</li>
    <li>Kumur mulut setelah ICS (cegah candidiasis)</li>
</ul>

<h2>Olahraga untuk Penderita Asma</h2>
<p><strong>Olahraga Aman:</strong></p>
<ul>
    <li>Berenang (udara lembab)</li>
    <li>Walking/jogging ringan</li>
    <li>Yoga (breathwork)</li>
    <li>Bersepeda santai</li>
    <li>Tai chi</li>
</ul>

<p><strong>Tips Olahraga:</strong></p>
<ul>
    <li>Warm-up 10-15 menit (penting!)</li>
    <li>Gunakan reliever 15 menit sebelum olahraga</li>
    <li>Olahraga indoor jika udara dingin</li>
    <li>Bernapas melalui hidung (filter & hangatkan udara)</li>
    <li>Cool-down gradual</li>
    <li>Bawa inhaler selalu</li>
</ul>

<p><strong>Hindari:</strong></p>
<ul>
    <li>Olahraga saat udara sangat dingin/kering</li>
    <li>HIIT intensitas tinggi (untuk sebagian orang)</li>
    <li>Olahraga saat flu/infeksi</li>
</ul>

<h2>Makanan untuk Asma</h2>
<p><strong>Baik untuk Asma:</strong></p>
<ul>
    <li>Buah-buahan (vitamin C): Jeruk, kiwi, pepaya</li>
    <li>Sayuran hijau (antioksidan)</li>
    <li>Ikan berlemak (omega-3 anti-inflamasi)</li>
    <li>Kacang-kacangan (vitamin E)</li>
    <li>Bawang putih & jahe (anti-inflamasi)</li>
</ul>

<p><strong>Hindari:</strong></p>
<ul>
    <li>Makanan dengan sulfite (wine, dried fruit)</li>
    <li>Food allergen pribadi</li>
    <li>Makanan yang menyebabkan GERD</li>
    <li>MSG berlebihan (untuk beberapa orang)</li>
</ul>

<h2>Asthma Action Plan</h2>
<p><strong>Green Zone (Kontrol Baik):</strong></p>
<ul>
    <li>Tidak ada gejala</li>
    <li>Lanjutkan controller daily</li>
    <li>Aktivitas normal</li>
</ul>

<p><strong>Yellow Zone (Waspada):</strong></p>
<ul>
    <li>Gejala ringan muncul</li>
    <li>Gunakan reliever</li>
    <li>Double controller jika perlu</li>
    <li>Kurangi aktivitas berat</li>
</ul>

<p><strong>Red Zone (Bahaya):</strong></p>
<ul>
    <li>Gejala berat, tidak membaik</li>
    <li>Gunakan reliever immediate</li>
    <li>Call emergency/ke IGD</li>
</ul>

<h2>Monitoring Asma</h2>
<ul>
    <li>Peak Flow Meter: Check di pagi & malam</li>
    <li>Asthma diary: Catat gejala & trigger</li>
    <li>Regular check-up 3-6 bulan</li>
    <li>Spirometry test tahunan</li>
</ul>

<h2>Tips Hidup dengan Asma</h2>
<ul>
    <li>Patuhi obat controller (jangan skip!)</li>
    <li>Identifikasi & hindari trigger pribadi</li>
    <li>Vaksinasi flu & pneumonia</li>
    <li>Jaga berat badan ideal</li>
    <li>Kelola stress</li>
    <li>Quit smoking</li>
    <li>Medical ID bracelet</li>
    <li>Edukasi keluarga/teman tentang asma Anda</li>
</ul>

<p>Asma yang terkontrol baik = hidup normal tanpa batasan. Kunci adalah konsistensi obat controller dan menghindari trigger!</p>',
                'category' => 'Hidup Sehat',
                'category_color' => 'green',
                'image' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=800&h=500&fit=crop',
                'read_time' => '11 min read',
                'published_at' => '3 minggu lalu',
                'author' => 'Dr. Budi Pulmonologi',
            ],
            
            // Additional Diabetes Articles
            [
                'id' => 21,
                'slug' => 'cara-mencegah-diabetes-tipe-2-dengan-gaya-hidup-sehat',
                'title' => 'Cara Mencegah Diabetes Tipe 2 dengan Gaya Hidup Sehat',
                'excerpt' => 'Diabetes tipe 2 dapat dicegah dengan perubahan gaya hidup sederhana. Pelajari langkah-langkah efektif untuk menurunkan risiko diabetes hingga 58%.',
                'quote' => 'Pencegahan adalah investasi kesehatan terbaik. Mulai hari ini, selamatkan masa depan Anda dari diabetes.',
                'content' => '<div class="article-quote mb-6 p-4 bg-red-50 border-l-4 border-red-500 italic text-gray-700">"Pencegahan adalah investasi kesehatan terbaik. Mulai hari ini, selamatkan masa depan Anda dari diabetes."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#pengantar" class="text-blue-600 hover:underline">Pengantar</a></li>
    <li><a href="#faktor-risiko" class="text-blue-600 hover:underline">Faktor Risiko Diabetes</a></li>
    <li><a href="#turunkan-berat-badan" class="text-blue-600 hover:underline">Turunkan Berat Badan</a></li>
    <li><a href="#pola-makan" class="text-blue-600 hover:underline">Pola Makan Sehat</a></li>
    <li><a href="#aktivitas-fisik" class="text-blue-600 hover:underline">Aktivitas Fisik Teratur</a></li>
    <li><a href="#tidur-cukup" class="text-blue-600 hover:underline">Tidur Cukup</a></li>
    <li><a href="#kelola-stress" class="text-blue-600 hover:underline">Kelola Stress</a></li>
</ul>

<p id="pengantar">Diabetes tipe 2 adalah kondisi kronis yang mempengaruhi cara tubuh memproses gula darah. Kabar baiknya, penelitian menunjukkan bahwa diabetes tipe 2 dapat dicegah atau ditunda dengan perubahan gaya hidup sederhana.</p>

<h2 id="faktor-risiko">Faktor Risiko Diabetes Tipe 2</h2>
<p><strong>Faktor yang tidak dapat diubah:</strong></p>
<ul>
    <li>Usia di atas 45 tahun</li>
    <li>Riwayat keluarga dengan diabetes</li>
    <li>Riwayat diabetes gestasional</li>
    <li>Sindrom polikistik ovarium (PCOS)</li>
</ul>

<p><strong>Faktor yang dapat diubah:</strong></p>
<ul>
    <li>Kelebihan berat badan dan obesitas</li>
    <li>Gaya hidup tidak aktif</li>
    <li>Pola makan tidak sehat</li>
    <li>Merokok</li>
    <li>Kurang tidur</li>
    <li>Stress kronis</li>
</ul>

<h2 id="turunkan-berat-badan">1. Turunkan Berat Badan Berlebih</h2>
<p>Menurunkan berat badan hanya 5-7% dari berat badan awal dapat mengurangi risiko diabetes hingga 58%. Jika berat Anda 90 kg, kehilangan 4.5-6.3 kg sudah memberikan manfaat signifikan.</p>

<p><strong>Tips menurunkan berat badan:</strong></p>
<ul>
    <li>Buat target realistis (0.5-1 kg per minggu)</li>
    <li>Catat asupan makanan harian</li>
    <li>Kurangi porsi makan secara bertahap</li>
    <li>Hindari diet ekstrem yang sulit dipertahankan</li>
    <li>Fokus pada perubahan permanen, bukan solusi cepat</li>
</ul>

<h2 id="pola-makan">2. Terapkan Pola Makan Sehat</h2>
<p><strong>Makanan yang harus diperbanyak:</strong></p>
<ul>
    <li><strong>Serat tinggi:</strong> Sayuran, buah-buahan, kacang-kacangan, biji-bijian utuh</li>
    <li><strong>Protein sehat:</strong> Ikan, ayam tanpa kulit, tahu, tempe</li>
    <li><strong>Lemak sehat:</strong> Alpukat, kacang-kacangan, minyak zaitun</li>
    <li><strong>Karbohidrat kompleks:</strong> Oatmeal, beras merah, quinoa</li>
</ul>

<p><strong>Makanan yang harus dibatasi:</strong></p>
<ul>
    <li>Gula tambahan dan minuman manis</li>
    <li>Makanan olahan dan fast food</li>
    <li>Karbohidrat putih (nasi putih, roti putih)</li>
    <li>Daging merah dan daging olahan</li>
    <li>Gorengan dan makanan tinggi lemak jenuh</li>
</ul>

<h2 id="aktivitas-fisik">3. Aktif Bergerak Setiap Hari</h2>
<p>Aktivitas fisik teratur meningkatkan sensitivitas insulin dan membantu mengontrol gula darah. Target minimal: 150 menit aktivitas sedang per minggu.</p>

<p><strong>Jenis aktivitas yang direkomendasikan:</strong></p>
<ul>
    <li><strong>Aerobik:</strong> Jalan cepat, jogging, bersepeda, berenang</li>
    <li><strong>Latihan kekuatan:</strong> Angkat beban 2-3x per minggu</li>
    <li><strong>Aktivitas sehari-hari:</strong> Naik tangga, berkebun, bersih-bersih rumah</li>
</ul>

<p><strong>Tips memulai:</strong></p>
<ul>
    <li>Mulai dengan 10 menit per hari, tingkatkan bertahap</li>
    <li>Pilih aktivitas yang Anda nikmati</li>
    <li>Ajak teman atau keluarga untuk motivasi</li>
    <li>Gunakan pedometer atau fitness tracker</li>
    <li>Kurangi waktu duduk, berdiri atau jalan setiap 30 menit</li>
</ul>

<h2 id="tidur-cukup">4. Tidur Cukup dan Berkualitas</h2>
<p>Kurang tidur meningkatkan resistensi insulin dan hormon stress. Usahakan tidur 7-9 jam per malam dengan kualitas baik.</p>

<p><strong>Tips tidur berkualitas:</strong></p>
<ul>
    <li>Buat jadwal tidur konsisten</li>
    <li>Hindari kafein 6 jam sebelum tidur</li>
    <li>Matikan layar elektronik 1 jam sebelum tidur</li>
    <li>Ciptakan kamar tidur gelap, sejuk, dan tenang</li>
    <li>Hindari makan berat 2-3 jam sebelum tidur</li>
</ul>

<h2 id="kelola-stress">5. Kelola Stress dengan Baik</h2>
<p>Stress kronis meningkatkan kadar gula darah dan mendorong perilaku tidak sehat. Temukan cara efektif untuk mengelola stress.</p>

<p><strong>Teknik manajemen stress:</strong></p>
<ul>
    <li>Meditasi dan mindfulness 10-15 menit per hari</li>
    <li>Yoga atau tai chi</li>
    <li>Napas dalam dan relaksasi progresif</li>
    <li>Hobi yang menyenangkan</li>
    <li>Berbicara dengan teman atau konselor</li>
    <li>Batasi paparan berita negatif</li>
</ul>

<h2>Pemeriksaan Rutin</h2>
<p><strong>Siapa yang perlu screening diabetes?</strong></p>
<ul>
    <li>Semua orang berusia 45+ tahun</li>
    <li>Orang dengan BMI ≥23 dan faktor risiko tambahan</li>
    <li>Wanita dengan riwayat diabetes gestasional</li>
</ul>

<p><strong>Jenis pemeriksaan:</strong></p>
<ul>
    <li>Gula darah puasa (normal: <100 mg/dL)</li>
    <li>HbA1c (normal: <5.7%)</li>
    <li>Tes toleransi glukosa oral</li>
</ul>

<h2>Program Pencegahan Diabetes</h2>
<p>Pertimbangkan bergabung dengan program pencegahan diabetes jika Anda memiliki prediabetes. Program ini biasanya mencakup:</p>
<ul>
    <li>Konseling nutrisi individual</li>
    <li>Program aktivitas fisik terstruktur</li>
    <li>Dukungan kelompok dan motivasi</li>
    <li>Monitoring dan follow-up berkala</li>
</ul>

<p><strong>Kesimpulan:</strong> Mencegah diabetes tipe 2 sepenuhnya berada dalam kendali Anda. Mulai dengan satu perubahan kecil hari ini, dan bangun kebiasaan sehat secara bertahap. Investasi kecil sekarang akan menghasilkan manfaat kesehatan besar di masa depan!</p>',
                'category' => 'Diabetes',
                'category_color' => 'red',
                'image' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=800&h=500&fit=crop',
                'read_time' => '10 min read',
                'published_at' => '5 hari lalu',
                'author' => 'Dr. Maya Endokrinologi',
            ],
            [
                'id' => 22,
                'slug' => 'komplikasi-diabetes-yang-harus-diwaspadai-dan-cara-mencegahnya',
                'title' => 'Komplikasi Diabetes yang Harus Diwaspadai dan Cara Mencegahnya',
                'excerpt' => 'Diabetes yang tidak terkontrol dapat menyebabkan komplikasi serius. Kenali risiko dan langkah pencegahan untuk menjaga kualitas hidup Anda.',
                'quote' => 'Kontrol gula darah hari ini adalah investasi kesehatan jangka panjang Anda.',
                'content' => '<div class="article-quote mb-6 p-4 bg-red-50 border-l-4 border-red-500 italic text-gray-700">"Kontrol gula darah hari ini adalah investasi kesehatan jangka panjang Anda."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#pengantar" class="text-blue-600 hover:underline">Pengantar</a></li>
    <li><a href="#penyakit-jantung" class="text-blue-600 hover:underline">Penyakit Jantung dan Stroke</a></li>
    <li><a href="#neuropati" class="text-blue-600 hover:underline">Kerusakan Saraf (Neuropati)</a></li>
    <li><a href="#nefropati" class="text-blue-600 hover:underline">Kerusakan Ginjal (Nefropati)</a></li>
    <li><a href="#retinopati" class="text-blue-600 hover:underline">Kerusakan Mata (Retinopati)</a></li>
    <li><a href="#kaki-diabetik" class="text-blue-600 hover:underline">Masalah Kaki</a></li>
    <li><a href="#pencegahan" class="text-blue-600 hover:underline">Cara Mencegah Komplikasi</a></li>
</ul>

<p id="pengantar">Diabetes yang tidak terkontrol dengan baik dapat menyebabkan komplikasi serius yang mempengaruhi berbagai organ tubuh. Namun kabar baiknya, sebagian besar komplikasi dapat dicegah atau diperlambat dengan kontrol gula darah yang baik.</p>

<h2 id="penyakit-jantung">1. Penyakit Jantung dan Stroke</h2>
<p>Orang dengan diabetes memiliki risiko 2-4 kali lebih tinggi mengalami penyakit jantung dan stroke.</p>

<p><strong>Mengapa terjadi?</strong></p>
<ul>
    <li>Gula darah tinggi merusak pembuluh darah</li>
    <li>Sering disertai hipertensi dan kolesterol tinggi</li>
    <li>Penumpukan plak di arteri lebih cepat</li>
</ul>

<p><strong>Gejala yang perlu diwaspadai:</strong></p>
<ul>
    <li>Nyeri dada atau sesak napas</li>
    <li>Kelelahan ekstrem</li>
    <li>Pusing atau pingsan</li>
    <li>Nyeri di lengan, rahang, atau punggung</li>
</ul>

<p><strong>Pencegahan:</strong></p>
<ul>
    <li>Kontrol HbA1c <7%</li>
    <li>Jaga tekanan darah <140/90 mmHg</li>
    <li>Pertahankan kolesterol LDL <100 mg/dL</li>
    <li>Tidak merokok</li>
    <li>Olahraga teratur minimal 150 menit/minggu</li>
    <li>Konsumsi obat sesuai anjuran dokter (aspirin, statin jika diperlukan)</li>
</ul>

<h2 id="neuropati">2. Kerusakan Saraf (Neuropati Diabetik)</h2>
<p>Hingga 50% penderita diabetes mengalami neuropati, terutama di kaki dan tangan.</p>

<p><strong>Gejala neuropati:</strong></p>
<ul>
    <li>Kesemutan, mati rasa, atau sensasi terbakar</li>
    <li>Nyeri tajam atau kram, terutama malam hari</li>
    <li>Sensitivitas berlebihan terhadap sentuhan</li>
    <li>Kelemahan otot</li>
    <li>Kehilangan keseimbangan</li>
</ul>

<p><strong>Jenis neuropati:</strong></p>
<ul>
    <li><strong>Perifer:</strong> Mempengaruhi kaki dan tangan</li>
    <li><strong>Otonom:</strong> Mempengaruhi sistem pencernaan, kandung kemih, jantung</li>
    <li><strong>Proksimal:</strong> Nyeri di paha, pinggul, atau bokong</li>
    <li><strong>Fokal:</strong> Kerusakan saraf tunggal (mata, wajah, kaki)</li>
</ul>

<p><strong>Pencegahan dan pengelolaan:</strong></p>
<ul>
    <li>Jaga gula darah dalam target</li>
    <li>Periksa kaki setiap hari</li>
    <li>Gunakan alas kaki yang nyaman</li>
    <li>Hindari berjalan tanpa alas kaki</li>
    <li>Obat untuk mengurangi nyeri neuropatik (gabapentin, pregabalin)</li>
</ul>

<h2 id="nefropati">3. Kerusakan Ginjal (Nefropati Diabetik)</h2>
<p>Diabetes adalah penyebab utama gagal ginjal. Sekitar 1 dari 3 penderita diabetes mengalami penyakit ginjal.</p>

<p><strong>Tahapan penyakit ginjal:</strong></p>
<ul>
    <li><strong>Stadium 1-2:</strong> Kerusakan minimal, tanpa gejala</li>
    <li><strong>Stadium 3:</strong> Penurunan fungsi ginjal sedang</li>
    <li><strong>Stadium 4:</strong> Penurunan fungsi ginjal berat</li>
    <li><strong>Stadium 5:</strong> Gagal ginjal, perlu dialisis/transplantasi</li>
</ul>

<p><strong>Tanda-tanda masalah ginjal:</strong></p>
<ul>
    <li>Bengkak di kaki, pergelangan kaki, atau wajah</li>
    <li>Urin berbusa</li>
    <li>Sering buang air kecil, terutama malam hari</li>
    <li>Kelelahan dan kelemahan</li>
    <li>Mual dan muntah</li>
    <li>Hilang nafsu makan</li>
</ul>

<p><strong>Pencegahan:</strong></p>
<ul>
    <li>Kontrol gula darah dan tekanan darah ketat</li>
    <li>Tes urin albumin dan kreatinin setiap tahun</li>
    <li>Batasi konsumsi protein (0.8-1 g/kg berat badan)</li>
    <li>Hindari NSAID (ibuprofen, aspirin dosis tinggi)</li>
    <li>Obat ACE inhibitor atau ARB untuk proteksi ginjal</li>
</ul>

<h2 id="retinopati">4. Kerusakan Mata (Retinopati Diabetik)</h2>
<p>Diabetes dapat menyebabkan kebutaan jika tidak ditangani. Retinopati diabetik adalah penyebab utama kebutaan pada usia kerja.</p>

<p><strong>Tahapan retinopati:</strong></p>
<ul>
    <li><strong>Non-proliferatif ringan:</strong> Pembengkakan pembuluh darah kecil</li>
    <li><strong>Non-proliferatif sedang-berat:</strong> Pembuluh darah tersumbat</li>
    <li><strong>Proliferatif:</strong> Pembuluh darah baru yang rapuh terbentuk</li>
</ul>

<p><strong>Gejala yang perlu diwaspadai:</strong></p>
<ul>
    <li>Penglihatan kabur atau terdistorsi</li>
    <li>Floaters (bintik-bintik mengambang)</li>
    <li>Kesulitan melihat di malam hari</li>
    <li>Kehilangan penglihatan mendadak</li>
    <li>Area gelap atau kosong di penglihatan</li>
</ul>

<p><strong>Pencegahan:</strong></p>
<ul>
    <li>Pemeriksaan mata lengkap setiap tahun</li>
    <li>Kontrol gula darah, tekanan darah, dan kolesterol</li>
    <li>Laser treatment jika diperlukan</li>
    <li>Injeksi anti-VEGF untuk retinopati proliferatif</li>
</ul>

<h2 id="kaki-diabetik">5. Masalah Kaki Diabetik</h2>
<p>Kombinasi neuropati dan sirkulasi buruk membuat kaki rentan terhadap luka yang sulit sembuh.</p>

<p><strong>Risiko kaki diabetik:</strong></p>
<ul>
    <li>Luka kecil berkembang menjadi ulkus</li>
    <li>Infeksi sulit dikontrol</li>
    <li>Dapat berakhir dengan amputasi jika tidak ditangani</li>
</ul>

<p><strong>Perawatan kaki harian:</strong></p>
<ul>
    <li>Periksa kaki setiap hari untuk luka, lecet, kemerahan</li>
    <li>Cuci kaki dengan air hangat, keringkan dengan lembut</li>
    <li>Gunakan pelembab, hindari area antar jari</li>
    <li>Potong kuku lurus, tidak terlalu pendek</li>
    <li>Gunakan sepatu yang pas dan nyaman</li>
    <li>Jangan pernah berjalan tanpa alas kaki</li>
</ul>

<p><strong>Kapan harus ke dokter:</strong></p>
<ul>
    <li>Luka atau lecet yang tidak sembuh dalam 2 hari</li>
    <li>Kemerahan, bengkak, atau hangat di kaki</li>
    <li>Nanah atau bau tidak sedap</li>
    <li>Demam dengan luka di kaki</li>
    <li>Kuku tumbuh ke dalam atau infeksi jamur</li>
</ul>

<h2 id="pencegahan">Strategi Pencegahan Komplikasi</h2>
<p><strong>1. Target Kontrol Gula Darah:</strong></p>
<ul>
    <li>HbA1c: <7% (individual sesuai kondisi)</li>
    <li>Gula darah puasa: 80-130 mg/dL</li>
    <li>Gula darah 2 jam setelah makan: <180 mg/dL</li>
</ul>

<p><strong>2. Pemeriksaan Rutin:</strong></p>
<ul>
    <li>HbA1c setiap 3-6 bulan</li>
    <li>Pemeriksaan mata tahunan</li>
    <li>Tes fungsi ginjal dan albumin urin tahunan</li>
    <li>Pemeriksaan kaki setiap kunjungan dokter</li>
    <li>Profil lipid tahunan</li>
</ul>

<p><strong>3. Gaya Hidup Sehat:</strong></p>
<ul>
    <li>Diet seimbang, rendah gula dan lemak jenuh</li>
    <li>Aktivitas fisik 150 menit per minggu</li>
    <li>Berhenti merokok</li>
    <li>Kelola stress</li>
    <li>Tidur cukup 7-9 jam</li>
</ul>

<p><strong>4. Kepatuhan Pengobatan:</strong></p>
<ul>
    <li>Minum obat diabetes sesuai jadwal</li>
    <li>Gunakan insulin dengan teknik yang benar</li>
    <li>Jangan skip dosis tanpa konsultasi dokter</li>
    <li>Laporkan efek samping ke dokter</li>
</ul>

<h2>Kesimpulan</h2>
<p>Komplikasi diabetes serius, namun sebagian besar dapat dicegah atau diperlambat. Kunci utamanya adalah kontrol gula darah yang konsisten, pemeriksaan rutin, dan gaya hidup sehat. Bekerja sama dengan tim medis Anda untuk membuat rencana pengelolaan diabetes yang komprehensif.</p>

<p><strong>Ingat:</strong> Setiap hari dengan kontrol gula darah yang baik adalah hari yang Anda investasikan untuk kesehatan jangka panjang Anda!</p>',
                'category' => 'Diabetes',
                'category_color' => 'red',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&h=500&fit=crop',
                'read_time' => '12 min read',
                'published_at' => '1 minggu lalu',
                'author' => 'Dr. Andi Wijaya',
            ],
            [
                'id' => 23,
                'slug' => 'olahraga-aman-untuk-penderita-diabetes-panduan-lengkap',
                'title' => 'Olahraga Aman untuk Penderita Diabetes: Panduan Lengkap',
                'excerpt' => 'Olahraga adalah kunci penting dalam mengelola diabetes. Pelajari jenis olahraga yang aman, tips memulai, dan cara menghindari hipoglikemia.',
                'quote' => 'Olahraga adalah obat alami terbaik untuk diabetes. Bergerak hari ini, hidup lebih sehat besok.',
                'content' => '<div class="article-quote mb-6 p-4 bg-red-50 border-l-4 border-red-500 italic text-gray-700">"Olahraga adalah obat alami terbaik untuk diabetes. Bergerak hari ini, hidup lebih sehat besok."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#manfaat" class="text-blue-600 hover:underline">Manfaat Olahraga</a></li>
    <li><a href="#jenis-olahraga" class="text-blue-600 hover:underline">Jenis Olahraga yang Direkomendasikan</a></li>
    <li><a href="#memulai" class="text-blue-600 hover:underline">Cara Memulai dengan Aman</a></li>
    <li><a href="#hipoglikemia" class="text-blue-600 hover:underline">Mencegah Hipoglikemia</a></li>
    <li><a href="#tips-praktis" class="text-blue-600 hover:underline">Tips Praktis</a></li>
</ul>

<h2 id="manfaat">Manfaat Olahraga untuk Diabetes</h2>
<p>Olahraga teratur memberikan manfaat luar biasa bagi penderita diabetes:</p>

<p><strong>Manfaat Jangka Pendek:</strong></p>
<ul>
    <li>Menurunkan gula darah segera (efek bertahan 24-72 jam)</li>
    <li>Meningkatkan sensitivitas insulin</li>
    <li>Membantu kontrol berat badan</li>
    <li>Meningkatkan energi dan mood</li>
    <li>Mengurangi stress</li>
</ul>

<p><strong>Manfaat Jangka Panjang:</strong></p>
<ul>
    <li>Menurunkan HbA1c hingga 0.6-1%</li>
    <li>Mengurangi risiko penyakit jantung</li>
    <li>Menurunkan tekanan darah</li>
    <li>Meningkatkan kolesterol HDL (baik)</li>
    <li>Memperbaiki kualitas tidur</li>
    <li>Mencegah komplikasi diabetes</li>
</ul>

<h2 id="jenis-olahraga">Jenis Olahraga yang Direkomendasikan</h2>

<h3>1. Latihan Aerobik (Kardio)</h3>
<p><strong>Target:</strong> 150 menit per minggu (30 menit, 5 hari)</p>

<p><strong>Pilihan olahraga aerobik:</strong></p>
<ul>
    <li><strong>Jalan cepat:</strong> Mulai 10 menit, tingkatkan bertahap. Ideal untuk pemula.</li>
    <li><strong>Jogging/Lari:</strong> Bakar kalori lebih banyak, tingkatkan stamina.</li>
    <li><strong>Bersepeda:</strong> Rendah benturan, bagus untuk sendi.</li>
    <li><strong>Berenang:</strong> Full body workout, nyaman untuk sendi.</li>
    <li><strong>Senam aerobik:</strong> Menyenangkan, bisa bersama kelompok.</li>
    <li><strong>Menari:</strong> Kombinasi fun dan fitness.</li>
</ul>

<h3>2. Latihan Kekuatan (Resistance Training)</h3>
<p><strong>Target:</strong> 2-3 kali per minggu, minimal 8 jenis latihan</p>

<p><strong>Manfaat latihan kekuatan:</strong></p>
<ul>
    <li>Membangun massa otot</li>
    <li>Meningkatkan metabolisme</li>
    <li>Memperbaiki kontrol gula darah jangka panjang</li>
    <li>Meningkatkan kekuatan tulang</li>
</ul>

<p><strong>Pilihan latihan:</strong></p>
<ul>
    <li>Angkat beban (dumbbell, barbell)</li>
    <li>Resistance band</li>
    <li>Latihan berat badan (push-up, squat, plank)</li>
    <li>Mesin gym</li>
</ul>

<h3>3. Latihan Fleksibilitas</h3>
<p><strong>Target:</strong> 2-3 kali per minggu, 10-30 detik per gerakan</p>

<p><strong>Pilihan:</strong></p>
<ul>
    <li>Yoga - meningkatkan fleksibilitas dan relaksasi</li>
    <li>Stretching - cegah cedera, tingkatkan ROM</li>
    <li>Tai chi - low impact, bagus untuk keseimbangan</li>
</ul>

<h3>4. Latihan Keseimbangan</h3>
<p>Penting untuk mencegah jatuh, terutama jika ada neuropati:</p>
<ul>
    <li>Berdiri satu kaki</li>
    <li>Heel-to-toe walk</li>
    <li>Tai chi</li>
    <li>Balance board exercises</li>
</ul>

<h2 id="memulai">Cara Memulai dengan Aman</h2>

<p><strong>Langkah 1: Konsultasi Dokter</strong></p>
<p>Sebelum memulai program olahraga, diskusikan dengan dokter terutama jika:</p>
<ul>
    <li>Berusia >40 tahun</li>
    <li>Memiliki penyakit jantung atau faktor risikonya</li>
    <li>Ada komplikasi diabetes (neuropati, retinopati)</li>
    <li>Tidak aktif dalam waktu lama</li>
</ul>

<p><strong>Langkah 2: Cek Gula Darah</strong></p>
<p>Selalu cek gula darah sebelum olahraga:</p>
<ul>
    <li><strong><100 mg/dL:</strong> Makan snack 15g karbohidrat dulu</li>
    <li><strong>100-250 mg/dL:</strong> Aman untuk olahraga</li>
    <li><strong>>250 mg/dL + keton:</strong> Tunda olahraga, atasi hiperglikemia dulu</li>
</ul>

<p><strong>Langkah 3: Mulai Perlahan</strong></p>
<ul>
    <li>Minggu 1-2: 10 menit per hari</li>
    <li>Minggu 3-4: 15 menit per hari</li>
    <li>Minggu 5-6: 20 menit per hari</li>
    <li>Tingkatkan 5 menit setiap 1-2 minggu hingga target</li>
</ul>

<p><strong>Langkah 4: Dengarkan Tubuh</strong></p>
<p>Hentikan olahraga jika mengalami:</p>
<ul>
    <li>Nyeri dada atau sesak napas berat</li>
    <li>Pusing atau mau pingsan</li>
    <li>Gejala hipoglikemia</li>
    <li>Nyeri sendi atau otot yang tidak normal</li>
</ul>

<h2 id="hipoglikemia">Mencegah Hipoglikemia Saat Olahraga</h2>

<p><strong>Tanda-tanda hipoglikemia:</strong></p>
<ul>
    <li>Gemetar, berkeringat</li>
    <li>Lapar tiba-tiba</li>
    <li>Pusing, bingung</li>
    <li>Jantung berdebar</li>
    <li>Lemah, kelelahan</li>
</ul>

<p><strong>Pencegahan hipoglikemia:</strong></p>
<ul>
    <li>Cek gula darah sebelum, selama (jika >60 menit), dan setelah olahraga</li>
    <li>Bawa snack cepat serap: permen, jus, tablet glukosa</li>
    <li>Sesuaikan dosis insulin/obat dengan dokter</li>
    <li>Olahraga 1-2 jam setelah makan</li>
    <li>Hindari olahraga saat insulin pada puncak kerja</li>
    <li>Pakai ID medis atau beri tahu teman olahraga</li>
</ul>

<p><strong>Jika terjadi hipoglikemia:</strong></p>
<ol>
    <li>Hentikan olahraga segera</li>
    <li>Konsumsi 15g karbohidrat cepat serap</li>
    <li>Tunggu 15 menit, cek gula darah lagi</li>
    <li>Jika masih <70 mg/dL, ulangi step 2-3</li>
    <li>Setelah normal, makan snack protein+karbohidrat</li>
</ol>

<h2 id="tips-praktis">Tips Praktis Olahraga untuk Diabetesi</h2>

<p><strong>1. Peralatan Penting:</strong></p>
<ul>
    <li>Glukometer dan strip test</li>
    <li>Snack darurat (glukosa, permen)</li>
    <li>Botol air minum</li>
    <li>Sepatu olahraga yang pas dan nyaman</li>
    <li>Kaos kaki yang menyerap keringat</li>
    <li>Handuk</li>
</ul>

<p><strong>2. Waktu Terbaik:</strong></p>
<ul>
    <li><strong>Pagi:</strong> Energi fresh, tapi cek gula darah dulu</li>
    <li><strong>Setelah makan:</strong> 1-2 jam, saat gula darah naik</li>
    <li><strong>Konsisten:</strong> Sama waktu setiap hari lebih baik</li>
</ul>

<p><strong>3. Perawatan Kaki:</strong></p>
<ul>
    <li>Periksa kaki sebelum dan setelah olahraga</li>
    <li>Gunakan sepatu tertutup, jangan barefoot</li>
    <li>Ganti kaos kaki jika basah</li>
    <li>Rawat lecet/luka segera</li>
</ul>

<p><strong>4. Hidrasi:</strong></p>
<ul>
    <li>Minum sebelum, selama, dan setelah olahraga</li>
    <li>Target: 250ml setiap 15-20 menit</li>
    <li>Pilih air putih, hindari minuman manis</li>
</ul>

<p><strong>5. Catat Progress:</strong></p>
<ul>
    <li>Log gula darah pre & post exercise</li>
    <li>Catat jenis, durasi, intensitas olahraga</li>
    <li>Perhatikan pola: olahraga mana yang paling efektif?</li>
    <li>Share dengan dokter untuk sesuaikan terapi</li>
</ul>

<h2>Program Olahraga Mingguan Sample</h2>

<p><strong>Untuk Pemula:</strong></p>
<ul>
    <li><strong>Senin:</strong> Jalan cepat 20 menit</li>
    <li><strong>Selasa:</strong> Latihan kekuatan ringan 20 menit</li>
    <li><strong>Rabu:</strong> Jalan cepat 20 menit</li>
    <li><strong>Kamis:</strong> Istirahat atau yoga 15 menit</li>
    <li><strong>Jumat:</strong> Jalan cepat 20 menit</li>
    <li><strong>Sabtu:</strong> Latihan kekuatan ringan 20 menit</li>
    <li><strong>Minggu:</strong> Aktivitas santai (jalan-jalan, berkebun)</li>
</ul>

<p><strong>Untuk Intermediate:</strong></p>
<ul>
    <li><strong>Senin:</strong> Jogging 30 menit</li>
    <li><strong>Selasa:</strong> Latihan kekuatan 30 menit</li>
    <li><strong>Rabu:</strong> Bersepeda 45 menit</li>
    <li><strong>Kamis:</strong> Latihan kekuatan 30 menit</li>
    <li><strong>Jumat:</strong> Berenang atau jogging 30 menit</li>
    <li><strong>Sabtu:</strong> Hiking atau yoga 45 menit</li>
    <li><strong>Minggu:</strong> Istirahat aktif (stretching ringan)</li>
</ul>

<h2>Kesimpulan</h2>
<p>Olahraga adalah komponen vital dalam pengelolaan diabetes. Mulai dengan perlahan, konsisten, dan selalu perhatikan respons tubuh Anda. Dengan olahraga teratur, Anda tidak hanya mengontrol gula darah, tetapi juga meningkatkan kualitas hidup secara keseluruhan.</p>

<p><strong>Ingat:</strong> Setiap langkah yang Anda ambil hari ini adalah investasi untuk kesehatan Anda besok. Ayo mulai bergerak!</p>',
                'category' => 'Diabetes',
                'category_color' => 'red',
                'image' => 'https://images.unsplash.com/photo-1538805060514-97d9cc17730c?w=800&h=500&fit=crop',
                'read_time' => '11 min read',
                'published_at' => '2 minggu lalu',
                'author' => 'Dr. Fitri Olahraga & Diabetes',
            ],
            
            // Additional Beauty Articles
            [
                'id' => 24,
                'slug' => 'perawatan-jerawat-yang-efektif-dan-aman',
                'title' => 'Perawatan Jerawat yang Efektif dan Aman untuk Semua Jenis Kulit',
                'excerpt' => 'Jerawat adalah masalah kulit yang umum namun bisa diatasi. Pelajari cara merawat kulit berjerawat dengan tepat dan hindari kesalahan yang memperburuk kondisi.',
                'quote' => 'Kulit sehat dimulai dari pemahaman dan perawatan yang tepat. Sabar dan konsisten adalah kunci.',
                'content' => '<div class="article-quote mb-6 p-4 bg-pink-50 border-l-4 border-pink-500 italic text-gray-700">"Kulit sehat dimulai dari pemahaman dan perawatan yang tepat. Sabar dan konsisten adalah kunci."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#penyebab" class="text-blue-600 hover:underline">Penyebab Jerawat</a></li>
    <li><a href="#jenis" class="text-blue-600 hover:underline">Jenis-Jenis Jerawat</a></li>
    <li><a href="#pembersihan" class="text-blue-600 hover:underline">Cara Membersihkan Wajah</a></li>
    <li><a href="#treatment" class="text-blue-600 hover:underline">Treatment Jerawat</a></li>
    <li><a href="#kesalahan" class="text-blue-600 hover:underline">Kesalahan yang Harus Dihindari</a></li>
    <li><a href="#diet" class="text-blue-600 hover:underline">Diet untuk Kulit Berjerawat</a></li>
</ul>

<h2 id="penyebab">Penyebab Jerawat</h2>
<p>Jerawat terjadi ketika pori-pori kulit tersumbat oleh minyak, sel kulit mati, dan bakteri. Beberapa faktor penyebab:</p>

<p><strong>Faktor Internal:</strong></p>
<ul>
    <li><strong>Hormon:</strong> Fluktuasi hormon saat pubertas, menstruasi, kehamilan</li>
    <li><strong>Genetik:</strong> Riwayat keluarga dengan jerawat</li>
    <li><strong>Stress:</strong> Meningkatkan produksi hormon kortisol</li>
    <li><strong>Obat-obatan:</strong> Kortikosteroid, lithium, kontrasepsi tertentu</li>
</ul>

<p><strong>Faktor Eksternal:</strong></p>
<ul>
    <li>Produk kosmetik yang comedogenic</li>
    <li>Polusi dan debu</li>
    <li>Kelembaban tinggi</li>
    <li>Gesekan dari helm, topi, atau masker</li>
    <li>Menyentuh wajah terlalu sering</li>
</ul>

<h2 id="jenis">Jenis-Jenis Jerawat</h2>

<p><strong>1. Non-Inflammatory (Komedo):</strong></p>
<ul>
    <li><strong>Whitehead:</strong> Komedo tertutup, bintik putih kecil</li>
    <li><strong>Blackhead:</strong> Komedo terbuka, teroksidasi jadi hitam</li>
</ul>

<p><strong>2. Inflammatory (Meradang):</strong></p>
<ul>
    <li><strong>Papula:</strong> Benjolan merah kecil, sensitif</li>
    <li><strong>Pustula:</strong> Papula dengan nanah putih/kuning di puncak</li>
    <li><strong>Nodula:</strong> Jerawat besar, keras, di bawah kulit</li>
    <li><strong>Cyst:</strong> Kantung berisi nanah, sangat nyeri, berisiko scar</li>
</ul>

<h2 id="pembersihan">Cara Membersihkan Wajah yang Benar</h2>

<p><strong>Rutinitas Pagi:</strong></p>
<ol>
    <li><strong>Cleanser:</strong> Gunakan gentle cleanser, hindari sabun keras
        <ul>
            <li>Kulit berminyak: gel/foam cleanser</li>
            <li>Kulit kering: cream cleanser</li>
            <li>Kulit sensitif: micellar water</li>
        </ul>
    </li>
    <li><strong>Toner:</strong> Seimbangkan pH kulit (optional)</li>
    <li><strong>Treatment:</strong> Serum atau spot treatment</li>
    <li><strong>Moisturizer:</strong> Oil-free, non-comedogenic</li>
    <li><strong>Sunscreen:</strong> SPF 30+, wajib!</li>
</ol>

<p><strong>Rutinitas Malam:</strong></p>
<ol>
    <li><strong>Makeup Remover/Cleansing Oil:</strong> Jika pakai makeup</li>
    <li><strong>Cleanser:</strong> Double cleansing untuk kulit berminyak</li>
    <li><strong>Exfoliant:</strong> 2-3x seminggu (AHA/BHA)</li>
    <li><strong>Toner:</strong> Sesuai kebutuhan</li>
    <li><strong>Treatment:</strong> Retinoid atau benzoyl peroxide</li>
    <li><strong>Moisturizer:</strong> Lebih rich dari pagi</li>
</ol>

<h2 id="treatment">Treatment Aktif untuk Jerawat</h2>

<p><strong>1. Benzoyl Peroxide (2.5-10%):</strong></p>
<ul>
    <li>Membunuh bakteri penyebab jerawat</li>
    <li>Efektif untuk papula dan pustula</li>
    <li>Mulai dari konsentrasi rendah</li>
    <li>Bisa membuat kulit kering, gunakan moisturizer</li>
</ul>

<p><strong>2. Salicylic Acid (0.5-2%):</strong></p>
<ul>
    <li>BHA yang menembus pori</li>
    <li>Eksfoliasi dan mengurangi komedo</li>
    <li>Cocok untuk kulit berminyak</li>
    <li>Gunakan 2-3x seminggu</li>
</ul>

<p><strong>3. Retinoid (Retinol, Adapalene, Tretinoin):</strong></p>
<ul>
    <li>Mempercepat cell turnover</li>
    <li>Mencegah penyumbatan pori</li>
    <li>Efektif untuk komedo dan jerawat meradang</li>
    <li>Mulai 2-3x seminggu, tingkatkan bertahap</li>
    <li>Wajib pakai sunscreen di pagi hari</li>
</ul>

<p><strong>4. Niacinamide (5-10%):</strong></p>
<ul>
    <li>Anti-inflammatory</li>
    <li>Kontrol produksi sebum</li>
    <li>Mencerahkan bekas jerawat</li>
    <li>Aman untuk semua jenis kulit</li>
</ul>

<p><strong>5. Azelaic Acid (10-20%):</strong></p>
<ul>
    <li>Anti bakteri dan anti-inflammatory</li>
    <li>Mencerahkan PIH (post-inflammatory hyperpigmentation)</li>
    <li>Gentle, cocok untuk kulit sensitif</li>
</ul>

<h2 id="kesalahan">Kesalahan yang Harus Dihindari</h2>

<p><strong>1. Memencet Jerawat:</strong></p>
<ul>
    <li>Menyebarkan bakteri</li>
    <li>Meningkatkan risiko scar dan PIH</li>
    <li>Jika terpaksa, sterilkan alat dan tangan</li>
</ul>

<p><strong>2. Over-Cleansing:</strong></p>
<ul>
    <li>Cuci muka >2x sehari menghilangkan minyak natural</li>
    <li>Kulit jadi kering dan produksi sebum meningkat</li>
    <li>Cukup 2x sehari: pagi dan malam</li>
</ul>

<p><strong>3. Skip Moisturizer:</strong></p>
<ul>
    <li>Kulit berjerawat tetap butuh hidrasi</li>
    <li>Pilih yang oil-free dan non-comedogenic</li>
    <li>Kulit kering memicu produksi minyak berlebih</li>
</ul>

<p><strong>4. Tidak Pakai Sunscreen:</strong></p>
<ul>
    <li>UV memperburuk bekas jerawat</li>
    <li>Treatment jerawat membuat kulit sensitif</li>
    <li>Pakai sunscreen SPF 30+ setiap hari</li>
</ul>

<p><strong>5. Ganti Produk Terlalu Cepat:</strong></p>
<ul>
    <li>Beri waktu minimal 6-8 minggu</li>
    <li>Purging (jerawat awal) adalah normal</li>
    <li>Konsisten adalah kunci</li>
</ul>

<p><strong>6. Terlalu Banyak Aktif Sekaligus:</strong></p>
<ul>
    <li>Bisa iritasi dan overload kulit</li>
    <li>Mulai 1 aktif, tunggu 2-4 minggu sebelum tambah</li>
    <li>Jangan combine retinoid + AHA/BHA di malam yang sama</li>
</ul>

<h2 id="diet">Diet untuk Kulit Berjerawat</h2>

<p><strong>Makanan yang Harus Dihindari:</strong></p>
<ul>
    <li><strong>High glycemic foods:</strong> Nasi putih, roti putih, makanan manis</li>
    <li><strong>Dairy:</strong> Susu, keju (terutama yang tinggi lemak)</li>
    <li><strong>Makanan berminyak dan gorengan</strong></li>
    <li><strong>Makanan olahan tinggi gula</strong></li>
</ul>

<p><strong>Makanan yang Baik untuk Kulit:</strong></p>
<ul>
    <li><strong>Omega-3:</strong> Ikan salmon, walnut, flaxseed</li>
    <li><strong>Antioksidan:</strong> Buah berry, sayuran hijau</li>
    <li><strong>Zinc:</strong> Kacang-kacangan, biji labu</li>
    <li><strong>Vitamin A:</strong> Wortel, ubi, bayam</li>
    <li><strong>Vitamin E:</strong> Alpukat, almond</li>
    <li><strong>Probiotik:</strong> Yogurt plain, kimchi, tempe</li>
</ul>

<h2>Kapan Harus ke Dokter?</h2>
<p>Konsultasi dermatologist jika:</p>
<ul>
    <li>Jerawat parah (nodular/cystic)</li>
    <li>OTC treatment tidak efektif setelah 3 bulan</li>
    <li>Jerawat meninggalkan scar yang dalam</li>
    <li>Jerawat mempengaruhi kepercayaan diri</li>
    <li>Jerawat muncul tiba-tiba di usia dewasa</li>
</ul>

<p><strong>Treatment Medis:</strong></p>
<ul>
    <li>Antibiotik oral (untuk jerawat meradang parah)</li>
    <li>Isotretinoin (Accutane) untuk jerawat severe</li>
    <li>Kontrasepsi hormonal (untuk wanita)</li>
    <li>Chemical peeling</li>
    <li>Laser therapy</li>
    <li>Injection kortikosteroid untuk nodula/cyst</li>
</ul>

<h2>Kesimpulan</h2>
<p>Perawatan jerawat membutuhkan kesabaran dan konsistensi. Tidak ada solusi instant, tapi dengan rutinitas yang tepat dan gaya hidup sehat, kulit Anda akan membaik. Ingat, setiap kulit berbeda - apa yang bekerja untuk orang lain belum tentu cocok untuk Anda. Jangan ragu konsultasi ke dermatologist untuk treatment yang personalized!</p>',
                'category' => 'Kecantikan',
                'category_color' => 'pink',
                'image' => 'https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?w=800&h=500&fit=crop',
                'read_time' => '11 min read',
                'published_at' => '4 hari lalu',
                'author' => 'Dr. Lisa Dermatologi',
            ],
            [
                'id' => 25,
                'slug' => 'anti-aging-alami-tampil-awet-muda-tanpa-operasi',
                'title' => 'Anti-Aging Alami: Tampil Awet Muda Tanpa Operasi Plastik',
                'excerpt' => 'Rahasia awet muda tidak selalu memerlukan prosedur mahal. Temukan cara alami untuk memperlambat penuaan kulit dan tampil lebih muda.',
                'quote' => 'Penuaan adalah proses alami, tetapi kita bisa memperlambatnya dengan gaya hidup sehat dan perawatan yang tepat.',
                'content' => '<div class="article-quote mb-6 p-4 bg-pink-50 border-l-4 border-pink-500 italic text-gray-700">"Penuaan adalah proses alami, tetapi kita bisa memperlambatnya dengan gaya hidup sehat dan perawatan yang tepat."</div>

<h2>Daftar Isi</h2>
<ul class="toc mb-6 bg-gray-50 p-4 rounded-lg">
    <li><a href="#proses-penuaan" class="text-blue-600 hover:underline">Proses Penuaan Kulit</a></li>
    <li><a href="#skincare" class="text-blue-600 hover:underline">Skincare Anti-Aging</a></li>
    <li><a href="#gaya-hidup" class="text-blue-600 hover:underline">Gaya Hidup Anti-Aging</a></li>
    <li><a href="#diet" class="text-blue-600 hover:underline">Diet Anti-Aging</a></li>
    <li><a href="#treatment" class="text-blue-600 hover:underline">Treatment Profesional</a></li>
</ul>

<h2 id="proses-penuaan">Memahami Proses Penuaan Kulit</h2>

<p><strong>Penuaan Intrinsik (Internal):</strong></p>
<ul>
    <li>Genetik dan hormon</li>
    <li>Penurunan produksi kolagen (1% per tahun setelah usia 20)</li>
    <li>Penurunan elastin</li>
    <li>Regenerasi sel melambat</li>
    <li>Tidak bisa dicegah, tapi bisa diperlambat</li>
</ul>

<p><strong>Penuaan Ekstrinsik (External):</strong></p>
<ul>
    <li><strong>Photoaging (80% penuaan kulit):</strong> Paparan UV</li>
    <li><strong>Polusi:</strong> Radikal bebas</li>
    <li><strong>Merokok:</strong> Merusak kolagen dan elastin</li>
    <li><strong>Stress:</strong> Meningkatkan kortisol</li>
    <li><strong>Pola makan buruk</strong></li>
    <li><strong>Kurang tidur</strong></li>
</ul>

<p><strong>Tanda-tanda Penuaan:</strong></p>
<ul>
    <li>Fine lines dan wrinkles</li>
    <li>Kulit kendur (sagging)</li>
    <li>Volume wajah berkurang</li>
    <li>Dark spots dan hiperpigmentasi</li>
    <li>Tekstur kulit kasar</li>
    <li>Pori-pori membesar</li>
    <li>Kulit kering</li>
</ul>

<h2 id="skincare">Skincare Anti-Aging yang Efektif</h2>

<p><strong>1. Sunscreen (WAJIB #1!):</strong></p>
<ul>
    <li>SPF 30-50, broad spectrum (UVA + UVB)</li>
    <li>Pakai setiap hari, rain or shine</li>
    <li>Reapply setiap 2 jam jika outdoor</li>
    <li>Ini investasi anti-aging terbaik!</li>
</ul>

<p><strong>2. Retinoid (Gold Standard):</strong></p>
<ul>
    <li>Retinol (OTC): 0.25-1%</li>
    <li>Tretinoin/Retin-A (prescription): lebih kuat</li>
    <li><strong>Manfaat:</strong> Boost kolagen, kurangi wrinkles, even skin tone</li>
    <li><strong>Cara pakai:</strong> Mulai 2x seminggu malam, tingkatkan bertahap</li>
    <li><strong>Side effect:</strong> Purging, kering, iritasi di awal (normal)</li>
    <li>Butuh 3-6 bulan untuk hasil optimal</li>
</ul>

<p><strong>3. Vitamin C (Antioksidan Kuat):</strong></p>
<ul>
    <li>Konsentrasi: 10-20% L-Ascorbic Acid</li>
    <li><strong>Manfaat:</strong> Cerahkan, lindungi dari radikal bebas, boost kolagen</li>
    <li>Pakai di pagi hari sebelum sunscreen</li>
    <li>Simpan di tempat gelap dan sejuk</li>
</ul>

<p><strong>4. Hyaluronic Acid (Hidrasi Intensif):</strong></p>
<ul>
    <li>Menarik 1000x beratnya dalam air</li>
    <li>Plumping effect, kurangi fine lines</li>
    <li>Aman untuk semua jenis kulit</li>
    <li>Pakai di kulit lembab, tutup dengan moisturizer</li>
</ul>

<p><strong>5. Peptides:</strong></p>
<ul>
    <li>Merangsang produksi kolagen</li>
    <li>Repair skin barrier</li>
    <li>Combine dengan retinoid untuk hasil maksimal</li>
</ul>

<p><strong>6. Niacinamide (Vitamin B3):</strong></p>
<ul>
    <li>Multi-fungsi: brighten, minimize pores, strengthen barrier</li>
    <li>Anti-inflammatory</li>
    <li>Cocok dikombinasikan dengan hampir semua aktif</li>
</ul>

<p><strong>7. AHA/BHA (Eksfoliasi Kimia):</strong></p>
<ul>
    <li><strong>AHA (Glycolic, Lactic):</strong> Eksfoliasi permukaan, brighten</li>
    <li><strong>BHA (Salicylic):</strong> Eksfoliasi dalam pori</li>
    <li>Gunakan 2-3x seminggu</li>
    <li>Jangan pakai bersamaan dengan retinoid</li>
</ul>

<h2>Urutan Skincare Anti-Aging</h2>

<p><strong>Pagi:</strong></p>
<ol>
    <li>Cleanser</li>
    <li>Toner (optional)</li>
    <li>Vitamin C serum</li>
    <li>Hyaluronic acid</li>
    <li>Eye cream</li>
    <li>Moisturizer</li>
    <li>Sunscreen SPF 50</li>
</ol>

<p><strong>Malam:</strong></p>
<ol>
    <li>Cleansing oil/balm</li>
    <li>Cleanser</li>
    <li>Exfoliant (AHA/BHA) - 2-3x seminggu</li>
    <li>Toner</li>
    <li>Retinoid (tunggu 20 menit setelah cleansing)</li>
    <li>Peptide serum (jika tidak pakai retinoid)</li>
    <li>Eye cream</li>
    <li>Moisturizer rich</li>
    <li>Face oil (optional)</li>
</ol>

<h2 id="gaya-hidup">Gaya Hidup Anti-Aging</h2>

<p><strong>1. Tidur Berkualitas (Beauty Sleep Real!):</strong></p>
<ul>
    <li>7-9 jam per malam</li>
    <li>Peak regenerasi kulit: 11 PM - 3 AM</li>
    <li>Gunakan sarung bantal sutra</li>
    <li>Tidur telentang untuk cegah sleep lines</li>
</ul>

<p><strong>2. Kelola Stress:</strong></p>
<ul>
    <li>Stress tinggi = kortisol tinggi = kolagen rusak</li>
    <li>Meditasi, yoga, hobi menyenangkan</li>
    <li>Quality time dengan orang tersayang</li>
</ul>

<p><strong>3. Olahraga Teratur:</strong></p>
<ul>
    <li>Meningkatkan sirkulasi darah ke kulit</li>
    <li>Detoks lewat keringat</li>
    <li>Target: 150 menit per minggu</li>
    <li>Mix cardio + strength training</li>
</ul>

<p><strong>4. Hindari Merokok & Alkohol:</strong></p>
<ul>
    <li>Rokok merusak kolagen dan elastin</li>
    <li>Alkohol dehidrasi kulit</li>
    <li>Keduanya mempercepat penuaan drastis</li>
</ul>

<p><strong>5. Hidrasi Cukup:</strong></p>
<ul>
    <li>2-3 liter air per hari</li>
    <li>Kulit terhidrasi = plump dan glowing</li>
</ul>

<h2 id="diet">Diet Anti-Aging</h2>

<p><strong>Makanan Anti-Aging Superfood:</strong></p>
<ul>
    <li><strong>Berries:</strong> Antioksidan tinggi, lawan radikal bebas</li>
    <li><strong>Fatty fish (Salmon, Mackerel):</strong> Omega-3, anti-inflammatory</li>
    <li><strong>Avocado:</strong> Vitamin E, lemak sehat</li>
    <li><strong>Nuts & Seeds:</strong> Vitamin E, zinc</li>
    <li><strong>Dark chocolate (70%+):</strong> Flavonoid antioksidan</li>
    <li><strong>Sayuran hijau:</strong> Vitamin A, C, K</li>
    <li><strong>Sweet potato:</strong> Beta carotene</li>
    <li><strong>Tomat:</strong> Lycopene, proteksi UV</li>
    <li><strong>Green tea:</strong> EGCG antioksidan kuat</li>
</ul>

<p><strong>Hindari:</strong></p>
<ul>
    <li>Gula berlebih (AGEs = Advanced Glycation End products)</li>
    <li>Makanan olahan</li>
    <li>Trans fat</li>
    <li>Karbohidrat putih berlebih</li>
</ul>

<p><strong>Suplemen Pendukung:</strong></p>
<ul>
    <li>Vitamin C: 500-1000mg</li>
    <li>Vitamin E: 400 IU</li>
    <li>Omega-3: 1000-2000mg</li>
    <li>Collagen peptides: 5-10g</li>
    <li>CoQ10: 100-200mg</li>
</ul>

<h2 id="treatment">Treatment Profesional Anti-Aging</h2>

<p><strong>Non-Invasive (Tanpa Jarum/Pisau):</strong></p>
<ul>
    <li><strong>Laser Resurfacing:</strong> Stimulasi kolagen, kurangi wrinkles</li>
    <li><strong>RF (Radiofrequency):</strong> Skin tightening</li>
    <li><strong>Ultherapy:</strong> Ultrasound lift</li>
    <li><strong>Chemical Peel:</strong> Eksfoliasi deep, regenerasi</li>
    <li><strong>Microneedling + PRP:</strong> Boost kolagen alami</li>
    <li><strong>LED Light Therapy:</strong> Red light untuk kolagen</li>
</ul>

<p><strong>Minimally Invasive:</strong></p>
<ul>
    <li><strong>Botox:</strong> Relax otot, kurangi dynamic wrinkles</li>
    <li><strong>Filler (HA):</strong> Restore volume, kontur wajah</li>
    <li><strong>Thread Lift:</strong> Lift tanpa operasi</li>
</ul>

<h2>Zona Penting yang Sering Diabaikan</h2>

<p><strong>1. Area Mata:</strong></p>
<ul>
    <li>Kulit paling tipis, rentan wrinkles</li>
    <li>Pakai eye cream dengan retinol, peptides, caffeine</li>
    <li>Aplikasi gentle dengan ring finger</li>
</ul>

<p><strong>2. Leher & Décolletage:</strong></p>
<ul>
    <li>Sering dilupakan!</li>
    <li>Apply semua skincare sampai area ini</li>
    <li>Sunscreen wajib!</li>
</ul>

<p><strong>3. Tangan:</strong></p>
<ul>
    <li>Tangan mengkhianati usia</li>
    <li>Hand cream dengan SPF setiap hari</li>
    <li>Gunakan sarung tangan saat aktivitas outdoor</li>
</ul>

<h2>Tips Pro Anti-Aging</h2>
<ul>
    <li><strong>Konsisten > Produk mahal:</strong> Routine sederhana tapi konsisten lebih efektif</li>
    <li><strong>Start early:</strong> Prevention lebih mudah dari reversal</li>
    <li><strong>Patience:</strong> Anti-aging butuh waktu, minimal 3-6 bulan</li>
    <li><strong>Less is more:</strong> Jangan overload aktif, bisa irritasi</li>
    <li><strong>Professional consultation:</strong> Untuk hasil optimal</li>
</ul>

<h2>Kesimpulan</h2>
<p>Anti-aging alami adalah kombinasi skincare cerdas, gaya hidup sehat, dan perlindungan konsisten dari faktor eksternal. Tidak ada magic pill, tetapi dengan komitmen dan kesabaran, Anda bisa memperlambat penuaan dan tampil lebih muda lebih lama. Ingat: yang terpenting adalah menjadi versi terbaik dari diri Anda sendiri di setiap usia!</p>',
                'category' => 'Kecantikan',
                'category_color' => 'pink',
                'image' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800&h=500&fit=crop',
                'read_time' => '13 min read',
                'published_at' => '1 minggu lalu',
                'author' => 'Dr. Diana Anti-Aging Specialist',
            ],
        ];
    }
}
