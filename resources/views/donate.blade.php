@extends('layouts.public-page')

@section('title', 'Donate to Us')
@section('crumb', 'Donate')
@section('hero', 'Donate to Us')

@section('page_css')
    .donate-layout { max-width:1180px; margin:0 auto; }
    .donate-main { display:grid; grid-template-columns:minmax(0,.9fr) minmax(0,1.1fr); gap:28px; align-items:start; }
    .bank-transfer-card { position:relative; overflow:hidden; padding:28px; border:1px solid var(--green); background:var(--green); color:var(--white); box-shadow:0 22px 52px rgba(18,63,47,.2); }
    .bank-transfer-card::before { content:""; position:absolute; inset:0 auto 0 0; width:5px; background:var(--gold); }
    .bank-transfer-card .tag { border-color:var(--gold); color:var(--gold); }
    .bank-transfer-head { display:flex; justify-content:space-between; gap:24px; align-items:start; margin-bottom:22px; }
    .bank-transfer-head h3 { margin:7px 0 6px; color:var(--white); }
    .bank-transfer-head p { max-width:620px; margin:0; color:rgba(255,255,255,.82); }
    .bank-mark { flex:0 0 auto; display:grid; place-items:center; width:48px; height:48px; border-radius:50%; background:rgba(255,255,255,.12); color:var(--gold); }
    .bank-details { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:1px; margin:0; overflow:hidden; border:1px solid rgba(255,255,255,.22); background:rgba(255,255,255,.22); }
    .bank-detail { min-width:0; padding:17px 18px; background:rgba(255,255,255,.08); }
    .bank-detail dt { margin:0 0 6px; color:rgba(255,255,255,.68); font-size:.74rem; font-weight:800; letter-spacing:.09em; text-transform:uppercase; }
    .bank-detail dd { margin:0; color:var(--white); font-size:1rem; font-weight:850; overflow-wrap:anywhere; }
    .bank-detail.account-number dd { color:var(--gold); font-size:1.2rem; letter-spacing:.04em; }
    .bank-transfer-note { display:flex; gap:10px; align-items:flex-start; margin:18px 0 0; padding:14px 16px; background:rgba(218,165,32,.18); border:1px solid rgba(218,165,32,.32); color:var(--white); font-size:.92rem; line-height:1.6; }
    .bank-transfer-note strong { white-space:nowrap; }
    @media (max-width:980px){
        .donate-main{grid-template-columns:1fr;}
    }
    @media (max-width:620px){
        .bank-transfer-card{padding:22px 18px 20px;}
        .bank-transfer-head{gap:14px;}
        .bank-mark{width:42px;height:42px;}
        .bank-details{grid-template-columns:1fr;}
        .bank-transfer-note{display:block;}
        .bank-transfer-note strong{display:block;margin-bottom:2px;}
    }
@endsection

@section('content')
    <section class="section">
        <div class="section-head">
            <h2>{{ $pageContent['donate']['title'] }}</h2>
            <p>{{ $pageContent['donate']['intro'] }}</p>
        </div>
        <div class="donate-layout">
            <div class="donate-main">
                <section class="bank-transfer-card" aria-labelledby="bank-transfer-title">
                    <div class="bank-transfer-head">
                        <div>
                            <span class="tag">Available Now</span>
                            <h3 id="bank-transfer-title">Donate by Bank Transfer</h3>
                            <p>You can make your donation directly to the Nicoville Foundation account using the details below.</p>
                        </div>
                        <span class="bank-mark" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 10h18M5 10v7m4-7v7m6-7v7m4-7v7M3 20h18M12 3l9 5H3l9-5Z"/>
                            </svg>
                        </span>
                    </div>

                    <dl class="bank-details">
                        <div class="bank-detail">
                            <dt>Bank</dt>
                            <dd>Housing Finance Bank</dd>
                        </div>
                        <div class="bank-detail">
                            <dt>Account Name</dt>
                            <dd>Nicoville Foundation</dd>
                        </div>
                        <div class="bank-detail account-number">
                            <dt>Account Number</dt>
                            <dd>1240000006345</dd>
                        </div>
                        <div class="bank-detail">
                            <dt>SWIFT / BIC Code</dt>
                            <dd>HFINUGKAXXX</dd>
                        </div>
                    </dl>

                    <p class="bank-transfer-note"><strong>After your transfer:</strong> Complete the contribution form below and choose “Bank Transfer” as your payment method so our team can identify and confirm your donation.</p>
                </section>

                <form class="form-card" action="/donations" method="POST">
                @csrf
                <label>Project or Cause
                    <select name="cause" required>
                        <option value="">Choose a project or cause</option>
                        @if (! empty($causes))
                            <optgroup label="Causes">
                                @foreach ($causes as $cause)
                                    <option value="{{ $cause['title'] }}" {{ request('cause') === $cause['title'] ? 'selected' : '' }}>{{ $cause['title'] }}</option>
                                @endforeach
                            </optgroup>
                        @endif
                        <optgroup label="Projects">
                            @foreach ($projects as $project)
                                <option value="{{ $project['title'] }}" {{ request('project') === $project['title'] || request('cause') === $project['title'] ? 'selected' : '' }}>{{ $project['title'] }}</option>
                            @endforeach
                        </optgroup>
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
                <div class="form-row">
                    <label>Currency
                        <select name="currency" required>
                            <option value="UGX">UGX</option>
                            <option value="USD">USD</option>
                        </select>
                    </label>
                    <label>Payment Method
                        <select name="payment_method" required>
                            <option value="mobile-money">Mobile Money</option>
                            <option value="bank-transfer">Bank Transfer</option>
                            <option value="cash-pledge">Cash Pledge</option>
                        </select>
                    </label>
                </div>
                <label>Message / Note<textarea name="message" placeholder="Optional note for this contribution"></textarea></label>
                <button class="button" type="submit">Submit Contribution</button>
                </form>
            </div>
        </div>
    </section>
@endsection
