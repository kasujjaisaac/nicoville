@extends('layouts.public-page')

@section('title', 'Contact Us')
@section('crumb', 'Contact')
@section('hero', 'Contact Us')

@section('page_css')
    .contact-layout { display:grid; grid-template-columns:420px minmax(0,1fr); gap:28px; max-width:1180px; margin:0 auto; align-items:start; }
    .contact-info { display:grid; gap:16px; padding:30px; border:1px solid var(--line); background:var(--green); color:var(--white); }
    .contact-info h2,.contact-info p { color:var(--white); }
    .contact-info p { margin:0; opacity:.88; }
    .contact-items { display:grid; gap:12px; margin:10px 0 0; padding:0; list-style:none; }
    .contact-items li { padding:14px; border:1px solid rgba(255,255,255,.26); }
    .contact-items a { color:var(--white); font-weight:800; }
    @media (max-width:980px){ .contact-layout{grid-template-columns:1fr;} }
@endsection

@section('content')
    <section class="section">
        <div class="section-head">
            <h2>{{ $pageContent['contact']['title'] }}</h2>
            <p>{{ $pageContent['contact']['intro'] }}</p>
        </div>
        <div class="contact-layout">
            <aside class="contact-info">
                <h2>Contact Details</h2>
                <p>Our team will respond as soon as possible.</p>
                <ul class="contact-items">
                    <li><b>Phone</b><br><a href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a></li>
                    <li><b>Email</b><br><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></li>
                    <li><b>Location</b><br>{{ $settings['location_label'] }}</li>
                    <li><b>Office Hours</b><br>Mon - Fri: 8:00 AM - 5:00 PM</li>
                </ul>
            </aside>
            <form class="form-card" action="mailto:{{ $settings['email'] }}" method="POST" enctype="text/plain">
                <div class="form-row">
                    <label>Name<input name="name" type="text" placeholder="Your full name" required></label>
                    <label>Email<input name="email" type="email" placeholder="you@example.com" required></label>
                </div>
                <div class="form-row">
                    <label>Phone<input name="phone" type="tel" placeholder="+256..."></label>
                    <label>Reason
                        <select name="reason" required>
                            <option value="">Choose one</option>
                            <option>Donation</option>
                            <option>Volunteer</option>
                            <option>Partnership</option>
                            <option>Programs</option>
                            <option>General Message</option>
                        </select>
                    </label>
                </div>
                <label>Message<textarea name="message" placeholder="Write your message..." required></textarea></label>
                <button class="button" type="submit">Send Message</button>
            </form>
        </div>
    </section>
@endsection
