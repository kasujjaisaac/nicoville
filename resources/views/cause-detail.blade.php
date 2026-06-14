@extends('layouts.public-page')

@section('title', $cause['title'])
@section('crumb', 'Causes / '.$cause['title'])
@section('hero', $cause['title'])

@section('page_css')
    .cause-detail { padding:clamp(56px,7vw,92px) clamp(18px,5vw,76px); background:linear-gradient(180deg,var(--white),var(--soft)); }
    .cause-wrap { display:grid; grid-template-columns:minmax(0,1fr) 340px; gap:28px; max-width:1180px; margin:0 auto; align-items:start; }
    .cause-main,.cause-side { border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
    .cause-hero { position:relative; min-height:420px; overflow:hidden; background:var(--line); }
    .cause-hero img { display:block; width:100%; height:100%; min-height:420px; object-fit:cover; }
    .cause-copy { padding:clamp(24px,4vw,40px); }
    .cause-copy p { margin:0; color:var(--muted); }
    .cause-copy p + p { margin-top:16px; }
    .impact-list { display:grid; gap:12px; margin:24px 0 0; padding:0; list-style:none; }
    .impact-list li { padding:14px 16px; border-left:4px solid var(--green); background:var(--soft); font-weight:700; }
    .cause-side { position:sticky; top:130px; display:grid; gap:18px; padding:22px; }
    .funding-summary { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .funding-box { padding:13px; border:1px solid var(--line); background:var(--soft); }
    .funding-box span { display:block; margin-bottom:4px; color:var(--muted); font-size:12px; font-weight:900; text-transform:uppercase; }
    .funding-box strong { color:var(--green-dark); font-size:20px; }
    .progress-meta { display:flex; justify-content:space-between; gap:12px; margin-bottom:8px; color:var(--green); font-size:14px; font-weight:900; }
    .progress-bar { height:12px; overflow:hidden; background:#d9ebe2; }
    .progress-bar span { display:block; width:var(--progress); height:100%; background:var(--green); }
    .side-actions { display:grid; gap:10px; }
    @media (max-width:980px){ .cause-wrap{grid-template-columns:1fr;} .cause-side{position:static;} }
    @media (max-width:640px){ .cause-hero,.cause-hero img{min-height:320px;} .funding-summary{grid-template-columns:1fr;} }
@endsection

@section('content')
    @php $progress = $causeRepo->progress($cause); @endphp
    <section class="cause-detail">
        <div class="cause-wrap">
            <article class="cause-main">
                <div class="cause-hero">
                    <span class="tag image-tag">{{ $cause['category'] }}</span>
                    <img src="{{ $cause['image'] }}" alt="{{ $cause['title'] }}">
                </div>
                <div class="cause-copy">
                    <span class="tag">Cause Details</span>
                    <h2>{{ $cause['title'] }}</h2>
                    @forelse ($cause['details'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @empty
                        <p>{{ $cause['brief'] }}</p>
                    @endforelse

                    @if (! empty($cause['impact']))
                        <ul class="impact-list">
                            @foreach ($cause['impact'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </article>

            <aside class="cause-side">
                <div>
                    <span class="tag">{{ $cause['category'] }}</span>
                    <h3>{{ $cause['title'] }}</h3>
                    <p>{{ $cause['brief'] }}</p>
                </div>
                <div class="funding-summary">
                    <div class="funding-box"><span>Target</span><strong>{{ $causeRepo->formatMoney($cause['target']) }}</strong></div>
                    <div class="funding-box"><span>Raised</span><strong>{{ $causeRepo->formatMoney($cause['raised']) }}</strong></div>
                </div>
                <div>
                    <div class="progress-meta"><span>{{ $progress }}% funded</span><span>{{ $causeRepo->formatMoney($cause['target'] - $cause['raised']) }} needed</span></div>
                    <div class="progress-bar" style="--progress: {{ $progress }}%;"><span></span></div>
                </div>
                <div class="side-actions">
                    <a class="button" href="/donate?cause={{ urlencode($cause['title']) }}">Donate to This Cause</a>
                    <a class="button outline" href="/causes">Back to Causes</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
