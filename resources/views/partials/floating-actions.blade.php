@php $whatsappUrl = $settings['whatsapp_url'] ?? null; @endphp

<div class="floating-actions" aria-label="Quick contact actions">
    @if (filled($whatsappUrl))
        <a class="floating-action whatsapp-action" href="{{ $whatsappUrl }}" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12.1 2a9.9 9.9 0 0 0-8.5 15l-1 4 4.1-1a9.9 9.9 0 1 0 5.4-18zm0 2a7.9 7.9 0 0 1 6.7 12.1 7.9 7.9 0 0 1-10.9 2.3l-.4-.2-2.4.6.6-2.3-.3-.4A7.9 7.9 0 0 1 12.1 4zm-3.3 3.8c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3.2 5 4.3 2.5 1 3 .8 3.5.7.6-.1 1.8-.8 2-1.5.3-.7.3-1.3.2-1.5-.1-.1-.3-.2-.7-.4l-2.1-1c-.3-.1-.6-.2-.8.2l-.9 1.1c-.2.2-.4.3-.7.1-.4-.2-1.4-.5-2.6-1.6-1-.9-1.6-2-1.8-2.4-.2-.3 0-.5.1-.7l.5-.6c.2-.2.2-.4.3-.6.1-.2.1-.4 0-.6L9.3 8c-.1-.2-.3-.2-.5-.2z"/></svg>
            <span>Chat with us</span>
        </a>
    @endif

    <button class="floating-action back-to-top" type="button" aria-label="Back to top" data-back-to-top>
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5 5 12l1.4 1.4L11 8.8V20h2V8.8l4.6 4.6L19 12l-7-7z"/></svg>
    </button>
</div>

<script>
    (() => {
        const backToTop = document.querySelector('[data-back-to-top]');

        if (! backToTop) {
            return;
        }

        const toggleBackToTop = () => {
            backToTop.classList.toggle('is-visible', window.scrollY > 360);
        };

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        toggleBackToTop();
        window.addEventListener('scroll', toggleBackToTop, { passive: true });
    })();
</script>
