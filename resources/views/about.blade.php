<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Who We Are - {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --green: #087348;
            --green-dark: #063f2e;
            --green-soft: #f4fbf7;
            --gold: #d99b2b;
            --coral: #c9543d;
            --line: #d9ebe2;
            --muted: #2f6e58;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--green-dark);
            font-family: 'Quicksand', Arial, Helvetica, sans-serif;
            font-size: 18px;
            background: var(--white);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 10px clamp(18px, 5vw, 76px);
            color: rgba(255, 255, 255, .92);
            background: var(--green-dark);
            font-size: 13px;
            font-weight: 700;
        }

        .contact-list,
        .top-group {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .top-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 24px;
        }

        .top-icon {
            width: 16px;
            height: 16px;
            flex: 0 0 16px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .volunteer-button {
            min-height: 36px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, .9);
            background: transparent;
            color: var(--white);
            font-weight: 900;
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 20;
            display: grid;
            grid-template-columns: minmax(180px, 1fr) auto minmax(180px, 1fr);
            align-items: center;
            gap: 28px;
            padding: 12px clamp(18px, 5vw, 76px);
            border-bottom: 1px solid rgba(6, 63, 46, .1);
            background: var(--white);
        }

        .brand {
            display: inline-flex;
            justify-self: start;
        }

        .brand-mark {
            width: auto;
            max-width: 260px;
            height: 82px;
            object-fit: contain;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: center;
            justify-self: center;
            gap: clamp(14px, 2.5vw, 30px);
            color: var(--muted);
            font-size: 15px;
            font-weight: 800;
        }

        .nav-item {
            position: relative;
        }

        .nav-item.has-submenu > a {
            gap: 6px;
        }

        .nav-item.has-submenu > a::after {
            width: 7px;
            height: 7px;
            content: "";
            border-right: 2px solid currentColor;
            border-bottom: 2px solid currentColor;
            transform: rotate(45deg) translateY(-2px);
        }

        .nav a {
            display: inline-flex;
            align-items: center;
            min-height: 42px;
            padding: 10px 0;
        }

        .nav a:hover,
        .nav a.is-active {
            color: var(--green);
        }

        .nav .donate-link a {
            min-height: 42px;
            padding: 0 18px;
            background: var(--green);
            color: var(--white);
        }

        .submenu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 30;
            display: grid;
            min-width: 220px;
            padding: 10px 8px 8px;
            border: 1px solid var(--line);
            background: var(--white);
            box-shadow: 0 18px 42px rgba(6, 63, 46, .13);
            opacity: 0;
            pointer-events: none;
            transform: translateY(6px);
            transition: opacity .18s ease, transform .18s ease;
        }

        .nav-item:hover .submenu,
        .nav-item:focus-within .submenu {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .submenu a {
            min-height: 40px;
            padding: 0 12px;
            color: var(--muted);
            white-space: nowrap;
        }

        .submenu a:hover,
        .submenu a.is-active {
            color: var(--white);
            background: var(--green);
        }

        .about-hero {
            position: relative;
            overflow: hidden;
            padding: clamp(82px, 11vw, 132px) clamp(18px, 5vw, 76px);
            color: var(--white);
            background:
                linear-gradient(135deg, rgba(6, 63, 46, .98), rgba(8, 115, 72, .88)),
                radial-gradient(circle at 82% 14%, rgba(255, 255, 255, .2), transparent 34%);
        }

        .about-hero::after {
            position: absolute;
            right: clamp(18px, 8vw, 130px);
            bottom: -110px;
            width: 330px;
            height: 330px;
            content: "";
            border: 34px solid rgba(255, 255, 255, .08);
            border-radius: 999px;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            max-width: 960px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, .82);
            font-size: 18px;
            font-weight: 800;
        }

        .breadcrumb a {
            color: var(--white);
        }

        .breadcrumb span {
            opacity: .72;
        }

        .about-hero h1 {
            margin: 0;
            font-size: clamp(46px, 7vw, 78px);
            line-height: 1.04;
            font-weight: 800;
        }

        .about-body {
            padding: clamp(56px, 7vw, 92px) clamp(18px, 5vw, 76px);
            background: linear-gradient(180deg, var(--white), var(--green-soft));
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
            max-width: 1180px;
            margin: 0 auto;
        }

        .about-card {
            position: relative;
            overflow: hidden;
            padding: clamp(26px, 4vw, 42px);
            border: 1px solid var(--line);
            background: var(--white);
            box-shadow: 0 22px 58px rgba(6, 63, 46, .08);
        }

        .about-card::before {
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            content: "";
            background: rgba(8, 115, 72, .08);
            transform: translate(42px, -42px);
        }

        .about-card h2 {
            position: relative;
            margin: 0 0 20px;
            color: var(--green);
            font-size: 46px;
            line-height: 1.1;
            font-weight: 800;
        }

        .about-card p {
            position: relative;
            margin: 0;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.75;
        }

        .about-card p + p {
            margin-top: 16px;
        }

        .mission-card {
            grid-row: span 2;
        }

        .motto-card {
            display: grid;
            align-content: center;
            min-height: 230px;
            background: var(--green);
            color: var(--white);
        }

        .motto-card h2,
        .motto-card p {
            color: var(--white);
        }

        .motto-card p {
            font-size: 30px;
            font-weight: 800;
            line-height: 1.25;
        }

        .values-section {
            padding: clamp(58px, 7vw, 96px) clamp(18px, 5vw, 76px);
            background:
                linear-gradient(180deg, var(--green-soft), var(--white) 62%),
                var(--white);
        }

        .values-inner {
            max-width: 1180px;
            margin: 0 auto;
        }

        .values-heading {
            display: grid;
            grid-template-columns: minmax(0, .82fr) minmax(280px, .48fr);
            gap: clamp(24px, 5vw, 62px);
            align-items: end;
            margin-bottom: clamp(28px, 5vw, 48px);
        }

        .values-kicker {
            display: inline-flex;
            width: max-content;
            min-height: 34px;
            align-items: center;
            padding: 0 13px;
            margin-bottom: 14px;
            color: var(--green);
            background: rgba(8, 115, 72, .1);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .values-heading h2 {
            margin: 0;
            color: var(--green-dark);
            font-size: clamp(36px, 5vw, 58px);
            line-height: 1.05;
            font-weight: 800;
        }

        .values-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.7;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            border-top: 1px solid var(--line);
            border-left: 1px solid var(--line);
            background: var(--white);
            box-shadow: 0 22px 58px rgba(6, 63, 46, .08);
        }

        .value-card {
            min-height: 250px;
            padding: 24px;
            border-right: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            background: var(--white);
        }

        .value-number {
            display: inline-flex;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: var(--white);
            background: var(--green);
            font-size: 13px;
            font-weight: 900;
            border-radius: 50%;
        }

        .value-card:nth-child(3n + 2) .value-number {
            background: var(--gold);
        }

        .value-card:nth-child(3n) .value-number {
            background: var(--coral);
        }

        .value-card h3 {
            margin: 0 0 12px;
            color: var(--green-dark);
            font-size: 24px;
            line-height: 1.2;
        }

        .value-card p {
            margin: 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.65;
        }

        .commitment-card {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 24px;
            align-items: center;
            margin-top: 24px;
            padding: clamp(26px, 4vw, 42px);
            color: var(--white);
            background: var(--green-dark);
        }

        .commitment-card h3 {
            margin: 0 0 12px;
            color: var(--white);
            font-size: clamp(28px, 4vw, 42px);
        }

        .commitment-card p {
            margin: 0;
            max-width: 820px;
            color: rgba(255, 255, 255, .84);
            line-height: 1.7;
        }

        .commitment-motto {
            display: inline-flex;
            min-height: 52px;
            align-items: center;
            padding: 0 18px;
            color: var(--green-dark);
            background: var(--white);
            font-size: 16px;
            font-weight: 900;
            white-space: nowrap;
        }

        .site-footer {
            color: rgba(255, 255, 255, .84);
            background: var(--green-dark);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.2fr repeat(3, 1fr);
            gap: clamp(24px, 4vw, 44px);
            padding: 58px clamp(18px, 5vw, 76px) 44px;
        }

        .footer-logo {
            width: auto;
            max-width: 190px;
            height: 56px;
            object-fit: contain;
        }

        .footer-col h3 {
            margin: 0 0 18px;
            color: var(--white);
            font-size: 24px;
        }

        .footer-col p {
            max-width: 360px;
            margin: 18px 0 0;
            line-height: 1.65;
        }

        .footer-links,
        .footer-contact {
            display: grid;
            gap: 11px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-links a,
        .footer-contact a {
            color: rgba(255, 255, 255, .78);
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px clamp(18px, 5vw, 76px);
            border-top: 1px solid rgba(255, 255, 255, .14);
            color: rgba(255, 255, 255, .66);
            font-size: 14px;
        }

        .footer-bottom-links {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        @media (max-width: 920px) {
            .site-header {
                align-items: flex-start;
                display: flex;
                flex-direction: column;
            }

            .nav {
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .cards-grid,
            .values-heading,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .values-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .commitment-card {
                grid-template-columns: 1fr;
            }

            .mission-card {
                grid-row: auto;
            }
        }

        @media (max-width: 640px) {
            .top-bar,
            .top-group {
                align-items: flex-start;
                flex-direction: column;
            }

            .about-card h2 {
                font-size: 38px;
            }

            .values-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                align-items: flex-start;
                flex-direction: column;
            }
        }
        @include('partials.public-mobile-css')
    </style>
</head>
<body>
    <div class="top-bar" aria-label="Organisation contact information">
        <div class="contact-list">
            <a class="top-link" href="tel:{{ $settings['phone_href'] }}">
                <svg class="top-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.62 2.61a2 2 0 0 1-.45 2.11L8 9.72a16 16 0 0 0 6.28 6.28l1.28-1.28a2 2 0 0 1 2.11-.45c.84.29 1.71.5 2.61.62A2 2 0 0 1 22 16.92z"/></svg>
                <span>{{ $settings['phone_label'] }}</span>
            </a>
            <a class="top-link" href="mailto:{{ $settings['email'] }}">
                <svg class="top-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16v16H4z"/><path d="m22 6-10 7L2 6"/></svg>
                <span>{{ $settings['email'] }}</span>
            </a>
            <a class="top-link" href="/#contact">
                <svg class="top-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0z"/><path d="M12 10h.01"/></svg>
                <span>{{ $settings['location_label'] }}</span>
            </a>
            <a class="top-link volunteer-button" href="/#contact">
                <svg class="top-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M19 8v6"/><path d="M22 11h-6"/></svg>
                <span>{{ $settings['volunteer_label'] }}</span>
            </a>
        </div>
        <div class="top-group">
            <span>Registration No: {{ $settings['registration_number'] }}</span>
        </div>
    </div>

    <header class="site-header">
        <a class="brand" href="/">
            @if ($settings['logo_image'])
                <img class="brand-mark" src="{{ $settings['logo_image'] }}" alt="{{ $settings['logo_name'] }} logo">
            @endif
        </a>
        <nav class="nav" aria-label="Main navigation">
            @foreach ($settings['menus'] as $menu)
                @php
                    $url = str_starts_with($menu['url'], '#') ? '/' . $menu['url'] : $menu['url'];
                @endphp
                @php $hasChildren = ! empty($menu['children']); @endphp
                <div class="nav-item {{ $hasChildren ? 'has-submenu' : '' }} {{ $menu['highlight'] ? 'donate-link' : '' }}">
                    <a class="{{ $url === '/about' ? 'is-active' : '' }}" href="{{ $url }}" @if ($hasChildren) aria-haspopup="true" aria-expanded="false" @endif>{{ $menu['label'] }}</a>
                    @if (! empty($menu['children']))
                        <div class="submenu">
                            @foreach ($menu['children'] as $child)
                                @php $childUrl = str_starts_with($child['url'], '#') ? '/' . $child['url'] : $child['url']; @endphp
                                <a class="{{ $childUrl === '/about' ? 'is-active' : '' }}" href="{{ $childUrl }}">{{ $child['label'] }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </nav>
    </header>

    <main>
        <section class="about-hero" aria-label="About page hero">
            <div class="hero-inner">
                <nav class="breadcrumb" aria-label="Sitemap">
                    <a href="/">Home</a>
                    <span>/</span>
            <span>Who We Are</span>
                </nav>
                <h1>Who We Are</h1>
            </div>
        </section>

        <section class="about-body" aria-label="Nicoville vision mission and motto">
            <div class="cards-grid">
                <article class="about-card">
                    <h2>{{ $pageContent['about']['vision_title'] }}</h2>
                    @foreach ($pageContent['about']['vision'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </article>

                <article class="about-card mission-card">
                    <h2>{{ $pageContent['about']['mission_title'] }}</h2>
                    @foreach ($pageContent['about']['mission'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </article>

                <article class="about-card motto-card">
                    <h2>{{ $pageContent['about']['motto_title'] }}</h2>
                    <p>{{ $pageContent['about']['motto'] }}</p>
                </article>
            </div>
        </section>

        <section class="values-section" aria-label="Nicoville Foundation core values">
            <div class="values-inner">
                <div class="values-heading">
                    <div>
                        <span class="values-kicker">Core Values</span>
                        <h2>{{ $pageContent['about']['core_values_title'] }}</h2>
                    </div>
                    <p>{{ $pageContent['about']['core_values_intro'] }}</p>
                </div>

                <div class="values-grid">
                    @foreach ($pageContent['about']['core_values'] as $index => $value)
                        <article class="value-card">
                            <span class="value-number">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <h3>{{ $value['title'] }}</h3>
                            <p>{{ $value['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <article class="commitment-card">
                    <div>
                        <h3>{{ $pageContent['about']['commitment_title'] }}</h3>
                        <p>{{ $pageContent['about']['commitment'] }}</p>
                    </div>
                    <span class="commitment-motto">{{ $pageContent['about']['motto_title'] }}: {{ $pageContent['about']['motto'] }}</span>
                </article>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="footer-grid">
            <div class="footer-col">
                <a href="/">
                    @if ($settings['logo_image'])
                        <img class="footer-logo" src="{{ $settings['logo_image'] }}" alt="{{ $settings['logo_name'] }} logo">
                    @endif
                </a>
                <p>Nicoville supports vulnerable families through transparent relief, education, health care, and community-led development programmes.</p>
            </div>

            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    @foreach ($settings['menus'] as $menu)
                        @php
                            $url = str_starts_with($menu['url'], '#') ? '/' . $menu['url'] : $menu['url'];
                        @endphp
                        <li><a href="{{ $url }}">{{ $menu['label'] }}</a></li>
                        @foreach ($menu['children'] ?? [] as $child)
                            <li><a href="{{ $child['url'] }}">{{ $child['label'] }}</a></li>
                        @endforeach
                    @endforeach
                </ul>
            </div>

            <div class="footer-col">
                <h3>Support</h3>
                <ul class="footer-links">
                    <li><a href="/#donate">Make a Donation</a></li>
                    <li><a href="/#donate">Sponsor Support</a></li>
                    <li><a href="/#contact">Become a Volunteer</a></li>
                    <li><a href="/#contact">Partner With Us</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Contact</h3>
                <ul class="footer-contact">
                    <li><a href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a></li>
                    <li><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></li>
                    <li>{{ $settings['location_label'] }}</li>
                    <li>Mon - Fri: 8:00 AM - 5:00 PM</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}. All rights reserved.</span>
            <div class="footer-bottom-links">
                <a href="/#contact">Privacy Policy</a>
                <a href="/#contact">Transparency</a>
                <a href="/#donate">Give Support</a>
            </div>
        </div>
    </footer>
    @include('partials.public-mobile-scripts')
</body>
</html>
