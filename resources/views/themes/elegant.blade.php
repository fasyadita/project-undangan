<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Invitation — {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    <meta name="description" content="You're cordially invited to celebrate the union of {{ $invitation->groom_name }} & {{ $invitation->bride_name }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Great+Vibes&family=Montserrat:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* =========================================
           CSS VARIABLES & RESET
        ========================================= */
        :root {
            --black:        #0A0A0A;
            --black-mid:    #111111;
            --black-card:   #161616;
            --white:        #F8F6F3;
            --white-dim:    rgba(248,246,243,0.7);
            --silver:       #C8C8C8;
            --silver-dim:   rgba(200,200,200,0.3);
            --rose-gold:    #C5886A;
            --rose-light:   #D4A896;
            --rose-dim:     rgba(197,136,106,0.25);
            --glass-bg:     rgba(255,255,255,0.04);
            --glass-border: rgba(255,255,255,0.08);
            --font-display: 'Cormorant Garamond', serif;
            --font-script:  'Great Vibes', cursive;
            --font-body:    'Montserrat', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; font-size: 16px; }

        body {
            background: var(--black);
            color: var(--white);
            font-family: var(--font-body);
            font-weight: 300;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        body.locked { overflow: hidden; }

        img { max-width: 100%; display: block; }

        /* =========================================
           OPENING OVERLAY (Cover / Tombol Buka)
        ========================================= */
        #opening-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: var(--black);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            transition: opacity 0.9s cubic-bezier(0.77,0,0.175,1), visibility 0.9s;
        }

        #opening-overlay.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .overlay-decor {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .overlay-decor::before, .overlay-decor::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.12;
        }
        .overlay-decor::before {
            width: 500px; height: 500px;
            background: var(--rose-gold);
            top: -150px; right: -150px;
        }
        .overlay-decor::after {
            width: 400px; height: 400px;
            background: var(--silver);
            bottom: -100px; left: -100px;
        }

        .overlay-content { position: relative; z-index: 1; }

        .overlay-to   { font-family: var(--font-body); font-size: .65rem; letter-spacing: .35em; color: var(--silver); text-transform: uppercase; margin-bottom: 2.5rem; }
        .overlay-name { font-family: var(--font-script); font-size: clamp(3rem, 8vw, 5.5rem); color: var(--white); line-height: 1.1; }
        .overlay-amp  { font-family: var(--font-display); font-style: italic; color: var(--rose-gold); font-size: clamp(1.8rem, 4vw, 2.5rem); display: block; margin: 0.4rem 0; }
        .overlay-date { font-family: var(--font-body); font-size: .65rem; letter-spacing: .3em; color: var(--silver); text-transform: uppercase; margin-top: 2rem; }

        .divider-gold {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.5rem auto; width: fit-content;
        }
        .divider-gold span { display: block; height: 1px; width: 60px; background: linear-gradient(90deg, transparent, var(--rose-gold), transparent); }
        .divider-gold i { color: var(--rose-gold); font-size: .55rem; }

        .btn-open {
            display: inline-flex; align-items: center; gap: .8rem;
            margin-top: 2.5rem;
            padding: .85rem 2.5rem;
            border: 1px solid var(--rose-gold);
            background: transparent;
            color: var(--white);
            font-family: var(--font-body);
            font-size: .65rem;
            font-weight: 500;
            letter-spacing: .3em;
            text-transform: uppercase;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: color .4s;
        }
        .btn-open::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--rose-gold);
            transform: translateX(-101%);
            transition: transform .4s cubic-bezier(0.77,0,0.175,1);
        }
        .btn-open:hover::before { transform: translateX(0); }
        .btn-open span, .btn-open i { position: relative; z-index: 1; }
        .btn-open:hover { color: var(--black); }

        /* =========================================
           SECTION BASE
        ========================================= */
        section { position: relative; overflow: hidden; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 2rem; }

        /* =========================================
           1. HERO — FULLSCREEN VIDEO BACKGROUND
        ========================================= */
        #hero {
            height: 100vh; min-height: 600px;
            display: flex; align-items: center; justify-content: center;
            text-align: center;
        }

        .hero-video-wrap {
            position: absolute; inset: 0;
            z-index: 0;
        }
        .hero-video-wrap::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(to bottom, rgba(10,10,10,0.3) 0%, rgba(10,10,10,0.6) 60%, rgba(10,10,10,0.95) 100%);
            z-index: 1;
        }

        /* Gradient placeholder jika tidak ada video nyata */
        .hero-video-placeholder {
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 60% 30%, rgba(197,136,106,0.15) 0%, transparent 70%),
                radial-gradient(ellipse 60% 80% at 20% 70%, rgba(200,200,200,0.08) 0%, transparent 60%),
                linear-gradient(135deg, #0e0c0b 0%, #1a1210 40%, #0e0e0e 100%);
            animation: heroShift 12s ease-in-out infinite alternate;
        }
        @keyframes heroShift {
            from { filter: brightness(1); }
            to   { filter: brightness(1.15) saturate(1.1); }
        }

        /* Particles Canvas */
        #particles-canvas {
            position: absolute; inset: 0; z-index: 2; pointer-events: none;
        }

        .hero-content {
            position: relative; z-index: 3;
            padding: 2rem;
        }

        .hero-eyebrow {
            font-size: .6rem; letter-spacing: .5em; text-transform: uppercase;
            color: var(--silver); margin-bottom: 2rem;
            opacity: 0; transform: translateY(20px);
            animation: fadeUp .8s .4s forwards;
        }

        .hero-names {
            line-height: 1;
        }

        .hero-name {
            font-family: var(--font-script);
            font-size: clamp(4rem, 12vw, 8.5rem);
            color: var(--white);
            display: block;
            opacity: 0;
        }
        .hero-name.n1 { animation: nameReveal .9s .8s cubic-bezier(0.22,1,.36,1) forwards; }
        .hero-name.n2 { animation: nameReveal .9s 1.1s cubic-bezier(0.22,1,.36,1) forwards; }

        @keyframes nameReveal {
            from { opacity: 0; transform: translateY(40px) skewY(2deg); filter: blur(6px); }
            to   { opacity: 1; transform: translateY(0) skewY(0);        filter: blur(0); }
        }

        .hero-amp {
            font-family: var(--font-display);
            font-style: italic;
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            color: var(--rose-gold);
            display: block;
            margin: .4rem 0;
            opacity: 0;
            animation: fadeUp .6s 1s forwards;
        }

        .hero-date {
            margin-top: 2.5rem;
            font-size: .65rem; letter-spacing: .4em; text-transform: uppercase;
            color: var(--silver);
            opacity: 0;
            animation: fadeUp .8s 1.4s forwards;
        }

        .scroll-indicator {
            position: absolute; bottom: 2.5rem; left: 50%; transform: translateX(-50%);
            z-index: 3; display: flex; flex-direction: column; align-items: center; gap: .5rem;
            opacity: 0; animation: fadeUp .8s 2s forwards;
        }
        .scroll-indicator span { font-size: .55rem; letter-spacing: .3em; color: var(--silver); }
        .scroll-line {
            width: 1px; height: 50px;
            background: linear-gradient(to bottom, var(--rose-gold), transparent);
            animation: scrollPulse 2s ease-in-out infinite;
        }
        @keyframes scrollPulse {
            0%, 100% { opacity: 0.3; transform: scaleY(0.5); transform-origin: top; }
            50%       { opacity: 1;   transform: scaleY(1); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* =========================================
           2. COUNTDOWN
        ========================================= */
        #countdown {
            padding: 6rem 0;
            background: var(--black-mid);
            text-align: center;
        }

        .section-label {
            font-size: .6rem; letter-spacing: .5em; text-transform: uppercase;
            color: var(--rose-gold); margin-bottom: 1rem;
            display: block;
        }

        .section-title {
            font-family: var(--font-display);
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 300;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: .5rem;
        }
        .section-title em { font-style: italic; color: var(--rose-gold); }

        .countdown-grid {
            display: flex; justify-content: center; gap: 1rem;
            margin-top: 3.5rem; flex-wrap: wrap;
        }

        .countdown-item {
            min-width: 90px; padding: 1.5rem 1rem;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
            text-align: center;
            position: relative;
        }
        .countdown-item::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--rose-gold), transparent);
        }

        .countdown-number {
            font-family: var(--font-display);
            font-size: 3rem; font-weight: 500;
            color: var(--white); line-height: 1;
            display: block;
        }

        .countdown-label {
            font-size: .55rem; letter-spacing: .3em; text-transform: uppercase;
            color: var(--silver); margin-top: .5rem; display: block;
        }

        /* =========================================
           3. QUOTE ROMANTIS
        ========================================= */
        #quote {
            padding: 7rem 0;
            text-align: center;
            background: var(--black);
        }

        .quote-text {
            font-family: var(--font-display);
            font-size: clamp(1.4rem, 3.5vw, 2.2rem);
            font-style: italic;
            font-weight: 300;
            color: var(--white);
            max-width: 700px; margin: 0 auto;
            line-height: 1.7;
            position: relative;
        }
        .quote-text::before, .quote-text::after {
            font-family: var(--font-script);
            font-size: 6rem;
            color: var(--rose-gold);
            opacity: .2;
            position: absolute;
            line-height: 1;
        }
        .quote-text::before { content: '"'; top: -2rem; left: -2rem; }
        .quote-text::after  { content: '"'; bottom: -3.5rem; right: -1rem; }

        .quote-source {
            margin-top: 2rem;
            font-size: .6rem; letter-spacing: .35em; color: var(--silver); text-transform: uppercase;
        }

        /* =========================================
           4. DETAIL ACARA — GLASSMORPHISM CARDS
        ========================================= */
        #acara {
            padding: 7rem 0;
            background: var(--black-mid);
        }

        .acara-header { text-align: center; margin-bottom: 4rem; }

        .acara-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .glass-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 2.5rem;
            position: relative;
            transition: transform .4s cubic-bezier(0.22,1,.36,1), border-color .4s;
        }
        .glass-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--rose-gold), transparent);
        }
        .glass-card:hover {
            transform: translateY(-6px);
            border-color: var(--rose-dim);
        }

        .card-icon {
            width: 48px; height: 48px;
            border: 1px solid var(--glass-border);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--rose-gold);
            font-size: 1.1rem;
        }

        .card-type {
            font-size: .55rem; letter-spacing: .4em; text-transform: uppercase;
            color: var(--rose-gold); margin-bottom: .5rem; display: block;
        }

        .card-title {
            font-family: var(--font-display);
            font-size: 1.6rem; font-weight: 400;
            color: var(--white); margin-bottom: 1.2rem;
            line-height: 1.2;
        }

        .card-detail {
            display: flex; flex-direction: column; gap: .6rem;
        }

        .card-row {
            display: flex; align-items: flex-start; gap: .8rem;
            font-size: .75rem; color: var(--white-dim);
            line-height: 1.5;
        }
        .card-row i { color: var(--rose-gold); width: 14px; flex-shrink: 0; margin-top: .15rem; }

        .add-to-cal {
            display: inline-flex; align-items: center; gap: .5rem;
            margin-top: 1.5rem;
            font-size: .6rem; letter-spacing: .25em; text-transform: uppercase;
            color: var(--silver);
            border: 1px solid var(--glass-border);
            padding: .6rem 1.2rem;
            background: transparent; cursor: pointer;
            transition: color .3s, border-color .3s;
            text-decoration: none;
        }
        .add-to-cal:hover { color: var(--rose-gold); border-color: var(--rose-gold); }

        /* =========================================
           5. LOVE STORY TIMELINE
        ========================================= */
        #lovestory {
            padding: 7rem 0;
            background: var(--black);
        }

        .lovestory-header { text-align: center; margin-bottom: 5rem; }

        .timeline {
            position: relative;
            max-width: 800px; margin: 0 auto;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%; top: 0; bottom: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, var(--rose-gold) 10%, var(--silver) 50%, var(--rose-gold) 90%, transparent);
            transform: translateX(-50%);
        }

        .timeline-item {
            display: grid;
            grid-template-columns: 1fr 60px 1fr;
            gap: 0;
            align-items: center;
            margin-bottom: 3.5rem;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .7s ease, transform .7s ease;
        }
        .timeline-item.visible { opacity: 1; transform: translateY(0); }

        .timeline-item:nth-child(odd) .tl-content  { grid-column: 1; text-align: right; padding-right: 2.5rem; }
        .timeline-item:nth-child(odd) .tl-dot      { grid-column: 2; }
        .timeline-item:nth-child(odd) .tl-year     { grid-column: 3; padding-left: 2.5rem; }

        .timeline-item:nth-child(even) .tl-year    { grid-column: 1; text-align: right; padding-right: 2.5rem; }
        .timeline-item:nth-child(even) .tl-dot     { grid-column: 2; }
        .timeline-item:nth-child(even) .tl-content { grid-column: 3; padding-left: 2.5rem; }

        .tl-dot {
            display: flex; align-items: center; justify-content: center;
            position: relative; z-index: 1;
        }
        .tl-dot-inner {
            width: 14px; height: 14px;
            border-radius: 50%;
            background: var(--black);
            border: 2px solid var(--rose-gold);
            position: relative;
        }
        .tl-dot-inner::after {
            content: '';
            position: absolute; inset: 3px;
            border-radius: 50%;
            background: var(--rose-gold);
        }

        .tl-year {
            font-family: var(--font-display);
            font-size: 2.8rem; font-weight: 300; font-style: italic;
            color: var(--rose-gold); line-height: 1;
        }

        .tl-label {
            font-size: .55rem; letter-spacing: .3em; text-transform: uppercase;
            color: var(--silver); display: block; margin-bottom: .5rem;
        }

        .tl-heading {
            font-family: var(--font-display);
            font-size: 1.3rem; font-weight: 400;
            color: var(--white); margin-bottom: .5rem;
        }

        .tl-desc {
            font-size: .75rem; color: var(--white-dim); line-height: 1.7;
        }

        /* =========================================
           6. GALLERY MASONRY
        ========================================= */
        #gallery {
            padding: 7rem 0;
            background: var(--black-mid);
        }

        .gallery-header { text-align: center; margin-bottom: 3.5rem; }

        .masonry-grid {
            columns: 3; gap: 1rem;
        }

        @media (max-width: 768px) { .masonry-grid { columns: 2; } }
        @media (max-width: 480px) { .masonry-grid { columns: 1; } }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1rem;
            overflow: hidden;
            position: relative;
        }

        .masonry-item img {
            width: 100%; display: block;
            transition: transform .6s cubic-bezier(0.22,1,.36,1), filter .6s;
            filter: grayscale(15%) brightness(0.9);
        }
        .masonry-item:hover img {
            transform: scale(1.04);
            filter: grayscale(0%) brightness(1);
        }

        .masonry-item::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(10,10,10,0.5) 0%, transparent 50%);
            opacity: 0;
            transition: opacity .4s;
        }
        .masonry-item:hover::after { opacity: 1; }

        /* Placeholder gallery swatch */
        .gallery-placeholder {
            width: 100%;
            background: var(--black-card);
            border: 1px solid var(--glass-border);
            display: flex; align-items: center; justify-content: center;
            color: var(--silver);
            font-size: .65rem; letter-spacing: .2em;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }
        .gallery-placeholder::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at center, rgba(197,136,106,0.08) 0%, transparent 70%);
        }
        .gallery-placeholder i { position: relative; z-index: 1; font-size: 1.5rem; color: var(--rose-gold); opacity: .4; }

        /* =========================================
           7. RSVP FORM
        ========================================= */
        #rsvp {
            padding: 7rem 0;
            background: var(--black);
        }

        .rsvp-inner {
            display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
        }
        @media (max-width: 768px) { .rsvp-inner { grid-template-columns: 1fr; gap: 3rem; } }

        .rsvp-text .section-label { margin-bottom: 1rem; }
        .rsvp-text .section-title { margin-bottom: 1rem; }

        .rsvp-sub {
            font-size: .8rem; color: var(--white-dim); line-height: 1.8;
            margin-top: .8rem;
        }

        .form-group {
            display: flex; flex-direction: column; gap: 1rem; margin-top: 2rem;
        }

        .form-field {
            display: flex; flex-direction: column; gap: .4rem;
        }

        .form-field label {
            font-size: .55rem; letter-spacing: .3em; text-transform: uppercase; color: var(--silver);
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--white);
            padding: .85rem 1rem;
            font-family: var(--font-body);
            font-size: .8rem;
            font-weight: 300;
            outline: none;
            transition: border-color .3s;
            -webkit-appearance: none;
            border-radius: 0;
        }
        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            border-color: var(--rose-gold);
        }

        .form-field input::placeholder,
        .form-field textarea::placeholder { color: rgba(200,200,200,0.3); }

        .form-field select option { background: var(--black-mid); }
        .form-field textarea { resize: none; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }

        .btn-submit {
            margin-top: .5rem;
            padding: 1rem 2.5rem;
            background: transparent;
            border: 1px solid var(--rose-gold);
            color: var(--white);
            font-family: var(--font-body);
            font-size: .65rem; letter-spacing: .3em; text-transform: uppercase;
            cursor: pointer; position: relative; overflow: hidden;
            transition: color .4s;
        }
        .btn-submit::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--rose-gold), var(--rose-light));
            transform: translateX(-101%);
            transition: transform .4s cubic-bezier(0.77,0,0.175,1);
        }
        .btn-submit span { position: relative; z-index: 1; }
        .btn-submit:hover::before { transform: translateX(0); }
        .btn-submit:hover { color: var(--black); }

        #rsvp-success {
            display: none;
            text-align: center; padding: 2rem;
            background: var(--glass-bg); border: 1px solid var(--rose-dim);
        }
        #rsvp-success i { font-size: 2rem; color: var(--rose-gold); margin-bottom: 1rem; display: block; }
        #rsvp-success p { font-size: .8rem; color: var(--white-dim); }

        /* =========================================
           8. WEDDING GIFT
        ========================================= */
        #gift {
            padding: 7rem 0;
            background: var(--black-mid);
            text-align: center;
        }

        .gift-header { margin-bottom: 3.5rem; }

        .gift-cards {
            display: flex; flex-wrap: wrap; justify-content: center; gap: 1.5rem;
        }

        .gift-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            padding: 2rem 2.5rem;
            min-width: 260px;
            position: relative;
        }
        .gift-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--silver), transparent);
        }

        .gift-bank {
            font-size: .6rem; letter-spacing: .35em; text-transform: uppercase;
            color: var(--silver); margin-bottom: .8rem; display: block;
        }

        .gift-name {
            font-family: var(--font-display);
            font-size: 1.4rem; font-weight: 400;
            color: var(--white); margin-bottom: .4rem;
        }

        .gift-account {
            font-size: 1.2rem; font-weight: 500; color: var(--rose-gold);
            letter-spacing: .08em; margin-bottom: 1rem; display: block;
        }

        .btn-copy {
            background: transparent;
            border: 1px solid var(--glass-border);
            color: var(--silver);
            font-family: var(--font-body);
            font-size: .6rem; letter-spacing: .2em; text-transform: uppercase;
            padding: .5rem 1rem; cursor: pointer;
            transition: color .3s, border-color .3s;
            display: inline-flex; align-items: center; gap: .5rem;
        }
        .btn-copy:hover { color: var(--rose-gold); border-color: var(--rose-gold); }

        .gift-or {
            font-family: var(--font-display);
            font-style: italic;
            color: var(--silver);
            font-size: 1.2rem;
            display: flex; align-items: center;
            padding: 1rem 0;
        }

        /* =========================================
           9. GOOGLE MAPS
        ========================================= */
        #maps {
            padding: 7rem 0;
            background: var(--black);
        }

        .maps-header { text-align: center; margin-bottom: 3.5rem; }

        .maps-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;
        }

        .map-wrap {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            overflow: hidden;
        }

        .map-info {
            padding: 1.5rem;
            border-top: 1px solid var(--glass-border);
        }

        .map-venue {
            font-family: var(--font-display);
            font-size: 1.3rem; color: var(--white); margin-bottom: .3rem;
        }

        .map-address {
            font-size: .7rem; color: var(--white-dim); line-height: 1.6; margin-bottom: 1rem;
        }

        .map-wrap iframe {
            width: 100%; height: 220px; border: 0;
            filter: grayscale(80%) invert(90%) contrast(90%);
            opacity: .7;
            transition: filter .4s, opacity .4s;
        }
        .map-wrap:hover iframe { filter: grayscale(0%) invert(0%) contrast(100%); opacity: 1; }

        .btn-maps {
            display: inline-flex; align-items: center; gap: .5rem;
            font-size: .6rem; letter-spacing: .25em; text-transform: uppercase;
            color: var(--rose-gold); text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: border-color .3s;
        }
        .btn-maps:hover { border-color: var(--rose-gold); }

        /* =========================================
           10. MUSIC PLAYER
        ========================================= */
        #music-player {
            position: fixed;
            bottom: 2rem; right: 2rem;
            z-index: 1000;
            display: flex; align-items: center; gap: 1rem;
        }

        .music-btn {
            width: 48px; height: 48px;
            border-radius: 50%;
            background: rgba(10,10,10,0.85);
            border: 1px solid var(--rose-gold);
            color: var(--rose-gold);
            font-size: .9rem;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background .3s;
            backdrop-filter: blur(10px);
        }
        .music-btn:hover { background: var(--rose-gold); color: var(--black); }

        .music-info {
            background: rgba(10,10,10,0.85);
            border: 1px solid var(--glass-border);
            padding: .5rem 1rem;
            backdrop-filter: blur(10px);
            display: none;
        }
        .music-info.show { display: block; }
        .music-title { font-size: .6rem; letter-spacing: .15em; color: var(--white); }
        .music-artist { font-size: .55rem; color: var(--silver); }

        /* =========================================
           FOOTER
        ========================================= */
        footer {
            padding: 5rem 0 3rem;
            background: var(--black-mid);
            text-align: center;
            border-top: 1px solid var(--glass-border);
        }

        .footer-names {
            font-family: var(--font-script);
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            color: var(--white); line-height: 1.1;
        }

        .footer-amp {
            font-family: var(--font-display);
            font-style: italic;
            color: var(--rose-gold); font-size: 1.5rem;
            display: block; margin: .2rem 0;
        }

        .footer-date {
            margin-top: 1.5rem;
            font-size: .6rem; letter-spacing: .45em; text-transform: uppercase;
            color: var(--silver);
        }

        .footer-note {
            margin-top: 3rem;
            font-size: .65rem; color: rgba(200,200,200,0.35);
        }

        /* =========================================
           SCROLL ANIMATION BASE
        ========================================= */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity .8s ease, transform .8s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-delay-1 { transition-delay: .1s; }
        .reveal-delay-2 { transition-delay: .2s; }
        .reveal-delay-3 { transition-delay: .3s; }

        /* =========================================
           PARALLAX SECTION DECORATOR
        ========================================= */
        .parallax-decor {
            position: absolute;
            pointer-events: none;
            opacity: .04;
        }
        .pd-script {
            font-family: var(--font-script);
            font-size: clamp(6rem, 18vw, 14rem);
            color: var(--white);
            white-space: nowrap;
            user-select: none;
        }

        /* =========================================
           FLOATING ORNAMENT SVG
        ========================================= */
        .ornament {
            position: absolute;
            opacity: .12;
            pointer-events: none;
        }
        .ornament svg { fill: none; stroke: var(--rose-gold); }

        /* =========================================
           NAV DOT (progress)
        ========================================= */
        .nav-dots {
            position: fixed;
            right: 1.5rem; top: 50%; transform: translateY(-50%);
            z-index: 500;
            display: flex; flex-direction: column; gap: .6rem;
        }
        .nav-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--silver-dim);
            border: 1px solid var(--glass-border);
            cursor: pointer;
            transition: background .3s, transform .3s;
        }
        .nav-dot.active { background: var(--rose-gold); transform: scale(1.5); }

        @media (max-width: 768px) { .nav-dots { display: none; } }

        /* =========================================
           RESPONSIVE ADJUSTMENTS
        ========================================= */
        @media (max-width: 768px) {
            .timeline::before { left: 20px; }
            .timeline-item {
                grid-template-columns: 40px 1fr;
                grid-template-rows: auto auto;
            }
            .timeline-item:nth-child(odd) .tl-content,
            .timeline-item:nth-child(even) .tl-content {
                grid-column: 2; text-align: left; padding: 0 0 0 1.5rem;
            }
            .timeline-item:nth-child(odd) .tl-dot,
            .timeline-item:nth-child(even) .tl-dot {
                grid-column: 1; grid-row: 1 / 3; align-self: start; padding-top: .2rem;
            }
            .timeline-item:nth-child(odd) .tl-year,
            .timeline-item:nth-child(even) .tl-year {
                grid-column: 2; text-align: left; padding: 0 0 .4rem 1.5rem;
                font-size: 2rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body class="locked">

<!-- ========== OPENING OVERLAY ========== -->
<div id="opening-overlay">
    <div class="overlay-decor"></div>
    <div class="overlay-content">
        <p class="overlay-to">You Are Cordially Invited To The Wedding Of</p>

        <div class="divider-gold">
            <span></span><i class="fas fa-diamond"></i><span></span>
        </div>

        <div class="overlay-names">
            <span class="overlay-name">{{ $invitation->groom_name }}</span>
            <span class="overlay-amp">&amp;</span>
            <span class="overlay-name">{{ $invitation->bride_name }}</span>
        </div>

        <div class="divider-gold" style="margin-top:1.5rem">
            <span></span><i class="fas fa-diamond"></i><span></span>
        </div>

        <p class="overlay-date">{{ $invitation->event_date->translatedFormat('l, d F Y') }} &nbsp;·&nbsp; {{ $invitation->event_location }}</p>

        <button class="btn-open" onclick="openInvitation()">
            <i class="fas fa-envelope-open-text"></i>
            <span>Buka Undangan</span>
        </button>
    </div>
</div>

<!-- ========== MUSIC ========== -->
<div id="music-player">
    <div class="music-info" id="music-info">
        <div class="music-title">A Thousand Years</div>
        <div class="music-artist">Christina Perri</div>
    </div>
    <button class="music-btn" id="music-btn" onclick="toggleMusic()" title="Toggle Music">
        <i class="fas fa-music" id="music-icon"></i>
    </button>
</div>
<audio id="bg-music" loop>
    {{-- Ganti src dengan URL lagu yang valid --}}
    <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
</audio>

<!-- ========== NAV DOTS ========== -->
<nav class="nav-dots" id="nav-dots">
    <div class="nav-dot active" data-target="hero"       title="Home"></div>
    <div class="nav-dot"        data-target="countdown"  title="Countdown"></div>
    <div class="nav-dot"        data-target="quote"      title="Quote"></div>
    <div class="nav-dot"        data-target="acara"      title="Detail Acara"></div>
    <div class="nav-dot"        data-target="lovestory"  title="Love Story"></div>
    <div class="nav-dot"        data-target="gallery"    title="Gallery"></div>
    <div class="nav-dot"        data-target="rsvp"       title="RSVP"></div>
    <div class="nav-dot"        data-target="gift"       title="Gift"></div>
    <div class="nav-dot"        data-target="maps"       title="Lokasi"></div>
</nav>

<!-- ============================================================
     1. HERO
============================================================ -->
<section id="hero">
    <div class="hero-video-wrap">
        {{-- Jika ada file video, uncomment ini dan ganti src --}}
        {{-- <video autoplay muted loop playsinline style="width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0;">
            <source src="{{ asset('video/wedding-bg.mp4') }}" type="video/mp4">
        </video> --}}
        <div class="hero-video-placeholder"></div>
    </div>

    <!-- Particles -->
    <canvas id="particles-canvas"></canvas>

    <!-- Ornament top -->
    <div class="ornament" style="top:10%;left:5%;opacity:.07;">
        <svg width="120" height="120" viewBox="0 0 120 120">
            <circle cx="60" cy="60" r="55" stroke-width=".5"/>
            <circle cx="60" cy="60" r="45" stroke-width=".5"/>
            <line x1="60" y1="5"  x2="60" y2="115" stroke-width=".5"/>
            <line x1="5"  y1="60" x2="115" y2="60" stroke-width=".5"/>
            <line x1="20" y1="20" x2="100" y2="100" stroke-width=".5"/>
            <line x1="100" y1="20" x2="20" y2="100" stroke-width=".5"/>
        </svg>
    </div>
    <div class="ornament" style="bottom:15%;right:5%;opacity:.07;transform:rotate(30deg)">
        <svg width="80" height="80" viewBox="0 0 80 80">
            <rect x="10" y="10" width="60" height="60" stroke-width=".5"/>
            <rect x="20" y="20" width="40" height="40" stroke-width=".5" transform="rotate(45 40 40)"/>
        </svg>
    </div>

    <div class="hero-content">
        <p class="hero-eyebrow">The Wedding of</p>
        <div class="hero-names">
            <span class="hero-name n1">{{ $invitation->groom_name }}</span>
            <span class="hero-amp">&amp;</span>
            <span class="hero-name n2">{{ $invitation->bride_name }}</span>
        </div>
        <p class="hero-date">{{ $invitation->event_date->translatedFormat('l') }} &nbsp;·&nbsp; {{ $invitation->event_date->translatedFormat('d F Y') }} &nbsp;·&nbsp; {{ $invitation->event_location }}</p>
    </div>

    <div class="scroll-indicator">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</section>

<!-- ============================================================
     2. COUNTDOWN
============================================================ -->
<section id="countdown">
    <div class="container">
        <span class="section-label reveal">Menghitung Hari</span>
        <h2 class="section-title reveal reveal-delay-1">Hari Bahagia <em>Kami</em><br>Semakin Dekat</h2>
        <div class="countdown-grid">
            <div class="countdown-item reveal reveal-delay-1">
                <span class="countdown-number" id="cd-days">00</span>
                <span class="countdown-label">Hari</span>
            </div>
            <div class="countdown-item reveal reveal-delay-2">
                <span class="countdown-number" id="cd-hours">00</span>
                <span class="countdown-label">Jam</span>
            </div>
            <div class="countdown-item reveal reveal-delay-3">
                <span class="countdown-number" id="cd-minutes">00</span>
                <span class="countdown-label">Menit</span>
            </div>
            <div class="countdown-item reveal reveal-delay-3" style="transition-delay:.4s">
                <span class="countdown-number" id="cd-seconds">00</span>
                <span class="countdown-label">Detik</span>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     3. QUOTE ROMANTIS
============================================================ -->
<section id="quote">
    <div class="parallax-decor pd-script" style="top:-2rem;right:-4rem;transform:rotate(-8deg);">Love</div>

    <div class="container">
        <div class="reveal" style="text-align:center;">
            <p class="quote-text">
                "And in her smile I see something more beautiful than the stars."
            </p>
            <p class="quote-source">— Beth Reekles</p>
        </div>

        <div class="divider-gold" style="margin:3rem auto;justify-content:center;">
            <span></span><i class="fas fa-diamond"></i><span></span>
        </div>

        <div style="text-align:center;" class="reveal">
            <span class="section-label">Dengan penuh syukur dan kebahagiaan</span>
            <h2 class="section-title" style="max-width:600px;margin:0 auto;">Kami Mengundang Kehadiran <em>Anda</em></h2>
            <p style="font-size:.8rem;color:var(--white-dim);margin-top:1rem;line-height:1.8;max-width:480px;margin:1rem auto 0;">
                Untuk turut menyaksikan dan mendoakan pernikahan putra-putri kami
                dalam suasana yang penuh kasih dan kebahagiaan.
            </p>
        </div>
    </div>
</section>

<!-- ============================================================
     4. DETAIL ACARA — GLASSMORPHISM
============================================================ -->
<section id="acara">
    <div class="ornament" style="top:0;right:0;opacity:.04;transform:rotate(15deg)">
        <svg width="300" height="300" viewBox="0 0 300 300">
            <circle cx="150" cy="150" r="140" stroke-width="1"/>
            <circle cx="150" cy="150" r="100" stroke-width="1"/>
            <circle cx="150" cy="150" r="60"  stroke-width="1"/>
        </svg>
    </div>
    <div class="container">
        <div class="acara-header">
            <span class="section-label reveal">Detail Acara</span>
            <h2 class="section-title reveal reveal-delay-1">Rangkaian <em>Acara</em></h2>
        </div>

        <div class="acara-grid">
            <!-- Akad -->
            <div class="glass-card reveal">
                <div class="card-icon"><i class="fas fa-ring"></i></div>
                <span class="card-type">Akad Nikah</span>
                <h3 class="card-title">Prosesi<br>Akad Nikah</h3>
                <div class="card-detail">
                    <div class="card-row">
                        <i class="far fa-calendar"></i>
                        <span>{{ $invitation->event_date->translatedFormat('l, d F Y') }}</span>
                    </div>
                    <div class="card-row">
                        <i class="far fa-clock"></i>
                        <span>{{ $invitation->event_time }}</span>
                    </div>
                    <div class="card-row">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $invitation->event_location }}, {{ $invitation->event_address }}</span>
                    </div>
                    <div class="card-row">
                        <i class="fas fa-tshirt"></i>
                        <span>Dress Code: Putih & Krem</span>
                    </div>
                </div>
                <a href="#" class="add-to-cal">
                    <i class="far fa-calendar-plus"></i> Tambah ke Kalender
                </a>
            </div>

            <!-- Resepsi -->
            <div class="glass-card reveal reveal-delay-1">
                <div class="card-icon"><i class="fas fa-champagne-glasses"></i></div>
                <span class="card-type">Resepsi</span>
                <h3 class="card-title">Pesta<br>Pernikahan</h3>
                <div class="card-detail">
                    <div class="card-row">
                        <i class="far fa-calendar"></i>
                        <span>{{ $invitation->event_date->translatedFormat('l, d F Y') }}</span>
                    </div>
                    <div class="card-row">
                        <i class="far fa-clock"></i>
                        <span>11.00 – 17.00 WIB</span>
                    </div>
                    <div class="card-row">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $invitation->event_location }}, {{ $invitation->event_address }}</span>
                    </div>
                    <div class="card-row">
                        <i class="fas fa-tshirt"></i>
                        <span>Dress Code: Rose Gold & Silver</span>
                    </div>
                </div>
                <a href="#" class="add-to-cal">
                    <i class="far fa-calendar-plus"></i> Tambah ke Kalender
                </a>
            </div>

            <!-- Info Tambahan -->
            <div class="glass-card reveal reveal-delay-2">
                <div class="card-icon"><i class="fas fa-info"></i></div>
                <span class="card-type">Informasi</span>
                <h3 class="card-title">Protokol<br>Kesehatan</h3>
                <div class="card-detail">
                    <div class="card-row">
                        <i class="fas fa-check"></i>
                        <span>Mohon hadir tepat waktu sesuai jadwal</span>
                    </div>
                    <div class="card-row">
                        <i class="fas fa-check"></i>
                        <span>Tamu undangan dipersilakan menunjukkan undangan ini</span>
                    </div>
                    <div class="card-row">
                        <i class="fas fa-check"></i>
                        <span>Konfirmasi kehadiran sebelum 13 September 2025</span>
                    </div>
                    <div class="card-row">
                        <i class="fas fa-check"></i>
                        <span>Parkir tersedia di area gedung</span>
                    </div>
                    <div class="card-row">
                        <i class="fas fa-heart" style="color:var(--rose-gold)"></i>
                        <span style="color:var(--rose-gold);">Kehadiran Anda adalah kado terbaik bagi kami</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     5. LOVE STORY TIMELINE
