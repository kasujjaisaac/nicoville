@php
    $class = $class ?? 'social-links';
    $socialLinks = collect($settings['social_links'] ?? [])
        ->filter(fn (array $link): bool => filled($link['url'] ?? null))
        ->values();
@endphp

@if ($socialLinks->isNotEmpty())
    <div class="{{ $class }}" aria-label="Social media links">
        @foreach ($socialLinks as $link)
            @php $platform = strtolower($link['platform'] ?? $link['label'] ?? 'social'); @endphp
            <a href="{{ $link['url'] }}" target="_blank" rel="noopener" aria-label="{{ $link['label'] ?? ucfirst($platform) }}">
                @switch($platform)
                    @case('facebook')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8h3V4h-3c-3.3 0-5 2-5 5v2H6v4h3v5h4v-5h3.2l.8-4h-4V9c0-.7.3-1 1-1z"/></svg>
                        @break
                    @case('instagram')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm5.5-3.2a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4z"/></svg>
                        @break
                    @case('x')
                    @case('twitter')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.9 2H22l-6.8 7.8L23 22h-6.1l-4.8-6.2L6.7 22H3.6l7.3-8.4L3.4 2h6.3l4.3 5.7L18.9 2zm-1.1 17.9h1.7L8.8 4H7l10.8 15.9z"/></svg>
                        @break
                    @case('youtube')
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.6 7.2s-.2-1.6-.8-2.3c-.8-.8-1.7-.8-2.1-.9C15.8 3.8 12 3.8 12 3.8s-3.8 0-6.7.2c-.4.1-1.3.1-2.1.9-.6.7-.8 2.3-.8 2.3S2.2 9.1 2.2 11v1.8c0 1.9.2 3.8.2 3.8s.2 1.6.8 2.3c.8.8 1.9.8 2.4.9 1.7.2 6.4.2 6.4.2s3.8 0 6.7-.2c.4-.1 1.3-.1 2.1-.9.6-.7.8-2.3.8-2.3s.2-1.9.2-3.8V11c0-1.9-.2-3.8-.2-3.8zM10.1 14.8V8.3l5.9 3.3-5.9 3.2z"/></svg>
                        @break
                    @default
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm4 7-2.2 6.6c-.2.6-.7.7-1.2.4l-2-1.5-1 1c-.1.1-.2.2-.5.2l.2-2.1L13.4 10c.2-.2 0-.3-.2-.2l-5.1 3.2-2.2-.7c-.5-.2-.5-.5.1-.7l8.6-3.3c.4-.2.8.1.6.7z"/></svg>
                @endswitch
            </a>
        @endforeach
    </div>
@endif
