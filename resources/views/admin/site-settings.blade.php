<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Site Header</title>
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

        .notice,
        .errors {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 0;
            font-weight: 800;
        }

        .notice {
            border: 1px solid rgba(15, 111, 77, .25);
            color: var(--green-dark);
            background: rgba(15, 111, 77, .09);
        }

        .errors {
            border: 1px solid rgba(201, 84, 61, .28);
            color: #8f2e1e;
            background: rgba(201, 84, 61, .09);
        }

        .settings-card {
            margin-bottom: 18px;
            padding: 20px;
            border: 1px solid var(--line);
            border-radius: 0;
            background: var(--white);
            box-shadow: 0 16px 38px rgba(21, 33, 29, .08);
        }

        .settings-card h2 {
            margin: 0 0 18px;
            font-size: 22px;
        }

        .fields-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .menu-grid {
            display: grid;
            gap: 14px;
        }

        .menu-card {
            padding: 14px;
            border: 1px solid var(--line);
            background: #fbfcfa;
        }

        .menu-row,
        .submenu-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) 150px 220px;
            gap: 14px;
            align-items: start;
        }

        .submenu-list {
            display: grid;
            gap: 10px;
            margin-top: 14px;
            padding: 14px;
            border-left: 4px solid var(--green);
            background: var(--white);
        }

        .submenu-title {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: var(--ink);
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            min-height: 44px;
            padding: 0 12px;
            border: 1px solid var(--line);
            border-radius: 0;
            color: var(--ink);
            background: #fbfcfa;
            font: inherit;
        }

        input[type="file"] {
            padding: 10px 12px;
        }

        input[type="checkbox"] {
            width: 18px;
            min-height: 18px;
            padding: 0;
        }

        .checkbox-field {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 44px;
            margin-top: 24px;
            font-weight: 800;
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 14px;
        }

        .order-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 24px;
        }

        .small-button,
        .danger-button,
        .order-button {
            min-height: 40px;
            padding: 0 14px;
            border-radius: 0;
            font: inherit;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
        }

        .small-button {
            border: 1px solid var(--green);
            color: var(--green-dark);
            background: rgba(15, 111, 77, .08);
        }

        .order-button {
            border: 1px solid var(--line);
            color: var(--green-dark);
            background: var(--white);
        }

        .danger-button {
            border: 1px solid rgba(201, 84, 61, .3);
            color: #8f2e1e;
            background: rgba(201, 84, 61, .08);
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

        @media (max-width: 860px) {
            .admin-layout,
            .fields-grid,
            .menu-row,
            .submenu-row {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                height: auto;
            }

            .sidebar-nav {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .field.full {
                grid-column: auto;
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
                <a class="sidebar-link" href="/admin">
                    <span class="sidebar-icon">01</span>
                    <span>Hero Slider</span>
                </a>
                <a class="sidebar-link active" href="/admin/site-settings" aria-current="page">
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

            <form method="POST" action="/admin/site-settings" enctype="multipart/form-data">
                @csrf

                <section class="settings-card">
                    <h2>Logo</h2>
                    <div class="fields-grid">
                        <div class="field">
                            <label for="logo_image_file">Upload Logo</label>
                            <input id="logo_image_file" name="logo_image_file" type="file" accept="image/*">
                        </div>

                        <div class="field">
                            <label for="logo_image_url">Logo Image URL</label>
                            <input id="logo_image_url" name="logo_image_url" value="{{ old('logo_image_url', $settings['logo_image']) }}">
                            <p class="hint">Upload a logo or paste an image URL. Uploaded logos replace this value automatically.</p>
                        </div>
                    </div>
                </section>

                <section class="settings-card">
                    <h2>Topbar</h2>
                    <div class="fields-grid">
                        <div class="field">
                            <label for="phone_label">Phone Display</label>
                            <input id="phone_label" name="phone_label" value="{{ old('phone_label', $settings['phone_label']) }}" required>
                        </div>

                        <div class="field">
                            <label for="phone_href">Phone Link</label>
                            <input id="phone_href" name="phone_href" value="{{ old('phone_href', $settings['phone_href']) }}" required>
                        </div>

                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $settings['email']) }}" required>
                        </div>

                        <div class="field">
                            <label for="location_label">Location Display</label>
                            <input id="location_label" name="location_label" value="{{ old('location_label', $settings['location_label']) }}" required>
                        </div>

                        <div class="field">
                            <label for="location_url">Location Link</label>
                            <input id="location_url" name="location_url" value="{{ old('location_url', $settings['location_url']) }}" required>
                        </div>

                        <div class="field">
                            <label for="volunteer_label">Volunteer Display</label>
                            <input id="volunteer_label" name="volunteer_label" value="{{ old('volunteer_label', $settings['volunteer_label']) }}" required>
                        </div>

                        <div class="field">
                            <label for="volunteer_url">Volunteer Link</label>
                            <input id="volunteer_url" name="volunteer_url" value="{{ old('volunteer_url', $settings['volunteer_url']) }}" required>
                        </div>

                        <div class="field">
                            <label for="registration_number">Registration Number</label>
                            <input id="registration_number" name="registration_number" value="{{ old('registration_number', $settings['registration_number']) }}" required>
                        </div>

                        <div class="field">
                            <label for="registration_status">Registration Status</label>
                            <input id="registration_status" name="registration_status" value="{{ old('registration_status', $settings['registration_status']) }}" required>
                        </div>
                    </div>
                </section>

                <section class="settings-card">
                    <h2>Menus</h2>
                    <div class="menu-grid" id="menuList">
                        @foreach ($settings['menus'] as $index => $menu)
                            <div class="menu-card" data-menu-card>
                                <div class="menu-row">
                                    <div class="field">
                                        <label>Menu Label</label>
                                        <input data-menu-label name="menus[{{ $index }}][label]" value="{{ old("menus.$index.label", $menu['label']) }}" required>
                                    </div>

                                    <div class="field">
                                        <label>Menu Link</label>
                                        <input data-menu-url name="menus[{{ $index }}][url]" value="{{ old("menus.$index.url", $menu['url']) }}" required>
                                    </div>

                                    <label class="checkbox-field">
                                        <input data-menu-highlight name="menus[{{ $index }}][highlight]" type="checkbox" value="1" @checked(old("menus.$index.highlight", $menu['highlight']))>
                                        Highlight button
                                    </label>

                                    <div class="order-actions">
                                        <button class="order-button" type="button" data-move-menu-up>Up</button>
                                        <button class="order-button" type="button" data-move-menu-down>Down</button>
                                        <button class="danger-button" type="button" data-remove-menu>Remove</button>
                                    </div>
                                </div>

                                <div class="submenu-list" data-submenu-list>
                                    <p class="submenu-title">Submenus</p>
                                    @foreach (($menu['children'] ?? []) as $childIndex => $child)
                                        <div class="submenu-row" data-submenu-row>
                                            <div class="field">
                                                <label>Submenu Label</label>
                                                <input data-submenu-label name="menus[{{ $index }}][children][{{ $childIndex }}][label]" value="{{ old("menus.$index.children.$childIndex.label", $child['label']) }}">
                                            </div>

                                            <div class="field">
                                                <label>Submenu Link</label>
                                                <input data-submenu-url name="menus[{{ $index }}][children][{{ $childIndex }}][url]" value="{{ old("menus.$index.children.$childIndex.url", $child['url']) }}">
                                            </div>

                                            <span></span>
                                            <button class="danger-button" type="button" data-remove-submenu>Remove</button>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="button-row">
                                    <button class="small-button" type="button" data-add-submenu>Add Submenu</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="button-row">
                        <button class="small-button" type="button" id="addMenuButton">Add Menu</button>
                    </div>
                </section>

                <div class="actions">
                    <button class="save-button" type="submit">Save Header Changes</button>
                </div>
            </form>
        </main>
    </div>
    <script>
        const menuList = document.querySelector('#menuList');
        const addMenuButton = document.querySelector('#addMenuButton');

        function reindexMenus() {
            Array.from(menuList.querySelectorAll('[data-menu-card]')).forEach((card, menuIndex) => {
                card.querySelector('[data-menu-label]').name = `menus[${menuIndex}][label]`;
                card.querySelector('[data-menu-url]').name = `menus[${menuIndex}][url]`;
                card.querySelector('[data-menu-highlight]').name = `menus[${menuIndex}][highlight]`;

                Array.from(card.querySelectorAll('[data-submenu-row]')).forEach((row, childIndex) => {
                    row.querySelector('[data-submenu-label]').name = `menus[${menuIndex}][children][${childIndex}][label]`;
                    row.querySelector('[data-submenu-url]').name = `menus[${menuIndex}][children][${childIndex}][url]`;
                });
            });
        }

        function createSubmenuRow() {
            const row = document.createElement('div');
            row.className = 'submenu-row';
            row.dataset.submenuRow = '';
            row.innerHTML = `
                <div class="field">
                    <label>Submenu Label</label>
                    <input data-submenu-label>
                </div>
                <div class="field">
                    <label>Submenu Link</label>
                    <input data-submenu-url>
                </div>
                <span></span>
                <button class="danger-button" type="button" data-remove-submenu>Remove</button>
            `;
            return row;
        }

        function createMenuCard() {
            const card = document.createElement('div');
            card.className = 'menu-card';
            card.dataset.menuCard = '';
            card.innerHTML = `
                <div class="menu-row">
                    <div class="field">
                        <label>Menu Label</label>
                        <input data-menu-label required>
                    </div>
                    <div class="field">
                        <label>Menu Link</label>
                        <input data-menu-url required>
                    </div>
                    <label class="checkbox-field">
                        <input data-menu-highlight type="checkbox" value="1">
                        Highlight button
                    </label>
                    <div class="order-actions">
                        <button class="order-button" type="button" data-move-menu-up>Up</button>
                        <button class="order-button" type="button" data-move-menu-down>Down</button>
                        <button class="danger-button" type="button" data-remove-menu>Remove</button>
                    </div>
                </div>
                <div class="submenu-list" data-submenu-list>
                    <p class="submenu-title">Submenus</p>
                </div>
                <div class="button-row">
                    <button class="small-button" type="button" data-add-submenu>Add Submenu</button>
                </div>
            `;
            return card;
        }

        addMenuButton.addEventListener('click', () => {
            menuList.appendChild(createMenuCard());
            reindexMenus();
        });

        menuList.addEventListener('click', (event) => {
            if (event.target.matches('[data-move-menu-up]')) {
                const card = event.target.closest('[data-menu-card]');
                const previousCard = card.previousElementSibling;

                if (previousCard) {
                    menuList.insertBefore(card, previousCard);
                    reindexMenus();
                }
            }

            if (event.target.matches('[data-move-menu-down]')) {
                const card = event.target.closest('[data-menu-card]');
                const nextCard = card.nextElementSibling;

                if (nextCard) {
                    menuList.insertBefore(nextCard, card);
                    reindexMenus();
                }
            }

            if (event.target.matches('[data-remove-menu]')) {
                if (menuList.querySelectorAll('[data-menu-card]').length > 1) {
                    event.target.closest('[data-menu-card]').remove();
                    reindexMenus();
                }
            }

            if (event.target.matches('[data-add-submenu]')) {
                const card = event.target.closest('[data-menu-card]');
                card.querySelector('[data-submenu-list]').appendChild(createSubmenuRow());
                reindexMenus();
            }

            if (event.target.matches('[data-remove-submenu]')) {
                event.target.closest('[data-submenu-row]').remove();
                reindexMenus();
            }
        });

        reindexMenus();
    </script>
</body>
</html>