============================================================ -->
<section id="lovestory">
    <div class="parallax-decor pd-script" style="bottom:-3rem;left:-2rem;opacity:.03;transform:rotate(10deg)">Together</div>

    <div class="container">
        <div class="lovestory-header">
            <span class="section-label reveal">Perjalanan Cinta</span>
            <h2 class="section-title reveal reveal-delay-1">Our <em>Love Story</em></h2>
            <p class="reveal reveal-delay-2" style="font-size:.8rem;color:var(--white-dim);max-width:440px;margin:.8rem auto 0;line-height:1.8;">
                Setiap momen bersama adalah kenangan yang tak ternilai harganya
            </p>
        </div>

        <div class="timeline">
            <div class="timeline-item">
                <div class="tl-content">
                    <span class="tl-label">Awal Pertemuan</span>
                    <h3 class="tl-heading">Saat Pertama Bertemu</h3>
                    <p class="tl-desc">Di sebuah seminar kampus, tatapan pertama itu menjadi awal dari segalanya. Sebuah kebetulan yang terasa seperti takdir.</p>
                </div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-year">2020</div>
            </div>

            <div class="timeline-item">
                <div class="tl-year">2021</div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-content">
                    <span class="tl-label">Pertemanan</span>
                    <h3 class="tl-heading">Lebih Dari Sekadar Teman</h3>
                    <p class="tl-desc">Hari demi hari dilewati bersama, tawa dan cerita mengalir begitu alami. Tanpa disadari, hati mulai berbicara hal yang berbeda.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="tl-content">
                    <span class="tl-label">Hubungan Resmi</span>
                    <h3 class="tl-heading">Ia Menyatakannya</h3>
                    <p class="tl-desc">Di bawah langit senja kota Malang, Ardan memberanikan diri mengungkapkan perasaannya. Rania tersenyum, dan jawaban itu mengubah segalanya.</p>
                </div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-year">2022</div>
            </div>

            <div class="timeline-item">
                <div class="tl-year">2024</div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-content">
                    <span class="tl-label">Lamaran</span>
                    <h3 class="tl-heading">Ia Melamarku</h3>
                    <p class="tl-desc">Dengan cincin yang berkilau dan kata-kata dari hati, Ardan berlutut di hadapan keluarga dan bertanya: "Maukah kamu menjadi istriku?"</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="tl-content">
                    <span class="tl-label">Hari Istimewa</span>
                    <h3 class="tl-heading">Pernikahan Kami</h3>
                    <p class="tl-desc">Dan kini kami siap melangkah bersama dalam ikatan suci, menjemput babak baru kehidupan yang penuh cinta dan kebahagiaan.</p>
                </div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-year">2025</div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     6. GALLERY MASONRY
