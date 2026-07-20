<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan: {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    <meta name="description" content="Undangan pernikahan digital {{ $invitation->groom_name }} & {{ $invitation->bride_name }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Great+Vibes&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #8a3b47;
            --primary-foreground: #fff8f5;
            --rose: #c97e88;
            --gold: #d4a373;
            --blush: #f7dede;
            --cream: #fdf8f3;
            --sage: #b8c9b0;
            --foreground: #4a2c33;
            --muted: #8a6b70;
            --border: #e8d5d8;
            --card: #fffaf7;
            --bg-soft: linear-gradient(180deg, #fdf8f3 0%, #f5e1e1 100%);
            --gradient-romantic: linear-gradient(135deg, #fce7e7 0%, #f5d5d5 50%, #fde4cf 100%);
            --gradient-envelope: linear-gradient(135deg, #c97e88 0%, #a04a56 100%);
            --shadow-petal: 0 20px 60px -20px rgba(160, 74, 86, 0.35);
            --shadow-soft: 0 10px 40px -15px rgba(160, 74, 86, 0.25);
            --shadow-gold: 0 0 40px rgba(212, 163, 115, 0.4);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Cormorant Garamond', serif;
            color: var(--foreground);
            background: var(--bg-soft);
            overflow-x: hidden;
            line-height: 1.5;
        }
        h1, h2, h3, h4 { font-family: 'Cormorant Garamond', serif; font-weight: 500; letter-spacing: 0.01em; }
        .font-script { font-family: 'Great Vibes', cursive; font-weight: 400; }
        .font-sans { font-family: 'Poppins', sans-serif; }
        img { max-width: 100%; display: block; }
        button { font-family: inherit; cursor: pointer; border: none; background: none; }
        a { color: inherit; text-decoration: none; }

        /* === Petals Animation === */
        @keyframes float-petal {
            0% { transform: translateY(-10vh) translateX(0) rotate(0deg); opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.8; }
            100% { transform: translateY(110vh) translateX(60px) rotate(360deg); opacity: 0; }
        }
        @keyframes shimmer {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }
        @keyframes bloom {
            0% { transform: scale(0.6); opacity: 0; }
            60% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes soft-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.04); }
        }
        @keyframes fade-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes envelope-open {
            0% { transform: rotateX(0deg); }
            100% { transform: rotateX(-180deg); }
        }

        .petals { position: fixed; inset: 0; pointer-events: none; z-index: 1; overflow: hidden; }
        .petal { position: absolute; top: -5vh; animation: float-petal linear infinite; }

        /* === Envelope Cover === */
        .cover {
            position: fixed; inset: 0; z-index: 100;
            background: var(--gradient-romantic);
            display: flex; align-items: center; justify-content: center;
            transition: opacity 0.7s ease;
        }
        .cover.hidden { opacity: 0; pointer-events: none; }
        .cover-inner {
            position: relative; z-index: 2;
            text-align: center; padding: 0 1.5rem;
            max-width: 32rem;
        }
        .cover-wreath {
            position: absolute; top: -3rem; left: 50%;
            transform: translateX(-50%);
            width: 20rem; height: 20rem;
            opacity: 0.4; pointer-events: none;
            background: radial-gradient(circle, #c97e88 0%, transparent 60%);
            border-radius: 50%;
            filter: blur(20px);
        }
        .cover-eyebrow {
            font-family: 'Poppins', sans-serif;
            font-size: 0.7rem; text-transform: uppercase;
            letter-spacing: 0.35em; color: var(--muted);
        }
        .cover-names {
            margin-top: 1rem;
            font-family: 'Great Vibes', cursive;
            font-size: 4rem; line-height: 1; color: var(--primary);
        }
        .cover-names span { color: var(--gold); }
        .cover-to { margin-top: 1.5rem; font-style: italic; color: var(--muted); }
        .cover-guest { margin-top: 0.25rem; font-size: 1.125rem; }

        .envelope {
            position: relative;
            width: 20rem; height: 14rem;
            margin: 2.5rem auto 0;
        }
        .envelope-body {
            position: absolute; inset: 0;
            background: var(--gradient-envelope);
            border-radius: 1rem;
            box-shadow: var(--shadow-petal);
        }
        .envelope-flap {
            position: absolute; top: 0; left: 0; right: 0;
            height: 50%;
            background: var(--gradient-envelope);
            clip-path: polygon(0 0, 100% 0, 50% 100%);
            transform-origin: top;
            transition: transform 1s ease;
        }
        .cover.opening .envelope-flap { transform: rotateX(-180deg); }
        .envelope-card {
            position: absolute; inset: 1rem;
            background: rgba(253, 248, 243, 0.95);
            border: 1px solid rgba(212, 163, 115, 0.4);
            border-radius: 0.75rem;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
        }
        .envelope-card-monogram {
            font-family: 'Great Vibes', cursive;
            font-size: 2rem; color: var(--primary);
        }
        .envelope-card-monogram span { color: var(--gold); }
        .envelope-card-date {
            margin-top: 0.5rem;
            font-family: 'Poppins', sans-serif;
            font-size: 0.65rem; letter-spacing: 0.3em;
            text-transform: uppercase; color: var(--muted);
        }
        .btn-open {
            margin-top: 2.5rem;
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 1rem 2rem;
            background: var(--primary); color: var(--primary-foreground);
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.25em;
            box-shadow: var(--shadow-petal);
            animation: soft-pulse 2.4s ease-in-out infinite;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-open:hover { transform: scale(1.05); box-shadow: var(--shadow-gold); }

        /* === Main Layout === */
        main { position: relative; z-index: 10; display: none; }
        main.visible { display: block; animation: bloom 0.9s cubic-bezier(0.34, 1.56, 0.64, 1) both; }
        section { position: relative; padding: 6rem 1.5rem; }

        .section-eyebrow {
            font-family: 'Poppins', sans-serif;
            font-size: 0.7rem; text-transform: uppercase;
            letter-spacing: 0.4em; color: var(--rose);
        }
        .section-title {
            margin-top: 0.75rem;
            font-size: 2.5rem; color: var(--primary);
        }
        .divider {
            display: flex; align-items: center; justify-content: center;
            gap: 0.75rem; padding: 2rem 0; color: var(--rose);
        }
        .divider-line {
            height: 1px; width: 4rem;
            background: linear-gradient(to right, transparent, currentColor);
            opacity: 0.5;
        }
        .divider-line.right { background: linear-gradient(to left, transparent, currentColor); }
        .divider svg { animation: shimmer 3s ease-in-out infinite; }

        /* === Hero === */
        .hero { min-height: 100vh; text-align: center; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .hero-decor {
            position: absolute; width: 20rem; height: 20rem; pointer-events: none;
            background: radial-gradient(circle, #f5c8c8 0%, transparent 65%);
            border-radius: 50%;
            filter: blur(30px);
        }
        .hero-decor.tr { top: -5rem; right: -5rem; opacity: 0.4; }
        .hero-decor.bl { bottom: -5rem; left: -5rem; opacity: 0.35; }
        .hero-inner { position: relative; max-width: 40rem; margin: 0 auto; }
        .verse { max-width: 28rem; margin: 1.5rem auto 0; font-style: italic; color: rgba(74, 44, 51, 0.8); }
        .verse-source { margin-top: 0.5rem; font-family: 'Poppins', sans-serif; font-size: 0.75rem; letter-spacing: 0.15em; color: var(--rose); }
        .hero-name { margin-top: 2rem; font-family: 'Great Vibes', cursive; font-size: 5rem; line-height: 1; color: var(--primary); }
        .amp-row { display: flex; align-items: center; justify-content: center; gap: 1rem; margin: 0.75rem 0; }
        .amp-line { height: 1px; width: 5rem; background: var(--gold); }
        .amp { font-family: 'Great Vibes', cursive; font-size: 2.5rem; color: var(--gold); }
        .hero-date { margin-top: 2rem; font-size: 1.5rem; }

        /* === Countdown === */
        .countdown { margin-top: 2.5rem; display: flex; align-items: center; justify-content: center; gap: 0.75rem; }
        .cd-box { display: flex; flex-direction: column; align-items: center; }
        .cd-value {
            width: 4rem; height: 4rem;
            display: flex; align-items: center; justify-content: center;
            background: var(--gradient-romantic);
            border-radius: 1rem;
            box-shadow: var(--shadow-petal);
            font-size: 1.5rem; font-weight: 600; color: var(--primary);
        }
        .cd-label {
            margin-top: 0.5rem;
            font-family: 'Poppins', sans-serif;
            font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.2em;
            color: var(--muted);
        }

        /* === Mempelai === */
        .couple-grid { display: grid; gap: 3.5rem; max-width: 60rem; margin: 0 auto; text-align: center; }
        .person { display: flex; flex-direction: column; align-items: center; }
        .person-photo-wrap { position: relative; }
        .person-photo-glow {
            position: absolute; inset: -0.75rem;
            border-radius: 50%;
            background: var(--gradient-romantic);
            opacity: 0.7;
            filter: blur(20px);
            transition: opacity 0.3s ease;
        }
        .person:hover .person-photo-glow { opacity: 1; }
        .person-photo {
            position: relative; overflow: hidden;
            width: 14rem; height: 14rem; border-radius: 50%;
            border: 4px solid var(--cream);
            box-shadow: var(--shadow-petal);
        }
        .person-photo img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease; }
        .person:hover .person-photo img { transform: scale(1.05); }
        .person-role { margin-top: 1.5rem; font-family: 'Poppins', sans-serif; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.3em; color: var(--gold); }
        .person-name { margin-top: 0.5rem; font-size: 1.875rem; color: var(--primary); }
        .person-parents { margin-top: 0.75rem; max-width: 20rem; font-style: italic; color: var(--muted); }
        .person-ig {
            margin-top: 1rem;
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.375rem 1rem;
            border: 1px solid rgba(201, 126, 136, 0.4);
            border-radius: 999px;
            font-family: 'Poppins', sans-serif; font-size: 0.75rem;
            color: var(--rose);
            transition: all 0.3s ease;
        }
        .person-ig:hover { background: var(--rose); color: white; }

        /* === Story === */
        .story-section { background: linear-gradient(180deg, transparent, rgba(252, 231, 231, 0.5), transparent); }
        .story-list { list-style: none; max-width: 50rem; margin: 2rem auto 0; display: flex; flex-direction: column; gap: 2.5rem; }
        .story-card {
            background: rgba(255, 250, 247, 0.9);
            padding: 1.75rem;
            border-radius: 1.5rem;
            box-shadow: var(--shadow-soft);
            text-align: left;
            backdrop-filter: blur(4px);
        }
        .story-date { font-family: 'Poppins', sans-serif; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.3em; color: var(--gold); }
        .story-title { margin-top: 0.5rem; font-size: 1.5rem; color: var(--primary); }
        .story-text { margin-top: 0.75rem; font-style: italic; color: var(--muted); }

        /* === Acara === */
        .events { display: grid; gap: 1.5rem; max-width: 50rem; margin: 0 auto; }
        .event-card {
            position: relative; overflow: hidden;
            background: var(--card);
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: var(--shadow-soft);
            text-align: center;
            transition: box-shadow 0.3s ease;
        }
        .event-card:hover { box-shadow: var(--shadow-petal); }
        .event-icon {
            width: 3.5rem; height: 3.5rem; margin: 0 auto;
            display: flex; align-items: center; justify-content: center;
            background: var(--gradient-envelope); color: white;
            border-radius: 50%;
        }
        .event-title { margin-top: 1rem; font-size: 1.875rem; color: var(--primary); }
        .event-date { margin-top: 0.75rem; font-size: 1.125rem; }
        .event-time { color: var(--muted); }
        .event-sep { width: 4rem; height: 1px; background: var(--gold); margin: 1rem auto; }
        .event-place { font-style: italic; color: var(--muted); }
        .btn-map {
            margin-top: 2.5rem;
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 2rem;
            background: var(--primary); color: var(--primary-foreground);
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.2em;
            box-shadow: var(--shadow-petal);
            transition: transform 0.3s ease;
        }
        .btn-map:hover { transform: scale(1.05); }

        /* === Gallery === */
        .gallery {
            display: grid; grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem; max-width: 70rem; margin: 0 auto;
        }
        .gallery-item {
            position: relative; overflow: hidden;
            border-radius: 1.5rem; box-shadow: var(--shadow-soft);
            aspect-ratio: 1 / 1;
        }
        .gallery-item.tall { aspect-ratio: 3 / 5; grid-row: span 2; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease; }
        .gallery-item:hover img { transform: scale(1.1); }
        .gallery-quote {
            grid-column: span 2;
            background: var(--gradient-romantic);
            border-radius: 1.5rem;
            padding: 2rem; text-align: center;
            display: flex; align-items: center; justify-content: center;
        }
        .gallery-quote-text { font-family: 'Great Vibes', cursive; font-size: 1.875rem; color: var(--primary); }

        /* === RSVP + Gift === */
        .rsvp-section { background: linear-gradient(180deg, transparent, rgba(252, 231, 231, 0.5), transparent); }
        .rsvp-grid { display: grid; gap: 2.5rem; max-width: 60rem; margin: 0 auto; }
        .panel { background: var(--card); padding: 2rem; border-radius: 1.5rem; box-shadow: var(--shadow-petal); }
        .panel-eyebrow { font-family: 'Poppins', sans-serif; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.3em; color: var(--rose); }
        .panel-title { margin-top: 0.5rem; font-size: 1.875rem; color: var(--primary); }
        .panel-sub { margin-top: 0.5rem; font-style: italic; color: var(--muted); }

        .form-field {
            width: 100%; padding: 0.75rem 1.25rem;
            border: 1px solid var(--border);
            background: var(--bg-soft);
            border-radius: 1rem;
            font-family: 'Poppins', sans-serif; font-size: 0.875rem;
            outline: none; transition: border-color 0.3s ease;
        }
        .form-field:focus { border-color: var(--rose); }
        textarea.form-field { resize: vertical; min-height: 6rem; }
        .form-row { margin-top: 1rem; }
        .attend-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; margin-top: 1rem; }
        .attend-option input { display: none; }
        .attend-option label {
            display: block; text-align: center; cursor: pointer;
            padding: 0.625rem;
            border: 1px solid var(--border); border-radius: 1rem;
            font-family: 'Poppins', sans-serif;
            font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.15em;
            color: var(--muted);
            transition: all 0.3s ease;
        }
        .attend-option label:hover { border-color: var(--rose); }
        .attend-option input:checked + label { background: var(--rose); color: white; border-color: var(--rose); }
        .btn-submit {
            width: 100%; margin-top: 1rem;
            padding: 0.9rem;
            background: var(--primary); color: var(--primary-foreground);
            border-radius: 999px;
            font-family: 'Poppins', sans-serif; font-size: 0.75rem;
            text-transform: uppercase; letter-spacing: 0.25em;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }
        .btn-submit:hover { transform: scale(1.02); box-shadow: var(--shadow-petal); }

        .bank { position: relative; overflow: hidden;
            border: 1px solid var(--border); border-radius: 1rem;
            background: linear-gradient(135deg, var(--cream), var(--blush));
            padding: 1.25rem;
        }
        .bank-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .bank-label { font-family: 'Poppins', sans-serif; font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.15em; color: var(--muted); }
        .bank-num { margin-top: 0.25rem; font-size: 1.5rem; letter-spacing: 0.05em; color: var(--primary); }
        .bank-name { font-style: italic; font-size: 0.875rem; color: var(--muted); }
        .btn-copy {
            padding: 0.5rem 1rem; background: var(--primary); color: var(--primary-foreground);
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.15em;
            transition: transform 0.3s ease;
        }
        .btn-copy:hover { transform: scale(1.05); }
        .gift-address {
            margin-top: 1rem; padding: 1rem;
            border: 1px dashed rgba(201, 126, 136, 0.5);
            border-radius: 1rem; text-align: center;
        }

        /* === Wishes Wall === */
        .wishes-count { margin-top: 0.5rem; font-family: 'Poppins', sans-serif; font-size: 0.75rem; color: var(--muted); }
        .wishes-list { list-style: none; max-width: 50rem; margin: 2rem auto 0; display: grid; gap: 1rem; }
        .wish {
            background: var(--card); padding: 1.25rem;
            border-radius: 1.5rem; box-shadow: var(--shadow-soft);
            animation: fade-up 0.6s ease-out both;
        }
        .wish-head { display: flex; align-items: center; gap: 0.75rem; }
        .wish-avatar {
            flex-shrink: 0;
            width: 2.75rem; height: 2.75rem;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            background: var(--gradient-envelope);
            color: white; font-size: 1.125rem; font-weight: 600;
        }
        .wish-name { font-size: 1.125rem; color: var(--primary); }
        .wish-badge {
            display: inline-block; padding: 0.15rem 0.5rem; margin-top: 0.15rem;
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.55rem; text-transform: uppercase; letter-spacing: 0.15em;
        }
        .wish-badge.hadir { background: rgba(184, 201, 176, 0.4); color: #3a5a3a; }
        .wish-badge.ragu { background: rgba(212, 163, 115, 0.4); color: #7a5a2a; }
        .wish-badge.tidak { background: var(--blush); color: var(--rose); }
        .wish-msg { margin-top: 0.75rem; font-style: italic; color: rgba(74, 44, 51, 0.8); }
        .wishes-empty { text-align: center; margin-top: 2rem; font-style: italic; color: var(--muted); }

        /* === Footer === */
        footer { text-align: center; padding: 6rem 1.5rem; position: relative; }
        .footer-text { max-width: 32rem; margin: 0 auto; font-style: italic; color: var(--muted); }
        .footer-salam { margin-top: 1.5rem; font-family: 'Poppins', sans-serif; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.3em; color: var(--rose); }
        .footer-eyebrow { margin-top: 2rem; font-family: 'Poppins', sans-serif; font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.4em; color: var(--muted); }
        .footer-names { margin-top: 1rem; font-family: 'Great Vibes', cursive; font-size: 3rem; color: var(--primary); }
        .footer-names span { color: var(--gold); }
        .footer-credit { margin-top: 2.5rem; font-family: 'Poppins', sans-serif; font-size: 0.625rem; text-transform: uppercase; letter-spacing: 0.3em; color: var(--muted); }

        /* === Responsive === */
        @media (min-width: 640px) {
            .cover-names { font-size: 6rem; }
            .envelope { width: 24rem; height: 16rem; }
            .envelope-card-monogram { font-size: 2.5rem; }
            .hero-name { font-size: 7rem; }
            .section-title { font-size: 3rem; }
            .cd-value { width: 6rem; height: 6rem; font-size: 2.5rem; }
            .cd-label { font-size: 0.75rem; }
            .person-photo { width: 18rem; height: 18rem; }
            .hero-decor { width: 28rem; height: 28rem; }
            .gallery { grid-template-columns: repeat(4, 1fr); gap: 1.25rem; }
            .gallery-quote { grid-column: span 2; }
        }
        @media (min-width: 768px) {
            .couple-grid { grid-template-columns: repeat(2, 1fr); gap: 2.5rem; }
            .events { grid-template-columns: repeat(2, 1fr); }
            .rsvp-grid { grid-template-columns: repeat(2, 1fr); }
            .wishes-list { grid-template-columns: repeat(2, 1fr); }
            .footer-names { font-size: 4rem; }
        }
    </style>
</head>
<body>

    {{-- ================ COVER / ENVELOPE ================ --}}
    <div class="cover" id="cover">
        <div class="petals" id="petals-cover"></div>
        <div class="cover-inner">
            <div class="cover-wreath"></div>
            <p class="cover-eyebrow">The Wedding of</p>
            <h1 class="cover-names">{{ $invitation->groom_nickname }} <span>&</span> {{ $invitation->bride_nickname }}</h1>
            <p class="cover-to">Kepada Yth. Bapak / Ibu / Saudara / i</p>
            <p class="cover-guest" id="guest-name">Tamu Undangan</p>

            <div class="envelope">
                <div class="envelope-body"></div>
                <div class="envelope-flap"></div>
                <div class="envelope-card">
                    <div class="envelope-card-monogram">{{ strtoupper(substr($invitation->groom_nickname,0,1)) }} <span>&</span> {{ strtoupper(substr($invitation->bride_nickname,0,1)) }}</div>
                    <p class="envelope-card-date">{{ $invitation->event_date->format('d · m · Y') }}</p>
                </div>
            </div>

            <button class="btn-open" onclick="openInvitation()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm2 0v.5l6 4 6-4V6H6z"/></svg>
                Buka Undangan
            </button>
        </div>
    </div>

    <div class="petals" id="petals-main"></div>

    {{-- ================ MAIN CONTENT ================ --}}
    <main id="main">

        {{-- HERO WELCOME + COUNTDOWN --}}
        <section class="hero">
            <div class="hero-decor tr"></div>
            <div class="hero-decor bl"></div>
            <div class="hero-inner">
                <p class="section-eyebrow">Bismillahirrahmanirrahim</p>
                <p class="verse">"Dan di antara tanda-tanda kekuasaan-Nya, Dia menciptakan untukmu pasangan hidup dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya."</p>
                <p class="verse-source">— QS. Ar-Rum : 21</p>

                <h1 class="hero-name font-script">{{ $invitation->groom_nickname }}</h1>
                <div class="amp-row">
                    <span class="amp-line"></span>
                    <span class="amp">&</span>
                    <span class="amp-line"></span>
                </div>
                <h1 class="hero-name font-script">{{ $invitation->bride_nickname }}</h1>

                <p class="hero-date">{{ $invitation->event_date->translatedFormat('d · F · Y') }}</p>

                <div class="countdown">
                    <div class="cd-box"><div class="cd-value" id="cd-days">00</div><span class="cd-label">Hari</span></div>
                    <div class="cd-box"><div class="cd-value" id="cd-hours">00</div><span class="cd-label">Jam</span></div>
                    <div class="cd-box"><div class="cd-value" id="cd-minutes">00</div><span class="cd-label">Menit</span></div>
                    <div class="cd-box"><div class="cd-value" id="cd-seconds">00</div><span class="cd-label">Detik</span></div>
                </div>
            </div>
        </section>

        {{-- MEMPELAI --}}
        <section>
            <div style="text-align:center;">
                <p class="section-eyebrow">The Bride & Groom</p>
                <h2 class="section-title">Mempelai Kami</h2>
                <div class="divider">
                    <span class="divider-line"></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-7-4.5-9-9c-1.5-3.5 1-7 4.5-7 2 0 3.5 1 4.5 2.5C13 6 14.5 5 16.5 5 20 5 22.5 8.5 21 12c-2 4.5-9 9-9 9z"/></svg>
                    <span class="divider-line right"></span>
                </div>
            </div>

            <div class="couple-grid">
                @php
                    $mempelai = [
                        [
                            'img'     => $invitation->groom_photo,
                            'role'    => 'The Groom',
                            'name'    => $invitation->groom_name,
                            'parents' => 'Putra dari Bapak ' . $invitation->groom_father . ' & Ibu ' . $invitation->groom_mother,
                        ],
                        [
                            'img'     => $invitation->bride_photo,
                            'role'    => 'The Bride',
                            'name'    => $invitation->bride_name,
                            'parents' => 'Putri dari Bapak ' . $invitation->bride_father . ' & Ibu ' . $invitation->bride_mother,
                        ],
                    ];
                @endphp
                @foreach ($mempelai as $p)
                    <div class="person">
                        <div class="person-photo-wrap">
                            <div class="person-photo-glow"></div>
                            <div class="person-photo">
                                <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" loading="lazy">
                            </div>
                        </div>
                        <p class="person-role">{{ $p['role'] }}</p>
                        <h3 class="person-name">{{ $p['name'] }}</h3>
                        <p class="person-parents">{{ $p['parents'] }}</p>
                        @if(isset($p['ig']))
                        <a class="person-ig" href="https://instagram.com/{{ $p['ig'] }}" target="_blank" rel="noreferrer">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.2.4.4 1 .4 2.2.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.2-1 .4-2.2.4-1.3.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.2-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.2 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2M12 0C8.7 0 8.3 0 7.1.1 5.8.1 5 .3 4.2.6c-.8.3-1.5.7-2.2 1.4C1.3 2.7.9 3.4.6 4.2.3 5 .1 5.8.1 7.1 0 8.3 0 8.7 0 12s0 3.7.1 4.9c.1 1.3.3 2.1.6 2.9.3.8.7 1.5 1.4 2.2.7.7 1.4 1.1 2.2 1.4.8.3 1.6.5 2.9.6C8.3 24 8.7 24 12 24s3.7 0 4.9-.1c1.3-.1 2.1-.3 2.9-.6.8-.3 1.5-.7 2.2-1.4.7-.7 1.1-1.4 1.4-2.2.3-.8.5-1.6.6-2.9.1-1.2.1-1.6.1-4.8s0-3.7-.1-4.9c-.1-1.3-.3-2.1-.6-2.9-.3-.8-.7-1.5-1.4-2.2C21.3 1.3 20.6.9 19.8.6 19 .3 18.2.1 16.9.1 15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 100 12.4 6.2 6.2 0 000-12.4zm0 10.2A4 4 0 1112 8a4 4 0 010 8zm6.4-10.5a1.44 1.44 0 100-2.9 1.44 1.44 0 000 2.9z"/></svg>
                            &#64;{{ $p['ig'] }}
                        </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        {{-- CERITA --}}
        <section class="story-section">
            <div style="text-align:center;">
                <p class="section-eyebrow">Our Story</p>
                <h2 class="section-title">Cerita Kami</h2>
                <div class="divider">
                    <span class="divider-line"></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-7-4.5-9-9c-1.5-3.5 1-7 4.5-7 2 0 3.5 1 4.5 2.5C13 6 14.5 5 16.5 5 20 5 22.5 8.5 21 12c-2 4.5-9 9-9 9z"/></svg>
                    <span class="divider-line right"></span>
                </div>
            </div>

            @php
                $story = [
                    ['Maret 2020', 'Pertama Bertemu', 'Sebuah pertemuan tak terduga di sebuah kafe kecil menjadi awal dari segalanya.'],
                    ['Desember 2021', 'Menjadi Sepasang', "Di bawah langit senja, Raka memberanikan diri berkata: 'Maukah kau menjadi milikku?'"],
                    ['Mei 2025', 'Lamaran', 'Dengan cincin dan janji, keluarga besar menyaksikan momen suci penuh haru.'],
                    ['Oktober 2026', 'Menuju Halal', 'Insya Allah, kami akan mengucap janji suci di hadapan Allah dan keluarga tercinta.'],
                ];
            @endphp
            <ul class="story-list">
                @foreach ($story as $s)
                    <li class="story-card">
                        <p class="story-date">{{ $s[0] }}</p>
                        <h3 class="story-title">{{ $s[1] }}</h3>
                        <p class="story-text">{{ $s[2] }}</p>
                    </li>
                @endforeach
            </ul>
        </section>

        {{-- ACARA --}}
        <section>
            <div style="text-align:center;">
                <p class="section-eyebrow">Save The Date</p>
                <h2 class="section-title">Rangkaian Acara</h2>
                <div class="divider">
                    <span class="divider-line"></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-7-4.5-9-9c-1.5-3.5 1-7 4.5-7 2 0 3.5 1 4.5 2.5C13 6 14.5 5 16.5 5 20 5 22.5 8.5 21 12c-2 4.5-9 9-9 9z"/></svg>
                    <span class="divider-line right"></span>
                </div>
            </div>

            @php
                $events = [
                    ['Akad Nikah', $invitation->event_time, $invitation->event_date->translatedFormat('l, d F Y'), $invitation->event_location],
                    ['Resepsi',    '13.00 – 17.00 WIB',     $invitation->event_date->translatedFormat('l, d F Y'), $invitation->event_location],
                ];
            @endphp
            <div class="events">
                @foreach ($events as $e)
                    <div class="event-card">
                        <div class="event-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-7-4.5-9-9c-1.5-3.5 1-7 4.5-7 2 0 3.5 1 4.5 2.5C13 6 14.5 5 16.5 5 20 5 22.5 8.5 21 12c-2 4.5-9 9-9 9z"/></svg>
                        </div>
                        <h3 class="event-title">{{ $e[0] }}</h3>
                        <p class="event-date">{{ $e[2] }}</p>
                        <p class="event-time">{{ $e[1] }}</p>
                        <div class="event-sep"></div>
                        <p class="event-place">{{ $e[3] }}</p>
                    </div>
                @endforeach
            </div>

            <div style="text-align:center;">
                <a class="btn-map" href="{{ $invitation->event_map_url }}" target="_blank" rel="noreferrer">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5A2.5 2.5 0 1112 6.5a2.5 2.5 0 010 5z"/></svg>
                    Lihat Lokasi
                </a>
            </div>
        </section>

        {{-- GALLERY --}}
        <section>
            <div style="text-align:center;">
                <p class="section-eyebrow">Our Moments</p>
                <h2 class="section-title">Galeri Kami</h2>
                <div class="divider">
                    <span class="divider-line"></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-7-4.5-9-9c-1.5-3.5 1-7 4.5-7 2 0 3.5 1 4.5 2.5C13 6 14.5 5 16.5 5 20 5 22.5 8.5 21 12c-2 4.5-9 9-9 9z"/></svg>
                    <span class="divider-line right"></span>
                </div>
            </div>

            @php
                $gallery = [
                    'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&h=1000&fit=crop',
                    'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&h=800&fit=crop',
                    'https://images.unsplash.com/photo-1529636798458-92182e662485?w=800&h=800&fit=crop',
                    'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&h=1000&fit=crop',
                ];
            @endphp
            <div class="gallery">
                <div class="gallery-item tall"><img src="{{ $gallery[0] }}" alt="galeri 1" loading="lazy"></div>
                <div class="gallery-item"><img src="{{ $gallery[1] }}" alt="galeri 2" loading="lazy"></div>
                <div class="gallery-item"><img src="{{ $gallery[2] }}" alt="galeri 3" loading="lazy"></div>
                <div class="gallery-item tall"><img src="{{ $gallery[3] }}" alt="galeri 4" loading="lazy"></div>
                <div class="gallery-quote">
                    <p class="gallery-quote-text">Forever &amp; Always</p>
                </div>
            </div>
        </section>

        {{-- RSVP + GIFT --}}
        <section class="rsvp-section">
            <div class="rsvp-grid">
                {{-- RSVP form --}}
                <div class="panel">
                    <p class="panel-eyebrow">RSVP & Ucapan</p>
                    <h3 class="panel-title">Kirimkan Doamu</h3>
                    <p class="panel-sub">Kehadiran & doa restu dari kamu sangat berarti bagi kami.</p>

                    <form id="rsvp-form" style="margin-top: 1.5rem;">
                        <div class="form-row"><input required class="form-field" type="text" name="name" placeholder="Nama kamu"></div>
                        <div class="form-row"><textarea required class="form-field" name="message" rows="4" placeholder="Tuliskan ucapan & doa..."></textarea></div>
                        <div class="attend-grid">
                            <div class="attend-option"><input type="radio" id="a1" name="attending" value="hadir" checked><label for="a1">Hadir</label></div>
                            <div class="attend-option"><input type="radio" id="a2" name="attending" value="ragu"><label for="a2">Ragu</label></div>
                            <div class="attend-option"><input type="radio" id="a3" name="attending" value="tidak"><label for="a3">Tidak Hadir</label></div>
                        </div>
                        <button type="submit" class="btn-submit">Kirim Ucapan</button>
                    </form>
                </div>

                {{-- Gift --}}
                <div class="panel">
                    <p class="panel-eyebrow">Wedding Gift</p>
                    <h3 class="panel-title">Kirim Hadiah</h3>
                    <p class="panel-sub">Doa restu adalah hadiah terindah. Namun jika ingin memberikan tanda kasih, kami menerima dengan tangan terbuka.</p>

                    @php
                        $banks = [
                            ['BCA', '1234567890', 'Aisyah Putri A.'],
                            ['Mandiri', '0987654321', 'Raka Prawira S.'],
                        ];
                    @endphp
                    <div style="margin-top:1.5rem; display:flex; flex-direction:column; gap:1rem;">
                        @foreach ($banks as $b)
                            <div class="bank">
                                <div class="bank-row">
                                    <div>
                                        <p class="bank-label">Bank {{ $b[0] }}</p>
                                        <p class="bank-num">{{ $b[1] }}</p>
                                        <p class="bank-name">a.n. {{ $b[2] }}</p>
                                    </div>
                                    <button class="btn-copy" onclick="copyNum('{{ $b[1] }}', this)">Salin</button>
                                </div>
                            </div>
                        @endforeach
                        <div class="gift-address">
                            <p class="panel-eyebrow" style="color:var(--rose);">Kirim Kado</p>
                            <p style="margin-top:0.25rem; font-size:0.875rem; color:var(--muted);">Jl. Melati Indah No. 21, Jakarta Selatan 12345</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- WISHES WALL --}}
        <section>
            <div style="text-align:center;">
                <p class="section-eyebrow">Wishes Wall</p>
                <h2 class="section-title">Ucapan & Doa</h2>
                <p class="wishes-count"><span id="wish-count">0</span> ucapan tersayang</p>
                <div class="divider">
                    <span class="divider-line"></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-7-4.5-9-9c-1.5-3.5 1-7 4.5-7 2 0 3.5 1 4.5 2.5C13 6 14.5 5 16.5 5 20 5 22.5 8.5 21 12c-2 4.5-9 9-9 9z"/></svg>
                    <span class="divider-line right"></span>
                </div>
            </div>

            <ul class="wishes-list" id="wishes-list"></ul>
            <p class="wishes-empty" id="wishes-empty">Jadilah yang pertama mengirim doa & ucapan ✨</p>
        </section>

        {{-- FOOTER --}}
        <footer>
            <p class="footer-text">Merupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.</p>
            <p class="footer-salam">Wassalamualaikum Wr. Wb.</p>
            <p class="footer-eyebrow">Kami yang berbahagia</p>
            <h3 class="footer-names">{{ $invitation->groom_nickname }} <span>&</span> {{ $invitation->bride_nickname }}</h3>
            <p class="footer-credit">Made with 💗 · WeddingKita.com</p>
        </footer>
    </main>

    <script>
        // ============ Auto-fill guest name from ?to=Nama ============
        (function () {
            const params = new URLSearchParams(window.location.search);
            const to = params.get('to');
            if (to) document.getElementById('guest-name').textContent = decodeURIComponent(to);
        })();

        // ============ Petals ============
        function makePetals(containerId, count) {
            const c = document.getElementById(containerId);
            if (!c) return;
            const colors = ['#e8a5ad', '#f5c8c8', '#d4a373', '#c97e88'];
            for (let i = 0; i < count; i++) {
                const el = document.createElement('div');
                el.className = 'petal';
                const size = 10 + Math.random() * 16;
                el.style.left = (Math.random() * 100) + '%';
                el.style.animationDelay = (Math.random() * 12) + 's';
                el.style.animationDuration = (12 + Math.random() * 10) + 's';
                el.style.opacity = 0.4 + Math.random() * 0.5;
                const color = colors[i % colors.length];
                el.innerHTML = `<svg width="${size}" height="${size}" viewBox="0 0 24 24" fill="${color}"><path d="M12 2C8 6 6 10 6 14c0 3.3 2.7 6 6 6s6-2.7 6-6c0-4-2-8-6-12z"/></svg>`;
                c.appendChild(el);
            }
        }
        makePetals('petals-cover', 16);
        makePetals('petals-main', 20);

        // ============ Open Envelope ============
        function openInvitation() {
            const cover = document.getElementById('cover');
            cover.classList.add('opening');
            setTimeout(() => {
                cover.classList.add('hidden');
                document.getElementById('main').classList.add('visible');
                // Try play music if you add an <audio id="bgm"> element
                const bgm = document.getElementById('bgm');
                if (bgm) bgm.play().catch(() => {});
            }, 1400);
        }

        // ============ Countdown ============
        const WEDDING_DATE = new Date('{{ $invitation->event_date->format("Y-m-d") }}T09:00:00+07:00').getTime();
        function pad(n) { return String(n).padStart(2, '0'); }
        function updateCountdown() {
            const diff = Math.max(0, WEDDING_DATE - Date.now());
            document.getElementById('cd-days').textContent    = pad(Math.floor(diff / 86400000));
            document.getElementById('cd-hours').textContent   = pad(Math.floor(diff / 3600000) % 24);
            document.getElementById('cd-minutes').textContent = pad(Math.floor(diff / 60000) % 60);
            document.getElementById('cd-seconds').textContent = pad(Math.floor(diff / 1000) % 60);
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);

        // ============ Copy rekening ============
        function copyNum(num, btn) {
            navigator.clipboard?.writeText(num);
            const orig = btn.textContent;
            btn.textContent = 'Tersalin';
            setTimeout(() => btn.textContent = orig, 1500);
        }

        // ============ Wishes (localStorage) ============
        // Untuk simpan ke database Laravel, ganti bagian ini dengan fetch POST ke route yang menyimpan ke DB.
        const STORAGE_KEY = 'wedding-wishes';
        function loadWishes() {
            try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; } catch { return []; }
        }
        function saveWishes(list) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(list));
        }
        function escapeHtml(s) {
            return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
        }
        function badgeInfo(v) {
            if (v === 'hadir') return { cls: 'hadir', label: 'Akan Hadir' };
            if (v === 'ragu')  return { cls: 'ragu',  label: 'Masih Ragu' };
            return { cls: 'tidak', label: 'Tidak Hadir' };
        }
        function renderWishes() {
            const list = loadWishes();
            const ul = document.getElementById('wishes-list');
            const empty = document.getElementById('wishes-empty');
            document.getElementById('wish-count').textContent = list.length;
            ul.innerHTML = '';
            if (!list.length) { empty.style.display = 'block'; return; }
            empty.style.display = 'none';
            list.forEach(w => {
                const b = badgeInfo(w.attending);
                const li = document.createElement('li');
                li.className = 'wish';
                li.innerHTML = `
                    <div class="wish-head">
                        <div class="wish-avatar">${escapeHtml((w.name[0] || '?').toUpperCase())}</div>
                        <div style="min-width:0; flex:1;">
                            <p class="wish-name" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">${escapeHtml(w.name)}</p>
                            <span class="wish-badge ${b.cls}">${b.label}</span>
                        </div>
                    </div>
                    <p class="wish-msg">"${escapeHtml(w.message)}"</p>
                `;
                ul.appendChild(li);
            });
        }
        renderWishes();

        document.getElementById('rsvp-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            const name = (fd.get('name') || '').toString().trim();
            const message = (fd.get('message') || '').toString().trim();
            const attending = (fd.get('attending') || 'hadir').toString();
            if (!name || !message) return;
            const list = loadWishes();
            list.unshift({ id: Date.now(), name, message, attending, createdAt: Date.now() });
            saveWishes(list);
            this.reset();
            document.getElementById('a1').checked = true;
            renderWishes();
            document.getElementById('wishes-list').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    </script>

    {{-- 
    ============================================================
    Contoh integrasi ke database Laravel (opsional):

    1. Buat migration:
        Schema::create('wishes', function ($t) {
            $t->id(); $t->string('name'); $t->text('message');
            $t->string('attending'); $t->timestamps();
        });

    2. Route (routes/web.php):
        Route::post('/wishes', function (\Illuminate\Http\Request $r) {
            $data = $r->validate([
                'name' => 'required|string|max:80',
                'message' => 'required|string|max:500',
                'attending' => 'required|in:hadir,ragu,tidak',
            ]);
            \App\Models\Wish::create($data);
            return response()->json(['ok' => true]);
        });

    3. Ganti submit handler JS-nya:
        fetch('/wishes', {
            method: 'POST',
            headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ name, message, attending })
        }).then(r => r.json()).then(() => location.reload());

    4. Kirim data ke Blade & loop:
        $wishes = \App\Models\Wish::latest()->get();
        return view('undangan', compact('wishes'));

        Lalu @foreach($wishes as $w) ... @endforeach di wishes wall.
    ============================================================
    --}}
</body>
</html>
