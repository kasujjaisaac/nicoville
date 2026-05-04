@extends('layouts.public-page')

@section('title', $event['title'])
@section('crumb', 'Events / ' . $event['title'])
@section('hero', $event['title'])

@section('page_css')
    .event-detail { display:grid; grid-template-columns:minmax(0,1fr) 420px; gap:28px; max-width:1180px; margin:0 auto; align-items:start; }
    .event-main { overflow:hidden; }
    .rotating-image { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0; transform:scale(1.04); transition:opacity .75s ease, transform 1.2s ease; }
    .rotating-image.is-active { opacity:1; transform:scale(1); }
    .image-dots { position:absolute; right:18px; bottom:18px; display:flex; gap:7px; z-index:2; }
    .image-dots span { width:9px; height:9px; border:1px solid rgba(255,255,255,.9); background:rgba(255,255,255,.28); }
    .image-dots span.is-active { background:var(--white); }
    .event-copy { display:grid; gap:16px; }
    .event-copy p { margin:0; color:var(--muted); }
    .event-facts { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px; margin-top:18px; }
    .event-facts div { padding:16px; border:1px solid var(--line); background:var(--soft); }
    .event-facts span { display:block; margin-bottom:5px; color:var(--muted); font-size:12px; font-weight:900; text-transform:uppercase; }
    .event-facts strong { color:var(--green-dark); }
    .schedule-list { display:grid; gap:12px; margin:0; padding:0; list-style:none; }
    .schedule-list li { padding:14px 16px; border-left:4px solid var(--green); background:var(--soft); color:var(--green-dark); font-weight:800; }
    .booking-card { position:sticky; top:128px; }
    .notice { max-width:1180px; margin:0 auto 20px; padding:16px; border:1px solid rgba(8,115,72,.25); background:rgba(8,115,72,.08); color:var(--green-dark); font-weight:800; }
    .errors { max-width:1180px; margin:0 auto 20px; padding:16px; border:1px solid rgba(8,115,72,.25); background:var(--white); color:var(--green-dark); }
    @media (max-width:980px){ .event-detail{grid-template-columns:1fr;} .booking-card{position:static;} }
    @media (max-width:640px){ .event-facts{grid-template-columns:1fr;} }
@endsection

@section('content')
    <section class="section">
        @if (session('status'))
            <div class="notice">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <strong>Please fix these fields:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="event-detail">
            <article class="panel event-main">
                <div class="image-wrap rotating-gallery">
                    <span class="tag image-tag">{{ $event['category'] }}</span>
                    @foreach (($event['images'] ?? [$event['image']]) as $imageIndex => $image)
                        <img class="rotating-image {{ $imageIndex === 0 ? 'is-active' : '' }}" src="{{ $image }}" alt="{{ $event['title'] }} image {{ $imageIndex + 1 }}">
                    @endforeach
                    <div class="image-dots" aria-hidden="true">
                        @foreach (($event['images'] ?? [$event['image']]) as $imageIndex => $image)
                            <span class="{{ $imageIndex === 0 ? 'is-active' : '' }}"></span>
                        @endforeach
                    </div>
                </div>
                <div class="panel-pad event-copy">
                    <h2>Event Details</h2>
                    @foreach ($event['details'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                    <div class="event-facts">
                        <div><span>Date</span><strong>{{ $event['date'] }}</strong></div>
                        <div><span>Time</span><strong>{{ $event['time'] }}</strong></div>
                        <div><span>Venue</span><strong>{{ $event['venue'] }}</strong></div>
                        <div><span>Program</span><strong>{{ $event['category'] }}</strong></div>
                    </div>
                    <h2>Program Flow</h2>
                    <ul class="schedule-list">
                        @foreach ($event['schedule'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </article>
            <aside class="booking-card" id="book-event">
                <form class="form-card" action="/events/{{ $event['slug'] }}/book" method="POST">
                    @csrf
                    <input type="hidden" name="event_slug" value="{{ $event['slug'] }}">
                    <h3>Book or Confirm Presence</h3>
                    <label>Name<input name="name" type="text" value="{{ old('name') }}" placeholder="Your full name" required></label>
                    <label>Email<input name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com" required></label>
                    <label>Phone<input name="phone" type="tel" value="{{ old('phone') }}" placeholder="+256..."></label>
                    <div class="form-row">
                        <label>Action
                            <select name="attendance_type" required>
                                <option {{ old('attendance_type') === 'Book this event' ? 'selected' : '' }}>Book this event</option>
                                <option {{ old('attendance_type') === 'Confirm presence' ? 'selected' : '' }}>Confirm presence</option>
                                <option {{ old('attendance_type') === 'Volunteer' ? 'selected' : '' }}>Volunteer</option>
                            </select>
                        </label>
                        <label>Guests<input name="guests" type="number" min="1" max="20" value="{{ old('guests', 1) }}" required></label>
                    </div>
                    <label>Message<textarea name="message" placeholder="Any note for the team">{{ old('message') }}</textarea></label>
                    <button class="button" type="submit">Submit Booking</button>
                </form>
            </aside>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.rotating-gallery').forEach((gallery) => {
            const images = Array.from(gallery.querySelectorAll('.rotating-image'));
            const dots = Array.from(gallery.querySelectorAll('.image-dots span'));

            if (images.length <= 1) {
                return;
            }

            let activeIndex = 0;

            window.setInterval(() => {
                images[activeIndex].classList.remove('is-active');
                dots[activeIndex]?.classList.remove('is-active');

                activeIndex = (activeIndex + 1) % images.length;

                images[activeIndex].classList.add('is-active');
                dots[activeIndex]?.classList.add('is-active');
            }, 3600);
        });
    </script>
@endsection
