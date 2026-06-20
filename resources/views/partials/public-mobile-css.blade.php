.mobile-nav-toggle {
    display: none;
}

.mobile-menu-panel {
    display: none;
}

@media (max-width: 980px) {
    html,
    body {
        overflow-x: hidden;
    }

    body.public-nav-open {
        overflow: hidden;
    }

    body.public-nav-open::before {
        position: fixed;
        inset: 0;
        z-index: 79;
        content: "";
        background: rgba(6, 63, 46, .44);
    }

    img,
    video {
        max-width: 100%;
    }

    .top-bar {
        gap: 12px;
        padding-inline: 14px !important;
    }

    .contact-list,
    .top-group {
        min-width: 0;
    }

    .site-header {
        position: sticky;
        top: 0;
        display: grid !important;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 8px !important;
        align-items: center !important;
        padding: 10px 14px !important;
    }

    .brand {
        min-width: 0 !important;
    }

    .brand-mark {
        max-width: min(220px, 72vw) !important;
        height: 58px !important;
    }

    .mobile-nav-toggle {
        display: inline-flex;
        width: 44px;
        height: 44px;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--line);
        background: var(--white);
        color: var(--green-dark);
        font: inherit;
        font-size: 28px;
        font-weight: 900;
        line-height: 1;
        cursor: pointer;
        touch-action: manipulation;
    }

    .site-header > .nav {
        display: none !important;
    }

    .mobile-menu-panel {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 90;
        display: grid !important;
        width: min(86vw, 340px);
        max-width: 100%;
        align-content: start;
        justify-content: stretch !important;
        gap: 8px !important;
        overflow-y: auto;
        padding: max(18px, env(safe-area-inset-top)) 14px max(22px, env(safe-area-inset-bottom)) !important;
        border-left: 1px solid var(--line);
        background: var(--white);
        box-shadow: -24px 0 60px rgba(6, 63, 46, .2);
        transform: translateX(104%);
        transition: transform .22s ease;
        -webkit-overflow-scrolling: touch;
    }

    body.public-nav-open .mobile-menu-panel {
        transform: translateX(0);
    }

    .mobile-menu-panel .nav-item {
        display: block !important;
        width: 100%;
    }

    .mobile-menu-panel .donate-link {
        display: block !important;
        padding: 0 !important;
        background: transparent !important;
        color: inherit !important;
        box-shadow: none !important;
    }

    .mobile-menu-panel a,
    .mobile-menu-panel .nav-trigger {
        display: flex !important;
        width: 100%;
        min-height: 40px !important;
        align-items: center;
        justify-content: flex-start;
        padding: 0 12px !important;
        border: 1px solid var(--line);
        background: var(--white);
        color: var(--green-dark) !important;
        white-space: normal;
    }

    .mobile-menu-panel .donate-link a,
    .mobile-menu-panel .donate-link .nav-trigger {
        border-color: var(--green);
        background: var(--green) !important;
        color: var(--white) !important;
    }

    .mobile-menu-panel .submenu {
        position: static !important;
        display: none !important;
        width: 100% !important;
        max-height: none;
        margin-top: 6px;
        overflow: visible;
        box-shadow: none !important;
        opacity: 1 !important;
        pointer-events: auto !important;
        transform: none !important;
    }

    .mobile-menu-panel .nav-item:hover .submenu,
    .mobile-menu-panel .nav-item:focus-within .submenu,
    .mobile-menu-panel .nav-item.submenu-open .submenu {
        display: grid !important;
    }

    .page-hero,
    .about-hero {
        padding: 46px 16px !important;
    }

    h1,
    .about-hero h1 {
        font-size: clamp(36px, 11vw, 58px) !important;
        overflow-wrap: anywhere;
    }

    h2,
    .section-head h2,
    .causes-heading h2,
    .impact-copy h2,
    .trust-copy h2,
    .contact-panel h2,
    .about-card h2 {
        font-size: clamp(30px, 8vw, 42px) !important;
    }

    .grid-2,
    .grid-3,
    .cards-grid,
    .values-heading,
    .footer-grid {
        grid-template-columns: 1fr !important;
    }

    .footer-grid,
    .footer-bottom {
        padding-inline: 18px !important;
    }

    .site-footer {
        background:
            linear-gradient(180deg, rgba(255, 255, 255, .05), transparent 34%),
            var(--green-dark) !important;
    }

    .footer-grid {
        gap: 28px !important;
    }

    .footer-col h3 {
        position: relative;
        margin-bottom: 14px !important;
        padding-bottom: 10px;
        font-size: 20px !important;
    }

    .footer-col h3::after {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 34px;
        height: 2px;
        content: "";
        background: rgba(255, 255, 255, .7);
    }

    .footer-links,
    .footer-contact {
        gap: 9px !important;
    }

    .footer-links a,
    .footer-contact a {
        display: inline-flex;
        min-height: 28px;
        align-items: center;
    }

    .hero-slider {
        min-height: auto !important;
    }

    .slide {
        position: relative !important;
        display: none !important;
        min-height: auto !important;
        padding: 28px 16px 58px !important;
    }

    .slide.is-active {
        display: block !important;
    }

    .hero-inner {
        min-height: 0 !important;
        gap: 14px !important;
    }

    .donation-card {
        width: 100% !important;
        padding: 10px !important;
    }

    .donation-steps {
        display: none !important;
    }

    .image-wrap,
    .certificate-view,
    .news-image,
    .event-image,
    .project-image,
    .cause-hero,
    .article-image,
    .team-photo,
    .trust-image {
        aspect-ratio: 4 / 3;
        min-height: 0 !important;
    }

    .image-wrap img,
    .certificate-view img,
    .news-image img,
    .event-image img,
    .project-image img,
    .cause-hero img,
    .article-image img,
    .team-photo img,
    .trust-image img {
        min-height: 0 !important;
    }
}

