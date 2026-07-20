<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeddingKita - Undangan Digital Pernikahan Premium & Elegan</title>

    <!-- Meta SEO -->
    <meta name="description"
        content="Jasa pembuatan website undangan digital pernikahan premium. Desain modern, elegan, minimalis, dan mewah dengan fitur RSVP, Musik, Countdown, dan Unlimited Share." />

    <!-- Google Fonts: Playfair Display, Cormorant Garamond, Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS v4 -->
    @vite(['resources/css/app.css'])

    <!-- AlpineJS for interactive elements -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-heading {
            font-family: 'Playfair Display', serif;
        }

        .font-subheading {
            font-family: 'Cormorant Garamond', serif;
        }

        /* Custom Float Animations */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(3deg); }
        }
        @keyframes float-medium {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(-3deg); }
        }
        @keyframes float-fast {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1deg); }
        }
        @keyframes pulse-soft {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.1); }
        }

        .animate-float-slow {
            animation: float-slow 8s ease-in-out infinite;
        }

        .animate-float-medium {
            animation: float-medium 6s ease-in-out infinite;
        }

        .animate-float-fast {
            animation: float-fast 4s ease-in-out infinite;
        }

        .animate-pulse-soft {
            animation: pulse-soft 5s ease-in-out infinite;
        }

        /* Ripple effect CSS */
        .ripple {
            position: relative;
            overflow: hidden;
        }
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Hide scrollbars */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-white text-text-primary antialiased selection:bg-primary-gold selection:text-white"
    x-data="{ 
        scrolled: false, 
        mobileMenuOpen: false, 
        showDemoModal: false, 
        showPreviewModal: false, 
        currentPreviewUrl: '/preview/classic-emerald?to=Tamu+Spesial', 
        currentPreviewTheme: 'classic-emerald',
        ripple(e) {
            let btn = e.currentTarget;
            let circle = document.createElement('span');
            let diameter = Math.max(btn.clientWidth, btn.clientHeight);
            let radius = diameter / 2;
            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${e.clientX - btn.getBoundingClientRect().left - radius}px`;
            circle.style.top = `${e.clientY - btn.getBoundingClientRect().top - radius}px`;
            circle.classList.add('ripple-effect');
            let existingRipple = btn.getElementsByClassName('ripple-effect')[0];
            if (existingRipple) { existingRipple.remove(); }
            btn.appendChild(circle);
        }
    }" 
    @scroll.window="scrolled = window.scrollY > 20">

    <!-- NAVBAR -->
    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-500"
        :class="scrolled ? 'bg-white/80 backdrop-blur-md shadow-lg py-4 border-b border-primary-gold/10' : 'bg-transparent py-6 border-b border-transparent'">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-2 group">
                <span class="text-2xl group-hover:scale-110 transition-transform duration-300">⚜️</span>
                <span class="font-heading text-2xl font-bold tracking-wide text-text-primary group-hover:text-primary-gold transition-colors duration-300">WeddingKita</span>
            </a>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden lg:flex items-center gap-8 font-medium text-sm text-text-primary">
                <a href="#" class="hover:text-primary-gold transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-primary-gold hover:after:w-full after:transition-all after:duration-300">Home</a>
                <a href="#tema" class="hover:text-primary-gold transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-primary-gold hover:after:w-full after:transition-all after:duration-300">Tema</a>
                <a href="#fitur" class="hover:text-primary-gold transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-primary-gold hover:after:w-full after:transition-all after:duration-300">Fitur</a>
                <a href="#harga" class="hover:text-primary-gold transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-primary-gold hover:after:w-full after:transition-all after:duration-300">Harga</a>
                <a href="#faq" class="hover:text-primary-gold transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-primary-gold hover:after:w-full after:transition-all after:duration-300">FAQ</a>
                <a href="#contact" class="hover:text-primary-gold transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-primary-gold hover:after:w-full after:transition-all after:duration-300">Contact</a>
            </nav>

            <!-- CTA button (Desktop) -->
            <div class="hidden lg:block">
                <a href="/create" @click="ripple($event)"
                    class="ripple px-6 py-3 bg-primary-gold hover:bg-[#b08f2e] text-white text-sm font-semibold rounded-full shadow-lg hover:shadow-primary-gold/20 hover:scale-105 active:scale-95 transition-all duration-300">
                    Pesan Sekarang
                </a>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden text-text-primary focus:outline-none hover:text-primary-gold transition-colors duration-300">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="lg:hidden bg-white border-b border-gray-100 shadow-xl px-6 py-6 absolute top-full left-0 w-full flex flex-col gap-4">
            <a href="#" @click="mobileMenuOpen = false" class="hover:text-primary-gold transition-colors duration-300 font-medium">Home</a>
            <a href="#tema" @click="mobileMenuOpen = false" class="hover:text-primary-gold transition-colors duration-300 font-medium">Tema</a>
            <a href="#fitur" @click="mobileMenuOpen = false" class="hover:text-primary-gold transition-colors duration-300 font-medium">Fitur</a>
            <a href="#harga" @click="mobileMenuOpen = false" class="hover:text-primary-gold transition-colors duration-300 font-medium">Harga</a>
            <a href="#faq" @click="mobileMenuOpen = false" class="hover:text-primary-gold transition-colors duration-300 font-medium">FAQ</a>
            <a href="#contact" @click="mobileMenuOpen = false" class="hover:text-primary-gold transition-colors duration-300 font-medium">Contact</a>
            <a href="/create" @click="ripple($event); mobileMenuOpen = false"
                class="ripple w-full text-center py-3 bg-primary-gold hover:bg-[#b08f2e] text-white text-sm font-semibold rounded-full shadow-lg transition-all duration-300">
                Pesan Sekarang
            </a>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="min-h-screen flex items-center pt-24 pb-16 px-6 relative overflow-hidden bg-white">
        <!-- Blur blobs and decorative background shapes -->
        <div class="absolute top-1/4 -left-32 w-[400px] h-[400px] rounded-full bg-[#E9D8A6]/20 blur-3xl animate-pulse-soft"></div>
        <div class="absolute bottom-1/4 -right-32 w-[500px] h-[500px] rounded-full bg-[#D4AF37]/10 blur-3xl animate-pulse-soft" style="animation-delay: 2.5s;"></div>

        <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Left Side -->
            <div class="space-y-8 text-left z-10">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-xs font-semibold uppercase tracking-wider rounded-full shadow-sm">
                    ✨ Luxury Digital Invitation Creator
                </span>

                <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-extrabold text-text-primary leading-tight">
                    Undangan Digital <br>
                    Pernikahan yang <span class="text-primary-gold">Elegan</span>, Modern, dan Berkesan.
                </h1>

                <p class="font-subheading text-lg sm:text-xl lg:text-2xl text-text-secondary italic max-w-xl">
                    "Buat momen bahagiamu semakin istimewa dengan website undangan digital premium yang dapat dibagikan hanya melalui satu link."
                </p>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <a href="/create" @click="ripple($event)"
                        class="ripple px-8 py-4 bg-primary-gold hover:bg-[#b08f2e] text-white text-center font-semibold rounded-full shadow-lg hover:shadow-primary-gold/20 hover:scale-105 active:scale-95 transition-all duration-300">
                        Pesan Sekarang
                    </a>
                    <button @click.prevent="currentPreviewUrl = '/preview/classic-emerald?to=Tamu+Spesial'; currentPreviewTheme = 'classic-emerald'; showPreviewModal = true;"
                        class="px-8 py-4 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory font-semibold rounded-full hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
                        Lihat Demo
                    </button>
                </div>

                <!-- Mini features list -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 pt-6 text-xs font-medium text-text-secondary border-t border-gray-100">
                    <div class="flex items-center gap-1.5">
                        <span class="text-primary-gold">✓</span> Mobile Friendly
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-primary-gold">✓</span> Musik
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-primary-gold">✓</span> RSVP
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-primary-gold">✓</span> Countdown
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-primary-gold">✓</span> Unlimited Share
                    </div>
                </div>
            </div>

            <!-- Right Side (Mockups & Sparkles) -->
            <div class="relative flex items-center justify-center lg:justify-end z-10 py-10 lg:py-0">
                <!-- Floral Line Art background (Decorative) -->
                <div class="absolute -top-12 -left-12 w-64 h-64 opacity-15 pointer-events-none select-none text-primary-gold animate-float-slow">
                    <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M50 0 C 40 30, 20 40, 0 50 C 20 60, 40 70, 50 100 C 60 70, 80 60, 100 50 C 80 40, 60 30, 50 0 Z" />
                        <path d="M50 10 C 43 35, 25 43, 10 50 C 25 57, 43 65, 50 90 C 57 65, 75 57, 90 50 C 75 43, 57 35, 50 10 Z" stroke-dasharray="2 2" />
                    </svg>
                </div>

                <!-- Gradient decorative circle -->
                <div class="absolute w-72 h-72 sm:w-[400px] sm:h-[400px] rounded-full bg-gradient-to-tr from-accent-gold/20 to-primary-gold/15 -z-10 animate-float-medium"></div>

                <!-- Sparkles -->
                <div class="absolute top-1/3 -right-6 text-primary-gold text-2xl animate-pulse">✨</div>
                <div class="absolute bottom-1/4 -left-6 text-primary-gold text-xl animate-pulse" style="animation-delay: 1.5s;">✨</div>

                <!-- Devices Wrap -->
                <div class="relative w-full max-w-lg aspect-square flex items-center justify-center">
                    
                    <!-- Laptop Mockup -->
                    <div class="relative w-[85%] aspect-video border-[10px] border-gray-900 rounded-xl shadow-2xl overflow-hidden bg-white animate-float-medium">
                        <!-- Camera -->
                        <div class="absolute top-1 left-1/2 transform -translate-x-1/2 w-2 h-2 rounded-full bg-black/80 z-20"></div>
                        <iframe src="/preview/classic-emerald?to=Tamu+Spesial" class="w-full h-full border-none pointer-events-none select-none scale-102" style="scrollbar-width: none;"></iframe>
                    </div>

                    <!-- Smartphone Mockup overlapping -->
                    <div class="absolute -bottom-4 right-2 w-[32%] aspect-[9/19.5] border-[6px] border-gray-900 rounded-[2rem] shadow-[0_20px_50px_-10px_rgba(0,0,0,0.5)] overflow-hidden bg-white animate-float-slow" style="animation-delay: 1s;">
                        <!-- Speaker / Notch -->
                        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-16 h-3.5 bg-gray-900 rounded-b-xl z-20 flex items-center justify-center">
                            <div class="w-1.5 h-1.5 rounded-full bg-black/60"></div>
                        </div>
                        <iframe src="/preview/classic-emerald?to=Tamu+Spesial" class="w-full h-full border-none pointer-events-none select-none scale-105" style="scrollbar-width: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SHOWCASE TEMA SECTION -->
    <section id="tema" class="py-24 px-6 bg-secondary-ivory relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-4 mb-16">
                <span class="text-primary-gold text-xs font-semibold uppercase tracking-widest block">Premium Templates</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-bold text-text-primary">Pilih Tema Favoritmu</h2>
                <div class="w-20 h-[2px] bg-primary-gold/60 mx-auto"></div>
                <p class="font-subheading text-lg sm:text-xl text-text-secondary italic">"Kami menyediakan berbagai tema elegan yang siap digunakan."</p>
            </div>

            <!-- Grid 3-column -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                <!-- Theme Card 1 -->
                <div class="bg-white rounded-[24px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group overflow-hidden relative border border-gray-100 flex flex-col">
                    <!-- Badge -->
                    <span class="absolute top-4 right-4 z-20 px-3 py-1 bg-primary-gold text-white text-[10px] font-semibold tracking-wider uppercase rounded-full shadow-sm">
                        Most Popular
                    </span>
                    <!-- Image Wrapper -->
                    <div class="aspect-video w-full overflow-hidden bg-gray-50 relative">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800" 
                            alt="Midnight Sage Theme Preview" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                    <!-- Details -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Elegant
                                </span>
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Nature
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Midnight Sage</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">Nuansa hijau sage yang tenang dengan sentuhan floral modern.</p>
                        </div>
                        <button @click.prevent="currentPreviewUrl = '/preview/classic-emerald?to=Tamu+Spesial'; currentPreviewTheme = 'classic-emerald'; showPreviewModal = true;"
                            class="w-full py-3 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory text-sm font-semibold rounded-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            Lihat Live Demo
                        </button>
                    </div>
                </div>

                <!-- Theme Card 2 -->
                <div class="bg-white rounded-[24px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group overflow-hidden relative border border-gray-100 flex flex-col">
                    <!-- Badge -->
                    <span class="absolute top-4 right-4 z-20 px-3 py-1 bg-primary-gold text-white text-[10px] font-semibold tracking-wider uppercase rounded-full shadow-sm">
                        New
                    </span>
                    <!-- Image Wrapper -->
                    <div class="aspect-video w-full overflow-hidden bg-gray-50 relative">
                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=800" 
                            alt="Dusty Rose Latte Theme Preview" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                    <!-- Details -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Soft
                                </span>
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Romantic
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Dusty Rose Latte</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">Perpaduan dusty pink dan beige dengan tampilan hangat dan manis.</p>
                        </div>
                        <button @click.prevent="currentPreviewUrl = '/preview/rustic-gold?to=Tamu+Spesial'; currentPreviewTheme = 'rustic-gold'; showPreviewModal = true;"
                            class="w-full py-3 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory text-sm font-semibold rounded-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            Lihat Live Demo
                        </button>
                    </div>
                </div>

                <!-- Theme Card 3 -->
                <div class="bg-white rounded-[24px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group overflow-hidden relative border border-gray-100 flex flex-col">
                    <!-- Badge -->
                    <span class="absolute top-4 right-4 z-20 px-3 py-1 bg-primary-gold text-white text-[10px] font-semibold tracking-wider uppercase rounded-full shadow-sm">
                        Most Popular
                    </span>
                    <!-- Image Wrapper -->
                    <div class="aspect-video w-full overflow-hidden bg-gray-50 relative">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=800" 
                            alt="Modern Noir Gold Theme Preview" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                    <!-- Details -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Luxury
                                </span>
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Dark
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Modern Noir Gold</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">Tema hitam emas untuk pasangan yang menginginkan kesan premium.</p>
                        </div>
                        <button @click.prevent="currentPreviewUrl = '/preview/modern-minimalist?to=Tamu+Spesial'; currentPreviewTheme = 'modern-minimalist'; showPreviewModal = true;"
                            class="w-full py-3 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory text-sm font-semibold rounded-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            Lihat Live Demo
                        </button>
                    </div>
                </div>

                <!-- Theme Card 4 -->
                <div class="bg-white rounded-[24px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group overflow-hidden relative border border-gray-100 flex flex-col">
                    <!-- Badge -->
                    <span class="absolute top-4 right-4 z-20 px-3 py-1 bg-primary-gold text-white text-[10px] font-semibold tracking-wider uppercase rounded-full shadow-sm">
                        New
                    </span>
                    <!-- Image Wrapper -->
                    <div class="aspect-video w-full overflow-hidden bg-gray-50 relative">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=800" 
                            alt="Botanical Linen Theme Preview" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                    <!-- Details -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Minimal
                                </span>
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Botanical
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Botanical Linen</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">Desain bersih dengan ornamen dedaunan yang elegan.</p>
                        </div>
                        <button @click.prevent="currentPreviewUrl = '/preview/elegant?to=Tamu+Spesial'; currentPreviewTheme = 'elegant'; showPreviewModal = true;"
                            class="w-full py-3 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory text-sm font-semibold rounded-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            Lihat Live Demo
                        </button>
                    </div>
                </div>

                <!-- Theme Card 5 -->
                <div class="bg-white rounded-[24px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group overflow-hidden relative border border-gray-100 flex flex-col">
                    <!-- Badge -->
                    <span class="absolute top-4 right-4 z-20 px-3 py-1 bg-primary-gold text-white text-[10px] font-semibold tracking-wider uppercase rounded-full shadow-sm">
                        Popular
                    </span>
                    <!-- Image Wrapper -->
                    <div class="aspect-video w-full overflow-hidden bg-gray-50 relative">
                        <img src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?q=80&w=800" 
                            alt="Artistic Invitation Theme Preview" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                    <!-- Details -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Artistic
                                </span>
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Lavender
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Artistic Invitation</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">Desain undangan modern dengan sentuhan artistik yang lembut bernuansa lavender.</p>
                        </div>
                        <button @click.prevent="currentPreviewUrl = '/preview/invitation?to=Tamu+Spesial'; currentPreviewTheme = 'invitation'; showPreviewModal = true;"
                            class="w-full py-3 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory text-sm font-semibold rounded-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            Lihat Live Demo
                        </button>
                    </div>
                </div>

                <!-- Theme Card 6 -->
                <div class="bg-white rounded-[24px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group overflow-hidden relative border border-gray-100 flex flex-col">
                    <!-- Badge -->
                    <span class="absolute top-4 right-4 z-20 px-3 py-1 bg-primary-gold text-white text-[10px] font-semibold tracking-wider uppercase rounded-full shadow-sm">
                        Classic
                    </span>
                    <!-- Image Wrapper -->
                    <div class="aspect-video w-full overflow-hidden bg-gray-50 relative">
                        <img src="https://images.unsplash.com/photo-1519225495810-7517c319b53b?q=80&w=800" 
                            alt="Classic Floral Theme Preview" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                    <!-- Details -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Classic
                                </span>
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Floral
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Classic Floral</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">Desain undangan klasik dengan ornamen bunga yang indah berbalut warna zamrud dan emas.</p>
                        </div>
                        <button @click.prevent="currentPreviewUrl = '/preview/undangan?to=Tamu+Spesial'; currentPreviewTheme = 'undangan'; showPreviewModal = true;"
                            class="w-full py-3 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory text-sm font-semibold rounded-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            Lihat Live Demo
                        </button>
                    </div>
                </div>

                <!-- Theme Card 7 -->
                <div class="bg-white rounded-[24px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group overflow-hidden relative border border-gray-100 flex flex-col">
                    <!-- Badge -->
                    <span class="absolute top-4 right-4 z-20 px-3 py-1 bg-primary-gold text-white text-[10px] font-semibold tracking-wider uppercase rounded-full shadow-sm">
                        Rustic
                    </span>
                    <!-- Image Wrapper -->
                    <div class="aspect-video w-full overflow-hidden bg-gray-50 relative">
                        <img src="https://images.unsplash.com/photo-1469371670807-013ccf25f16a?q=80&w=800" 
                            alt="Rustic Floral Theme Preview" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                    <!-- Details -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Rustic
                                </span>
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Floral
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Rustic Floral</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">Tema rustic yang elegan dengan hiasan bunga-bunga cantik yang menawan.</p>
                        </div>
                        <button @click.prevent="currentPreviewUrl = '/preview/rustic-floral?to=Tamu+Spesial'; currentPreviewTheme = 'rustic-floral'; showPreviewModal = true;"
                            class="w-full py-3 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory text-sm font-semibold rounded-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            Lihat Live Demo
                        </button>
                    </div>
                </div>

                <!-- Theme Card 8 -->
                <div class="bg-white rounded-[24px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group overflow-hidden relative border border-gray-100 flex flex-col">
                    <!-- Badge -->
                    <span class="absolute top-4 right-4 z-20 px-3 py-1 bg-primary-gold text-white text-[10px] font-semibold tracking-wider uppercase rounded-full shadow-sm">
                        Cute
                    </span>
                    <!-- Image Wrapper -->
                    <div class="aspect-video w-full overflow-hidden bg-gray-50 relative">
                        <img src="https://images.unsplash.com/photo-1518002171953-a080ee817e1f?q=80&w=800" 
                            alt="Girl Theme Preview" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                    <!-- Details -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 justify-between gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Girl
                                </span>
                                <span class="px-2.5 py-0.5 bg-secondary-ivory border border-accent-gold/40 text-primary-gold text-[10px] font-semibold tracking-wider uppercase rounded-full">
                                    Pink
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Sweet Girl</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">Desain undangan manis dengan sentuhan warna pink dan gaya yang imut.</p>
                        </div>
                        <button @click.prevent="currentPreviewUrl = '/preview/girl?to=Tamu+Spesial'; currentPreviewTheme = 'girl'; showPreviewModal = true;"
                            class="w-full py-3 border-2 border-primary-gold/30 hover:border-primary-gold text-text-primary hover:bg-secondary-ivory text-sm font-semibold rounded-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                            Lihat Live Demo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURE SECTION -->
    <section id="fitur" class="py-24 px-6 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-4 mb-20">
                <span class="text-primary-gold text-xs font-semibold uppercase tracking-widest block">Everything You Need</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-bold text-text-primary">Semua yang Kamu Butuhkan</h2>
                <div class="w-20 h-[2px] bg-primary-gold/60 mx-auto"></div>
            </div>

            <!-- Features Grid (3 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        ⏰
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Countdown Timer</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Penunjuk waktu mundur real-time menuju momen bahagia pernikahan Anda.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        ✉️
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">RSVP Online</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Kelola konfirmasi kehadiran para tamu dengan mudah secara real-time.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        📸
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Gallery Foto</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Tampilkan album foto kenangan prewedding yang estetik & interaktif.</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        💬
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Wedding Wishes</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Buku tamu digital interaktif untuk menampung doa & restu terbaik.</p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        ⏳
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Love Story Timeline</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Bagikan garis waktu kisah perjalanan cinta romantis Anda berdua.</p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        📍
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Google Maps</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Navigasi peta lokasi acara yang akurat dalam sekali klik.</p>
                    </div>
                </div>

                <!-- Feature 7 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        🎵
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Background Music</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Musik latar autoplay romantis untuk mengiringi pembacaan undangan.</p>
                    </div>
                </div>

                <!-- Feature 8 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        💳
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Amplop Digital</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Tampung kado tanpa ribet dengan salin nomor rekening instan.</p>
                    </div>
                </div>

                <!-- Feature 9 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        📱
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Responsive Mobile</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Tampilan premium yang menyesuaikan di seluruh ukuran layar gadget.</p>
                    </div>
                </div>

                <!-- Feature 10 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        💬
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Share via WhatsApp</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Undangan siap dibagikan secara instan ke kontak keluarga & kerabat.</p>
                    </div>
                </div>

                <!-- Feature 11 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        ✨
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Animasi Scroll</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Efek transisi scroll yang lembut untuk menambah estetika kemewahan.</p>
                    </div>
                </div>

                <!-- Feature 12 -->
                <div class="p-8 bg-white border border-gray-100 rounded-3xl shadow-sm hover:scale-[1.03] hover:shadow-xl hover:border-primary-gold/60 transition-all duration-300 flex flex-col gap-5 group">
                    <div class="w-14 h-14 rounded-2xl bg-secondary-ivory border border-accent-gold/40 text-primary-gold flex items-center justify-center text-2xl group-hover:bg-primary-gold group-hover:text-white transition-colors duration-300">
                        🌐
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-xl font-bold text-text-primary">Custom Domain (Premium)</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">Gunakan nama link undangan digital khusus sesuai keinginan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING SECTION -->
    <section id="harga" class="py-24 px-6 bg-gradient-to-b from-secondary-ivory to-white">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-4 mb-20">
                <span class="text-primary-gold text-xs font-semibold uppercase tracking-widest block">Affordable Pricing</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-bold text-text-primary">Pilih Paket</h2>
                <div class="w-20 h-[2px] bg-primary-gold/60 mx-auto"></div>
            </div>

            <!-- Pricing Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch max-w-6xl mx-auto">
                <!-- Card Basic -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-lg hover:shadow-xl hover:scale-102 hover:shadow-primary-gold/5 transition-all duration-300 flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Basic</h3>
                            <div class="text-3xl font-extrabold text-primary-gold">Rp 99.000</div>
                            <p class="text-text-secondary text-xs">Sangat cocok untuk kebutuhan sederhana.</p>
                        </div>
                        <hr class="border-gray-100">
                        <ul class="space-y-3.5 text-sm text-text-primary">
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> 1 Tema
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Countdown
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Musik
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Gallery
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Google Maps
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Unlimited Share
                            </li>
                            <li class="flex items-center gap-2 text-text-secondary line-through">
                                <span class="text-red-500 text-base">✗</span> RSVP
                            </li>
                            <li class="flex items-center gap-2 text-text-secondary line-through">
                                <span class="text-red-500 text-base">✗</span> Custom Warna
                            </li>
                        </ul>
                    </div>
                    <div class="pt-8">
                        <a href="/create" @click="ripple($event)"
                            class="ripple block w-full text-center py-3.5 border-2 border-primary-gold text-primary-gold hover:bg-secondary-ivory text-sm font-semibold rounded-xl transition-all duration-300">
                            Pesan Basic
                        </a>
                    </div>
                </div>

                <!-- Card Premium (Most Popular) -->
                <div class="bg-white rounded-3xl p-8 border-2 border-primary-gold shadow-2xl hover:scale-105 hover:shadow-primary-gold/15 transition-all duration-300 flex flex-col justify-between relative transform -translate-y-2 lg:-translate-y-4">
                    <span class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-4 py-1 bg-primary-gold text-white text-[10px] font-bold tracking-wider uppercase rounded-full shadow-md">
                        Recommended
                    </span>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Premium</h3>
                            <div class="text-3xl font-extrabold text-primary-gold">Rp 199.000</div>
                            <p class="text-text-secondary text-xs">Pilihan terbaik untuk pernikahan mewah impian Anda.</p>
                        </div>
                        <hr class="border-gray-100">
                        <ul class="space-y-3.5 text-sm text-text-primary">
                            <li class="flex items-center gap-2 font-semibold">
                                <span class="text-green-500 text-base">✓</span> Semua fitur Basic
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> RSVP Online
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Wishes
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Custom Warna
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Custom Font
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Amplop Digital
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Revisi 2x
                            </li>
                        </ul>
                    </div>
                    <div class="pt-8">
                        <a href="/create" @click="ripple($event)"
                            class="ripple block w-full text-center py-4 bg-primary-gold hover:bg-[#b08f2e] text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-primary-gold/20 transition-all duration-300">
                            Pesan Premium
                        </a>
                    </div>
                </div>

                <!-- Card Custom -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-lg hover:shadow-xl hover:scale-102 hover:shadow-primary-gold/5 transition-all duration-300 flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <h3 class="font-heading text-2xl font-bold text-text-primary">Custom</h3>
                            <div class="text-3xl font-extrabold text-primary-gold">Hubungi Kami</div>
                            <p class="text-text-secondary text-xs">Untuk desain dan fitur khusus kustomisasi penuh.</p>
                        </div>
                        <hr class="border-gray-100">
                        <ul class="space-y-3.5 text-sm text-text-primary">
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Request desain
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Request fitur
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Domain sendiri
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Unlimited revisi minor
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500 text-base">✓</span> Konsultasi langsung
                            </li>
                        </ul>
                    </div>
                    <div class="pt-8">
                        <a href="https://wa.me/6281234567890?text=Halo%20WeddingKita%20saya%20tertarik%20dengan%20Paket%20Custom" 
                            target="_blank" @click="ripple($event)"
                            class="ripple block w-full text-center py-3.5 border-2 border-primary-gold text-primary-gold hover:bg-secondary-ivory text-sm font-semibold rounded-xl transition-all duration-300">
                            Pesan Custom
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS SECTION -->
    <section id="cara-kerja" class="py-24 px-6 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-4 mb-20">
                <span class="text-primary-gold text-xs font-semibold uppercase tracking-widest block">Process Flow</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-bold text-text-primary">Bagaimana Cara Kerjanya?</h2>
                <div class="w-20 h-[2px] bg-primary-gold/60 mx-auto"></div>
            </div>

            <!-- Horizontal Timeline / Step Process -->
            <div class="relative grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-16 pt-8">
                <!-- Line background (visible on desktop) -->
                <div class="hidden md:block absolute top-[44px] left-[12%] right-[12%] h-[2px] bg-dashed bg-gradient-to-r from-primary-gold/20 via-accent-gold/40 to-primary-gold/20 z-0"></div>

                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center space-y-5 relative z-10 group">
                    <div class="w-16 h-16 rounded-full bg-secondary-ivory border-2 border-primary-gold text-primary-gold flex items-center justify-center text-xl font-bold shadow-md group-hover:bg-primary-gold group-hover:text-white transition-all duration-500">
                        1
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-lg font-bold text-text-primary">Pilih Tema</h3>
                        <p class="text-text-secondary text-xs leading-relaxed max-w-[200px] mx-auto">Tentukan desain visual premium yang paling sesuai dengan selera tema impian Anda.</p>
                    </div>
                    <div class="text-2xl pt-2 opacity-60 group-hover:scale-110 transition-transform duration-300">🎨</div>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center space-y-5 relative z-10 group">
                    <div class="w-16 h-16 rounded-full bg-secondary-ivory border-2 border-primary-gold text-primary-gold flex items-center justify-center text-xl font-bold shadow-md group-hover:bg-primary-gold group-hover:text-white transition-all duration-500">
                        2
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-lg font-bold text-text-primary">Isi Data</h3>
                        <p class="text-text-secondary text-xs leading-relaxed max-w-[200px] mx-auto">Lengkapi formulir online mulai biodata mempelai, tanggal acara, hingga foto.</p>
                    </div>
                    <div class="text-2xl pt-2 opacity-60 group-hover:scale-110 transition-transform duration-300">📝</div>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center space-y-5 relative z-10 group">
                    <div class="w-16 h-16 rounded-full bg-secondary-ivory border-2 border-primary-gold text-primary-gold flex items-center justify-center text-xl font-bold shadow-md group-hover:bg-primary-gold group-hover:text-white transition-all duration-500">
                        3
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-lg font-bold text-text-primary">Kami Proses</h3>
                        <p class="text-text-secondary text-xs leading-relaxed max-w-[200px] mx-auto">Sistem kami langsung mengolah data Anda secara kilat dalam waktu singkat.</p>
                    </div>
                    <div class="text-2xl pt-2 opacity-60 group-hover:scale-110 transition-transform duration-300">⚙️</div>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col items-center text-center space-y-5 relative z-10 group">
                    <div class="w-16 h-16 rounded-full bg-secondary-ivory border-2 border-primary-gold text-primary-gold flex items-center justify-center text-xl font-bold shadow-md group-hover:bg-primary-gold group-hover:text-white transition-all duration-500">
                        4
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-heading text-lg font-bold text-text-primary">Undangan Siap</h3>
                        <p class="text-text-secondary text-xs leading-relaxed max-w-[200px] mx-auto">Link website undangan digital premium siap disebar ke seluruh tamu.</p>
                    </div>
                    <div class="text-2xl pt-2 opacity-60 group-hover:scale-110 transition-transform duration-300">💌</div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL SECTION -->
    <section class="py-24 px-6 bg-secondary-ivory relative">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-4 mb-16">
                <span class="text-primary-gold text-xs font-semibold uppercase tracking-widest block">Client Love</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-bold text-text-primary">Apa Kata Mereka</h2>
                <div class="w-20 h-[2px] bg-primary-gold/60 mx-auto"></div>
            </div>

            <!-- Testimonial Carousel / Placeholder -->
            <div x-data="{ activeIndex: 0, count: 3 }" class="max-w-3xl mx-auto relative">
                <!-- Testimonials Wrapper -->
                <div class="relative min-h-[300px] flex items-center justify-center overflow-hidden">
                    
                    <!-- Slide 1 -->
                    <div x-show="activeIndex === 0" x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-300 absolute"
                        x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8"
                        class="bg-white rounded-3xl p-8 md:p-12 shadow-md border border-gray-100 flex flex-col md:flex-row gap-6 md:gap-8 items-center text-center md:text-left w-full">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200" 
                            alt="Citra Kirana" 
                            class="w-20 h-20 rounded-full object-cover border-2 border-primary-gold shadow-sm">
                        <div class="space-y-4 flex-1">
                            <div class="flex items-center justify-center md:justify-start text-primary-gold gap-1 text-sm">
                                ★★★★★
                            </div>
                            <p class="font-subheading text-lg italic text-text-secondary leading-relaxed">
                                "Sangat mudah digunakan! Hanya butuh waktu sekitar 5 menit dan undangan premium kami selesai dibuat. Tema Sage Green-nya luar biasa elegan, tamu kami banyak yang memuji tampilannya!"
                            </p>
                            <div>
                                <h4 class="font-heading font-bold text-text-primary text-base">Citra & Arya</h4>
                                <p class="text-text-secondary text-xs">Pernikahan di Bandung • Oktober 2026</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div x-show="activeIndex === 1" x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-300 absolute"
                        x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8"
                        class="bg-white rounded-3xl p-8 md:p-12 shadow-md border border-gray-100 flex flex-col md:flex-row gap-6 md:gap-8 items-center text-center md:text-left w-full"
                        style="display: none;">
                        <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=200" 
                            alt="Budi Santoso" 
                            class="w-20 h-20 rounded-full object-cover border-2 border-primary-gold shadow-sm">
                        <div class="space-y-4 flex-1">
                            <div class="flex items-center justify-center md:justify-start text-primary-gold gap-1 text-sm">
                                ★★★★★
                            </div>
                            <p class="font-subheading text-lg italic text-text-secondary leading-relaxed">
                                "Fitur RSVP-nya benar-benar live dan akurat! Buku tamu doanya juga seru dibaca. Kado amplop digital instan memudahkan teman-teman kami yang tidak bisa hadir untuk kirim hadiah."
                            </p>
                            <div>
                                <h4 class="font-heading font-bold text-text-primary text-base">Ani & Budi</h4>
                                <p class="text-text-secondary text-xs">Pernikahan di Bogor • Desember 2026</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 (Placeholder / Become first customer) -->
                    <div x-show="activeIndex === 2" x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-300 absolute"
                        x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8"
                        class="bg-white rounded-3xl p-8 md:p-12 shadow-md border border-dashed border-primary-gold/60 flex flex-col items-center text-center w-full gap-4 justify-center"
                        style="display: none;">
                        <div class="text-5xl">👑</div>
                        <h3 class="font-heading text-2xl font-bold text-text-primary">Jadilah pelanggan pertama kami!</h3>
                        <p class="text-text-secondary text-sm max-w-md">Kami berkomitmen memberikan layanan website undangan digital eksklusif terbaik untuk menyempurnakan hari bahagia Anda.</p>
                        <a href="/create" class="px-6 py-2.5 bg-primary-gold text-white text-xs font-semibold rounded-full hover:bg-[#b08f2e] transition-colors duration-300 shadow-md">
                            Tulis Cerita Bahagiamu
                        </a>
                    </div>
                </div>

                <!-- Navigation dots -->
                <div class="flex justify-center gap-2 mt-8 z-10 relative">
                    <button @click="activeIndex = 0" class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                        :class="activeIndex === 0 ? 'bg-primary-gold w-6' : 'bg-gray-300 hover:bg-gray-400'"></button>
                    <button @click="activeIndex = 1" class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                        :class="activeIndex === 1 ? 'bg-primary-gold w-6' : 'bg-gray-300 hover:bg-gray-400'"></button>
                    <button @click="activeIndex = 2" class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                        :class="activeIndex === 2 ? 'bg-primary-gold w-6' : 'bg-gray-300 hover:bg-gray-400'"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq" class="py-24 px-6 bg-white relative">
        <div class="max-w-4xl mx-auto">
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto space-y-4 mb-16">
                <span class="text-primary-gold text-xs font-semibold uppercase tracking-widest block">Got Questions?</span>
                <h2 class="font-heading text-4xl font-bold text-text-primary">Frequently Asked Questions</h2>
                <div class="w-20 h-[2px] bg-primary-gold/60 mx-auto"></div>
            </div>

            <!-- Accordions Container -->
            <div x-data="{ active: null }" class="space-y-4">
                
                <!-- FAQ Item 1 -->
                <div class="border border-gray-100 rounded-2xl shadow-sm bg-white overflow-hidden transition-all duration-300"
                    :class="active === 1 ? 'border-primary-gold/40 shadow-md' : ''">
                    <button @click="active = (active === 1 ? null : 1)" 
                        class="w-full flex items-center justify-between p-6 text-left font-semibold text-text-primary hover:text-primary-gold transition-colors duration-300 focus:outline-none">
                        <span>Berapa lama proses pengerjaan?</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-gold" 
                            :class="active === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 1" x-collapse x-cloak
                        class="px-6 pb-6 text-sm text-text-secondary leading-relaxed border-t border-gray-50 pt-4">
                        Proses pembuatan undangan digital kami bersifat instan! Setelah mengisi detail biodata, foto, dan tanggal acara pada form builder, website undangan Anda langsung aktif detik itu juga dan siap dibagikan.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-100 rounded-2xl shadow-sm bg-white overflow-hidden transition-all duration-300"
                    :class="active === 2 ? 'border-primary-gold/40 shadow-md' : ''">
                    <button @click="active = (active === 2 ? null : 2)" 
                        class="w-full flex items-center justify-between p-6 text-left font-semibold text-text-primary hover:text-primary-gold transition-colors duration-300 focus:outline-none">
                        <span>Apakah bisa custom warna?</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-gold" 
                            :class="active === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 2" x-collapse x-cloak
                        class="px-6 pb-6 text-sm text-text-secondary leading-relaxed border-t border-gray-50 pt-4">
                        Ya! Khusus bagi pengguna paket Premium dan Custom, Anda dibebaskan untuk mengatur dan memilih palet warna khusus serta menentukan font undangan agar selaras dengan konsep/warna tema dekorasi pernikahan fisik Anda.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-100 rounded-2xl shadow-sm bg-white overflow-hidden transition-all duration-300"
                    :class="active === 3 ? 'border-primary-gold/40 shadow-md' : ''">
                    <button @click="active = (active === 3 ? null : 3)" 
                        class="w-full flex items-center justify-between p-6 text-left font-semibold text-text-primary hover:text-primary-gold transition-colors duration-300 focus:outline-none">
                        <span>Apakah bisa request lagu?</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-gold" 
                            :class="active === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 3" x-collapse x-cloak
                        class="px-6 pb-6 text-sm text-text-secondary leading-relaxed border-t border-gray-50 pt-4">
                        Tentu bisa! Kami menyediakan galeri koleksi lagu latar romantis instan terpopuler. Jika Anda ingin menggunakan lagu kesukaan tersendiri, Anda dapat menyematkan link lagu dari YouTube atau mengunggah format audio sendiri di form pengisian data.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border border-gray-100 rounded-2xl shadow-sm bg-white overflow-hidden transition-all duration-300"
                    :class="active === 4 ? 'border-primary-gold/40 shadow-md' : ''">
                    <button @click="active = (active === 4 ? null : 4)" 
                        class="w-full flex items-center justify-between p-6 text-left font-semibold text-text-primary hover:text-primary-gold transition-colors duration-300 focus:outline-none">
                        <span>Berapa kali revisi?</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-gold" 
                            :class="active === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 4" x-collapse x-cloak
                        class="px-6 pb-6 text-sm text-text-secondary leading-relaxed border-t border-gray-50 pt-4">
                        Paket Premium mendapatkan layanan revisi minor data sebanyak 2 kali. Sedangkan untuk paket Custom, Anda akan mendapatkan revisi minor tanpa batas (unlimited) demi memastikan hasil yang sempurna.
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="border border-gray-100 rounded-2xl shadow-sm bg-white overflow-hidden transition-all duration-300"
                    :class="active === 5 ? 'border-primary-gold/40 shadow-md' : ''">
                    <button @click="active = (active === 5 ? null : 5)" 
                        class="w-full flex items-center justify-between p-6 text-left font-semibold text-text-primary hover:text-primary-gold transition-colors duration-300 focus:outline-none">
                        <span>Bagaimana proses pembayaran?</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-gold" 
                            :class="active === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 5" x-collapse x-cloak
                        class="px-6 pb-6 text-sm text-text-secondary leading-relaxed border-t border-gray-50 pt-4">
                        Proses pembayaran sangat mudah dan praktis. Pembayaran dilakukan via transfer rekening Bank (BCA/Mandiri/BNI) atau digital e-wallet (GoPay/OVO/Dana) setelah Anda selesai mengkonfirmasi pilihan paket undangan yang diinginkan.
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="border border-gray-100 rounded-2xl shadow-sm bg-white overflow-hidden transition-all duration-300"
                    :class="active === 6 ? 'border-primary-gold/40 shadow-md' : ''">
                    <button @click="active = (active === 6 ? null : 6)" 
                        class="w-full flex items-center justify-between p-6 text-left font-semibold text-text-primary hover:text-primary-gold transition-colors duration-300 focus:outline-none">
                        <span>Apakah domain termasuk?</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300 text-primary-gold" 
                            :class="active === 6 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 6" x-collapse x-cloak
                        class="px-6 pb-6 text-sm text-text-secondary leading-relaxed border-t border-gray-50 pt-4">
                        Untuk paket Basic & Premium, nama link website default mengikuti format domain kami `weddingkita.com/slug-anda`. Namun khusus untuk paket Custom, domain kustom tersendiri (.com / .id) sudah termasuk langsung dalam harga paket.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section id="contact" class="py-20 px-6 bg-white relative">
        <div class="max-w-6xl mx-auto">
            <div class="bg-gradient-to-r from-primary-gold via-[#e6bf47] to-accent-gold rounded-[2.5rem] p-10 md:p-20 relative overflow-hidden shadow-2xl flex items-center justify-center text-center">
                
                <!-- Left Flower Illustration SVG -->
                <div class="absolute -left-6 bottom-0 w-32 md:w-56 opacity-20 text-white pointer-events-none select-none animate-float-slow">
                    <svg viewBox="0 0 100 100" fill="currentColor">
                        <path d="M 0 100 C 20 80, 40 90, 50 50 C 40 40, 20 20, 0 50 Z M 20 80 C 35 60, 45 45, 50 20 C 60 45, 70 60, 85 80 Z" />
                    </svg>
                </div>

                <!-- Right Flower Illustration SVG -->
                <div class="absolute -right-6 top-0 w-32 md:w-56 opacity-20 text-white pointer-events-none select-none animate-float-medium" style="animation-delay: 2s;">
                    <svg viewBox="0 0 100 100" fill="currentColor">
                        <path d="M 100 0 C 80 20, 60 10, 50 50 C 60 60, 80 80, 100 50 Z M 80 20 C 65 40, 55 55, 50 80 C 40 55, 30 40, 15 20 Z" />
                    </svg>
                </div>

                <div class="space-y-8 max-w-2xl mx-auto z-10 text-white">
                    <h2 class="font-heading text-4xl sm:text-5xl md:text-6xl font-bold leading-tight drop-shadow-sm">
                        Siap Membuat Undangan Pernikahan Impianmu?
                    </h2>
                    <p class="text-white/90 text-base sm:text-lg max-w-xl mx-auto leading-relaxed">
                        Hubungi kami sekarang dan dapatkan website undangan yang elegan dan siap dibagikan dalam sekali klik.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-2">
                        <a href="https://wa.me/6281234567890?text=Halo%20WeddingKita,%20saya%20tertarik%20untuk%20memesan%20undangan%20pernikahan%20digital." 
                            target="_blank" @click="ripple($event)"
                            class="ripple px-8 py-4 bg-white text-primary-gold hover:bg-secondary-ivory font-bold rounded-full shadow-lg hover:scale-105 active:scale-95 transition-all duration-300">
                            Pesan via WhatsApp
                        </a>
                        <button @click.prevent="currentPreviewUrl = '/budi-ani?to=Tamu+Spesial'; currentPreviewTheme = 'classic-emerald'; showPreviewModal = true;"
                            class="px-8 py-4 border-2 border-white/40 hover:border-white text-white hover:bg-white/10 font-bold rounded-full hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
                            Lihat Demo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black text-white py-16 px-6 relative border-t border-white/5">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">
            <!-- Brand Column -->
            <div class="space-y-4">
                <a href="#" class="flex items-center gap-2">
                    <span class="text-xl">⚜️</span>
                    <span class="font-heading text-xl font-bold tracking-wide text-white">WeddingKita</span>
                </a>
                <p class="text-gray-400 text-xs leading-relaxed">
                    Menghadirkan layanan undangan pernikahan digital premium, elegan, dan minimalis. Wujudkan hari pernikahan impian Anda bersama kami.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h4 class="font-heading text-sm font-bold tracking-wider uppercase text-primary-gold">Quick Links</h4>
                <ul class="space-y-2 text-xs text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors duration-300">Home</a></li>
                    <li><a href="#tema" class="hover:text-white transition-colors duration-300">Katalog Tema</a></li>
                    <li><a href="#fitur" class="hover:text-white transition-colors duration-300">Fitur Utama</a></li>
                    <li><a href="#harga" class="hover:text-white transition-colors duration-300">Harga Paket</a></li>
                </ul>
            </div>

            <!-- Social Media / Contact -->
            <div class="space-y-4">
                <h4 class="font-heading text-sm font-bold tracking-wider uppercase text-primary-gold">Hubungi Kami</h4>
                <ul class="space-y-2 text-xs text-gray-400">
                    <li class="flex items-center gap-2">
                        <span>💬</span> <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-white transition-colors duration-300">WhatsApp: +62 812-3456-7890</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <span>📸</span> <a href="https://instagram.com/weddingkita" target="_blank" class="hover:text-white transition-colors duration-300">Instagram: @weddingkita</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <span>✉️</span> <a href="mailto:support@weddingkita.com" class="hover:text-white transition-colors duration-300">Email: support@weddingkita.com</a>
                    </li>
                </ul>
            </div>

            <!-- Copyright info -->
            <div class="space-y-4 md:text-right">
                <h4 class="font-heading text-sm font-bold tracking-wider uppercase text-primary-gold">Copyright</h4>
                <p class="text-gray-400 text-xs leading-relaxed">
                    © 2026 WeddingKita.com. <br>All rights reserved.
                </p>
                <p class="text-[10px] text-gray-500 italic mt-2">
                    Dibuat dengan cinta untuk menyatukan dua hati.
                </p>
            </div>
        </div>
    </footer>

    <!-- STUNNING INTERACTIVE RESPONSIVE LIVE PREVIEW MODAL -->
    <div x-show="showPreviewModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-[100] flex items-center justify-center p-0 md:p-6"
        style="display: none;">

        <!-- Backdrop with High-end Glassmorphism -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md"
            @click="showPreviewModal = false"></div>

        <!-- Modal Content Container -->
        <div x-show="showPreviewModal" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="relative bg-secondary-ivory border border-primary-gold/20 w-full h-full md:h-[90vh] md:max-h-[850px] md:max-w-7xl shadow-2xl z-10 md:rounded-[2.5rem] flex flex-col md:flex-row overflow-hidden">

            <!-- CLOSE BUTTON (Floating Desktop) -->
            <button @click="showPreviewModal = false"
                class="hidden md:flex absolute top-6 right-6 w-11 h-11 rounded-full bg-white border border-primary-gold/15 text-primary-gold items-center justify-center hover:bg-secondary-ivory transition duration-300 cursor-pointer shadow-md text-base font-bold z-30">
                ✕
            </button>

            <!-- MOBILE TOP NAVIGATION BAR -->
            <div class="flex md:hidden items-center justify-between px-4 py-3 bg-white border-b border-primary-gold/10 sticky top-0 z-20 w-full shadow-sm">
                <button @click="showPreviewModal = false"
                    class="text-xs font-bold text-text-primary flex items-center gap-1.5 cursor-pointer">
                    ← Kembali
                </button>
                <div class="flex items-center">
                    <select
                        @change="currentPreviewTheme = $event.target.value; 
                            if($event.target.value === 'classic-emerald') currentPreviewUrl = '/preview/classic-emerald?to=Tamu+Spesial'; 
                            else if($event.target.value === 'rustic-gold') currentPreviewUrl = '/preview/rustic-gold?to=Tamu+Spesial'; 
                            else if($event.target.value === 'modern-minimalist') currentPreviewUrl = '/preview/modern-minimalist?to=Tamu+Spesial'; 
                            else if($event.target.value === 'elegant') currentPreviewUrl = '/preview/elegant?to=Tamu+Spesial'; 
                            else if($event.target.value === 'invitation') currentPreviewUrl = '/preview/invitation?to=Tamu+Spesial'; 
                            else if($event.target.value === 'rustic-floral') currentPreviewUrl = '/preview/rustic-floral?to=Tamu+Spesial'; 
                            else if($event.target.value === 'girl') currentPreviewUrl = '/preview/girl?to=Tamu+Spesial'; 
                            else currentPreviewUrl = '/preview/undangan?to=Tamu+Spesial';"
                        :value="currentPreviewTheme"
                        class="text-xs font-bold bg-secondary-ivory border border-primary-gold/20 rounded-xl px-3 py-1.5 text-text-primary focus:outline-none focus:ring-1 focus:ring-primary-gold">
                        <option value="classic-emerald">🌿 Classic Emerald</option>
                        <option value="rustic-gold">🍂 Rustic Gold</option>
                        <option value="modern-minimalist">▫️ Modern Minimalist</option>
                        <option value="elegant">💎 Elegant</option>
                        <option value="invitation">💌 Invitation</option>
                        <option value="undangan">🌸 Undangan</option>
                        <option value="rustic-floral">🌿 Rustic Floral</option>
                        <option value="girl">🎀 Sweet Girl</option>
                    </select>
                </div>
                <a :href="currentPreviewUrl" target="_blank"
                    class="text-xs font-bold text-primary-gold flex items-center gap-0.5">
                    Penuh ↗
                </a>
            </div>

            <!-- LEFT CONTROL PANEL: Theme Info & Switcher (Desktop) -->
            <div class="w-full md:w-[42%] bg-white border-r border-primary-gold/10 p-6 md:p-10 flex flex-col justify-between overflow-y-auto h-auto md:h-full">
                <div class="space-y-6">
                    <!-- Header -->
                    <div class="space-y-2">
                        <span class="inline-block px-3 py-1 bg-secondary-ivory text-primary-gold text-[10px] font-bold uppercase tracking-widest rounded-full border border-primary-gold/15">
                            📱 Live Preview Tema
                        </span>

                        <!-- Dynamic Theme Name and Palette -->
                        <div>
                            <template x-if="currentPreviewTheme === 'classic-emerald'">
                                <h3 class="text-2xl md:text-3xl font-heading text-text-primary font-bold">Midnight Sage</h3>
                            </template>
                            <template x-if="currentPreviewTheme === 'rustic-gold'">
                                <h3 class="text-2xl md:text-3xl font-heading text-text-primary font-bold">Dusty Rose Latte</h3>
                            </template>
                            <template x-if="currentPreviewTheme === 'modern-minimalist'">
                                <h3 class="text-2xl md:text-3xl font-heading text-text-primary font-bold">Modern Noir Gold</h3>
                            </template>
                            <template x-if="currentPreviewTheme === 'elegant'">
                                <h3 class="text-2xl md:text-3xl font-heading text-text-primary font-bold">Botanical Linen</h3>
                            </template>
                            <template x-if="currentPreviewTheme === 'invitation'">
                                <h3 class="text-2xl md:text-3xl font-heading text-text-primary font-bold">Artistic Invitation</h3>
                            </template>
                            <template x-if="currentPreviewTheme === 'undangan'">
                                <h3 class="text-2xl md:text-3xl font-heading text-text-primary font-bold">Classic Floral</h3>
                            </template>
                            <template x-if="currentPreviewTheme === 'rustic-floral'">
                                <h3 class="text-2xl md:text-3xl font-heading text-text-primary font-bold">Rustic Floral</h3>
                            </template>
                            <template x-if="currentPreviewTheme === 'girl'">
                                <h3 class="text-2xl md:text-3xl font-heading text-text-primary font-bold">Sweet Girl</h3>
                            </template>
                        </div>
                    </div>

                    <!-- Dynamic Description Copy -->
                    <div class="text-xs md:text-sm text-text-secondary leading-relaxed min-h-[100px]">
                        <template x-if="currentPreviewTheme === 'classic-emerald'">
                            <div class="space-y-3">
                                <p>Desain bertema <b>Sage Green</b> & <b>Warm Ivory</b> yang anggun. Sangat memukau bagi pasangan yang menyukai kehangatan alam, nuansa intim pedesaan, serta keindahan visual estetik klasik.</p>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#3e5643]"></span>
                                    <span class="text-[10px] font-bold text-text-secondary"> Sage Green • Warm Ivory • Gold Accent</span>
                                </div>
                            </div>
                        </template>
                        <template x-if="currentPreviewTheme === 'rustic-gold'">
                            <div class="space-y-3">
                                <p>Perpaduan warna <b>musim gugur hangat (Autumnal Forest)</b> beraksen Terracotta, Cokelat hangat, dan Emas antik. Sangat romantis, hangat, dan memberikan atmosfer pernikahan yang bersahaja serta berkelas.</p>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-primary-gold"></span>
                                    <span class="text-[10px] font-bold text-text-secondary"> Terracotta • Cozy Cream • Antique Gold</span>
                                </div>
                            </div>
                        </template>
                        <template x-if="currentPreviewTheme === 'modern-minimalist'">
                            <div class="space-y-3">
                                <p>Tampilan bergaya <b>majalah editorial kontemporer</b> modern yang bersih. Didominasi warna monokrom Slate Black dan Putih Bersih, dipercantik aksen Rose Gold mewah yang mewah dan elegan.</p>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-black"></span>
                                    <span class="text-[10px] font-bold text-text-secondary"> Slate Charcoal • Pure White • Rose Gold</span>
                                </div>
                            </div>
                        </template>
                        <template x-if="currentPreviewTheme === 'elegant'">
                            <div class="space-y-3">
                                <p>Desain eksklusif bergaya <b>elegan dan mempesona</b>. Memiliki tampilan yang bersih dan mewah, sangat cocok untuk acara pernikahan yang mewah dan berkelas dengan paduan warna biru donker dan perak.</p>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-blue-900"></span>
                                    <span class="text-[10px] font-bold text-text-secondary"> Navy Blue • Light Blue • Silver</span>
                                </div>
                            </div>
                        </template>
                        <template x-if="currentPreviewTheme === 'invitation'">
                            <div class="space-y-3">
                                <p>Desain <b>undangan modern</b> dengan sentuhan artistik yang lembut. Memberikan kesan romantis dan hangat yang tak terlupakan bagi tamu undangan Anda, dihiasi warna ungu dan lavender.</p>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-purple-900"></span>
                                    <span class="text-[10px] font-bold text-text-secondary"> Deep Purple • Soft Pink • Lavender</span>
                                </div>
                            </div>
                        </template>
                        <template x-if="currentPreviewTheme === 'undangan'">
                            <div class="space-y-3">
                                <p>Desain <b>undangan klasik</b> dengan ornamen bunga yang indah. Menghadirkan nuansa manis dan penuh cinta yang cocok untuk acara sakral dengan balutan warna zamrud dan emas.</p>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-900"></span>
                                    <span class="text-[10px] font-bold text-text-secondary"> Emerald Green • Rose Pink • Soft Gold</span>
                                </div>
                            </div>
                        </template>
                        <template x-if="currentPreviewTheme === 'rustic-floral'">
                            <div class="space-y-3">
                                <p>Tema <b>Rustic yang elegan</b> dengan hiasan bunga-bunga cantik yang menawan. Cocok untuk pernikahan dengan nuansa kebun atau outdoor.</p>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#A38570]"></span>
                                    <span class="text-[10px] font-bold text-text-secondary"> Rustic Brown • Floral Pink • Soft White</span>
                                </div>
                            </div>
                        </template>
                        <template x-if="currentPreviewTheme === 'girl'">
                            <div class="space-y-3">
                                <p>Desain undangan manis dengan sentuhan <b>warna pink</b> dan gaya yang imut. Sangat cocok untuk pasangan yang menginginkan kesan cute dan romantis.</p>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-pink-400"></span>
                                    <span class="text-[10px] font-bold text-text-secondary"> Soft Pink • Cute White • Sweet Rose</span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <hr class="border-gray-100">

                    <!-- Theme Switcher Buttons List -->
                    <div class="space-y-3">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block">Pilih Gaya Desain:</span>
                        <div class="grid grid-cols-1 gap-2.5">
                            <!-- Midnight Sage Selector -->
                            <button
                                @click="currentPreviewUrl = '/preview/classic-emerald?to=Tamu+Spesial'; currentPreviewTheme = 'classic-emerald';"
                                class="w-full flex items-center justify-between p-3 rounded-xl border text-left transition-all duration-300 cursor-pointer shadow-sm hover:scale-[1.01]"
                                :class="currentPreviewTheme === 'classic-emerald' ? 'bg-secondary-ivory border-primary-gold text-primary-gold font-bold' : 'bg-white hover:bg-gray-50 border-gray-200 text-text-primary'">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">🌿</span>
                                    <div>
                                        <p class="text-xs leading-none font-bold">Midnight Sage</p>
                                        <p class="text-[9px] text-text-secondary mt-1">Cottagecore Sage Green</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold" x-show="currentPreviewTheme === 'classic-emerald'">✓ Aktif</span>
                            </button>

                            <!-- Dusty Rose Latte Selector -->
                            <button
                                @click="currentPreviewUrl = '/preview/rustic-gold?to=Tamu+Spesial'; currentPreviewTheme = 'rustic-gold';"
                                class="w-full flex items-center justify-between p-3 rounded-xl border text-left transition-all duration-300 cursor-pointer shadow-sm hover:scale-[1.01]"
                                :class="currentPreviewTheme === 'rustic-gold' ? 'bg-secondary-ivory border-primary-gold text-primary-gold font-bold' : 'bg-white hover:bg-gray-50 border-gray-200 text-text-primary'">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">🍂</span>
                                    <div>
                                        <p class="text-xs leading-none font-bold">Dusty Rose Latte</p>
                                        <p class="text-[9px] text-text-secondary mt-1">Autumnal Terracotta</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold" x-show="currentPreviewTheme === 'rustic-gold'">✓ Aktif</span>
                            </button>

                            <!-- Modern Noir Gold Selector -->
                            <button
                                @click="currentPreviewUrl = '/preview/modern-minimalist?to=Tamu+Spesial'; currentPreviewTheme = 'modern-minimalist';"
                                class="w-full flex items-center justify-between p-3 rounded-xl border text-left transition-all duration-300 cursor-pointer shadow-sm hover:scale-[1.01]"
                                :class="currentPreviewTheme === 'modern-minimalist' ? 'bg-secondary-ivory border-primary-gold text-primary-gold font-bold' : 'bg-white hover:bg-gray-50 border-gray-200 text-text-primary'">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">▫️</span>
                                    <div>
                                        <p class="text-xs leading-none font-bold">Modern Noir Gold</p>
                                        <p class="text-[9px] text-text-secondary mt-1">Luxury Black Gold</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold" x-show="currentPreviewTheme === 'modern-minimalist'">✓ Aktif</span>
                            </button>

                            <!-- Botanical Linen Selector -->
                            <button
                                @click="currentPreviewUrl = '/preview/elegant?to=Tamu+Spesial'; currentPreviewTheme = 'elegant';"
                                class="w-full flex items-center justify-between p-3 rounded-xl border text-left transition-all duration-300 cursor-pointer shadow-sm hover:scale-[1.01]"
                                :class="currentPreviewTheme === 'elegant' ? 'bg-secondary-ivory border-primary-gold text-primary-gold font-bold' : 'bg-white hover:bg-gray-50 border-gray-200 text-text-primary'">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">💎</span>
                                    <div>
                                        <p class="text-xs leading-none font-bold">Botanical Linen</p>
                                        <p class="text-[9px] text-text-secondary mt-1">Exclusive Navy Minimalist</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold" x-show="currentPreviewTheme === 'elegant'">✓ Aktif</span>
                            </button>

                            <!-- Artistic Invitation Selector -->
                            <button
                                @click="currentPreviewUrl = '/preview/invitation?to=Tamu+Spesial'; currentPreviewTheme = 'invitation';"
                                class="w-full flex items-center justify-between p-3 rounded-xl border text-left transition-all duration-300 cursor-pointer shadow-sm hover:scale-[1.01]"
                                :class="currentPreviewTheme === 'invitation' ? 'bg-secondary-ivory border-primary-gold text-primary-gold font-bold' : 'bg-white hover:bg-gray-50 border-gray-200 text-text-primary'">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">💌</span>
                                    <div>
                                        <p class="text-xs leading-none font-bold">Artistic Invitation</p>
                                        <p class="text-[9px] text-text-secondary mt-1">Artistic Lavender</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold" x-show="currentPreviewTheme === 'invitation'">✓ Aktif</span>
                            </button>

                            <!-- Classic Floral Selector -->
                            <button
                                @click="currentPreviewUrl = '/preview/undangan?to=Tamu+Spesial'; currentPreviewTheme = 'undangan';"
                                class="w-full flex items-center justify-between p-3 rounded-xl border text-left transition-all duration-300 cursor-pointer shadow-sm hover:scale-[1.01]"
                                :class="currentPreviewTheme === 'undangan' ? 'bg-secondary-ivory border-primary-gold text-primary-gold font-bold' : 'bg-white hover:bg-gray-50 border-gray-200 text-text-primary'">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">🌸</span>
                                    <div>
                                        <p class="text-xs leading-none font-bold">Classic Floral</p>
                                        <p class="text-[9px] text-text-secondary mt-1">Classic Emerald Floral</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold" x-show="currentPreviewTheme === 'undangan'">✓ Aktif</span>
                            </button>

                            <!-- Rustic Floral Selector -->
                            <button
                                @click="currentPreviewUrl = '/preview/rustic-floral?to=Tamu+Spesial'; currentPreviewTheme = 'rustic-floral';"
                                class="w-full flex items-center justify-between p-3 rounded-xl border text-left transition-all duration-300 cursor-pointer shadow-sm hover:scale-[1.01]"
                                :class="currentPreviewTheme === 'rustic-floral' ? 'bg-secondary-ivory border-primary-gold text-primary-gold font-bold' : 'bg-white hover:bg-gray-50 border-gray-200 text-text-primary'">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">🌿</span>
                                    <div>
                                        <p class="text-xs leading-none font-bold">Rustic Floral</p>
                                        <p class="text-[9px] text-text-secondary mt-1">Elegant Rustic Brown</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold" x-show="currentPreviewTheme === 'rustic-floral'">✓ Aktif</span>
                            </button>

                            <!-- Sweet Girl Selector -->
                            <button
                                @click="currentPreviewUrl = '/preview/girl?to=Tamu+Spesial'; currentPreviewTheme = 'girl';"
                                class="w-full flex items-center justify-between p-3 rounded-xl border text-left transition-all duration-300 cursor-pointer shadow-sm hover:scale-[1.01]"
                                :class="currentPreviewTheme === 'girl' ? 'bg-secondary-ivory border-primary-gold text-primary-gold font-bold' : 'bg-white hover:bg-gray-50 border-gray-200 text-text-primary'">
                                <div class="flex items-center gap-3">
                                    <span class="text-lg">🎀</span>
                                    <div>
                                        <p class="text-xs leading-none font-bold">Sweet Girl</p>
                                        <p class="text-[9px] text-text-secondary mt-1">Cute Pink Style</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold" x-show="currentPreviewTheme === 'girl'">✓ Aktif</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Footer Call to Actions (Desktop) -->
                <div class="hidden md:flex flex-col gap-3 mt-6">
                    <a href="/create"
                        class="w-full py-3.5 bg-primary-gold hover:bg-[#b08f2e] text-white text-xs font-bold text-center rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                        ✨ Buat Undangan Sekarang (Gratis)
                    </a>
                    <div class="flex gap-2">
                        <a :href="currentPreviewUrl" target="_blank"
                            class="flex-1 py-2.5 bg-white border border-primary-gold/20 hover:bg-secondary-ivory text-text-primary text-[11px] font-bold text-center rounded-xl transition duration-300">
                            Buka Layar Penuh ↗
                        </a>
                        <button @click="showPreviewModal = false"
                            class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-text-secondary text-[11px] font-bold text-center rounded-xl transition duration-300 cursor-pointer">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>

            <!-- RIGHT PREVIEW PANEL: Responsive Simulated Mobile Viewport -->
            <div class="w-full md:w-[58%] bg-[#f5efe2] md:bg-gray-100 p-4 md:p-8 flex items-center justify-center flex-1 min-h-0 md:h-full overflow-hidden">
                <div class="w-full h-full flex justify-center items-center overflow-hidden">

                    <!-- Smartphone Mockup Frame (visible on desktop) -->
                    <div class="hidden md:block relative border-gray-900 bg-gray-900 border-[12px] rounded-[2.5rem] shadow-[0_25px_60px_-15px_rgba(0,0,0,0.4)] overflow-hidden flex-shrink-0" style="height: 70vh; max-height: 600px; aspect-ratio: 9/19.5; width: auto;">
                        <!-- Camera & Speaker Island -->
                        <div class="absolute top-0 left-1/2 transform -translate-x-1/2 h-3.5 w-28 bg-gray-900 rounded-b-xl z-20 flex items-center justify-center">
                            <div class="w-2 h-2 rounded-full bg-slate-900 border border-slate-800"></div>
                        </div>
                        <!-- Bottom Home indicator bar -->
                        <div class="absolute bottom-1 left-1/2 transform -translate-x-1/2 h-1 w-20 bg-gray-700/80 rounded-full z-20"></div>

                        <!-- Mobile simulated screen iframe -->
                        <div class="w-full h-full bg-[#faf6ee] overflow-hidden rounded-[1.8rem] relative">
                            <iframe :src="currentPreviewUrl" class="w-full h-full border-none" style="scrollbar-width: none;"></iframe>
                        </div>
                    </div>

                    <!-- Viewport Frame (visible on mobile/tablet) -->
                    <div class="block md:hidden w-full h-full bg-white rounded-2xl shadow-lg border border-primary-gold/10 overflow-hidden relative">
                        <iframe :src="currentPreviewUrl" class="w-full h-full border-none" style="scrollbar-width: none;"></iframe>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @stack('modals')
</body>

</html>