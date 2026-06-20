<script>
    (() => {
        const header = document.querySelector('.site-header');
        const nav = header?.querySelector('.nav');

        if (! header || ! nav || header.querySelector('.mobile-nav-toggle')) {
            return;
        }

        const mobilePanel = document.createElement('nav');
        mobilePanel.className = 'mobile-menu-panel';
        mobilePanel.id = 'mobile-site-nav';
        mobilePanel.setAttribute('aria-label', 'Mobile navigation');
        mobilePanel.innerHTML = nav.innerHTML;

        const toggle = document.createElement('button');
        toggle.className = 'mobile-nav-toggle';
        toggle.type = 'button';
        toggle.setAttribute('aria-controls', 'mobile-site-nav');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Open menu');
        toggle.innerHTML = '&#9776;';

        header.insertBefore(toggle, nav);
        document.body.appendChild(mobilePanel);

        function setOpen(isOpen) {
            document.body.classList.toggle('public-nav-open', isOpen);
            toggle.setAttribute('aria-expanded', String(isOpen));
            toggle.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
            toggle.innerHTML = isOpen ? '&times;' : '&#9776;';

            if (! isOpen) {
                mobilePanel.querySelectorAll('.submenu-open').forEach((item) => {
                    item.classList.remove('submenu-open');
                    item.querySelector('[aria-expanded]')?.setAttribute('aria-expanded', 'false');
                });
            }
        }

        toggle.addEventListener('click', () => {
            setOpen(! document.body.classList.contains('public-nav-open'));
        });

        mobilePanel.addEventListener('click', (event) => {
            const link = event.target.closest('a');
            const item = event.target.closest('.nav-item.has-submenu');

            if (link && item && item.querySelector('.submenu') && link.parentElement === item && ! item.classList.contains('submenu-open')) {
                event.preventDefault();
                item.classList.add('submenu-open');
                link.setAttribute('aria-expanded', 'true');
                return;
            }

            if (link) {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setOpen(false);
            }
        });

        document.addEventListener('click', (event) => {
            if (! document.body.classList.contains('public-nav-open')) {
                return;
            }

            if (! event.target.closest('.site-header') && ! event.target.closest('.mobile-menu-panel')) {
                setOpen(false);
            }
        });
    })();
</script>
