.admin-mobile-toggle {
    display: none;
}

@media (max-width: 860px) {
    html,
    body {
        overflow-x: hidden;
    }

    body.admin-nav-open {
        overflow: hidden;
    }

    body.admin-nav-open::before {
        position: fixed;
        inset: 0;
        z-index: 69;
        content: "";
        background: rgba(7, 63, 49, .46);
    }

    img,
    video,
    input,
    select,
    textarea,
    button {
        max-width: 100%;
    }

    .admin-layout {
        display: block !important;
        min-height: 100vh;
    }

    .admin-mobile-toggle {
        position: sticky;
        top: 0;
        z-index: 80;
        display: flex;
        width: 100%;
        min-height: 46px;
        align-items: center;
        justify-content: space-between;
        padding: 0 14px;
        border: 0;
        color: var(--white);
        background: var(--green-dark);
        font: inherit;
        font-size: 13px;
        font-weight: 900;
        text-transform: uppercase;
        cursor: pointer;
        touch-action: manipulation;
    }

    .admin-mobile-toggle span:last-child {
        font-size: 22px;
        line-height: 1;
    }

    .sidebar {
        position: fixed !important;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 90;
        width: min(86vw, 330px);
        height: 100svh !important;
        max-height: none;
        overflow: auto;
        padding: max(16px, env(safe-area-inset-top)) 16px max(18px, env(safe-area-inset-bottom)) !important;
        box-shadow: 24px 0 60px rgba(7, 63, 49, .24);
        transform: translateX(-104%);
        transition: transform .22s ease;
        -webkit-overflow-scrolling: touch;
    }

    body.admin-nav-open .sidebar {
        transform: translateX(0);
    }

    .sidebar-brand {
        gap: 10px;
        padding: 0 4px 14px !important;
    }

    .brand-mark {
        width: 40px !important;
        height: 40px !important;
        flex: 0 0 40px;
    }

    .brand-name {
        font-size: 18px !important;
    }

    .brand-role {
        font-size: 11px !important;
    }

    .sidebar-section {
        margin: 14px 0 8px !important;
        padding: 0 4px !important;
    }

    .sidebar-nav {
        display: grid !important;
        gap: 8px !important;
        overflow: visible;
        padding-bottom: 0;
    }

    .sidebar-link {
        flex: none;
        min-height: 40px !important;
        padding: 0 10px !important;
        white-space: normal;
    }

    .sidebar-icon {
        width: 26px !important;
        height: 26px !important;
        flex: 0 0 26px;
    }

    .sidebar-footer {
        margin-top: 14px !important;
        padding: 14px 4px 0 !important;
    }

    .admin-shell {
        width: calc(100% - 18px) !important;
        margin: 12px auto 44px !important;
    }

    .button,
    .small-button,
    .danger-button,
    .order-button,
    .save-button,
    .view-site,
    .preview-link,
    .logout-button {
        min-height: 44px;
        touch-action: manipulation;
    }

    .actions {
        position: sticky !important;
        bottom: 0;
        z-index: 30;
        margin-inline: -9px;
        padding: 10px 9px max(10px, env(safe-area-inset-bottom)) !important;
        background: linear-gradient(transparent, var(--paper) 26%, var(--paper));
    }

    .page-head {
        margin-bottom: 14px !important;
    }

    .page-head p,
    .hint,
    .meta,
    .message {
        font-size: 13px !important;
        line-height: 1.45 !important;
    }

    .stat-card strong {
        font-size: clamp(24px, 8vw, 32px) !important;
    }
}

@media (max-width: 620px) {
    .admin-shell {
        width: calc(100% - 20px) !important;
        margin-top: 14px !important;
    }

    .sidebar {
        padding: 14px 12px !important;
    }

    .sidebar-link {
        min-height: 38px !important;
        font-size: 12px;
    }

    .sidebar-icon {
        width: 24px !important;
        height: 24px !important;
        flex-basis: 24px;
        font-size: 11px !important;
    }

    .page-head h1,
    h1 {
        font-size: clamp(26px, 9vw, 34px) !important;
        overflow-wrap: anywhere;
    }

    .stats,
    .manager-grid,
    .fields-grid,
    .field-grid,
    .heading-grid,
    .form-row,
    .form-row.three,
    .fields,
    .form-grid,
    .grid,
    .upload-panel,
    .media-grid,
    .menu-row,
    .submenu-row,
    .member-card,
    .slide-card,
    .certificate-card,
    .item-card,
    .project-row,
    .cause-row,
    .testimonial-row,
    .booking-row {
        grid-template-columns: 1fr !important;
    }

    .page-head,
    .actions {
        display: grid !important;
        grid-template-columns: 1fr !important;
        align-items: stretch !important;
    }

    .button,
    .small-button,
    .danger-button,
    .order-button,
    .save-button,
    .view-site,
    .preview-link {
        width: 100%;
        justify-content: center;
        margin-top: 0 !important;
    }

    .settings-card,
    .panel,
    .manager-card,
    .stat-card,
    .item-card,
    .menu-card,
    .member-card,
    .slide-card,
    .certificate-card,
    .testimonial-card {
        padding: 12px !important;
    }

    .thumb,
    .certificate-card img,
    .media-preview,
    .image-preview,
    .avatar-preview {
        width: 100% !important;
        max-width: 100%;
    }

    .field.full {
        grid-column: auto !important;
    }

    input,
    select,
    textarea {
        min-height: 42px !important;
        font-size: 14px !important;
    }

    textarea {
        min-height: 110px !important;
    }

    .button-row,
    .order-actions,
    .media-actions {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 8px !important;
    }

    .thumb,
    .media-preview,
    .preview,
    .certificate-card img {
        aspect-ratio: 4 / 3;
        height: auto !important;
        min-height: 0 !important;
        object-fit: cover;
    }
}

@media (max-width: 420px) {
    .admin-shell {
        width: calc(100% - 14px) !important;
    }

    .page-head h1,
    h1 {
        font-size: clamp(23px, 8vw, 30px) !important;
    }

    .settings-card h2,
    .panel h2,
    .manager-card h2,
    .item-card h2 {
        font-size: 19px !important;
    }

    .sidebar {
        width: min(90vw, 320px);
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
