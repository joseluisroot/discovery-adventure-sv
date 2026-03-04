<?php
$seg1 = service('request')->getUri()->getSegment(1); // es|en
$path = service('request')->getUri()->getPath();     // es/xxxx
$rest = preg_replace('#^(es|en)#', '', $path);
$toEs = '/es' . $rest;
$toEn = '/en' . $rest;

$labels = [
    'home' => $locale === 'en' ? 'Home' : 'Inicio',
    'services' => $locale === 'en' ? 'Services' : 'Servicios',
    'tours' => $locale === 'en' ? 'Tours' : 'Tours',
    'corporate' => $locale === 'en' ? 'Corporate' : 'Corporativo',
    'fleet' => $locale === 'en' ? 'Fleet' : 'Flota',
    'reviews' => $locale === 'en' ? 'Reviews' : 'Reseñas',
    'contact' => $locale === 'en' ? 'Contact' : 'Contacto',
];
?>
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-100">
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">
        <a href="<?= base_url($locale) ?>" class="font-bold tracking-tight text-lg">
            Discovery Adventure SV
        </a>

        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a class="hover:text-slate-700" href="<?= base_url($locale) ?>"><?= esc($labels['home']) ?></a>
            <a class="hover:text-slate-700" href="<?= base_url($locale.'/services') ?>"><?= esc($labels['services']) ?></a>
            <a class="hover:text-slate-700" href="<?= base_url($locale.'/tours') ?>"><?= esc($labels['tours']) ?></a>
            <a class="hover:text-slate-700" href="<?= base_url($locale.'/corporate') ?>"><?= esc($labels['corporate']) ?></a>
            <a class="hover:text-slate-700" href="<?= base_url($locale.'/fleet') ?>"><?= esc($labels['fleet']) ?></a>
            <a class="hover:text-slate-700" href="<?= base_url($locale.'/reviews') ?>"><?= esc($labels['reviews']) ?></a>
            <a class="hover:text-slate-700" href="<?= base_url($locale.'/contact') ?>"><?= esc($labels['contact']) ?></a>
        </nav>

        <div class="flex items-center gap-3">
            <?php
            $path = trim(service('request')->getUri()->getPath(), '/');
            $segments = $path ? explode('/', $path) : [];
            if (!empty($segments) && in_array($segments[0], ['es','en'], true)) array_shift($segments);
            $rest = $segments ? '/' . implode('/', $segments) : '';
            ?>
            <a href="<?= base_url('es' . $rest) ?>">ES</a>
            <a href="<?= base_url('en' . $rest) ?>">EN</a>

            <a href="https://wa.me/50369296224"
               class="hidden md:inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-900 text-white text-sm hover:bg-slate-800">
                WhatsApp
            </a>
        </div>
    </div>
</header>