<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Event Bookings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#15211d; --muted:#6f7d78; --line:#dbe6e0; --green:#0f6f4d; --green-dark:#073f31; --coral:#c9543d; --paper:#f8f5ee; --white:#fff; }
        * { box-sizing:border-box; }
        body { margin:0; color:var(--ink); font-family:'Poppins',Arial,sans-serif; font-size:16px; background:var(--paper); }
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
        .notice { margin-bottom:18px; padding:14px 16px; border:1px solid rgba(15,111,77,.25); color:var(--green-dark); background:rgba(15,111,77,.09); font-weight:800; }
        .stats { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:16px; margin-bottom:20px; }
        .stat-card { padding:18px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.07); }
        .stat-card span { color:var(--muted); font-size:12px; font-weight:900; text-transform:uppercase; }
        .stat-card strong { display:block; margin-top:6px; color:var(--green); font-size:34px; }
        .bookings { display:grid; gap:14px; }
        .booking-card { display:grid; grid-template-columns:minmax(0,1fr) 220px; gap:18px; padding:18px; border:1px solid var(--line); background:var(--white); box-shadow:0 16px 38px rgba(21,33,29,.07); }
        .booking-card h2 { margin:0 0 8px; font-size:22px; }
        .booking-meta { display:flex; flex-wrap:wrap; gap:10px; color:var(--muted); font-size:14px; font-weight:700; }
        .booking-message { margin:12px 0 0; color:var(--muted); line-height:1.55; }
        .status { display:inline-flex; width:max-content; min-height:32px; align-items:center; padding:0 10px; background:rgba(15,111,77,.1); color:var(--green-dark); font-size:12px; font-weight:900; text-transform:uppercase; }
        .actions { display:grid; gap:10px; align-content:start; }
        select { width:100%; min-height:42px; border:1px solid var(--line); padding:0 10px; font:inherit; background:#fbfcfa; }
        .save-button { min-height:42px; border:0; color:var(--white); background:var(--coral); font:inherit; font-weight:900; cursor:pointer; }
        .pagination { margin-top:20px; }
        @media (max-width:820px){ .admin-layout,.booking-card,.stats{grid-template-columns:1fr;} .sidebar{position:static;height:auto;} }
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
                <a class="sidebar-link" href="/admin"><span class="sidebar-icon">01</span><span>Hero Slider</span></a>
                <a class="sidebar-link" href="/admin/site-settings"><span class="sidebar-icon">02</span><span>Site Header</span></a>
                <a class="sidebar-link active" href="/admin/event-bookings" aria-current="page"><span class="sidebar-icon">03</span><span>Event Bookings</span></a>
                <a class="sidebar-link" href="/admin/content/pages"><span class="sidebar-icon">04</span><span>Content Manager</span></a>
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
            <div class="stats">
                <div class="stat-card"><span>Pending</span><strong>{{ $counts['pending'] }}</strong></div>
                <div class="stat-card"><span>Confirmed</span><strong>{{ $counts['confirmed'] }}</strong></div>
                <div class="stat-card"><span>Cancelled</span><strong>{{ $counts['cancelled'] }}</strong></div>
            </div>
            <div class="bookings">
                @forelse ($bookings as $booking)
                    <article class="booking-card">
                        <div>
                            <span class="status">{{ $booking->status }}</span>
                            <h2>{{ $booking->event_title }}</h2>
                            <div class="booking-meta">
                                <span>{{ $booking->name }}</span>
                                <span>{{ $booking->email }}</span>
                                @if ($booking->phone)<span>{{ $booking->phone }}</span>@endif
                                <span>{{ $booking->attendance_type }}</span>
                                <span>{{ $booking->guests }} guest{{ $booking->guests === 1 ? '' : 's' }}</span>
                                <span>{{ $booking->created_at->format('M j, Y g:i A') }}</span>
                            </div>
                            @if ($booking->message)
                                <p class="booking-message">{{ $booking->message }}</p>
                            @endif
                        </div>
                        <form class="actions" method="POST" action="/admin/event-bookings/{{ $booking->id }}">
                            @csrf
                            @method('PATCH')
                            <select name="status">
                                <option value="pending" @selected($booking->status === 'pending')>Pending</option>
                                <option value="confirmed" @selected($booking->status === 'confirmed')>Confirmed</option>
                                <option value="cancelled" @selected($booking->status === 'cancelled')>Cancelled</option>
                            </select>
                            <button class="save-button" type="submit">Update</button>
                        </form>
                    </article>
                @empty
                    <div class="notice">No event bookings have been submitted yet.</div>
                @endforelse
            </div>
            <div class="pagination">{{ $bookings->links() }}</div>
        </main>
    </div>
</body>
</html>
