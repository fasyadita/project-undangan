<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan: {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>

    <!-- Meta SEO dinamis untuk share WhatsApp -->
    <meta property="og:title"
        content="Undangan Pernikahan: {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}" />
    <meta property="og:description"
        content="Kami mengundang Anda untuk menghadiri hari bahagia kami pada {{ $invitation->event_date->translatedFormat('d F Y') }} di {{ $invitation->event_location }}." />
    <meta property="og:type" content="website" />

    <!-- Google Fonts: Great Vibes (for cursive names), Lato (for body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Lato:ital,wght@0,300;0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS v4 -->
    @vite(['resources/css/app.css'])

    <!-- AlpineJS for interactive elements -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .font-cursive {
            font-family: 'Great Vibes', cursive;
        }

        .font-body {
            font-family: 'Lato', sans-serif;
        }

        body {
            /* Light textured background similar to watercolor/marble */
            background-color: #FDF9F6;
            background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');
            color: #5D4037;
            /* Dark brown text */
        }

        .text-brown-dark {
            color: #4E342E;
        }

        .text-brown-light {
            color: #A1887F;
        }

        .text-gold {
            color: #BCAAA4;
        }

        .bg-brown-button {
            background-color: #A38570;
        }

        .bg-brown-button:hover {
            background-color: #8D705C;
        }

        .ring-gold {
            border: 2px solid #D7C4B7;
            padding: 4px;
        }

        /* Asset placeholders - You can replace these URLs with your actual floral assets */
        .floral-top-left {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            transform: scaleY(-1);
            pointer-events: none;
            opacity: 0.9;
            animation: beat-tl 3s infinite ease-in-out;
        }

        .floral-top-right {
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            transform: scale(-1,-1);
            pointer-events: none;
            opacity: 0.9;
            animation: beat-tr 3s infinite ease-in-out;
        }

        .floral-bottom-left {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200px;
            pointer-events: none;
            opacity: 0.9;
            animation: beat-bl 3s infinite ease-in-out;
        }

        .floral-bottom-right {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 200px;
            transform: scaleX(-1);
            pointer-events: none;
            opacity: 0.9;
            animation: beat-br 3s infinite ease-in-out;
        }

        .floral-center-right {
            position: absolute;
            top: 50%;
            right: -20px;
            transform: translateY(-50%);
            width: 120px;
            pointer-events: none;
            animation: beat-cr 3s infinite ease-in-out;
        }

        .floral-event {
            animation: beat-event 3s infinite ease-in-out;
        }

        @keyframes beat-tl {
            0%, 100% { transform: scaleY(-1) scale(1); }
            50% { transform: scaleY(-1) scale(1.05); }
        }
        @keyframes beat-tr {
            0%, 100% { transform: scale(-1, -1) scale(1); }
            50% { transform: scale(-1, -1) scale(1.05); }
        }
        @keyframes beat-bl {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        @keyframes beat-br {
            0%, 100% { transform: scaleX(-1) scale(1); }
            50% { transform: scaleX(-1) scale(1.05); }
        }
        @keyframes beat-cr {
            0%, 100% { transform: translateY(-50%) scale(1); }
            50% { transform: translateY(-50%) scale(1.05); }
        }
        @keyframes beat-event {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.05); }
        }
    </style>
</head>

<body class="font-body antialiased relative min-h-screen"
    x-data="{ openCover: true, isPlaying: false, guestName: '{{ request()->query('to', '') }}', hasUrlName: {{ request()->query('to') ? 'true' : 'false' }} }">

    <!-- BACKGROUND MUSIC -->
    <audio id="bg-music" x-ref="bgMusic" src="{{ asset('audio/wedding.mp3') }}" loop></audio>

    <!-- FLOATING MUSIC BUTTON -->
    <button type="button" x-show="!openCover"
        @click="if (isPlaying) { $refs.bgMusic.pause(); isPlaying = false; } else { $refs.bgMusic.play(); isPlaying = true; }"
        class="fixed bottom-6 right-6 z-40 w-12 h-12 rounded-full bg-brown-button text-white shadow-xl flex items-center justify-center transition-all duration-300">
        <span x-text="isPlaying ? '🎵' : '🔇'" class="text-lg"></span>
    </button>

    <!-- COVER SECTION (MODAL OVERLAY) -->
    <div x-show="openCover" x-transition:leave="transition ease-in duration-700 transform"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-full"
        class="fixed inset-0 z-50 bg-[#FDF9F6] flex flex-col items-center justify-center text-center px-6 relative overflow-hidden"
        style="background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');">

        <!-- Floral Assets (Corner) -->
        <img src="{{ asset('yes.png') }}" onerror="this.src='asset('yes.png')'" alt="Floral"
            class="floral-top-left rounded-br-[100px] shadow-sm mask-image-blur opacity-60 mix-blend-multiply">
        <img src="{{ asset('yes.png') }}" onerror="this.src='asset('yes.png')'" alt="Floral"
            class="floral-top-right rounded-bl-[100px] shadow-sm mask-image-blur opacity-60 mix-blend-multiply">
        <img src="{{ asset('yes.png') }}" onerror="this.src='asset('yes.png')'" alt="Floral"
            class="floral-bottom-left rounded-tr-[100px] shadow-sm mask-image-blur opacity-60 mix-blend-multiply">
        <img src="{{ asset('yes.png') }}" onerror="this.src='asset('yes.png')'" alt="Floral"
            class="floral-bottom-right rounded-tl-[100px] shadow-sm mask-image-blur opacity-60 mix-blend-multiply">

        <h2 class="text-sm font-bold text-brown-dark mb-8 tracking-widest uppercase">Happy Wedding</h2>

        <!-- Central Photo with Ring -->
        <div class="relative w-56 h-56 md:w-64 md:h-64 rounded-full ring-gold mb-6 shadow-xl bg-white p-1">
            <img src="{{ $invitation->groom_photo }}" alt="Couple" class="w-full h-full object-cover rounded-full">
            <!-- Side Floral Decor for Photo -->
            <!-- <img src="{{ asset('yes.png') }}" onerror="this.style.display='none'" alt="Floral Decor"
                class="floral-center-right mix-blend-multiply"> -->
        </div>

        <h1 class="text-6xl md:text-7xl font-cursive text-[#A38570] mb-4 drop-shadow-sm">
            {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
        </h1>

        <div class="text-brown-dark text-sm max-w-sm mb-6 w-full flex flex-col items-center leading-relaxed">
            <p class="mb-6 opacity-80">Tanpa Mengurangi Rasa Hormat, Kami Mengundang Bapak/Ibu/Saudara/i untuk Hadir di
                Acara Kami.</p>

            <p class="mb-1 text-sm opacity-90">Kepada</p>

            <!-- Guest Name -->
            <template x-if="hasUrlName">
                <div class="block text-xl font-bold text-brown-dark mb-6">
                    <span x-text="guestName"></span>
                </div>
            </template>

            <template x-if="!hasUrlName">
                <input type="text" x-model="guestName" placeholder="Ketik Nama Anda..."
                    class="w-full text-center text-lg font-bold text-brown-dark bg-transparent border-b border-[#A38570] focus:outline-none mb-6 pb-1">
            </template>
        </div>

        <button @click="
            openCover = false; 
            $refs.bgMusic.play(); 
            isPlaying = true;
            if (guestName.trim() !== '') {
                fetch('/{{ $invitation->slug }}/visit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name: guestName })
                });
            }
        "
            class="px-8 py-2.5 bg-brown-button text-white font-semibold rounded shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2">
            <i class="fa-solid fa-envelope"></i> Buka Sampul
        </button>
    </div>

    <!-- MAIN BODY CONTENT -->
    <div x-show="!openCover" x-transition:enter="transition ease-out duration-1000 delay-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

        <!-- HERO SECTION -->
        <section
            class="min-h-screen flex flex-col items-center justify-center text-center px-6 relative overflow-hidden py-20">
            <!-- Background Florals inside content -->
            <img src="{{ asset('yes.png') }}"
                onerror="this.src='https://images.unsplash.com/photo-1572451458925-5f65306637d9?w=300&q=80'"
                alt="Floral" class="floral-top-left opacity-30">
            <img src="{{ asset('yes.png') }}"
                onerror="this.src='https://images.unsplash.com/photo-1572451458925-5f65306637d9?w=300&q=80'"
                alt="Floral" class="floral-bottom-right opacity-30">

            <p class="text-sm tracking-widest text-brown-dark font-bold mb-4 uppercase">We Are Getting Married</p>
            <h2 class="text-6xl md:text-8xl font-cursive text-[#A38570] mb-8">
                {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
            </h2>

            <div class="border-t border-b border-[#D7C4B7] py-2 px-8 mb-12">
                <span
                    class="text-lg tracking-widest text-brown-dark font-light">{{ $invitation->event_date->translatedFormat('d . m . Y') }}</span>
            </div>

            <!-- Countdown Timer Widget -->
            <div class="flex gap-4 md:gap-8 justify-center"
                x-data="countdown('{{ $invitation->event_date->format('Y-m-d') }}')">
                <div class="text-center">
                    <span class="block text-3xl font-cursive text-[#A38570]" x-text="days">00</span>
                    <span class="text-[10px] text-brown-dark uppercase tracking-widest font-bold">Hari</span>
                </div>
                <div class="text-center">
                    <span class="block text-3xl font-cursive text-[#A38570]" x-text="hours">00</span>
                    <span class="text-[10px] text-brown-dark uppercase tracking-widest font-bold">Jam</span>
                </div>
                <div class="text-center">
                    <span class="block text-3xl font-cursive text-[#A38570]" x-text="minutes">00</span>
                    <span class="text-[10px] text-brown-dark uppercase tracking-widest font-bold">Menit</span>
                </div>
                <div class="text-center">
                    <span class="block text-3xl font-cursive text-[#A38570]" x-text="seconds">00</span>
                    <span class="text-[10px] text-brown-dark uppercase tracking-widest font-bold">Detik</span>
                </div>
            </div>
        </section>

        <!-- PROFILES -->
        <section class="py-20 px-6 max-w-4xl mx-auto relative z-10">
            <div class="text-center space-y-4 mb-16">
                <p class="font-cursive text-3xl text-[#A38570]">Bismillahirrahmanirrahim</p>
                <p class="text-brown-dark text-sm max-w-xl mx-auto leading-relaxed opacity-80">
                    Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan acara pernikahan
                    putra-putri kami:
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-center gap-12 md:gap-24">
                <!-- Groom -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <div class="w-40 h-40 rounded-full ring-gold p-1 shadow-lg">
                        <img src="{{ $invitation->groom_photo }}" alt="{{ $invitation->groom_name }}"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-4xl font-cursive text-[#A38570]">{{ $invitation->groom_name }}</h3>
                    <p class="text-xs text-brown-dark opacity-70 uppercase tracking-widest">Putra dari</p>
                    <p class="text-sm font-bold text-brown-dark">Bapak {{ $invitation->groom_father }} & Ibu
                        {{ $invitation->groom_mother }}</p>
                </div>

                <!-- Divider -->
                <div class="text-4xl font-cursive text-[#D7C4B7]">&</div>

                <!-- Bride -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <div class="w-40 h-40 rounded-full ring-gold p-1 shadow-lg">
                        <img src="{{ $invitation->bride_photo }}" alt="{{ $invitation->bride_name }}"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-4xl font-cursive text-[#A38570]">{{ $invitation->bride_name }}</h3>
                    <p class="text-xs text-brown-dark opacity-70 uppercase tracking-widest">Putri dari</p>
                    <p class="text-sm font-bold text-brown-dark">Bapak {{ $invitation->bride_father }} & Ibu
                        {{ $invitation->bride_mother }}</p>
                </div>
            </div>
        </section>

        <!-- EVENT DETAILS -->
        <section class="py-20 bg-white px-6 border-y border-[#D7C4B7]/40 relative">
            <img src="{{ asset('yes1.png') }}"
                onerror="this.src='https://images.unsplash.com/photo-1572451458925-5f65306637d9?w=300&q=80'"
                alt="Floral"
                class="floral-event absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 opacity-80 mix-blend-multiply">
<img src="{{ asset('yes.png') }}"
                onerror="this.src='https://images.unsplash.com/photo-1572451458925-5f65306637d9?w=300&q=80'"
                alt="Floral"
                class="floral-event absolute top-0 left-1/2 -translate-x-2/1 -translate-y-2/1 w-32 opacity-80 mix-blend-multiply">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-cursive text-[#A38570] mb-12">Detail Acara</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Akad -->
                    <div class="p-8 border border-[#D7C4B7] rounded-lg relative bg-[#FDF9F6]">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#FDF9F6] px-4">
                            <i class="fa-solid fa-ring text-[#A38570] text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-brown-dark mb-4 tracking-widest uppercase">Akad Nikah</h3>
                        <p class="text-sm text-brown-dark mb-2">
                            {{ $invitation->event_date->translatedFormat('l, d F Y') }}</p>
                        <p class="text-sm text-brown-dark mb-4 font-bold">{{ $invitation->event_time }}</p>
                        <p class="text-xs text-brown-dark opacity-80 leading-relaxed">{{ $invitation->event_address }}
                        </p>
                    </div>

                    <!-- Resepsi -->
                    <div class="p-8 border border-[#D7C4B7] rounded-lg relative bg-[#FDF9F6]">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#FDF9F6] px-4">
                            <i class="fa-solid fa-champagne-glasses text-[#A38570] text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-brown-dark mb-4 tracking-widest uppercase">Resepsi</h3>
                        <p class="text-sm text-brown-dark mb-2">
                            {{ $invitation->event_date->translatedFormat('l, d F Y') }}</p>
                        <p class="text-sm text-brown-dark mb-4 font-bold">11:00 WIB - Selesai</p>
                        <p class="text-sm font-bold text-brown-dark mb-1">{{ $invitation->event_location }}</p>
                        <p class="text-xs text-brown-dark opacity-80 leading-relaxed">{{ $invitation->event_address }}
                        </p>
                    </div>
                </div>

                @if ($invitation->event_map_url)
                    <div class="mt-12">
                        <a href="{{ $invitation->event_map_url }}" target="_blank"
                            class="inline-block px-8 py-3 bg-brown-button text-white font-semibold rounded shadow-md hover:bg-[#8D705C] transition-all">
                            <i class="fa-solid fa-map-location-dot mr-2"></i> Buka Google Maps
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- RSVP & WISHES -->
        <section class="py-20 px-6 max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-cursive text-[#A38570] mb-2">RSVP & Ucapan</h2>
                <p class="text-sm text-brown-dark opacity-70">Kehadiran dan doa restu Anda sangat berarti bagi kami.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- RSVP Form -->
                <div class="bg-white p-8 border border-[#D7C4B7] rounded-lg shadow-sm">
                    @if (session('rsvp_success'))
                        <div class="mb-6 p-4 bg-[#F3EBE1] text-brown-dark text-sm rounded border border-[#D7C4B7]">
                            {{ session('rsvp_success') }}
                        </div>
                    @endif

                    <form action="/{{ $invitation->slug }}/rsvp" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <input type="text" name="name" x-model="guestName" required placeholder="Nama Lengkap"
                                class="w-full px-4 py-3 bg-[#FDF9F6] border border-[#D7C4B7] rounded focus:outline-none focus:border-[#A38570] text-sm text-brown-dark">
                        </div>
                        <div>
                            <select name="is_present" required
                                class="w-full px-4 py-3 bg-[#FDF9F6] border border-[#D7C4B7] rounded focus:outline-none focus:border-[#A38570] text-sm text-brown-dark">
                                <option value="" disabled selected>Apakah Anda akan hadir?</option>
                                <option value="1">Ya, Saya Hadir</option>
                                <option value="0">Maaf, Tidak Bisa Hadir</option>
                            </select>
                        </div>
                        <div>
                            <select name="guest_count" required
                                class="w-full px-4 py-3 bg-[#FDF9F6] border border-[#D7C4B7] rounded focus:outline-none focus:border-[#A38570] text-sm text-brown-dark">
                                <option value="" disabled selected>Jumlah Kehadiran</option>
                                <option value="1">1 Orang</option>
                                <option value="2">2 Orang</option>
                                <option value="3">3 Orang</option>
                            </select>
                        </div>
                        <div>
                            <textarea name="wish" rows="4" placeholder="Berikan ucapan & doa restu..."
                                class="w-full px-4 py-3 bg-[#FDF9F6] border border-[#D7C4B7] rounded focus:outline-none focus:border-[#A38570] text-sm text-brown-dark"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full py-3 bg-brown-button text-white font-semibold rounded shadow-md hover:bg-[#8D705C] transition-all">
                            Kirim RSVP
                        </button>
                    </form>
                </div>

                <!-- Wishes -->
                <div class="bg-[#FDF9F6] p-8 border border-[#D7C4B7] rounded-lg shadow-sm h-[500px] flex flex-col">
                    <h3
                        class="text-xl font-bold text-brown-dark mb-6 tracking-widest uppercase text-center border-b border-[#D7C4B7] pb-4">
                        Doa & Ucapan</h3>
                    <div class="overflow-y-auto flex-1 space-y-4 pr-2">
                        @if($invitation->guests->isEmpty())
                            <p class="text-center text-sm text-brown-dark opacity-60 mt-10">Belum ada ucapan.</p>
                        @else
                            @foreach ($invitation->guests as $guest)
                                <div class="p-4 bg-white rounded border border-[#D7C4B7]/50 shadow-sm">
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-sm text-brown-dark">{{ $guest->name }}</h5>
                                        <span
                                            class="text-[10px] px-2 py-1 rounded-full {{ $guest->is_present ? 'bg-[#EFE7DC] text-[#4E342E]' : 'bg-red-50 text-red-600' }}">
                                            {{ $guest->is_present ? 'Hadir' : 'Absen' }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-brown-dark opacity-80 italic">"{{ $guest->wish }}"</p>
                                    <p class="text-[10px] text-right mt-2 text-brown-dark opacity-50">
                                        {{ $guest->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="py-12 text-center bg-[#4E342E] text-[#FDF9F6]">
            <h2 class="text-3xl font-cursive mb-2">{{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
            </h2>
            <p class="text-xs opacity-70 mb-8">Terima kasih atas segala doa restu Anda.</p>
            <p class="text-[10px] opacity-50">Dibuat dengan ❤️ oleh WeddingKita</p>
        </footer>
    </div>

    <script>
        function countdown(dateString) {
            return {
                targetDate: new Date(dateString).getTime(),
                days: '00', hours: '00', minutes: '00', seconds: '00',
                init() {
                    const updateCountdown = () => {
                        const now = new Date().getTime();
                        const distance = this.targetDate - now;
                        if (distance < 0) return;
                        this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                        this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                        this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                        this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                    };
                    updateCountdown();
                    setInterval(updateCountdown, 1000);
                }
            }
        }
    </script>
</body>

</html>