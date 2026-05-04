@extends('layouts.public-page')

@section('title', 'Our Projects')
@section('crumb', 'Projects')
@section('hero', 'Our Projects')

@section('page_css')
    .project-card { overflow:hidden; }
    .project-card .panel-pad { display:grid; gap:14px; }
    .project-card p { margin:0; color:var(--muted); }
    .project-meta { display:flex; flex-wrap:wrap; gap:10px; }
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
                            @foreach ($project['focus'] as $focus)
                                <span class="tag">{{ $focus }}</span>
                            @endforeach
                        </div>
                        <a class="button outline" href="{{ $project['url'] }}">View Project</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
