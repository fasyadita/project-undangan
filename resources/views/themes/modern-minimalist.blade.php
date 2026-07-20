<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan: {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    <meta property="og:title" content="Undangan Pernikahan: {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}" />
    <meta property="og:description" content="Kami mengundang Anda untuk menghadiri hari bahagia kami pada {{ $invitation->event_date->translatedFormat('d F Y') }} di {{ $invitation->event_location }}." />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:     #1a1208;
            --cream:   #faf6f0;
            --warm:    #f0e8d8;
            --gold:    #b8935a;
            --gold-lt: #d4b483;
            --blush:   #e8d5c0;
            --sage:    #8a9e88;
            --accent:  #c4784a;
            --ff-head: 'Cormorant Garamond', Georgia, serif;
            --ff-body: 'DM Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--cream);
            color: var(--ink);
            font-family: var(--ff-body);
            font-weight: 300;
            line-height: 1.7;
            overflow-x: hidden;
        }

        /* ─── COVER OVERLAY ─────────────────────────────────────── */
        #cover {
            position: fixed; inset: 0; z-index: 100;
            background: var(--ink);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center; padding: 2rem;
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        #cover.hidden { opacity: 0; transform: scale(1.04); pointer-events: none; }

        .cover-frame {
            position: absolute; inset: 1.5rem;
            border: 1px solid rgba(180,147,90,0.3);
            pointer-events: none;
        }
        .cover-frame::before {
            content: '';
            position: absolute; inset: 8px;
            border: 1px solid rgba(180,147,90,0.15);
        }

        /* Corner ornaments */
        .corner { position: absolute; width: 40px; height: 40px; }
        .corner svg { width: 100%; height: 100%; }
        .corner-tl { top: 1.5rem; left: 1.5rem; }
        .corner-tr { top: 1.5rem; right: 1.5rem; transform: scaleX(-1); }
        .corner-bl { bottom: 1.5rem; left: 1.5rem; transform: scaleY(-1); }
        .corner-br { bottom: 1.5rem; right: 1.5rem; transform: scale(-1); }

        .cover-eyebrow {
            font-family: var(--ff-body);
            font-size: 0.6rem;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 2.5rem;
        }
        .cover-names {
            font-family: var(--ff-head);
            font-size: clamp(3.5rem, 12vw, 6rem);
            font-weight: 300;
            font-style: italic;
            color: var(--cream);
            line-height: 1.05;
            margin-bottom: 0.5rem;
        }
        .cover-amp {
            font-size: clamp(2rem, 6vw, 3rem);
            color: var(--gold);
            display: block;
            font-style: normal;
            margin: 0.3rem 0;
        }
        .cover-date {
            font-family: var(--ff-body);
            font-size: 0.72rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(250,246,240,0.5);
            margin-bottom: 3rem;
        }

        .cover-guest-label {
            font-size: 0.68rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(250,246,240,0.4);
            margin-bottom: 0.75rem;
        }
        .cover-guest-box {
            width: min(300px, 90vw);
            text-align: center;
            padding: 0.85rem 1.5rem;
            background: rgba(180,147,90,0.12);
            border: 1px solid rgba(180,147,90,0.3);
            font-family: var(--ff-head);
            font-size: 1.15rem;
            color: var(--cream);
            letter-spacing: 0.02em;
            margin-bottom: 2.5rem;
            outline: none;
        }
        .cover-guest-box::placeholder { color: rgba(250,246,240,0.25); font-style: italic; }
        .cover-guest-box:focus { border-color: rgba(180,147,90,0.7); }

        .cover-btn {
            display: inline-flex; align-items: center; gap: 0.6rem;
            padding: 0.9rem 2.8rem;
            background: var(--gold);
            color: var(--ink);
            font-family: var(--ff-body);
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            border: none; cursor: pointer;
            transition: background 0.25s, transform 0.15s;
        }
        .cover-btn:hover { background: var(--gold-lt); transform: translateY(-1px); }
        .cover-btn:active { transform: translateY(0); }

        /* ─── FLOATING MUSIC ──────────────────────────────────────── */
        #music-btn {
            position: fixed; bottom: 2rem; right: 2rem; z-index: 50;
            width: 3rem; height: 3rem;
            border-radius: 50%;
            background: var(--ink);
            border: 1px solid rgba(180,147,90,0.4);
            color: var(--gold);
            font-size: 1rem;
            cursor: pointer;
            display: none;
            align-items: center; justify-content: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.25);
            transition: transform 0.2s;
        }
        #music-btn.visible { display: flex; }
        #music-btn:hover { transform: scale(1.1); }
        #music-btn .note { transition: opacity 0.2s; }

        /* ─── MAIN CONTENT ────────────────────────────────────────── */
        main { opacity: 0; transition: opacity 0.9s ease; }
        main.visible { opacity: 1; }

        /* ─── HERO ────────────────────────────────────────────────── */
        .hero {
            min-height: 100svh;
            display: grid;
            place-items: center;
            text-align: center;
            padding: 5rem 2rem;
            position: relative;
            overflow: hidden;
            background: var(--ink);
        }

        .hero-bg {
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 50% 100%, rgba(180,147,90,0.12) 0%, transparent 70%),
                radial-gradient(ellipse 60% 40% at 20% 20%, rgba(138,158,136,0.08) 0%, transparent 60%);
        }

        /* Animated grain */
        .hero-grain {
            position: absolute; inset: -50%;
            width: 200%; height: 200%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            opacity: 0.6;
            animation: grain 8s steps(10) infinite;
        }
        @keyframes grain {
            0%,100%  { transform: translate(0,0); }
            10%      { transform: translate(-2%,-3%); }
            20%      { transform: translate(3%,2%); }
            30%      { transform: translate(-1%,4%); }
            40%      { transform: translate(2%,-1%); }
            50%      { transform: translate(-3%,3%); }
            60%      { transform: translate(1%,-2%); }
            70%      { transform: translate(-2%,1%); }
            80%      { transform: translate(3%,-4%); }
            90%      { transform: translate(-1%,2%); }
        }

        .hero-inner { position: relative; z-index: 2; }

        .hero-eyebrow {
            font-size: 0.62rem;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeUp 1s 0.3s forwards;
        }
        .hero-names {
            font-family: var(--ff-head);
            font-size: clamp(4rem, 14vw, 9rem);
            font-weight: 300;
            font-style: italic;
            color: var(--cream);
            line-height: 0.95;
            opacity: 0;
            animation: fadeUp 1s 0.5s forwards;
        }
        .hero-names .amp {
            font-style: normal;
            font-size: 0.45em;
            color: var(--gold);
            display: block;
            margin: 0.5rem 0;
        }
        .hero-divider {
            display: flex; align-items: center; gap: 1rem;
            justify-content: center;
            margin: 2.5rem auto;
            opacity: 0;
            animation: fadeUp 1s 0.7s forwards;
        }
        .hero-divider-line { width: 60px; height: 1px; background: rgba(180,147,90,0.4); }
        .hero-divider-icon { color: var(--gold); font-size: 0.9rem; }

        .hero-date-block {
            display: inline-block;
            border: 1px solid rgba(180,147,90,0.25);
            padding: 0.9rem 2.5rem;
            opacity: 0;
            animation: fadeUp 1s 0.9s forwards;
        }
        .hero-date-block .day {
            font-family: var(--ff-head);
            font-size: 0.8rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold-lt);
        }
        .hero-date-block .date-num {
            font-family: var(--ff-head);
            font-size: 3rem;
            font-weight: 300;
            color: var(--cream);
            line-height: 1;
        }
        .hero-date-block .month-year {
            font-size: 0.7rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(250,246,240,0.45);
        }

        /* Countdown */
        .hero-countdown {
            display: flex; gap: 1.5rem; justify-content: center;
            margin-top: 3rem;
            opacity: 0;
            animation: fadeUp 1s 1.1s forwards;
        }
        .cd-unit { text-align: center; }
        .cd-num {
            font-family: var(--ff-head);
            font-size: 2.2rem;
            font-weight: 300;
            color: var(--cream);
            display: block;
            line-height: 1;
        }
        .cd-label {
            font-size: 0.55rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(250,246,240,0.35);
            margin-top: 0.3rem;
        }
        .cd-sep { font-family: var(--ff-head); color: var(--gold); font-size: 1.5rem; align-self: center; padding-bottom: 0.6rem; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── SCROLL REVEAL ──────────────────────────────────────── */
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-d1 { transition-delay: 0.1s; }
        .reveal-d2 { transition-delay: 0.2s; }
        .reveal-d3 { transition-delay: 0.3s; }

        /* ─── SECTION BASE ───────────────────────────────────────── */
        section { padding: 7rem 2rem; }
        .section-eyebrow {
            font-size: 0.6rem;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.75rem;
        }
        .section-title {
            font-family: var(--ff-head);
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 300;
            font-style: italic;
            color: var(--ink);
            line-height: 1.2;
        }
        .section-line {
            width: 3rem; height: 1px;
            background: var(--gold);
            margin: 1.5rem auto;
        }

        /* ─── COUPLE SECTION ─────────────────────────────────────── */
        .couple-section {
            background: var(--cream);
            text-align: center;
        }
        .couple-intro {
            font-family: var(--ff-head);
            font-size: clamp(1rem, 3vw, 1.2rem);
            font-style: italic;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .couple-subtext {
            max-width: 520px;
            margin: 0 auto 4rem;
            font-size: 0.82rem;
            color: rgba(26,18,8,0.55);
            line-height: 1.9;
        }
        .couple-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: start;
            gap: 2rem;
            max-width: 760px;
            margin: 0 auto;
        }
        .couple-card { text-align: center; }
        .couple-photo {
            width: clamp(140px, 28vw, 200px);
            aspect-ratio: 1;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 1.5rem;
            border: 3px solid var(--blush);
            filter: grayscale(20%);
            transition: filter 0.4s;
        }
        .couple-photo:hover { filter: grayscale(0); }
        .couple-name {
            font-family: var(--ff-head);
            font-size: 1.6rem;
            font-style: italic;
            color: var(--ink);
            margin-bottom: 0.3rem;
        }
        .couple-parents { font-size: 0.72rem; color: rgba(26,18,8,0.5); line-height: 1.7; }
        .couple-parents strong { font-weight: 500; color: rgba(26,18,8,0.7); }
        .couple-amp {
            font-family: var(--ff-head);
            font-size: 4rem;
            color: var(--gold);
            font-style: italic;
            line-height: 1;
            padding-top: 3rem;
        }

        /* ─── EVENT SECTION ──────────────────────────────────────── */
        .event-section {
            background: var(--ink);
            color: var(--cream);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .event-section .section-title { color: var(--cream); }
        .event-section .section-eyebrow { color: var(--gold); }

        .event-bg {
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 70% 50% at 50% 100%, rgba(180,147,90,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .event-grid {
            display: grid;
            grid-template-columns: 1fr 1px 1fr;
            gap: 0 3rem;
            max-width: 700px;
            margin: 4rem auto 0;
            position: relative;
        }
        .event-divider {
            background: rgba(180,147,90,0.2);
            margin: 0;
        }
        .event-card { padding: 0 1rem; }
        .event-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            display: block;
        }
        .event-type {
            font-family: var(--ff-head);
            font-size: 1.4rem;
            font-style: italic;
            color: var(--gold-lt);
            margin-bottom: 1.5rem;
        }
        .event-detail-label {
            font-size: 0.6rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(250,246,240,0.3);
            margin-bottom: 0.3rem;
        }
        .event-detail-val {
            font-family: var(--ff-head);
            font-size: 1rem;
            color: var(--cream);
            margin-bottom: 1.25rem;
            line-height: 1.4;
        }
        .event-map-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            margin-top: 3rem;
            padding: 0.85rem 2.5rem;
            border: 1px solid rgba(180,147,90,0.35);
            color: var(--gold-lt);
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .event-map-btn:hover { background: rgba(180,147,90,0.1); color: var(--cream); }

        /* ─── LOVE STORY ──────────────────────────────────────────── */
        .story-section { background: var(--warm); }
        .story-section .section-title,
        .story-section .section-eyebrow { display: block; text-align: center; }
        .story-section .section-line { margin: 1.5rem auto; }

        .timeline {
            max-width: 640px;
            margin: 4rem auto 0;
            position: relative;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%; top: 0; bottom: 0;
            width: 1px;
            background: rgba(26,18,8,0.1);
            transform: translateX(-50%);
        }
        .tl-item {
            display: grid;
            grid-template-columns: 1fr 2rem 1fr;
            gap: 0 1.5rem;
            margin-bottom: 3.5rem;
            align-items: start;
        }
        .tl-item:nth-child(odd) .tl-content { grid-column: 1; text-align: right; }
        .tl-item:nth-child(odd) .tl-empty   { grid-column: 3; }
        .tl-item:nth-child(even) .tl-content { grid-column: 3; text-align: left; }
        .tl-item:nth-child(even) .tl-empty   { grid-column: 1; }
        .tl-dot {
            grid-column: 2;
            display: flex; align-items: flex-start; justify-content: center;
            padding-top: 0.2rem;
        }
        .tl-dot-inner {
            width: 10px; height: 10px;
            border-radius: 50%;
            background: var(--gold);
            border: 2px solid var(--warm);
            box-shadow: 0 0 0 2px rgba(180,147,90,0.3);
            flex-shrink: 0;
        }
        .tl-date {
            display: inline-block;
            font-size: 0.62rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            background: rgba(180,147,90,0.1);
            padding: 0.2rem 0.7rem;
            margin-bottom: 0.5rem;
        }
        .tl-title { font-family: var(--ff-head); font-size: 1.1rem; font-style: italic; color: var(--ink); margin-bottom: 0.3rem; }
        .tl-desc { font-size: 0.78rem; color: rgba(26,18,8,0.55); line-height: 1.8; }

        /* ─── GALLERY ──────────────────────────────────────────────── */
        .gallery-section {
            background: var(--cream);
            padding-bottom: 0;
        }
        .gallery-section .section-eyebrow,
        .gallery-section .section-title { text-align: center; display: block; }
        .gallery-section .section-line { margin: 1.5rem auto 3rem; }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: auto;
            gap: 0.5rem;
            max-width: 1100px;
            margin: 0 auto;
        }
        .gallery-item {
            overflow: hidden;
            position: relative;
            background: var(--blush);
        }
        .gallery-item:first-child { grid-column: 1 / 3; grid-row: 1 / 3; }
        .gallery-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.7s ease, filter 0.4s;
            filter: brightness(0.95) saturate(0.9);
            min-height: 220px;
        }
        .gallery-item:first-child img { min-height: 400px; }
        .gallery-item:hover img { transform: scale(1.04); filter: brightness(1) saturate(1.05); }

        /* ─── GIFT ──────────────────────────────────────────────────── */
        .gift-section {
            background: var(--warm);
            text-align: center;
        }
        .gift-section .section-eyebrow,
        .gift-section .section-title { display: block; }
        .gift-section .section-line { margin: 1.5rem auto; }
        .gift-subtext { font-size: 0.82rem; color: rgba(26,18,8,0.5); max-width: 440px; margin: 0 auto 3rem; line-height: 1.9; }

        .gift-cards {
            display: flex; flex-wrap: wrap; gap: 1.5rem;
            justify-content: center;
            max-width: 700px; margin: 0 auto;
        }
        .gift-card {
            background: var(--cream);
            border: 1px solid rgba(180,147,90,0.2);
            padding: 2rem 2.5rem;
            min-width: 260px;
            text-align: left;
            position: relative;
        }
        .gift-bank {
            font-size: 0.6rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1rem;
        }
        .gift-num {
            font-family: var(--ff-head);
            font-size: 1.7rem;
            color: var(--ink);
            margin-bottom: 0.3rem;
            letter-spacing: 0.02em;
        }
        .gift-owner { font-size: 0.78rem; color: rgba(26,18,8,0.5); margin-bottom: 1.5rem; }
        .gift-copy-btn {
            width: 100%;
            padding: 0.65rem 1.2rem;
            border: 1px solid rgba(26,18,8,0.12);
            background: transparent;
            font-family: var(--ff-body);
            font-size: 0.68rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--ink);
            cursor: pointer;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .gift-copy-btn:hover { background: var(--ink); color: var(--cream); border-color: var(--ink); }
        .gift-copy-btn.copied { background: var(--sage); color: #fff; border-color: var(--sage); }

        /* ─── RSVP + WISHES ─────────────────────────────────────────── */
        .rsvp-section {
            background: var(--ink);
            color: var(--cream);
        }
        .rsvp-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            max-width: 960px;
            margin: 0 auto;
            align-items: start;
        }

        .rsvp-eyebrow { font-size: 0.6rem; letter-spacing: 0.4em; text-transform: uppercase; color: var(--gold); margin-bottom: 0.75rem; }
        .rsvp-title {
            font-family: var(--ff-head);
            font-size: 2.2rem;
            font-style: italic;
            font-weight: 300;
            color: var(--cream);
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }
        .rsvp-sub { font-size: 0.75rem; color: rgba(250,246,240,0.35); margin-bottom: 2.5rem; line-height: 1.8; }

        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-size: 0.62rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(250,246,240,0.4);
            margin-bottom: 0.5rem;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            background: rgba(250,246,240,0.05);
            border: 1px solid rgba(250,246,240,0.12);
            padding: 0.8rem 1rem;
            color: var(--cream);
            font-family: var(--ff-body);
            font-size: 0.85rem;
            outline: none;
            transition: border-color 0.2s;
            appearance: none;
        }
        .form-input::placeholder { color: rgba(250,246,240,0.2); }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: rgba(180,147,90,0.5);
        }
        .form-select option { background: #1a1208; }
        .form-textarea { resize: none; min-height: 100px; }

        .form-submit {
            width: 100%;
            padding: 1rem;
            background: var(--gold);
            border: none;
            color: var(--ink);
            font-family: var(--ff-body);
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 0.5rem;
        }
        .form-submit:hover { background: var(--gold-lt); }

        /* Wishes board */
        .wishes-title {
            font-family: var(--ff-head);
            font-size: 2.2rem;
            font-style: italic;
            font-weight: 300;
            color: var(--cream);
            margin-bottom: 2rem;
        }
        .wishes-list {
            max-height: 520px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding-right: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: rgba(180,147,90,0.2) transparent;
        }
        .wish-card {
            background: rgba(250,246,240,0.04);
            border: 1px solid rgba(250,246,240,0.07);
            padding: 1.25rem 1.5rem;
        }
        .wish-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.6rem; }
        .wish-name { font-family: var(--ff-head); font-size: 1rem; color: var(--cream); }
        .wish-badge {
            font-size: 0.55rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.2rem 0.6rem;
            border: 1px solid;
        }
        .wish-badge.hadir { color: var(--sage); border-color: var(--sage); }
        .wish-badge.tidak { color: #c47a7a; border-color: #c47a7a; }
        .wish-text { font-size: 0.78rem; color: rgba(250,246,240,0.45); font-style: italic; line-height: 1.8; }
        .wish-time { font-size: 0.62rem; color: rgba(250,246,240,0.2); margin-top: 0.75rem; text-align: right; }

        .wishes-empty {
            text-align: center;
            padding: 3rem;
            border: 1px dashed rgba(250,246,240,0.1);
            font-size: 0.8rem;
            color: rgba(250,246,240,0.2);
            font-style: italic;
            font-family: var(--ff-head);
        }

        /* Alert */
        .success-alert {
            padding: 1rem 1.25rem;
            background: rgba(138,158,136,0.15);
            border: 1px solid rgba(138,158,136,0.3);
            font-size: 0.78rem;
            color: #b5d4b3;
            margin-bottom: 1.5rem;
            display: none;
        }
        .success-alert.show { display: block; }

        /* ─── FOOTER ──────────────────────────────────────────────── */
        footer {
            background: #110d06;
            color: rgba(250,246,240,0.35);
            text-align: center;
            padding: 3.5rem 2rem;
            border-top: 1px solid rgba(180,147,90,0.1);
        }
        .footer-names {
            font-family: var(--ff-head);
            font-size: 1.8rem;
            font-style: italic;
            color: var(--gold-lt);
            margin-bottom: 0.5rem;
        }
        .footer-tagline { font-size: 0.7rem; letter-spacing: 0.15em; margin-bottom: 2rem; }
        .footer-credit { font-size: 0.62rem; letter-spacing: 0.1em; }
        .footer-credit a { color: rgba(250,246,240,0.25); text-decoration: none; }
        .footer-credit a:hover { color: var(--gold); }

        /* ─── RESPONSIVE ────────────────────────────────────────────── */
        @media (max-width: 700px) {
            .couple-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .couple-amp { padding: 0; }

            .event-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            .event-divider { display: none; }

            .timeline::before { left: 0.6rem; }
            .tl-item { grid-template-columns: 1.2rem 1fr; gap: 0 1rem; }
            .tl-item:nth-child(odd) .tl-content,
            .tl-item:nth-child(even) .tl-content { grid-column: 2; text-align: left; }
            .tl-item:nth-child(odd) .tl-empty,
            .tl-item:nth-child(even) .tl-empty { display: none; }
            .tl-dot { grid-column: 1; }

            .gallery-grid { grid-template-columns: 1fr 1fr; }
            .gallery-item:first-child { grid-column: 1 / 3; grid-row: auto; }

            .rsvp-grid { grid-template-columns: 1fr; gap: 3rem; }

            .hero-countdown { gap: 0.8rem; }
            .cd-num { font-size: 1.6rem; }

            section { padding: 5rem 1.5rem; }
        }
    </style>
</head>

<body>

<!-- BACKGROUND MUSIC -->
<audio id="bg-music" src="" loop preload="none"></audio>

<!-- FLOATING MUSIC BUTTON -->
<button id="music-btn" title="Toggle Music" aria-label="Toggle music">
    <span id="music-icon">🎵</span>
</button>

<!-- ═══════════════════════════════════════════ -->
<!-- COVER OVERLAY                               -->
<!-- ═══════════════════════════════════════════ -->
<div id="cover">
    <div class="cover-frame"></div>

    <!-- Corner ornaments -->
    <div class="corner corner-tl">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 38 L2 2 L38 2" stroke="#b8935a" stroke-width="1" opacity="0.5"/>
            <path d="M2 20 Q10 2 20 2" stroke="#b8935a" stroke-width="0.7" opacity="0.3"/>
        </svg>
    </div>
    <div class="corner corner-tr">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 38 L2 2 L38 2" stroke="#b8935a" stroke-width="1" opacity="0.5"/>
            <path d="M2 20 Q10 2 20 2" stroke="#b8935a" stroke-width="0.7" opacity="0.3"/>
        </svg>
    </div>
    <div class="corner corner-bl">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 38 L2 2 L38 2" stroke="#b8935a" stroke-width="1" opacity="0.5"/>
            <path d="M2 20 Q10 2 20 2" stroke="#b8935a" stroke-width="0.7" opacity="0.3"/>
        </svg>
    </div>
    <div class="corner corner-br">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 38 L2 2 L38 2" stroke="#b8935a" stroke-width="1" opacity="0.5"/>
            <path d="M2 20 Q10 2 20 2" stroke="#b8935a" stroke-width="0.7" opacity="0.3"/>
        </svg>
    </div>

    <p class="cover-eyebrow">The Wedding Celebration</p>

    <h1 class="cover-names">
        {{ $invitation->groom_nickname }}
        <span class="cover-amp">&</span>
        {{ $invitation->bride_nickname }}
    </h1>

    <p class="cover-date">{{ $invitation->event_date->translatedFormat('d · F · Y') }}</p>

    <p class="cover-guest-label">Kepada Yth.</p>
    <div id="cover-guest-display" style="display:none; width:min(300px,90vw); margin-bottom:2.5rem;">
        <div style="padding:0.85rem 1.5rem; background:rgba(180,147,90,0.12); border:1px solid rgba(180,147,90,0.3); font-family:var(--ff-head); font-size:1.2rem; color:var(--cream); letter-spacing:0.02em;" id="cover-guest-name-display"></div>
    </div>
    <input type="text" class="cover-guest-box" id="cover-guest-input" placeholder="Ketik nama Anda…">

    <button class="cover-btn" id="cover-open-btn">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        Buka Undangan
    </button>
</div>

<!-- ═══════════════════════════════════════════ -->
<!-- MAIN CONTENT                                -->
<!-- ═══════════════════════════════════════════ -->
<main id="main-content">

    <!-- ─── HERO ─────────────────────────────── -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-grain"></div>
        <div class="hero-inner">
            <p class="hero-eyebrow">We Are Getting Married</p>
            <h2 class="hero-names">
                {{ $invitation->groom_nickname }}
                <span class="amp">&</span>
                {{ $invitation->bride_nickname }}
            </h2>

            <div class="hero-divider">
                <div class="hero-divider-line"></div>
                <span class="hero-divider-icon">✦</span>
                <div class="hero-divider-line"></div>
            </div>

            <div class="hero-date-block">
                <p class="day">{{ $invitation->event_date->translatedFormat('l') }}</p>
                <p class="date-num">{{ $invitation->event_date->format('d') }}</p>
                <p class="month-year">{{ $invitation->event_date->translatedFormat('F Y') }}</p>
            </div>

            <div class="hero-countdown" id="hero-countdown">
                <div class="cd-unit">
                    <span class="cd-num" id="cd-days">00</span>
                    <span class="cd-label">Hari</span>
                </div>
                <span class="cd-sep">·</span>
                <div class="cd-unit">
                    <span class="cd-num" id="cd-hours">00</span>
                    <span class="cd-label">Jam</span>
                </div>
                <span class="cd-sep">·</span>
                <div class="cd-unit">
                    <span class="cd-num" id="cd-mins">00</span>
                    <span class="cd-label">Menit</span>
                </div>
                <span class="cd-sep">·</span>
                <div class="cd-unit">
                    <span class="cd-num" id="cd-secs">00</span>
                    <span class="cd-label">Detik</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── COUPLE ────────────────────────────── -->
    <section class="couple-section">
        <div class="reveal">
            <p class="section-eyebrow">Bismillahirrahmanirrahim</p>
            <p class="couple-intro">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
            <p class="couple-subtext">
                Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan.
                Dengan memohon rahmat dan ridho-Nya, kami mengundang Anda menghadiri momen sakral kami.
            </p>
        </div>

        <div class="couple-grid">
            <div class="couple-card reveal reveal-d1">
                <img src="{{ $invitation->groom_photo }}" 
                     alt="{{ $invitation->groom_nickname }}" class="couple-photo">
                <p class="couple-name">{{ $invitation->groom_name }}</p>
                <p class="couple-parents">
                    Putra tercinta dari<br>
                    <strong>Bapak {{ $invitation->groom_father }} & Ibu {{ $invitation->groom_mother }}</strong>
                </p>
            </div>

            <div class="couple-amp reveal">
                <em>&</em>
            </div>

            <div class="couple-card reveal reveal-d1">
                <img src="{{ $invitation->bride_photo }}" 
                     alt="{{ $invitation->bride_nickname }}" class="couple-photo">
                <p class="couple-name">{{ $invitation->bride_name }}</p>
                <p class="couple-parents">
                    Putri tercinta dari<br>
                    <strong>Bapak {{ $invitation->bride_father }} & Ibu {{ $invitation->bride_mother }}</strong>
                </p>
            </div>
        </div>
    </section>

    <!-- ─── EVENT ─────────────────────────────── -->
    <section class="event-section">
        <div class="event-bg"></div>
        <div class="reveal">
            <p class="section-eyebrow">Tanggal &amp; Tempat</p>
            <h2 class="section-title">Acara Pernikahan</h2>
            <div class="section-line"></div>
        </div>

        <div class="event-grid reveal reveal-d1">
            <div class="event-card">
                <span class="event-icon">🕌</span>
                <p class="event-type">Akad Nikah</p>
                <p class="event-detail-label">Hari, Tanggal</p>
                <p class="event-detail-val">{{ $invitation->event_date->translatedFormat('l, d F Y') }}</p>
                <p class="event-detail-label">Waktu</p>
                <p class="event-detail-val">{{ $invitation->event_time }}</p>
            </div>

            <div class="event-divider"></div>

            <div class="event-card">
                <span class="event-icon">🌿</span>
                <p class="event-type">Resepsi Pernikahan</p>
                <p class="event-detail-label">Tempat</p>
                <p class="event-detail-val">{{ $invitation->event_location }}</p>
                <p class="event-detail-label">Alamat</p>
                <p class="event-detail-val" style="font-size:0.85rem; color:rgba(250,246,240,0.6);">
                    {{ $invitation->event_address }}
                </p>
            </div>
        </div>

        <div class="reveal" style="text-align:center; position:relative; z-index:2;">
            <a href="{{ $invitation->event_map_url }}" class="event-map-btn" target="_blank">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7 1C4.79 1 3 2.79 3 5c0 3.5 4 8 4 8s4-4.5 4-8c0-2.21-1.79-4-4-4z" stroke="currentColor" stroke-width="1.2"/>
                    <circle cx="7" cy="5" r="1.5" stroke="currentColor" stroke-width="1.2"/>
                </svg>
                Buka Google Maps
            </a>
        </div>
    </section>

    <!-- ─── LOVE STORY ────────────────────────── -->
    <section class="story-section">
        <div class="reveal">
            <p class="section-eyebrow">Our Journey</p>
            <h2 class="section-title">Kisah Perjalanan Kita</h2>
            <div class="section-line"></div>
        </div>

        <div class="timeline">
            <div class="tl-item reveal">
                <div class="tl-content">
                    <span class="tl-date">Maret 2020</span>
                    <h4 class="tl-title">Pertemuan Pertama</h4>
                    <p class="tl-desc">Berawal dari sebuah seminar di kampus, pandangan kami bertemu dan sesuatu yang tak terduga pun mulai tumbuh.</p>
                </div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-empty"></div>
            </div>

            <div class="tl-item reveal">
                <div class="tl-empty"></div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-content">
                    <span class="tl-date">Desember 2020</span>
                    <h4 class="tl-title">Jadian</h4>
                    <p class="tl-desc">Di bawah hujan gerimis malam Natal, Arya mengungkapkan perasaannya dengan sederhana namun tulus.</p>
                </div>
            </div>

            <div class="tl-item reveal">
                <div class="tl-content">
                    <span class="tl-date">Juni 2023</span>
                    <h4 class="tl-title">Lamaran</h4>
                    <p class="tl-desc">Dengan cincin sederhana dan doa yang tulus, Arya melamar Riri di hadapan keluarga tercinta.</p>
                </div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-empty"></div>
            </div>

            <div class="tl-item reveal">
                <div class="tl-empty"></div>
                <div class="tl-dot"><div class="tl-dot-inner"></div></div>
                <div class="tl-content">
                    <span class="tl-date">Juni 2025</span>
                    <h4 class="tl-title">Hari Bahagia</h4>
                    <p class="tl-desc">Dan kini saatnya kami melangkah menuju babak baru kehidupan bersama, dengan cinta dan ridho Allah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── GALLERY ───────────────────────────── -->
    <section class="gallery-section">
        <div class="reveal" style="text-align:center; padding-bottom:1rem;">
            <p class="section-eyebrow">Moments Together</p>
            <h2 class="section-title">Galeri Kebersamaan</h2>
            <div class="section-line"></div>
        </div>

        <div class="gallery-grid reveal">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=800&fit=crop&q=80" alt="Gallery 1">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=500&h=400&fit=crop&q=80" alt="Gallery 2">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=500&h=400&fit=crop&q=80" alt="Gallery 3">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1616669944447-d5f7c2e59ed2?w=500&h=400&fit=crop&q=80" alt="Gallery 4">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1591604021695-0c69b7c05981?w=500&h=400&fit=crop&q=80" alt="Gallery 5">
            </div>
        </div>
    </section>

    <!-- ─── GIFT ──────────────────────────────── -->
    <section class="gift-section">
        <div class="reveal">
            <p class="section-eyebrow">Wedding Gift</p>
            <h2 class="section-title">Amplop Digital</h2>
            <div class="section-line"></div>
            <p class="gift-subtext">
                Kehadiran dan doa restu Anda adalah hadiah terindah bagi kami. Namun bila ingin mengirimkan tanda kasih, dapat melalui:
            </p>
        </div>

        <div class="gift-cards reveal">
            <div class="gift-card">
                <p class="gift-bank">Bank BCA</p>
                <p class="gift-num">1234567890</p>
                <p class="gift-owner">a.n. Ahmad Arya Pratama</p>
                <button class="gift-copy-btn" data-num="1234567890">Salin Nomor Rekening</button>
            </div>
            <div class="gift-card">
                <p class="gift-bank">GoPay / OVO</p>
                <p class="gift-num">0812-3456-7890</p>
                <p class="gift-owner">a.n. Rizky Maharani</p>
                <button class="gift-copy-btn" data-num="081234567890">Salin Nomor</button>
            </div>
        </div>
    </section>

    <!-- ─── RSVP + WISHES ─────────────────────── -->
    <section class="rsvp-section">
        <div class="rsvp-grid">

            <!-- RSVP Form -->
            <div class="reveal">
                <p class="rsvp-eyebrow">Konfirmasi</p>
                <h3 class="rsvp-title">Kehadiran Anda</h3>
                <p class="rsvp-sub">Harap isi form di bawah agar kami dapat mempersiapkan sambutan terbaik.</p>

                <div class="success-alert" id="rsvp-success">
                    ✓ Terima kasih! Kehadiran Anda telah kami catat.
                </div>

                <form id="rsvp-form">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-input" id="rsvp-name" placeholder="Budi Santoso" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Kehadiran *</label>
                        <select class="form-select" id="rsvp-attend">
                            <option value="1">Ya, Saya Akan Hadir</option>
                            <option value="0">Maaf, Tidak Bisa Hadir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Tamu</label>
                        <select class="form-select" id="rsvp-count">
                            <option value="1">1 Orang</option>
                            <option value="2">2 Orang</option>
                            <option value="3">3 Orang</option>
                            <option value="4">4 Orang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ucapan & Doa Restu</label>
                        <textarea class="form-textarea" id="rsvp-wish" placeholder="Selamat menempuh hidup baru…"></textarea>
                    </div>
                    <button type="submit" class="form-submit">Kirim Konfirmasi</button>
                </form>
            </div>

            <!-- Wishes Board -->
            <div class="reveal reveal-d2">
                <h3 class="wishes-title">Ucapan & Doa Restu</h3>
                <div class="wishes-list" id="wishes-list">
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">Siti Nurhaliza</span>
                            <span class="wish-badge hadir">Hadir</span>
                        </div>
                        <p class="wish-text">Selamat menempuh hidup baru, semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Aamiin!</p>
                        <p class="wish-time">2 jam yang lalu</p>
                    </div>
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">Budi Santoso</span>
                            <span class="wish-badge tidak">Tidak Hadir</span>
                        </div>
                        <p class="wish-text">Maaf tidak bisa hadir, tapi doa tulus selalu menyertai kalian berdua. Bahagia selalu ya!</p>
                        <p class="wish-time">5 jam yang lalu</p>
                    </div>
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">Rina Wijaya</span>
                            <span class="wish-badge hadir">Hadir</span>
                        </div>
                        <p class="wish-text">Wow akhirnya ya! Sudah lama nunggu momen ini. Congrats banget Arya & Riri, kalian pasangan yang sangat serasi!</p>
                        <p class="wish-time">Kemarin</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── FOOTER ────────────────────────────── -->
    <footer>
        <p class="footer-names">Arya & Riri</p>
        <p class="footer-tagline">14 Juni 2025 · Jakarta</p>
        <div style="width:2rem; height:1px; background:rgba(180,147,90,0.2); margin:1.5rem auto;"></div>
        <p class="footer-credit">
            Terima kasih atas doa restu dan kehangatan Anda.<br>
            <span style="opacity:0.4; font-size:0.6rem; letter-spacing:0.1em; display:block; margin-top:1rem;">
                Powered by <a href="/">WeddingKita.com</a>
            </span>
        </p>
    </footer>

</main>

<script>
    // ─── GUEST NAME FROM URL ──────────────────────────────────
    const urlParams = new URLSearchParams(window.location.search);
    const guestFromUrl = urlParams.get('to') || '';
    const guestInput = document.getElementById('cover-guest-input');
    const guestDisplay = document.getElementById('cover-guest-display');
    const guestNameDisplay = document.getElementById('cover-guest-name-display');

    if (guestFromUrl) {
        guestInput.style.display = 'none';
        guestNameDisplay.textContent = decodeURIComponent(guestFromUrl);
        guestDisplay.style.display = 'block';
    } else {
        guestInput.style.display = 'block';
        guestDisplay.style.display = 'none';
    }

    // ─── COVER OPEN ──────────────────────────────────────────
    const cover = document.getElementById('cover');
    const mainContent = document.getElementById('main-content');
    const musicBtn = document.getElementById('music-btn');
    const bgMusic = document.getElementById('bg-music');
    let isPlaying = false;

    document.getElementById('cover-open-btn').addEventListener('click', () => {
        cover.classList.add('hidden');
        setTimeout(() => { cover.style.display = 'none'; }, 800);

        mainContent.classList.add('visible');
        musicBtn.classList.add('visible');

        bgMusic.play().then(() => {
            isPlaying = true;
            document.getElementById('music-icon').textContent = '🎵';
        }).catch(() => {});

        // Pre-fill RSVP name
        const name = guestFromUrl || guestInput.value.trim();
        if (name) document.getElementById('rsvp-name').value = decodeURIComponent(name);
    });

    // ─── MUSIC TOGGLE ─────────────────────────────────────────
    musicBtn.addEventListener('click', () => {
        if (isPlaying) {
            bgMusic.pause();
            isPlaying = false;
            document.getElementById('music-icon').textContent = '🔇';
        } else {
            bgMusic.play();
            isPlaying = true;
            document.getElementById('music-icon').textContent = '🎵';
        }
    });

    // ─── COUNTDOWN ────────────────────────────────────────────
    const targetDate = new Date('2025-06-14T08:00:00').getTime();
    function updateCountdown() {
        const now = Date.now();
        const dist = targetDate - now;
        if (dist < 0) return;
        const pad = n => String(Math.floor(n)).padStart(2, '0');
        document.getElementById('cd-days').textContent  = pad(dist / 86400000);
        document.getElementById('cd-hours').textContent = pad((dist % 86400000) / 3600000);
        document.getElementById('cd-mins').textContent  = pad((dist % 3600000) / 60000);
        document.getElementById('cd-secs').textContent  = pad((dist % 60000) / 1000);
    }
    updateCountdown();
    setInterval(updateCountdown, 1000);

    // ─── SCROLL REVEAL ────────────────────────────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('revealed'); observer.unobserve(e.target); }});
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // ─── COPY TO CLIPBOARD ────────────────────────────────────
    document.querySelectorAll('.gift-copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            navigator.clipboard.writeText(btn.dataset.num).then(() => {
                const orig = btn.textContent;
                btn.textContent = '✓ Berhasil Disalin';
                btn.classList.add('copied');
                setTimeout(() => { btn.textContent = orig; btn.classList.remove('copied'); }, 2000);
            });
        });
    });

    // ─── RSVP FORM (demo: add to wishes board) ────────────────
    document.getElementById('rsvp-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const name  = document.getElementById('rsvp-name').value.trim();
        const hadir = document.getElementById('rsvp-attend').value === '1';
        const wish  = document.getElementById('rsvp-wish').value.trim();

        if (!name) return;

        // Show success
        const alert = document.getElementById('rsvp-success');
        alert.classList.add('show');
        setTimeout(() => alert.classList.remove('show'), 4000);

        // Prepend to wishes board
        const wishCard = document.createElement('div');
        wishCard.className = 'wish-card';
        wishCard.innerHTML = `
            <div class="wish-header">
                <span class="wish-name">${name}</span>
                <span class="wish-badge ${hadir ? 'hadir' : 'tidak'}">${hadir ? 'Hadir' : 'Tidak Hadir'}</span>
            </div>
            ${wish ? `<p class="wish-text">${wish}</p>` : ''}
            <p class="wish-time">Baru saja</p>
        `;
        document.getElementById('wishes-list').prepend(wishCard);

        this.reset();
    });
</script>
</body>
</html>