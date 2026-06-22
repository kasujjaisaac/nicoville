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
        body { margin:0; color:var(--ink); font-family:'Poppins',Arial,sans-serif; font-size:14px; background:var(--paper); }
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
        .admin-shell { width:min(1180px,calc(100% - 36px)); margin:28px auto 64px; }
        .notice,.errors { margin-bottom:18px; padding:14px 16px; font-weight:800; }
        .notice { border:1px solid rgba(15,111,77,.25); color:var(--green-dark); background:rgba(15,111,77,.09); }
        .errors { border:1px solid rgba(201,84,61,.28); color:#8f2e1e; background:rgba(201,84,61,.09); }
        .page-head { display:flex; align-items:end; justify-content:space-between; gap:20px; margin-bottom:22px; }
        .page-head h1 { margin:0 0 8px; font-size:34px; }
        .page-head p { max-width:680px; margin:0; color:var(--muted); line-height:1.6; }
        .button,.small-button,.danger-button { display:inline-flex; align-items:center; justify-content:center; min-height:42px; padding:0 14px; border:0; font:inherit; font-weight:900; cursor:pointer; }
        .button { min-height:48px; padding:0 18px; color:var(--white); background:var(--coral); }
        .small-button { border:1px solid var(--green); color:var(--green-dark); background:rgba(15,111,77,.08); }
        .danger-button { border:1px solid rgba(201,84,61,.3); color:#8f2e1e; background:rgba(201,84,61,.08); }
        .panel { margin-bottom:18px; padding:20px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); }
        .panel h2 { margin:0 0 16px; font-size:22px; }
        .heading-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; }
        .field { display:grid; gap:7px; }
        .field.full { grid-column:1 / -1; }
        label { color:var(--ink); font-size:12px; font-weight:900; text-transform:uppercase; }
        input,textarea { width:100%; border:1px solid var(--line); background:#fbfcfa; color:var(--ink); font:inherit; font-size:14px; outline:0; }
        input { min-height:44px; padding:0 12px; }
        textarea { min-height:100px; padding:12px; line-height:1.55; resize:vertical; }
        .testimonial-table { border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); overflow:hidden; }
        .testimonial-row { display:grid; grid-template-columns:78px minmax(0,1fr) 180px 230px; gap:16px; align-items:center; padding:14px; border-bottom:1px solid var(--line); }
        .testimonial-row:last-child { border-bottom:0; }
        .testimonial-head { color:var(--muted); background:#fbfcfa; font-size:12px; font-weight:900; text-transform:uppercase; }
        .avatar { display:grid; width:64px; height:64px; place-items:center; overflow:hidden; color:var(--white); background:linear-gradient(135deg,var(--green),var(--gold)); font-size:22px; font-weight:900; border-radius:50%; }
        .avatar img { width:100%; height:100%; object-fit:cover; }
        .testimonial-title strong { display:block; font-size:16px; }
        .testimonial-title span { display:block; margin-top:5px; color:var(--muted); line-height:1.45; }
        .highlight { display:inline-flex; width:max-content; min-height:30px; align-items:center; padding:0 10px; background:rgba(15,111,77,.09); color:var(--green); font-size:12px; font-weight:900; text-transform:uppercase; }
        .actions { display:flex; flex-wrap:wrap; gap:8px; }
        .section-actions { display:flex; justify-content:flex-end; margin-top:14px; }
        .empty { padding:34px; text-align:center; color:var(--muted); }
        @media (max-width:980px){ .admin-layout,.heading-grid,.testimonial-row{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} .testimonial-head{display:none;} .page-head{display:block;} .button{margin-top:14px;} .field.full{grid-column:auto;} }
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
                <a class="sidebar-link active" href="/admin/testimonials" aria-current="page"><span class="sidebar-icon">04</span><span>Testimonials</span></a>
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">05</span><span>Site Settings</span></a>
            </nav>
            <div class="sidebar-section">Content</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="/admin/content/pages"><span class="sidebar-icon">06</span><span>Page Text</span></a>
                <a class="sidebar-link" href="/admin/projects"><span class="sidebar-icon">07</span><span>Projects</span></a>
                <a class="sidebar-link" href="/admin/certificates"><span class="sidebar-icon">08</span><span>Certificates</span></a>
                <a class="sidebar-link" href="/admin/content/events"><span class="sidebar-icon">09</span><span>Events</span></a>
                <a class="sidebar-link" href="/admin/content/news"><span class="sidebar-icon">10</span><span>News</span></a>
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
                    <p>Manage the quotes shown on the homepage. Add each testimonial separately so the list stays easy to review.</p>
                </div>
                <a class="button" href="/admin/testimonials/create">Add Testimonial</a>
            </header>

            <section class="panel">
                <h2>Homepage Section Heading</h2>
                <form method="POST" action="/admin/testimonials/heading">
                    @csrf
                    <div class="heading-grid">
                        <div class="field">
                            <label for="testimonials_kicker">Small Heading</label>
                            <input id="testimonials_kicker" name="testimonials_kicker" value="{{ old('testimonials_kicker', $home['testimonials_kicker']) }}" required>
                        </div>
                        <div class="field">
                            <label for="testimonials_title">Main Heading</label>
                            <input id="testimonials_title" name="testimonials_title" value="{{ old('testimonials_title', $home['testimonials_title']) }}" required>
                        </div>
                        <div class="field full">
                            <label for="testimonials_intro">Intro Text</label>
                            <textarea id="testimonials_intro" name="testimonials_intro" required>{{ old('testimonials_intro', $home['testimonials_intro']) }}</textarea>
                        </div>
                    </div>
                    <div class="section-actions">
                        <button class="small-button" type="submit">Save Heading</button>
                    </div>
                </form>
            </section>

            <section class="testimonial-table" aria-label="Testimonials list">
                <div class="testimonial-row testimonial-head">
                    <span>Photo</span>
                    <span>Testimonial</span>
                    <span>Highlight</span>
                    <span>Actions</span>
                </div>

                @forelse ($testimonials as $index => $testimonial)
                    @php $image = $testimonial['image'] ?? ''; @endphp
                    <article class="testimonial-row">
                        <div class="avatar">
                            @if (filled($image))
                                <img src="{{ $image }}" alt="{{ $testimonial['name'] ?? 'Testimonial' }} photo">
                            @else
                                {{ strtoupper(substr($testimonial['name'] ?? 'N', 0, 1)) }}
                            @endif
                        </div>
                        <div class="testimonial-title">
                            <strong>{{ $testimonial['name'] ?? 'Unnamed testimonial' }}</strong>
                            @if (filled($testimonial['email'] ?? null))
                                <span>{{ $testimonial['email'] }}</span>
                            @endif
                            <span>{{ $testimonial['role'] ?? '' }}</span>
                            <span>{{ Str::limit($testimonial['quote'] ?? '', 130) }}</span>
                        </div>
                        <span class="highlight">{{ $testimonial['highlight'] ?? 'Testimonial' }}</span>
                        <div class="actions">
                            <a class="small-button" href="/#testimonials" target="_blank" rel="noopener">View</a>
                            <a class="small-button" href="/admin/testimonials/{{ $index }}/edit">Edit</a>
                            <form method="POST" action="/admin/testimonials/{{ $index }}" onsubmit="return confirm('Delete this testimonial?');">
                                @csrf
                                @method('DELETE')
                                <button class="danger-button" type="submit">Delete</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="empty">
                        <p>No testimonials yet.</p>
                        <a class="button" href="/admin/testimonials/create">Add Your First Testimonial</a>
                    </div>
                @endforelse
            </section>
        </main>
    </div>
    @include('admin.partials.mobile-scripts')
</body>
</html>
