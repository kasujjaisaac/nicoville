@extends('layouts.public-page')

@section('title', 'Our Projects')
@section('crumb', 'Projects')
@section('hero', 'Our Projects')

@section('page_css')
    .project-card { overflow:hidden; }
    .project-card .image-wrap { aspect-ratio:16 / 10; min-height:0; }
    .project-card .image-wrap img { display:block; height:100%; min-height:0; object-fit:cover; }
    .project-card .panel-pad { display:grid; gap:14px; }
    .project-card p { margin:0; color:var(--muted); }
    .project-meta { display:flex; flex-wrap:wrap; gap:10px; }
    .project-status { display:inline-flex; width:max-content; min-height:32px; align-items:center; padding:0 10px; border:1px solid var(--line); color:var(--green); font-size:12px; font-weight:900; text-transform:uppercase; }
@endsection

@section('content')
    <section class="section">
        <div class="section-head">
            <h2>Programs Built Around Children</h2>
            <p>Our projects are simple, focused, and community-led so support reaches the children and families who need it most.</p>
        </div>
        <div class="grid-3">
            @foreach ($projects as $project)
                <article class="panel project-card">
                    <div class="image-wrap">
                        <span class="tag image-tag">{{ $project['category'] }}</span>
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}">
                    </div>
                    <div class="panel-pad">
                        <h3>{{ $project['title'] }}</h3>
                        <p>{{ $project['summary'] }}</p>
                        <div class="project-meta">
                            <span class="tag">{{ $project['category'] }}</span>
                            @if ($project['started'])
                                <span class="tag">Since {{ $project['started'] }}</span>
                            @endif
                            <span class="project-status">{{ $project['status'] }}</span>
                        </div>
                        <a class="button outline" href="/projects/{{ $project['slug'] }}">View Project</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
