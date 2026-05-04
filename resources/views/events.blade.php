@extends('layouts.public-page')

@section('title', 'Events')
@section('crumb', 'Events')
@section('hero', 'Events')

@section('page_css')
    .events-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:24px; max-width:1180px; margin:0 auto; }
    .event-card { display:grid; grid-template-columns:240px minmax(0,1fr); overflow:hidden; }
    .event-card .image-wrap { min-height:100%; }
    .event-card .image-wrap img { min-height:100%; }
    .rotating-image { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0; transform:scale(1.04); transition:opacity .75s ease, transform 1.2s ease; }
    .rotating-image.is-active { opacity:1; transform:scale(1); }
    .image-dots { position:absolute; right:14px; bottom:14px; display:flex; gap:6px; z-index:2; }
    .image-dots span { width:8px; height:8px; border:1px solid rgba(255,255,255,.9); background:rgba(255,255,255,.28); }
    .image-dots span.is-active { background:var(--white); }
    .event-body { display:grid; gap:14px; padding:24px; }
    .event-body p { margin:0; color:var(--muted); }
    .event-meta { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; }
    .event-meta span { padding:12px; border:1px solid var(--line); background:var(--soft); color:var(--green-dark); font-size:14px; font-weight:800; }
    .event-actions { display:flex; flex-wrap:wrap; gap:10px; }
    @media (max-width:1120px){ .events-grid{grid-template-columns:1fr;} }
    @media (max-width:640px){ .event-card{grid-template-columns:1fr;} .event-meta{grid-template-columns:1fr;} }
@endsection

@section('content')
    <section class="section">
        <div class="section-head">
            <h2>Upcoming Events & Programs</h2>
            <p>Browse Nicoville events, read the full details, and book or confirm your presence so our team can prepare well.</p>
        </div>
        <div class="events-grid">
            @foreach ($events as $event)
                <article class="panel event-card">
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
                    <div class="event-body">
                        <h3>{{ $event['title'] }}</h3>
                        <div class="event-meta">
                            <span>{{ $event['date'] }}</span>
                            <span>{{ $event['time'] }}</span>
                            <span>{{ $event['venue'] }}</span>
                            <span>{{ $event['category'] }}</span>
                        </div>
                        <p>{{ $event['summary'] }}</p>
                        <div class="event-actions">
                            <a class="button" href="/events/{{ $event['slug'] }}">View Event</a>
                            <a class="button outline" href="/events/{{ $event['slug'] }}#book-event">Book Event</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.rotating-gallery').forEach((gallery, galleryIndex) => {
            const images = Array.from(gallery.querySelectorAll('.rotating-image'));
            const dots = Array.from(gallery.querySelectorAll('.image-dots span'));

            if (images.length <= 1) {
                return;
            }

            let activeIndex = 0;
            const rotateDelay = 3600 + (galleryIndex * 450);

            window.setInterval(() => {
                images[activeIndex].classList.remove('is-active');
                dots[activeIndex]?.classList.remove('is-active');

                activeIndex = (activeIndex + 1) % images.length;

                images[activeIndex].classList.add('is-active');
                dots[activeIndex]?.classList.add('is-active');
            }, rotateDelay);
        });
    </script>
@endsection
