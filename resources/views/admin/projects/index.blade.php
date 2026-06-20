<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Projects</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#15211d; --muted:#6f7d78; --line:#dbe6e0; --green:#0f6f4d; --green-dark:#073f31; --coral:#c9543d; --paper:#f8f5ee; --white:#fff; }
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
        .page-head { display:flex; align-items:end; justify-content:space-between; gap:20px; margin-bottom:22px; }
        .page-head h1 { margin:0 0 8px; font-size:34px; }
        .page-head p { max-width:680px; margin:0; color:var(--muted); line-height:1.6; }
        .button,.small-button,.danger-button { display:inline-flex; align-items:center; justify-content:center; min-height:42px; padding:0 14px; border:0; font:inherit; font-weight:900; cursor:pointer; }
        .button { min-height:48px; padding:0 18px; color:var(--white); background:var(--coral); }
        .small-button { border:1px solid var(--green); color:var(--green-dark); background:rgba(15,111,77,.08); }
        .danger-button { border:1px solid rgba(201,84,61,.3); color:#8f2e1e; background:rgba(201,84,61,.08); }
        .project-table { border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); overflow:hidden; }
        .project-row { display:grid; grid-template-columns:96px minmax(0,1fr) 150px 120px 230px; gap:16px; align-items:center; padding:14px; border-bottom:1px solid var(--line); }
        .project-row:last-child { border-bottom:0; }
        .project-head { color:var(--muted); background:#fbfcfa; font-size:12px; font-weight:900; text-transform:uppercase; }
        .thumb { width:96px; height:72px; object-fit:cover; background:var(--line); }
        .project-title strong { display:block; font-size:16px; }
        .project-title span { display:block; margin-top:4px; color:var(--muted); line-height:1.45; }
        .status { display:inline-flex; width:max-content; min-height:30px; align-items:center; padding:0 10px; background:rgba(15,111,77,.09); color:var(--green); font-size:12px; font-weight:900; text-transform:uppercase; }
        .actions { display:flex; flex-wrap:wrap; gap:8px; }
        .empty { padding:34px; text-align:center; color:var(--muted); }
        @media (max-width:980px){ .admin-layout,.project-row{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} .project-head{display:none;} .thumb{width:100%;height:220px;} .page-head{display:block;} .button{margin-top:14px;} }
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
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">04</span><span>Site Settings</span></a>
            </nav>
            <div class="sidebar-section">Content</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="/admin/content/pages"><span class="sidebar-icon">05</span><span>Page Text</span></a>
                <a class="sidebar-link active" href="/admin/projects" aria-current="page"><span class="sidebar-icon">06</span><span>Projects</span></a>
                <a class="sidebar-link" href="/admin/causes"><span class="sidebar-icon">07</span><span>Causes</span></a>
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
            @if (session('status'))
                <div class="notice">{{ session('status') }}</div>
            @endif

            <header class="page-head">
                <div>
                    <h1>Projects</h1>
                    <p>Add and manage activity-report style project pages. These appear on the public Projects page.</p>
                </div>
                <a class="button" href="/admin/projects/create">Add Project</a>
            </header>

            <section class="project-table" aria-label="Projects list">
                <div class="project-row project-head">
                    <span>Image</span>
                    <span>Project</span>
                    <span>Category</span>
                    <span>Status</span>
                    <span>Actions</span>
                </div>

                @forelse ($projects as $project)
                    <article class="project-row">
                        @if ($project['image'])
                            <img class="thumb" src="{{ $project['image'] }}" alt="{{ $project['title'] }}">
                        @else
                            <span class="thumb"></span>
                        @endif
                        <div class="project-title">
                            <strong>{{ $project['title'] }}</strong>
                            <span>{{ $project['started'] ? 'Started '.$project['started'].' | ' : '' }}{{ $project['summary'] }}</span>
                        </div>
                        <span>{{ $project['category'] }}</span>
                        <span class="status">{{ $project['status'] }}</span>
                        <div class="actions">
                            <a class="small-button" href="/projects/{{ $project['slug'] }}" target="_blank" rel="noopener">View</a>
                            <a class="small-button" href="/admin/projects/{{ $project['slug'] }}/edit">Edit</a>
                            <form method="POST" action="/admin/projects/{{ $project['slug'] }}" onsubmit="return confirm('Delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button class="danger-button" type="submit">Delete</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="empty">
                        <p>No projects yet.</p>
                        <a class="button" href="/admin/projects/create">Add Your First Project</a>
                    </div>
                @endforelse
            </section>
        </main>
    </div>
    @include('admin.partials.mobile-scripts')
</body>
</html>
