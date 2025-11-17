@extends('layouts.app')

@section('title', 'Home - Kelompok Serigala Putih')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4 animate-fade-in">
            Selamat Datang di Proyek Serigala Putih
        </h1>
        <p class="text-xl mb-8 text-purple-100">
            Tugas Besar Pemrograman Web - Solusi Digital Terbaik
        </p>
        <div class="flex justify-center space-x-4">
            <button class="px-8 py-3 bg-white text-purple-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                Mulai Sekarang
            </button>
            <button class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                Pelajari Lebih Lanjut
            </button>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-4 text-gray-800">Fitur Utama</h2>
        <p class="text-center text-gray-600 mb-12">
            Fitur-fitur yang akan dikembangkan oleh tim
        </p>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature Card 1 -->
            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-users text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-800">Manajemen User</h3>
                <p class="text-gray-600 mb-4">
                    Sistem autentikasi dan manajemen pengguna yang lengkap dengan role-based access.
                </p>
                <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">
                    <i class="fas fa-user mr-1"></i> Anggota 1
                </span>
            </div>
            
            <!-- Feature Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-shopping-cart text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-800">E-Commerce</h3>
                <p class="text-gray-600 mb-4">
                    Sistem belanja online dengan keranjang, checkout, dan payment gateway.
                </p>
                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                    <i class="fas fa-user mr-1"></i> Anggota 2
                </span>
            </div>
            
            <!-- Feature Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-800">Dashboard & Analytics</h3>
                <p class="text-gray-600 mb-4">
                    Dashboard interaktif dengan visualisasi data dan laporan real-time.
                </p>
                <span class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">
                    <i class="fas fa-user mr-1"></i> Anggota 3
                </span>
            </div>
            
            <!-- Feature Card 4 -->
            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-blog text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-800">Content Management</h3>
                <p class="text-gray-600 mb-4">
                    Sistem manajemen konten untuk artikel, berita, dan blog.
                </p>
                <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-sm">
                    <i class="fas fa-user mr-1"></i> Anggota 4
                </span>
            </div>
            
            <!-- Feature Card 5 -->
            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-cog text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-800">Admin Panel</h3>
                <p class="text-gray-600 mb-4">
                    Panel administrasi untuk mengelola seluruh sistem dan konfigurasi.
                </p>
                <span class="inline-block px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm">
                    <i class="fas fa-user mr-1"></i> Anggota 5
                </span>
            </div>
            
            <!-- Feature Card 6 -->
            <div class="bg-white p-6 rounded-lg shadow-lg card-hover">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-mobile-alt text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-800">Responsive Design</h3>
                <p class="text-gray-600 mb-4">
                    Interface yang responsive dan mobile-friendly untuk semua perangkat.
                </p>
                <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm">
                    <i class="fas fa-users mr-1"></i> Semua Tim
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-gray-900 text-left mb-4">Kata Mereka tentang Halodoc</h2>
        <p class="text-gray-600 text-left mb-12 max-w-3xl">
            Cerita nyata dari pengguna yang merasakan layanan kesehatan cepat, aman, dan nyaman langsung dari rumah.
        </p>

        <div class="grid md:grid-cols-3 gap-10">
            <!-- Testimonial 1 -->
            <div class="flex flex-col space-y-6">
                <div class="flex items-start space-x-4">
                    <img src="https://i.pravatar.cc/80?img=68" alt="Sainem Wiyono" class="w-16 h-16 rounded-full object-cover border border-gray-200" />
                    <div>
                        <p class="italic text-gray-800 leading-relaxed">
                            “Sangat membantu.. malam2 butuh obat, gak perlu keluar rumah”
                        </p>
                        <p class="uppercase tracking-wide text-xs text-gray-500 mt-3">SAINEM WIYONO</p>
                    </div>
                </div>
                <button class="w-fit px-6 py-2 border border-pink-500 text-pink-500 rounded-full text-sm font-semibold hover:bg-pink-50 transition">
                    Beli Obat
                </button>
            </div>

            <!-- Testimonial 2 -->
            <div class="flex flex-col space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center">
                        <span class="text-pink-500 font-semibold text-xl">L</span>
                    </div>
                    <div>
                        <p class="italic text-gray-800 leading-relaxed">
                            “Sangat Helpful!!! Terima kasih yaa, sangat menghemat waktu dan respon dokternya juga baik. resep obatnya juga manjur sekali, thank u ya semoga kedepannya tambah keren lagi.”
                        </p>
                        <p class="uppercase tracking-wide text-xs text-gray-500 mt-3">LINTANG ANINDHITYA INDRASWARI</p>
                    </div>
                </div>
                <button class="w-fit px-6 py-2 border border-pink-500 text-pink-500 rounded-full text-sm font-semibold hover:bg-pink-50 transition">
                    Chat dengan Dokter
                </button>
            </div>

            <!-- Testimonial 3 -->
            <div class="flex flex-col space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center">
                        <span class="text-pink-500 font-semibold text-xl">A</span>
                    </div>
                    <div>
                        <p class="italic text-gray-800 leading-relaxed">
                            “Menggunakan Halodoc untuk pemanggilan Home Service kesehatan. Sangat memuaskan, walau di proses perlu perubahan jasa medis, tetap dilayani dengan cepat, dan proses refund mudah & cepat. Semoga bisa dipertahankan.”
                        </p>
                        <p class="uppercase tracking-wide text-xs text-gray-500 mt-3">AHKBAR FELYAYTI</p>
                    </div>
                </div>
                <button class="w-fit px-6 py-2 border border-pink-500 text-pink-500 rounded-full text-sm font-semibold hover:bg-pink-50 transition">
                    Pesan Tes Lab
                </button>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-10 mt-12">
            <!-- Testimonial 4 -->
            <div class="flex flex-col space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center">
                        <span class="text-pink-500 font-semibold text-xl">I</span>
                    </div>
                    <div>
                        <p class="italic text-gray-800 leading-relaxed">
                            “Hallo, terimakasih Haloskin sejak pertama konsultasi hingga saat ini kulitku sudah banyak mengalami perubahan. Jerawat dan bekasnya semakin membaik berkat saran dokter-dokter Haloskin. Jujur baru kali ini bisa konsultasi dengan dokter kulit secara leluasa dan terbuka, semua pertanyaan tentang jerawatku dijawab secara gamblang.”
                        </p>
                        <p class="uppercase tracking-wide text-xs text-gray-500 mt-3">IZZA AFKARINA MUDMAINAH</p>
                    </div>
                </div>
                <button class="w-fit px-6 py-2 border border-pink-500 text-pink-500 rounded-full text-sm font-semibold hover:bg-pink-50 transition">
                    Dapatkan Solusi Kulit
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-purple-600 mb-2">5+</div>
                <div class="text-gray-600">Anggota Tim</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-purple-600 mb-2">10+</div>
                <div class="text-gray-600">Fitur Utama</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-purple-600 mb-2">100%</div>
                <div class="text-gray-600">Dedikasi</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-purple-600 mb-2">24/7</div>
                <div class="text-gray-600">Support</div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-4 text-gray-800">Siap Untuk Memulai?</h2>
        <p class="text-xl text-gray-600 mb-8">
            Bergabunglah dengan kami dan rasakan pengalaman digital terbaik
        </p>
        <button class="px-8 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition shadow-lg">
            Hubungi Kami Sekarang
        </button>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Tambahkan animasi atau interaksi JavaScript di sini jika diperlukan
    console.log('Homepage Serigala Putih loaded successfully!');
</script>
@endpush