============================================================ -->
<section id="gallery">
    <div class="container">
        <div class="gallery-header">
            <span class="section-label reveal">Galeri Foto</span>
            <h2 class="section-title reveal reveal-delay-1">Momen <em>Berharga</em></h2>
        </div>

        <div class="masonry-grid">
            {{-- Ganti src img dengan foto nyata --}}
            <div class="masonry-item reveal">
                <div class="gallery-placeholder" style="height:280px"><i class="fas fa-camera"></i></div>
            </div>
            <div class="masonry-item reveal reveal-delay-1">
                <div class="gallery-placeholder" style="height:200px"><i class="fas fa-camera"></i></div>
            </div>
            <div class="masonry-item reveal reveal-delay-2">
                <div class="gallery-placeholder" style="height:340px"><i class="fas fa-camera"></i></div>
            </div>
            <div class="masonry-item reveal">
                <div class="gallery-placeholder" style="height:240px"><i class="fas fa-camera"></i></div>
            </div>
            <div class="masonry-item reveal reveal-delay-1">
                <div class="gallery-placeholder" style="height:300px"><i class="fas fa-camera"></i></div>
            </div>
            <div class="masonry-item reveal reveal-delay-2">
                <div class="gallery-placeholder" style="height:220px"><i class="fas fa-camera"></i></div>
            </div>
        </div>

        <p style="text-align:center;margin-top:2rem;font-size:.7rem;color:var(--white-dim);">
            Ganti placeholder di atas dengan tag <code style="color:var(--rose-gold)">&lt;img src="..."&gt;</code> untuk foto nyata
        </p>
    </div>
