<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - Rizky & Ameliya</title>
    
    <!-- Fonts -->
    <link href="[fonts.googleapis.com](https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Lato:wght@300;400;700&display=swap)" rel="stylesheet">
    <link rel="stylesheet" href="[cdnjs.cloudflare.com](https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css)">
    
    <style>
        /* ============================================
           ROOT VARIABLES - GARDEN WEDDING PALETTE
        ============================================ */
        :root {
            --sage: #8FAF8C;
            --sage-light: #B5CEB2;
            --sage-dark: #6B8F68;
            --beige: #F5EDD6;
            --beige-dark: #E8D9B5;
            --olive: #7A8C5C;
            --olive-dark: #5C6B44;
            --brown-light: #C4A882;
            --brown: #A08060;
            --brown-dark: #7A6040;
            --cream: #FAF6EE;
            --white: #FFFFFF;
            --text-dark: #3D2B1F;
            --text-medium: #6B5040;
            --text-light: #9A8070;
            --shadow: rgba(61, 43, 31, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* ============================================
           LEAF ANIMATION
        ============================================ */
        .leaves-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
            overflow: hidden;
        }

        .falling-leaf {
            position: absolute;
            top: -50px;
            opacity: 0.8;
            animation: fallLeaf linear infinite;
        }

        .falling-leaf svg {
            fill: var(--sage);
            opacity: 0.6;
        }

        @keyframes fallLeaf {
            0% {
                transform: translateY(-50px) rotate(0deg) translateX(0);
                opacity: 0;
            }
            10% { opacity: 0.8; }
            90% { opacity: 0.6; }
            100% {
                transform: translateY(110vh) rotate(720deg) translateX(80px);
                opacity: 0;
            }
        }

        /* ============================================
           GATE / LANDING PAGE
        ============================================ */
        #gate-page {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background: linear-gradient(
                180deg,
                #2D4A2D 0%,
                #3D6B3D 15%,
                #8FAF8C 40%,
                #B5CEB2 60%,
                #F5EDD6 100%
            );
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 1.2s ease, transform 1.2s ease;
        }

        #gate-page.closing {
            opacity: 0;
            transform: scale(1.05);
        }

        /* Garden scenery */
        .gate-scenery {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60%;
        }

        .garden-bg {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                0deg,
                #5C6B44 0%,
                #7A8C5C 20%,
                #8FAF8C 40%,
                transparent 100%
            );
        }

        /* Trees left */
        .tree {
            position: absolute;
            bottom: 0;
        }
        .tree-left {
            left: 0;
        }
        .tree-right {
            right: 0;
            transform: scaleX(-1);
        }

        /* Gate Structure */
        .gate-arch {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .gate-frame {
            width: 350px;
            height: 450px;
            padding: 30px 20px 20px;
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.15),
                rgba(255, 255, 255, 0.05)
            );
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: 120px 120px 10px 10px;
            text-align: center;
            backdrop-filter: blur(8px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
        }

        .gate-frame::before {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            border-radius: 122px 122px 12px 12px;
            background: linear-gradient(135deg, rgba(245,237,214,0.6), rgba(143,175,140,0.4));
            z-index: -1;
        }

        /* Flower decorations on gate */
        .gate-flowers {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 6px;
        }

        .gate-flower {
            font-size: 20px;
            animation: flowerSway 3s ease-in-out infinite;
        }

        .gate-flower:nth-child(2) { animation-delay: 0.5s; font-size: 16px; }
        .gate-flower:nth-child(3) { animation-delay: 1s; }

        @keyframes flowerSway {
            0%, 100% { transform: rotate(-5deg); }
            50% { transform: rotate(5deg); }
        }

        .gate-label {
            font-family: 'Lato', sans-serif;
            padding-top: 25px;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.8);
            margin-bottom: 12px;
        }

        .gate-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 6vw, 42px);
            color: #FFFFFF;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            line-height: 1.2;
            margin-bottom: 5px;
        }

        .gate-title .ampersand {
            font-style: italic;
            color: var(--beige);
        }

        .gate-date {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            color: rgba(255,255,255,0.85);
            letter-spacing: 1px;
            margin: 10px 0 20px;
        }

        .guest-greeting {
            font-family: 'Lato', sans-serif;
            font-size: 11px;
            color: rgba(255,255,255,0.7);
            margin-bottom: 4px;
            letter-spacing: 1px;
        }

        .guest-name {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            color: var(--beige);
            margin-bottom: 20px;
            font-style: italic;
        }

        .open-btn {
            background: linear-gradient(135deg, var(--beige), var(--beige-dark));
            color: var(--text-dark);
            border: none;
            padding: 14px 36px;
            border-radius: 50px;
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }

        .open-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .open-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .open-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
        }

        .open-btn .btn-icon {
            margin-left: 8px;
            animation: bounce 1.5s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        /* Fireflies */
        .firefly {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #FFE878;
            box-shadow: 0 0 10px 3px rgba(255,232,120,0.8);
            animation: fireflyAnim linear infinite;
        }

        @keyframes fireflyAnim {
            0% { opacity: 0; transform: translate(0, 0); }
            25% { opacity: 1; }
            50% { opacity: 0.5; transform: translate(30px, -20px); }
            75% { opacity: 1; }
            100% { opacity: 0; transform: translate(-20px, 30px); }
        }

        /* ============================================
           MAIN CONTENT
        ============================================ */
        #main-content {
            display: none;
            opacity: 0;
            transition: opacity 1s ease;
        }

        #main-content.visible {
            display: block;
            opacity: 1;
        }

        /* ============================================
           MUSIC PLAYER
        ============================================ */
        .music-player {
            position: fixed;
            bottom: 30px;
            right: 20px;
            z-index: 900;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .music-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--sage), var(--olive));
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(107,143,104,0.5);
            transition: all 0.3s ease;
            color: white;
            font-size: 18px;
        }

        .music-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(107,143,104,0.7);
        }

        .music-btn.playing {
            animation: musicPulse 2s ease-in-out infinite;
        }

        @keyframes musicPulse {
            0%, 100% { box-shadow: 0 4px 20px rgba(107,143,104,0.5); }
            50% { box-shadow: 0 4px 30px rgba(107,143,104,0.9), 0 0 0 10px rgba(107,143,104,0.1); }
        }

        .music-label {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            color: var(--text-medium);
            letter-spacing: 1px;
            box-shadow: 0 3px 15px var(--shadow);
            white-space: nowrap;
        }

        /* ============================================
           NAVIGATION
        ============================================ */
        .nav-dots {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 800;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .nav-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--brown-light);
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0.5;
            border: none;
            position: relative;
        }

        .nav-dot.active,
        .nav-dot:hover {
            opacity: 1;
            background: var(--sage-dark);
            transform: scale(1.4);
        }

        .nav-dot::after {
            content: attr(data-label);
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.9);
            padding: 4px 10px;
            border-radius: 10px;
            font-size: 10px;
            white-space: nowrap;
            color: var(--text-dark);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
            letter-spacing: 1px;
        }

        .nav-dot:hover::after {
            opacity: 1;
        }

        /* ============================================
           SECTION COMMONS
        ============================================ */
        section {
            min-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 80px 20px;
            overflow: hidden;
        }

        .section-leaf-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .container {
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 5vw, 42px);
            color: var(--sage-dark);
            text-align: center;
            margin-bottom: 10px;
        }

        .section-subtitle {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px;
            color: var(--text-light);
            text-align: center;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 40px;
        }

        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 20px auto;
        }

        .divider-line {
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--sage), transparent);
        }

        .divider-icon {
            color: var(--sage);
            font-size: 16px;
        }

        /* ============================================
           HERO SECTION
        ============================================ */
        #hero {
            background: linear-gradient(
                135deg,
                #EDF5EC 0%,
                #F5EDD6 50%,
                #EDF0E5 100%
            );
            min-height: 100vh;
            padding: 0;
        }

        .hero-botanical-left {
            position: absolute;
            left: -20px;
            top: 0;
            height: 100%;
            width: 200px;
            opacity: 0.25;
        }

        .hero-botanical-right {
            position: absolute;
            right: -20px;
            top: 0;
            height: 100%;
            width: 200px;
            opacity: 0.25;
            transform: scaleX(-1);
        }

        .hero-content {
            text-align: center;
            z-index: 2;
            padding: 40px 20px;
            animation: heroFadeIn 1.5s ease forwards;
        }

        @keyframes heroFadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-label {
            font-family: 'Lato', sans-serif;
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--sage-dark);
            margin-bottom: 20px;
        }

        .hero-names {
            font-family: 'Playfair Display', serif;
            font-size: clamp(52px, 12vw, 100px);
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 10px;
        }

        .hero-names .bride-name {
            display: block;
            color: var(--sage-dark);
            font-style: italic;
        }

        .hero-ampersand {
            font-size: clamp(30px, 6vw, 50px);
            color: var(--brown-light);
            margin: 5px 0;
            display: block;
            font-style: italic;
        }

        .hero-date-location {
            margin-top: 30px;
        }

        .hero-date {
            font-family: 'Playfair Display', serif;
            font-size: clamp(16px, 3vw, 22px);
            color: var(--text-medium);
            margin-bottom: 8px;
        }

        .hero-location {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            color: var(--text-light);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hero-scroll-hint {
            margin-top: 50px;
            animation: scrollBounce 2s ease-in-out infinite;
            color: var(--sage);
            font-size: 24px;
        }

        @keyframes scrollBounce {
            0%, 100% { transform: translateY(0); opacity: 0.7; }
            50% { transform: translateY(8px); opacity: 1; }
        }

        /* ============================================
           COUPLE SECTION
        ============================================ */
        #couple {
            background-color: var(--cream);
        }

        .couple-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 30px;
            align-items: start;
            margin-top: 40px;
        }

        .couple-card {
            text-align: center;
        }

        /* Polaroid Style */
        .polaroid {
            background: white;
            padding: 15px 15px 50px;
            box-shadow: 0 8px 30px var(--shadow);
            display: inline-block;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            animation: slideInFromLeft 0.8s ease forwards;
            cursor: pointer;
        }

        .polaroid:hover {
            transform: rotate(0deg) scale(1.03) translateY(-8px) !important;
            box-shadow: 0 20px 50px rgba(61,43,31,0.25);
        }

        .polaroid-groom {
            transform: rotate(-3deg);
            animation: slideInFromLeft 0.8s ease forwards;
        }

        .polaroid-bride {
            transform: rotate(3deg);
            animation: slideInFromRight 0.8s ease forwards;
        }

        @keyframes slideInFromLeft {
            from { opacity: 0; transform: translateX(-60px) rotate(-5deg); }
            to { opacity: 1; transform: translateX(0) rotate(-3deg); }
        }

        @keyframes slideInFromRight {
            from { opacity: 0; transform: translateX(60px) rotate(5deg); }
            to { opacity: 1; transform: translateX(0) rotate(3deg); }
        }

        .polaroid img {
            width: 100%;
            aspect-ratio: 4/5;
            object-fit: cover;
            display: block;
        }

        .polaroid-caption {
            margin-top: 10px;
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            color: var(--text-medium);
            font-style: italic;
        }

        .couple-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-top: 60px;
        }

        .heart-icon {
            font-size: 40px;
            color: var(--sage);
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .couple-ampersand {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            color: var(--brown-light);
            font-style: italic;
            line-height: 1;
        }

        .couple-info {
            margin-top: 20px;
        }

        .couple-fullname {
            font-family: 'Playfair Display', serif;
            font-size: clamp(18px, 3vw, 24px);
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .couple-parents {
            font-size: 13px;
            color: var(--text-light);
            line-height: 1.8;
        }

        .couple-parents strong {
            color: var(--text-medium);
        }

        /* Parents Photos */
        .parents-section {
            margin-top: 60px;
            text-align: center;
        }

        .parents-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 30px;
        }

        .parent-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 20px var(--shadow);
            border: 1px solid var(--beige-dark);
            transition: transform 0.3s ease;
        }

        .parent-card:hover {
            transform: translateY(-5px);
        }

        .parent-card-title {
            font-family: 'Lato', sans-serif;
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--sage);
            margin-bottom: 15px;
        }

        .parent-photos {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 15px;
        }

        .parent-photo-wrap {
            text-align: center;
        }

        .parent-photo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--sage-light);
            box-shadow: 0 3px 10px var(--shadow);
            transition: transform 0.3s ease;
        }

        .parent-photo:hover {
            transform: scale(1.1);
        }

        .parent-photo-name {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 6px;
            font-family: 'Cormorant Garamond', serif;
        }

        .parent-couple-names {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            color: var(--text-medium);
            font-style: italic;
        }

        .parent-heart {
            color: var(--brown-light);
            margin: 0 8px;
        }

        /* ============================================
           COUNTDOWN SECTION
        ============================================ */
        #countdown {
            background: linear-gradient(
                135deg,
                #3D5C3A 0%,
                #5C7A58 30%,
                #7A8C5C 60%,
                #8FAF8C 100%
            );
            position: relative;
        }

        #countdown::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='[w3.org](http://www.w3.org/2000/svg)'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .countdown-content {
            text-align: center;
            z-index: 1;
        }

        .countdown-label {
            font-family: 'Lato', sans-serif;
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
            margin-bottom: 15px;
        }

        .countdown-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 5vw, 48px);
            color: white;
            margin-bottom: 10px;
        }

        .countdown-date {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            color: rgba(255,255,255,0.85);
            margin-bottom: 50px;
            letter-spacing: 2px;
        }

        .countdown-grid {
            display: flex;
            gap: clamp(15px, 4vw, 40px);
            justify-content: center;
            flex-wrap: wrap;
        }

        .countdown-item {
            text-align: center;
        }

        .countdown-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 16px;
            width: clamp(80px, 18vw, 130px);
            height: clamp(80px, 18vw, 130px);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .countdown-box:hover {
            transform: translateY(-5px);
        }

        .countdown-number {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 8vw, 56px);
            color: white;
            font-weight: 600;
            line-height: 1;
        }

        .countdown-unit {
            font-family: 'Lato', sans-serif;
            font-size: 11px;
            color: rgba(255,255,255,0.75);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .countdown-passed {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: white;
            font-style: italic;
        }

        /* Date & Location Info */
        .event-info {
            margin-top: 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .event-card {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 16px;
            padding: 25px;
            text-align: center;
        }

        .event-card-icon {
            font-size: 28px;
            color: var(--beige);
            margin-bottom: 12px;
        }

        .event-card-label {
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            margin-bottom: 8px;
        }

        .event-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            color: white;
            margin-bottom: 6px;
        }

        .event-card-detail {
            font-size: 13px;
            color: rgba(255,255,255,0.75);
            line-height: 1.6;
        }

        /* ============================================
           LOVE STORY SECTION
        ============================================ */
        #story {
            background: var(--beige);
        }

        .story-timeline {
            margin-top: 50px;
            position: relative;
        }

        .story-timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, transparent, var(--sage), var(--sage-light), transparent);
            transform: translateX(-50%);
        }

        .story-item {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 20px;
            margin-bottom: 50px;
            align-items: center;
            opacity: 0;
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .story-item.visible {
            opacity: 1;
        }

        .story-item:nth-child(odd) .story-text {
            text-align: right;
            grid-column: 1;
        }

        .story-item:nth-child(odd) .story-img {
            grid-column: 3;
        }

        .story-item:nth-child(even) .story-text {
            grid-column: 3;
            text-align: left;
        }

        .story-item:nth-child(even) .story-img {
            grid-column: 1;
            grid-row: 1;
        }

        .story-dot {
            grid-column: 2;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 3px solid var(--sage);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sage);
            font-size: 16px;
            box-shadow: 0 4px 15px var(--shadow);
            z-index: 1;
        }

        .story-text {
            padding: 20px;
        }

        .story-year {
            font-family: 'Lato', sans-serif;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--sage-dark);
            margin-bottom: 8px;
        }

        .story-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .story-desc {
            font-size: 14px;
            color: var(--text-medium);
            line-height: 1.8;
        }

        .story-img {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px var(--shadow);
        }

        .story-img img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .story-img img:hover {
            transform: scale(1.05);
        }

        /* ============================================
           GALLERY SECTION
        ============================================ */
        #gallery {
            background: var(--cream);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 220px;
            gap: 15px;
            margin-top: 40px;
        }

        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px var(--shadow);
            position: relative;
            cursor: pointer;
        }

        .gallery-item:nth-child(1),
        .gallery-item:nth-child(4) {
            grid-row: span 2;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .gallery-item::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(
                135deg,
                rgba(143,175,140,0.0),
                rgba(143,175,140,0.4)
            );
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.08);
        }

        .gallery-item:hover::after {
            opacity: 1;
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.92);
            z-index: 9000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox img {
            max-width: 90vw;
            max-height: 90vh;
            border-radius: 8px;
            object-fit: contain;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 36px;
            cursor: pointer;
            background: none;
            border: none;
            line-height: 1;
        }

        /* ============================================
           RSVP SECTION
        ============================================ */
        #rsvp {
            background: linear-gradient(135deg, #EDF5EC, #F5EDD6);
        }

        .rsvp-form {
            background: white;
            border-radius: 24px;
            padding: 50px 40px;
            box-shadow: 0 15px 50px var(--shadow);
            max-width: 600px;
            margin: 40px auto 0;
            border: 1px solid var(--beige-dark);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-family: 'Lato', sans-serif;
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-medium);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--beige-dark);
            border-radius: 12px;
            font-family: 'Lato', sans-serif;
            font-size: 15px;
            color: var(--text-dark);
            background: var(--cream);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--sage);
            background: white;
            box-shadow: 0 0 0 4px rgba(143,175,140,0.15);
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        .attendance-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .attendance-option {
            position: relative;
        }

        .attendance-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
        }

        .attendance-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px;
            border: 2px solid var(--beige-dark);
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            color: var(--text-medium);
            transition: all 0.3s ease;
            background: var(--cream);
        }

        .attendance-option input[type="radio"]:checked + label {
            border-color: var(--sage);
            background: rgba(143,175,140,0.1);
            color: var(--sage-dark);
            font-weight: 700;
        }

        .attendance-option label:hover {
            border-color: var(--sage-light);
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--sage-dark), var(--olive));
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Lato', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 8px 25px rgba(107,143,104,0.4);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(107,143,104,0.5);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .rsvp-success {
            display: none;
            text-align: center;
            padding: 40px;
        }

        .rsvp-success .success-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .rsvp-success h3 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: var(--sage-dark);
            margin-bottom: 10px;
        }

        .rsvp-success p {
            color: var(--text-medium);
            line-height: 1.7;
        }

        /* ============================================
           FOOTER / CLOSING
        ============================================ */
        #closing {
            background: linear-gradient(
                135deg,
                #2D4A2D 0%,
                #3D6B3D 40%,
                #5C7A58 100%
            );
            min-height: 60vh;
        }

        .closing-content {
            text-align: center;
            color: white;
            z-index: 1;
        }

        .closing-quote {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(16px, 3vw, 22px);
            font-style: italic;
            color: rgba(255,255,255,0.85);
            line-height: 1.8;
            margin-bottom: 8px;
            max-width: 600px;
        }

        .closing-quote-source {
            font-size: 12px;
            color: rgba(255,255,255,0.55);
            letter-spacing: 2px;
            margin-bottom: 40px;
        }

        .closing-names {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 7vw, 56px);
            color: white;
            margin-bottom: 5px;
        }

        .closing-names span {
            color: var(--beige);
            font-style: italic;
        }

        .closing-date {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px;
            color: rgba(255,255,255,0.7);
            letter-spacing: 3px;
            margin-top: 10px;
            margin-bottom: 50px;
        }

        .closing-hashtag {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: var(--beige);
            font-style: italic;
            margin-bottom: 40px;
        }

        .footer-credit {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            letter-spacing: 2px;
        }

        /* ============================================
           TOAST NOTIFICATION
        ============================================ */
        .toast {
            position: fixed;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: var(--text-dark);
            color: white;
            padding: 14px 28px;
            border-radius: 50px;
            font-size: 14px;
            opacity: 0;
            transition: all 0.4s ease;
            z-index: 9999;
            pointer-events: none;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* ============================================
           SCROLL ANIMATIONS
        ============================================ */
        .fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .fade-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* ============================================
           RESPONSIVE
        ============================================ */
        @media (max-width: 768px) {
            .couple-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .couple-center {
                flex-direction: row;
                padding-top: 0;
                justify-content: center;
                gap: 20px;
            }

            .couple-card:first-child { order: 1; }
            .couple-center { order: 2; }
            .couple-card:last-child { order: 3; }

            .story-timeline::before {
                left: 20px;
            }

            .story-item {
                grid-template-columns: 40px 1fr;
                grid-template-rows: auto auto;
            }

            .story-dot { grid-column: 1; grid-row: 1; }
            .story-item:nth-child(odd) .story-text,
            .story-item:nth-child(even) .story-text {
                grid-column: 2;
                grid-row: 1;
                text-align: left;
            }
            .story-item:nth-child(odd) .story-img,
            .story-item:nth-child(even) .story-img {
                grid-column: 1 / -1;
                grid-row: 2;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-auto-rows: 160px;
            }

            .gallery-item:nth-child(1),
            .gallery-item:nth-child(4) {
                grid-row: span 1;
            }

            .parents-grid {
                grid-template-columns: 1fr;
            }

            .event-info {
                grid-template-columns: 1fr;
            }

            .rsvp-form {
                padding: 30px 20px;
            }

            .countdown-grid {
                gap: 10px;
            }

            .nav-dots {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .gallery-grid {
                grid-template-columns: 1fr 1fr;
                grid-auto-rows: 130px;
            }

            .gate-frame {
                width: 220px;
            }
        }

        /* Botanical SVG decorations */
        .botanical-corner {
            position: absolute;
            opacity: 0.12;
            pointer-events: none;
        }

        .botanical-top-left {
            top: -20px;
            left: -20px;
            transform: rotate(0deg);
        }

        .botanical-top-right {
            top: -20px;
            right: -20px;
            transform: rotate(90deg);
        }

        .botanical-bottom-left {
            bottom: -20px;
            left: -20px;
            transform: rotate(270deg);
        }

        .botanical-bottom-right {
            bottom: -20px;
            right: -20px;
            transform: rotate(180deg);
        }
    </style>
</head>
<body>

<!-- ============================================
     FALLING LEAVES
============================================ -->
<div class="leaves-container" id="leavesContainer"></div>

<!-- ============================================
     LIGHTBOX
============================================ -->
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" id="lightboxClose">&times;</button>
    <img src="" id="lightboxImg" alt="Gallery">
</div>

<!-- ============================================
     TOAST
============================================ -->
<div class="toast" id="toast"></div>

<!-- ============================================
     GATE PAGE
============================================ -->
<div id="gate-page">
    <!-- Garden Background -->
    <div class="gate-scenery">
        <div class="garden-bg"></div>
        
        <!-- Botanical SVG Trees -->
        <svg class="tree tree-left" width="200" height="400" viewBox="0 0 200 400" xmlns="[w3.org](http://www.w3.org/2000/svg)">
            <rect x="90" y="300" width="20" height="100" fill="#5C4033" rx="4"/>
            <ellipse cx="80" cy="220" rx="65" ry="90" fill="#3D6B3D" opacity="0.9"/>
            <ellipse cx="100" cy="180" rx="50" ry="80" fill="#4A7A4A" opacity="0.95"/>
            <ellipse cx="60" cy="260" rx="45" ry="60" fill="#3D6B3D" opacity="0.8"/>
            <ellipse cx="130" cy="250" rx="40" ry="55" fill="#4A7A4A" opacity="0.85"/>
            <!-- Leaves -->
            <ellipse cx="40" cy="200" rx="20" ry="10" fill="#8FAF8C" opacity="0.6" transform="rotate(-30 40 200)"/>
            <ellipse cx="150" cy="190" rx="18" ry="9" fill="#B5CEB2" opacity="0.5" transform="rotate(20 150 190)"/>
            <ellipse cx="80" cy="140" rx="15" ry="8" fill="#8FAF8C" opacity="0.5" transform="rotate(-10 80 140)"/>
        </svg>

        <svg class="tree tree-right" width="200" height="400" viewBox="0 0 200 400" xmlns="[w3.org](http://www.w3.org/2000/svg)">
            <rect x="90" y="300" width="20" height="100" fill="#5C4033" rx="4"/>
            <ellipse cx="110" cy="220" rx="65" ry="90" fill="#3D6B3D" opacity="0.9"/>
            <ellipse cx="95" cy="180" rx="50" ry="80" fill="#4A7A4A" opacity="0.95"/>
            <ellipse cx="130" cy="260" rx="45" ry="60" fill="#3D6B3D" opacity="0.8"/>
            <ellipse cx="60" cy="250" rx="40" ry="55" fill="#4A7A4A" opacity="0.85"/>
            <ellipse cx="150" cy="200" rx="20" ry="10" fill="#8FAF8C" opacity="0.6" transform="rotate(30 150 200)"/>
            <ellipse cx="40" cy="190" rx="18" ry="9" fill="#B5CEB2" opacity="0.5" transform="rotate(-20 40 190)"/>
        </svg>
    </div>

    <!-- Fireflies -->
    <div id="fireflies"></div>

    <!-- Gate Frame -->
    <div class="gate-arch">
        <div class="gate-frame">
            <div class="gate-flowers">
                <span class="gate-flower">🌿</span>
                <span class="gate-flower">🌸</span>
                <span class="gate-flower">🌿</span>
            </div>

            <p class="gate-label">Undangan Pernikahan</p>
            
            <div class="gate-title">
                Rizky
                <span class="ampersand">&</span>
                Ameliya
            </div>

            <p class="gate-date">Minggu, 14 Juni 2026</p>

            <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 16px; margin-bottom: 16px;">
                <p class="guest-greeting">Kepada Yth.</p>
                <p class="guest-name" id="guestName">Tamu Undangan</p>
            </div>

            <button class="open-btn" id="openBtn">
                Buka Undangan
                <span class="btn-icon">🌿</span>
            </button>
        </div>
    </div>

    <!-- Stars -->
    <div id="stars" style="position:absolute;top:0;left:0;width:100%;height:40%;pointer-events:none;"></div>
</div>

<!-- ============================================
     MUSIC PLAYER
============================================ -->
<div class="music-player" id="musicPlayer" style="display:none;">
    <span class="music-label">♪ Perfect — Ed Sheeran</span>
    <button class="music-btn" id="musicBtn">
        <i class="fas fa-music"></i>
    </button>
    <audio id="bgMusic" loop>
        <!-- Ganti src dengan file lagu Anda -->
        <source src="{{ asset('audio/wedding.mp3') }}" type="audio/mp3">
    </audio>
</div>

<!-- ============================================
     NAV DOTS
============================================ -->
<nav class="nav-dots" id="navDots" style="display:none;">
    <button class="nav-dot active" data-section="hero" data-label="Beranda" onclick="scrollToSection('hero')"></button>
    <button class="nav-dot" data-section="couple" data-label="Mempelai" onclick="scrollToSection('couple')"></button>
    <button class="nav-dot" data-section="countdown" data-label="Countdown" onclick="scrollToSection('countdown')"></button>
    <button class="nav-dot" data-section="story" data-label="Cerita Cinta" onclick="scrollToSection('story')"></button>
    <button class="nav-dot" data-section="gallery" data-label="Galeri" onclick="scrollToSection('gallery')"></button>
    <button class="nav-dot" data-section="rsvp" data-label="RSVP" onclick="scrollToSection('rsvp')"></button>
</nav>

<!-- ============================================
     MAIN CONTENT
============================================ -->
<div id="main-content">

    <!-- HERO SECTION -->
    <section id="hero">
        <!-- Botanical Decorations -->
        <svg class="hero-botanical-left" viewBox="0 0 200 600" xmlns="[w3.org](http://www.w3.org/2000/svg)">
            <g fill="#8FAF8C">
                <ellipse cx="30" cy="100" rx="50" ry="20" transform="rotate(-40 30 100)"/>
                <ellipse cx="50" cy="200" rx="60" ry="22" transform="rotate(-20 50 200)"/>
                <ellipse cx="20" cy="300" rx="45" ry="18" transform="rotate(-50 20 300)"/>
                <ellipse cx="60" cy="400" rx="55" ry="20" transform="rotate(-30 60 400)"/>
                <ellipse cx="30" cy="500" rx="40" ry="16" transform="rotate(-45 30 500)"/>
                <line x1="40" y1="50" x2="40" y2="560" stroke="#7A8C5C" stroke-width="3" opacity="0.5"/>
            </g>
        </svg>

        <svg class="hero-botanical-right" viewBox="0 0 200 600" xmlns="[w3.org](http://www.w3.org/2000/svg)">
            <g fill="#8FAF8C">
                <ellipse cx="170" cy="100" rx="50" ry="20" transform="rotate(40 170 100)"/>
                <ellipse cx="150" cy="200" rx="60" ry="22" transform="rotate(20 150 200)"/>
                <ellipse cx="180" cy="300" rx="45" ry="18" transform="rotate(50 180 300)"/>
                <ellipse cx="140" cy="400" rx="55" ry="20" transform="rotate(30 140 400)"/>
                <ellipse cx="170" cy="500" rx="40" ry="16" transform="rotate(45 170 500)"/>
                <line x1="160" y1="50" x2="160" y2="560" stroke="#7A8C5C" stroke-width="3" opacity="0.5"/>
            </g>
        </svg>

        <div class="hero-content">
            <p class="hero-label">🌿 The Wedding of</p>
            
            <div class="hero-names">
                <span>Rizky</span>
                <span class="hero-ampersand">&</span>
                <span class="bride-name">Ameliya</span>
            </div>

            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-icon">🍃</span>
                <div class="divider-line"></div>
            </div>

            <div class="hero-date-location">
                <p class="hero-date">Minggu, 14 Juni 2026</p>
                <p class="hero-location">📍 The Secret Garden, Bogor, Jawa Barat</p>
            </div>

            <div class="hero-scroll-hint">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- COUPLE SECTION -->
    <section id="couple">
        <!-- Botanical corners -->
        <svg class="botanical-corner botanical-top-left" width="150" height="150" viewBox="0 0 150 150" xmlns="[w3.org](http://www.w3.org/2000/svg)">
            <g fill="#8FAF8C">
                <ellipse cx="20" cy="80" rx="40" ry="15" transform="rotate(-30 20 80)"/>
                <ellipse cx="50" cy="40" rx="35" ry="14" transform="rotate(-60 50 40)"/>
                <ellipse cx="80" cy="20" rx="30" ry="12" transform="rotate(-80 80 20)"/>
                <line x1="10" y1="120" x2="100" y2="10" stroke="#7A8C5C" stroke-width="2"/>
            </g>
        </svg>
        <svg class="botanical-corner botanical-bottom-right" width="150" height="150" viewBox="0 0 150 150" xmlns="[w3.org](http://www.w3.org/2000/svg)">
            <g fill="#8FAF8C">
                <ellipse cx="130" cy="70" rx="40" ry="15" transform="rotate(30 130 70)"/>
                <ellipse cx="100" cy="110" rx="35" ry="14" transform="rotate(60 100 110)"/>
                <ellipse cx="70" cy="130" rx="30" ry="12" transform="rotate(80 70 130)"/>
                <line x1="140" y1="30" x2="50" y2="140" stroke="#7A8C5C" stroke-width="2"/>
            </g>
        </svg>

        <div class="container">
            <p class="section-subtitle fade-up">Dengan penuh rasa syukur</p>
            <h2 class="section-title fade-up">Mempelai</h2>

            <div class="divider fade-up">
                <div class="divider-line"></div>
                <span class="divider-icon">🌸</span>
                <div class="divider-line"></div>
            </div>

            <div class="couple-grid">
                <!-- Groom -->
                <div class="couple-card fade-left">
                    <div class="polaroid polaroid-groom">
                        <img 
                            src="{{ asset('images/groom.jpg') }}" 
                            alt="Mempelai Pria"
                            onerror="this.src='[placehold.co](https://placehold.co/300x375/8FAF8C/FFFFFF?text=Foto+Pria)'"
                        >
                        <div class="polaroid-caption">Rizky</div>
                    </div>
                    <div class="couple-info" style="margin-top:20px;">
                        <h3 class="couple-fullname">Muhammad Rizky Pratama, S.T.</h3>
                        <div class="couple-parents">
                            <p>Putra pertama dari</p>
                            <p><strong>Bapak Ahmad Santoso</strong></p>
                            <p>dan <strong>Ibu Sri Rahayu</strong></p>
                        </div>
                    </div>
                </div>

                <!-- Center -->
                <div class="couple-center fade-up">
                    <div class="heart-icon">🌿</div>
                    <div class="couple-ampersand">&</div>
                    <div class="heart-icon">🌿</div>
                </div>

                <!-- Bride -->
                <div class="couple-card fade-right">
                    <div class="polaroid polaroid-bride">
                        <img 
                            src="{{ asset('images/bride.jpg') }}" 
                            alt="Mempelai Wanita"
                            onerror="this.src='[placehold.co](https://placehold.co/300x375/B5CEB2/FFFFFF?text=Foto+Wanita)'"
                        >
                        <div class="polaroid-caption">Ameliya</div>
                    </div>
                    <div class="couple-info" style="margin-top:20px;">
                        <h3 class="couple-fullname">Ameliya Sari Dewi, S.Pd.</h3>
                        <div class="couple-parents">
                            <p>Putri pertama dari</p>
                            <p><strong>Bapak Hendra Wijaya</strong></p>
                            <p>dan <strong>Ibu Nurlaela</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PARENTS SECTION -->
            <div class="parents-section fade-up">
                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-icon">🍃</span>
                    <div class="divider-line"></div>
                </div>
                <h3 class="section-title" style="font-size:28px; margin-bottom:5px;">Orang Tua Mempelai</h3>
                <p style="color:var(--text-light); font-size:13px; margin-bottom:30px; font-family:'Cormorant Garamond', serif; font-style:italic;">
                    Yang kami hormati dan kasihi
                </p>

                <div class="parents-grid">
                    <!-- Parents Groom -->
                    <div class="parent-card">
                        <p class="parent-card-title">🌿 Keluarga Mempelai Pria</p>
                        <div class="parent-photos">
                            <div class="parent-photo-wrap">
                                <img 
                                    src="{{ asset('images/father-groom.jpg') }}" 
                                    alt="Ayah Pria"
                                    class="parent-photo"
                                    onerror="this.src='[placehold.co](https://placehold.co/80x80/8FAF8C/FFFFFF?text=Ayah)'"
                                >
                                <p class="parent-photo-name">Bapak Ahmad</p>
                            </div>
                            <div class="parent-photo-wrap" style="display:flex;align-items:center;padding-bottom:20px;">
                                <span style="color:var(--brown-light); font-size:20px;">🤍</span>
                            </div>
                            <div class="parent-photo-wrap">
                                <img 
                                    src="{{ asset('images/mother-groom.jpg') }}" 
                                    alt="Ibu Pria"
                                    class="parent-photo"
                                    onerror="this.src='[placehold.co](https://placehold.co/80x80/B5CEB2/FFFFFF?text=Ibu)'"
                                >
                                <p class="parent-photo-name">Ibu Sri Rahayu</p>
                            </div>
                        </div>
                        <p class="parent-couple-names">Ahmad Santoso <span class="parent-heart">🤍</span> Sri Rahayu</p>
                    </div>

                    <!-- Parents Bride -->
                    <div class="parent-card">
                        <p class="parent-card-title">🌸 Keluarga Mempelai Wanita</p>
                        <div class="parent-photos">
                            <div class="parent-photo-wrap">
                                <img 
                                    src="{{ asset('images/father-bride.jpg') }}" 
                                    alt="Ayah Wanita"
                                    class="parent-photo"
                                    onerror="this.src='[placehold.co](https://placehold.co/80x80/8FAF8C/FFFFFF?text=Ayah)'"
                                >
                                <p class="parent-photo-name">Bapak Hendra</p>
                            </div>
                            <div class="parent-photo-wrap" style="display:flex;align-items:center;padding-bottom:20px;">
                                <span style="color:var(--brown-light); font-size:20px;">🤍</span>
                            </div>
                            <div class="parent-photo-wrap">
                                <img 
                                    src="{{ asset('images/mother-bride.jpg') }}" 
                                    alt="Ibu Wanita"
                                    class="parent-photo"
                                    onerror="this.src='[placehold.co](https://placehold.co/80x80/B5CEB2/FFFFFF?text=Ibu)'"
                                >
                                <p class="parent-photo-name">Ibu Nurlaela</p>
                            </div>
                        </div>
                        <p class="parent-couple-names">Hendra Wijaya <span class="parent-heart">🤍</span> Nurlaela</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COUNTDOWN SECTION -->
    <section id="countdown">
        <div class="container">
            <div class="countdown-content">
                <p class="countdown-label">🌿 Menghitung Hari</p>
                <h2 class="countdown-title">Hari Bahagia Kami</h2>
                <p class="countdown-date">Minggu, 14 Juni 2026 · 10:00 WIB</p>

                <div class="countdown-grid" id="countdownGrid">
                    <div class="countdown-item">
                        <div class="countdown-box">
                            <span class="countdown-number" id="cdDays">00</span>
                        </div>
                        <span class="countdown-unit">Hari</span>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-box">
                            <span class="countdown-number" id="cdHours">00</span>
                        </div>
                        <span class="countdown-unit">Jam</span>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-box">
                            <span class="countdown-number" id="cdMinutes">00</span>
                        </div>
                        <span class="countdown-unit">Menit</span>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-box">
                            <span class="countdown-number" id="cdSeconds">00</span>
                        </div>
                        <span class="countdown-unit">Detik</span>
                    </div>
                </div>

                <!-- Event Info Cards -->
                <div class="event-info">
                    <div class="event-card fade-up">
                        <div class="event-card-icon">💍</div>
                        <p class="event-card-label">Akad Nikah</p>
                        <p class="event-card-title">Minggu, 14 Juni 2026</p>
                        <p class="event-card-detail">08:00 – 10:00 WIB<br>Masjid Al-Ikhlas, Bogor</p>
                    </div>
                    <div class="event-card fade-up">
                        <div class="event-card-icon">🌿</div>
                        <p class="event-card-label">Resepsi</p>
                        <p class="event-card-title">Minggu, 14 Juni 2026</p>
                        <p class="event-card-detail">11:00 – 16:00 WIB<br>The Secret Garden, Bogor</p>
                    </div>
                </div>

                <!-- Maps button -->
                <div style="margin-top: 30px;">
                    <a 
                        href="[maps.google.com](https://maps.google.com/?q=The+Secret+Garden+Bogor)" 
                        target="_blank"
                        style="
                            display: inline-flex;
                            align-items: center;
                            gap: 8px;
                            background: rgba(255,255,255,0.15);
                            border: 1px solid rgba(255,255,255,0.3);
                            color: white;
                            text-decoration: none;
                            padding: 12px 28px;
                            border-radius: 50px;
                            font-size: 13px;
                            letter-spacing: 1px;
                            transition: all 0.3s ease;
                            backdrop-filter: blur(8px);
                        "
                        onmouseover="this.style.background='rgba(255,255,255,0.25)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.15)'"
                    >
                        <i class="fas fa-map-marker-alt"></i>
                        Lihat di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- LOVE STORY SECTION -->
    <section id="story">
        <div class="container">
            <p class="section-subtitle fade-up">Perjalanan cinta kami</p>
            <h2 class="section-title fade-up">Cerita Kita</h2>

            <div class="divider fade-up">
                <div class="divider-line"></div>
                <span class="divider-icon">💚</span>
                <div class="divider-line"></div>
            </div>

            <div class="story-timeline">
                <!-- Story 1 -->
                <div class="story-item">
                    <div class="story-text">
                        <p class="story-year">2019 · Awal Pertemuan</p>
                        <h3 class="story-title">Pertemuan Pertama</h3>
                        <p class="story-desc">
                            Semuanya dimulai di sebuah kafe kecil di sudut kota Bogor. 
                            Hujan turun deras, dan kami berbagi meja yang sama karena 
                            tempat lain sudah penuh. Percakapan mengalir begitu alami, 
                            seolah kami sudah saling mengenal bertahun-tahun.
                        </p>
                    </div>
                    <div class="story-dot">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <div class="story-img">
                        <img 
                            src="{{ asset('images/story-1.jpg') }}" 
                            alt="Pertemuan Pertama"
                            onerror="this.src='[placehold.co](https://placehold.co/400x300/8FAF8C/FFFFFF?text=Pertemuan+Pertama)'"
                        >
                    </div>
                </div>

                <!-- Story 2 -->
                <div class="story-item">
                    <div class="story-img">
                        <img 
                            src="{{ asset('images/story-2.jpg') }}" 
                            alt="Jatuh Cinta"
                            onerror="this.src='[placehold.co](https://placehold.co/400x300/B5CEB2/FFFFFF?text=Jatuh+Cinta)'"
                        >
                    </div>
                    <div class="story-dot">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="story-text">
                        <p class="story-year">2020 · Jatuh Cinta</p>
                        <h3 class="story-title">Saat Aku Tahu Dia Spesial</h3>
                        <p class="story-desc">
                            Satu tahun berlalu, dan aku menyadari betapa aku selalu 
                            menantikan pesannya di pagi hari. Ia hadir bukan hanya 
                            sebagai teman, tapi sebagai rumah tempat aku pulang. 
                            Di sinilah cerita cinta kami benar-benar dimulai.
                        </p>
                    </div>
                </div>

                <!-- Story 3 -->
                <div class="story-item">
                    <div class="story-text">
                        <p class="story-year">2022 · Perjalanan Bersama</p>
                        <h3 class="story-title">Petualangan Kita</h3>
                        <p class="story-desc">
                            Kami menjelajahi berbagai sudut indah bersama — dari 
                            pantai yang tenang hingga pegunungan yang sejuk. Setiap 
                            perjalanan mengajarkan kami untuk saling mengenal lebih 
                            dalam dan memperkuat ikatan yang telah terjalin.
                        </p>
                    </div>
                    <div class="story-dot">
                        <i class="fas fa-compass"></i>
                    </div>
                    <div class="story-img">
                        <img 
                            src="{{ asset('images/story-3.jpg') }}" 
                            alt="Perjalanan"
                            onerror="this.src='[placehold.co](https://placehold.co/400x300/7A8C5C/FFFFFF?text=Petualangan)'"
                        >
                    </div>
                </div>

                <!-- Story 4 -->
                <div class="story-item">
                    <div class="story-img">
                        <img 
                            src="{{ asset('images/story-4.jpg') }}" 
                            alt="Lamaran"
                            onerror="this.src='[placehold.co](https://placehold.co/400x300/C4A882/FFFFFF?text=Lamaran)'"
                        >
                    </div>
                    <div class="story-dot">
                        <i class="fas fa-ring"></i>
                    </div>
                    <div class="story-text">
                        <p class="story-year">2025 · Lamaran</p>
                        <h3 class="story-title">Momen yang Dinantikan</h3>
                        <p class="story-desc">
                            Di bawah sinar bulan purnama dan alunan angin malam, 
                            Rizky berlutut dan mengucapkan kata-kata yang paling 
                            indah. Ameliya mengangguk dengan air mata bahagia, 
                            dan dunia terasa sempurna saat itu juga.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GALLERY SECTION -->
    <section id="gallery">
        <div class="container">
            <p class="section-subtitle fade-up">Kenangan indah bersama</p>
            <h2 class="section-title fade-up">Galeri Kami</h2>

            <div class="divider fade-up">
                <div class="divider-line"></div>
                <span class="divider-icon">📸</span>
                <div class="divider-line"></div>
            </div>

            <div class="gallery-grid fade-up">
                <div class="gallery-item" onclick="openLightbox(this)">
                    <img 
                        src="{{ asset('images/gallery-1.jpg') }}" 
                        alt="Galeri 1"
                        onerror="this.src='[placehold.co](https://placehold.co/400x600/8FAF8C/FFFFFF?text=Foto+1)'"
                    >
                </div>
                <div class="gallery-item" onclick="openLightbox(this)">
                    <img 
                        src="{{ asset('images/gallery-2.jpg') }}" 
                        alt="Galeri 2"
                        onerror="this.src='[placehold.co](https://placehold.co/400x300/B5CEB2/FFFFFF?text=Foto+2)'"
                    >
                </div>
                <div class="gallery-item" onclick="openLightbox(this)">
                    <img 
                        src="{{ asset('images/gallery-3.jpg') }}" 
                        alt="Galeri 3"
                        onerror="this.src='[placehold.co](https://placehold.co/400x300/7A8C5C/FFFFFF?text=Foto+3)'"
                    >
                </div>
                <div class="gallery-item" onclick="openLightbox(this)">
                    <img 
                        src="{{ asset('images/gallery-4.jpg') }}" 
                        alt="Galeri 4"
                        onerror="this.src='[placehold.co](https://placehold.co/400x600/C4A882/FFFFFF?text=Foto+4)'"
                    >
                </div>
                <div class="gallery-item" onclick="openLightbox(this)">
                    <img 
                        src="{{ asset('images/gallery-5.jpg') }}" 
                        alt="Galeri 5"
                        onerror="this.src='[placehold.co](https://placehold.co/400x300/8FAF8C/FFFFFF?text=Foto+5)'"
                    >
                </div>
                <div class="gallery-item" onclick="openLightbox(this)">
                    <img 
                        src="{{ asset('images/gallery-6.jpg') }}" 
                        alt="Galeri 6"
                        onerror="this.src='[placehold.co](https://placehold.co/400x300/B5CEB2/FFFFFF?text=Foto+6)'"
                    >
                </div>
                <div class="gallery-item" onclick="openLightbox(this)">
                    <img 
                        src="{{ asset('images/gallery-7.jpg') }}" 
                        alt="Galeri 7"
                        onerror="this.src='[placehold.co](https://placehold.co/400x300/7A8C5C/FFFFFF?text=Foto+7)'"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- RSVP SECTION -->
    <section id="rsvp">
        <!-- Botanical corners -->
        <svg class="botanical-corner botanical-top-right" width="180" height="180" viewBox="0 0 150 150" xmlns="[w3.org](http://www.w3.org/2000/svg)">
            <g fill="#8FAF8C" opacity="0.3">
                <ellipse cx="130" cy="70" rx="40" ry="15" transform="rotate(40 130 70)"/>
                <ellipse cx="100" cy="30" rx="35" ry="14" transform="rotate(60 100 30)"/>
                <ellipse cx="60" cy="10" rx="30" ry="12" transform="rotate(80 60 10)"/>
                <line x1="140" y1="120" x2="30" y2="5" stroke="#7A8C5C" stroke-width="2"/>
            </g>
        </svg>

        <div class="container">
            <p class="section-subtitle fade-up">Konfirmasi kehadiran</p>
            <h2 class="section-title fade-up">RSVP</h2>

            <div class="divider fade-up">
                <div class="divider-line"></div>
                <span class="divider-icon">✉️</span>
                <div class="divider-line"></div>
            </div>

            <p style="text-align:center; color:var(--text-medium); font-family:'Cormorant Garamond', serif; font-size:18px; margin-bottom:0;" class="fade-up">
                Kehadiran Anda adalah hadiah terindah bagi kami.<br>
                Mohon konfirmasi paling lambat <strong>7 Juni 2026</strong>.
            </p>

            <div class="rsvp-form fade-up" id="rsvpForm">
                <form id="weddingRsvpForm" onsubmit="handleRSVP(event)">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="tel" class="form-control" name="phone" placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Konfirmasi Kehadiran *</label>
                        <div class="attendance-options">
                            <div class="attendance-option">
                                <input type="radio" name="attendance" id="attend-yes" value="hadir" required>
                                <label for="attend-yes">
                                    <span>✅</span> Hadir
                                </label>
                            </div>
                            <div class="attendance-option">
                                <input type="radio" name="attendance" id="attend-no" value="tidak_hadir">
                                <label for="attend-no">
                                    <span>❌</span> Tidak Hadir
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="guestCountGroup">
                        <label class="form-label">Jumlah Tamu</label>
                        <select class="form-control" name="guest_count">
                            <option value="1">1 orang (hanya saya)</option>
                            <option value="2">2 orang</option>
                            <option value="3">3 orang</option>
                            <option value="4">4 orang</option>
                            <option value="5">5 orang atau lebih</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ucapan & Doa</label>
                        <textarea 
                            class="form-control" 
                            name="message" 
                            rows="4" 
                            placeholder="Sampaikan ucapan selamat dan doa terbaik Anda untuk kami..."
                            style="resize:vertical;"
                        ></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane" style="margin-right:8px;"></i>
                        Kirim Konfirmasi
                    </button>
                </form>

                <!-- Success State -->
                <div class="rsvp-success" id="rsvpSuccess">
                    <div class="success-icon">🌿</div>
                    <h3>Terima Kasih!</h3>
                    <p>
                        Konfirmasi kehadiran Anda telah kami terima.<br>
                        Kami sangat menantikan kehadiran Anda di hari bahagia kami.<br><br>
                        <em style="color:var(--sage-dark);">Rizky & Ameliya</em>
                    </p>
                </div>
            </div>

            <!-- Wishes Wall -->
            <div class="fade-up" style="margin-top: 50px; text-align:center;">
                <h3 style="font-family:'Playfair Display',serif; font-size:24px; color:var(--text-dark); margin-bottom:20px;">
                    💌 Ucapan & Doa
                </h3>
                <div id="wishesWall" style="
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
                    gap: 16px;
                    text-align: left;
                ">
                    <!-- Wishes akan tampil di sini -->
                    <div style="background:white; border-radius:16px; padding:20px; box-shadow:0 4px 15px var(--shadow); border-left:4px solid var(--sage);">
                        <p style="font-family:'Cormorant Garamond',serif; font-size:16px; color:var(--text-medium); font-style:italic; margin-bottom:10px;">
                            "Semoga pernikahan kalian menjadi awal dari kebahagiaan yang tak terhingga. Barakallah!"
                        </p>
                        <p style="font-size:12px; color:var(--text-light); letter-spacing:1px;">— Budi Santoso</p>
                    </div>
                    <div style="background:white; border-radius:16px; padding:20px; box-shadow:0 4px 15px var(--shadow); border-left:4px solid var(--brown-light);">
                        <p style="font-family:'Cormorant Garamond',serif; font-size:16px; color:var(--text-medium); font-style:italic; margin-bottom:10px;">
                            "Selamat menempuh hidup baru! Semoga kalian selalu saling mencintai dan mendukung satu sama lain 🌿"
                        </p>
                        <p style="font-size:12px; color:var(--text-light); letter-spacing:1px;">— Dewi Permata</p>
                    </div>
                    <div style="background:white; border-radius:16px; padding:20px; box-shadow:0 4px 15px var(--shadow); border-left:4px solid var(--olive);">
                        <p style="font-family:'Cormorant Garamond',serif; font-size:16px; color:var(--text-medium); font-style:italic; margin-bottom:10px;">
                            "Barakallahu lakuma wa baraka alaykuma wa jama'a baynakuma fi khair. Selamat menikah!"
                        </p>
                        <p style="font-size:12px; color:var(--text-light); letter-spacing:1px;">— Keluarga Besar Hartono</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CLOSING SECTION -->
    <section id="closing">
        <!-- Botanical top decoration -->
        <svg style="position:absolute;top:0;left:0;width:100%;pointer-events:none;" viewBox="0 0 1440 80" xmlns="[w3.org](http://www.w3.org/2000/svg)" preserveAspectRatio="none">
            <path d="M0,80 Q360,0 720,40 Q1080,80 1440,0 L1440,0 L0,0 Z" fill="#EDF5EC" opacity="0.15"/>
        </svg>

        <div class="container">
            <div class="closing-content">
                <div class="divider" style="margin-bottom:30px;">
                    <div class="divider-line" style="background:linear-gradient(90deg,transparent,rgba(255,255,255,0.4),transparent);"></div>
                    <span style="color:rgba(255,255,255,0.7); font-size:20px;">🌿</span>
                    <div class="divider-line" style="background:linear-gradient(90deg,transparent,rgba(255,255,255,0.4),transparent);"></div>
                </div>

                <p class="closing-quote">
                    "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu 
                    istri-istri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram 
                    kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan sayang."
                </p>
                <p class="closing-quote-source">— QS. Ar-Rum: 21 —</p>

                <div class="divider" style="margin:30px auto;">
                    <div class="divider-line" style="background:linear-gradient(90deg,transparent,rgba(255,255,255,0.3),transparent);"></div>
                    <span style="color:rgba(255,255,255,0.5);">✦</span>
                    <div class="divider-line" style="background:linear-gradient(90deg,transparent,rgba(255,255,255,0.3),transparent);"></div>
                </div>

                <p class="closing-names">
                    Rizky <span>&</span> Ameliya
                </p>
                <p class="closing-date">14 · 06 · 2026</p>

                <p style="color:rgba(255,255,255,0.7); font-family:'Cormorant Garamond',serif; font-size:16px; margin-bottom:20px; font-style:italic;">
                    Merupakan suatu kehormatan dan kebahagiaan bagi kami<br>
                    apabila Bapak/Ibu/Saudara/i berkenan hadir<br>
                    untuk memberikan doa restu kepada kami.
                </p>

                <p class="closing-hashtag">#RizkyDanAmeliya2026</p>

                <!-- Share Buttons -->
                <div style="display:flex; gap:12px; justify-content:center; flex-wrap:wrap; margin-bottom:40px;">
                    <a href="https://wa.me/?text=Undangan+Pernikahan+Rizky+%26+Ameliya+14+Juni+2026+{{ urlencode(url()->current()) }}"
                       target="_blank"
                       style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);color:white;text-decoration:none;padding:12px 24px;border-radius:50px;font-size:13px;letter-spacing:1px;transition:all 0.3s;"
                       onmouseover="this.style.background='rgba(255,255,255,0.25)'"
                       onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        <i class="fab fa-whatsapp"></i> Bagikan
                    </a>
                    <button 
                        onclick="copyLink()"
                        style="display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);color:white;padding:12px 24px;border-radius:50px;font-size:13px;letter-spacing:1px;cursor:pointer;transition:all 0.3s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.25)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        <i class="fas fa-link"></i> Salin Tautan
                    </button>
                </div>

                <p class="footer-credit">Made with 🌿 Love · {{ date('Y') }}</p>
            </div>
        </div>
    </section>

</div><!-- end #main-content -->

<!-- ============================================
     JAVASCRIPT
============================================ -->
<script>
    // ==========================================
    // CONFIG
    // ==========================================
    const WEDDING_DATE = new Date('2026-06-14T10:00:00+07:00');
    const GUEST_NAME   = '{{ request("to") ?? "Bapak/Ibu/Saudara/i" }}';

    // ==========================================
    // INIT
    // ==========================================
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('guestName').textContent = GUEST_NAME;
        createLeaves();
        createFireflies();
        createStars();
        startCountdown();
    });

    // ==========================================
    // GATE OPEN
    // ==========================================
    document.getElementById('openBtn').addEventListener('click', function () {
        const gate = document.getElementById('gate-page');
        const main = document.getElementById('main-content');
        const musicPlayer = document.getElementById('musicPlayer');
        const navDots = document.getElementById('navDots');

        gate.classList.add('closing');

        setTimeout(function () {
            gate.style.display = 'none';
            main.style.display = 'block';
            musicPlayer.style.display = 'flex';
            navDots.style.display = 'flex';

            requestAnimationFrame(function () {
                main.classList.add('visible');
            });

            // Auto-play music
            tryAutoPlay();
            
            // Init scroll animations
            initScrollAnimations();
            initNavDots();
            
        }, 1200);
    });

    // ==========================================
    // LEAVES ANIMATION
    // ==========================================
    function createLeaves() {
        const container = document.getElementById('leavesContainer');
        const leafPaths = [
            'M10,0 Q15,5 10,10 Q5,15 0,10 Q5,5 10,0Z',
            'M0,10 Q5,0 10,5 Q15,10 10,15 Q5,20 0,15 Q-5,10 0,10Z',
            'M5,0 Q12,3 10,10 Q8,17 3,15 Q-2,13 0,7 Q2,2 5,0Z',
            'M8,0 C14,2 16,8 12,13 C8,18 2,17 0,12 C-2,7 2,1 8,0Z',
        ];

        for (let i = 0; i < 18; i++) {
            setTimeout(function () {
                const leaf = document.createElement('div');
                leaf.className = 'falling-leaf';

                const size = Math.random() * 20 + 12;
                const path = leafPaths[Math.floor(Math.random() * leafPaths.length)];
                const duration = Math.random() * 8 + 6;
                const delay = Math.random() * 5;
                const colors = ['#8FAF8C', '#7A8C5C', '#B5CEB2', '#6B8F68', '#C4A882'];
                const color = colors[Math.floor(Math.random() * colors.length)];

                leaf.style.cssText = `
                    left: ${Math.random() * 100}%;
                    animation-duration: ${duration}s;
                    animation-delay: ${delay}s;
                `;

                leaf.innerHTML = `
                    <svg width="${size}" height="${size}" viewBox="0 0 16 20" xmlns="[w3.org](http://www.w3.org/2000/svg)">
                        <path d="${path}" fill="${color}" opacity="${0.5 + Math.random() * 0.4}"/>
                    </svg>
                `;

                container.appendChild(leaf);

                // Remove and re-add for continuous loop
                leaf.addEventListener('animationiteration', function () {
                    leaf.style.left = Math.random() * 100 + '%';
                });

            }, i * 300);
        }
    }

    // ==========================================
    // FIREFLIES
    // ==========================================
    function createFireflies() {
        const container = document.getElementById('fireflies');
        for (let i = 0; i < 15; i++) {
            const ff = document.createElement('div');
            ff.className = 'firefly';
            ff.style.cssText = `
                left: ${10 + Math.random() * 80}%;
                top: ${20 + Math.random() * 60}%;
                animation-duration: ${3 + Math.random() * 4}s;
                animation-delay: ${Math.random() * 5}s;
            `;
            container.appendChild(ff);
        }
    }

    // ==========================================
    // STARS
    // ==========================================
    function createStars() {
        const container = document.getElementById('stars');
        for (let i = 0; i < 60; i++) {
            const star = document.createElement('div');
            const size = Math.random() * 2 + 1;
            star.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                border-radius: 50%;
                background: white;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                opacity: ${0.3 + Math.random() * 0.7};
                animation: twinkle ${1.5 + Math.random() * 3}s ease-in-out infinite;
                animation-delay: ${Math.random() * 3}s;
            `;
            container.appendChild(star);
        }

        // Twinkle keyframe
        if (!document.getElementById('twinkle-style')) {
            const style = document.createElement('style');
            style.id = 'twinkle-style';
            style.textContent = `
                @keyframes twinkle {
                    0%, 100% { opacity: 0.2; transform: scale(1); }
                    50% { opacity: 1; transform: scale(1.4); }
                }
            `;
            document.head.appendChild(style);
        }
    }

    // ==========================================
    // COUNTDOWN
    // ==========================================
    function startCountdown() {
        function update() {
            const now  = new Date();
            const diff = WEDDING_DATE - now;

            if (diff <= 0) {
                document.getElementById('countdownGrid').innerHTML =
                    '<p class="countdown-passed">🎉 Hari Bahagia Telah Tiba! 🎉</p>';
                return;
            }

            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('cdDays').textContent    = String(d).padStart(2, '0');
            document.getElementById('cdHours').textContent   = String(h).padStart(2, '0');
            document.getElementById('cdMinutes').textContent = String(m).padStart(2, '0');
            document.getElementById('cdSeconds').textContent = String(s).padStart(2, '0');
        }

        update();
        setInterval(update, 1000);
    }

    // ==========================================
    // MUSIC PLAYER
    // ==========================================
    let isPlaying = false;

    function tryAutoPlay() {
        const audio = document.getElementById('bgMusic');
        const btn   = document.getElementById('musicBtn');

        audio.volume = 0.5;
        const playPromise = audio.play();

        if (playPromise !== undefined) {
            playPromise.then(function () {
                isPlaying = true;
                btn.classList.add('playing');
                btn.innerHTML = '<i class="fas fa-pause"></i>';
            }).catch(function () {
                isPlaying = false;
            });
        }
    }

    document.getElementById('musicBtn').addEventListener('click', function () {
        const audio = document.getElementById('bgMusic');
        const btn   = this;

        if (isPlaying) {
            audio.pause();
            btn.classList.remove('playing');
            btn.innerHTML = '<i class="fas fa-music"></i>';
            isPlaying = false;
        } else {
            audio.play();
            btn.classList.add('playing');
            btn.innerHTML = '<i class="fas fa-pause"></i>';
            isPlaying = true;
        }
    });

    // ==========================================
    // SCROLL ANIMATIONS
    // ==========================================
    function initScrollAnimations() {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.fade-up, .fade-left, .fade-right, .story-item').forEach(function (el) {
            observer.observe(el);
        });
    }

    // ==========================================
    // NAV DOTS
    // ==========================================
    function initNavDots() {
        const sections = ['hero', 'couple', 'countdown', 'story', 'gallery', 'rsvp'];
        const dots     = document.querySelectorAll('.nav-dot');

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    dots.forEach(function (d) {
                        d.classList.toggle('active', d.dataset.section === id);
                    });
                }
            });
        }, { threshold: 0.5 });

        sections.forEach(function (id) {
            const el = document.getElementById(id);
            if (el) observer.observe(el);
        });
    }

    function scrollToSection(id) {
        document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
    }

    // ==========================================
    // LIGHTBOX
    // ==========================================
    function openLightbox(item) {
        const img = item.querySelector('img');
        document.getElementById('lightboxImg').src = img.src;
        document.getElementById('lightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    document.getElementById('lightboxClose').addEventListener('click', closeLightbox);
    document.getElementById('lightbox').addEventListener('click', function (e) {
        if (e.target === this) closeLightbox();
    });

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
    });

    // ==========================================
    // RSVP FORM
    // ==========================================
    document.getElementById('attend-yes').addEventListener('change', function () {
        document.getElementById('guestCountGroup').style.display = 'block';
    });
    document.getElementById('attend-no').addEventListener('change', function () {
        document.getElementById('guestCountGroup').style.display = 'none';
    });

    function handleRSVP(e) {
        e.preventDefault();

        const form    = e.target;
        const btn     = form.querySelector('.submit-btn');
        const success = document.getElementById('rsvpSuccess');
        const wishWall = document.getElementById('wishesWall');

        btn.textContent = 'Mengirim...';
        btn.disabled    = true;

        // Simulate API call — replace with real fetch to your Laravel route
        setTimeout(function () {
            const name    = form.name.value;
            const message = form.message.value;

            // Add to wishes wall if message provided
            if (message.trim()) {
                const wish = document.createElement('div');
                wish.style.cssText = `
                    background: white;
                    border-radius: 16px;
                    padding: 20px;
                    box-shadow: 0 4px 15px var(--shadow);
                    border-left: 4px solid var(--sage);
                    animation: fadeIn 0.5s ease;
                `;
                wish.innerHTML = `
                    <p style="font-family:'Cormorant Garamond',serif; font-size:16px; color:var(--text-medium); font-style:italic; margin-bottom:10px;">
                        "${message}"
                    </p>
                    <p style="font-size:12px; color:var(--text-light); letter-spacing:1px;">— ${name}</p>
                `;
                wishWall.insertBefore(wish, wishWall.firstChild);
            }

            form.style.display    = 'none';
            success.style.display = 'block';

            showToast('Konfirmasi berhasil dikirim! 🌿');

        }, 1500);

        // Real implementation:
        // fetch('/rsvp', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        //     },
        //     body: JSON.stringify(Object.fromEntries(new FormData(form)))
        // })
        // .then(r => r.json())
        // .then(data => { ... })
        // .catch(err => { ... });
    }

    // ==========================================
    // TOAST
    // ==========================================
    function showToast(msg) {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.classList.add('show');
        setTimeout(function () { toast.classList.remove('show'); }, 3500);
    }

    // ==========================================
    // COPY LINK
    // ==========================================
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(function () {
            showToast('Tautan berhasil disalin! 🔗');
        }).catch(function () {
            showToast('Gagal menyalin tautan.');
        });
    }
</script>

</body>
</html>
