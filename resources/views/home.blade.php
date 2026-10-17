
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Serenity Yoga Studio | Find Your Balance</title>
    <meta name="description" content="Temukan keseimbangan tubuh dan pikiran bersama Serenity Yoga Studio. Pilih paket kredit dan jadwalkan kelas yoga favoritmu.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #f8f4ec;
            --cream-dark: #eee5d8;
            --paper: #fffdf8;
            --brown: #46372d;
            --brown-soft: #766456;
            --terracotta: #b86f50;
            --terracotta-dark: #96543b;
            --olive: #697454;
            --olive-light: #dce1d1;
            --line: #e8dfd2;
            --white: #ffffff;
            --shadow: 0 12px 35px rgba(70, 55, 45, 0.07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--brown);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, a {
            -webkit-tap-highlight-color: transparent;
        }

        button {
            font: inherit;
        }

        .container {
            width: min(1160px, 88%);
            margin: 0 auto;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--terracotta-dark);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.2px;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: '';
            width: 25px;
            height: 1px;
            background: currentColor;
        }

        .section-heading {
            max-width: 650px;
            margin-bottom: 34px;
        }

        .section-heading h2 {
            margin-top: 12px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(30px, 4vw, 43px);
            font-weight: 500;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .section-heading p {
            margin-top: 12px;
            color: var(--brown-soft);
            font-size: 14px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 48px;
            padding: 12px 23px;
            border: 1px solid transparent;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            transition: background .2s, transform .2s, border-color .2s;
            cursor: pointer;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            color: var(--white);
            background: var(--terracotta);
        }

        .btn-primary:hover {
            background: var(--terracotta-dark);
        }

        .btn-outline {
            color: var(--brown);
            border-color: #cfc2b2;
            background: transparent;
        }

        .btn-outline:hover {
            border-color: var(--terracotta);
            background: var(--paper);
        }

        .arrow {
            font-size: 17px;
            line-height: 1;
        }

        /* NAVBAR */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(248, 244, 236, .96);
            border-bottom: 1px solid rgba(232, 223, 210, .8);
            backdrop-filter: blur(12px);
        }

        .nav-inner {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            flex-shrink: 0;
        }

        .brand-mark {
            width: 39px;
            height: 39px;
            display: grid;
            place-items: center;
            color: var(--paper);
            background: var(--olive);
            border-radius: 50%;
        }

        .brand-name {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: 21px;
            font-weight: 600;
            line-height: 1.15;
        }

        .brand-caption {
            display: block;
            margin-top: 3px;
            color: var(--brown-soft);
            font-size: 9px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 29px;
        }

        .nav-links > a:not(.btn) {
            color: var(--brown-soft);
            font-size: 12px;
            font-weight: 500;
            transition: color .2s;
        }

        .nav-links > a:not(.btn):hover {
            color: var(--terracotta);
        }

        .nav-links .btn {
            min-height: 42px;
            padding: 10px 17px;
        }

        .menu-toggle {
            display: none;
            padding: 8px 12px;
            border: 1px solid var(--line);
            border-radius: 5px;
            color: var(--brown);
            background: var(--paper);
            cursor: pointer;
        }

        /* HERO */

        .hero {
            position: relative;
            overflow: hidden;
            padding: 75px 0 78px;
            background:
                radial-gradient(ellipse at 83% 35%, rgba(220, 225, 209, .6), transparent 35%),
                var(--cream);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.02fr .98fr;
            align-items: center;
            gap: 45px;
        }

        .hero-copy {
            position: relative;
            z-index: 2;
            padding: 10px 0;
        }

        .hero h1 {
            max-width: 590px;
            margin: 20px 0;
            font-family: 'Playfair Display', serif;
            font-size: clamp(43px, 5.5vw, 67px);
            font-weight: 500;
            line-height: 1.09;
            letter-spacing: -2px;
        }

        .hero h1 em {
            color: var(--terracotta);
            font-weight: 400;
        }

        .hero-description {
            max-width: 440px;
            color: var(--brown-soft);
            font-size: 14px;
            line-height: 1.9;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .hero-note {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 35px;
            color: var(--brown-soft);
            font-size: 11px;
        }

        .hero-note-icon {
            display: grid;
            place-items: center;
            width: 34px;
            height: 34px;
            border: 1px solid #d8cbb9;
            border-radius: 50%;
            color: var(--olive);
            font-size: 17px;
        }

        .hero-art {
            position: relative;
            min-width: 0;
        }

        .art-frame {
            position: relative;
            overflow: hidden;
            max-width: 490px;
            margin-left: auto;
            aspect-ratio: 4 / 4.3;
            border-radius: 48% 48% 5px 5px;
            background: #e7d5c2;
        }

        .art-frame svg {
            display: block;
            width: 100%;
            height: 100%;
        }

        .art-label {
            position: absolute;
            right: -12px;
            bottom: 35px;
            max-width: 190px;
            padding: 17px 21px;
            border: 1px solid var(--line);
            background: var(--paper);
            box-shadow: var(--shadow);
        }

        .art-label small {
            display: block;
            color: var(--terracotta);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .art-label strong {
            display: block;
            margin-top: 3px;
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 500;
        }

        /* VALUES */

        .values {
            padding: 25px 0;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            background: var(--paper);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        .value-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 13px;
            padding: 7px 15px;
        }

        .value-item + .value-item {
            border-left: 1px solid var(--line);
        }

        .value-icon {
            color: var(--olive);
            font-size: 22px;
        }

        .value-item strong {
            display: block;
            font-size: 12px;
            font-weight: 700;
        }

        .value-item span:last-child {
            display: block;
            color: var(--brown-soft);
            font-size: 10px;
        }

        /* PACKAGES */

        .packages-section {
            padding: 88px 0;
            background: var(--paper);
        }

        .section-topline {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 25px;
        }

        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 22px;
        }

        .package-card {
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 29px 25px;
            border: 1px solid var(--line);
            border-radius: 7px;
            background: var(--paper);
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }

        .package-card:hover {
            transform: translateY(-5px);
            border-color: #c7b5a2;
            box-shadow: var(--shadow);
        }

        .package-card.featured {
            border-color: var(--olive);
            background: #f1f0e7;
        }

        .package-tag {
            display: inline-block;
            align-self: flex-start;
            margin-bottom: 18px;
            padding: 5px 10px;
            border-radius: 3px;
            color: var(--olive);
            background: var(--olive-light);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .package-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            font-weight: 500;
        }

        .package-description {
            min-height: 45px;
            margin-top: 7px;
            color: var(--brown-soft);
            font-size: 12px;
        }

        .package-price {
            margin-top: 25px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(24px, 2.7vw, 32px);
            font-weight: 600;
            line-height: 1.25;
            overflow-wrap: anywhere;
        }

        .package-credit {
            margin-top: 9px;
            color: var(--olive);
            font-size: 12px;
            font-weight: 700;
        }

        .package-divider {
            margin: 24px 0;
            border: 0;
            border-top: 1px solid var(--line);
        }

        .package-features {
            display: grid;
            gap: 11px;
            margin-bottom: 25px;
            list-style: none;
            color: var(--brown-soft);
            font-size: 12px;
        }

        .package-features li::before {
            content: '✓';
            margin-right: 9px;
            color: var(--olive);
            font-weight: 700;
        }

        .package-card .btn {
            width: 100%;
            margin-top: auto;
        }

        .section-footnote {
            margin-top: 20px;
            color: var(--brown-soft);
            font-size: 11px;
        }

        /* CLASSES */

        .classes-section {
            padding: 88px 0;
            background: var(--cream);
        }

        .class-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .class-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 7px;
            background: var(--paper);
            transition: transform .2s, box-shadow .2s;
        }

        .class-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
        }

        .class-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 19px 21px;
            background: #e9e6d9;
        }

        .class-day {
            color: var(--olive);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .class-date {
            margin-top: 2px;
            font-family: 'Playfair Display', serif;
            font-size: 20px;
        }

        .class-time {
            flex-shrink: 0;
            padding: 7px 10px;
            border: 1px solid #d2d1bf;
            border-radius: 3px;
            color: var(--olive);
            font-size: 11px;
            font-weight: 600;
        }

        .class-card-body {
            padding: 22px;
        }

        .class-card-body h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 500;
        }

        .class-card-body > p {
            min-height: 45px;
            margin-top: 8px;
            color: var(--brown-soft);
            font-size: 12px;
        }

        .class-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin: 20px 0;
            padding-top: 15px;
            border-top: 1px solid var(--line);
            color: var(--brown-soft);
            font-size: 11px;
        }

        .class-meta strong {
            color: var(--brown);
        }

        .class-card-body .btn {
            width: 100%;
        }

        .empty-state {
            grid-column: 1 / -1;
            padding: 45px 25px;
            border: 1px dashed #cfc2b2;
            border-radius: 7px;
            text-align: center;
            color: var(--brown-soft);
        }

        .empty-state h3 {
            margin-bottom: 7px;
            color: var(--brown);
            font-family: 'Playfair Display', serif;
            font-size: 24px;
        }

        /* KALENDER */

        .kal-layout { display: grid; grid-template-columns: 1.1fr .9fr; gap: 22px; align-items: start; }
        .kal-panel { padding: 26px; border: 1px solid var(--line); border-radius: 8px; background: var(--paper); }
        .kal-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
        .kal-head h3, .kal-date { font-family: 'Playfair Display', serif; font-size: 23px; font-weight: 500; }
        .kal-nav { width: 38px; height: 38px; border: 1px solid var(--line); border-radius: 50%; background: transparent; color: var(--brown); font-size: 20px; line-height: 1; cursor: pointer; }
        .kal-nav:hover { border-color: var(--terracotta); }
        .kal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; }
        .kal-wd { padding-bottom: 4px; text-align: center; color: var(--brown-soft); font-size: 12px; }
        .kal-day { position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center; aspect-ratio: 1; border: 1px solid transparent; border-radius: 8px; background: transparent; color: var(--brown); font-size: 14px; cursor: pointer; }
        .kal-day:hover:not(:disabled) { border-color: var(--line); background: #fff; }
        .kal-day:disabled { color: #bdb2a6; cursor: default; }
        .kal-day.selected { background: var(--olive); color: #fff; }
        .kal-day.today { border-color: var(--terracotta); }
        .kal-day .dot { width: 6px; height: 6px; margin-top: 2px; border-radius: 50%; background: var(--terracotta); }
        .kal-day.selected .dot { background: #fff; }
        .kal-date { margin-bottom: 6px; }
        .kal-sess { padding: 16px 0; border-top: 1px solid var(--line); }
        .kal-sess:first-child { border-top: 0; }
        .kal-time { color: var(--olive); font-size: 13px; font-weight: 700; }
        .kal-sess h4 { font-family: 'Playfair Display', serif; font-size: 21px; font-weight: 500; }
        .kal-sess p { color: var(--brown-soft); font-size: 12px; }
        .kal-sess .kal-guru { color: var(--brown); font-weight: 600; }
        .kal-foot { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-top: 10px; font-size: 12px; color: var(--brown-soft); }
        .kal-foot .btn { min-height: 38px; padding: 7px 15px; }
        .kal-empty { padding: 26px 10px; border: 1px dashed #cfc2b2; border-radius: 7px; text-align: center; color: var(--brown-soft); font-size: 13px; }

        @media (max-width: 820px) { .kal-layout { grid-template-columns: 1fr; } }
        @media (max-width: 680px) { .kal-panel { padding: 18px; } }

        /* CTA */

        .cta-section {
            padding: 0 0 85px;
            background: var(--cream);
        }

        .cta-panel {
            position: relative;
            overflow: hidden;
            padding: 55px 30px;
            border-radius: 8px;
            color: var(--paper);
            background: var(--olive);
            text-align: center;
        }

        .cta-panel::before,
        .cta-panel::after {
            position: absolute;
            width: 180px;
            height: 180px;
            border: 1px solid rgba(255, 253, 248, .18);
            border-radius: 50%;
            content: '';
        }

        .cta-panel::before {
            top: -90px;
            left: -60px;
        }

        .cta-panel::after {
            right: -65px;
            bottom: -110px;
            width: 240px;
            height: 240px;
        }

        .cta-panel .eyebrow {
            color: #e5d6c4;
        }

        .cta-panel h2 {
            position: relative;
            z-index: 1;
            max-width: 570px;
            margin: 15px auto;
            font-family: 'Playfair Display', serif;
            font-size: clamp(31px, 4vw, 45px);
            font-weight: 500;
            line-height: 1.2;
        }

        .cta-panel p {
            position: relative;
            z-index: 1;
            max-width: 500px;
            margin: 0 auto 25px;
            color: #e3e3d7;
            font-size: 13px;
        }

        .cta-panel .btn {
            position: relative;
            z-index: 1;
            color: var(--brown);
            background: var(--paper);
        }

        .cta-panel .btn:hover {
            background: var(--cream-dark);
        }

        /* FOOTER */

        .footer {
            padding: 35px 0;
            border-top: 1px solid var(--line);
            background: var(--paper);
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-copy {
            color: var(--brown-soft);
            font-size: 11px;
        }

        .footer-links {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-links a {
            color: var(--brown-soft);
            font-size: 11px;
        }

        .footer-links a:hover {
            color: var(--terracotta);
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {
            .container {
                width: 90%;
            }

            .nav-links {
                gap: 17px;
            }

            .hero-grid {
                gap: 25px;
            }

            .hero h1 {
                font-size: clamp(39px, 6vw, 55px);
            }

            .package-grid,
            .class-grid {
                gap: 15px;
            }

            .package-card {
                padding: 23px 17px;
            }

            .class-card-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .class-card-body {
                padding: 18px;
            }
        }

        @media (max-width: 680px) {
            .nav-inner {
                min-height: 70px;
                flex-wrap: wrap;
            }

            .menu-toggle {
                display: inline-block;
            }

            .nav-links {
                display: none;
                flex-basis: 100%;
                align-items: stretch;
                flex-direction: column;
                gap: 0;
                padding: 0 0 16px;
            }

            .nav-links.is-open {
                display: flex;
            }

            .nav-links > a:not(.btn) {
                padding: 12px 0;
                border-top: 1px solid var(--line);
            }

            .nav-links .btn {
                margin-top: 10px;
            }

            .hero {
                padding: 48px 0 55px;
            }

            .hero-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .hero h1 {
                font-size: clamp(43px, 11vw, 59px);
                letter-spacing: -1.5px;
            }

            .hero-description {
                font-size: 13px;
            }

            .hero-art {
                width: 90%;
                margin: 0 auto;
            }

            .art-frame {
                max-width: none;
            }

            .art-label {
                right: -18px;
                bottom: 20px;
                max-width: 170px;
                padding: 13px 16px;
            }

            .values {
                padding: 12px 0;
            }

            .values-grid {
                grid-template-columns: 1fr;
            }

            .value-item {
                justify-content: flex-start;
                padding: 13px 4px;
            }

            .value-item + .value-item {
                border-top: 1px solid var(--line);
                border-left: 0;
            }

            .packages-section,
            .classes-section {
                padding: 62px 0;
            }

            .section-topline {
                align-items: flex-start;
                flex-direction: column;
                gap: 0;
            }

            .package-grid,
            .class-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .package-card {
                padding: 25px;
            }

            .package-description,
            .class-card-body > p {
                min-height: auto;
            }

            .class-card-top {
                flex-direction: row;
                align-items: center;
            }

            .class-card-body {
                padding: 22px;
            }

            .cta-section {
                padding-bottom: 60px;
            }

            .cta-panel {
                padding: 45px 22px;
            }

            .footer-inner {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *, *::before, *::after {
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>

    <!-- NAVIGATION -->
    <nav class="navbar">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand" aria-label="Serenity Yoga Studio - Beranda">
                <span class="brand-mark" aria-hidden="true">
                    <svg width="25" height="25" viewBox="0 0 24 24" fill="none">
                        <path d="M12 20V11M12 15C6 15 4 11 4 7C9 7 12 10 12 15ZM12 12C12 7 15 4 20 4C20 9 17 12 12 12Z"
                              stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span>
                    <span class="brand-name">Serenity</span>
                    <span class="brand-caption">Yoga Studio</span>
                </span>
            </a>

            <button class="menu-toggle" id="menuToggle"
                    type="button" aria-expanded="false" aria-controls="navLinks">
                Menu ☰
            </button>

            <div class="nav-links" id="navLinks">
                <a href="#tentang">Tentang Kami</a>
                <a href="#paket">Paket Kredit</a>
                <a href="{{ route('classes.index') }}">Jadwal Kelas</a>
                <a href="{{ route('history.index') }}">Riwayat</a>
                <a href="{{ route('purchases.index') }}" class="btn btn-primary">
                    Beli Paket <span class="arrow">↗</span>
                </a>
            </div>
        </div>
    </nav>

    <main>
        <!-- HERO -->
        <section class="hero" id="tentang">
            <div class="container hero-grid">
                <div class="hero-copy">
                    <span class="eyebrow">Your space to reconnect</span>

                    <h1>
                        Temukan tenangmu,<br>
                        <em>temukan dirimu.</em>
                    </h1>

                    <p class="hero-description">
                        Beri ruang untuk tubuh dan pikiranmu beristirahat.
                        Mulai perjalanan yoga yang lebih mindful bersama
                        komunitas yang mendukung keseimbangan hidupmu.
                    </p>

                    <div class="hero-actions">
                        <a href="#jadwal" class="btn btn-primary">
                            Jelajahi Kelas <span class="arrow">→</span>
                        </a>
                        <a href="#paket" class="btn btn-outline">
                            Lihat Paket Kredit
                        </a>
                    </div>

                    <div class="hero-note">
                        <span class="hero-note-icon" aria-hidden="true">✳</span>
                        <span>
                            <strong>Move gently. Live mindfully.</strong><br>
                            Satu langkah kecil menuju hidup yang lebih seimbang.
                        </span>
                    </div>
                </div>

                <!-- Ilustrasi yoga minimalis menggunakan SVG -->
                <div class="hero-art">
                    <div class="art-frame">
                        <svg viewBox="0 0 480 515" role="img"
                             aria-label="Ilustrasi minimalis seseorang bermeditasi di atas matras yoga"
                             xmlns="http://www.w3.org/2000/svg">

                            <rect width="480" height="515" fill="#E9D9C7"/>

                            <!-- Lingkaran latar -->
                            <circle cx="245" cy="218" r="165" fill="#D6BBA2"/>
                            <circle cx="245" cy="218" r="143" fill="#E8CEB5"/>

                            <!-- Matahari -->
                            <circle cx="370" cy="91" r="29" fill="#BD7857"/>
                            <path d="M370 48V39 M370 143V134 M327 91H318 M422 91H413"
                                  stroke="#BD7857" stroke-width="2" stroke-linecap="round"/>

                            <!-- Tanaman kiri -->
                            <path d="M64 380C72 322 63 274 43 238"
                                  stroke="#737B5A" stroke-width="4" fill="none" stroke-linecap="round"/>
                            <path d="M59 333C25 323 15 300 22 281C46 287 61 305 59 333Z"
                                  fill="#899173"/>
                            <path d="M63 297C92 280 97 254 86 235C65 251 57 273 63 297Z"
                                  fill="#697454"/>
                            <path d="M51 272C26 254 24 232 36 217C55 233 60 253 51 272Z"
                                  fill="#899173"/>

                            <!-- Pot tanaman -->
                            <path d="M38 375H85L78 431H46Z" fill="#B87555"/>
                            <ellipse cx="61.5" cy="375" rx="23.5" ry="6" fill="#CF9476"/>

                            <!-- Matras -->
                            <path d="M87 418L350 390L442 443L177 480Z" fill="#899173"/>
                            <path d="M87 418L350 390L442 443L177 480Z"
                                  fill="none" stroke="#697454" stroke-width="2"/>
                            <path d="M111 422L356 400"
                                  stroke="#B6BBA5" stroke-width="2" stroke-dasharray="4 8"/>

                            <!-- Bayangan tubuh -->
                            <ellipse cx="263" cy="413" rx="94" ry="20"
                                     fill="#A77B60" opacity=".24"/>

                            <!-- Kaki bersila -->
                            <path d="M248 341
                                     C220 357 177 365 157 386
                                     C145 399 163 414 184 407
                                     L255 385
                                     C274 380 293 386 310 395
                                     L345 412
                                     C363 420 379 402 360 388
                                     C339 372 300 350 276 341Z"
                                  fill="#A95F43"/>

                            <path d="M245 346
                                     C225 367 216 381 194 391
                                     C182 396 174 387 188 377
                                     L225 343Z"
                                  fill="#C37B5B"/>

                            <path d="M273 348
                                     C291 366 310 375 333 385
                                     C346 391 356 382 341 374
                                     L294 341Z"
                                  fill="#B76D4E"/>

                            <!-- Badan -->
                            <path d="M214 230
                                     C196 244 190 269 199 300
                                     L219 354
                                     C226 369 247 374 264 366
                                     L288 352
                                     C300 345 300 332 292 319
                                     L278 269
                                     C271 244 252 230 235 227Z"
                                  fill="#697454"/>

                            <!-- Detail pakaian -->
                            <path d="M217 246C237 258 260 258 280 246"
                                  stroke="#899173" stroke-width="3" fill="none"
                                  stroke-linecap="round"/>
                            <path d="M221 276L238 319"
                                  stroke="#899173" stroke-width="2" fill="none"
                                  stroke-linecap="round"/>

                            <!-- Leher -->
                            <path d="M227 211L227 239C234 249 250 249 258 238L256 209Z"
                                  fill="#C98B6A"/>

                            <!-- Kepala -->
                            <ellipse cx="241" cy="181" rx="39" ry="47"
                                     fill="#D49A77" transform="rotate(-7 241 181)"/>

                            <!-- Rambut -->
                            <path d="M202 179
                                     C193 144 213 119 243 120
                                     C271 120 283 143 278 171
                                     C273 157 263 151 251 147
                                     C238 163 222 170 202 179Z"
                                  fill="#46372D"/>

                            <path d="M204 164C197 182 202 202 213 214
                                     C205 188 216 171 230 159Z"
                                  fill="#46372D"/>

                            <!-- Gương mặt -->
                            <path d="M224 185Q230 190 236 185"
                                  stroke="#754B39" stroke-width="2"
                                  fill="none" stroke-linecap="round"/>
                            <path d="M249 182Q255 187 261 181"
                                  stroke="#754B39" stroke-width="2"
                                  fill="none" stroke-linecap="round"/>
                            <path d="M242 188L239 200L245 202"
                                  stroke="#B47758" stroke-width="1.5"
                                  fill="none" stroke-linecap="round"/>

                            <!-- Cánh tay trái -->
                            <path d="M211 244
                                     C192 255 175 273 157 289
                                     C148 297 144 311 154 319
                                     C164 326 174 315 181 307
                                     L225 272Z"
                                  fill="#D49A77"/>

                            <!-- Cánh tay phải -->
                            <path d="M277 246
                                     C295 254 312 273 329 290
                                     C340 301 338 313 328 319
                                     C317 325 308 312 301 305
                                     L267 273Z"
                                  fill="#D49A77"/>

                            <!-- Telapak tangan -->
                            <path d="M151 315Q144 319 145 326Q149 332 156 326L163 319Z"
                                  fill="#D49A77"/>
                            <path d="M329 315Q337 319 336 326Q331 333 325 326L318 319Z"
                                  fill="#D49A77"/>

                            <!-- Aksen dekoratif -->
                            <path d="M333 185C345 172 360 172 373 185"
                                  stroke="#B87D5B" stroke-width="2"
                                  fill="none" stroke-linecap="round"/>
                            <circle cx="103" cy="161" r="4" fill="#B87D5B"/>
                            <circle cx="125" cy="184" r="3" fill="#B87D5B"/>
                            <path d="M102 210L102 226M94 218H110"
                                  stroke="#B87D5B" stroke-width="2"
                                  stroke-linecap="round"/>

                            <!-- Tanah -->
                            <path d="M0 462Q120 445 230 466T480 455V515H0Z"
                                  fill="#D3B69A" opacity=".55"/>
                        </svg>
                    </div>

                    <div class="art-label">
                        <small>Your daily ritual</small>
                        <strong>Find your balance.</strong>
                    </div>
                </div>
            </div>
        </section>

        <!-- NILAI STUDIO -->
        <section class="values" aria-label="Keunggulan studio">
            <div class="container values-grid">
                <div class="value-item">
                    <span class="value-icon" aria-hidden="true">✳</span>
                    <div>
                        <strong>Ruang yang Menenangkan</strong>
                        <span>Luangkan waktu untuk dirimu</span>
                    </div>
                </div>

                <div class="value-item">
                    <span class="value-icon" aria-hidden="true">❋</span>
                    <div>
                        <strong>Berlatih Sesuai Ritmemu</strong>
                        <span>Pilih kelas sesuai kebutuhan</span>
                    </div>
                </div>

                <div class="value-item">
                    <span class="value-icon" aria-hidden="true">♡</span>
                    <div>
                        <strong>Lebih Mindful Setiap Hari</strong>
                        <span>Bangun kebiasaan yang sehat</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- PAKET KREDIT -->
        <section class="packages-section" id="paket">
            <div class="container">
                <div class="section-topline">
                    <div class="section-heading">
                        <span class="eyebrow">Choose your journey</span>
                        <h2>Investasi kecil untuk<br>dirimu yang lebih baik.</h2>
                        <p>
                            Pilih paket kredit yang sesuai dengan ritme latihanmu.
                            Semakin konsisten, semakin dekat dengan keseimbangan.
                        </p>
                    </div>
                </div>

                @php $featured = $packages->count() > 3 ? 2 : 1; @endphp
                <div class="package-grid">
                    @forelse ($packages as $index => $package)
                        <article class="package-card {{ $index === $featured ? 'featured' : '' }}">
                            @if ($index === $featured)
                                <span class="package-tag">Pilihan populer</span>
                            @elseif ($index === 0)
                                <span class="package-tag">Start your journey</span>
                            @else
                                <span class="package-tag">For your routine</span>
                            @endif

                            <h3>{{ $package->name }}</h3>

                            <p class="package-description">
                                {{ $package->description ?: 'Temukan ritme latihan yoga yang sesuai untukmu.' }}
                            </p>

                            <div class="package-price">
                                Rp{{ number_format($package->price, 0, ',', '.') }}
                            </div>

                            <p class="package-credit">
                                {{ $package->credits }} kredit kelas
                            </p>

                            <hr class="package-divider">

                            <ul class="package-features">
                                <li>Kredit untuk booking kelas</li>
                                <li>Pilihan jadwal yang tersedia</li>
                                <li>Pantau riwayat booking</li>
                            </ul>

                            <a href="{{ route('purchases.index') }}" class="btn {{ $index === $featured ? 'btn-primary' : 'btn-outline' }}">
                                Pilih Paket <span class="arrow">→</span>
                            </a>
                        </article>
                    @empty
                        <div class="empty-state">
                            <h3>Paket sedang disiapkan</h3>
                            <p>Belum ada paket kredit yang tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>

                <p class="section-footnote">
                    * Harga dan jumlah kredit ditampilkan sesuai data paket yang tersimpan di database.
                </p>
            </div>
        </section>

        <!-- JADWAL KELAS (KALENDER) -->
        <section class="classes-section" id="jadwal">
            <div class="container">
                <div class="section-heading">
                    <span class="eyebrow">Move at your own pace</span>
                    <h2>Temukan kelas yang<br>cocok untukmu.</h2>
                    <p>Pilih tanggal di kalender untuk melihat kelas yang tersedia. Titik menandakan ada kelas di hari itu.</p>
                </div>

                <div class="kal-layout">
                    <div class="kal-panel">
                        <div class="kal-head">
                            <button type="button" class="kal-nav" id="kalPrev" aria-label="Bulan sebelumnya">‹</button>
                            <h3 id="kalTitle"></h3>
                            <button type="button" class="kal-nav" id="kalNext" aria-label="Bulan berikutnya">›</button>
                        </div>
                        <div class="kal-grid" id="kalGrid"></div>
                    </div>

                    <div class="kal-panel" aria-live="polite">
                        <h3 class="kal-date" id="kalDate"></h3>
                        <div id="kalList"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CALL TO ACTION -->
        <section class="cta-section" id="mulai">
            <div class="container">
                <div class="cta-panel">
                    <span class="eyebrow">A little time for yourself</span>

                    <h2>Mulai dari satu tarikan napas.</h2>

                    <p>
                        Tidak harus sempurna untuk memulai.
                        Luangkan waktu untuk bergerak, bernapas,
                        dan kembali terhubung dengan dirimu.
                    </p>

                    <a href="{{ route('purchases.index') }}" class="btn">
                        Temukan Paketmu <span class="arrow">↗</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container footer-inner">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark" aria-hidden="true">
                    <svg width="23" height="23" viewBox="0 0 24 24" fill="none">
                        <path d="M12 20V11M12 15C6 15 4 11 4 7C9 7 12 10 12 15ZM12 12C12 7 15 4 20 4C20 9 17 12 12 12Z"
                              stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span>
                    <span class="brand-name">Serenity</span>
                    <span class="brand-caption">Yoga Studio</span>
                </span>
            </a>

            <p class="footer-copy">
                © {{ date('Y') }} Serenity Yoga Studio. Find your balance.
            </p>

            <div class="footer-links">
                <a href="#tentang">Tentang</a>
                <a href="#paket">Paket</a>
                <a href="#jadwal">Jadwal</a>
            </div>
        </div>
    </footer>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');

        menuToggle.addEventListener('click', function () {
            const isOpen = navLinks.classList.toggle('is-open');

            menuToggle.setAttribute('aria-expanded', String(isOpen));
            menuToggle.textContent = isOpen ? 'Tutup ✕' : 'Menu ☰';
        });

        navLinks.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                navLinks.classList.remove('is-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.textContent = 'Menu ☰';
            });
        });
    </script>

@php
    $calendarData = $classes->map(function ($c) {
        return [
            'id' => $c->id,
            'name' => $c->name,
            'date' => substr($c->class_date, 0, 10),
            'start' => substr($c->start_time, 0, 5),
            'end' => substr($c->end_time, 0, 5),
            'cap' => $c->capacity,
            'desc' => $c->description,
            'instructor' => $c->instructor ?? null,
        ];
    })->values();
    $bookUrl = route('bookings.create', ['classId' => '__ID__']);
@endphp
    <script>
        (function () {
            const classes = @json($calendarData);
            const bookUrl = @json($bookUrl);
            const MON = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            const DAY = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const iso = d => d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
            const todayIso = iso(new Date());

            const byDate = {};
            classes.forEach(c => (byDate[c.date] = byDate[c.date] || []).push(c));

            let sel = Object.keys(byDate).filter(d => d >= todayIso).sort()[0] || null;
            let cur = sel ? new Date(sel + 'T00:00:00') : new Date();
            cur.setDate(1);

            const grid = document.getElementById('kalGrid');
            const title = document.getElementById('kalTitle');
            const dateEl = document.getElementById('kalDate');
            const list = document.getElementById('kalList');

            function el(tag, cls, text) {
                const e = document.createElement(tag);
                if (cls) e.className = cls;
                if (text !== undefined) e.textContent = text;
                return e;
            }

            function renderGrid() {
                grid.innerHTML = '';
                title.textContent = MON[cur.getMonth()] + ' ' + cur.getFullYear();
                ['Sen','Sel','Rab','Kam','Jum','Sab','Min'].forEach(d => grid.appendChild(el('div', 'kal-wd', d)));
                const offset = (cur.getDay() + 6) % 7;
                for (let i = 0; i < offset; i++) grid.appendChild(el('div'));
                const days = new Date(cur.getFullYear(), cur.getMonth() + 1, 0).getDate();
                for (let n = 1; n <= days; n++) {
                    const key = iso(new Date(cur.getFullYear(), cur.getMonth(), n));
                    const b = el('button', 'kal-day' + (key === sel ? ' selected' : '') + (key === todayIso ? ' today' : ''), String(n));
                    b.type = 'button';
                    b.disabled = key < todayIso;
                    if (byDate[key]) b.appendChild(el('span', 'dot'));
                    b.addEventListener('click', () => { sel = key; renderGrid(); renderList(); });
                    grid.appendChild(b);
                }
            }

            function renderList() {
                list.innerHTML = '';
                if (!sel) {
                    dateEl.textContent = 'Belum ada kelas';
                    list.appendChild(el('div', 'kal-empty', 'Jadwal baru segera hadir. Silakan cek kembali nanti.'));
                    return;
                }
                const d = new Date(sel + 'T00:00:00');
                dateEl.textContent = DAY[d.getDay()] + ', ' + d.getDate() + ' ' + MON[d.getMonth()] + ' ' + d.getFullYear();
                const items = byDate[sel] || [];
                if (!items.length) {
                    list.appendChild(el('div', 'kal-empty', 'Tidak ada kelas di tanggal ini. Pilih tanggal yang bertanda titik.'));
                    return;
                }
                items.forEach(c => {
                    const row = el('div', 'kal-sess');
                    row.appendChild(el('div', 'kal-time', c.start + ' – ' + c.end));
                    row.appendChild(el('h4', '', c.name));
                    if (c.instructor) row.appendChild(el('p', 'kal-guru', 'Guru: ' + c.instructor));
                    row.appendChild(el('p', '', c.desc || 'Sesi yoga untuk membantu tubuh lebih rileks dan seimbang.'));
                    const foot = el('div', 'kal-foot');
                    foot.appendChild(el('span', '', 'Kapasitas ' + c.cap + ' peserta'));
                    if (new Date(c.date + 'T' + c.start + ':00') > new Date()) {
                        const a = el('a', 'btn btn-primary', 'Booking · 1 kredit');
                        a.href = bookUrl.replace('__ID__', c.id);
                        foot.appendChild(a);
                    } else {
                        foot.appendChild(el('span', '', 'Sudah lewat'));
                    }
                    row.appendChild(foot);
                    list.appendChild(row);
                });
            }

            document.getElementById('kalPrev').addEventListener('click', () => { cur.setMonth(cur.getMonth() - 1); renderGrid(); });
            document.getElementById('kalNext').addEventListener('click', () => { cur.setMonth(cur.getMonth() + 1); renderGrid(); });
            renderGrid(); renderList();
        })();
    </script>

</body>
</html>
