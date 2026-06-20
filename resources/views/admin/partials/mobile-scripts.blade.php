<script>
    (() => {
        const layout = document.querySelector('.admin-layout');
        const sidebar = layout?.querySelector('.sidebar');

        if (! layout || ! sidebar || document.querySelector('.admin-mobile-toggle')) {
            return;
        }

        const toggle = document.createElement('button');
        toggle.className = 'admin-mobile-toggle';
        toggle.type = 'button';
        toggle.setAttribute('aria-controls', 'admin-mobile-sidebar');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.innerHTML = '<span>Admin Menu</span><span aria-hidden="true">☰</span>';

        sidebar.id = sidebar.id || 'admin-mobile-sidebar';
        layout.parentNode.insertBefore(toggle, layout);

        function setOpen(isOpen) {
            document.body.classList.toggle('admin-nav-open', isOpen);
            toggle.setAttribute('aria-expanded', String(isOpen));
            toggle.querySelector('span:last-child').textContent = isOpen ? '×' : '☰';
        }

        toggle.addEventListener('click', () => {
            setOpen(! document.body.classList.contains('admin-nav-open'));
        });

        sidebar.addEventListener('click', (event) => {
            if (event.target.closest('a')) {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setOpen(false);
            }
        });

        document.addEventListener('click', (event) => {
            if (! document.body.classList.contains('admin-nav-open')) {
                return;
            }

            if (! event.target.closest('.sidebar') && ! event.target.closest('.admin-mobile-toggle')) {
                setOpen(false);
            }
        });
    })();
</script>
