<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0b0b0c">
    <title>Undangan Pernikahan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --bg:#070708;
            --bg2:#0c0c0e;
            --card:rgba(255,255,255,.08);
            --stroke:rgba(255,255,255,.14);
            --text:#f5f5f7;
            --muted:rgba(245,245,247,.72);
            --silver:#c7c7cd;
            --rose:#d8a6b6;
            --shadow:0 30px 80px rgba(0,0,0,.45);
            --radius:28px;
        }

        *{box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{
            margin:0;
            background:radial-gradient(circle at top, rgba(216,166,182,.12), transparent 35%), linear-gradient(180deg, var(--bg), var(--bg2));
            color:var(--text);
            font-family:'Inter',sans-serif;
            overflow-x:hidden;
        }
        img{max-width:100%; display:block}
        a{text-decoration:none; color:inherit}
        .container{width:min(1180px, calc(100% - 32px)); margin-inline:auto}
        .btn{
            display:inline-flex; align-items:center; justify-content:center;
            gap:.6rem; padding:14px 22px; border-radius:999px;
            border:1px solid rgba(255,255,255,.18); background:rgba(255,255,255,.06);
            color:var(--text); backdrop-filter:blur(18px);
            transition:.3s ease; cursor:pointer;
        }
        .btn:hover{transform:translateY(-2px); border-color:rgba(216,166,182,.55); box-shadow:0 18px 40px rgba(0,0,0,.25)}
        .btn.primary{background:linear-gradient(135deg, rgba(216,166,182,.95), rgba(199,199,205,.9)); color:#111}
        .section{padding:100px 0; position:relative}
        .section-title{
            font-family:'Playfair Display',serif;
            font-size:clamp(2rem, 3vw, 3.4rem);
            line-height:1.1;
            margin:0 0 14px;
            letter-spacing:.01em;
        }
        .section-sub{color:var(--muted); max-width:680px; margin:0 0 34px; line-height:1.8}

        .reveal{opacity:0; transform:translateY(26px); transition:opacity .8s ease, transform .8s ease}
        .reveal.show{opacity:1; transform:none}

        /* opening */
        .opening{
            min-height:100svh; position:relative; display:grid; place-items:center; overflow:hidden;
            isolation:isolate;
        }
        .opening video{
            position:absolute; inset:0; width:100%; height:100%; object-fit:cover;
            filter:brightness(.38) contrast(1.05) saturate(.85);
            transform:scale(1.04);
        }
        .opening::after{
            content:""; position:absolute; inset:0;
            background:linear-gradient(180deg, rgba(7,7,8,.28), rgba(7,7,8,.82));
            z-index:1;
        }
        .opening-content{
            position:relative; z-index:2; text-align:center; width:min(900px, calc(100% - 32px));
            padding:40px 0;
        }
        .eyebrow{
            display:inline-flex; align-items:center; gap:.7rem; padding:10px 16px; border-radius:999px;
            background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.12);
            backdrop-filter:blur(14px); color:var(--silver); font-size:.88rem; letter-spacing:.16em; text-transform:uppercase;
        }
        .names{
            font-family:'Playfair Display',serif;
            font-size:clamp(3rem, 9vw, 6.8rem);
            line-height:.95;
            margin:22px 0 14px;
            text-shadow:0 16px 50px rgba(0,0,0,.55);
        }
        .names span{
            display:inline-block;
            background:linear-gradient(90deg, #fff, var(--silver), var(--rose), #fff);
            -webkit-background-clip:text;
            background-clip:text;
            color:transparent;
            background-size:200% auto;
            animation:shimmer 7s linear infinite;
        }
        .opening p{color:rgba(255,255,255,.8); font-size:1.05rem; line-height:1.9; max-width:680px; margin:0 auto 24px}
        .opening-actions{display:flex; gap:12px; justify-content:center; flex-wrap:wrap}

        /* panels */
        .glass{
            background:linear-gradient(180deg, rgba(255,255,255,.11), rgba(255,255,255,.05));
            border:1px solid var(--stroke);
            backdrop-filter:blur(18px);
            box-shadow:var(--shadow);
            border-radius:var(--radius);
        }
        .grid-2{display:grid; grid-template-columns:repeat(2,1fr); gap:22px}
        .grid-3{display:grid; grid-template-columns:repeat(3,1fr); gap:22px}
        .card{padding:24px}
        .label{font-size:.82rem; text-transform:uppercase; letter-spacing:.18em; color:var(--rose); margin-bottom:10px}
        .big{
            font-family:'Playfair Display',serif; font-size:clamp(1.7rem, 2.5vw, 2.8rem); line-height:1.15; margin:0 0 10px;
        }
        .muted{color:var(--muted); line-height:1.8}

        /* countdown */
        .countdown{display:grid; grid-template-columns:repeat(4,1fr); gap:14px}
        .count-item{
            padding:18px 12px; text-align:center; border-radius:22px;
            background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1);
        }
        .count-item strong{display:block; font-size:2rem; font-family:'Playfair Display',serif}
        .count-item span{font-size:.82rem; color:var(--muted); letter-spacing:.12em; text-transform:uppercase}

        /* timeline */
        .timeline{position:relative; display:grid; gap:18px}
        .timeline::before{
            content:""; position:absolute; left:18px; top:0; bottom:0; width:1px;
            background:linear-gradient(180deg, rgba(216,166,182,.8), rgba(255,255,255,.05));
        }
        .timeline-item{
            position:relative; padding:10px 10px 10px 52px;
        }
        .timeline-item::before{
            content:""; position:absolute; left:10px; top:16px; width:16px; height:16px; border-radius:50%;
            background:linear-gradient(135deg, var(--rose), var(--silver));
            box-shadow:0 0 0 6px rgba(216,166,182,.14);
        }

        /* gallery */
        .masonry{columns:3 260px; column-gap:18px}
        .shot{
            break-inside:avoid; margin-bottom:18px; overflow:hidden; border-radius:22px;
            position:relative; border:1px solid rgba(255,255,255,.08);
        }
        .shot img{width:100%; height:auto; transition:transform .6s ease}
        .shot:hover img{transform:scale(1.04)}
        .shot::after{
            content:""; position:absolute; inset:0;
            background:linear-gradient(180deg, transparent, rgba(0,0,0,.18));
        }

        /* form */
        .form{
            display:grid; gap:14px;
        }
        .input, .select, .textarea{
            width:100%; padding:15px 16px; border-radius:18px;
            border:1px solid rgba(255,255,255,.12);
            background:rgba(255,255,255,.05); color:var(--text);
            outline:none; font:inherit;
        }
        .textarea{min-height:130px; resize:vertical}
        .input::placeholder, .textarea::placeholder{color:rgba(245,245,247,.45)}
        .actions{display:flex; gap:12px; flex-wrap:wrap; margin-top:6px}

        /* maps */
        .map-wrap{overflow:hidden; border-radius:24px; border:1px solid rgba(255,255,255,.08); min-height:360px}
        .map-wrap iframe{width:100%; height:360px; border:0; filter:grayscale(1) contrast(1.05) brightness(.92)}

        /* music */
        .music-btn{
            position:fixed; right:18px; bottom:18px; z-index:50;
            width:56px; height:56px; border-radius:50%; display:grid; place-items:center;
            border:1px solid rgba(255,255,255,.15); background:rgba(255,255,255,.08);
            backdrop-filter:blur(18px); cursor:pointer;
        }

        /* modal open */
        .cover{
            position:fixed; inset:0; z-index:80; display:grid; place-items:center;
            background:radial-gradient(circle at top, rgba(216,166,182,.18), transparent 40%), rgba(5,5,6,.94);
            transition:.6s ease;
        }
        .cover.hide{opacity:0; visibility:hidden; pointer-events:none}
        .cover-box{
            width:min(520px, calc(100% - 32px)); text-align:center; padding:32px;
        }

        @keyframes shimmer{0%{background-position:0% center}100%{background-position:200% center}}
        @media (max-width: 920px){
            .grid-2,.grid-3{grid-template-columns:1fr}
            .countdown{grid-template-columns:repeat(2,1fr)}
            .section{padding:76px 0}
        }
    </style>
</head>
<body>

    <div id="cover" class="cover">
        <div class="cover-box glass">
            <div class="eyebrow" style="margin-bottom:18px;">Wedding Invitation</div>
            <h1 class="big">A Perfectly Crafted Celebration</h1>
            <p class="muted">Sebuah undangan digital premium dengan nuansa eksklusif, elegan, dan modern.</p>
            <button class="btn primary" onclick="openInvitation()">Buka Undangan</button>
        </div>
    </div>

    <button class="music-btn" id="musicBtn" aria-label="Toggle music">♪</button>
    <audio id="bgMusic" loop preload="none">
        <source src="{{ asset('music/background.mp3') }}" type="audio/mpeg">
    </audio>

    <section class="opening">
        <video autoplay muted loop playsinline poster="{{ asset('images/cover.jpg') }}">
            <source src="{{ asset('video/opening.mp4') }}" type="video/mp4">
        </video>

        <div class="opening-content reveal">
            <div class="eyebrow">Save The Date • 2025</div>
            <h1 class="names"><span>Nama Mempelai</span></h1>
            <p>
                Dengan penuh cinta dan syukur, kami mengundang Anda untuk hadir dan merayakan hari istimewa kami dalam suasana yang hangat dan berkesan.
            </p>
            <div class="opening-actions">
                <a href="#details" class="btn primary">Lihat Detail</a>
                <a href="#rsvp" class="btn">RSVP Sekarang</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container grid-2">
            <div class="glass card reveal">
                <div class="label">Countdown</div>
                <h2 class="big">Hari bahagia kami semakin dekat.</h2>
                <div class="countdown" id="countdown"></div>
            </div>
            <div class="glass card reveal">
                <div class="label">Romantic Quote</div>
                <h2 class="big">“Two souls, one heart, one beautiful journey.”</h2>
                <p class="muted">Cinta tidak hanya tentang bertemu, tetapi tentang memilih satu sama lain setiap hari.</p>
            </div>
        </div>
    </section>

    <section class="section" id="details">
        <div class="container">
            <h2 class="section-title reveal">Detail Acara</h2>
            <p class="section-sub reveal">Informasi acara ditampilkan dalam card glassmorphism agar tetap terasa mewah, ringan, dan mudah dibaca di berbagai perangkat.</p>

            <div class="grid-3">
                <div class="glass card reveal">
                    <div class="label">Akad Nikah</div>
                    <h3 class="big" style="font-size:1.8rem">Sabtu, 20 September 2026</h3>
                    <p class="muted">08.00 WIB — Selesai</p>
                    <p class="muted">Lokasi: Ballroom Aurora, Malang</p>
                </div>
                <div class="glass card reveal">
                    <div class="label">Resepsi</div>
                    <h3 class="big" style="font-size:1.8rem">Sabtu, 20 September 2026</h3>
                    <p class="muted">11.00 WIB — 14.00 WIB</p>
                    <p class="muted">Dress code: Black, White, Silver</p>
                </div>
                <div class="glass card reveal">
                    <div class="label">Dress & Vibe</div>
                    <h3 class="big" style="font-size:1.8rem">Elegant Premium</h3>
                    <p class="muted">Nuansa modern minimalis dengan sentuhan rose gold dan silver yang halus.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title reveal">Love Story</h2>
            <p class="section-sub reveal">Timeline modern untuk menampilkan perjalanan cinta kalian secara singkat dan estetik.</p>

            <div class="timeline">
                <div class="timeline-item glass card reveal">
                    <div class="label">Awal Bertemu</div>
                    <p class="muted">Sebuah pertemuan sederhana yang ternyata menjadi awal dari perjalanan besar.</p>
                </div>
                <div class="timeline-item glass card reveal">
                    <div class="label">Menjalin Hubungan</div>
                    <p class="muted">Hari-hari yang dilalui bersama membentuk rasa saling percaya dan bertumbuh.</p>
                </div>
                <div class="timeline-item glass card reveal">
                    <div class="label">Lamaran</div>
                    <p class="muted">Momen penuh haru ketika dua keluarga dipertemukan dalam niat yang indah.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title reveal">Gallery</h2>
            <p class="section-sub reveal">Layout masonry memberi kesan editorial premium dan sangat cocok untuk foto-foto prewedding maupun momen personal.</p>

            <div class="masonry">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="shot reveal">
                        <img loading="lazy" src="{{ asset('images/gallery-'.$i.'.jpg') }}" alt="Gallery {{ $i }}">
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <section class="section" id="rsvp">
        <div class="container grid-2">
            <div class="glass card reveal">
                <div class="label">RSVP</div>
                <h2 class="big">Konfirmasi Kehadiran</h2>
                <form class="form">
                    <input class="input" type="text" placeholder="Nama lengkap">
                    <input class="input" type="number" placeholder="Jumlah tamu">
                    <select class="select">
                        <option>Hadir</option>
                        <option>Tidak dapat hadir</option>
                        <option>Mungkin hadir</option>
                    </select>
                    <textarea class="textarea" placeholder="Ucapan untuk kedua mempelai"></textarea>
                    <div class="actions">
                        <button type="button" class="btn primary">Kirim RSVP</button>
                    </div>
                </form>
            </div>

            <div class="glass card reveal">
                <div class="label">Wedding Gift</div>
                <h2 class="big">Hadiah Pernikahan</h2>
                <p class="muted">Bagi yang ingin mengirimkan hadiah, dapat melalui rekening atau alamat berikut.</p>
                <div class="glass card" style="padding:18px; margin-top:16px">
                    <p class="muted" style="margin:0 0 8px">BCA a.n. Nama Mempelai</p>
                    <h3 style="margin:0; font-family:'Playfair Display',serif">1234567890</h3>
                </div>
                <div class="glass card" style="padding:18px; margin-top:14px">
                    <p class="muted" style="margin:0 0 8px">Alamat Hadiah</p>
                    <h3 style="margin:0; font-family:'Playfair Display',serif">Jl. Contoh No. 123, Malang</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title reveal">Lokasi Acara</h2>
            <p class="section-sub reveal">Google Maps embed ditampilkan penuh agar tamu lebih mudah membuka navigasi dari ponsel.</p>
            <div class="map-wrap glass reveal">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d..."
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <script>
        const cover = document.getElementById('cover');
        const bgMusic = document.getElementById('bgMusic');
        const musicBtn = document.getElementById('musicBtn');

        function openInvitation(){
            cover.classList.add('hide');
            bgMusic.play().catch(()=>{});
        }

        musicBtn.addEventListener('click', async () => {
            if (bgMusic.paused) {
                await bgMusic.play().catch(()=>{});
                musicBtn.textContent = '❚❚';
            } else {
                bgMusic.pause();
                musicBtn.textContent = '♪';
            }
        });

        const targetDate = new Date('2026-09-20T08:00:00').getTime();
        const countdown = document.getElementById('countdown');

        function updateCountdown(){
            const now = Date.now();
            const diff = Math.max(0, targetDate - now);

            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const m = Math.floor((diff / (1000 * 60)) % 60);
            const s = Math.floor((diff / 1000) % 60);

            countdown.innerHTML = `
                <div class="count-item"><strong>${d}</strong><span>Hari</span></div>
                <div class="count-item"><strong>${h}</strong><span>Jam</span></div>
                <div class="count-item"><strong>${m}</strong><span>Menit</span></div>
                <div class="count-item"><strong>${s}</strong><span>Detik</span></div>
            `;
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if(entry.isIntersecting) entry.target.classList.add('show');
            });
        }, {threshold: .12});

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>