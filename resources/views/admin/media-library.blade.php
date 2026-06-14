<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Media Library</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#15211d; --muted:#6f7d78; --line:#dbe6e0; --green:#0f6f4d; --green-dark:#073f31; --coral:#c9543d; --paper:#f8f5ee; --white:#fff; }
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
        .admin-shell { width:min(1220px,calc(100% - 36px)); margin:28px auto 64px; }
        .notice,.errors { margin-bottom:18px; padding:14px 16px; font-weight:800; }
        .notice { border:1px solid rgba(15,111,77,.25); color:var(--green-dark); background:rgba(15,111,77,.09); }
        .errors { border:1px solid rgba(201,84,61,.28); color:#8f2e1e; background:rgba(201,84,61,.09); }
        .page-head { display:flex; align-items:end; justify-content:space-between; gap:20px; margin-bottom:20px; }
        .page-head h1 { margin:0 0 8px; font-size:32px; }
        .page-head p { margin:0; color:var(--muted); line-height:1.6; }
        .upload-panel { display:grid; grid-template-columns:220px minmax(0,1fr) auto; gap:14px; align-items:end; margin-bottom:22px; padding:18px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); }
        label { display:block; margin-bottom:7px; color:var(--ink); font-size:13px; font-weight:900; text-transform:uppercase; }
        select,input { width:100%; min-height:44px; border:1px solid var(--line); padding:0 12px; color:var(--ink); background:#fbfcfa; font:inherit; }
        input[type="file"] { padding:10px 12px; }
        .save-button,.copy-button,.danger-button { min-height:42px; padding:0 14px; border-radius:0; font:inherit; font-size:13px; font-weight:900; cursor:pointer; }
        .save-button { border:0; color:var(--white); background:var(--coral); }
        .copy-button { border:1px solid var(--green); color:var(--green-dark); background:rgba(15,111,77,.08); }
        .danger-button { border:1px solid rgba(201,84,61,.3); color:#8f2e1e; background:rgba(201,84,61,.08); }
        .media-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; }
        .media-card { overflow:hidden; border:1px solid var(--line); background:var(--white); box-shadow:0 14px 30px rgba(21,33,29,.06); }
        .media-preview { aspect-ratio:4 / 3; background:#edf5ef; }
        .media-preview img { width:100%; height:100%; object-fit:cover; display:block; }
        .media-body { display:grid; gap:10px; padding:14px; }
        .media-name { overflow:hidden; font-size:13px; font-weight:900; text-overflow:ellipsis; white-space:nowrap; }
        .media-meta { display:flex; flex-wrap:wrap; gap:8px; color:var(--muted); font-size:12px; font-weight:700; }
        .media-path { width:100%; min-height:36px; padding:0 10px; border:1px solid var(--line); background:#fbfcfa; color:var(--muted); font-size:12px; }
        .media-actions { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
        @media (max-width:1100px){ .media-grid{grid-template-columns:repeat(3,minmax(0,1fr));} }
        @media (max-width:820px){ .admin-layout,.upload-panel{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} .media-grid{grid-template-columns:repeat(2,minmax(0,1fr));} }
        @media (max-width:560px){ .media-grid{grid-template-columns:1fr;} }
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
                <a class="sidebar-link active" href="/admin/media" aria-current="page"><span class="sidebar-icon">02</span><span>Media Library</span></a>
                <a class="sidebar-link" href="/admin/slider"><span class="sidebar-icon">03</span><span>Hero Slider</span></a>
                <a class="sidebar-link" href="/admin/impact"><span class="sidebar-icon">04</span><span>Impact Section</span></a>
                <a class="sidebar-link" href="/admin/team"><span class="sidebar-icon">05</span><span>Team Members</span></a>
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">06</span><span>Site Settings</span></a>
            </nav>
            <div class="sidebar-section">Operations</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="/admin/contact-messages"><span class="sidebar-icon">07</span><span>Messages</span></a>
                <a class="sidebar-link" href="/admin/donations"><span class="sidebar-icon">08</span><span>Donations</span></a>
                <a class="sidebar-link" href="/admin/event-bookings"><span class="sidebar-icon">09</span><span>Event Bookings</span></a>
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
                    <h1>Media Library</h1>
                    <p>Upload images once, copy their public paths, and reuse them across sliders, team profiles, causes, news, and events.</p>
                </div>
            </header>

            <form class="upload-panel" method="POST" action="/admin/media" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="folder">Folder</label>
                    <select id="folder" name="folder" required>
                        @foreach ($folders as $folder)
                            <option value="{{ $folder }}">{{ ucfirst($folder) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="files">Images</label>
                    <input id="files" name="files[]" type="file" accept="image/*" multiple required>
                </div>
                <button class="save-button" type="submit">Upload Media</button>
            </form>

            <section class="media-grid" aria-label="Uploaded media">
                @forelse ($files as $file)
                    <article class="media-card">
                        <div class="media-preview">
                            <img src="{{ $file['path'] }}" alt="{{ $file['name'] }}">
                        </div>
                        <div class="media-body">
                            <div class="media-name" title="{{ $file['name'] }}">{{ $file['name'] }}</div>
                            <div class="media-meta">
                                <span>{{ $file['folder'] }}</span>
                                <span>{{ $file['size'] }}</span>
                                <span>{{ $file['modified'] }}</span>
                            </div>
                            <input class="media-path" value="{{ $file['path'] }}" readonly>
                            <div class="media-actions">
                                <button class="copy-button" type="button" data-copy="{{ $file['path'] }}">Copy Path</button>
                                <form method="POST" action="/admin/media" onsubmit="return confirm('Delete this media file?');">
                                    @csrf
                                    @method('DELETE')
                                    <input name="path" type="hidden" value="{{ $file['path'] }}">
                                    <button class="danger-button" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="notice">No uploaded media found yet.</div>
                @endforelse
            </section>
        </main>
    </div>
    <script>
        document.addEventListener('click', async (event) => {
            if (! event.target.matches('[data-copy]')) {
                return;
            }

            await navigator.clipboard.writeText(event.target.dataset.copy);
            event.target.textContent = 'Copied';

            window.setTimeout(() => {
                event.target.textContent = 'Copy Path';
            }, 1400);
        });
    </script>
</body>
</html>
