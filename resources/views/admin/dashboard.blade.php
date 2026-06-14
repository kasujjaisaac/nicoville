<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Dashboard</title>
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
        .admin-shell { width:min(1180px,calc(100% - 36px)); margin:28px auto 64px; }
        .page-head { display:flex; align-items:end; justify-content:space-between; gap:20px; margin-bottom:22px; }
        .page-head h1 { margin:0; font-size:clamp(30px,4vw,46px); line-height:1.05; }
        .page-head p { max-width:650px; margin:10px 0 0; color:var(--muted); line-height:1.6; }
        .view-site { display:inline-flex; align-items:center; justify-content:center; min-height:44px; padding:0 16px; background:var(--coral); color:var(--white); font-weight:900; white-space:nowrap; }
        .stats { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px; margin-bottom:22px; }
        .stat-card { padding:18px; border:1px solid var(--line); background:var(--white); box-shadow:0 14px 30px rgba(21,33,29,.06); }
        .stat-card span { color:var(--muted); font-size:12px; font-weight:900; text-transform:uppercase; }
        .stat-card strong { display:block; margin-top:6px; color:var(--green); font-size:32px; line-height:1; }
        .section-title { margin:28px 0 14px; font-size:18px; }
        .manager-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:16px; }
        .manager-card { display:grid; align-content:space-between; min-height:190px; padding:20px; border:1px solid var(--line); background:var(--white); box-shadow:0 14px 30px rgba(21,33,29,.06); }
        .manager-card h2 { margin:0 0 8px; font-size:21px; }
        .manager-card p { margin:0; color:var(--muted); line-height:1.55; }
        .manager-card a { display:inline-flex; width:max-content; min-height:42px; align-items:center; justify-content:center; margin-top:18px; padding:0 14px; background:var(--green); color:var(--white); font-weight:900; }
        .booking-list { display:grid; gap:12px; }
        .booking-row { display:grid; grid-template-columns:minmax(0,1fr) auto; gap:16px; align-items:center; padding:16px; border:1px solid var(--line); background:var(--white); }
        .booking-row h3 { margin:0 0 5px; font-size:17px; }
        .booking-row p { margin:0; color:var(--muted); font-size:14px; line-height:1.5; }
        .status { display:inline-flex; min-height:30px; align-items:center; padding:0 10px; background:rgba(217,155,43,.16); color:#785012; font-size:12px; font-weight:900; text-transform:uppercase; }
        @media (max-width:1020px){ .stats,.manager-grid{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:820px){ .admin-layout,.stats,.manager-grid,.booking-row{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} .page-head{display:block;} .view-site{margin-top:16px;} }
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
                <a class="sidebar-link active" href="/admin" aria-current="page"><span class="sidebar-icon">01</span><span>Dashboard</span></a>
                <a class="sidebar-link" href="/admin/media"><span class="sidebar-icon">02</span><span>Media Library</span></a>
                <a class="sidebar-link" href="/admin/slider"><span class="sidebar-icon">03</span><span>Hero Slider</span></a>
                <a class="sidebar-link" href="/admin/impact"><span class="sidebar-icon">04</span><span>Impact Section</span></a>
                <a class="sidebar-link" href="/admin/testimonials"><span class="sidebar-icon">05</span><span>Testimonials</span></a>
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">06</span><span>Site Settings</span></a>
                <a class="sidebar-link" href="/admin/certificates"><span class="sidebar-icon">07</span><span>Certificates</span></a>
                <a class="sidebar-link" href="/admin/team"><span class="sidebar-icon">08</span><span>Team Members</span></a>
                <a class="sidebar-link" href="/admin/contact-messages"><span class="sidebar-icon">09</span><span>Messages</span></a>
                <a class="sidebar-link" href="/admin/donations"><span class="sidebar-icon">10</span><span>Donations</span></a>
                <a class="sidebar-link" href="/admin/event-bookings"><span class="sidebar-icon">11</span><span>Event Bookings</span></a>
            </nav>
            <div class="sidebar-section">Content</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="/admin/content/pages"><span class="sidebar-icon">06</span><span>Pages</span></a>
                <a class="sidebar-link" href="/admin/projects"><span class="sidebar-icon">07</span><span>Projects</span></a>
                <a class="sidebar-link" href="/admin/content/events"><span class="sidebar-icon">08</span><span>Events</span></a>
                <a class="sidebar-link" href="/admin/content/news"><span class="sidebar-icon">09</span><span>News</span></a>
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
            <header class="page-head">
                <div>
                    <h1>Website Control Center</h1>
                    <p>Update the hero, header, page text, projects, events, news, and visitor bookings from one place.</p>
                </div>
                <a class="view-site" href="/" target="_blank" rel="noopener">View Website</a>
            </header>

            <section class="stats" aria-label="Website summary">
                <div class="stat-card"><span>Slides</span><strong>{{ $counts['slides'] }}</strong></div>
                <div class="stat-card"><span>Projects</span><strong>{{ $counts['projects'] }}</strong></div>
                <div class="stat-card"><span>Causes</span><strong>{{ $counts['causes'] }}</strong></div>
                <div class="stat-card"><span>Events</span><strong>{{ $counts['events'] }}</strong></div>
                <div class="stat-card"><span>News</span><strong>{{ $counts['news'] }}</strong></div>
                <div class="stat-card"><span>Team</span><strong>{{ $counts['team'] }}</strong></div>
                <div class="stat-card"><span>Messages</span><strong>{{ $counts['messages'] }}</strong></div>
                <div class="stat-card"><span>Donations</span><strong>{{ $counts['donations'] }}</strong></div>
                <div class="stat-card"><span>Pending</span><strong>{{ $counts['pending_bookings'] }}</strong></div>
            </section>

            <h2 class="section-title">Manage Website Sections</h2>
            <section class="manager-grid" aria-label="Admin sections">
                <article class="manager-card"><div><h2>Hero Slider</h2><p>Change homepage slide images, headlines, descriptions, and button links.</p></div><a href="/admin/slider">Edit Slider</a></article>
                <article class="manager-card"><div><h2>Media Library</h2><p>Upload reusable images, preview files, copy public paths, and clean up old media.</p></div><a href="/admin/media">Open Library</a></article>
                <article class="manager-card"><div><h2>Impact Section</h2><p>Change the homepage impact statement and the rotating project images.</p></div><a href="/admin/impact">Edit Impact</a></article>
                <article class="manager-card"><div><h2>Testimonials</h2><p>List, add, edit, and remove the homepage testimonial stories.</p></div><a href="/admin/testimonials">Manage Testimonials</a></article>
                <article class="manager-card"><div><h2>Team Members</h2><p>Add people, upload profile photos, and manage the Our Team and profile pages.</p></div><a href="/admin/team">Edit Team</a></article>
                <article class="manager-card"><div><h2>Contact Messages</h2><p>Review website enquiries and mark them new, read, or closed.</p></div><a href="/admin/contact-messages">View Messages</a></article>
                <article class="manager-card"><div><h2>Donations</h2><p>Track contribution pledges, donor details, payment methods, and statuses.</p></div><a href="/admin/donations">View Donations</a></article>
                <article class="manager-card"><div><h2>Site Settings</h2><p>Update logo, phone, email, location, registration details, and menus.</p></div><a href="/admin/site-settings">Edit Settings</a></article>
                <article class="manager-card"><div><h2>Certificates</h2><p>Upload protected certificate previews with Nicoville Foundation watermarking.</p></div><a href="/admin/certificates">Manage Certificates</a></article>
                <article class="manager-card"><div><h2>Page Text</h2><p>Control homepage, about, donation, contact, footer, stats, and support text.</p></div><a href="/admin/content/pages">Edit Pages</a></article>
                <article class="manager-card"><div><h2>Projects</h2><p>Add, edit, review, and delete project reports from a dedicated projects dashboard.</p></div><a href="/admin/projects">Manage Projects</a></article>
                <article class="manager-card"><div><h2>Causes</h2><p>Add, edit, review, and delete fundraising causes and progress details.</p></div><a href="/admin/causes">Manage Causes</a></article>
                <article class="manager-card"><div><h2>Events</h2><p>Update event listings, detail pages, schedules, venues, dates, and gallery images.</p></div><a href="/admin/content/events">Edit Events</a></article>
                <article class="manager-card"><div><h2>News</h2><p>Manage blog cards, update categories, publish dates, summaries, images, and links.</p></div><a href="/admin/content/news">Edit News</a></article>
            </section>

            <h2 class="section-title">Latest Event Bookings</h2>
            <section class="booking-list" aria-label="Latest event bookings">
                @forelse ($latestBookings as $booking)
                    <article class="booking-row">
                        <div>
                            <h3>{{ $booking->event_title }}</h3>
                            <p>{{ $booking->name }} | {{ $booking->email }} | {{ $booking->created_at->format('M j, Y g:i A') }}</p>
                        </div>
                        <span class="status">{{ $booking->status }}</span>
                    </article>
                @empty
                    <article class="booking-row">
                        <div>
                            <h3>No bookings yet</h3>
                            <p>New event confirmations will appear here as visitors submit them.</p>
                        </div>
                    </article>
                @endforelse
            </section>
        </main>
    </div>
</body>
</html>
