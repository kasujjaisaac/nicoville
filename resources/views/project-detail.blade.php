@extends('layouts.public-page')

@section('title', $project['title'])
@section('crumb', 'Projects / '.$project['title'])
@section('hero', $project['title'])

@section('page_css')
    .project-report { padding:clamp(56px,7vw,92px) clamp(18px,5vw,76px); background:linear-gradient(180deg,var(--white),var(--soft)); }
    .report-wrap { display:grid; grid-template-columns:minmax(0,1fr) 340px; gap:28px; max-width:1180px; margin:0 auto; align-items:start; }
    .report-main,.report-side,.report-gallery { border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
    .report-hero { position:relative; min-height:430px; overflow:hidden; background:var(--line); }
    .report-hero img { width:100%; height:100%; min-height:430px; object-fit:cover; display:block; }
    .report-label { position:absolute; left:20px; bottom:20px; display:flex; flex-wrap:wrap; gap:10px; }
    .report-label span { min-height:34px; display:inline-flex; align-items:center; padding:0 12px; border:1px solid rgba(255,255,255,.8); background:rgba(6,63,46,.64); color:var(--white); font-size:13px; font-weight:900; text-transform:uppercase; backdrop-filter:blur(8px); }
    .report-intro { padding:clamp(24px,4vw,40px); border-bottom:1px solid var(--line); }
    .report-intro p { margin:12px 0 0; color:var(--muted); }
    .overview-panel { padding:clamp(24px,4vw,40px); }
    .overview-panel h2 { margin-bottom:14px; color:var(--green); font-size:clamp(28px,3vw,42px); }
    .overview-panel p { margin:0; color:var(--muted); line-height:1.75; }
    .report-download { display:grid; gap:14px; margin-top:22px; padding:22px; border:1px solid var(--line); background:var(--soft); }
    .report-download h3 { margin:0; color:var(--green-dark); }
    .report-download p { margin:0; }
    .report-side { position:sticky; top:130px; display:grid; gap:18px; padding:22px; }
    .stat-list { display:grid; gap:12px; }
    .stat-box { padding:16px; border:1px solid var(--line); background:var(--soft); }
    .stat-box strong { display:block; color:var(--green-dark); font-size:26px; line-height:1; }
    .stat-box span { display:block; margin-top:7px; color:var(--muted); font-size:13px; font-weight:900; text-transform:uppercase; }
    .report-actions { display:grid; gap:10px; }
    .report-gallery { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:10px; padding:10px; }
    .report-gallery img { width:100%; aspect-ratio:1; object-fit:cover; background:var(--line); }
    @media (max-width:980px){ .report-wrap{grid-template-columns:1fr;} .report-side{position:static;} }
    @media (max-width:640px){ .report-gallery{grid-template-columns:1fr;} .report-hero,.report-hero img{min-height:320px;} }
@endsection

@section('content')
    <section class="project-report">
        <div class="report-wrap">
            <article class="report-main">
                <div class="report-hero">
                    <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}">
                    <div class="report-label">
                        <span>{{ $project['category'] }}</span>
                        @if ($project['started'])
                            <span>Since {{ $project['started'] }}</span>
                        @endif
                        <span>{{ $project['status'] }}</span>
                    </div>
                </div>

                <div class="report-intro">
                    <span class="tag">Project Overview</span>
                    <h2>{{ $project['title'] }}</h2>
                    <p>{{ $project['summary'] }}</p>
                </div>

                <section class="overview-panel">
                    <h2>Essential Details</h2>
                    <p>{{ $project['summary'] }}</p>

                    <div class="report-download">
                        <h3>Full Detailed Report</h3>
                        <p>For objectives, activities, beneficiaries reached, impact achieved, challenges, success stories, and future plans, read the full project report.</p>
                        @if ($project['report_file'])
                            <a class="button" href="{{ $project['report_file'] }}" target="_blank" rel="noopener">Download Report / Read Full Detailed Report</a>
                        @else
                            <a class="button outline" href="/contact">Request Full Report</a>
                        @endif
                    </div>
                </section>
            </article>

            <aside class="report-side">
                <div>
                    <span class="tag">Project Snapshot</span>
                    <h3>{{ $project['title'] }}</h3>
                    <p>{{ $project['summary'] }}</p>
                </div>

                @if (! empty($project['stats']))
                    <div class="stat-list">
                        @foreach ($project['stats'] as $stat)
                            <div class="stat-box">
                                <strong>{{ $stat['number'] }}</strong>
                                <span>{{ $stat['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if (! empty($project['gallery']))
                    <div class="report-gallery" aria-label="{{ $project['title'] }} gallery">
                        @foreach ($project['gallery'] as $image)
                            <img src="{{ $image }}" alt="{{ $project['title'] }} project photo">
                        @endforeach
                    </div>
                @endif

                <div class="report-actions">
                    @if ($project['report_file'])
                        <a class="button" href="{{ $project['report_file'] }}" target="_blank" rel="noopener">Read Full Detailed Report</a>
                    @endif
                    <a class="button outline" href="/contact">Partner With This Project</a>
                    <a class="button outline" href="/projects">Back to Projects</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
