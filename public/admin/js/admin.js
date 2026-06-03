document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('adminOverlay');
    const toggle = document.getElementById('sidebarToggle');
    const userBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');

    const closeSidebar = () => {
        sidebar?.classList.remove('open');
        overlay?.classList.remove('show');
    };

    toggle?.addEventListener('click', () => {
        sidebar?.classList.toggle('open');
        overlay?.classList.toggle('show');
    });

    overlay?.addEventListener('click', closeSidebar);

    userBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdown?.classList.toggle('show');
    });

    document.addEventListener('click', () => {
        userDropdown?.classList.remove('show');
    });

    document.querySelectorAll('.admin-nav__toggle').forEach((btn) => {
        btn.addEventListener('click', () => {
            btn.closest('.admin-nav__group')?.classList.toggle('open');
        });
    });

    document.querySelectorAll('.admin-alert__close').forEach((btn) => {
        btn.addEventListener('click', () => {
            btn.closest('.admin-alert')?.remove();
        });
    });
});
