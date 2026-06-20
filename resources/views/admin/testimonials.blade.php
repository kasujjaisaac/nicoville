<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Testimonials</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#15211d; --muted:#6f7d78; --line:#dbe6e0; --green:#0f6f4d; --green-dark:#073f31; --coral:#c9543d; --gold:#d99b2b; --paper:#f8f5ee; --white:#fff; }
        * { box-sizing:border-box; }
        body { margin:0; color:var(--ink); font-family:'Poppins',Arial,sans-serif; font-size:11px; background:var(--paper); }
        a { color:inherit; text-decoration:none; }
        .admin-layout { display:grid; grid-template-columns:280px minmax(0,1fr); min-height:100vh; }
        .sidebar { position:sticky; top:0; display:flex; flex-direction:column; height:100vh; padding:24px 18px; color:rgba(255,255,255,.78); background:var(--green-dark); }
        .sidebar-brand { display:flex; align-items:center; gap:12px; padding:0 8px 24px; border-bottom:1px solid rgba(255,255,255,.12); color:var(--white); }
        .brand-mark { display:grid; width:44px; height:44px; place-items:center; background:var(--green); font-size:21px; font-weight:900; }
        .brand-name { display:block; font-size:20px; font-weight:900; line-height:1; }
        .brand-role { display:block; margin-top:5px; color:rgba(255,255,255,.58); font-size:12px; font-weight:800; text-transform:uppercase; }
        .sidebar-section { margin:24px 0 10px; padding:0 10px; color:rgba(255,255,255,.48); font-size:12px; font-weight:900; text-transform:uppercase; }
        .sidebar-nav { display:grid; gap:6px; }
        .sidebar-link { display:flex; align-items:center; gap:10px; min-height:44px; padding:0 12px; color:rgba(255,255,255,.76); font-weight:800; }
        .sidebar-link:hover,.sidebar-link.active { color:var(--white); background:rgba(255,255,255,.12); }
        .sidebar-icon { display:grid; width:28px; height:28px; place-items:center; background:rgba(255,255,255,.1); color:#ffe0a4; font-size:13px; }
        .sidebar-footer { margin-top:auto; padding:16px 10px 0; border-top:1px solid rgba(255,255,255,.12); }
        .admin-user { margin:0 0 12px; color:rgba(255,255,255,.62); font-size:13px; line-height:1.5; }
        .logout-button { width:100%; min-height:42px; border:1px solid rgba(255,255,255,.18); color:var(--white); background:rgba(255,255,255,.08); font:inherit; font-weight:800; cursor:pointer; }
        .admin-shell { width:min(1120px,calc(100% - 36px)); margin:28px auto 64px; }
        .notice,.errors { margin-bottom:18px; padding:14px 16px; font-weight:800; }
        .notice { border:1px solid rgba(15,111,77,.25); color:var(--green-dark); background:rgba(15,111,77,.09); }
        .errors { border:1px solid rgba(201,84,61,.28); color:#8f2e1e; background:rgba(201,84,61,.09); }
        .page-head { display:flex; align-items:end; justify-content:space-between; gap:20px; margin-bottom:20px; }
        .page-head h1 { margin:0 0 8px; font-size:34px; line-height:1.08; }
        .page-head p { max-width:700px; margin:0; color:var(--muted); line-height:1.6; }
        .preview-link { display:inline-flex; align-items:center; justify-content:center; min-height:44px; padding:0 16px; background:var(--green); color:var(--white); font-weight:900; white-space:nowrap; }
        .panel { margin-bottom:18px; padding:20px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); }
        .heading-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:16px; }
        .heading-grid .wide { grid-column:1 / -1; }
        label { display:block; margin-bottom:7px; color:var(--ink); font-size:13px; font-weight:900; text-transform:uppercase; }
        input,textarea { width:100%; border:1px solid var(--line); color:var(--ink); background:#fbfcfa; font:inherit; }
        input { min-height:44px; padding:0 12px; }
        input[type="file"] { padding:10px 12px; }
        textarea { min-height:120px; padding:12px; resize:vertical; }
        .testimonial-list { display:grid; gap:16px; }
        .testimonial-card { position:relative; display:grid; grid-template-columns:80px minmax(0,1fr); gap:18px; padding:18px; border:1px solid var(--line); background:#fbfcfa; }
        .avatar-preview { display:grid; width:70px; height:70px; place-items:center; overflow:hidden; color:var(--white); background:linear-gradient(135deg,var(--green),var(--gold)); font-size:24px; font-weight:900; }
        .avatar-preview img { width:100%; height:100%; object-fit:cover; }
        .field-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:14px; }
        .field-grid .wide { grid-column:1 / -1; }
        .hint { margin:7px 0 0; color:var(--muted); font-size:13px; line-height:1.4; }
        .button-row { display:flex; flex-wrap:wrap; gap:10px; margin-top:14px; }
        .small-button,.danger-button { min-height:40px; padding:0 14px; border-radius:0; font:inherit; font-size:14px; font-weight:900; cursor:pointer; }
        .small-button { border:1px solid var(--green); color:var(--green-dark); background:rgba(15,111,77,.08); }
        .danger-button { border:1px solid rgba(201,84,61,.3); color:#8f2e1e; background:rgba(201,84,61,.08); }
        .actions { position:sticky; bottom:0; display:flex; justify-content:flex-end; padding:16px 0; background:linear-gradient(transparent,var(--paper) 30%); }
        .save-button { min-height:50px; padding:0 24px; border:0; color:var(--white); background:var(--coral); font:inherit; font-weight:900; cursor:pointer; }
        @media (max-width:900px){ .admin-layout,.heading-grid,.testimonial-card,.field-grid{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} .page-head{display:block;} .preview-link{margin-top:16px;} }
        @include('admin.partials.mobile-css')
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar" aria-label="Admin navigation">
            <a class="sidebar-brand" href="/admin">
                <span class="brand-mark">N</span>
                <span><span class="brand-name">Nicoville</span><span class="brand-role">Admin Panel</span></span>
            </a>
            <div class="sidebar-section">Website</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="/admin"><span class="sidebar-icon">01</span><span>Dashboard</span></a>
                <a class="sidebar-link" href="/admin/media"><span class="sidebar-icon">02</span><span>Media Library</span></a>
                <a class="sidebar-link" href="/admin/slider"><span class="sidebar-icon">03</span><span>Hero Slider</span></a>
                <a class="sidebar-link" href="/admin/impact"><span class="sidebar-icon">04</span><span>Impact Section</span></a>
                <a class="sidebar-link active" href="/admin/testimonials" aria-current="page"><span class="sidebar-icon">05</span><span>Testimonials</span></a>
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">06</span><span>Site Settings</span></a>
                <a class="sidebar-link" href="/admin/team"><span class="sidebar-icon">07</span><span>Team Members</span></a>
                <a class="sidebar-link" href="/admin/contact-messages"><span class="sidebar-icon">08</span><span>Messages</span></a>
                <a class="sidebar-link" href="/admin/donations"><span class="sidebar-icon">09</span><span>Donations</span></a>
                <a class="sidebar-link" href="/admin/event-bookings"><span class="sidebar-icon">10</span><span>Event Bookings</span></a>
            </nav>
            <div class="sidebar-section">Content</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="/admin/content/pages"><span class="sidebar-icon">11</span><span>Pages</span></a>
                <a class="sidebar-link" href="/admin/projects"><span class="sidebar-icon">12</span><span>Projects</span></a>
                <a class="sidebar-link" href="/admin/content/events"><span class="sidebar-icon">13</span><span>Events</span></a>
                <a class="sidebar-link" href="/admin/content/news"><span class="sidebar-icon">14</span><span>News</span></a>
            </nav>
            <div class="sidebar-footer">
                <p class="admin-user">Signed in as<br><strong>{{ auth()->user()->email }}</strong></p>
                <form method="POST" action="/admin/logout">
                    @csrf
                    <button class="logout-button" type="submit">Logout</button>
                </form>
            </div>
        </aside>

        <main class="admin-shell">
            @if (session('status'))
                <div class="notice">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="errors">
                    <strong>Please fix these fields:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <header class="page-head">
                <div>
                    <h1>Testimonials</h1>
                    <p>Update the homepage testimonial heading and the donor, parent, and volunteer quotes shown beneath the “Why donate” section.</p>
                </div>
                <a class="preview-link" href="/#testimonials" target="_blank" rel="noopener">Preview Section</a>
            </header>

            <form method="POST" action="/admin/testimonials" enctype="multipart/form-data">
                @csrf

                <section class="panel">
                    <div class="heading-grid">
                        <div>
                            <label for="testimonials_kicker">Small Heading</label>
                            <input id="testimonials_kicker" name="testimonials_kicker" value="{{ old('testimonials_kicker', $home['testimonials_kicker']) }}" required>
                        </div>
                        <div>
                            <label for="testimonials_title">Main Heading</label>
                            <input id="testimonials_title" name="testimonials_title" value="{{ old('testimonials_title', $home['testimonials_title']) }}" required>
                        </div>
                        <div class="wide">
                            <label for="testimonials_intro">Intro Text</label>
                            <textarea id="testimonials_intro" name="testimonials_intro" required>{{ old('testimonials_intro', $home['testimonials_intro']) }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="testimonial-list" data-testimonial-list>
                        @php $testimonialRows = old('testimonials', $home['testimonials']); @endphp
                        @foreach ($testimonialRows as $index => $testimonial)
                            @php $testimonialImage = $testimonial['image'] ?? $testimonial['image_url'] ?? ''; @endphp
                            <article class="testimonial-card" data-testimonial-card>
                                <div class="avatar-preview" data-avatar-preview>
                                    @if (filled($testimonialImage))
                                        <img src="{{ $testimonialImage }}" alt="{{ $testimonial['name'] }} photo">
                                    @else
                                        {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                                    @endif
                                </div>
                                <div class="field-grid">
                                    <div class="wide">
                                        <label>Quote</label>
                                        <textarea data-quote name="testimonials[{{ $index }}][quote]" required>{{ old("testimonials.$index.quote", $testimonial['quote']) }}</textarea>
                                    </div>
                                    <div>
                                        <label>Name</label>
                                        <input data-name name="testimonials[{{ $index }}][name]" value="{{ old("testimonials.$index.name", $testimonial['name']) }}" required>
                                    </div>
                                    <div>
                                        <label>Role</label>
                                        <input data-role name="testimonials[{{ $index }}][role]" value="{{ old("testimonials.$index.role", $testimonial['role']) }}" required>
                                    </div>
                                    <div>
                                        <label>Highlight</label>
                                        <input data-highlight name="testimonials[{{ $index }}][highlight]" value="{{ old("testimonials.$index.highlight", $testimonial['highlight']) }}" required>
                                        <p class="hint">Short phrase, like “Transparent giving”.</p>
                                    </div>
                                    <div class="wide">
                                        <label>Avatar Image</label>
                                        <input data-image-file name="testimonials[{{ $index }}][image_file]" type="file" accept="image/*">
                                        <input data-image-url name="testimonials[{{ $index }}][image_url]" type="hidden" value="{{ old("testimonials.$index.image_url", $testimonialImage) }}">
                                        <p class="hint">Upload a square portrait to replace the letter holder on the homepage.</p>
                                    </div>
                                    <div class="wide">
                                        <button class="danger-button" type="button" data-remove-testimonial>Remove Testimonial</button>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="button-row">
                        <button class="small-button" type="button" data-add-testimonial>Add Testimonial</button>
                    </div>
                </section>

                <div class="actions">
                    <button class="save-button" type="submit">Save Testimonials</button>
                </div>
            </form>
        </main>
    </div>

    <script>
        function reindexTestimonials() {
            Array.from(document.querySelectorAll('[data-testimonial-card]')).forEach((card, index) => {
                card.querySelector('[data-quote]').name = `testimonials[${index}][quote]`;
                card.querySelector('[data-name]').name = `testimonials[${index}][name]`;
                card.querySelector('[data-role]').name = `testimonials[${index}][role]`;
                card.querySelector('[data-highlight]').name = `testimonials[${index}][highlight]`;
                card.querySelector('[data-image-file]').name = `testimonials[${index}][image_file]`;
                card.querySelector('[data-image-url]').name = `testimonials[${index}][image_url]`;
                syncAvatar(card);
            });
        }

        function syncAvatar(card) {
            if (card.querySelector('[data-avatar-preview] img')) {
                return;
            }

            const name = card.querySelector('[data-name]').value.trim();
            card.querySelector('[data-avatar-preview]').textContent = (name[0] || 'N').toUpperCase();
        }

        function createTestimonialCard() {
            const card = document.createElement('article');
            card.className = 'testimonial-card';
            card.dataset.testimonialCard = '';
            card.innerHTML = `
                <div class="avatar-preview" data-avatar-preview>N</div>
                <div class="field-grid">
                    <div class="wide">
                        <label>Quote</label>
                        <textarea data-quote required></textarea>
                    </div>
                    <div>
                        <label>Name</label>
                        <input data-name required>
                    </div>
                    <div>
                        <label>Role</label>
                        <input data-role required>
                    </div>
                    <div>
                        <label>Highlight</label>
                        <input data-highlight required>
                        <p class="hint">Short phrase, like “Transparent giving”.</p>
                    </div>
                    <div class="wide">
                        <label>Avatar Image</label>
                        <input data-image-file type="file" accept="image/*">
                        <input data-image-url type="hidden" value="">
                        <p class="hint">Upload a square portrait to replace the letter holder on the homepage.</p>
                    </div>
                    <div class="wide">
                        <button class="danger-button" type="button" data-remove-testimonial>Remove Testimonial</button>
                    </div>
                </div>
            `;

            return card;
        }

        document.addEventListener('click', (event) => {
            if (event.target.matches('[data-add-testimonial]')) {
                document.querySelector('[data-testimonial-list]').appendChild(createTestimonialCard());
                reindexTestimonials();
            }

            if (event.target.matches('[data-remove-testimonial]')) {
                const cards = document.querySelectorAll('[data-testimonial-card]');

                if (cards.length > 1) {
                    event.target.closest('[data-testimonial-card]').remove();
                    reindexTestimonials();
                }
            }
        });

        document.addEventListener('input', (event) => {
            if (event.target.matches('[data-name]')) {
                syncAvatar(event.target.closest('[data-testimonial-card]'));
            }
        });

        document.addEventListener('change', (event) => {
            if (! event.target.matches('[data-image-file]') || ! event.target.files[0]) {
                return;
            }

            const preview = event.target.closest('[data-testimonial-card]').querySelector('[data-avatar-preview]');
            preview.innerHTML = `<img src="${URL.createObjectURL(event.target.files[0])}" alt="">`;
        });

        reindexTestimonials();
    </script>
    @include('admin.partials.mobile-scripts')
</body>
</html>
