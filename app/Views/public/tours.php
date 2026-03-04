<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?php
$phone = '50369296224';

$t = [
    'badge' => $locale === 'en' ? 'Tours' : 'Tours',
    'h1' => $locale === 'en'
        ? 'Private Tours & Transportation Across El Salvador'
        : 'Tours Privados y Transporte Turístico en El Salvador',
    'sub' => $locale === 'en'
        ? 'Beaches, mountains, volcanoes and iconic places — with comfort, safety and bilingual support.'
        : 'Playas, montañas, volcanes y lugares emblemáticos — con comodidad, seguridad y servicio bilingüe.',
    'ctaMain' => $locale === 'en' ? 'Plan a tour via WhatsApp' : 'Planear tour por WhatsApp',
    'ctaFleet' => $locale === 'en' ? 'See fleet' : 'Ver flota',
    'sectionRoutes' => $locale === 'en' ? 'Featured routes' : 'Rutas destacadas',
    'sectionRoutesSub' => $locale === 'en'
        ? 'Choose a route and we’ll tailor the itinerary to your time and group size.'
        : 'Elige una ruta y adaptamos el itinerario a tu tiempo y tamaño de grupo.',
    'whyTitle' => $locale === 'en' ? 'Why travelers choose us' : 'Por qué nos eligen',
    'whySub' => $locale === 'en'
        ? 'Our #1 priority is customer service — and it shows in our reviews.'
        : 'Nuestra prioridad #1 es la atención al cliente — y se nota en las reseñas.',
    'customTitle' => $locale === 'en' ? 'Custom itinerary' : 'Itinerario personalizado',
    'customSub' => $locale === 'en'
        ? 'Tell us your dates and what you want to experience. We’ll propose the best route.'
        : 'Cuéntanos tus fechas y qué te gustaría vivir. Te proponemos la mejor ruta.',
    'ctaBottom' => $locale === 'en' ? 'Book now' : 'Reservar ahora',
];

$routes = [
    [
        'key' => 'Ruta de las Flores',
        'title_es' => 'Ruta de las Flores',
        'title_en' => 'Ruta de las Flores',
        'desc_es' => 'Pueblos con encanto, café, miradores y gastronomía.',
        'desc_en' => 'Charming towns, coffee, viewpoints and local food.',
        // PLACEHOLDER: Foto de pueblo/calle colonial/café
        'img_label' => 'ruta-las-flores.png',
    ],
    [
        'key' => 'Surf City',
        'title_es' => 'Surf City (Playas)',
        'title_en' => 'Surf City (Beaches)',
        'desc_es' => 'Atardeceres, playa, mar y paradas para fotos.',
        'desc_en' => 'Sunsets, beach time, and photo stops.',
        // PLACEHOLDER: Foto de playa/atardecer/olas
        'img_label' => 'surf-city.png',
    ],
    [
        'key' => 'Lago de Coatepeque',
        'title_es' => 'Lago de Coatepeque',
        'title_en' => 'Coatepeque Lake',
        'desc_es' => 'Vistas increíbles, restaurantes y descanso.',
        'desc_en' => 'Amazing views, restaurants and relaxing time.',
        // PLACEHOLDER: Foto del lago/mirador
        'img_label' => 'lago-coatepeque.png',
    ],
    [
        'key' => 'Centro Histórico',
        'title_es' => 'Centro Histórico (San Salvador)',
        'title_en' => 'Historic Center (San Salvador)',
        'desc_es' => 'Arquitectura, cultura, plazas y spots emblemáticos.',
        'desc_en' => 'Architecture, culture, plazas and iconic spots.',
        // PLACEHOLDER: Catedral/teatro/plaza
        'img_label' => 'centro-historico.png',
    ],
    [
        'key' => 'Volcán de Santa Ana',
        'title_es' => 'Volcán de Santa Ana',
        'title_en' => 'Santa Ana Volcano',
        'desc_es' => 'Aventura de montaña y vistas espectaculares.',
        'desc_en' => 'Mountain adventure with spectacular views.',
        // PLACEHOLDER: volcán/sendero
        'img_label' => 'volcan-santa-ana.png',
    ],
    [
        'key' => 'Tamanique',
        'title_es' => 'Cascadas de Tamanique',
        'title_en' => 'Tamanique Waterfalls',
        'desc_es' => 'Naturaleza, caminata y cascadas.',
        'desc_en' => 'Nature hike and waterfalls.',
        // PLACEHOLDER: cascada/verde
        'img_label' => 'cascadas.png',
    ],
];

