<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Impact Section</title>
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
        .admin-shell { width:min(1120px,calc(100% - 36px)); margin:28px auto 64px; }
        .notice,.errors { margin-bottom:18px; padding:14px 16px; font-weight:800; }
        .notice { border:1px solid rgba(15,111,77,.25); color:var(--green-dark); background:rgba(15,111,77,.09); }
        .errors { border:1px solid rgba(201,84,61,.28); color:#8f2e1e; background:rgba(201,84,61,.09); }
        .page-head { margin-bottom:20px; }
        .page-head h1 { margin:0 0 8px; font-size:30px; }
        .page-head p { margin:0; color:var(--muted); line-height:1.6; }
        .panel { margin-bottom:18px; padding:20px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); }
        .column-panel { margin-bottom:18px; padding:16px; border:1px solid var(--line); background:#fff; }
        .column-panel h2 { margin:0 0 12px; font-size:20px; }
        .image-card { display:grid; grid-template-columns:minmax(220px,.5fr) minmax(0,1fr); gap:18px; margin-bottom:16px; padding:16px; border:1px solid var(--line); background:#fbfcfa; }
        .preview { min-height:220px; background:linear-gradient(rgba(7,63,49,.18),rgba(7,63,49,.34)),var(--preview-image); background-position:center; background-size:cover; }
        .fields { display:grid; gap:14px; align-content:start; }
        label { display:block; margin-bottom:7px; color:var(--ink); font-size:13px; font-weight:900; text-transform:uppercase; }
        input,textarea { width:100%; border:1px solid var(--line); color:var(--ink); background:#fbfcfa; font:inherit; }
        input { min-height:44px; padding:0 12px; }
        input[type="file"] { padding:10px 12px; }
        textarea { min-height:130px; padding:12px; resize:vertical; }
        .hint { margin:7px 0 0; color:var(--muted); font-size:13px; line-height:1.4; }
        .button-row { display:flex; flex-wrap:wrap; gap:10px; margin-top:14px; }
        .small-button,.danger-button { min-height:40px; padding:0 14px; border-radius:0; font:inherit; font-size:14px; font-weight:900; cursor:pointer; }
        .small-button { border:1px solid var(--green); color:var(--green-dark); background:rgba(15,111,77,.08); }
        .danger-button { border:1px solid rgba(201,84,61,.3); color:#8f2e1e; background:rgba(201,84,61,.08); }
        .actions { position:sticky; bottom:0; display:flex; justify-content:flex-end; padding:16px 0; background:linear-gradient(transparent,var(--paper) 30%); }
        .save-button { min-height:50px; padding:0 24px; border:0; color:var(--white); background:var(--coral); font:inherit; font-weight:900; cursor:pointer; }
        @media (max-width:820px){ .admin-layout,.image-card{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} }
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
                <a class="sidebar-link" href="/admin/slider"><span class="sidebar-icon">02</span><span>Hero Slider</span></a>
                <a class="sidebar-link active" href="/admin/impact" aria-current="page"><span class="sidebar-icon">03</span><span>Impact Section</span></a>
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">04</span><span>Site Settings</span></a>
                <a class="sidebar-link" href="/admin/event-bookings"><span class="sidebar-icon">05</span><span>Event Bookings</span></a>
            </nav>
            <div class="sidebar-section">Content</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="/admin/content/pages"><span class="sidebar-icon">06</span><span>Page Text</span></a>
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
                <h1>Impact Section</h1>
                <p>Update the rotating images and statement in the homepage projects/impact section.</p>
            </header>

            <form method="POST" action="/admin/impact" enctype="multipart/form-data">
                @csrf

                <section class="panel">
                    <label for="impact_statement">Impact Statement</label>
                    <textarea id="impact_statement" name="impact_statement" required>{{ old('impact_statement', $impactStatement) }}</textarea>
                </section>

                <section class="panel">
                    @foreach ($impact['columns'] as $columnIndex => $column)
                        <div class="column-panel" data-column-panel>
                            <h2>Image Section {{ $columnIndex + 1 }} Slider</h2>
                            <div data-image-list>
                                @foreach ($column['images'] as $imageIndex => $image)
                                    <div class="image-card" data-image-card>
                                        <div class="preview" style="--preview-image:url('{{ $image['image'] }}');" aria-label="Impact section {{ $columnIndex + 1 }} image {{ $imageIndex + 1 }} preview"></div>
                                        <div class="fields">
                                            <div>
                                                <label>Upload Image</label>
                                                <input data-image-file name="columns[{{ $columnIndex }}][images][{{ $imageIndex }}][image_file]" type="file" accept="image/*">
                                            </div>
                                            <div>
                                                <label>Image URL</label>
                                                <input data-image-url name="columns[{{ $columnIndex }}][images][{{ $imageIndex }}][image_url]" value="{{ old("columns.$columnIndex.images.$imageIndex.image_url", $image['image']) }}">
                                                <p class="hint">These images rotate inside image section {{ $columnIndex + 1 }} only.</p>
                                            </div>
                                            <div>
                                                <button class="danger-button" type="button" data-remove-image>Remove Image</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="button-row">
                                <button class="small-button" type="button" data-add-image>Add Image to Section {{ $columnIndex + 1 }}</button>
                            </div>
                        </div>
                    @endforeach
                </section>

                <div class="actions">
                    <button class="save-button" type="submit">Save Impact Changes</button>
                </div>
            </form>
        </main>
    </div>
    <script>
        function reindexImages() {
            Array.from(document.querySelectorAll('[data-column-panel]')).forEach((panel, columnIndex) => {
                Array.from(panel.querySelectorAll('[data-image-card]')).forEach((card, imageIndex) => {
                    card.querySelector('[data-image-file]').name = `columns[${columnIndex}][images][${imageIndex}][image_file]`;
                    card.querySelector('[data-image-url]').name = `columns[${columnIndex}][images][${imageIndex}][image_url]`;
                    card.querySelector('.preview').setAttribute('aria-label', `Impact section ${columnIndex + 1} image ${imageIndex + 1} preview`);
                });
            });
        }

        function createImageCard() {
            const card = document.createElement('div');
            card.className = 'image-card';
            card.dataset.imageCard = '';
            card.innerHTML = `
                <div class="preview" style="--preview-image:linear-gradient(rgba(7,63,49,.18),rgba(7,63,49,.34));"></div>
                <div class="fields">
                    <div>
                        <label>Upload Image</label>
                        <input data-image-file type="file" accept="image/*">
                    </div>
                    <div>
                        <label>Image URL</label>
                        <input data-image-url>
                        <p class="hint">Upload a new image or paste a full image URL/path here.</p>
                    </div>
                    <div>
                        <button class="danger-button" type="button" data-remove-image>Remove Image</button>
                    </div>
                </div>
            `;

            return card;
        }

        document.addEventListener('click', (event) => {
            if (event.target.matches('[data-add-image]')) {
                event.target.closest('[data-column-panel]').querySelector('[data-image-list]').appendChild(createImageCard());
                reindexImages();
            }

            if (event.target.matches('[data-remove-image]')) {
                const panel = event.target.closest('[data-column-panel]');

                if (panel.querySelectorAll('[data-image-card]').length > 1) {
                    event.target.closest('[data-image-card]').remove();
                    reindexImages();
                }
            }
        });

        document.addEventListener('change', (event) => {
            if (! event.target.matches('[data-image-file]') || ! event.target.files[0]) {
                return;
            }

            const preview = event.target.closest('[data-image-card]').querySelector('.preview');
            preview.style.setProperty('--preview-image', `url('${URL.createObjectURL(event.target.files[0])}')`);
        });

        reindexImages();
    </script>
    @include('admin.partials.mobile-scripts')
</body>
</html>