</section>

<!-- ============================================================
     7. RSVP FORM
============================================================ -->
<section id="rsvp">
    <div class="ornament" style="top:50%;left:-80px;transform:translateY(-50%);">
        <svg width="200" height="200" viewBox="0 0 200 200">
            <circle cx="100" cy="100" r="90" stroke-width=".8" stroke="var(--rose-gold)"/>
            <circle cx="100" cy="100" r="70" stroke-width=".5" stroke="var(--silver)"/>
        </svg>
    </div>

    <div class="container">
        <div class="rsvp-inner">
            <div class="rsvp-text">
                <span class="section-label reveal">Konfirmasi Kehadiran</span>
                <h2 class="section-title reveal reveal-delay-1">Kami Menanti <em>Kehadiran</em> Anda</h2>
                <p class="rsvp-sub reveal reveal-delay-2">
                    Mohon konfirmasi kehadiran Anda sebelum
                    <strong style="color:var(--rose-gold)">13 September 2025</strong>
                    agar kami dapat mempersiapkan segalanya dengan sebaik mungkin.
                </p>
                <div class="divider-gold" style="margin-top:2rem">
                    <span></span><i class="fas fa-diamond"></i><span></span>
                </div>
            </div>

            <div class="rsvp-form-wrap reveal reveal-delay-1">
                <div id="rsvp-success">
                    <i class="fas fa-heart"></i>
                    <p>Terima kasih! Kami sangat senang menantikan kehadiran Anda.</p>
                </div>
                <div id="rsvp-form-container">
                    <div class="form-group">
                        <div class="form-field">
                            <label>Nama Lengkap</label>
                            <input type="text" id="rsvp-name" placeholder="Nama Anda...">
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label>Jumlah Tamu</label>
                                <select id="rsvp-guests">
                                    <option value="1">1 Orang</option>
                                    <option value="2">2 Orang</option>
                                    <option value="3">3 Orang</option>
                                    <option value="4">4 Orang</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label>Kehadiran</label>
                                <select id="rsvp-attend">
                                    <option value="hadir">Hadir</option>
                                    <option value="tidak">Tidak Dapat Hadir</option>
                                    <option value="mungkin">Mungkin Hadir</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-field">
                            <label>Ucapan & Doa</label>
                            <textarea id="rsvp-message" rows="4" placeholder="Tulis ucapan atau doa untuk kami..."></textarea>
                        </div>
                        <button class="btn-submit" onclick="submitRSVP()">
                            <span>Kirim Konfirmasi &nbsp;<i class="fas fa-paper-plane"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     8. WEDDING GIFT
