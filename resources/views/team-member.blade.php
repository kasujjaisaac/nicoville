@extends('layouts.public-page')

@section('title', $member['name'])
@section('crumb', 'Our Team / '.$member['name'])
@section('hero', $member['name'])

@section('page_css')
    .profile-wrap { display:grid; grid-template-columns:minmax(320px,.86fr) minmax(0,1.14fr); gap:clamp(28px,5vw,58px); align-items:start; max-width:1180px; margin:0 auto; }
    .profile-photo { position:sticky; top:130px; overflow:hidden; border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
    .profile-photo img { width:100%; min-height:520px; object-fit:cover; display:block; }
    .profile-meta { padding:24px; border-top:1px solid var(--line); background:var(--white); }
    .profile-meta span { display:inline-flex; min-height:34px; align-items:center; margin-bottom:14px; padding:0 12px; border:1px solid var(--green); color:var(--green); font-size:13px; font-weight:900; text-transform:uppercase; }
    .profile-meta h2 { font-size:34px; }
    .profile-meta p { margin:10px 0 0; color:var(--muted); }
    .profile-content { display:grid; gap:22px; }
    .profile-panel { padding:clamp(24px,4vw,38px); border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
    .profile-panel p { margin:0; color:var(--muted); }
    .profile-panel p + p { margin-top:16px; }
    .contact-strip { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; }
    .contact-tile { padding:18px; border:1px solid var(--line); background:var(--soft); }
    .contact-tile b { display:block; margin-bottom:6px; color:var(--green); font-size:13px; text-transform:uppercase; }
    @media (max-width:980px){ .profile-wrap,.contact-strip{grid-template-columns:1fr;} .profile-photo{position:static;} }
@endsection

@section('content')
    <section class="section" aria-label="{{ $member['name'] }} profile">
        <div class="profile-wrap">
            <aside class="profile-photo">
                <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}">
                <div class="profile-meta">
                    <span>{{ $member['role'] }}</span>
                    <h2>{{ $member['name'] }}</h2>
                    <p>{{ $member['summary'] }}</p>
                </div>
            </aside>

            <div class="profile-content">
                <article class="profile-panel">
                    <span class="tag">Profile</span>
                    <h2>About {{ $member['name'] }}</h2>
                    @foreach ($member['bio'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </article>

                @if ($member['email'] || $member['phone'])
                    <section class="contact-strip" aria-label="Member contact details">
                        @if ($member['email'])
                            <div class="contact-tile">
                                <b>Email</b>
                                <a href="mailto:{{ $member['email'] }}">{{ $member['email'] }}</a>
                            </div>
                        @endif
                        @if ($member['phone'])
                            <div class="contact-tile">
                                <b>Phone</b>
                                <a href="tel:{{ $member['phone'] }}">{{ $member['phone'] }}</a>
                            </div>
                        @endif
                    </section>
                @endif

            </div>
        </div>
    </section>
@endsection
