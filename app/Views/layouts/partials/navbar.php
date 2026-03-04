<?php
// app/Views/layouts/partials/navbar.php

$request = service('request');
$uri     = $request->getUri();

$path = trim($uri->getPath(), '/');
$segments = $path ? explode('/', $path) : [];

// Locale actual
$currentLocale = (!empty($segments) && in_array($segments[0], ['es','en'], true))
        ? $segments[0]
        : ($locale ?? 'es');

// Ruta sin locale (para switch ES/EN manteniendo la ruta)
if (!empty($segments) && in_array($segments[0], ['es','en'], true)) {
    array_shift($segments);
}
$rest = $segments ? '/' . implode('/', $segments) : '';

// Labels
$labels = [
        'home'      => $currentLocale === 'en' ? 'Home' : 'Inicio',
        'services'  => $currentLocale === 'en' ? 'Services' : 'Servicios',
        'tours'     => $currentLocale === 'en' ? 'Tours' : 'Tours',
        'corporate' => $currentLocale === 'en' ? 'Corporate' : 'Corporativo',
        'fleet'     => $currentLocale === 'en' ? 'Fleet' : 'Flota',
        'reviews'   => $currentLocale === 'en' ? 'Reviews' : 'Reseñas',
        'contact'   => $currentLocale === 'en' ? 'Contact' : 'Contacto',
];

// Links
$nav = [
        ['key' => 'home',      'href' => base_url($currentLocale)],
        ['key' => 'services',  'href' => base_url($currentLocale . '/services')],
        ['key' => 'tours',     'href' => base_url($currentLocale . '/tours')],
        ['key' => 'corporate', 'href' => base_url($currentLocale . '/corporate')],
        ['key' => 'fleet',     'href' => base_url($currentLocale . '/fleet')],
        ['key' => 'reviews',   'href' => base_url($currentLocale . '/reviews')],
        ['key' => 'contact',   'href' => base_url($currentLocale . '/contact')],
];

// Activo (por segmento 2 en rutas /{locale}/xxx)
$pathNoLocale = implode('/', $segments); // '' | 'services' | ...
$activeKey = 'home';
if ($pathNoLocale !== '') {
    $first = explode('/', $pathNoLocale)[0] ?? '';
    if (in_array($first, ['services','tours','corporate','fleet','reviews','contact'], true)) {
        $activeKey = $first;
    }
}

// CTA WhatsApp copy (mejor conversión)
$ctaText = $currentLocale === 'en' ? 'Book Your Tour' : 'Reservar Tour';
?>

<header data-navbar class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-100">
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">

        <!-- Logo / Brand -->
        <a href="<?= base_url($currentLocale) ?>" class="font-bold tracking-tight text-lg flex items-center gap-2">
            <span aria-hidden="true">🧭</span>
            <span>Discovery Adventure SV</span>
        </a>

        <!-- Desktop menu -->
        <nav class="hidden md:flex items-center gap-6 text-sm">
            <?php foreach ($nav as $item): ?>
                <?php
                $isActive = ($item['key'] === $activeKey);
                $cls = $isActive
                        ? 'font-semibold text-slate-900'
                        : 'text-slate-600 hover:text-slate-700';
                ?>
                <a
                        class="<?= $cls ?>"
                        href="<?= $item['href'] ?>"
                        <?= $isActive ? 'aria-current="page"' : '' ?>
                >
                    <?= esc($labels[$item['key']]) ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- Right actions -->
        <div class="flex items-center gap-3">
            <!-- Idiomas -->
            <a class="text-sm text-slate-600 hover:text-slate-900" href="<?= base_url('es' . $rest) ?>">ES</a>
            <a class="text-sm text-slate-600 hover:text-slate-900" href="<?= base_url('en' . $rest) ?>">EN</a>

            <!-- WhatsApp desktop -->
            <a href="https://wa.me/50369296224"
               class="hidden md:inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-900 text-white text-sm hover:bg-slate-800 transition">
                <?= esc($ctaText) ?>
            </a>

            <!-- Hamburger (mobile) -->
            <button
                    data-menu-btn
                    type="button"
                    class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl hover:bg-slate-100 active:scale-95 transition"
                    aria-expanded="false"
                    aria-label="Open menu"
            >
                <!-- Icon: hamburger -->
                <svg data-icon-hamburger xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <!-- Icon: close -->
                <svg data-icon-close xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile dropdown (con animación + panel un poquito más premium) -->
    <div data-menu-panel class="md:hidden hidden border-t border-slate-100 bg-white/95 backdrop-blur transition-all duration-300 ease-in-out">
        <div class="mx-auto max-w-6xl px-4 py-3 flex flex-col gap-1 text-sm">
            <?php foreach ($nav as $item): ?>
                <?php
                $isActive = ($item['key'] === $activeKey);
                $cls = $isActive
                        ? 'bg-slate-100 text-slate-900 font-semibold'
                        : 'text-slate-700 hover:bg-slate-100';
                ?>
                <a
                        class="py-2 px-2 rounded-lg <?= $cls ?>"
                        href="<?= $item['href'] ?>"
                        <?= $isActive ? 'aria-current="page"' : '' ?>
                >
                    <?= esc($labels[$item['key']]) ?>
                </a>
            <?php endforeach; ?>

            <div class="pt-2">
                <a href="https://wa.me/50369296224"
                   class="inline-flex w-full items-center justify-center px-4 py-2 rounded-xl bg-slate-900 text-white text-sm hover:bg-slate-800 transition">
                    <?= esc($ctaText) ?>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    (function () {
        // Soporta múltiples navbars sin choque
        document.querySelectorAll('[data-navbar]').forEach((root) => {
            const btn  = root.querySelector('[data-menu-btn]');
            const menu = root.querySelector('[data-menu-panel]');
            const iconHamburger = root.querySelector('[data-icon-hamburger]');
            const iconClose     = root.querySelector('[data-icon-close]');

            if (!btn || !menu) return;

            function setOpen(isOpen) {
                menu.classList.toggle('hidden', !isOpen);
                if (iconHamburger) iconHamburger.classList.toggle('hidden', isOpen);
                if (iconClose) iconClose.classList.toggle('hidden', !isOpen);
                btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                btn.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
            }

            btn.addEventListener('click', () => {
                const willOpen = menu.classList.contains('hidden');
                setOpen(willOpen);
            });

            // Cerrar al tocar un link
            menu.querySelectorAll('a').forEach(a => {
                a.addEventListener('click', () => setOpen(false));
            });

            // Cerrar con ESC
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') setOpen(false);
            });

            // Cerrar click fuera
            document.addEventListener('click', (e) => {
                if (menu.classList.contains('hidden')) return;
                const clickedInside = menu.contains(e.target) || btn.contains(e.target);
                if (!clickedInside) setOpen(false);
            });
        });
    })();
</script>