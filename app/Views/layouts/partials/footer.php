<?php
$year = date('Y');
$isEn = ($locale === 'en');

$labels = [
    'tagline' => $isEn ? 'Private transportation & tours in El Salvador.' : 'Transporte privado y tours en El Salvador.',
    'services' => $isEn ? 'Services' : 'Servicios',
    'fleet' => $isEn ? 'Fleet' : 'Flota',
    'reviews' => $isEn ? 'Reviews' : 'Reseñas',
    'contact' => $isEn ? 'Contact' : 'Contacto',
    'ctaTitle' => $isEn ? 'Ready to book?' : '¿Listo para reservar?',
    'ctaText' => $isEn ? 'Write us on WhatsApp and we’ll help you plan your trip.' : 'Escríbenos por WhatsApp y te ayudamos a planificar.',
    'whatsapp' => $isEn ? 'WhatsApp' : 'WhatsApp',
    'rights' => $isEn ? 'All rights reserved.' : 'Todos los derechos reservados.',
    'langs' => $isEn ? 'Language' : 'Idioma',
];

$wa = $isEn
    ? 'https://wa.me/50369296224?text=' . urlencode('Hello! I would like information about private transportation and tours with Discovery Adventure SV.')
    : 'https://wa.me/50369296224?text=' . urlencode('Hola, deseo información sobre transporte turístico y corporativo con Discovery Adventure SV.');
?>

<footer class="border-t border-slate-100 bg-white">
    <div class="mx-auto max-w-6xl px-4 py-10">
        <div class="grid gap-10 md:grid-cols-3">
            <div>
                <div class="text-lg font-extrabold tracking-tight">Discovery Adventure SV</div>
                <p class="mt-3 text-sm text-slate-600"><?= esc($labels['tagline']) ?></p>

                <div class="mt-4 text-sm text-slate-700">
                    <div class="font-semibold">WhatsApp</div>
                    <a class="text-emerald-700 hover:text-emerald-600 font-semibold"
                       href="<?= $wa ?>">
                        +503 6929 6224
                    </a>
                </div>
            </div>

            <div>
                <div class="text-sm font-bold text-slate-900"><?= esc($labels['services']) ?></div>
                <ul class="mt-3 space-y-2 text-sm text-slate-600">
                    <li><a class="hover:text-slate-800" href="<?= base_url($locale.'/services') ?>"><?= $isEn ? 'Tourist transportation' : 'Transporte turístico' ?></a></li>
                    <li><a class="hover:text-slate-800" href="<?= base_url($locale.'/corporate') ?>"><?= $isEn ? 'Corporate transport' : 'Transporte corporativo' ?></a></li>
                    <li><a class="hover:text-slate-800" href="<?= base_url($locale.'/fleet') ?>"><?= esc($labels['fleet']) ?></a></li>
                    <li><a class="hover:text-slate-800" href="<?= base_url($locale.'/reviews') ?>"><?= esc($labels['reviews']) ?></a></li>
                </ul>
            </div>

            <div class="rounded-2xl border border-slate-100 p-6">
                <div class="text-sm font-bold"><?= esc($labels['ctaTitle']) ?></div>
                <p class="mt-2 text-sm text-slate-600"><?= esc($labels['ctaText']) ?></p>

                <div class="mt-4">
                    <a href="<?= $wa ?>"
                       class="inline-flex w-full justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                        <?= esc($labels['whatsapp']) ?>
                    </a>
                </div>

                <div class="mt-4 text-xs text-slate-500">
                    <?= esc($labels['langs']) ?>:
                    <a class="underline hover:text-slate-700" href="<?= base_url('es') ?>">ES</a>
                    ·
                    <a class="underline hover:text-slate-700" href="<?= base_url('en') ?>">EN</a>
                </div>
            </div>
        </div>

        <div class="mt-10 flex flex-col gap-2 border-t border-slate-100 pt-6 text-xs text-slate-500 md:flex-row md:items-center md:justify-between">
            <div>© <?= $year ?> Discovery Adventure SV. <?= esc($labels['rights']) ?></div>
            <div class="flex gap-4">
                <a class="hover:text-slate-700" href="<?= base_url($locale.'/contact') ?>"><?= esc($labels['contact']) ?></a>
                <span class="text-slate-300">|</span>
                <a class="hover:text-slate-700" href="<?= base_url($locale.'/privacy') ?>"><?= $isEn ? 'Privacy' : 'Privacidad' ?></a>
                <a class="hover:text-slate-700" href="<?= base_url($locale. '/terms') ?>"><?= $isEn ? 'Terms' : 'Términos' ?></a>
            </div>
        </div>
    </div>
</footer>