function wa_tour_link(string $phone, string $locale, string $routeName): string {
    $text = $locale === 'en'
        ? "Hello! I'd like to book a private tour with Discovery Adventure SV.\nRoute: {$routeName}\nDate: __\nPassengers: __\nPickup location: __\nNotes: __"
        : "Hola! Quiero reservar un tour privado con Discovery Adventure SV.\nRuta: {$routeName}\nFecha: __\nPasajeros: __\nPunto de salida: __\nNotas: __";

    return 'https://wa.me/' . $phone . '?text=' . urlencode($text);
}
?>

    <!-- HERO -->
    <section class="mx-auto max-w-6xl px-4 pt-10 pb-10">
        <p class="text-sm font-semibold text-emerald-700"><?= $t['badge'] ?></p>

        <div class="mt-3 grid gap-6 md:grid-cols-2 md:items-center">
            <div>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">
                    <?= esc($t['h1']) ?>
                </h1>
                <p class="mt-4 text-slate-600 max-w-xl">
                    <?= esc($t['sub']) ?>
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="<?= wa_tour_link($phone, $locale, 'Custom Tour') ?>"
                       class="inline-flex justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                        <?= esc($t['ctaMain']) ?>
                    </a>
                    <a href="<?= base_url($locale.'/fleet') ?>"
                       class="inline-flex justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold hover:bg-slate-50">
                        <?= esc($t['ctaFleet']) ?>
                    </a>
                </div>

                <div class="mt-4 text-xs text-slate-500">
                    <?= $locale === 'en'
                        ? 'Bilingual support available · Fast booking via WhatsApp'
                        : 'Servicio bilingüe disponible · Reserva rápida por WhatsApp' ?>
                </div>
            </div>

            <!-- HERO IMAGE PLACEHOLDER -->
            <div class="rounded-3xl border border-slate-100 overflow-hidden bg-slate-50">
                <img src="<?= base_url('images/tours/hero.png') ?>"
                     alt="Private tours in El Salvador"
                     class="h-[320px] md:h-[360px] w-full object-cover">
            </div>
        </div>
    </section>

    <!-- ROUTES -->
    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight"><?= esc($t['sectionRoutes']) ?></h2>
            <p class="mt-2 text-slate-600 max-w-2xl"><?= esc($t['sectionRoutesSub']) ?></p>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <?php foreach ($routes as $r): ?>
                <?php
                $title = $locale === 'en' ? $r['title_en'] : $r['title_es'];
                $desc  = $locale === 'en' ? $r['desc_en'] : $r['desc_es'];
                ?>
                <div class="rounded-3xl border border-slate-100 overflow-hidden shadow-sm">
                    <!-- IMAGE PLACEHOLDER -->
                    <img src="<?= base_url('images/tours/'. esc($r['img_label'] )) ?>"
                         alt="Private tours in El Salvador"
                         class="h-[320px] md:h-[360px] w-full object-cover">

                    <div class="p-6">
                        <h3 class="text-lg font-extrabold tracking-tight"><?= esc($title) ?></h3>
                        <p class="mt-2 text-sm text-slate-600"><?= esc($desc) ?></p>

                        <div class="mt-5 flex gap-3">
                            <a href="<?= wa_tour_link($phone, $locale, $title) ?>"
                               class="inline-flex w-full justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">
                                <?= $locale === 'en' ? 'Request this route' : 'Solicitar esta ruta' ?>
                            </a>
                        </div>

                        <div class="mt-3 text-xs text-slate-500">
                            <?= $locale === 'en'
                                ? 'Tip: tell us your date and passengers.'
                                : 'Tip: indícanos fecha y pasajeros.' ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- WHY -->
    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div class="rounded-3xl bg-slate-900 text-white p-7 md:p-10">
            <div class="grid gap-8 md:grid-cols-2 md:items-center">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight"><?= esc($t['whyTitle']) ?></h2>
                    <p class="mt-3 text-white/80"><?= esc($t['whySub']) ?></p>
                </div>

                <div class="grid gap-3">
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? 'Bilingual service' : 'Servicio bilingüe' ?></div>
                        <div class="mt-1 text-sm text-white/80"><?= $locale === 'en' ? 'English/Spanish support for a smoother trip.' : 'Soporte en inglés/español para una mejor experiencia.' ?></div>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? 'Comfort & cleanliness' : 'Comodidad y limpieza' ?></div>
                        <div class="mt-1 text-sm text-white/80"><?= $locale === 'en' ? 'Clean vehicle standards on every service.' : 'Estándares de limpieza en cada servicio.' ?></div>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? 'Punctual & reliable' : 'Puntual y confiable' ?></div>
                        <div class="mt-1 text-sm text-white/80"><?= $locale === 'en' ? 'We respect your schedule.' : 'Respetamos tu tiempo y agenda.' ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CUSTOM -->
    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div class="grid gap-6 md:grid-cols-2 md:items-center">
            <div class="rounded-3xl border border-slate-100 p-7 md:p-10">
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight"><?= esc($t['customTitle']) ?></h2>
                <p class="mt-3 text-slate-600"><?= esc($t['customSub']) ?></p>

                <div class="mt-6 grid gap-3 text-sm">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="font-semibold"><?= $locale === 'en' ? '1) Tell us what you want to see' : '1) Dinos qué quieres conocer' ?></div>
                        <div class="mt-1 text-slate-600"><?= $locale === 'en' ? 'Beach, mountains, volcano, city, culture.' : 'Playa, montaña, volcán, ciudad, cultura.' ?></div>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="font-semibold"><?= $locale === 'en' ? '2) We propose the best itinerary' : '2) Te proponemos el mejor itinerario' ?></div>
                        <div class="mt-1 text-slate-600"><?= $locale === 'en' ? 'Optimized for time and comfort.' : 'Optimizado por tiempo y comodidad.' ?></div>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="font-semibold"><?= $locale === 'en' ? '3) Confirm & enjoy' : '3) Confirmas y disfrutas' ?></div>
                        <div class="mt-1 text-slate-600"><?= $locale === 'en' ? 'We take care of the logistics.' : 'Nos encargamos de la logística.' ?></div>
                    </div>
                </div>

                <a href="<?= wa_tour_link($phone, $locale, 'Custom Tour') ?>"
                   class="mt-6 inline-flex w-full justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                    <?= esc($t['ctaBottom']) ?>
                </a>

                <div class="mt-3 text-xs text-slate-500">
                    <?= $locale === 'en'
                        ? 'Online booking system coming soon.'
                        : 'Pronto lanzaremos reservas online.' ?>
                </div>
            </div>

            <!-- IMAGE PLACEHOLDER -->
            <div class="rounded-3xl border border-slate-100 overflow-hidden bg-slate-50">
                <img src="<?= base_url('images/tours/familia.png') ?>"
                     alt="Private tours in El Salvador"
                     class="h-[320px] md:h-[360px] w-full object-cover">
            </div>
        </div>
    </section>

<?= $this->endSection() ?>