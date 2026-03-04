<?php $locale = service('request')->getLocale(); ?>
<a
    href="<?=
    $locale === 'en'
        ? 'https://wa.me/50369296224?text=' . urlencode('Hello! I would like information about private transportation and tours with Discovery Adventure SV.')
        : 'https://wa.me/50369296224?text=' . urlencode('Hola, deseo información sobre transporte turístico y corporativo con Discovery Adventure SV.')
    ?>"
    class="fixed bottom-4 right-4 z-50 inline-flex items-center gap-2 rounded-full bg-emerald-600 text-white px-4 py-3 shadow-lg hover:bg-emerald-500"
    aria-label="WhatsApp"
>
    <span class="font-semibold">WhatsApp</span>
</a>