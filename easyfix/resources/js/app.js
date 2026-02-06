import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const themeStorageKey = 'theme';

function getPreferredTheme() {
    const stored = localStorage.getItem(themeStorageKey);
    if (stored === 'dark' || stored === 'light') {
        return stored;
    }
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

function applyTheme(theme) {
    const root = document.documentElement;
    if (theme === 'dark') {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
    updateThemeIcons(theme);
}

function updateThemeIcons(theme) {
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        const sun = button.querySelector('[data-theme-icon="sun"]');
        const moon = button.querySelector('[data-theme-icon="moon"]');
        if (sun && moon) {
            if (theme === 'dark') {
                sun.classList.remove('hidden');
                moon.classList.add('hidden');
            } else {
                sun.classList.add('hidden');
                moon.classList.remove('hidden');
            }
        }
        button.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
    });
}

function initTheme() {
    const theme = getPreferredTheme();
    applyTheme(theme);
    localStorage.setItem(themeStorageKey, theme);
}

function toggleTheme() {
    const current = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
    const next = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem(themeStorageKey, next);
    applyTheme(next);
}

function setupThemeToggle() {
    document.addEventListener('click', (event) => {
        const toggle = event.target.closest('[data-theme-toggle]');
        if (!toggle) return;
        event.preventDefault();
        toggleTheme();
    });
}

function setupMobileNav() {
    const navToggle = document.querySelector('[data-nav-toggle]');
    const navPanel = document.querySelector('[data-nav-panel]');
    if (!navToggle || !navPanel) return;

    const openIcon = navToggle.querySelector('[data-menu-icon="open"]');
    const closeIcon = navToggle.querySelector('[data-menu-icon="close"]');

    const updateMenuIcons = (isOpen) => {
        if (openIcon && closeIcon) {
            if (isOpen) {
                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        }
    };

    const closeMenu = () => {
        navPanel.classList.add('hidden');
        navToggle.setAttribute('aria-expanded', 'false');
        updateMenuIcons(false);
    };

    const openMenu = () => {
        navPanel.classList.remove('hidden');
        navToggle.setAttribute('aria-expanded', 'true');
        updateMenuIcons(true);
    };

    navToggle.addEventListener('click', (event) => {
        event.preventDefault();
        if (navPanel.classList.contains('hidden')) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    document.addEventListener('click', (event) => {
        if (navPanel.classList.contains('hidden')) return;
        if (navPanel.contains(event.target) || navToggle.contains(event.target)) return;
        closeMenu();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });

    navPanel.querySelectorAll('[data-nav-link]').forEach((link) => {
        link.addEventListener('click', () => closeMenu());
    });
}

function setupUserMenu() {
    const getMenu = (id) => document.querySelector(`[data-user-menu="${id}"]`);

    const closeMenu = (toggle, menu) => {
        menu.classList.add('hidden');
        toggle.setAttribute('aria-expanded', 'false');
    };

    const openMenu = (toggle, menu) => {
        menu.classList.remove('hidden');
        toggle.setAttribute('aria-expanded', 'true');
    };

    document.addEventListener('click', (event) => {
        const toggle = event.target.closest('[data-user-menu-toggle]');
        if (toggle) {
            event.preventDefault();
            const id = toggle.getAttribute('data-user-menu-toggle');
            const menu = getMenu(id);
            if (!menu) return;
            if (menu.classList.contains('hidden')) {
                openMenu(toggle, menu);
            } else {
                closeMenu(toggle, menu);
            }
            return;
        }

        document.querySelectorAll('[data-user-menu-toggle]').forEach((activeToggle) => {
            const id = activeToggle.getAttribute('data-user-menu-toggle');
            const menu = getMenu(id);
            if (!menu || menu.classList.contains('hidden')) return;
            if (menu.contains(event.target) || activeToggle.contains(event.target)) return;
            closeMenu(activeToggle, menu);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        document.querySelectorAll('[data-user-menu-toggle]').forEach((activeToggle) => {
            const id = activeToggle.getAttribute('data-user-menu-toggle');
            const menu = getMenu(id);
            if (!menu) return;
            closeMenu(activeToggle, menu);
        });
    });

    document.querySelectorAll('[data-user-menu]').forEach((menu) => {
        menu.querySelectorAll('a, button').forEach((item) => {
            item.addEventListener('click', () => {
                const id = menu.getAttribute('data-user-menu');
                const toggle = document.querySelector(`[data-user-menu-toggle="${id}"]`);
                if (toggle) closeMenu(toggle, menu);
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    setupThemeToggle();
    setupMobileNav();
    setupUserMenu();
});
