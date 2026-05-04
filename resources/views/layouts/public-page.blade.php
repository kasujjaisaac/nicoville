<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --green:#087348; --green-dark:#063f2e; --soft:#f4fbf7; --line:#d9ebe2; --muted:#2f6e58; --white:#fff; }
        * { box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body { margin:0; color:var(--green-dark); font-family:'Quicksand',Arial,sans-serif; font-size:18px; background:var(--white); }
        a { color:inherit; text-decoration:none; }
        button,input,select,textarea { font:inherit; }
        .top-bar { display:flex; align-items:center; justify-content:space-between; gap:18px; padding:10px clamp(18px,5vw,76px); color:rgba(255,255,255,.92); background:var(--green-dark); font-size:13px; font-weight:700; }
        .contact-list,.top-group { display:flex; align-items:center; flex-wrap:wrap; gap:14px; }
        .top-link { display:inline-flex; align-items:center; min-height:24px; }
        .volunteer-button { min-height:36px; padding:8px 16px; border:1px solid rgba(255,255,255,.9); background:transparent; color:var(--white); font-weight:900; }
        .site-header { position:sticky; top:0; z-index:20; display:grid; grid-template-columns:minmax(180px,1fr) auto minmax(180px,1fr); align-items:center; gap:28px; padding:12px clamp(18px,5vw,76px); border-bottom:1px solid rgba(6,63,46,.1); background:var(--white); }
        .brand { display:inline-flex; justify-self:start; }
        .brand-mark { width:auto; max-width:260px; height:82px; object-fit:contain; }
        .nav { display:flex; align-items:center; justify-content:center; justify-self:center; gap:clamp(14px,2.5vw,30px); color:var(--muted); font-size:15px; font-weight:800; }
        .nav a { display:inline-flex; align-items:center; min-height:42px; padding:10px 0; }
        .nav a:hover,.nav a.is-active { color:var(--green); }
        .nav .donate-link a { min-height:42px; padding:0 18px; background:var(--green); color:var(--white); }
        .page-hero { position:relative; overflow:hidden; padding:clamp(78px,10vw,124px) clamp(18px,5vw,76px); color:var(--white); background:linear-gradient(135deg,rgba(6,63,46,.98),rgba(8,115,72,.88)); }
        .page-hero::after { position:absolute; right:8vw; bottom:-120px; width:330px; height:330px; content:""; border:34px solid rgba(255,255,255,.08); border-radius:999px; }
        .hero-inner { position:relative; z-index:1; max-width:980px; }
        .breadcrumb { display:flex; gap:10px; flex-wrap:wrap; margin-bottom:18px; color:rgba(255,255,255,.82); font-weight:800; }
        .breadcrumb a { color:var(--white); }
        h1 { margin:0; font-size:clamp(46px,7vw,76px); line-height:1.04; font-weight:800; }
        h2 { margin:0; font-size:46px; line-height:1.1; font-weight:800; }
        h3 { margin:0; font-size:24px; line-height:1.25; font-weight:800; }
        p { font-size:18px; line-height:1.65; }
        .section { padding:clamp(56px,7vw,92px) clamp(18px,5vw,76px); background:linear-gradient(180deg,var(--white),var(--soft)); }
        .section.plain { background:var(--white); }
        .section-head { max-width:880px; margin:0 auto 38px; text-align:center; }
        .section-head p { margin:12px 0 0; color:var(--muted); }
        .grid-2 { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:24px; max-width:1180px; margin:0 auto; }
        .grid-3 { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:24px; max-width:1180px; margin:0 auto; }
        .panel { border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
        .panel-pad { padding:clamp(24px,4vw,36px); }
        .image-wrap { position:relative; overflow:hidden; min-height:260px; background:var(--line); }
        .image-wrap img { width:100%; height:100%; min-height:260px; object-fit:cover; }
        .tag { display:inline-flex; min-height:34px; align-items:center; padding:0 12px; border:1px solid var(--green); color:var(--green); font-size:13px; font-weight:900; text-transform:uppercase; }
        .image-tag { position:absolute; top:16px; left:16px; border-color:rgba(255,255,255,.85); background:rgba(6,63,46,.26); color:var(--white); backdrop-filter:blur(8px); }
        .button { display:inline-flex; align-items:center; justify-content:center; min-height:52px; border:1px solid var(--green); padding:0 22px; background:var(--green); color:var(--white); font-weight:900; text-transform:uppercase; cursor:pointer; }
        .button.outline { background:transparent; color:var(--green); }
        .form-card { display:grid; gap:16px; max-width:920px; margin:0 auto; padding:clamp(24px,4vw,36px); border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
        .form-row { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:16px; }
        label { display:grid; gap:8px; color:var(--muted); font-size:13px; font-weight:900; text-transform:uppercase; }
        input,select,textarea { width:100%; min-height:52px; border:1px solid var(--line); padding:0 14px; color:var(--green-dark); background:#fbfffc; outline:0; }
        textarea { min-height:150px; padding-top:14px; resize:vertical; }
        .site-footer { color:rgba(255,255,255,.84); background:var(--green-dark); }
        .footer-grid { display:grid; grid-template-columns:1.2fr repeat(3,1fr); gap:clamp(24px,4vw,44px); padding:58px clamp(18px,5vw,76px) 44px; }
        .footer-logo { width:auto; max-width:190px; height:56px; object-fit:contain; }
        .footer-col h3 { margin:0 0 18px; color:var(--white); font-size:24px; }
        .footer-col p { max-width:360px; margin:18px 0 0; color:rgba(255,255,255,.78); }
        .footer-links,.footer-contact { display:grid; gap:11px; margin:0; padding:0; list-style:none; }
        .footer-links a,.footer-contact a { color:rgba(255,255,255,.78); }
        .footer-bottom { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:18px clamp(18px,5vw,76px); border-top:1px solid rgba(255,255,255,.14); color:rgba(255,255,255,.66); font-size:14px; }
        .footer-bottom-links { display:flex; flex-wrap:wrap; gap:16px; }
        @yield('page_css')
        @media (max-width:980px){ .site-header{display:flex; flex-direction:column; align-items:flex-start;} .nav{justify-content:flex-start; flex-wrap:wrap;} .grid-2,.grid-3,.footer-grid{grid-template-columns:1fr;} }
        @media (max-width:640px){ .top-bar,.top-group{align-items:flex-start; flex-direction:column;} h2{font-size:38px;} .form-row{grid-template-columns:1fr;} .footer-bottom{align-items:flex-start; flex-direction:column;} }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="contact-list">
            <a class="top-link" href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a>
            <a class="top-link" href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
            <a class="top-link" href="/contact">{{ $settings['location_label'] }}</a>
            <a class="top-link volunteer-button" href="/contact">{{ $settings['volunteer_label'] }}</a>
        </div>
        <div class="top-group"><span>{{ $settings['logo_tagline'] }}</span></div>
    </div>
    <header class="site-header">
        <a class="brand" href="/">
            @if ($settings['logo_image'])
                <img class="brand-mark" src="{{ $settings['logo_image'] }}" alt="{{ $settings['logo_name'] }} logo">
            @endif
        </a>
        <nav class="nav" aria-label="Main navigation">
            @foreach ($settings['menus'] as $menu)
                @php $url = str_starts_with($menu['url'], '#') ? '/' . $menu['url'] : $menu['url']; @endphp
                <div class="{{ $menu['highlight'] ? 'donate-link' : '' }}">
                    <a class="{{ ($active ?? '') === $url ? 'is-active' : '' }}" href="{{ $url }}">{{ $menu['label'] }}</a>
                </div>
            @endforeach
        </nav>
    </header>
    <main>
        <section class="page-hero">
            <div class="hero-inner">
                <nav class="breadcrumb" aria-label="Sitemap">
                    <a href="/">Home</a>
                    <span>/</span>
                    <span>@yield('crumb')</span>
                </nav>
                <h1>@yield('hero')</h1>
            </div>
        </section>
        @yield('content')
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
                        @php $url = str_starts_with($menu['url'], '#') ? '/' . $menu['url'] : $menu['url']; @endphp
                        <li><a href="{{ $url }}">{{ $menu['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-col">
                <h3>Support</h3>
                <ul class="footer-links">
                    <li><a href="/donate">Make a Donation</a></li>
                    <li><a href="/causes">Sponsor a Cause</a></li>
                    <li><a href="/contact">Become a Volunteer</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact</h3>
                <ul class="footer-contact">
                    <li><a href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a></li>
                    <li><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></li>
                    <li>{{ $settings['location_label'] }}</li>
                    <li><a href="/contact">Send a message</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}. All rights reserved.</span>
            <div class="footer-bottom-links">
                <a href="/contact">Privacy Policy</a>
                <a href="/donate">Give Support</a>
            </div>
        </div>
    </footer>
    @yield('scripts')
</body>
</html>