============================================================ -->
<section id="gift">
    <div class="container">
        <div class="gift-header">
            <span class="section-label reveal">Wedding Gift</span>
            <h2 class="section-title reveal reveal-delay-1">Hadiah <em>Pernikahan</em></h2>
            <p class="reveal reveal-delay-2" style="font-size:.8rem;color:var(--white-dim);max-width:480px;margin:.8rem auto 0;line-height:1.8;">
                Doa restu Anda adalah hadiah terbaik bagi kami. Namun jika ingin
                memberikan tanda kasih, berikut informasinya:
            </p>
        </div>

        <div class="gift-cards">
            <div class="gift-card reveal">
                <span class="gift-bank">Bank BCA</span>
                <div class="gift-name">Rania Aurellia</div>
                <span class="gift-account" id="acc-bca">1234 5678 90</span>
                <button class="btn-copy" onclick="copyAccount('acc-bca', this)">
                    <i class="far fa-copy"></i> Salin Nomor
                </button>
            </div>

            <div class="gift-or reveal reveal-delay-1">
                <span>&nbsp; atau &nbsp;</span>
            </div>

            <div class="gift-card reveal reveal-delay-2">
                <span class="gift-bank">Bank Mandiri</span>
                <div class="gift-name">Ardan Fawwaz</div>
                <span class="gift-account" id="acc-mandiri">0987 6543 210</span>
                <button class="btn-copy" onclick="copyAccount('acc-mandiri', this)">
                    <i class="far fa-copy"></i> Salin Nomor
                </button>
            </div>
        </div>

        <div class="reveal" style="margin-top:3rem;">
            <p style="font-size:.65rem;letter-spacing:.2em;color:var(--silver);text-transform:uppercase;">
                atau kirim secara langsung ke alamat kami
            </p>
            <p style="margin-top:.6rem;font-size:.8rem;color:var(--white-dim);">
                Jl. Bunga Andong No. 14, Kec. Lowokwaru, Malang 65141
            </p>
        </div>
    </div>
