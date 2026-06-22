<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Content Manager</title>
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
        .errors { border:1px solid rgba(201,84,61,.28); color:#8f2e1e; background:rgba(201,84,61,.09); }
        .tabs { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:18px; }
        .tab { min-height:42px; display:inline-flex; align-items:center; padding:0 14px; border:1px solid var(--line); background:var(--white); color:var(--green-dark); font-weight:900; }
        .tab.active { border-color:var(--green); background:var(--green); color:var(--white); }
        .editor-card { padding:20px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.08); }
        .editor-card h1 { margin:0 0 8px; font-size:30px; }
        .editor-card p { margin:0 0 18px; color:var(--muted); line-height:1.55; }
        .editor-grid { display:grid; gap:18px; margin-top:20px; }
        .form-section { padding:18px; border:1px solid var(--line); background:#fbfcfa; }
        .form-section h2 { margin:0 0 12px; font-size:20px; }
        .form-section h3 { margin:0 0 12px; font-size:17px; }
        .form-row { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; }
        .form-row.three { grid-template-columns:repeat(3,minmax(0,1fr)); }
        .field { display:grid; gap:7px; margin-bottom:14px; }
        label { color:var(--ink); font-size:12px; font-weight:900; text-transform:uppercase; }
        input,textarea { width:100%; border:1px solid var(--line); background:var(--white); color:var(--ink); font:inherit; font-size:14px; outline:0; }
        input { min-height:44px; padding:0 12px; }
        textarea { min-height:110px; padding:12px; line-height:1.55; resize:vertical; }
        textarea.tall { min-height:160px; }
        .field small { color:var(--muted); font-size:12px; line-height:1.45; }
        .item-card { display:grid; gap:4px; padding:16px; border:1px solid rgba(15,111,77,.18); background:var(--white); box-shadow:0 10px 24px rgba(21,33,29,.05); }
        .item-card + .item-card { margin-top:14px; }
        .item-title { display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:8px; }
        .item-title span { display:inline-flex; min-height:30px; align-items:center; padding:0 10px; background:rgba(15,111,77,.09); color:var(--green); font-weight:900; text-transform:uppercase; }
        .actions { position:sticky; bottom:0; display:flex; justify-content:flex-end; padding:16px 0; background:linear-gradient(transparent,var(--paper) 30%); }
        .save-button { min-height:50px; padding:0 24px; border:0; color:var(--white); background:var(--coral); font:inherit; font-weight:900; cursor:pointer; }
        .hint { padding:14px 16px; border-left:4px solid var(--green); background:rgba(15,111,77,.08); color:var(--green-dark); font-size:14px; line-height:1.55; }
        @media (max-width:820px){ .admin-layout{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} .form-row,.form-row.three{grid-template-columns:1fr;} }
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
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">03</span><span>Site Settings</span></a>
                <a class="sidebar-link" href="/admin/event-bookings"><span class="sidebar-icon">04</span><span>Event Bookings</span></a>
            </nav>
            <div class="sidebar-section">Content</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link {{ $section === 'pages' ? 'active' : '' }}" href="/admin/content/pages" @if ($section === 'pages') aria-current="page" @endif><span class="sidebar-icon">05</span><span>Page Text</span></a>
                <a class="sidebar-link" href="/admin/projects"><span class="sidebar-icon">06</span><span>Projects</span></a>
                <a class="sidebar-link {{ $section === 'events' ? 'active' : '' }}" href="/admin/content/events" @if ($section === 'events') aria-current="page" @endif><span class="sidebar-icon">07</span><span>Events</span></a>
                <a class="sidebar-link {{ $section === 'news' ? 'active' : '' }}" href="/admin/content/news" @if ($section === 'news') aria-current="page" @endif><span class="sidebar-icon">08</span><span>News</span></a>
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
            <div class="tabs">
                @foreach ($sections as $key => $label)
                    <a class="tab {{ $key === $section ? 'active' : '' }}" href="/admin/content/{{ $key }}">{{ $label }}</a>
                @endforeach
            </div>
            <form class="editor-card" method="POST" action="/admin/content/{{ $section }}" enctype="multipart/form-data">
                @csrf
                <h1>{{ $sections[$section] }}</h1>
                <p>Update website wording, images, amounts, and page details using the fields below. No code or JSON editing is needed.</p>
                <div class="hint">For image fields, paste an uploaded path such as <strong>/uploads/slides/slide-name.jpg</strong> or a full image URL. For paragraph lists, put each paragraph or point on its own line.</div>

                <div class="editor-grid">
                    @if ($section === 'pages')
                        @php
                            $home = $content['home'] ?? [];
                            $about = $content['about'] ?? [];
                            $donate = $content['donate'] ?? [];
                            $contact = $content['contact'] ?? [];
                        @endphp

                        <section class="form-section">
                            <h2>Home Page Sections</h2>
                            <div class="field">
                                <label for="impact_statement">Impact Statement</label>
                                <textarea id="impact_statement" name="pages[home][impact_statement]">{{ old('pages.home.impact_statement', $home['impact_statement'] ?? '') }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="field">
                                    <label for="causes_heading">Projects Heading</label>
                                    <input id="causes_heading" name="pages[home][causes_heading]" value="{{ old('pages.home.causes_heading', $home['causes_heading'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label for="stats_title">Stats Title</label>
                                    <input id="stats_title" name="pages[home][stats_title]" value="{{ old('pages.home.stats_title', $home['stats_title'] ?? '') }}">
                                </div>
                            </div>
                            <div class="field">
                                <label for="causes_intro">Projects Intro</label>
                                <textarea id="causes_intro" name="pages[home][causes_intro]">{{ old('pages.home.causes_intro', $home['causes_intro'] ?? '') }}</textarea>
                            </div>
                            <div class="form-row three">
                                <div class="field">
                                    <label for="events_kicker">Events Small Heading</label>
                                    <input id="events_kicker" name="pages[home][events_kicker]" value="{{ old('pages.home.events_kicker', $home['events_kicker'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label for="events_title">Events Title</label>
                                    <input id="events_title" name="pages[home][events_title]" value="{{ old('pages.home.events_title', $home['events_title'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label for="news_kicker">News Small Heading</label>
                                    <input id="news_kicker" name="pages[home][news_kicker]" value="{{ old('pages.home.news_kicker', $home['news_kicker'] ?? '') }}">
                                </div>
                            </div>
                            <div class="form-row three">
                                <div class="field">
                                    <label for="news_title">News Title</label>
                                    <input id="news_title" name="pages[home][news_title]" value="{{ old('pages.home.news_title', $home['news_title'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label for="home_contact_title">Home Contact Title</label>
                                    <input id="home_contact_title" name="pages[home][contact_title]" value="{{ old('pages.home.contact_title', $home['contact_title'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label for="contact_button">Contact Button</label>
                                    <input id="contact_button" name="pages[home][contact_button]" value="{{ old('pages.home.contact_button', $home['contact_button'] ?? '') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="field">
                                    <label for="events_intro">Events Intro</label>
                                    <textarea id="events_intro" name="pages[home][events_intro]">{{ old('pages.home.events_intro', $home['events_intro'] ?? '') }}</textarea>
                                </div>
                                <div class="field">
                                    <label for="news_intro">News Intro</label>
                                    <textarea id="news_intro" name="pages[home][news_intro]">{{ old('pages.home.news_intro', $home['news_intro'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="field">
                                <label for="home_contact_intro">Home Contact Intro</label>
                                <textarea id="home_contact_intro" name="pages[home][contact_intro]">{{ old('pages.home.contact_intro', $home['contact_intro'] ?? '') }}</textarea>
                            </div>
                        </section>

                        <section class="form-section">
                            <h2>Stats</h2>
                            @foreach ($home['stats'] ?? [] as $index => $stat)
                                <div class="form-row three">
                                    <div class="field">
                                        <label>Number</label>
                                        <input name="pages[home][stats][{{ $index }}][number]" type="number" value="{{ old("pages.home.stats.$index.number", $stat['number'] ?? 0) }}">
                                    </div>
                                    <div class="field">
                                        <label>Suffix</label>
                                        <input name="pages[home][stats][{{ $index }}][suffix]" value="{{ old("pages.home.stats.$index.suffix", $stat['suffix'] ?? '') }}">
                                    </div>
                                    <div class="field">
                                        <label>Label</label>
                                        <input name="pages[home][stats][{{ $index }}][label]" value="{{ old("pages.home.stats.$index.label", $stat['label'] ?? '') }}">
                                    </div>
                                </div>
                            @endforeach
                        </section>

                        <section class="form-section">
                            <h2>Trust Section</h2>
                            <div class="form-row">
                                <div class="field">
                                    <label>Small Heading</label>
                                    <input name="pages[home][trust_kicker]" value="{{ old('pages.home.trust_kicker', $home['trust_kicker'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label>Main Heading</label>
                                    <input name="pages[home][trust_title]" value="{{ old('pages.home.trust_title', $home['trust_title'] ?? '') }}">
                                </div>
                            </div>
                            @foreach ($home['trust_items'] ?? [] as $index => $item)
                                <div class="item-card">
                                    <div class="item-title"><strong>Trust Item {{ $index + 1 }}</strong></div>
                                    <div class="field">
                                        <label>Title</label>
                                        <input name="pages[home][trust_items][{{ $index }}][title]" value="{{ old("pages.home.trust_items.$index.title", $item['title'] ?? '') }}">
                                    </div>
                                    <div class="field">
                                        <label>Text</label>
                                        <textarea name="pages[home][trust_items][{{ $index }}][text]">{{ old("pages.home.trust_items.$index.text", $item['text'] ?? '') }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </section>

                        <section class="form-section">
                            <h2>Testimonials</h2>
                            <div class="form-row">
                                <div class="field">
                                    <label>Small Heading</label>
                                    <input name="pages[home][testimonials_kicker]" value="{{ old('pages.home.testimonials_kicker', $home['testimonials_kicker'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label>Main Heading</label>
                                    <input name="pages[home][testimonials_title]" value="{{ old('pages.home.testimonials_title', $home['testimonials_title'] ?? '') }}">
                                </div>
                            </div>
                            <div class="field">
                                <label>Intro</label>
                                <textarea name="pages[home][testimonials_intro]">{{ old('pages.home.testimonials_intro', $home['testimonials_intro'] ?? '') }}</textarea>
                            </div>
                            @foreach ($home['testimonials'] ?? [] as $index => $item)
                                <div class="item-card">
                                    <div class="item-title"><strong>Testimonial {{ $index + 1 }}</strong></div>
                                    <div class="field">
                                        <label>Quote</label>
                                        <textarea name="pages[home][testimonials][{{ $index }}][quote]">{{ old("pages.home.testimonials.$index.quote", $item['quote'] ?? '') }}</textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="field"><label>Name</label><input name="pages[home][testimonials][{{ $index }}][name]" value="{{ old("pages.home.testimonials.$index.name", $item['name'] ?? '') }}"></div>
                                        <div class="field"><label>Email</label><input type="email" name="pages[home][testimonials][{{ $index }}][email]" value="{{ old("pages.home.testimonials.$index.email", $item['email'] ?? '') }}"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="field"><label>Role</label><input name="pages[home][testimonials][{{ $index }}][role]" value="{{ old("pages.home.testimonials.$index.role", $item['role'] ?? '') }}"></div>
                                        <div class="field"><label>Highlight</label><input name="pages[home][testimonials][{{ $index }}][highlight]" value="{{ old("pages.home.testimonials.$index.highlight", $item['highlight'] ?? '') }}"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="field"><label>Image</label><input name="pages[home][testimonials][{{ $index }}][image]" value="{{ old("pages.home.testimonials.$index.image", $item['image'] ?? '') }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </section>

                        <section class="form-section">
                            <h2>About, Donate, Contact and Footer</h2>
                            <div class="form-row">
                                <div class="field"><label>About Vision Title</label><input name="pages[about][vision_title]" value="{{ old('pages.about.vision_title', $about['vision_title'] ?? '') }}"></div>
                                <div class="field"><label>About Mission Title</label><input name="pages[about][mission_title]" value="{{ old('pages.about.mission_title', $about['mission_title'] ?? '') }}"></div>
                            </div>
                            <div class="form-row">
                                <div class="field"><label>Vision Paragraphs</label><textarea class="tall" name="pages[about][vision_text]">{{ old('pages.about.vision_text', implode("\n", $about['vision'] ?? [])) }}</textarea><small>Put each paragraph on its own line.</small></div>
                                <div class="field"><label>Mission Paragraphs</label><textarea class="tall" name="pages[about][mission_text]">{{ old('pages.about.mission_text', implode("\n", $about['mission'] ?? [])) }}</textarea><small>Put each paragraph on its own line.</small></div>
                            </div>
                            <div class="form-row three">
                                <div class="field"><label>Motto Title</label><input name="pages[about][motto_title]" value="{{ old('pages.about.motto_title', $about['motto_title'] ?? '') }}"></div>
                                <div class="field"><label>Motto</label><input name="pages[about][motto]" value="{{ old('pages.about.motto', $about['motto'] ?? '') }}"></div>
                                <div class="field"><label>Footer Text</label><input name="pages[home][footer_text]" value="{{ old('pages.home.footer_text', $home['footer_text'] ?? '') }}"></div>
                            </div>

                            <h3>Core Values</h3>
                            <div class="form-row">
                                <div class="field">
                                    <label>Core Values Title</label>
                                    <input name="pages[about][core_values_title]" value="{{ old('pages.about.core_values_title', $about['core_values_title'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label>Core Values Intro</label>
                                    <textarea name="pages[about][core_values_intro]">{{ old('pages.about.core_values_intro', $about['core_values_intro'] ?? '') }}</textarea>
                                </div>
                            </div>
                            @foreach ($about['core_values'] ?? [] as $index => $value)
                                <div class="item-card">
                                    <div class="item-title"><strong>Value {{ $index + 1 }}</strong><span>{{ $value['title'] ?? 'Core Value' }}</span></div>
                                    <div class="form-row">
                                        <div class="field">
                                            <label>Value Name</label>
                                            <input name="pages[about][core_values][{{ $index }}][title]" value="{{ old("pages.about.core_values.$index.title", $value['title'] ?? '') }}">
                                        </div>
                                        <div class="field">
                                            <label>Description</label>
                                            <textarea name="pages[about][core_values][{{ $index }}][text]">{{ old("pages.about.core_values.$index.text", $value['text'] ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-row">
                                <div class="field">
                                    <label>Commitment Title</label>
                                    <input name="pages[about][commitment_title]" value="{{ old('pages.about.commitment_title', $about['commitment_title'] ?? '') }}">
                                </div>
                                <div class="field">
                                    <label>Commitment Text</label>
                                    <textarea name="pages[about][commitment]">{{ old('pages.about.commitment', $about['commitment'] ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="field"><label>Donate Page Title</label><input name="pages[donate][title]" value="{{ old('pages.donate.title', $donate['title'] ?? '') }}"></div>
                                <div class="field"><label>Contact Page Title</label><input name="pages[contact][title]" value="{{ old('pages.contact.title', $contact['title'] ?? '') }}"></div>
                            </div>
                            <div class="form-row">
                                <div class="field"><label>Donate Intro</label><textarea name="pages[donate][intro]">{{ old('pages.donate.intro', $donate['intro'] ?? '') }}</textarea></div>
                                <div class="field"><label>Contact Intro</label><textarea name="pages[contact][intro]">{{ old('pages.contact.intro', $contact['intro'] ?? '') }}</textarea></div>
                            </div>
                            <div class="form-row">
                                <div class="field"><label>Donate Side Title</label><input name="pages[donate][side_title]" value="{{ old('pages.donate.side_title', $donate['side_title'] ?? '') }}"></div>
                                <div class="field"><label>Donate Side Text</label><input name="pages[donate][side_text]" value="{{ old('pages.donate.side_text', $donate['side_text'] ?? '') }}"></div>
                            </div>

                            <h3>Footer Support Links</h3>
                            @foreach ($home['footer_support_links'] ?? [] as $index => $link)
                                <div class="form-row">
                                    <div class="field"><label>Label</label><input name="pages[home][footer_support_links][{{ $index }}][label]" value="{{ old("pages.home.footer_support_links.$index.label", $link['label'] ?? '') }}"></div>
                                    <div class="field"><label>URL</label><input name="pages[home][footer_support_links][{{ $index }}][url]" value="{{ old("pages.home.footer_support_links.$index.url", $link['url'] ?? '') }}"></div>
                                </div>
                            @endforeach

                            <h3>Social Links</h3>
                            @foreach ($home['social_links'] ?? [] as $index => $link)
                                <div class="form-row">
                                    <div class="field"><label>Label</label><input name="pages[home][social_links][{{ $index }}][label]" value="{{ old("pages.home.social_links.$index.label", $link['label'] ?? '') }}"></div>
                                    <div class="field"><label>URL</label><input name="pages[home][social_links][{{ $index }}][url]" value="{{ old("pages.home.social_links.$index.url", $link['url'] ?? '') }}"></div>
                                </div>
                            @endforeach
                        </section>
                    @endif

                    @if ($section === 'projects')
                        @php
                            $projectItems = array_values($content);
                            $projectItems[] = [
                                'stats' => [
                                    ['number' => '', 'label' => ''],
                                    ['number' => '', 'label' => ''],
                                    ['number' => '', 'label' => ''],
                                ],
                                'sections' => [
                                    ['title' => 'Introduction', 'body' => []],
                                    ['title' => 'Why the Project Started', 'body' => []],
                                    ['title' => 'Project Objectives', 'body' => []],
                                    ['title' => 'Activity Description', 'body' => []],
                                    ['title' => 'Beneficiaries Reached', 'body' => []],
                                    ['title' => 'Impact Achieved', 'body' => []],
                                    ['title' => 'Challenges Faced', 'body' => []],
                                    ['title' => 'Success Story', 'body' => []],
                                    ['title' => 'Future Plans', 'body' => []],
                                    ['title' => 'Appreciation', 'body' => []],
                                ],
                            ];
                        @endphp
                        @foreach ($projectItems as $index => $project)
                            <section class="form-section item-card">
                                <div class="item-title"><h2>{{ $project['title'] ?? 'New Project Report' }}</h2><span>{{ empty($project['title'] ?? '') ? 'New Item' : 'Project '.($index + 1) }}</span></div>
                                <div class="form-row three">
                                    <div class="field"><label>Slug</label><input name="projects[{{ $index }}][slug]" value="{{ old("projects.$index.slug", $project['slug'] ?? '') }}"></div>
                                    <div class="field"><label>Title</label><input name="projects[{{ $index }}][title]" value="{{ old("projects.$index.title", $project['title'] ?? '') }}"></div>
                                    <div class="field"><label>Category</label><input name="projects[{{ $index }}][category]" value="{{ old("projects.$index.category", $project['category'] ?? '') }}"></div>
                                </div>
                                <div class="form-row three">
                                    <div class="field"><label>Status</label><input name="projects[{{ $index }}][status]" value="{{ old("projects.$index.status", $project['status'] ?? '') }}"></div>
                                    <div class="field"><label>Year Started</label><input name="projects[{{ $index }}][started]" value="{{ old("projects.$index.started", $project['started'] ?? '') }}"></div>
                                    <div class="field"><label>Report File URL</label><input name="projects[{{ $index }}][report_file]" value="{{ old("projects.$index.report_file", $project['report_file'] ?? '') }}"></div>
                                </div>
                                <div class="form-row">
                                    <div class="field">
                                        <label>Main Image Path</label>
                                        <input name="projects[{{ $index }}][image]" value="{{ old("projects.$index.image", $project['image'] ?? '') }}">
                                        <small>Keep the current path, paste a media path, or upload a new image.</small>
                                    </div>
                                    <div class="field">
                                        <label>Choose Main Image</label>
                                        <input name="projects[{{ $index }}][image_file]" type="file" accept="image/*">
                                        <small>Uploading a file replaces the image path for this project.</small>
                                    </div>
                                </div>
                                <div class="field"><label>Short Summary</label><textarea name="projects[{{ $index }}][summary]">{{ old("projects.$index.summary", $project['summary'] ?? '') }}</textarea></div>
                                <div class="form-row">
                                    <div class="field">
                                        <label>Gallery Image Paths</label>
                                        <textarea name="projects[{{ $index }}][gallery_text]">{{ old("projects.$index.gallery_text", implode("\n", $project['gallery'] ?? [])) }}</textarea>
                                        <small>Put each image path on its own line.</small>
                                    </div>
                                    <div class="field">
                                        <label>Choose Gallery Images</label>
                                        <input name="projects[{{ $index }}][gallery_files][]" type="file" accept="image/*" multiple>
                                        <small>Selected files will be added to the gallery.</small>
                                    </div>
                                </div>

                                <h3>Project Stats</h3>
                                @foreach (($project['stats'] ?? []) as $statIndex => $stat)
                                    <div class="form-row">
                                        <div class="field"><label>Number</label><input name="projects[{{ $index }}][stats][{{ $statIndex }}][number]" value="{{ old("projects.$index.stats.$statIndex.number", $stat['number'] ?? '') }}"></div>
                                        <div class="field"><label>Label</label><input name="projects[{{ $index }}][stats][{{ $statIndex }}][label]" value="{{ old("projects.$index.stats.$statIndex.label", $stat['label'] ?? '') }}"></div>
                                    </div>
                                @endforeach

                                <h3>Activity Report Sections</h3>
                                @foreach (($project['sections'] ?? []) as $sectionIndex => $projectSection)
                                    <div class="item-card">
                                        <div class="field">
                                            <label>Section Heading</label>
                                            <input name="projects[{{ $index }}][sections][{{ $sectionIndex }}][title]" value="{{ old("projects.$index.sections.$sectionIndex.title", $projectSection['title'] ?? '') }}">
                                        </div>
                                        <div class="field">
                                            <label>Section Content</label>
                                            <textarea class="tall" name="projects[{{ $index }}][sections][{{ $sectionIndex }}][body_text]">{{ old("projects.$index.sections.$sectionIndex.body_text", implode("\n", $projectSection['body'] ?? [])) }}</textarea>
                                            <small>Put each paragraph or bullet point on its own line.</small>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="field">
                                    <label>Closing Message</label>
                                    <input name="projects[{{ $index }}][closing_title]" value="{{ old("projects.$index.closing_title", $project['closing_title'] ?? '') }}">
                                </div>
                            </section>
                        @endforeach
                    @endif

                    @if ($section === 'events')
                        @php $eventItems = array_values($content); $eventItems[] = []; @endphp
                        @foreach ($eventItems as $index => $event)
                            <section class="form-section item-card">
                                <div class="item-title"><h2>{{ $event['title'] ?? 'New Event' }}</h2><span>{{ empty($event) ? 'New Item' : 'Event '.($index + 1) }}</span></div>
                                <div class="form-row three">
                                    <div class="field"><label>Slug</label><input name="events[{{ $index }}][slug]" value="{{ old("events.$index.slug", $event['slug'] ?? '') }}"></div>
                                    <div class="field"><label>Category</label><input name="events[{{ $index }}][category]" value="{{ old("events.$index.category", $event['category'] ?? '') }}"></div>
                                    <div class="field"><label>Title</label><input name="events[{{ $index }}][title]" value="{{ old("events.$index.title", $event['title'] ?? '') }}"></div>
                                </div>
                                <div class="form-row three">
                                    <div class="field"><label>Date</label><input name="events[{{ $index }}][date]" value="{{ old("events.$index.date", $event['date'] ?? '') }}"></div>
                                    <div class="field"><label>Time</label><input name="events[{{ $index }}][time]" value="{{ old("events.$index.time", $event['time'] ?? '') }}"></div>
                                    <div class="field"><label>Venue</label><input name="events[{{ $index }}][venue]" value="{{ old("events.$index.venue", $event['venue'] ?? '') }}"></div>
                                </div>
                                <div class="field"><label>Main Image</label><input name="events[{{ $index }}][image]" value="{{ old("events.$index.image", $event['image'] ?? '') }}"></div>
                                <div class="field"><label>Gallery Images</label><textarea name="events[{{ $index }}][images_text]">{{ old("events.$index.images_text", implode("\n", $event['images'] ?? [])) }}</textarea><small>Put each image path on its own line.</small></div>
                                <div class="field"><label>Summary</label><textarea name="events[{{ $index }}][summary]">{{ old("events.$index.summary", $event['summary'] ?? '') }}</textarea></div>
                                <div class="form-row">
                                    <div class="field"><label>Detail Paragraphs</label><textarea class="tall" name="events[{{ $index }}][details_text]">{{ old("events.$index.details_text", implode("\n", $event['details'] ?? [])) }}</textarea></div>
                                    <div class="field"><label>Schedule Items</label><textarea class="tall" name="events[{{ $index }}][schedule_text]">{{ old("events.$index.schedule_text", implode("\n", $event['schedule'] ?? [])) }}</textarea></div>
                                </div>
                            </section>
                        @endforeach
                    @endif

                    @if ($section === 'news')
                        @php $postItems = array_values($content); $postItems[] = []; @endphp
                        @foreach ($postItems as $index => $post)
                            <section class="form-section item-card">
                                <div class="item-title"><h2>{{ $post['title'] ?? 'New News Post' }}</h2><span>{{ empty($post) ? 'New Item' : 'Post '.($index + 1) }}</span></div>
                                <div class="form-row three">
                                    <div class="field"><label>Slug</label><input name="news[{{ $index }}][slug]" value="{{ old("news.$index.slug", $post['slug'] ?? '') }}"></div>
                                    <div class="field"><label>Category</label><input name="news[{{ $index }}][category]" value="{{ old("news.$index.category", $post['category'] ?? '') }}"></div>
                                    <div class="field"><label>Date</label><input name="news[{{ $index }}][date]" value="{{ old("news.$index.date", $post['date'] ?? '') }}"></div>
                                </div>
                                <div class="field"><label>Title</label><input name="news[{{ $index }}][title]" value="{{ old("news.$index.title", $post['title'] ?? '') }}"></div>
                                <div class="field"><label>Image</label><input name="news[{{ $index }}][image]" value="{{ old("news.$index.image", $post['image'] ?? '') }}"></div>
                                <div class="form-row">
                                    <div class="field"><label>Summary</label><textarea name="news[{{ $index }}][summary]">{{ old("news.$index.summary", $post['summary'] ?? '') }}</textarea></div>
                                    <div class="field"><label>Button Label</label><input name="news[{{ $index }}][link_label]" value="{{ old("news.$index.link_label", $post['link_label'] ?? 'Read More') }}"></div>
                                </div>
                                <div class="field"><label>Article Paragraphs</label><textarea class="tall" name="news[{{ $index }}][details_text]">{{ old("news.$index.details_text", implode("\n", $post['details'] ?? [])) }}</textarea><small>Put each paragraph on its own line.</small></div>
                            </section>
                        @endforeach
                    @endif
                </div>

                <div class="actions">
                    <button class="save-button" type="submit">Save Content Changes</button>
                </div>
            </form>
        </main>
    </div>
    @include('admin.partials.mobile-scripts')
</body>
</html>
