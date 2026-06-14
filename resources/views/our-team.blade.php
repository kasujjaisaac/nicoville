@extends('layouts.public-page')

@section('title', 'Our Team')
@section('crumb', 'Our Team')
@section('hero', 'Our Team')

@section('page_css')
    .team-intro { max-width:900px; margin:0 auto 42px; text-align:center; }
    .team-intro p { margin:12px 0 0; color:var(--muted); }
    .team-grid { align-items:stretch; gap:28px; }
    .team-card {
        position:relative;
        display:grid;
        grid-template-rows:auto 1fr;
        overflow:hidden;
        border:1px solid var(--line);
        background:var(--white);
        box-shadow:0 22px 58px rgba(6,63,46,.08);
        transition:transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }
    .team-card::before {
        position:absolute;
        inset:0 0 auto;
        height:6px;
        content:"";
        background:linear-gradient(90deg,var(--green),#d79b32);
    }
    .team-card:hover {
        border-color:rgba(8,115,72,.34);
        box-shadow:0 30px 76px rgba(6,63,46,.14);
        transform:translateY(-6px);
    }
    .team-photo {
        position:relative;
        display:grid;
        min-height:310px;
        place-items:center;
        padding:34px 28px 22px;
        background:
            linear-gradient(135deg,rgba(8,115,72,.1),rgba(255,255,255,.75) 52%,rgba(215,155,50,.16)),
            var(--soft);
    }
    .team-photo::before {
        position:absolute;
        inset:28px;
        content:"";
        border:1px solid rgba(8,115,72,.18);
        background:rgba(255,255,255,.42);
    }
    .team-photo img {
        position:relative;
        z-index:1;
        width:min(238px,76vw);
        height:min(238px,76vw);
        border:8px solid var(--white);
        border-radius:999px;
        object-fit:cover;
        object-position:center;
        background:var(--white);
        box-shadow:0 18px 42px rgba(6,63,46,.18);
    }
    .team-role {
        position:relative;
        z-index:1;
        display:inline-flex;
        min-height:34px;
        align-items:center;
        justify-content:center;
        max-width:100%;
        margin-top:-2px;
        padding:0 12px;
        border:1px solid rgba(8,115,72,.22);
        background:var(--white);
        color:var(--green);
        font-size:12px;
        font-weight:900;
        text-align:center;
        text-transform:uppercase;
    }
    .team-body { display:grid; align-content:space-between; padding:26px; }
    .team-body h3 { color:var(--green-dark); font-size:clamp(22px,2vw,28px); }
    .team-body p { margin:12px 0 0; color:var(--muted); }
    .team-actions { display:flex; margin-top:22px; }
    .team-actions .button { min-height:46px; font-size:13px; }
    @media (max-width:980px){ .team-photo img{width:220px;height:220px;} }
    @media (max-width:640px){ .team-photo{min-height:280px;padding:30px 22px 20px;} .team-photo::before{inset:22px;} .team-photo img{width:200px;height:200px;} .team-body{padding:22px;} }
@endsection

@section('content')
    <section class="section" aria-label="Nicoville team">
        <div class="team-intro">
            <span class="tag">People behind the work</span>
            <h2>Serving Children, Families, and Communities With Care</h2>
            <p>Meet the people coordinating Nicoville programs, outreach, partnerships, and volunteer support.</p>
        </div>

        <div class="grid-3 team-grid">
            @foreach ($members as $member)
                <article class="team-card">
                    <div class="team-photo">
                        <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}">
                        <span class="team-role">{{ $member['role'] }}</span>
                    </div>
                    <div class="team-body">
                        <div>
                            <h3>{{ $member['name'] }}</h3>
                            <p>{{ $member['summary'] }}</p>
                        </div>
                        <div class="team-actions">
                            <a class="button" href="/our-team/{{ $member['slug'] }}">Read More</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
