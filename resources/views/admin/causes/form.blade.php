<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | {{ $mode === 'create' ? 'Add Cause' : 'Edit Cause' }}</title>
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
        .errors { margin-bottom:18px; padding:14px 16px; border:1px solid rgba(201,84,61,.28); color:#8f2e1e; background:rgba(201,84,61,.09); font-weight:800; }
        .page-head { display:flex; align-items:end; justify-content:space-between; gap:20px; margin-bottom:22px; }
        .page-head h1 { margin:0 0 8px; font-size:34px; }
        .page-head p { max-width:680px; margin:0; color:var(--muted); line-height:1.6; }
        .form-section { margin-bottom:18px; padding:20px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); }
        .form-section h2 { margin:0 0 16px; font-size:22px; }
        .form-row { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; }
        .form-row.three { grid-template-columns:repeat(3,minmax(0,1fr)); }
        .field { display:grid; gap:7px; margin-bottom:14px; }
        label { color:var(--ink); font-size:12px; font-weight:900; text-transform:uppercase; }
        input,textarea { width:100%; border:1px solid var(--line); background:#fbfcfa; color:var(--ink); font:inherit; font-size:14px; outline:0; }
        input { min-height:44px; padding:0 12px; }
        input[type="file"] { padding:10px 12px; }
        textarea { min-height:130px; padding:12px; line-height:1.55; resize:vertical; }
        small { color:var(--muted); font-size:12px; line-height:1.45; }
        .preview { width:100%; min-height:260px; border:1px solid var(--line); background:linear-gradient(rgba(7,63,49,.12),rgba(7,63,49,.22)),var(--preview-image); background-position:center; background-size:cover; }
        .actions { position:sticky; bottom:0; display:flex; justify-content:space-between; gap:12px; padding:16px 0; background:linear-gradient(transparent,var(--paper) 30%); }
        .button,.small-button { display:inline-flex; align-items:center; justify-content:center; min-height:48px; padding:0 18px; border:0; font:inherit; font-weight:900; cursor:pointer; }
        .button { color:var(--white); background:var(--coral); }
        .small-button { border:1px solid var(--green); color:var(--green-dark); background:rgba(15,111,77,.08); }
        @media (max-width:900px){ .admin-layout,.form-row,.form-row.three{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} .page-head,.actions{display:block;} .button,.small-button{margin-top:12px;} }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar" aria-label="Admin navigation">
            <a class="sidebar-brand" href="/admin"><span class="brand-mark">N</span><span><span class="brand-name">Nicoville</span><span class="brand-role">Admin Panel</span></span></a>
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
                <a class="sidebar-link" href="/admin/projects"><span class="sidebar-icon">06</span><span>Projects</span></a>
                <a class="sidebar-link active" href="/admin/causes" aria-current="page"><span class="sidebar-icon">07</span><span>Causes</span></a>
                <a class="sidebar-link" href="/admin/content/events"><span class="sidebar-icon">08</span><span>Events</span></a>
                <a class="sidebar-link" href="/admin/content/news"><span class="sidebar-icon">09</span><span>News</span></a>
            </nav>
            <div class="sidebar-footer">
                <p class="admin-user">Signed in as<br><strong>{{ auth()->user()->email }}</strong></p>
                <form method="POST" action="/admin/logout">@csrf<button class="logout-button" type="submit">Logout</button></form>
            </div>
        </aside>

        <main class="admin-shell">
            @if ($errors->any())
                <div class="errors"><strong>Please fix these fields:</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <header class="page-head">
                <div>
                    <h1>{{ $mode === 'create' ? 'Add Cause' : 'Edit Cause' }}</h1>
                    <p>Add fundraising details, image, progress, and impact notes for the public Causes page.</p>
                </div>
                <a class="small-button" href="/admin/causes">Back to Causes</a>
            </header>

            <form method="POST" action="{{ $mode === 'create' ? '/admin/causes' : '/admin/causes/'.$cause['slug'] }}" enctype="multipart/form-data">
                @csrf
                @if ($mode === 'edit') @method('PATCH') @endif

                <section class="form-section">
                    <h2>Cause Details</h2>
                    <div class="form-row three">
                        <div class="field"><label>Title</label><input name="title" value="{{ old('title', $cause['title']) }}" required></div>
                        <div class="field"><label>Slug</label><input name="slug" value="{{ old('slug', $cause['slug']) }}"><small>Leave blank to generate from the title.</small></div>
                        <div class="field"><label>Category</label><input name="category" value="{{ old('category', $cause['category']) }}" required></div>
                    </div>
                    <div class="field"><label>Short Brief</label><textarea name="brief" required>{{ old('brief', $cause['brief']) }}</textarea></div>
                    <div class="form-row">
                        <div class="field"><label>Target Amount</label><input name="target" type="number" min="0" value="{{ old('target', $cause['target']) }}" required></div>
                        <div class="field"><label>Raised Amount</label><input name="raised" type="number" min="0" value="{{ old('raised', $cause['raised']) }}" required></div>
                    </div>
                </section>

                <section class="form-section">
                    <h2>Image</h2>
                    <div class="form-row">
                        <div class="field"><label>Image Path</label><input name="image" value="{{ old('image', $cause['image']) }}"><small>Paste a Media Library path or keep the existing one.</small></div>
                        <div class="field"><label>Choose Image</label><input id="imageFile" name="image_file" type="file" accept="image/*"><small>Uploading replaces the image path.</small></div>
                    </div>
                    <div class="preview" id="imagePreview" style="--preview-image:url('{{ old('image', $cause['image']) }}');"></div>
                </section>

                <section class="form-section">
                    <h2>Details and Impact</h2>
                    <div class="form-row">
                        <div class="field"><label>Details</label><textarea name="details_text">{{ old('details_text', implode("\n", $cause['details'])) }}</textarea><small>One paragraph per line.</small></div>
                        <div class="field"><label>Impact Points</label><textarea name="impact_text">{{ old('impact_text', implode("\n", $cause['impact'])) }}</textarea><small>One impact point per line.</small></div>
                    </div>
                </section>

                <div class="actions">
                    <a class="small-button" href="/admin/causes">Cancel</a>
                    <button class="button" type="submit">{{ $mode === 'create' ? 'Add Cause' : 'Save Cause' }}</button>
                </div>
            </form>
        </main>
    </div>
    <script>
        const imageFile = document.querySelector('#imageFile');
        const imagePreview = document.querySelector('#imagePreview');
        imageFile?.addEventListener('change', () => {
            if (imageFile.files[0]) {
                imagePreview.style.setProperty('--preview-image', `url('${URL.createObjectURL(imageFile.files[0])}')`);
            }
        });
    </script>
</body>
</html>
