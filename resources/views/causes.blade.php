@extends('layouts.public-page')

@section('title', 'Our Causes')
@section('crumb', 'Causes')
@section('hero', 'Our Causes')

@section('page_css')
    .cause-card { overflow:hidden; }
    .cause-card .image-wrap { aspect-ratio:16 / 10; min-height:0; }
    .cause-card .image-wrap img { display:block; height:100%; min-height:0; object-fit:cover; }
    .cause-card .panel-pad { display:grid; gap:16px; }
    .cause-card p { margin:0; color:var(--muted); }
    .funding-summary { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px; }
    .funding-box { padding:13px; border:1px solid var(--line); background:var(--soft); }
    .funding-box span { display:block; margin-bottom:4px; color:var(--muted); font-size:12px; font-weight:900; text-transform:uppercase; }
    .funding-box strong { color:var(--green-dark); font-size:20px; }
    .progress-meta { display:flex; justify-content:space-between; gap:12px; margin-bottom:8px; color:var(--green); font-size:14px; font-weight:900; }
    .progress-bar { height:11px; overflow:hidden; background:#d9ebe2; }
    .progress-bar span { display:block; width:var(--progress); height:100%; background:var(--green); }
    .cause-actions { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
    @media (max-width:640px){ .funding-summary,.cause-actions{grid-template-columns:1fr;} }
@endsection

@section('content')
    <section class="section">
        <div class="section-head">
            <h2>Campaigns You Can Support</h2>
            <p>Each cause responds to a direct community need. Add, update, and manage these from the admin Causes section.</p>
        </div>

        <div class="grid-3">
            @foreach ($causes as $cause)
                @php $progress = $causeRepo->progress($cause); @endphp
                <article class="panel cause-card">
                    <div class="image-wrap">
                        <span class="tag image-tag">{{ $cause['category'] }}</span>
                        <img src="{{ $cause['image'] }}" alt="{{ $cause['title'] }}">
                    </div>
                    <div class="panel-pad">
                        <h3>{{ $cause['title'] }}</h3>
                        <p>{{ $cause['brief'] }}</p>

                        <div class="funding-summary">
                            <div class="funding-box"><span>Target</span><strong>{{ $causeRepo->formatMoney($cause['target']) }}</strong></div>
                            <div class="funding-box"><span>Raised</span><strong>{{ $causeRepo->formatMoney($cause['raised']) }}</strong></div>
                        </div>

                        <div>
                            <div class="progress-meta"><span>{{ $progress }}% funded</span><span>{{ $causeRepo->formatMoney($cause['target'] - $cause['raised']) }} needed</span></div>
                            <div class="progress-bar" style="--progress: {{ $progress }}%;"><span></span></div>
                        </div>

                        <div class="cause-actions">
                            <a class="button" href="/donate?cause={{ urlencode($cause['title']) }}">Donate</a>
                            <a class="button outline" href="/causes/{{ $cause['slug'] }}">Details</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
