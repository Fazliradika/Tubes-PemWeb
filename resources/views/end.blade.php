<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Terima Kasih — HealthFirst Medical</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- App CSS/JS (Tailwind via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --end-bg: #0b1120;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background: var(--end-bg);
        }

        /* Scroll container */
        .end-scroll {
            height: 100vh;
            overflow-y: auto;
            scroll-snap-type: y mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .end-section {
            scroll-snap-align: start;
            scroll-snap-stop: always;
        }

        /* Smooth section transitions */
        .reveal {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 800ms ease, transform 800ms ease;
        }

        .is-active .reveal {
            opacity: 1;
            transform: translateY(0);
        }

        /* Subtle background glow using existing palette (no new hard-coded colors beyond neutrals & blue) */
        .bg-glow {
            background:
                radial-gradient(800px 400px at 20% 20%, rgba(59, 130, 246, 0.25), transparent 60%),
                radial-gradient(700px 350px at 80% 30%, rgba(59, 130, 246, 0.18), transparent 60%),
                linear-gradient(180deg, rgba(15, 23, 42, 0.92), rgba(2, 6, 23, 1));
        }

        /* Image frame */
        .img-frame {
            border: 1px solid rgba(148, 163, 184, 0.25);
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Minimal helper for hover easter egg */
        .egg {
            position: relative;
            cursor: default;
        }

        .egg .egg-reveal {
            opacity: 0;
            transform: translateY(4px);
            transition: opacity 250ms ease, transform 250ms ease;
        }

        .egg:hover .egg-reveal {
            opacity: 1;
            transform: translateY(0);
        }

        /* Respect reduced-motion */
        @media (prefers-reduced-motion: reduce) {
            .end-scroll {
                scroll-behavior: auto;
            }

            .reveal {
                transition: none;
                opacity: 1;
                transform: none;
            }
        }
    </style>
</head>

<body class="font-sans antialiased text-slate-100">
    @php
        $assets = [
            'first_commit' => asset('media/end/first-commit.png'),
            'last_commit' => asset('media/end/last-commit.png'),
            'group_chat' => asset('media/end/serigala-putih-chat.png'),
            'lecturer_photo' => asset('media/end/dosen.png'),
        ];

        $team = [
            [
                'name' => 'Muhammad Rafadi Kurniawan',
                'nim' => '103062300089',
                'role' => '',
                'photo' => asset('media/end/team/Rafadi.png'),
                'quote' => '',
            ],
            [
                'name' => 'Naufal Saifullah Yusuf',
                'nim' => '103062300091',
                'role' => '',
                'photo' => asset('media/end/team/Yusuf.png'),
                'quote' => '',
            ],
            [
                'name' => 'Fazli Radika',
                'nim' => '103062300092',
                'role' => '',
                'photo' => asset('media/end/team/Fazli.png'),
                'quote' => '',
            ],
            [
                'name' => 'Muhammad Afriza Hidayat',
                'nim' => '103062300093',
                'role' => '',
                'photo' => asset('media/end/team/Afriza.png'),
                'quote' => '',
            ],
            [
                'name' => 'Aldyansyah Wisnu Saputra',
                'nim' => '103062300100',
                'role' => '',
                'photo' => asset('media/end/team/Aldy.png'),
                'quote' => '',
            ],
        ];
    @endphp

    <!-- YouTube audio (autoplay best-effort; with sound requires user gesture) -->
    <div id="end-yt" class="sr-only" aria-hidden="true"></div>

    <div id="end-scroll" class="end-scroll bg-glow">
        <!-- Section 1: Opening -->
        <section class="end-section min-h-screen flex items-center">
            <div class="mx-auto w-full max-w-6xl px-6 py-16">
                <div class="reveal">
                    <p class="text-sm uppercase tracking-widest text-slate-300">22 Desember 2025</p>
                    <h1 class="mt-3 text-4xl sm:text-5xl font-bold leading-tight text-white">
                        Halaman Perpisahan
                        <span class="block text-blue-400">HealthFirst Medical</span>
                    </h1>
                    <p class="mt-6 max-w-2xl text-slate-300 text-lg leading-relaxed">
                        Ini bukan akhir dari proyek—ini penutup dari perjalanan. Terima kasih untuk setiap revisi,
                        setiap debug, setiap "bentar lagi kelar".
                    </p>

                    <p class="mt-4 text-slate-300">
                        <span class="font-semibold text-white">Kelompok Serigala Putih</span> —
                        Tugas Besar Pemrograman Web, Universitas Telkom.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row gap-3">
                        <button id="end-start" type="button"
                            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Mulai Perjalanan (Aktifkan Suara)
                        </button>
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-700 px-6 py-3 font-semibold text-slate-200 hover:bg-slate-800/60">
                            Kembali ke Beranda
                        </a>
                    </div>

                    <div class="mt-10 text-sm text-slate-400">
                        Auto-scroll akan berjalan pelan dari section ke section.
                        <span class="egg ml-2 inline-flex items-center gap-2">
                            (hover di sini)
                            <span class="egg-reveal text-slate-200">— pesan rahasia: <span class="font-semibold text-blue-300">kalian hebat.</span></span>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Group chat screenshot -->
        <section class="end-section min-h-screen flex items-center">
            <div class="mx-auto w-full max-w-6xl px-6 py-16">
                <div class="reveal grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-slate-300">Awal Mula</p>
                        <h2 class="mt-3 text-3xl sm:text-4xl font-bold text-white">"Serigala Putih"</h2>
                        <p class="mt-5 text-slate-300 leading-relaxed">
                            Screenshot percakapan saat kita mulai ngerjain proyek ini.
                            Di situ, semuanya masih terasa sederhana… sampai akhirnya jadi cerita panjang.
                        </p>
                        <p class="mt-4 text-sm text-slate-400">
                            Taruh file gambar di <span class="font-mono">public/media/end/serigala-putih-chat.png</span>
                        </p>
                    </div>

                    <div class="img-frame rounded-2xl p-3">
                        <img id="img-group-chat" src="{{ $assets['group_chat'] }}" alt="Screenshot grup Serigala Putih"
                            class="w-full rounded-xl object-cover" loading="lazy">
                        <div id="img-group-chat-fallback" class="hidden p-6 text-slate-300">
                            <p class="font-semibold text-white">Gambar belum ditemukan.</p>
                            <p class="mt-1 text-sm">Pastikan file ada di <span class="font-mono">public/media/end/serigala-putih-chat.png</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: First commit screenshot -->
        <section class="end-section min-h-screen flex items-center">
            <div class="mx-auto w-full max-w-6xl px-6 py-16">
                <div class="reveal grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-slate-300">Jejak Pertama</p>
                        <h2 class="mt-3 text-3xl sm:text-4xl font-bold text-white">First Commit</h2>
                        <p class="mt-5 text-slate-300 leading-relaxed">
                            Di commit pertama, kita belum tahu semua rintangan. Tapi kita mulai.
                            Dan itu yang paling penting.
                        </p>
                        <p class="mt-4 text-sm text-slate-400">
                            Taruh file gambar di <span class="font-mono">public/media/end/first-commit.png</span>
                        </p>
                    </div>

                    <div class="img-frame rounded-2xl p-3">
                        <img id="img-first-commit" src="{{ $assets['first_commit'] }}" alt="Screenshot first commit"
                            class="w-full rounded-xl object-cover" loading="lazy">
                        <div id="img-first-commit-fallback" class="hidden p-6 text-slate-300">
                            <p class="font-semibold text-white">Gambar belum ditemukan.</p>
                            <p class="mt-1 text-sm">Pastikan file ada di <span class="font-mono">public/media/end/first-commit.png</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Last commit screenshot -->
        <section class="end-section min-h-screen flex items-center">
            <div class="mx-auto w-full max-w-6xl px-6 py-16">
                <div class="reveal grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-slate-300">Jejak Terakhir</p>
                        <h2 class="mt-3 text-3xl sm:text-4xl font-bold text-white">Last Commit</h2>
                        <p class="mt-5 text-slate-300 leading-relaxed">
                            Ini bukan sekadar "selesai". Ini bukti kita bertahan sampai final.
                        </p>
                        <p class="mt-4 text-sm text-slate-400">
                            Taruh file gambar di <span class="font-mono">public/media/end/last-commit.png</span>
                        </p>
                    </div>

                    <div class="img-frame rounded-2xl p-3">
                        <img id="img-last-commit" src="{{ $assets['last_commit'] }}" alt="Screenshot last commit"
                            class="w-full rounded-xl object-cover" loading="lazy">
                        <div id="img-last-commit-fallback" class="hidden p-6 text-slate-300">
                            <p class="font-semibold text-white">Gambar belum ditemukan.</p>
                            <p class="mt-1 text-sm">Pastikan file ada di <span class="font-mono">public/media/end/last-commit.png</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 5: Team bios -->
        <section class="end-section min-h-screen flex items-center">
            <div class="mx-auto w-full max-w-6xl px-6 py-16">
                <div class="reveal">
                    <p class="text-sm uppercase tracking-widest text-slate-300">Orang-Orang di Balik Layar</p>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-bold text-white">Tim Pengembang</h2>
                    <p class="mt-3 text-slate-300">Kelompok <span class="font-semibold text-white">Serigala Putih</span></p>

                    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($team as $member)
                            <div class="rounded-2xl border border-slate-700/60 bg-slate-900/60 backdrop-blur p-6">
                                <div class="flex items-start gap-4">
                                    <div class="shrink-0">
                                        <img src="{{ $member['photo'] }}" alt="Foto {{ $member['name'] }}"
                                            class="h-16 w-16 rounded-xl object-cover border border-slate-700/60">
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-lg font-semibold text-white truncate">{{ $member['name'] }}</p>
                                        <p class="text-sm text-slate-300">NIM: <span class="text-white">{{ $member['nim'] }}</span></p>
                                        <p class="text-sm text-blue-300">Peran: <span class="text-slate-200">{{ $member['role'] !== '' ? $member['role'] : '—' }}</span></p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between">
                                    <div class="egg text-xs text-slate-400">
                                        hover
                                        <div class="egg-reveal mt-1">
                                            <span class="rounded-lg border border-slate-700 bg-slate-950/40 px-2 py-1 text-slate-200">terima kasih sudah berjuang bareng.</span>
                                        </div>
                                    </div>
                                </div>

                                @if (($member['quote'] ?? '') !== '')
                                    <div class="mt-4 rounded-xl border border-slate-700/60 bg-slate-950/30 p-4">
                                        <p class="text-sm text-slate-200">{!! e($member['quote']) !!}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <p class="mt-8 text-sm text-slate-400">
                        Proyek ini dibuat untuk <span class="text-slate-200">Tugas Besar Pemrograman Web</span> — Universitas Telkom.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 6: Lecturer + thanks -->
        <section class="end-section min-h-screen flex items-center">
            <div class="mx-auto w-full max-w-6xl px-6 py-16">
                <div class="reveal grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-slate-300">Penghargaan</p>
                        <h2 class="mt-3 text-3xl sm:text-4xl font-bold text-white">Terima Kasih, Dosen</h2>
                        <p class="mt-2 text-slate-300">
                            <span class="font-semibold text-white">Zuki Pristiantoro Putro, S.T., M.M.S.I</span>
                            <span class="text-slate-400">— Dosen Mata Kuliah Pemrograman Website</span>
                        </p>
                        <p class="mt-5 text-slate-300 leading-relaxed">
                            Terima kasih atas arahan, koreksi, masukan, dan kesabaran selama satu semester ini.
                            Proyek ini menjadi lebih terarah karena bimbingan dan evaluasi yang diberikan.
                        </p>
                        <p class="mt-5 text-slate-300 leading-relaxed">
                            Kami juga memohon maaf sebesar-besarnya apabila selama perkuliahan maupun pengerjaan tugas
                            terdapat tutur kata, sikap, atau hal-hal yang kurang berkenan.
                        </p>
                        <p class="mt-6 text-slate-300 leading-relaxed">
                            Dan untuk tim…
                            <span class="text-white font-semibold">kalian bukan cuma teman sekelompok,</span>
                            tapi teman seperjalanan.
                        </p>

                        <div class="mt-10 rounded-2xl border border-slate-700/60 bg-slate-900/60 backdrop-blur p-6">
                            <p class="text-sm uppercase tracking-widest text-slate-300">Easter Egg</p>
                            <p class="mt-2 text-slate-200 egg">
                                Arahkan kursor ke kalimat ini.
                                <span class="egg-reveal block mt-2 text-blue-300 font-semibold">
                                    Kalau kamu baca ini: semoga kita ketemu lagi di proyek yang lebih besar.
                                </span>
                            </p>
                        </div>

                        <p class="mt-6 text-sm text-slate-400">
                            Foto dosen tersimpan di <span class="font-mono">public/media/end/dosen.png</span>
                        </p>
                    </div>

                    <div class="img-frame rounded-2xl p-3">
                        <img id="img-lecturer" src="{{ $assets['lecturer_photo'] }}" alt="Foto dosen"
                            class="w-full rounded-xl object-cover" loading="lazy">
                        <div id="img-lecturer-fallback" class="hidden p-6 text-slate-300">
                            <p class="font-semibold text-white">Foto dosen belum ditemukan.</p>
                            <p class="mt-1 text-sm">Pastikan file ada di <span class="font-mono">public/media/end/dosen.jpg</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 7: Closing -->
        <section class="end-section min-h-screen flex items-center">
            <div class="mx-auto w-full max-w-6xl px-6 py-16">
                <div class="reveal">
                    <p class="text-sm uppercase tracking-widest text-slate-300">Akhir</p>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-bold text-white">Sampai Jumpa</h2>
                    <p class="mt-6 max-w-3xl text-slate-300 leading-relaxed">
                        Terima kasih sudah berjalan bareng sampai sini. Semoga lelahnya jadi cerita,
                        dan ceritanya jadi bekal.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row gap-3">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-500">
                            Kembali ke Beranda
                        </a>
                        <button id="end-replay" type="button"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-700 px-6 py-3 font-semibold text-slate-200 hover:bg-slate-800/60">
                            Putar Ulang Auto-Scroll
                        </button>
                    </div>

                    <p class="mt-10 text-xs text-slate-400">
                        Musik diputar dari YouTube (autoplay best-effort). Jika suaranya belum keluar,
                        klik tombol <span class="text-slate-200">Mulai Perjalanan</span> untuk mengaktifkan suara.
                    </p>
                </div>
            </div>
        </section>
    </div>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        (function () {
            const scrollEl = document.getElementById('end-scroll');
            const sections = Array.from(scrollEl.querySelectorAll('.end-section'));
            const startBtn = document.getElementById('end-start');
            const replayBtn = document.getElementById('end-replay');

            const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            // YouTube Player
            const YT_VIDEO_ID = '13ARO0HDZsQ';
            let ytPlayer = null;
            let ytReady = false;

            const imgFallback = (imgId, fallbackId) => {
                const img = document.getElementById(imgId);
                const fallback = document.getElementById(fallbackId);
                if (!img || !fallback) return;

                img.addEventListener('error', () => {
                    img.classList.add('hidden');
                    fallback.classList.remove('hidden');
                }, { once: true });
            };

            imgFallback('img-group-chat', 'img-group-chat-fallback');
            imgFallback('img-first-commit', 'img-first-commit-fallback');
            imgFallback('img-last-commit', 'img-last-commit-fallback');
            imgFallback('img-lecturer', 'img-lecturer-fallback');

            // Reveal animation via IntersectionObserver
            const io = new IntersectionObserver((entries) => {
                for (const entry of entries) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-active');
                    }
                }
            }, { root: scrollEl, threshold: 0.45 });

            sections.forEach((s) => io.observe(s));

            // Auto-scroll controller
            let currentIndex = 0;
            let timer = null;
            let pauseUntil = 0;

            const scrollToIndex = (index) => {
                const target = sections[index];
                if (!target) return;
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                currentIndex = index;
            };

            const stopAuto = () => {
                if (timer) {
                    clearInterval(timer);
                    timer = null;
                }
            };

            const startAuto = () => {
                stopAuto();
                timer = setInterval(() => {
                    if (Date.now() < pauseUntil) return;
                    const next = (currentIndex + 1) % sections.length;
                    scrollToIndex(next);
                }, 8500);
            };

            // Detect manual interaction -> pause auto-scroll briefly (so it doesn't fight the user)
            const pauseFor = (ms) => {
                pauseUntil = Date.now() + ms;
            };

            ['wheel', 'touchstart', 'keydown', 'pointerdown'].forEach((evt) => {
                scrollEl.addEventListener(evt, () => pauseFor(20000), { passive: true });
            });

            // Keep index in sync with scroll position
            const syncIndex = () => {
                const viewportTop = scrollEl.getBoundingClientRect().top;
                let bestIdx = 0;
                let bestDist = Number.POSITIVE_INFINITY;
                sections.forEach((s, idx) => {
                    const r = s.getBoundingClientRect();
                    const dist = Math.abs((r.top - viewportTop));
                    if (dist < bestDist) {
                        bestDist = dist;
                        bestIdx = idx;
                    }
                });
                currentIndex = bestIdx;
            };

            scrollEl.addEventListener('scroll', () => {
                window.requestAnimationFrame(syncIndex);
            }, { passive: true });

            // User gesture: enable sound + start scrolling
            const enableSound = () => {
                if (!ytReady || !ytPlayer) return;
                try {
                    ytPlayer.unMute();
                    ytPlayer.setVolume(65);
                    ytPlayer.playVideo();
                } catch (e) {
                    // Ignore
                }
            };

            startBtn?.addEventListener('click', () => {
                enableSound();
                if (!prefersReducedMotion) startAuto();
                scrollToIndex(1);
            });

            replayBtn?.addEventListener('click', () => {
                pauseUntil = 0;
                if (!prefersReducedMotion) startAuto();
                scrollToIndex(0);
            });

            // On load: reveal first section + try autoplay quietly
            window.addEventListener('load', async () => {
                sections[0]?.classList.add('is-active');

                // Auto-start scrolling (best-effort); pause when user interacts
                if (!prefersReducedMotion) {
                    startAuto();
                    setTimeout(() => {
                        if (Date.now() >= pauseUntil) scrollToIndex(1);
                    }, 2500);
                }
            });

            // YouTube IFrame API hook (must be global)
            window.onYouTubeIframeAPIReady = function () {
                ytPlayer = new YT.Player('end-yt', {
                    height: '0',
                    width: '0',
                    videoId: YT_VIDEO_ID,
                    playerVars: {
                        autoplay: 1,
                        controls: 0,
                        rel: 0,
                        modestbranding: 1,
                        playsinline: 1,
                        loop: 1,
                        playlist: YT_VIDEO_ID,
                    },
                    events: {
                        onReady: function () {
                            ytReady = true;
                            try {
                                // Autoplay best-effort (muted)
                                ytPlayer.mute();
                                ytPlayer.playVideo();
                            } catch (e) {
                                // Ignore
                            }
                        },
                    },
                });
            };
        })();
    </script>
</body>

</html>
