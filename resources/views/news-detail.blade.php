@extends('layouts.public-page')

@section('title', $post['title'])
@section('crumb', 'News / '.$post['title'])
@section('hero', $post['title'])

@section('page_css')
    .article-wrap { max-width:980px; margin:0 auto; }
    .article-image { overflow:hidden; margin-bottom:26px; border:1px solid var(--line); background:var(--line); }
    .article-image img { width:100%; max-height:520px; object-fit:cover; display:block; }
    .article-card { padding:clamp(26px,4vw,42px); border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
    .article-meta { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px; }
    .article-card p { color:var(--muted); }
@endsection

@section('content')
    <section class="section">
        <article class="article-wrap">
            <div class="article-image">
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}">
            </div>
            <div class="article-card">
                <div class="article-meta">
                    <span class="tag">{{ $post['category'] }}</span>
                    <span class="tag">{{ $post['date'] }}</span>
                </div>
                <h2>{{ $post['title'] }}</h2>
                @foreach ($post['details'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
                <a class="button outline" href="/news">Back to News</a>
            </div>
        </article>
    </section>
@endsection
