<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $cause['title'] }} - {{ $settings['logo_name'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --green:#087348; --green-dark:#063f2e; --soft:#f4fbf7; --line:#d9ebe2; --muted:#2f6e58; --white:#fff; }
        * { box-sizing:border-box; }
        body { margin:0; color:var(--green-dark); font-family:'Quicksand',Arial,sans-serif; font-size:18px; background:var(--white); }
        a { color:inherit; text-decoration:none; }
        .top-bar { display:flex; justify-content:space-between; gap:18px; padding:10px clamp(18px,5vw,76px); color:rgba(255,255,255,.92); background:var(--green-dark); font-size:13px; font-weight:700; }
        .contact-list,.top-group,.nav { display:flex; align-items:center; flex-wrap:wrap; gap:14px; }
        .volunteer-button { min-height:36px; padding:8px 16px; border:1px solid rgba(255,255,255,.9); }
        .site-header { position:sticky; top:0; z-index:20; display:grid; grid-template-columns:minmax(180px,1fr) auto minmax(180px,1fr); align-items:center; gap:28px; padding:12px clamp(18px,5vw,76px); border-bottom:1px solid rgba(6,63,46,.1); background:var(--white); }
        .brand { justify-self:start; }
        .brand-mark { width:auto; max-width:260px; height:82px; object-fit:contain; }
        .nav { justify-content:center; color:var(--muted); font-size:15px; font-weight:800; }
        .nav a { display:inline-flex; align-items:center; min-height:42px; padding:10px 0; }
        .nav a:hover,.nav a.is-active { color:var(--green); }
        .nav .donate-link a { min-height:42px; padding:0 18px; background:var(--green); color:var(--white); }
        .page-hero { position:relative; overflow:hidden; padding:clamp(82px,11vw,132px) clamp(18px,5vw,76px); color:var(--white); background:linear-gradient(135deg,rgba(6,63,46,.96),rgba(8,115,72,.84)), var(--hero-image); background-size:cover; background-position:center; }
        .hero-inner { max-width:980px; }
        .breadcrumb { display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px; color:rgba(255,255,255,.82); font-weight:800; }
        .breadcrumb a { color:var(--white); }
        h1 { margin:0; font-size:clamp(42px,6vw,72px); line-height:1.05; }
        .detail-body { padding:clamp(56px,7vw,92px) clamp(18px,5vw,76px); background:linear-gradient(180deg,var(--white),var(--soft)); }
        .detail-grid { display:grid; grid-template-columns:minmax(0,1fr) 390px; gap:34px; max-width:1180px; margin:0 auto; align-items:start; }
        .content-card,.side-card,.say-form { border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
        .content-card { overflow:hidden; }
        .campaign-image { position:relative; min-height:420px; background:var(--line); }
        .campaign-image img { width:100%; height:100%; min-height:420px; object-fit:cover; }
        .campaign-category { position:absolute; top:20px; left:20px; padding:10px 15px; border:1px solid rgba(255,255,255,.86); background:rgba(6,63,46,.24); color:var(--white); font-size:14px; font-weight:900; backdrop-filter:blur(8px); }
        .campaign-copy { padding:clamp(26px,4vw,42px); }
        .campaign-copy h2,.say-form h2 { margin:0 0 18px; color:var(--green); font-size:46px; line-height:1.1; }
        .campaign-copy p { margin:0; color:var(--muted); line-height:1.75; }
        .campaign-copy p + p { margin-top:16px; }
        .impact-list { display:grid; gap:12px; margin:24px 0 0; padding:0; list-style:none; }
        .impact-list li { padding:14px 16px; border-left:4px solid var(--green); background:var(--soft); color:var(--green-dark); font-weight:700; }
        .side-card { display:grid; gap:18px; padding:26px; }
        .amount-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .amount-box { padding:14px; background:var(--soft); border:1px solid var(--line); }
        .amount-box span { display:block; margin-bottom:5px; color:var(--muted); font-size:12px; font-weight:900; text-transform:uppercase; }
        .amount-box strong { font-size:20px; color:var(--green-dark); }
        .progress-meta { display:flex; justify-content:space-between; gap:12px; margin-bottom:8px; color:var(--green); font-size:14px; font-weight:900; }
        .progress-bar { height:12px; overflow:hidden; background:#d9ebe2; }
        .progress-bar span { display:block; width:var(--progress); height:100%; background:var(--green); }
        .donate-link { display:inline-flex; justify-content:center; align-items:center; min-height:52px; background:var(--green); color:var(--white); font-weight:900; text-transform:uppercase; }
        button.donate-link { width:100%; border:0; font:inherit; cursor:pointer; }
        .say-form { display:grid; gap:16px; margin-top:24px; padding:26px; }
        .say-form p { margin:0; color:var(--muted); line-height:1.6; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
        label { display:grid; gap:8px; color:var(--muted); font-size:13px; font-weight:900; text-transform:uppercase; }
        input,select,textarea { width:100%; min-height:50px; border:1px solid var(--line); padding:0 14px; color:var(--green-dark); background:#fbfffc; font:inherit; outline:0; }
        textarea { min-height:150px; padding-top:14px; resize:vertical; }
        button { justify-self:start; min-height:52px; border:0; padding:0 22px; background:var(--green); color:var(--white); font:inherit; font-weight:900; text-transform:uppercase; cursor:pointer; }
        .donation-modal { position:fixed; inset:0; z-index:100; display:grid; place-items:center; padding:18px; opacity:0; visibility:hidden; transition:opacity .2s ease, visibility .2s ease; }
        .donation-modal.is-open { opacity:1; visibility:visible; }
        .modal-backdrop { position:absolute; inset:0; background:rgba(6,63,46,.72); }
        .modal-panel { position:relative; z-index:1; width:min(100%,720px); max-height:92vh; overflow:auto; background:var(--white); border:1px solid var(--line); box-shadow:0 30px 90px rgba(6,63,46,.32); }
        .modal-head { display:flex; align-items:flex-start; justify-content:space-between; gap:20px; padding:24px 26px; background:var(--green); color:var(--white); }
        .modal-head h2 { margin:0; font-size:34px; line-height:1.1; }
        .modal-head p { margin:8px 0 0; color:rgba(255,255,255,.82); }
        .modal-close { width:42px; height:42px; border:1px solid rgba(255,255,255,.7); background:transparent; color:var(--white); font:inherit; font-size:28px; cursor:pointer; }
        .donation-form { display:grid; gap:16px; padding:26px; }
        .form-note { margin:0; color:var(--muted); line-height:1.55; }
        .modal-submit { justify-self:start; }
        .site-footer { color:rgba(255,255,255,.84); background:var(--green-dark); }
        .footer-bottom { display:flex; justify-content:space-between; gap:16px; padding:18px clamp(18px,5vw,76px); color:rgba(255,255,255,.66); font-size:14px; }
        @media (max-width:920px){ .site-header{display:flex; flex-direction:column; align-items:flex-start;} .detail-grid{grid-template-columns:1fr;} }
        @media (max-width:640px){ .top-bar,.top-group{align-items:flex-start; flex-direction:column;} .campaign-copy h2,.say-form h2{font-size:38px;} .amount-grid,.form-row{grid-template-columns:1fr;} .footer-bottom{flex-direction:column;} }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="contact-list">
            <a href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a>
            <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
            <a href="/#contact">{{ $settings['location_label'] }}</a>
            <a class="volunteer-button" href="/#contact">{{ $settings['volunteer_label'] }}</a>
        </div>
        <div class="top-group"><span>Registration No: {{ $settings['registration_number'] }}</span></div>
    </div>
    <header class="site-header">
        <a class="brand" href="/">
            @if ($settings['logo_image'])<img class="brand-mark" src="{{ $settings['logo_image'] }}" alt="{{ $settings['logo_name'] }} logo">@endif
        </a>
        <nav class="nav">
            @foreach ($settings['menus'] as $menu)
                @php $url = str_starts_with($menu['url'], '#') ? '/' . $menu['url'] : $menu['url']; @endphp
                <div class="{{ $menu['highlight'] ? 'donate-link' : '' }}"><a class="{{ $url === '/causes' ? 'is-active' : '' }}" href="{{ $url }}">{{ $menu['label'] }}</a></div>
            @endforeach
        </nav>
    </header>
    <main>
        <section class="page-hero" style="--hero-image: url('{{ $cause['image'] }}');">
            <div class="hero-inner">
                <nav class="breadcrumb"><a href="/">Home</a><span>/</span><a href="/causes">Our Causes</a><span>/</span><span>{{ $cause['title'] }}</span></nav>
                <h1>{{ $cause['title'] }}</h1>
            </div>
        </section>
        <section class="detail-body">
            <div class="detail-grid">
                <article class="content-card">
                    <div class="campaign-image">
                        <span class="campaign-category">{{ $cause['category'] }}</span>
                        <img src="{{ $cause['image'] }}" alt="{{ $cause['title'] }}">
                    </div>
                    <div class="campaign-copy">
                        <h2>Campaign Details</h2>
                        @foreach ($cause['details'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                        <ul class="impact-list">
                            @foreach ($cause['impact'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </article>
                <aside>
                    @php $progress = $causeRepo->progress($cause); @endphp
                    <div class="side-card">
                        <div class="amount-grid">
                            <div class="amount-box"><span>Target</span><strong>{{ $causeRepo->formatMoney($cause['target']) }}</strong></div>
                            <div class="amount-box"><span>Raised</span><strong>{{ $causeRepo->formatMoney($cause['raised']) }}</strong></div>
                        </div>
                        <div>
                            <div class="progress-meta"><span>{{ $progress }}% funded</span><span>{{ $causeRepo->formatMoney($cause['target'] - $cause['raised']) }} needed</span></div>
                            <div class="progress-bar" style="--progress: {{ $progress }}%;"><span></span></div>
                        </div>
                        <button class="donate-link contribute-trigger" type="button" data-cause="{{ $cause['title'] }}">Contribute to Cause</button>
                    </div>
                    <form class="say-form" action="mailto:{{ $settings['email'] }}" method="POST" enctype="text/plain">
                        <h2>What Is Your Say?</h2>
                        <p>Share your thoughts, visit feedback, or interest in this particular cause.</p>
                        <input type="hidden" name="cause" value="{{ $cause['title'] }}">
                        <div class="form-row">
                            <label>Name<input name="name" type="text" required></label>
                            <label>Email<input name="email" type="email" required></label>
                        </div>
                        <label>Your Interest
                            <select name="interest" required>
                                <option value="">Choose one</option>
                                <option>Visited this cause</option>
                                <option>Want to volunteer</option>
                                <option>Want to donate</option>
                                <option>Need more information</option>
                            </select>
                        </label>
                        <label>Your Say<textarea name="message" required placeholder="Write your message about this cause..."></textarea></label>
                        <button type="submit">Submit Your Say</button>
                    </form>
                </aside>
            </div>
        </section>
    </main>
    <footer class="site-footer">
        <div class="footer-bottom"><span>&copy; {{ date('Y') }} {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}. All rights reserved.</span><a href="/causes">Back to Causes</a></div>
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
                        @foreach ($causeRepo->all() as $optionCause)
                            <option value="{{ $optionCause['title'] }}" {{ $optionCause['slug'] === $cause['slug'] ? 'selected' : '' }}>{{ $optionCause['title'] }}</option>
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
                modalCause.value = button.dataset.cause || modalCause.value;
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
