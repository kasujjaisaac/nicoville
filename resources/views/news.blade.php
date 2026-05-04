@extends('layouts.public-page')

@section('title', 'News and Blogs')
@section('crumb', 'News')
@section('hero', 'News and Blogs')

@section('page_css')
    .news-card { overflow:hidden; }
    .news-card .panel-pad { display:grid; gap:14px; }
    .news-card p { margin:0; color:var(--muted); }
    .news-date { color:var(--green); font-size:14px; font-weight:900; text-transform:uppercase; }
@endsection

@section('content')
    <section class="section">
        <div class="section-head">
            <h2>Stories From the Field</h2>
            <p>Follow updates from our programs, community outreaches, and the work happening around children and families.</p>
        </div>
        <div class="grid-3">
            @foreach ($posts as $post)
                <article class="panel news-card">
                    <div class="image-wrap">
                        <span class="tag image-tag">{{ $post['category'] }}</span>
                        <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}">
                    </div>
                    <div class="panel-pad">
                        <span class="news-date">{{ $post['date'] }}</span>
                        <h3>{{ $post['title'] }}</h3>
                        <p>{{ $post['summary'] }}</p>
                        <a class="button outline" href="{{ $post['link_url'] ?? '/contact' }}">{{ $post['link_label'] ?? 'Read More' }}</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
