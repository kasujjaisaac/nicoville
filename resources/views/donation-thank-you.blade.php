@extends('layouts.public-page')

@section('title', 'Donation Received')
@section('crumb', 'Donation Received')
@section('hero', 'Thank You')

@section('page_css')
    .thank-you-wrap { max-width:900px; margin:0 auto; }
    .thank-you-card { padding:clamp(26px,4vw,42px); border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
    .summary-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; margin-top:24px; }
    .summary-item { padding:16px; border:1px solid var(--line); background:var(--soft); }
    .summary-item b { display:block; margin-bottom:6px; color:var(--green); font-size:13px; text-transform:uppercase; }
    @media (max-width:640px){ .summary-grid{grid-template-columns:1fr;} }
@endsection

@section('content')
    <section class="section">
        <div class="thank-you-wrap">
            <article class="thank-you-card">
                <span class="tag">Contribution Received</span>
                <h2>Thank you, {{ $donation->name }}.</h2>
                <p>Your contribution has been recorded. Our team will contact you with the next payment confirmation steps.</p>

                <div class="summary-grid">
                    <div class="summary-item"><b>Project</b>{{ $donation->cause }}</div>
                    <div class="summary-item"><b>Amount</b>{{ $donation->currency }} {{ number_format($donation->amount) }}</div>
                    <div class="summary-item"><b>Payment Method</b>{{ str_replace('-', ' ', ucfirst($donation->payment_method)) }}</div>
                    <div class="summary-item"><b>Status</b>{{ ucfirst($donation->status) }}</div>
                </div>
            </article>
        </div>
    </section>
@endsection
