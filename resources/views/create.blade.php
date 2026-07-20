<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Undangan Pernikahan Digital - WeddingKita</title>

    <!-- Google Fonts: Playfair Display & Instrument Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..900;1,400..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS v4 -->
    @vite(['resources/css/app.css'])
    @livewireStyles

    <style>
        .font-serif-luxury {
            font-family: 'Playfair Display', Georgia, serif;
        }

        .font-sans-modern {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
        }
    </style>
</head>

<body class="bg-[#faf6ee] font-sans-modern text-[#27382b] antialiased">

    <!-- HEADER / NAVIGATION -->
    <header class="border-b border-[#d98a6c]/15 bg-white/70 backdrop-blur-md sticky top-0 z-50 px-6 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <span class="text-2xl">🌿</span>
                <span class="font-serif-luxury text-xl font-extrabold tracking-wide text-[#3e5643]">WeddingKita</span>
            </a>

            <div class="flex items-center gap-4">
                <a href="/" class="text-sm font-semibold text-slate-600 hover:text-[#3e5643] transition">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT AREA -->
    <div class="py-12 px-4 relative overflow-hidden min-h-[calc(100vh-140px)]">
        <!-- Soft decorative cottagecore shapes -->
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-[#3e5643]/5 blur-3xl -z-10 animate-pulse">
        </div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-[#d98a6c]/5 blur-3xl -z-10 animate-pulse"
            style="animation-delay: 2s"></div>

        <div class="max-w-7xl mx-auto">
            <!-- Alert Session Message -->
            @if (session()->has('message'))
                <div
                    class="max-w-4xl mx-auto mb-6 p-4 bg-[#edf2ec] border border-[#3e5643]/20 text-[#27382b] rounded-2xl flex items-center gap-3 shadow-sm">
                    <span>✅</span>
                    <span class="text-sm font-bold">{{ session('message') }}</span>
                </div>
            @endif

            <!-- Livewire Form Builder Component -->
            <livewire:invitation-builder />
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="py-8 border-t border-[#d98a6c]/15 bg-[#1c2820] text-white text-center px-6">
        <div class="max-w-6xl mx-auto space-y-4">
            <p class="text-xs text-slate-400">© 2026 WeddingKita.com - Solusi Undangan Digital Otomatis Kreator Pasif
                Income.</p>
            <p class="text-[10px] text-slate-500">Terima kasih atas segala doa restu dan kehangatan Anda.</p>
        </div>
    </footer>

    @livewireScripts
</body>

</html>