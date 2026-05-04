<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Causes - {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --green:#087348; --green-dark:#063f2e; --soft:#f4fbf7; --line:#d9ebe2; --muted:#2f6e58; --white:#fff; }
        * { box-sizing: border-box; }
        body { margin:0; color:var(--green-dark); font-family:'Quicksand',Arial,sans-serif; font-size:18px; background:var(--white); }
        a { color:inherit; text-decoration:none; }
        .top-bar { display:flex; justify-content:space-between; gap:18px; padding:10px clamp(18px,5vw,76px); color:rgba(255,255,255,.92); background:var(--green-dark); font-size:13px; font-weight:700; }
        .contact-list,.top-group { display:flex; align-items:center; flex-wrap:wrap; gap:14px; }
        .top-link { display:inline-flex; align-items:center; gap:7px; min-height:24px; }
        .top-icon { width:16px; height:16px; stroke:currentColor; stroke-width:2; fill:none; }
        .volunteer-button { min-height:36px; padding:0 16px; border:1px solid rgba(255,255,255,.9); }
        .site-header { position:sticky; top:0; z-index:20; display:grid; grid-template-columns:minmax(180px,1fr) auto minmax(180px,1fr); align-items:center; gap:28px; padding:12px clamp(18px,5vw,76px); border-bottom:1px solid rgba(6,63,46,.1); background:var(--white); }
        .brand { display:inline-flex; justify-self:start; }
        .brand-mark { width:auto; max-width:260px; height:82px; object-fit:contain; }
        .nav { display:flex; justify-content:center; flex-wrap:wrap; gap:clamp(14px,2.5vw,30px); color:var(--muted); font-size:15px; font-weight:800; }
        .nav a { display:inline-flex; align-items:center; min-height:42px; padding:10px 0; }
        .nav a:hover,.nav a.is-active { color:var(--green); }
        .nav .donate-link a { min-height:42px; padding:0 18px; background:var(--green); color:var(--white); }
        .page-hero { position:relative; overflow:hidden; padding:clamp(82px,11vw,132px) clamp(18px,5vw,76px); color:var(--white); background:linear-gradient(135deg,rgba(6,63,46,.98),rgba(8,115,72,.88)); }
        .page-hero::after { position:absolute; right:8vw; bottom:-120px; width:330px; height:330px; content:""; border:34px solid rgba(255,255,255,.08); border-radius:999px; }
        .hero-inner { position:relative; z-index:1; max-width:980px; }
        .breadcrumb { display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px; color:rgba(255,255,255,.82); font-weight:800; }
        .breadcrumb a { color:var(--white); }
        h1 { margin:0; font-size:clamp(46px,7vw,78px); line-height:1.04; }
        .causes-body { padding:clamp(56px,7vw,92px) clamp(18px,5vw,76px); background:linear-gradient(180deg,var(--white),var(--soft)); }
        .section-head { max-width:860px; margin:0 auto 38px; text-align:center; }
        .section-head h2 { margin:0 0 12px; font-size:46px; line-height:1.1; }
        .section-head p { margin:0; color:var(--muted); line-height:1.65; }
        .causes-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:26px; max-width:1180px; margin:0 auto; }
        .cause-card { overflow:hidden; border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.09); }
        .cause-image { position:relative; min-height:300px; overflow:hidden; background:var(--line); }
        .cause-image img { width:100%; height:100%; min-height:300px; object-fit:cover; transition:transform .45s ease; }
        .cause-card:hover .cause-image img { transform:scale(1.04); }
        .cause-category { position:absolute; top:18px; left:18px; padding:9px 14px; border:1px solid rgba(255,255,255,.85); background:rgba(6,63,46,.24); color:var(--white); font-size:14px; font-weight:800; backdrop-filter:blur(8px); }
        .cause-content { display:grid; gap:18px; padding:26px; }
        .cause-content h3 { margin:0; color:var(--green-dark); font-size:24px; line-height:1.22; }
        .cause-content p { margin:0; color:var(--muted); line-height:1.65; }
        .funding-summary { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .funding-box { padding:13px; border:1px solid var(--line); background:var(--soft); }
        .funding-box span { display:block; margin-bottom:4px; color:var(--muted); font-size:12px; font-weight:900; text-transform:uppercase; }
        .funding-box strong { color:var(--green-dark); font-size:20px; }
        .progress-meta { display:flex; justify-content:space-between; gap:12px; margin-bottom:8px; color:var(--green); font-size:14px; font-weight:900; }
        .progress-bar { height:11px; overflow:hidden; background:#d9ebe2; }
        .progress-bar span { display:block; width:var(--progress); height:100%; background:var(--green); }
        .card-actions { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .cause-link { display:inline-flex; align-items:center; justify-content:center; min-height:48px; padding:0 16px; border:1px solid var(--green); color:var(--green); font-size:14px; font-weight:900; text-transform:uppercase; }
        .cause-link.primary { background:var(--green); color:var(--white); }
        .site-footer { color:rgba(255,255,255,.84); background:var(--green-dark); }
        .footer-grid { display:grid; grid-template-columns:1.2fr repeat(3,1fr); gap:clamp(24px,4vw,44px); padding:58px clamp(18px,5vw,76px) 44px; }
        .footer-logo { width:auto; max-width:190px; height:56px; object-fit:contain; }
        .footer-col h3 { margin:0 0 18px; color:var(--white); font-size:24px; }
        .footer-col p { max-width:360px; margin:18px 0 0; line-height:1.65; }
        .footer-links,.footer-contact { display:grid; gap:11px; margin:0; padding:0; list-style:none; }
        .footer-links a,.footer-contact a { color:rgba(255,255,255,.78); }
        .footer-bottom { display:flex; justify-content:space-between; gap:16px; padding:18px clamp(18px,5vw,76px); border-top:1px solid rgba(255,255,255,.14); color:rgba(255,255,255,.66); font-size:14px; }
        .footer-bottom-links { display:flex; flex-wrap:wrap; gap:16px; }
        .donation-modal { position:fixed; inset:0; z-index:100; display:grid; place-items:center; padding:18px; opacity:0; visibility:hidden; transition:opacity .2s ease, visibility .2s ease; }
        .donation-modal.is-open { opacity:1; visibility:visible; }
        .modal-backdrop { position:absolute; inset:0; background:rgba(6,63,46,.72); }
        .modal-panel { position:relative; z-index:1; width:min(100%,720px); max-height:92vh; overflow:auto; background:var(--white); border:1px solid var(--line); box-shadow:0 30px 90px rgba(6,63,46,.32); }
        .modal-head { display:flex; align-items:flex-start; justify-content:space-between; gap:20px; padding:24px 26px; background:var(--green); color:var(--white); }
        .modal-head h2 { margin:0; font-size:34px; line-height:1.1; }
        .modal-head p { margin:8px 0 0; color:rgba(255,255,255,.82); }
        .modal-close { width:42px; height:42px; border:1px solid rgba(255,255,255,.7); background:transparent; color:var(--white); font:inherit; font-size:28px; cursor:pointer; }
        .donation-form { display:grid; gap:16px; padding:26px; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        .donation-form label { display:grid; gap:8px; color:var(--muted); font-size:13px; font-weight:900; text-transform:uppercase; }
        .donation-form input,.donation-form select,.donation-form textarea { width:100%; min-height:50px; border:1px solid var(--line); padding:0 14px; color:var(--green-dark); background:#fbfffc; font:inherit; outline:0; }
        .donation-form textarea { min-height:120px; padding-top:14px; resize:vertical; }
        .form-note { margin:0; color:var(--muted); line-height:1.55; }
        .modal-submit { justify-self:start; min-height:52px; border:0; padding:0 22px; background:var(--green); color:var(--white); font:inherit; font-weight:900; text-transform:uppercase; cursor:pointer; }
        @media (max-width:920px){ .site-header{display:flex; flex-direction:column; align-items:flex-start;} .causes-grid,.footer-grid{grid-template-columns:1fr;} }
        @media (max-width:640px){ .top-bar,.top-group{align-items:flex-start; flex-direction:column;} .section-head h2{font-size:38px;} .funding-summary,.card-actions,.form-row{grid-template-columns:1fr;} .footer-bottom{flex-direction:column;} }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="contact-list">
            <a class="top-link" href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a>
            <a class="top-link" href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
            <a class="top-link" href="/#contact">{{ $settings['location_label'] }}</a>
            <a class="top-link volunteer-button" href="/#contact">{{ $settings['volunteer_label'] }}</a>
        </div>
        <div class="top-group"><span>Registration No: {{ $settings['registration_number'] }}</span></div>
    </div>
    <header class="site-header">
        <a class="brand" href="/">
            @if ($settings['logo_image'])
                <img class="brand-mark" src="{{ $settings['logo_image'] }}" alt="{{ $settings['logo_name'] }} logo">
            @endif
        </a>
        <nav class="nav">
            @foreach ($settings['menus'] as $menu)
                @php $url = str_starts_with($menu['url'], '#') ? '/' . $menu['url'] : $menu['url']; @endphp
                <div class="{{ $menu['highlight'] ? 'donate-link' : '' }}"><a class="{{ $url === '/causes' ? 'is-active' : '' }}" href="{{ $url }}">{{ $menu['label'] }}</a></div>
            @endforeach
        </nav>
    </header>
    <main>
        <section class="page-hero">
            <div class="hero-inner">
                <nav class="breadcrumb"><a href="/">Home</a><span>/</span><span>Our Causes</span></nav>
                <h1>Our Causes</h1>
            </div>
        </section>
        <section class="causes-body">
            <div class="section-head">
                <h2>Campaigns You Can Support</h2>
                <p>Each campaign responds to a real need in the community. Choose a cause, learn more, and contribute toward lasting care.</p>
            </div>
            <div class="causes-grid">
                @foreach ($causes as $cause)
                    @php $progress = $causeRepo->progress($cause); @endphp
                    <article class="cause-card">
                        <div class="cause-image">
                            <span class="cause-category">{{ $cause['category'] }}</span>
                            <img src="{{ $cause['image'] }}" alt="{{ $cause['title'] }}">
                        </div>
                        <div class="cause-content">
                            <h3>{{ $cause['title'] }}</h3>
                            <p>{{ $cause['brief'] }}</p>
                            <div class="funding-summary">
                                <div class="funding-box"><span>Target Amount</span><strong>{{ $causeRepo->formatMoney($cause['target']) }}</strong></div>
                                <div class="funding-box"><span>Raised So Far</span><strong>{{ $causeRepo->formatMoney($cause['raised']) }}</strong></div>
                            </div>
                            <div>
                                <div class="progress-meta"><span>{{ $progress }}% funded</span><span>{{ $causeRepo->formatMoney($cause['target'] - $cause['raised']) }} needed</span></div>
                                <div class="progress-bar" style="--progress: {{ $progress }}%;"><span></span></div>
                            </div>
                            <div class="card-actions">
                                <button class="cause-link primary contribute-trigger" type="button" data-cause="{{ $cause['title'] }}">Contribute to Cause</button>
                                <a class="cause-link" href="/causes/{{ $cause['slug'] }}">Full Details</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
    <footer class="site-footer">
        <div class="footer-grid">
            <div class="footer-col">
                @if ($settings['logo_image'])<img class="footer-logo" src="{{ $settings['logo_image'] }}" alt="{{ $settings['logo_name'] }} logo">@endif
                <p>Nicoville supports vulnerable families through transparent relief, education, health care, and community-led development programmes.</p>
            </div>
            <div class="footer-col"><h3>Quick Links</h3><ul class="footer-links">@foreach ($settings['menus'] as $menu) @php $url = str_starts_with($menu['url'], '#') ? '/' . $menu['url'] : $menu['url']; @endphp <li><a href="{{ $url }}">{{ $menu['label'] }}</a></li> @endforeach</ul></div>
            <div class="footer-col"><h3>Support</h3><ul class="footer-links"><li><a href="/#donate">Make a Donation</a></li><li><a href="/#contact">Become a Volunteer</a></li><li><a href="/#contact">Partner With Us</a></li></ul></div>
            <div class="footer-col"><h3>Contact</h3><ul class="footer-contact"><li><a href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a></li><li><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></li><li>{{ $settings['location_label'] }}</li></ul></div>
        </div>
        <div class="footer-bottom"><span>&copy; {{ date('Y') }} {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}. All rights reserved.</span><div class="footer-bottom-links"><a href="/#contact">Privacy Policy</a><a href="/#donate">Give Support</a></div></div>
    </footer>
    <div class="donation-modal" id="donationModal" aria-hidden="true">
        <div class="modal-backdrop" data-close-modal></div>
        <div class="modal-panel" role="dialog" aria-modal="true" aria-labelledby="donationModalTitle">
            <div class="modal-head">
                <div>
                    <h2 id="donationModalTitle">Contribute to a Cause</h2>
                    <p>Share your donor details. This will redirect to our contributions page when it is ready.</p>
                </div>
                <button class="modal-close" type="button" data-close-modal aria-label="Close donation form">&times;</button>
            </div>
            <form class="donation-form" action="/contributions" method="GET">
                <label>Cause
                    <select name="cause" id="modalCause" required>
                        <option value="">Choose a cause</option>
                        @foreach ($causes as $cause)
                            <option value="{{ $cause['title'] }}">{{ $cause['title'] }}</option>
                        @endforeach
                    </select>
                </label>
                <div class="form-row">
                    <label>Donor Name<input name="name" type="text" placeholder="Your full name" required></label>
                    <label>Email Address<input name="email" type="email" placeholder="you@example.com" required></label>
                </div>
                <div class="form-row">
                    <label>Contact / Phone<input name="phone" type="tel" placeholder="+256..." required></label>
                    <label>Amount<input name="amount" type="number" min="1" placeholder="Amount in UGX" required></label>
                </div>
                <label>Message / Note<textarea name="message" placeholder="Optional note for this contribution"></textarea></label>
                <p class="form-note">After submitting, this form will send these details to the future contributions page.</p>
                <button class="modal-submit" type="submit">Continue to Contributions</button>
            </form>
        </div>
    </div>
    <script>
        const donationModal = document.getElementById('donationModal');
        const modalCause = document.getElementById('modalCause');

        document.querySelectorAll('.contribute-trigger').forEach((button) => {
            button.addEventListener('click', () => {
                modalCause.value = button.dataset.cause || '';
                donationModal.classList.add('is-open');
                donationModal.setAttribute('aria-hidden', 'false');
            });
        });

        document.querySelectorAll('[data-close-modal]').forEach((button) => {
            button.addEventListener('click', () => {
                donationModal.classList.remove('is-open');
                donationModal.setAttribute('aria-hidden', 'true');
            });
        });
    </script>
</body>
</html>