@media (max-width: 640px) {
    body {
        font-size: 16px !important;
    }

    p,
    .lead,
    .section-head p,
    .footer-col p {
        font-size: 16px !important;
        line-height: 1.62;
    }

    .top-bar {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 6px !important;
        overflow: visible !important;
        min-height: 0;
        padding: 8px 12px !important;
        white-space: normal !important;
    }

    .contact-list,
    .top-group {
        display: grid !important;
        width: 100%;
        min-width: 0;
        overflow: visible !important;
        gap: 6px !important;
        white-space: normal !important;
    }

    .contact-list {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        align-items: stretch !important;
    }

    .contact-list .top-link:nth-child(3) {
        display: none !important;
    }

    .contact-list .volunteer-button {
        grid-column: auto;
        justify-self: stretch;
        margin-inline: auto;
        padding-inline: 3px !important;
    }

    .contact-list .volunteer-button span {
        font-size: 0;
    }

    .contact-list .volunteer-button span::after {
        content: "Volunteer";
        font-size: 10px;
    }

    .top-link {
        min-width: 0;
        min-height: 28px !important;
        justify-content: center;
        padding: 3px 3px;
        border: 0 !important;
        background: transparent !important;
        font-size: 10px !important;
        line-height: 1.25;
        text-align: center;
        white-space: nowrap;
    }

    .top-link span {
        min-width: 0;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .top-group {
        grid-template-columns: 1fr auto;
        align-items: center !important;
    }

    .top-group > span {
        min-width: 0;
        padding: 5px 8px;
        border: 0;
        background: transparent;
        font-size: 11px;
        line-height: 1.25;
        text-align: center;
        overflow-wrap: anywhere;
    }

    .top-socials a {
        width: 28px !important;
        height: 28px !important;
    }

    .top-socials {
        flex-direction: row !important;
        justify-content: flex-end;
    }

    .section,
    .about-body,
    .values-section,
    .causes-section,
    .events-section,
    .news-section,
    .contact-section {
        padding: 34px 12px !important;
    }

    .panel-pad,
    .form-card,
    .about-card,
    .value-card,
    .contact-form,
    .contact-panel,
    .event-content,
    .news-card-body,
    .team-body {
        padding: 14px !important;
    }

    .form-row,
    .funding-summary,
    .event-facts,
    .summary-grid,
    .certificate-grid,
    .contact-layout,
    .donate-layout,
    .event-detail,
    .cause-wrap,
    .project-detail,
    .team-detail,
    .news-grid {
        grid-template-columns: 1fr !important;
    }

    .button,
    .contact-submit,
    .news-link,
    .event-link,
    .program-link,
    .cause-link {
        width: 100%;
        justify-content: center;
        min-height: 48px;
    }

    .footer-links.two-columns {
        grid-template-columns: 1fr !important;
    }

    .footer-bottom {
        align-items: flex-start !important;
        flex-direction: column !important;
    }

    .hero-slider {
        min-height: auto !important;
    }

    .hero-inner {
        display: grid !important;
        grid-template-columns: 1fr !important;
        align-items: start !important;
        min-height: auto !important;
    }

    .hero-inner h1,
    .slide-content h1 {
        font-size: clamp(30px, 9vw, 40px) !important;
        line-height: 1.08 !important;
    }

    .slide-content {
        width: 100% !important;
    }

    .eyebrow {
        margin-bottom: 10px !important;
        font-size: 12px !important;
    }

    .lead {
        margin-top: 12px !important;
        max-width: none !important;
    }

    .actions {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 8px !important;
        margin-top: 18px !important;
    }

    .slide .actions .button,
    .hero-slider .button {
        width: 100% !important;
        min-width: 0;
        min-height: 44px !important;
        padding: 8px 12px !important;
        white-space: normal !important;
        text-align: center;
        line-height: 1.2;
    }

    .stats-section {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 8px !important;
        overflow-x: visible;
        padding-inline: 12px !important;
    }

    .stat-card {
        min-width: 0;
        padding: 14px 10px !important;
        min-height: 116px;
        display: grid !important;
        align-content: center;
        text-align: center;
    }

    .stats-heading {
        grid-column: 1 / -1;
        text-align: center;
    }

    .stats-heading h2 {
        font-size: clamp(24px, 7vw, 34px) !important;
    }

    .footer-grid {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 18px 18px !important;
        padding-top: 28px !important;
        padding-bottom: 22px !important;
    }

    .footer-col:first-child {
        order: 1;
    }

    .footer-col:nth-child(2) {
        order: 2;
    }

    .footer-col:nth-child(3) {
        order: 3;
    }

    .footer-col:nth-child(4),
    .footer-col:has(.footer-contact) {
        order: 4;
    }

    .footer-col:first-child,
    .footer-col:nth-child(4),
    .footer-col:last-child,
    .footer-col:has(.footer-contact) {
        grid-column: 1 / -1;
    }

    .footer-col:nth-child(2),
    .footer-col:nth-child(3) {
        min-width: 0;
    }

    .footer-col h3 {
        margin-bottom: 10px !important;
        padding-bottom: 8px;
        font-size: 17px !important;
        line-height: 1.2;
    }

    .footer-col h3::after {
        width: 26px;
        height: 2px;
        opacity: .7;
    }

    .footer-links.two-columns {
        grid-template-columns: 1fr 1fr !important;
        column-gap: 12px !important;
    }

    .footer-col:nth-child(2) .footer-links,
    .footer-col:nth-child(3) .footer-links {
        grid-template-columns: 1fr !important;
    }

    .footer-logo {
        max-width: 142px !important;
        height: 42px !important;
    }

    .footer-col p {
        max-width: none !important;
        margin-top: 10px !important;
        font-size: 14px !important;
        line-height: 1.55 !important;
    }

    .footer-links,
    .footer-contact {
        gap: 6px !important;
        font-size: 14px !important;
        line-height: 1.4;
    }

    .footer-links a,
    .footer-contact a,
    .footer-contact li {
        min-height: 24px;
        overflow-wrap: anywhere;
    }

    .footer-contact {
        grid-template-columns: 1fr;
    }

    .footer-contact li:nth-child(3),
    .footer-contact li:nth-child(4) {
        grid-column: auto;
    }

    .footer-social-title {
        margin-top: 14px !important;
        margin-bottom: 8px !important;
        padding-top: 12px;
        border-top: 1px solid rgba(255, 255, 255, .14);
        font-size: 12px !important;
    }

    .footer-socials {
        justify-content: flex-start;
        gap: 8px !important;
    }

    .footer-socials a {
        width: 38px !important;
        height: 38px !important;
    }

    .footer-bottom {
        gap: 8px !important;
        padding-top: 12px !important;
        padding-bottom: max(16px, env(safe-area-inset-bottom)) !important;
        font-size: 12px !important;
        line-height: 1.45;
        text-align: left;
    }

    .footer-bottom-links {
        gap: 10px !important;
    }

    .amount-grid,
    .program-cards,
    .values-grid,
    .impact-gallery-grid,
    .project-stats,
    .payment-methods {
        gap: 8px !important;
    }

    .panel,
    .news-card,
    .event-card,
    .project-card,
    .cause-card,
    .team-card,
    .certificate-card,
    .about-card,
    .value-card,
    .stat-card,
    .program-card,
    .donation-card,
    .contact-form {
        box-shadow: 0 8px 22px rgba(6, 63, 46, .07) !important;
    }

    .donation-card {
        display: grid !important;
        gap: 9px !important;
        align-self: stretch;
        margin-top: 4px;
        overflow: visible !important;
    }

    .donation-title {
        margin: 0 !important;
        font-size: 20px !important;
        line-height: 1.2 !important;
        text-align: center;
    }

    .donation-note {
        min-height: 0 !important;
        padding: 4px 8px !important;
        font-size: 11px !important;
        text-align: center;
    }

    .donation-toggle,
    .amount-grid,
    .payment-row {
        gap: 6px !important;
    }

    .toggle-option,
    .amount-button,
    .payment-badge {
        min-height: 38px !important;
        padding: 6px 8px !important;
        font-size: 12px !important;
        line-height: 1.15;
    }

    .amount-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }

    .donation-card input,
    .donation-card select,
    .donation-submit {
        min-height: 44px !important;
    }

    .currency-select-wrap,
    .custom-amount {
        gap: 5px !important;
        font-size: 12px !important;
    }

    .payment-row {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }

    .donation-submit {
        margin-top: 2px !important;
    }

    .impact-section {
        gap: 18px !important;
        padding-block: 32px !important;
    }

    .impact-images {
        gap: 8px !important;
    }

    .impact-image {
        min-height: 180px !important;
    }

    .program-card,
    .cause-card {
        min-height: 0 !important;
    }

    .causes-section {
        overflow: hidden;
    }

    .causes-heading {
        gap: 10px !important;
        margin-bottom: 18px !important;
        text-align: center;
    }

    .causes-heading p {
        max-width: none !important;
    }

    .causes-track .cause-card,
    .projects-grid .cause-card {
        grid-template-columns: 1fr !important;
        gap: 0 !important;
        padding: 0 !important;
        background: var(--white) !important;
        color: var(--green-dark) !important;
        border: 1px solid var(--line);
    }

    .causes-track .cause-image,
    .projects-grid .cause-image {
        order: -1;
        min-height: 190px !important;
    }

    .causes-track .cause-image img,
    .projects-grid .cause-image img {
        min-height: 190px !important;
    }

    .causes-track .cause-content,
    .projects-grid .cause-content {
        padding: 16px !important;
    }

    .causes-track .cause-card h3,
    .projects-grid .cause-card h3 {
        color: var(--green-dark) !important;
        font-size: 21px !important;
    }

    .project-card-summary {
        margin-top: 8px !important;
        color: var(--muted) !important;
        font-size: 14px !important;
        line-height: 1.5 !important;
    }

    .home-cause-actions,
    .project-meta-row {
        gap: 8px !important;
    }

    .cause-arrow {
        width: 40px !important;
        height: 40px !important;
    }

    .testimonials-section {
        padding: 38px 12px !important;
    }

    .testimonials-wrap {
        gap: 18px !important;
    }

    .testimonials-copy {
        text-align: center;
    }

    .testimonial-feature {
        justify-content: center;
        text-align: left;
    }

    .testimonial-card {
        min-height: 0 !important;
        padding: 20px 16px !important;
    }

    .testimonial-card blockquote {
        font-size: 16px !important;
        line-height: 1.55 !important;
    }

    .testimonial-controls {
        gap: 12px !important;
    }

    .contact-grid {
        gap: 14px !important;
    }

    .contact-list-block {
        gap: 8px !important;
    }

    .contact-form {
        gap: 12px !important;
    }

    .contact-form input,
    .contact-form select,
    .contact-form textarea {
        min-height: 44px !important;
    }

    .contact-form textarea {
        min-height: 120px !important;
    }

    .floating-actions {
        right: 8px !important;
        bottom: max(10px, env(safe-area-inset-bottom)) !important;
        gap: 8px !important;
    }

    .floating-action {
        width: 42px !important;
        height: 42px !important;
    }
}