</section>

<!-- ============================================================
     9. MAPS
============================================================ -->
<section id="maps">
    <div class="container">
        <div class="maps-header">
            <span class="section-label reveal">Lokasi</span>
            <h2 class="section-title reveal reveal-delay-1">Temukan <em>Kami</em></h2>
        </div>

        <div class="maps-grid">
            <div class="map-wrap reveal">
                {{-- Ganti src iframe dengan embed Google Maps yang sesuai --}}
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.2!2d112.6304!3d-7.9666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNTcnNTkuOCJTIDExMsKwMzcnNDkuNiJF!5e0!3m2!1sid!2sid!4v1"
                    allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi Akad">
                </iframe>
                <div class="map-info">
                    <div class="map-venue">Masjid Al-Ikhlas</div>
                    <p class="map-address">Jl. Soekarno Hatta No. 10, Malang, Jawa Timur 65141</p>
                    <a href="https://maps.google.com" target="_blank" class="btn-maps">
                        <i class="fas fa-directions"></i> Buka di Google Maps
                    </a>
                </div>
            </div>

            <div class="map-wrap reveal reveal-delay-1">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.8!2d112.6134!3d-7.9789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNTgnNDQuMCJTIDExMsKwMzYnNDguMiJF!5e0!3m2!1sid!2sid!4v1"
                    allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi Resepsi">
                </iframe>
                <div class="map-info">
                    <div class="map-venue">Grand Mercure Malang Mirama</div>
                    <p class="map-address">Jl. Ijen No. 60, Kec. Klojen, Kota Malang, Jawa Timur 65119</p>
                    <a href="https://maps.google.com" target="_blank" class="btn-maps">
                        <i class="fas fa-directions"></i> Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     FOOTER
