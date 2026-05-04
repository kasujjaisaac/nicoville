<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Hero Slider</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #15211d;
            --muted: #6f7d78;
            --line: #dbe6e0;
            --green: #0f6f4d;
            --green-dark: #073f31;
            --coral: #c9543d;
            --paper: #f8f5ee;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: var(--ink);
            font-family: 'Poppins', Arial, Helvetica, sans-serif;
            font-size: 16px;
            background: var(--paper);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .admin-layout {
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
            min-height: 100vh;
        }

        .sidebar {
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 24px 18px;
            color: rgba(255, 255, 255, .78);
            background: var(--green-dark);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
            color: var(--white);
        }

        .brand-mark {
            display: grid;
            width: 44px;
            height: 44px;
            place-items: center;
            border-radius: 0;
            background: var(--green);
            font-size: 21px;
            font-weight: 900;
        }

        .brand-name {
            display: block;
            font-size: 20px;
            font-weight: 900;
            line-height: 1;
        }

        .brand-role {
            display: block;
            margin-top: 5px;
            color: rgba(255, 255, 255, .58);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .sidebar-section {
            margin: 24px 0 10px;
            padding: 0 10px;
            color: rgba(255, 255, 255, .48);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: grid;
            gap: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 44px;
            padding: 0 12px;
            border-radius: 0;
            color: rgba(255, 255, 255, .76);
            font-weight: 800;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            color: var(--white);
            background: rgba(255, 255, 255, .12);
        }

        .sidebar-icon {
            display: grid;
            width: 28px;
            height: 28px;
            place-items: center;
            border-radius: 0;
            background: rgba(255, 255, 255, .1);
            color: #ffe0a4;
            font-size: 13px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 10px 0;
            border-top: 1px solid rgba(255, 255, 255, .12);
        }

        .admin-user {
            margin: 0 0 12px;
            color: rgba(255, 255, 255, .62);
            font-size: 13px;
            line-height: 1.5;
        }

        .admin-main {
            min-width: 0;
        }

        .logout-button {
            width: 100%;
            min-height: 42px;
            padding: 0 14px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 0;
            color: var(--white);
            background: rgba(255, 255, 255, .08);
            font: inherit;
            font-weight: 800;
            cursor: pointer;
        }

        .admin-shell {
            width: min(1120px, calc(100% - 36px));
            margin: 28px auto 64px;
        }

        .notice {
            margin-bottom: 18px;
            padding: 14px 16px;
            border: 1px solid rgba(15, 111, 77, .25);
            border-radius: 0;
            color: var(--green-dark);
            background: rgba(15, 111, 77, .09);
            font-weight: 800;
        }

        .errors {
            margin-bottom: 18px;
            padding: 14px 16px;
            border: 1px solid rgba(201, 84, 61, .28);
            border-radius: 0;
            color: #8f2e1e;
            background: rgba(201, 84, 61, .09);
        }

        .intro {
            max-width: 780px;
            margin: 0 0 24px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.55;
        }

        .content-card {
            margin-bottom: 22px;
            padding: 22px;
            border: 1px solid var(--line);
            border-radius: 0;
            background: var(--white);
            box-shadow: 0 16px 38px rgba(21, 33, 29, .07);
        }

        .content-card h2 {
            margin: 0 0 8px;
            font-size: 22px;
        }

        .content-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
        }

        .slide-card {
            display: grid;
            grid-template-columns: minmax(220px, .55fr) minmax(0, 1fr);
            gap: 22px;
            margin-bottom: 18px;
            padding: 20px;
            border: 1px solid var(--line);
            border-radius: 0;
            background: var(--white);
            box-shadow: 0 16px 38px rgba(21, 33, 29, .08);
        }

        .preview {
            min-height: 260px;
            border-radius: 0;
            background:
                linear-gradient(rgba(7, 63, 49, .25), rgba(7, 63, 49, .5)),
                var(--preview-image);
            background-position: center;
            background-size: cover;
        }

        .slide-fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: var(--ink);
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 0;
            color: var(--ink);
            background: #fbfcfa;
            font: inherit;
        }

        input {
            min-height: 44px;
            padding: 0 12px;
        }

        input[type="file"] {
            padding: 10px 12px;
        }

        textarea {
            min-height: 110px;
            padding: 12px;
            resize: vertical;
        }

        .hint {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.4;
        }

        .actions {
            position: sticky;
            bottom: 0;
            display: flex;
            justify-content: flex-end;
            padding: 16px 0;
            background: linear-gradient(transparent, var(--paper) 30%);
        }

        .save-button {
            min-height: 50px;
            padding: 0 24px;
            border: 0;
            border-radius: 0;
            color: var(--white);
            background: var(--coral);
            font-size: 15px;
            font-weight: 900;
            cursor: pointer;
        }

        @media (max-width: 820px) {
            .admin-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                height: auto;
            }

            .sidebar-nav {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .slide-card {
                grid-template-columns: 1fr;
            }

            .slide-fields {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar" aria-label="Admin navigation">
            <a class="sidebar-brand" href="/admin">
                <span class="brand-mark">N</span>
                <span>
                    <span class="brand-name">Nicoville</span>
                    <span class="brand-role">Admin Panel</span>
                </span>
            </a>

            <div class="sidebar-section">Website</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link active" href="/admin" aria-current="page">
                    <span class="sidebar-icon">01</span>
                    <span>Hero Slider</span>
                </a>
                <a class="sidebar-link" href="/admin/site-settings">
                    <span class="sidebar-icon">02</span>
                    <span>Site Header</span>
                </a>
                <a class="sidebar-link" href="/admin/event-bookings">
                    <span class="sidebar-icon">03</span>
                    <span>Event Bookings</span>
                </a>
                <a class="sidebar-link" href="/admin/content/pages">
                    <span class="sidebar-icon">04</span>
                    <span>Content Manager</span>
                </a>
            </nav>

            <div class="sidebar-section">Coming Next</div>
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="#causes-management">
                    <span class="sidebar-icon">05</span>
                    <span>Causes</span>
                </a>
                <a class="sidebar-link" href="#donation-management">
                    <span class="sidebar-icon">06</span>
                    <span>Donations</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <p class="admin-user">Signed in as<br><strong>{{ auth()->user()->email }}</strong></p>
                <form method="POST" action="/admin/logout">
                    @csrf
                    <button class="logout-button" type="submit">Logout</button>
                </form>
            </div>
        </aside>

        <div class="admin-main">
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

                <form method="POST" action="/admin" enctype="multipart/form-data">
                    @csrf

                    @foreach ($slides as $index => $slide)
                        <section class="slide-card">
                            <div class="preview" style="--preview-image: url('{{ $slide['image'] }}');" aria-label="Slide {{ $index + 1 }} image preview"></div>

                            <div class="slide-fields">
                                <div class="field">
                                    <label for="slides_{{ $index }}_eyebrow">Small Heading</label>
                                    <input id="slides_{{ $index }}_eyebrow" name="slides[{{ $index }}][eyebrow]" value="{{ old("slides.$index.eyebrow", $slide['eyebrow']) }}" required>
                                </div>

                                <div class="field">
                                    <label for="slides_{{ $index }}_image_file">Upload Image</label>
                                    <input id="slides_{{ $index }}_image_file" name="slides[{{ $index }}][image_file]" type="file" accept="image/*">
                                </div>

                                <div class="field full">
                                    <label for="slides_{{ $index }}_image_url">Image URL</label>
                                    <input id="slides_{{ $index }}_image_url" name="slides[{{ $index }}][image_url]" value="{{ old("slides.$index.image_url", $slide['image']) }}" required>
                                    <p class="hint">Paste an image URL here, or upload a new image above. Uploaded images replace this value automatically.</p>
                                </div>

                                <div class="field full">
                                    <label for="slides_{{ $index }}_title">Main Title</label>
                                    <input id="slides_{{ $index }}_title" name="slides[{{ $index }}][title]" value="{{ old("slides.$index.title", $slide['title']) }}" required>
                                </div>

                                <div class="field full">
                                    <label for="slides_{{ $index }}_lead">Description</label>
                                    <textarea id="slides_{{ $index }}_lead" name="slides[{{ $index }}][lead]" required>{{ old("slides.$index.lead", $slide['lead']) }}</textarea>
                                </div>

                                <div class="field">
                                    <label for="slides_{{ $index }}_primary_label">Primary Button Text</label>
                                    <input id="slides_{{ $index }}_primary_label" name="slides[{{ $index }}][primary_label]" value="{{ old("slides.$index.primary_label", $slide['primary_label']) }}" required>
                                </div>

                                <div class="field">
                                    <label for="slides_{{ $index }}_primary_url">Primary Button Link</label>
                                    <input id="slides_{{ $index }}_primary_url" name="slides[{{ $index }}][primary_url]" value="{{ old("slides.$index.primary_url", $slide['primary_url']) }}" required>
                                </div>

                                <div class="field">
                                    <label for="slides_{{ $index }}_secondary_label">Secondary Button Text</label>
                                    <input id="slides_{{ $index }}_secondary_label" name="slides[{{ $index }}][secondary_label]" value="{{ old("slides.$index.secondary_label", $slide['secondary_label']) }}" required>
                                </div>

                                <div class="field">
                                    <label for="slides_{{ $index }}_secondary_url">Secondary Button Link</label>
                                    <input id="slides_{{ $index }}_secondary_url" name="slides[{{ $index }}][secondary_url]" value="{{ old("slides.$index.secondary_url", $slide['secondary_url']) }}" required>
                                </div>
                            </div>
                        </section>
                    @endforeach

                    <div class="actions">
                        <button class="save-button" type="submit">Save Slider Changes</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>
</html>
