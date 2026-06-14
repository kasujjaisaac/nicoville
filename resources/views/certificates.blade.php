@extends('layouts.public-page')

@section('title', 'Certificates')
@section('crumb', 'Certificates')
@section('hero', 'Certificates')

@section('page_css')
    .certificate-intro { max-width:900px; margin:0 auto 34px; text-align:center; }
    .certificate-intro p { margin:12px 0 0; color:var(--muted); }
    .certificate-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:24px; max-width:1180px; margin:0 auto; }
    .certificate-card { overflow:hidden; border:1px solid var(--line); background:var(--white); box-shadow:0 22px 58px rgba(6,63,46,.08); }
    .certificate-view { position:relative; overflow:hidden; min-height:320px; background:var(--line); user-select:none; -webkit-user-select:none; }
    .certificate-view { cursor:zoom-in; }
    .certificate-view::after { position:absolute; inset:0; content:""; background:repeating-linear-gradient(-24deg, transparent 0 78px, rgba(15,111,77,.08) 78px 82px, transparent 82px 160px); pointer-events:none; }
    .certificate-view img { display:block; width:100%; height:100%; min-height:320px; object-fit:contain; pointer-events:none; -webkit-user-drag:none; }
    .certificate-body { padding:22px; }
    .certificate-body h3 { margin-bottom:8px; }
    .certificate-meta { display:flex; flex-wrap:wrap; gap:10px; margin-top:14px; }
    .certificate-note { max-width:1180px; margin:28px auto 0; padding:16px; border-left:4px solid var(--green); background:rgba(8,115,72,.08); color:var(--green-dark); font-weight:800; }
    .certificate-modal { position:fixed; inset:0; z-index:100; display:none; background:rgba(6,63,46,.92); }
    .certificate-modal.is-open { display:grid; grid-template-rows:auto minmax(0,1fr); }
    .modal-bar { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:14px clamp(16px,4vw,42px); color:var(--white); background:rgba(6,63,46,.98); }
    .modal-bar h2 { margin:0; color:var(--white); font-size:clamp(18px,3vw,28px); }
    .modal-close { min-height:42px; padding:0 16px; border:1px solid rgba(255,255,255,.72); background:transparent; color:var(--white); font:inherit; font-weight:900; cursor:pointer; }
    .modal-stage { display:grid; min-height:0; place-items:center; padding:clamp(14px,3vw,34px); overflow:auto; user-select:none; -webkit-user-select:none; }
    .modal-stage img { display:block; max-width:min(100%,1500px); max-height:calc(100vh - 120px); object-fit:contain; background:var(--white); box-shadow:0 28px 90px rgba(0,0,0,.36); pointer-events:none; -webkit-user-drag:none; }
    @media (max-width:860px){ .certificate-grid{grid-template-columns:1fr;} }
@endsection

@section('content')
    <section class="section" aria-label="Organisation certificates">
        <div class="certificate-intro">
            <span class="tag">Verification Documents</span>
            <h2>Organisation Registration Certificates</h2>
            <p>These protected previews are shown for transparency. Copies are watermarked by Nicoville Foundation.</p>
        </div>

        @if ($certificates)
            <div class="certificate-grid">
                @foreach ($certificates as $certificate)
                    <article class="certificate-card">
                        <button class="certificate-view" type="button" data-certificate-open data-title="{{ $certificate['title'] }}" data-image="/certificates/{{ $certificate['slug'] }}/image" oncontextmenu="return false;">
                            <img src="/certificates/{{ $certificate['slug'] }}/image" alt="{{ $certificate['title'] }}" draggable="false">
                        </button>
                        <div class="certificate-body">
                            <h3>{{ $certificate['title'] }}</h3>
                            <p>{{ $certificate['issuer'] ?: 'Nicoville Foundation registration document' }}</p>
                            <div class="certificate-meta">
                                @if ($certificate['registration_number'])
                                    <span class="tag">Reg: {{ $certificate['registration_number'] }}</span>
                                @endif
                                @if ($certificate['issued_on'])
                                    <span class="tag">{{ $certificate['issued_on'] }}</span>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="certificate-note">Certificates will appear here after they are uploaded by the administrator.</div>
        @endif

        <div class="certificate-note">Protected preview only. For verification, contact Nicoville Foundation directly.</div>
    </section>

    <div class="certificate-modal" id="certificateModal" aria-hidden="true">
        <div class="modal-bar">
            <h2 id="certificateModalTitle">Certificate</h2>
            <button class="modal-close" type="button" data-certificate-close>Close</button>
        </div>
        <div class="modal-stage" oncontextmenu="return false;">
            <img id="certificateModalImage" src="" alt="" draggable="false">
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const certificateModal = document.querySelector('#certificateModal');
        const certificateModalTitle = document.querySelector('#certificateModalTitle');
        const certificateModalImage = document.querySelector('#certificateModalImage');

        function closeCertificateModal() {
            certificateModal.classList.remove('is-open');
            certificateModal.setAttribute('aria-hidden', 'true');
            certificateModalImage.src = '';
            document.body.style.overflow = '';
        }

        document.querySelectorAll('[data-certificate-open]').forEach((button) => {
            button.addEventListener('click', () => {
                certificateModalTitle.textContent = button.dataset.title || 'Certificate';
                certificateModalImage.src = button.dataset.image || '';
                certificateModalImage.alt = button.dataset.title || 'Certificate';
                certificateModal.classList.add('is-open');
                certificateModal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            });
        });

        document.querySelector('[data-certificate-close]')?.addEventListener('click', closeCertificateModal);

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && certificateModal.classList.contains('is-open')) {
                closeCertificateModal();
            }
        });

        document.addEventListener('contextmenu', (event) => {
            if (event.target.closest('.certificate-view') || event.target.closest('.modal-stage')) {
                event.preventDefault();
            }
        });

        document.addEventListener('dragstart', (event) => {
            if (event.target.closest('.certificate-view') || event.target.closest('.modal-stage')) {
                event.preventDefault();
            }
        });
    </script>
@endsection
