<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Team Members</title>
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
        .member-card { display:grid; grid-template-columns:minmax(240px,.42fr) minmax(0,1fr); gap:18px; margin-bottom:18px; padding:18px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); }
        .preview { min-height:320px; background:linear-gradient(rgba(7,63,49,.16),rgba(7,63,49,.34)),var(--preview-image); background-position:center; background-size:cover; }
        .fields-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; align-content:start; }
        .field.full { grid-column:1 / -1; }
        label { display:block; margin-bottom:7px; color:var(--ink); font-size:13px; font-weight:900; text-transform:uppercase; }
        input,textarea { width:100%; border:1px solid var(--line); color:var(--ink); background:#fbfcfa; font:inherit; }
        input { min-height:44px; padding:0 12px; }
        input[type="file"] { padding:10px 12px; }
        textarea { min-height:110px; padding:12px; resize:vertical; }
        .bio-area { min-height:190px; }
        .hint { margin:7px 0 0; color:var(--muted); font-size:13px; line-height:1.45; }
        .button-row { display:flex; flex-wrap:wrap; gap:10px; margin:14px 0; }
        .small-button,.danger-button,.order-button { min-height:40px; padding:0 14px; border-radius:0; font:inherit; font-size:14px; font-weight:900; cursor:pointer; }
        .small-button { border:1px solid var(--green); color:var(--green-dark); background:rgba(15,111,77,.08); }
        .order-button { border:1px solid var(--line); color:var(--green-dark); background:var(--white); }
        .danger-button { border:1px solid rgba(201,84,61,.3); color:#8f2e1e; background:rgba(201,84,61,.08); }
        .actions { position:sticky; bottom:0; display:flex; justify-content:flex-end; padding:16px 0; background:linear-gradient(transparent,var(--paper) 30%); }
        .save-button { min-height:50px; padding:0 24px; border:0; color:var(--white); background:var(--coral); font:inherit; font-weight:900; cursor:pointer; }
        @media (max-width:900px){ .admin-layout,.member-card,.fields-grid{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} .field.full{grid-column:auto;} }
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
                <a class="sidebar-link" href="/admin/impact"><span class="sidebar-icon">03</span><span>Impact Section</span></a>
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">04</span><span>Site Settings</span></a>
                <a class="sidebar-link active" href="/admin/team" aria-current="page"><span class="sidebar-icon">05</span><span>Team Members</span></a>
                <a class="sidebar-link" href="/admin/event-bookings"><span class="sidebar-icon">06</span><span>Event Bookings</span></a>
            </nav>
            <div class="sidebar-section">Content</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="/admin/content/pages"><span class="sidebar-icon">07</span><span>Page Text</span></a>
                <a class="sidebar-link" href="/admin/projects"><span class="sidebar-icon">08</span><span>Projects</span></a>
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
                    <h1>Team Members</h1>
                    <p>Add, reorder, and update the people shown on the Our Team page and their individual profile pages.</p>
                </div>
                <a class="small-button" href="/our-team" target="_blank" rel="noopener">View Team Page</a>
            </header>

            <form method="POST" action="/admin/team" enctype="multipart/form-data">
                @csrf

                <div id="memberList">
                    @foreach ($members as $index => $member)
                        <section class="member-card" data-member-card>
                            <div class="preview" style="--preview-image:url('{{ $member['photo'] }}');" aria-label="{{ $member['name'] }} photo preview"></div>
                            <div class="fields-grid">
                                <div class="field">
                                    <label>Name</label>
                                    <input data-member-name name="members[{{ $index }}][name]" value="{{ old("members.$index.name", $member['name']) }}" required>
                                </div>
                                <div class="field">
                                    <label>Role</label>
                                    <input data-member-role name="members[{{ $index }}][role]" value="{{ old("members.$index.role", $member['role']) }}" required>
                                </div>
                                <div class="field">
                                    <label>Page Slug</label>
                                    <input data-member-slug name="members[{{ $index }}][slug]" value="{{ old("members.$index.slug", $member['slug']) }}">
                                </div>
                                <div class="field">
                                    <label>Upload Photo</label>
                                    <input data-member-photo-file name="members[{{ $index }}][photo_file]" type="file" accept="image/*">
                                </div>
                                <div class="field full">
                                    <label>Photo URL</label>
                                    <input data-member-photo-url name="members[{{ $index }}][photo_url]" value="{{ old("members.$index.photo_url", $member['photo']) }}">
                                </div>
                                <div class="field full">
                                    <label>Short Summary</label>
                                    <textarea data-member-summary name="members[{{ $index }}][summary]" required>{{ old("members.$index.summary", $member['summary']) }}</textarea>
                                </div>
                                <div class="field full">
                                    <label>Full Profile Bio</label>
                                    <textarea class="bio-area" data-member-bio name="members[{{ $index }}][bio]" required>{{ old("members.$index.bio", implode("\n\n", $member['bio'])) }}</textarea>
                                    <p class="hint">Use a blank line between paragraphs. This appears on the single team member page.</p>
                                </div>
                                <div class="field">
                                    <label>Email</label>
                                    <input data-member-email name="members[{{ $index }}][email]" type="email" value="{{ old("members.$index.email", $member['email']) }}">
                                </div>
                                <div class="field">
                                    <label>Phone</label>
                                    <input data-member-phone name="members[{{ $index }}][phone]" value="{{ old("members.$index.phone", $member['phone']) }}">
                                </div>
                                <div class="button-row field full">
                                    <button class="order-button" type="button" data-move-up>Move Up</button>
                                    <button class="order-button" type="button" data-move-down>Move Down</button>
                                    <button class="danger-button" type="button" data-remove-member>Remove Member</button>
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>

                <div class="button-row">
                    <button class="small-button" type="button" id="addMemberButton">Add Team Member</button>
                </div>

                <div class="actions">
                    <button class="save-button" type="submit">Save Team Members</button>
                </div>
            </form>
        </main>
    </div>

    <script>
        const memberList = document.querySelector('#memberList');
        const addMemberButton = document.querySelector('#addMemberButton');

        function reindexMembers() {
            Array.from(memberList.querySelectorAll('[data-member-card]')).forEach((card, index) => {
                card.querySelector('[data-member-name]').name = `members[${index}][name]`;
                card.querySelector('[data-member-role]').name = `members[${index}][role]`;
                card.querySelector('[data-member-slug]').name = `members[${index}][slug]`;
                card.querySelector('[data-member-photo-file]').name = `members[${index}][photo_file]`;
                card.querySelector('[data-member-photo-url]').name = `members[${index}][photo_url]`;
                card.querySelector('[data-member-summary]').name = `members[${index}][summary]`;
                card.querySelector('[data-member-bio]').name = `members[${index}][bio]`;
                card.querySelector('[data-member-email]').name = `members[${index}][email]`;
                card.querySelector('[data-member-phone]').name = `members[${index}][phone]`;
            });
        }

        function createMemberCard() {
            const card = document.createElement('section');
            card.className = 'member-card';
            card.dataset.memberCard = '';
            card.innerHTML = `
                <div class="preview" style="--preview-image:linear-gradient(rgba(7,63,49,.16),rgba(7,63,49,.34));"></div>
                <div class="fields-grid">
                    <div class="field"><label>Name</label><input data-member-name required></div>
                    <div class="field"><label>Role</label><input data-member-role required></div>
                    <div class="field"><label>Page Slug</label><input data-member-slug></div>
                    <div class="field"><label>Upload Photo</label><input data-member-photo-file type="file" accept="image/*"></div>
                    <div class="field full"><label>Photo URL</label><input data-member-photo-url></div>
                    <div class="field full"><label>Short Summary</label><textarea data-member-summary required></textarea></div>
                    <div class="field full"><label>Full Profile Bio</label><textarea class="bio-area" data-member-bio required></textarea><p class="hint">Use a blank line between paragraphs. This appears on the single team member page.</p></div>
                    <div class="field"><label>Email</label><input data-member-email type="email"></div>
                    <div class="field"><label>Phone</label><input data-member-phone></div>
                    <div class="button-row field full">
                        <button class="order-button" type="button" data-move-up>Move Up</button>
                        <button class="order-button" type="button" data-move-down>Move Down</button>
                        <button class="danger-button" type="button" data-remove-member>Remove Member</button>
                    </div>
                </div>
            `;

            return card;
        }

        addMemberButton.addEventListener('click', () => {
            memberList.appendChild(createMemberCard());
            reindexMembers();
        });

        memberList.addEventListener('click', (event) => {
            const card = event.target.closest('[data-member-card]');

            if (! card) {
                return;
            }

            if (event.target.matches('[data-move-up]') && card.previousElementSibling) {
                memberList.insertBefore(card, card.previousElementSibling);
                reindexMembers();
            }

            if (event.target.matches('[data-move-down]') && card.nextElementSibling) {
                memberList.insertBefore(card.nextElementSibling, card);
                reindexMembers();
            }

            if (event.target.matches('[data-remove-member]') && memberList.querySelectorAll('[data-member-card]').length > 1) {
                card.remove();
                reindexMembers();
            }
        });

        memberList.addEventListener('change', (event) => {
            if (! event.target.matches('[data-member-photo-file]') || ! event.target.files[0]) {
                return;
            }

            const preview = event.target.closest('[data-member-card]').querySelector('.preview');
            preview.style.setProperty('--preview-image', `url('${URL.createObjectURL(event.target.files[0])}')`);
        });

        reindexMembers();
    </script>
    @include('admin.partials.mobile-scripts')
</body>
</html>
