<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan: {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    
    <!-- Meta SEO dinamis untuk share WhatsApp -->
    <meta property="og:title" content="Undangan Pernikahan: {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}" />
    <meta property="og:description" content="Kami mengundang Anda untuk menghadiri hari bahagia kami pada {{ $invitation->event_date->translatedFormat('d F Y') }} di {{ $invitation->event_location }}." />
    <meta property="og:type" content="website" />
    
    <!-- Google Fonts: Playfair Display & Instrument Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..900;1,400..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS v4 -->
    @vite(['resources/css/app.css'])
    
    <!-- AlpineJS for interactive elements (music, cover modal) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .font-serif-luxury {
            font-family: 'Playfair Display', Georgia, serif;
        }
        .font-sans-modern {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
        }
        .bg-rustic-dark {
            background-color: #4A2E26; /* Deep Espresso Brown */
        }
        .bg-rustic-medium {
            background-color: #6E473B; /* Warm Terracotta Chocolate */
        }
        .border-gold-accent {
            border-color: #D4A373; /* Antique Gold Accent */
        }
        .text-gold-accent {
            color: #D4A373;
        }
        .bg-gold-accent {
            background-color: #D4A373;
        }
    </style>
</head>
<body class="bg-[#F9F3EB] font-sans-modern text-[#3E251E]" x-data="{ openCover: true, isPlaying: false, guestName: '{{ request()->query('to', '') }}', hasUrlName: {{ request()->query('to') ? 'true' : 'false' }} }">
 
    <!-- BACKGROUND MUSIC -->
    <audio id="bg-music" x-ref="bgMusic" src="{{ $invitation->music_url }}" loop></audio>
 
    <!-- FLOATING MUSIC BUTTON -->
    <button type="button" x-show="!openCover" @click="if (isPlaying) { $refs.bgMusic.pause(); isPlaying = false; } else { $refs.bgMusic.play(); isPlaying = true; }" 
            class="fixed bottom-6 right-6 z-40 w-12 h-12 rounded-full bg-[#6E473B] text-[#F9F3EB] border border-[#D4A373] shadow-xl flex items-center justify-center animate-bounce transition-all duration-300">
        <span x-text="isPlaying ? '🎵' : '🔇'" class="text-lg"></span>
    </button>
 
    <!-- COVER SECTION (MODAL OVERLAY) -->
    <div x-show="openCover" x-transition:leave="transition ease-in duration-500 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
         class="fixed inset-0 z-50 bg-[#4A2E26] flex flex-col items-center justify-center text-center px-6 relative overflow-hidden">
        
        <!-- Warm Gold decorative borders -->
        <div class="absolute inset-4 border border-[#D4A373]/30 rounded-2xl -z-10 pointer-events-none"></div>
        <div class="absolute inset-8 border-2 border-[#D4A373]/10 rounded-2xl -z-10 pointer-events-none"></div>
        
        <!-- Subtle leaf overlay decoration in corners -->
        <div class="absolute top-0 left-0 w-24 h-24 md:w-32 md:h-32 opacity-10 bg-[radial-gradient(circle_at_top_left,_var(--tw-gradient-stops))] from-[#D4A373] to-transparent pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-24 h-24 md:w-32 md:h-32 opacity-10 bg-[radial-gradient(circle_at_bottom_right,_var(--tw-gradient-stops))] from-[#D4A373] to-transparent pointer-events-none"></div>
        
        <p class="text-xs uppercase tracking-widest text-[#F9F3EB]/70 mb-4 font-semibold">The Wedding Celebration</p>
        <h1 class="text-5xl md:text-7xl font-serif-luxury text-[#F9F3EB] leading-none mb-6">
            {{ $invitation->groom_nickname }} <span class="text-2xl font-sans-modern block my-2 text-[#D4A373] font-bold">&</span> {{ $invitation->bride_nickname }}
        </h1>
        
        <div class="text-[#F9F3EB]/70 text-sm max-w-md mb-8 w-full flex flex-col items-center">
            <p class="mb-2">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            
            <!-- Jika link URL berisi ?to=NamaTamu -->
            <template x-if="hasUrlName">
                <div class="block text-lg font-bold text-[#3E251E] mt-2 bg-[#F9F3EB] px-6 py-3 rounded-xl border border-[#D4A373]/30 w-full max-w-xs shadow-md">
                    <span x-text="guestName"></span>
                </div>
            </template>

            <!-- Jika tidak ada ?to= di URL (tamu bisa ketik sendiri namanya) -->
            <template x-if="!hasUrlName">
                <input type="text" x-model="guestName" placeholder="Ketik Nama Anda Di Sini..." 
                       class="w-full text-center text-md font-bold text-[#3E251E] bg-[#F9F3EB] px-6 py-3.5 rounded-xl border border-[#D4A373]/30 focus:outline-none focus:ring-2 focus:ring-[#D4A373] max-w-xs shadow-md placeholder-stone-400">
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
                class="px-8 py-3.5 bg-[#D4A373] hover:bg-[#c39262] text-white font-extrabold rounded-full shadow-lg shadow-amber-950/40 hover:scale-105 active:scale-95 transition-all duration-300">
            🍁 Buka Undangan
        </button>
    </div>

    <!-- MAIN BODY CONTENT -->
    <div x-show="!openCover" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
        
        <!-- HERO / HOME SECTION -->
        <section class="min-h-screen bg-[#6E473B] text-white flex flex-col items-center justify-center text-center px-6 relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-[#3E251E] via-[#6E473B] to-[#2B1713] opacity-75"></div>
            
            <p class="text-xs uppercase tracking-widest text-[#D4A373] font-bold mb-4 relative z-10">We Are Getting Married</p>
            <h2 class="text-5xl md:text-8xl font-serif-luxury text-[#F9F3EB] relative z-10 leading-tight mb-8">
                {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
            </h2>
            
            <div class="relative z-10 border border-[#D4A373]/40 px-8 py-3 rounded-full bg-[#3E251E]/40 backdrop-blur-sm text-sm tracking-wide">
                {{ $invitation->event_date->translatedFormat('d F Y') }}
            </div>

            <!-- Countdown Timer Widget -->
            <div class="mt-12 relative z-10 flex gap-4 md:gap-6" 
                 x-data="countdown('{{ $invitation->event_date->format('Y-m-d') }}')">
                <div class="bg-[#3E251E]/60 backdrop-blur-sm border border-[#D4A373]/20 rounded-xl px-4 py-2 w-16 md:w-20 text-center">
                    <span class="block text-xl md:text-2xl font-serif-luxury text-[#F9F3EB] font-bold" x-text="days">00</span>
                    <span class="text-[10px] text-white/50 uppercase">Hari</span>
                </div>
                <div class="bg-[#3E251E]/60 backdrop-blur-sm border border-[#D4A373]/20 rounded-xl px-4 py-2 w-16 md:w-20 text-center">
                    <span class="block text-xl md:text-2xl font-serif-luxury text-[#F9F3EB] font-bold" x-text="hours">00</span>
                    <span class="text-[10px] text-white/50 uppercase">Jam</span>
                </div>
                <div class="bg-[#3E251E]/60 backdrop-blur-sm border border-[#D4A373]/20 rounded-xl px-4 py-2 w-16 md:w-20 text-center">
                    <span class="block text-xl md:text-2xl font-serif-luxury text-[#F9F3EB] font-bold" x-text="minutes">00</span>
                    <span class="text-[10px] text-white/50 uppercase">Menit</span>
                </div>
                <div class="bg-[#3E251E]/60 backdrop-blur-sm border border-[#D4A373]/20 rounded-xl px-4 py-2 w-16 md:w-20 text-center">
                    <span class="block text-xl md:text-2xl font-serif-luxury text-[#F9F3EB] font-bold" x-text="seconds">00</span>
                    <span class="text-[10px] text-white/50 uppercase">Detik</span>
                </div>
            </div>
        </section>

        <!-- BRIDE & GROOM PROFILES -->
        <section class="py-20 px-6 max-w-4xl mx-auto space-y-16">
            <div class="text-center space-y-4">
                <p class="font-serif-luxury italic text-xl text-[#6E473B]">Assalamu’alaikum Warahmatullahi Wabarakatuh</p>
                <p class="text-stone-600 text-sm max-w-xl mx-auto leading-relaxed">
                    Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Dengan memohon rahmat dan ridho-Nya, kami mengundang Anda menghadiri momen sakral kami:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 pt-8">
                <!-- Groom Profile -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-gold-accent shadow-lg relative">
                        <img src="{{ $invitation->groom_photo }}" alt="{{ $invitation->groom_name }}" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-serif-luxury text-[#3E251E] font-bold">{{ $invitation->groom_name }}</h3>
                    <p class="text-xs text-stone-500 font-semibold">Putra tercinta dari:</p>
                    <p class="text-sm font-bold text-stone-700">Bapak {{ $invitation->groom_father }} & Ibu {{ $invitation->groom_mother }}</p>
                </div>

                <!-- Bride Profile -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-gold-accent shadow-lg relative">
                        <img src="{{ $invitation->bride_photo }}" alt="{{ $invitation->bride_name }}" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-serif-luxury text-[#3E251E] font-bold">{{ $invitation->bride_name }}</h3>
                    <p class="text-xs text-stone-500 font-semibold">Putri tercinta dari:</p>
                    <p class="text-sm font-bold text-stone-700">Bapak {{ $invitation->bride_father }} & Ibu {{ $invitation->bride_mother }}</p>
                </div>
            </div>
        </section>

        <!-- ACARA / DETAILS SECTION -->
        <section class="py-20 bg-[#6E473B] text-white px-6 relative overflow-hidden">
            <!-- Leaf watermarks -->
            <div class="absolute inset-0 opacity-5 pointer-events-none bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white to-transparent"></div>
            
            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                
                <!-- Card Akad -->
                <div class="p-8 rounded-3xl border border-[#D4A373]/30 bg-[#F9F3EB] text-[#3E251E] text-center space-y-4 shadow-xl">
                    <span class="text-4xl">🕌</span>
                    <h3 class="text-2xl font-serif-luxury text-[#D4A373] font-bold">Akad Pernikahan</h3>
                    <div class="w-12 h-[1px] bg-[#D4A373]/50 mx-auto"></div>
                    
                    <p class="text-stone-500 text-sm font-semibold">Hari, Tanggal:</p>
                    <p class="font-bold text-lg text-[#3E251E]">{{ $invitation->event_date->translatedFormat('l, d F Y') }}</p>
                    
                    <p class="text-stone-500 text-sm mt-2 font-semibold">Waktu:</p>
                    <p class="font-bold text-[#3E251E]">{{ $invitation->event_time }}</p>
                </div>

                <!-- Card Resepsi -->
                <div class="p-8 rounded-3xl border border-[#D4A373]/30 bg-[#F9F3EB] text-[#3E251E] text-center space-y-4 shadow-xl">
                    <span class="text-4xl">🍂</span>
                    <h3 class="text-2xl font-serif-luxury text-[#D4A373] font-bold">Resepsi Pernikahan</h3>
                    <div class="w-12 h-[1px] bg-[#D4A373]/50 mx-auto"></div>
                    
                    <p class="text-stone-500 text-sm font-semibold">Tempat / Lokasi:</p>
                    <p class="font-bold text-lg text-[#3E251E]">{{ $invitation->event_location }}</p>
                    
                    <p class="text-stone-500 text-xs mt-2 font-semibold">Alamat lengkap:</p>
                    <p class="text-xs text-stone-600 leading-relaxed">{{ $invitation->event_address }}</p>
                </div>
            </div>

            @if ($invitation->event_map_url)
                <div class="max-w-2xl mx-auto text-center mt-12 relative z-10">
                    <a href="{{ $invitation->event_map_url }}" target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-[#D4A373] hover:bg-[#c39262] text-white font-extrabold rounded-xl shadow-lg transition duration-300">
                        🗺️ Buka Google Maps
                    </a>
                </div>
            @endif
        </section>

        <!-- LOVE STORY SECTION -->
        @if (isset($invitation->story) && count($invitation->story) > 0)
            <section class="py-20 px-6 max-w-3xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-serif-luxury text-[#3E251E] font-bold">Kisah Perjalanan Kita</h2>
                    <p class="text-stone-400 text-xs mt-1">Perjalanan indah kami dipersatukan dalam takdir</p>
                    <div class="w-16 h-[2px] bg-[#6E473B] mx-auto mt-4"></div>
                </div>

                <div class="space-y-8 relative before:absolute before:left-4 md:before:left-1/2 before:top-2 before:bottom-2 before:w-[2px] before:bg-[#EFE7DC]">
                    @foreach ($invitation->story as $index => $item)
                        <div class="flex flex-col md:flex-row relative items-start md:items-center">
                            <!-- Bullet -->
                            <div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-gold-accent border-2 border-white shadow"></div>
                            
                            <div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-12 md:text-right {{ $index % 2 === 0 ? '' : 'md:order-last md:pl-12 md:text-left' }}">
                                <span class="inline-block px-3 py-1 bg-[#EFE7DC] text-[#3E251E] text-xs font-bold rounded-full mb-2">
                                    {{ $item['date'] ?? '' }}
                                </span>
                                <h4 class="font-serif-luxury text-lg text-[#3E251E] font-bold">{{ $item['title'] ?? '' }}</h4>
                                <p class="text-sm text-stone-600 mt-1 leading-relaxed">{{ $item['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- GALLERY SECTION -->
        @if (isset($invitation->gallery) && count($invitation->gallery) > 0)
            <section class="py-20 bg-[#F9F3EB] border-t border-[#EFE7DC] px-6">
                <div class="max-w-5xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-serif-luxury text-[#3E251E] font-bold">Galeri Kebersamaan</h2>
                        <div class="w-16 h-[2px] bg-[#6E473B] mx-auto mt-4"></div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($invitation->gallery as $photo)
                            <div class="h-64 bg-slate-200 rounded-2xl overflow-hidden shadow-md hover:scale-[1.02] transition duration-300 border border-[#D4A373]/10">
                                <img src="{{ $photo }}" alt="Gallery photo" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- GIFT & ANGPAO SECTION -->
        @if (isset($invitation->gift_accounts) && count($invitation->gift_accounts) > 0)
            <section class="py-20 px-6 max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-serif-luxury text-[#3E251E] font-bold">Kado Pernikahan / Amplop Digital</h2>
                <p class="text-stone-500 text-sm max-w-md mx-auto mt-2">Kebahagiaan Anda adalah berkah melimpah bagi kami. Jika ingin mengirimkan tanda kasih, dapat disalurkan melalui:</p>
                <div class="w-16 h-[2px] bg-[#6E473B] mx-auto my-6"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto mt-8">
                    @foreach ($invitation->gift_accounts as $account)
                        <div class="p-6 bg-white border border-[#D4A373]/15 rounded-2xl shadow-md hover:shadow-lg transition relative overflow-hidden" 
                             x-data="{ copied: false }">
                            <span class="absolute top-2 right-2 text-xs uppercase tracking-widest text-[#D4A373] font-bold">
                                {{ $account['bank'] ?? '' }}
                            </span>
                            <div class="text-left space-y-2 mt-4">
                                <p class="text-xs text-stone-400 font-semibold">Nomor Rekening / HP:</p>
                                <p class="text-xl font-bold text-[#3E251E] select-all font-sans-modern" id="acc-num-{{ $loop->index }}">{{ $account['number'] ?? '' }}</p>
                                <p class="text-sm font-semibold text-stone-600">a.n. {{ $account['owner'] ?? '' }}</p>
                            </div>
                            
                            <button @click="navigator.clipboard.writeText('{{ $account['number'] }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                                    class="w-full mt-4 py-2 rounded-xl text-xs font-bold border transition duration-300"
                                    :class="copied ? 'bg-[#EFE7DC] text-[#3E251E] border-[#D4A373]/20' : 'bg-[#6E473B] text-white border-[#6E473B] hover:bg-[#4A2E26]'">
                                <span x-text="copied ? '✅ Berhasil Disalin!' : '📋 Salin Nomor Rekening'"></span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- RSVP & BOOK WISHES SECTION -->
        <section class="py-20 bg-[#6E473B] text-white px-6">
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-12">
                
                <!-- Form RSVP (5 Columns) -->
                <div class="md:col-span-5 p-8 rounded-3xl border border-[#D4A373]/30 bg-[#F9F3EB] text-[#3E251E] space-y-6 shadow-2xl">
                    <div>
                        <h3 class="text-2xl font-serif-luxury text-[#D4A373] font-bold">Konfirmasi Kehadiran</h3>
                        <p class="text-xs text-stone-500 mt-1">Harap isi form kehadiran tamu di bawah ini.</p>
                        <div class="w-12 h-[1px] bg-[#D4A373]/50 mt-4"></div>
                    </div>

                    <!-- Success Alert -->
                    @if (session('rsvp_success'))
                        <div class="p-4 bg-[#EFE7DC] border border-[#D4A373]/30 text-[#3E251E] rounded-xl text-xs font-semibold leading-relaxed">
                            {{ session('rsvp_success') }}
                        </div>
                    @endif

                    <form action="/{{ $invitation->slug }}/rsvp" method="POST" class="space-y-4 text-left">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-stone-600 mb-1">Nama Lengkap Anda *</label>
                            <input type="text" name="name" x-model="guestName" required placeholder="Budi Santoso" 
                                   class="w-full px-4 py-2.5 bg-white border border-[#D4A373]/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373] text-[#3E251E] placeholder-stone-400 text-sm">
                            @error('name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-stone-600 mb-1">Konfirmasi Kehadiran *</label>
                            <select name="is_present" required 
                                    class="w-full px-4 py-2.5 bg-white border border-[#D4A373]/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373] text-[#3E251E] text-sm">
                                <option value="1" class="text-stone-800">Ya, Saya Akan Hadir</option>
                                <option value="0" class="text-stone-800">Maaf, Tidak Bisa Hadir</option>
                            </select>
                            @error('is_present') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-stone-600 mb-1">Jumlah Tamu *</label>
                            <select name="guest_count" required 
                                    class="w-full px-4 py-2.5 bg-white border border-[#D4A373]/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373] text-[#3E251E] text-sm">
                                <option value="1" class="text-stone-800">1 Orang</option>
                                <option value="2" class="text-stone-800">2 Orang</option>
                                <option value="3" class="text-stone-800">3 Orang</option>
                                <option value="4" class="text-stone-800">4 Orang</option>
                            </select>
                            @error('guest_count') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-stone-600 mb-1">Ucapan & Doa Restu</label>
                            <textarea name="wish" rows="3" placeholder="Selamat menempuh hidup baru ya Arya & Riri! Semoga bahagia selalu... " 
                                      class="w-full px-4 py-2.5 bg-white border border-[#D4A373]/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4A373] text-[#3E251E] placeholder-stone-400 text-sm"></textarea>
                        </div>

                        <button type="submit" 
                                class="w-full py-3 bg-[#D4A373] hover:bg-[#c39262] text-white font-extrabold rounded-xl shadow-lg hover:opacity-90 active:scale-95 transition-all duration-300">
                            Kirim Kehadiran
                        </button>
                    </form>
                </div>

                <!-- Buku Tamu / Guestbook Wishes Board (7 Columns) -->
                <div class="md:col-span-7 space-y-6">
                    <div>
                        <h3 class="text-2xl font-serif-luxury text-[#F9F3EB] font-bold">Ucapan & Doa Restu</h3>
                        <p class="text-xs text-[#F9F3EB]/70 mt-1">Melihat doa restu yang mengalir dari keluarga dan rekan tercinta.</p>
                        <div class="w-12 h-[1px] bg-[#F9F3EB]/30 mt-4"></div>
                    </div>

                    <div class="space-y-4 max-h-[480px] overflow-y-auto pr-2">
                        @if($invitation->guests->isEmpty())
                            <div class="p-6 bg-white/10 rounded-2xl text-center border border-white/10 text-white/50 text-sm">
                                Belum ada ucapan. Jadilah yang pertama mengirimkan doa!
                            </div>
                        @else
                            @foreach ($invitation->guests as $guest)
                                <div class="p-4 bg-[#F9F3EB] rounded-2xl border border-[#D4A373]/10 relative text-left shadow-md">
                                    <div class="flex items-center justify-between mb-2">
                                        <h5 class="font-bold text-[#3E251E] text-sm">{{ $guest->name }}</h5>
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider {{ $guest->is_present ? 'bg-[#EFE7DC] text-[#3E251E] border border-[#6E473B]/20' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                                            {{ $guest->is_present ? ' Hadir' : ' Tidak Hadir' }}
                                        </span>
                                    </div>
                                    <p class="text-[#3E251E]/80 text-xs leading-relaxed italic">"{{ $guest->wish }}"</p>
                                    <span class="text-[9px] text-stone-400 block text-right mt-2">{{ $guest->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </section>

        <!-- FOOTER OUTRO -->
        <section class="py-12 bg-[#2B1713] text-white text-center px-6 border-t border-[#D4A373]/20">
            <h2 class="text-2xl font-serif-luxury text-[#F9F3EB] mb-2">{{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</h2>
            <p class="text-xs text-stone-400">Terima kasih atas segala doa restu dan kehangatan Anda.</p>
            <p class="text-[10px] text-stone-500 mt-8">Powered by <a href="/" class="text-[#F9F3EB]/50 hover:text-white transition font-bold">WeddingKita.com</a></p>
        </section>

    </div>

    <!-- Countdown JS helper script -->
    <script>
        function countdown(dateString) {
            return {
                targetDate: new Date(dateString).getTime(),
                days: '00',
                hours: '00',
                minutes: '00',
                seconds: '00',
                init() {
                    const updateCountdown = () => {
                        const now = new Date().getTime();
                        const distance = this.targetDate - now;

                        if (distance < 0) {
                            clearInterval(interval);
                            return;
                        }

                        this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                        this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                        this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                        this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                    };

                    updateCountdown();
                    const interval = setInterval(updateCountdown, 1000);
                }
            }
        }
    </script>
</body>
</html>
