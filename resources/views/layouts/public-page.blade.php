<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
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
        .top-bar { display:flex; align-items:center; justify-content:space-between; gap:18px; overflow-x:auto; padding:10px clamp(18px,5vw,76px); color:rgba(255,255,255,.92); background:var(--green-dark); font-size:13px; font-weight:700; white-space:nowrap; }
        .contact-list,.top-group { display:flex; align-items:center; flex:0 0 auto; flex-wrap:nowrap; gap:14px; }
        .top-link { display:inline-flex; align-items:center; flex:0 0 auto; min-height:24px; }
        .top-socials,.footer-socials { display:flex; flex-wrap:wrap; gap:8px; }
        .top-socials { flex-wrap:nowrap; }
        .top-socials a,.footer-socials a,.floating-action { display:grid; width:42px; height:42px; place-items:center; border:1px solid rgba(255,255,255,.72); background:transparent; color:var(--white); }
        .top-socials a { width:32px; height:32px; }
        .top-socials svg,.footer-socials svg,.floating-action svg { width:19px; height:19px; fill:currentColor; }
        .top-socials a:hover,.footer-socials a:hover { background:var(--white); color:var(--green); }
        .volunteer-button { min-height:36px; padding:8px 16px; border:1px solid rgba(255,255,255,.9); background:transparent; color:var(--white); font-weight:900; }
        .site-header { position:sticky; top:0; z-index:20; display:grid; grid-template-columns:minmax(180px,1fr) auto minmax(180px,1fr); align-items:center; gap:28px; padding:12px clamp(18px,5vw,76px); border-bottom:1px solid rgba(6,63,46,.1); background:var(--white); }
        .brand { display:inline-flex; justify-self:start; }
        .brand-mark { width:auto; max-width:260px; height:82px; object-fit:contain; }
        .nav { display:flex; align-items:center; justify-content:center; justify-self:center; gap:clamp(14px,2.5vw,30px); color:var(--muted); font-size:15px; font-weight:800; }
        .nav-item { position:relative; }
        .nav a { display:inline-flex; align-items:center; min-height:42px; padding:10px 0; }
        .nav-item.has-submenu > a { gap:6px; }
        .nav-item.has-submenu > a::after { width:7px; height:7px; content:""; border-right:2px solid currentColor; border-bottom:2px solid currentColor; transform:rotate(45deg) translateY(-2px); }
        .nav a:hover,.nav a.is-active { color:var(--green); }
        .nav .donate-link a { min-height:42px; padding:0 18px; background:var(--green); color:var(--white); }
        .submenu { position:absolute; top:100%; left:0; z-index:30; display:grid; min-width:220px; padding:10px 8px 8px; border:1px solid var(--line); background:var(--white); box-shadow:0 18px 42px rgba(6,63,46,.13); opacity:0; pointer-events:none; transform:translateY(6px); transition:opacity .18s ease,transform .18s ease; }
        .nav-item:hover .submenu,.nav-item:focus-within .submenu { opacity:1; pointer-events:auto; transform:translateY(0); }
        .submenu a { min-height:40px; padding:0 12px; color:var(--muted); white-space:nowrap; }
        .submenu a:hover,.submenu a.is-active { color:var(--white); background:var(--green); }
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
        .footer-links.two-columns { grid-template-columns:repeat(2,max-content); column-gap:18px; row-gap:11px; }
        .footer-links a,.footer-contact a { color:rgba(255,255,255,.78); }
        .footer-social-title { display:block; margin-top:20px; margin-bottom:10px; color:var(--white); font-size:13px; font-weight:900; text-transform:uppercase; }
        .footer-socials { margin-top:0; }
        .footer-socials a { background:var(--white); color:var(--green); }
        .footer-socials a:hover { background:transparent; color:var(--white); }
        .footer-bottom { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:18px clamp(18px,5vw,76px); border-top:1px solid rgba(255,255,255,.14); color:rgba(255,255,255,.66); font-size:14px; }
        .footer-bottom-links { display:flex; flex-wrap:wrap; gap:16px; }
        .floating-actions { position:fixed; right:18px; bottom:18px; z-index:60; display:grid; gap:10px; }
        .floating-action { width:52px; height:52px; border-color:var(--green); background:var(--green); cursor:pointer; box-shadow:0 16px 36px rgba(6,63,46,.22); }
        .floating-action svg { width:23px; height:23px; }
        .whatsapp-action { background:#25d366; border-color:#25d366; }
        .whatsapp-action span { position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; }
        .back-to-top { opacity:0; pointer-events:none; transform:translateY(8px); transition:opacity .2s ease,transform .2s ease; }
        .back-to-top.is-visible { opacity:1; pointer-events:auto; transform:translateY(0); }
        @yield('page_css')
        @media (max-width:980px){ .site-header{display:flex; flex-direction:column; align-items:flex-start;} .nav{justify-content:flex-start; flex-wrap:wrap;} .grid-2,.grid-3,.footer-grid{grid-template-columns:1fr;} }
        @media (max-width:640px){ h2{font-size:38px;} .form-row{grid-template-columns:1fr;} .footer-bottom{align-items:flex-start; flex-direction:column;} .floating-actions{right:12px;bottom:12px;} .floating-action{width:48px;height:48px;} }
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
        <div class="top-group">
            <span>Registration No: {{ $settings['registration_number'] }}</span>
            @include('partials.social-links', ['class' => 'top-socials'])
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
                    $activePath = $active ?? '';
                @endphp
                @php
                    $hasChildren = ! empty($menu['children']);
                    $isActiveMenu = $activePath === $url || collect($menu['children'] ?? [])->contains(function (array $child) use ($activePath) {
                        $childUrl = str_starts_with($child['url'], '#') ? '/' . $child['url'] : $child['url'];

                        return $activePath === $childUrl;
                    });
                @endphp
                <div class="nav-item {{ $hasChildren ? 'has-submenu' : '' }} {{ $menu['highlight'] ? 'donate-link' : '' }}">
                    <a class="{{ $isActiveMenu ? 'is-active' : '' }}" href="{{ $url }}" @if ($hasChildren) aria-haspopup="true" aria-expanded="false" @endif>{{ $menu['label'] }}</a>
                    @if (! empty($menu['children']))
                        <div class="submenu">
                            @foreach ($menu['children'] as $child)
                                @php $childUrl = str_starts_with($child['url'], '#') ? '/' . $child['url'] : $child['url']; @endphp
                                <a class="{{ ($active ?? '') === $childUrl ? 'is-active' : '' }}" href="{{ $childUrl }}">{{ $child['label'] }}</a>
                            @endforeach
                        </div>
                    @endif
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
                <ul class="footer-links two-columns">
                    @foreach ($settings['menus'] as $menu)
                        @php $url = str_starts_with($menu['url'], '#') ? '/' . $menu['url'] : $menu['url']; @endphp
                        <li><a href="{{ $url }}">{{ $menu['label'] }}</a></li>
                        @foreach ($menu['children'] ?? [] as $child)
                            @php $childUrl = str_starts_with($child['url'], '#') ? '/' . $child['url'] : $child['url']; @endphp
                            <li><a href="{{ $childUrl }}">{{ $child['label'] }}</a></li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <div class="footer-col">
                <h3>Support</h3>
                <ul class="footer-links">
                    <li><a href="/donate">Make a Donation</a></li>
                    <li><a href="/projects">Support a Project</a></li>
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
                <span class="footer-social-title">Follow Us</span>
                @include('partials.social-links', ['class' => 'footer-socials'])
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
    @include('partials.floating-actions')
    @yield('scripts')
</body>
</html>
