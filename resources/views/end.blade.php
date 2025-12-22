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

        /* Team W silhouette layout */
        .w-team {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .w-team {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .w-team {
                grid-template-columns: repeat(6, minmax(0, 1fr));
                align-items: stretch;
            }

            .w-pos-1 {
                grid-column: 1 / span 2;
                grid-row: 1;
            }

            .w-pos-3 {
                grid-column: 3 / span 2;
                grid-row: 1;
            }

            .w-pos-5 {
                grid-column: 5 / span 2;
                grid-row: 1;
            }

            .w-pos-2 {
                grid-column: 2 / span 2;
                grid-row: 2;
            }

            .w-pos-4 {
                grid-column: 4 / span 2;
                grid-row: 2;
            }
        }

        /* Minimal helper for hover easter egg */
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
            'rafadi' => [
                'name' => 'Muhammad Rafadi Kurniawan',
                'nim' => '103062300089',
                'role' => 'AI & ML Engineer',
                'photo' => asset('media/end/team/Rafadi.png'),
            ],
            'yusuf' => [
                'name' => 'Naufal Saifullah Yusuf',
                'nim' => '103062300091',
                'role' => 'UI/UX Designer & Frontend Developer',
                'photo' => asset('media/end/team/Yusuf.png'),
            ],
            // Fazli harus di posisi (3)
            'fazli' => [
                'name' => 'Fazli Radika',
                'nim' => '103062300092',
                'role' => 'Project Manager & Backend Developer',
                'photo' => asset('media/end/team/Fazli.png'),
            ],
            'afriza' => [
                'name' => 'Muhammad Afriza Hidayat',
                'nim' => '103062300093',
                'role' => 'QA Tester & System Integration',
                'photo' => asset('media/end/team/Afriza.png'),
            ],
            'aldy' => [
                'name' => 'Aldyansyah Wisnu Saputra',
                'nim' => '103062300100',
                'role' => 'Medical Content Specialist & Research',
                'photo' => asset('media/end/team/Aldy.png'),
            ],
        ];

        // W silhouette placement (1,3,5 top row; 2,4 bottom row)
        $teamW = [
            1 => $team['rafadi'],
            2 => $team['yusuf'],
            3 => $team['fazli'],
            4 => $team['afriza'],
            5 => $team['aldy'],
        ];
    @endphp

    <!-- YouTube audio (autoplay best-effort; with sound requires user gesture) -->
    <div id="end-yt" aria-hidden="true" style="position: fixed; width: 1px; height: 1px; left: -9999px; top: -9999px; opacity: 0; pointer-events: none;"></div>

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
                        Halaman ini akan otomatis scroll per bagian (±6 detik per section).
                        Suara YouTube akan aktif setelah kamu klik/ketuk sekali di mana saja (aturan browser).
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

                    <div class="mt-10 w-team">
                        @foreach ($teamW as $pos => $member)
                            <div class="w-pos-{{ $pos }} rounded-2xl border border-slate-700/60 bg-slate-900/60 backdrop-blur p-6">
                                <div class="flex items-start gap-4">
                                    <div class="shrink-0">
                                        <img src="{{ $member['photo'] }}" alt="Foto {{ $member['name'] }}"
                                            class="h-16 w-16 rounded-xl object-cover border border-slate-700/60">
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-lg font-semibold text-white">{{ $member['name'] }}</p>
                                        <p class="text-sm text-slate-300">NIM: <span class="text-white">{{ $member['nim'] }}</span></p>
                                        <p class="text-sm text-blue-300">Peran: <span class="text-slate-200">{{ $member['role'] }}</span></p>
                                    </div>
                                </div>
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
                    </div>

                    <div class="img-frame rounded-2xl p-3">
                        <img id="img-lecturer" src="{{ $assets['lecturer_photo'] }}" alt="Foto dosen"
                            class="w-full rounded-xl object-cover" loading="lazy">
                        <div id="img-lecturer-fallback" class="hidden p-6 text-slate-300">
                            <p class="font-semibold text-white">Foto dosen belum ditemukan.</p>
                            <p class="mt-1 text-sm">Pastikan file ada di <span class="font-mono">public/media/end/dosen.png</span></p>
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
                        Musik diputar dari YouTube (autoplay best-effort).
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
            let wantsSound = true;

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

                // Scroll inside the container explicitly (more reliable than scrollIntoView for nested scroll containers)
                const containerTop = scrollEl.getBoundingClientRect().top;
                const targetTop = target.getBoundingClientRect().top;
                const nextTop = (targetTop - containerTop) + scrollEl.scrollTop;
                scrollEl.scrollTo({ top: nextTop, behavior: 'smooth' });
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
                }, 6000);
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
                wantsSound = true;
                if (!ytReady || !ytPlayer) return;
                try {
                    ytPlayer.unMute();
                    ytPlayer.setVolume(65);
                    ytPlayer.playVideo();
                } catch (e) {
                    // Ignore
                }
            };

            // Provide a button to re-trigger sound + continue scrolling
            startBtn?.addEventListener('click', () => {
                enableSound();
                if (!prefersReducedMotion) {
                    pauseUntil = 0;
                    startAuto();
                }
                scrollToIndex(1);
            });

            replayBtn?.addEventListener('click', () => {
                pauseUntil = 0;
                if (!prefersReducedMotion) startAuto();
                scrollToIndex(0);
            });

            // Also try enabling sound on first interaction anywhere (helps when autoplay is blocked)
            const enableSoundOnce = () => enableSound();
            document.addEventListener('pointerdown', enableSoundOnce, { once: true, passive: true });
            document.addEventListener('touchstart', enableSoundOnce, { once: true, passive: true });
            document.addEventListener('keydown', enableSoundOnce, { once: true });

            // On load: reveal first section + try autoplay quietly
            window.addEventListener('load', async () => {
                sections[0]?.classList.add('is-active');

                // Auto-start scrolling (best-effort); pause when user interacts
                if (!prefersReducedMotion) {
                    startAuto();
                    setTimeout(() => {
                        if (Date.now() >= pauseUntil) scrollToIndex(1);
                    }, 900);
                }

                // Try to start audio with sound immediately (may be blocked by browser policy)
                enableSound();
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
                        origin: window.location.origin,
                    },
                    events: {
                        onReady: function () {
                            ytReady = true;
                            try {
                                // Autoplay best-effort (try with sound)
                                if (wantsSound) {
                                    ytPlayer.unMute();
                                    ytPlayer.setVolume(65);
                                }
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