============================================================ -->
<footer>
    <div class="container">
        <div class="footer-names reveal">
            <span>Rania Aurellia</span>
            <span class="footer-amp">&amp;</span>
            <span>Ardan Fawwaz</span>
        </div>
        <p class="footer-date reveal reveal-delay-1">20 . 09 . 2025</p>
        <div class="divider-gold" style="margin:2rem auto;justify-content:center;">
            <span></span><i class="fas fa-heart" style="color:var(--rose-gold);font-size:.6rem"></i><span></span>
        </div>
        <p class="footer-note reveal reveal-delay-2">
            Dibuat dengan penuh cinta &nbsp;·&nbsp; Terima kasih telah hadir dalam perjalanan kami
        </p>
    </div>
</footer>

<!-- ============================================================
     JAVASCRIPT
============================================================ -->
<script>
    /* ============================================
       OPEN INVITATION
    ============================================ */
    function openInvitation() {
        const overlay = document.getElementById('opening-overlay');
        overlay.classList.add('hidden');
        document.body.classList.remove('locked');

        // Start music after interaction
        const audio = document.getElementById('bg-music');
        audio.volume = 0.3;
        audio.play().catch(() => {});
        document.getElementById('music-info').classList.add('show');
        document.getElementById('music-icon').className = 'fas fa-pause';
    }

    /* ============================================
       MUSIC TOGGLE
    ============================================ */
    let isPlaying = false;
    function toggleMusic() {
        const audio = document.getElementById('bg-music');
        const icon  = document.getElementById('music-icon');
        const info  = document.getElementById('music-info');
        if (audio.paused) {
            audio.play().catch(() => {});
            icon.className = 'fas fa-pause';
            info.classList.add('show');
            isPlaying = true;
        } else {
            audio.pause();
            icon.className = 'fas fa-music';
            info.classList.remove('show');
            isPlaying = false;
        }
    }

    /* ============================================
       COUNTDOWN TIMER
    ============================================ */
    function updateCountdown() {
        const target = new Date('2025-09-20T08:00:00').getTime();
        const now    = Date.now();
        const diff   = target - now;

        if (diff <= 0) {
            ['cd-days','cd-hours','cd-minutes','cd-seconds'].forEach(id => {
                document.getElementById(id).textContent = '00';
            });
            return;
        }

        const d = Math.floor(diff / 86400000);
        const h = Math.floor((diff % 86400000) / 3600000);
        const m = Math.floor((diff % 3600000)  / 60000);
        const s = Math.floor((diff % 60000)    / 1000);

        document.getElementById('cd-days').textContent    = String(d).padStart(2,'0');
        document.getElementById('cd-hours').textContent   = String(h).padStart(2,'0');
        document.getElementById('cd-minutes').textContent = String(m).padStart(2,'0');
        document.getElementById('cd-seconds').textContent = String(s).padStart(2,'0');
    }
    updateCountdown();
    setInterval(updateCountdown, 1000);

    /* ============================================
       SCROLL REVEAL
    ============================================ */
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                revealObserver.unobserve(e.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    /* Timeline items */
    const tlObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                tlObserver.unobserve(e.target);
            }
        });
    }, { threshold: 0.3 });
    document.querySelectorAll('.timeline-item').forEach(el => tlObserver.observe(el));

    /* ============================================
       NAV DOTS
    ============================================ */
    const sections = ['hero','countdown','quote','acara','lovestory','gallery','rsvp','gift','maps'];
    const dots     = document.querySelectorAll('.nav-dot');

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            const target = document.getElementById(dot.dataset.target);
            if (target) target.scrollIntoView({ behavior: 'smooth' });
        });
    });

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const idx = sections.indexOf(e.target.id);
                dots.forEach((d, i) => d.classList.toggle('active', i === idx));
            }
        });
    }, { threshold: 0.4 });

    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) sectionObserver.observe(el);
    });

    /* ============================================
       PARALLAX SCROLL
    ============================================ */
    function parallaxUpdate() {
        const scrollY = window.scrollY;
        document.querySelectorAll('.parallax-decor').forEach(el => {
            el.style.transform = `translateY(${scrollY * 0.25}px) rotate(${el.style.getPropertyValue('--rot') || '-8deg'})`;
        });
    }
    window.addEventListener('scroll', parallaxUpdate, { passive: true });

    /* ============================================
       RSVP FORM
    ============================================ */
    function submitRSVP() {
        const name    = document.getElementById('rsvp-name').value.trim();
        const attend  = document.getElementById('rsvp-attend').value;
        const guests  = document.getElementById('rsvp-guests').value;
        const message = document.getElementById('rsvp-message').value.trim();

        if (!name) {
            document.getElementById('rsvp-name').focus();
            document.getElementById('rsvp-name').style.borderColor = 'var(--rose-gold)';
            return;
        }

        // Di sini Anda bisa kirim via AJAX ke route Laravel
        // fetch('/rsvp', { method:'POST', body: JSON.stringify({name, attend, guests, message}), headers:{'Content-Type':'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}'} })

        document.getElementById('rsvp-form-container').style.display = 'none';
        document.getElementById('rsvp-success').style.display = 'block';
    }

    /* ============================================
       COPY ACCOUNT
    ============================================ */
    function copyAccount(elemId, btn) {
        const text = document.getElementById(elemId).textContent.trim().replace(/\s/g,'');
        navigator.clipboard.writeText(text).then(() => {
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
            btn.style.color = 'var(--rose-gold)';
            setTimeout(() => { btn.innerHTML = orig; btn.style.color = ''; }, 2000);
        });
    }

    /* ============================================
       PARTICLES CANVAS
    ============================================ */
    (function initParticles() {
        const canvas = document.getElementById('particles-canvas');
        const ctx    = canvas.getContext('2d');
        let W, H, particles = [];

        function resize() {
            W = canvas.width  = window.innerWidth;
            H = canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        class Particle {
            constructor() { this.reset(); }
            reset() {
                this.x  = Math.random() * W;
                this.y  = Math.random() * H + H;
                this.vx = (Math.random() - .5) * .3;
                this.vy = -(Math.random() * .4 + .2);
                this.alpha = Math.random() * .5 + .1;
                this.size  = Math.random() * 1.8 + .4;
                const r = Math.random();
                this.color = r < .5 ? '197,136,106' : '200,200,200'; // rose-gold or silver
            }
            update() {
                this.x += this.vx;
                this.y += this.vy;
                this.alpha -= .0015;
                if (this.alpha <= 0 || this.y < -10) this.reset();
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(${this.color},${this.alpha})`;
                ctx.fill();
            }
        }

        for (let i = 0; i < 60; i++) particles.push(new Particle());

        function loop() {
            ctx.clearRect(0, 0, W, H);
            particles.forEach(p => { p.update(); p.draw(); });
            requestAnimationFrame(loop);
        }
        loop();
    })();
</script>

</body>
</html>