@media (max-width: 420px) {
    .brand-mark {
        max-width: 180px !important;
        height: 50px !important;
    }

    h1,
    .about-hero h1 {
        font-size: clamp(31px, 10vw, 42px) !important;
    }

    h2,
    .section-head h2,
    .causes-heading h2,
    .impact-copy h2,
    .trust-copy h2,
    .contact-panel h2,
    .about-card h2 {
        font-size: clamp(25px, 7vw, 34px) !important;
    }

    .hero-slider {
        min-height: auto !important;
    }

    .top-bar {
        padding-inline: 10px !important;
    }

    .top-link {
        font-size: 9px !important;
        padding-inline: 2px;
    }

    .contact-list .volunteer-button span::after {
        font-size: 9px;
    }

    .top-group {
        grid-template-columns: 1fr;
    }

    .top-socials {
        justify-content: center;
    }

    .footer-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 16px 12px !important;
    }

    .footer-col:first-child,
    .footer-col:nth-child(4),
    .footer-col:last-child,
    .footer-col:has(.footer-contact) {
        grid-column: 1 / -1;
    }

    .footer-col h3 {
        font-size: 16px !important;
    }

    .footer-links,
    .footer-contact {
        font-size: 13px !important;
    }

    .button,
    .contact-submit,
    .news-link,
    .event-link,
    .program-link,
    .cause-link {
        min-height: 44px;
        padding-inline: 12px !important;
        font-size: 13px !important;
    }

    .stat-card {
        min-height: 104px;
        padding-inline: 8px !important;
    }

    .stat-card strong {
        font-size: 34px !important;
    }

    .stat-card > span {
        font-size: 11px !important;
    }

    .donation-title {
        font-size: 18px !important;
    }

    .amount-button,
    .payment-badge {
        font-size: 11px !important;
    }
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        scroll-behavior: auto !important;
        transition-duration: .01ms !important;
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
    }
}
