@extends('layouts.public-page')

@section('title', 'Donate to Us')
@section('crumb', 'Donate')
@section('hero', 'Donate to Us')

@section('page_css')
    .donate-layout { display:grid; grid-template-columns:minmax(0,1fr) 420px; gap:28px; max-width:1180px; margin:0 auto; align-items:start; }
    .donate-copy { display:grid; gap:18px; }
    .donate-copy p { margin:0; color:var(--muted); }
    .giving-card { padding:28px; border:1px solid var(--line); background:var(--green); color:var(--white); }
    .giving-card h3,.giving-card p { color:var(--white); }
    .giving-card p { margin:12px 0 0; opacity:.88; }
    .impact-list { display:grid; gap:12px; margin:0; padding:0; list-style:none; }
    .impact-list li { padding:16px; border:1px solid var(--line); background:var(--white); color:var(--green-dark); font-weight:800; }
    @media (max-width:980px){ .donate-layout{grid-template-columns:1fr;} }
@endsection

@section('content')
    <section class="section">
        <div class="section-head">
            <h2>{{ $pageContent['donate']['title'] }}</h2>
            <p>{{ $pageContent['donate']['intro'] }}</p>
        </div>
        <div class="donate-layout">
            <form class="form-card" action="/contributions" method="GET">
                <label>Cause
                    <select name="cause" required>
                        <option value="">Choose a cause</option>
                        @foreach ($causes as $cause)
                            <option value="{{ $cause['title'] }}" {{ request('cause') === $cause['title'] ? 'selected' : '' }}>{{ $cause['title'] }}</option>
                        @endforeach
                    </select>
                </label>
                <div class="form-row">
                    <label>Donor Name<input name="name" type="text" placeholder="Your full name" required></label>
                    <label>Email Address<input name="email" type="email" placeholder="you@example.com" required></label>
                </div>
                <div class="form-row">
                    <label>Contact / Phone<input name="phone" type="tel" placeholder="+256..." required></label>
                    <label>Amount<input name="amount" type="number" min="1" placeholder="Amount in UGX" required></label>
                </div>
                <label>Message / Note<textarea name="message" placeholder="Optional note for this contribution"></textarea></label>
                <button class="button" type="submit">Continue to Contributions</button>
            </form>
            <aside class="donate-copy">
                <div class="giving-card">
                    <span class="tag">Trusted Giving</span>
                    <h3>{{ $pageContent['donate']['side_title'] }}</h3>
                    <p>{{ $pageContent['donate']['side_text'] }}</p>
                </div>
                <ul class="impact-list">
                    <li>Education support keeps children in school.</li>
                    <li>Food support helps families through difficult seasons.</li>
                    <li>Care outreach restores dignity for street-connected children.</li>
                </ul>
            </aside>
        </div>
    </section>
@endsection
