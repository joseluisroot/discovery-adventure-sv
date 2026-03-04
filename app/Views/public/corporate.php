<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?php
$phone = '50369296224';

function wa_corp_link(string $phone, string $locale, string $serviceName): string {
    $text = $locale === 'en'
        ? "Hello! I’m interested in corporate transportation with Discovery Adventure SV.\nService: {$serviceName}\nDate & time: __\nPickup location: __\nDrop-off location: __\nPassengers: __\nCompany / Contact name: __\nNotes: __"
        : "Hola! Estoy interesado en transporte corporativo con Discovery Adventure SV.\nServicio: {$serviceName}\nFecha y hora: __\nPunto de salida: __\nDestino: __\nPasajeros: __\nEmpresa / Contacto: __\nNotas: __";

    return 'https://wa.me/' . $phone . '?text=' . urlencode($text);
}

$t = [
    'badge' => $locale === 'en' ? 'Corporate' : 'Corporativo',
    'h1' => $locale === 'en'
        ? 'Corporate Transportation You Can Trust'
        : 'Transporte Corporativo en el que Puedes Confiar',
    'sub' => $locale === 'en'
        ? 'Punctual, professional and comfortable rides for executives, teams and events — with personalized services.'
        : 'Traslados puntuales, profesionales y cómodos para ejecutivos, equipos y eventos — con servicio personalizado.',
    'ctaMain' => $locale === 'en' ? 'Request a corporate quote' : 'Solicitar cotización corporativa',
    'ctaContact' => $locale === 'en' ? 'Contact via WhatsApp' : 'Contactar por WhatsApp',
    'sectionServices' => $locale === 'en' ? 'Corporate services' : 'Servicios corporativos',
    'sectionServicesSub' => $locale === 'en'
        ? 'Choose the service you need — we’ll confirm availability and provide a clear quote.'
        : 'Elige el servicio que necesitas — confirmamos disponibilidad y enviamos una cotización clara.',
    'whyTitle' => $locale === 'en' ? 'Built for punctuality and service' : 'Diseñado para puntualidad y servicio',
    'whySub' => $locale === 'en'
        ? 'Customer service is our differentiator — we prioritize communication, clarity and reliability.'
        : 'La atención al cliente es nuestro diferencial — priorizamos comunicación, claridad y confiabilidad.',
    'ctaBottom' => $locale === 'en' ? 'Schedule service' : 'Programar servicio',
];

$services = [
    [
        'key' => 'Airport Transfer',
        'title_en' => 'Airport transfers (SAL)',
        'title_es' => 'Traslados al Aeropuerto (SAL)',
        'desc_en'  => 'Pickup and drop-off with clear scheduling and communication.',
        'desc_es'  => 'Recogida y traslado con programación clara y comunicación constante.',
        'img_label'=> 'aeropuerto.png',
    ],
    [
        'key' => 'Executive Rides',
        'title_en' => 'Executive transportation',
        'title_es' => 'Transporte ejecutivo',
        'desc_en'  => 'Professional rides for managers, visitors and VIP guests.',
        'desc_es'  => 'Traslados profesionales para gerencias, visitas y clientes VIP.',
        'img_label'=> 'ejecutivo.png',
    ],
    [
        'key' => 'Corporate Events',
        'title_en' => 'Corporate events & conferences',
        'title_es' => 'Eventos y conferencias',
        'desc_en'  => 'Scheduled group transportation for events, hotels and venues.',
        'desc_es'  => 'Transporte programado para grupos, hoteles y sedes de eventos.',
        'img_label'=> 'conferencia.png',
    ],
    [
        'key' => 'Staff Transport',
        'title_en' => 'Staff / team transportation',
        'title_es' => 'Transporte de personal',
        'desc_en'  => 'Routine or occasional transport for teams with flexible schedules.',
        'desc_es'  => 'Transporte recurrente u ocasional para equipos con horarios flexibles.',
        'img_label'=> 'personal.png',
    ],
    [
        'key' => 'Hotel Partnerships',
        'title_en' => 'Hotel & agency partnerships',
        'title_es' => 'Alianzas con hoteles y agencias',
        'desc_en'  => 'Reliable transport partner for your guests and operations.',
        'desc_es'  => 'Socio confiable de transporte para huéspedes y operación.',
        'img_label'=> 'hotel-recepcion.png',
    ],
    [
        'key' => 'Custom Corporate',
        'title_en' => 'Custom corporate routes',
        'title_es' => 'Rutas corporativas personalizadas',
        'desc_en'  => 'Tell us your needs and we’ll propose an efficient plan.',
        'desc_es'  => 'Cuéntanos tu necesidad y te proponemos un plan eficiente.',
        'img_label'=> 'ejecutivo-mapa.png',
    ],
];
?>

    <!-- HERO -->
    <section class="mx-auto max-w-6xl px-4 pt-10 pb-10">
        <p class="text-sm font-semibold text-emerald-700"><?= esc($t['badge']) ?></p>

        <div class="mt-3 grid gap-6 md:grid-cols-2 md:items-center">
            <div>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">
                    <?= esc($t['h1']) ?>
                </h1>
                <p class="mt-4 text-slate-600 max-w-xl">
                    <?= esc($t['sub']) ?>
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="<?= wa_corp_link($phone, $locale, 'Corporate Quote') ?>"
                       class="inline-flex justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                        <?= esc($t['ctaMain']) ?>
                    </a>
                    <a href="https://wa.me/<?= $phone ?>"
                       class="inline-flex justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold hover:bg-slate-50">
                        <?= esc($t['ctaContact']) ?> · +503 6929 6224
                    </a>
                </div>

                <div class="mt-4 text-xs text-slate-500">
                    <?= $locale === 'en'
                        ? 'Personalized services available · Clear coordination by WhatsApp'
                        : 'Servicio personalizado disponible · Coordinación clara por WhatsApp' ?>
                </div>
            </div>

            <!-- HERO IMAGE PLACEHOLDER -->

                <img src="<?= base_url('images/coorporate/hero.png') ?>"
                     alt="Ruta de las Flores"
                     class="rounded-3xl border border-slate-100 overflow-hidden bg-slate-50 h-[320px] md:h-[360px] w-full object-cover">


        </div>
    </section>

    <!-- SERVICES -->
    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div>
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight"><?= esc($t['sectionServices']) ?></h2>
            <p class="mt-2 text-slate-600 max-w-2xl"><?= esc($t['sectionServicesSub']) ?></p>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <?php foreach ($services as $s): ?>
                <?php
                $title = $locale === 'en' ? $s['title_en'] : $s['title_es'];
                $desc  = $locale === 'en' ? $s['desc_en'] : $s['desc_es'];
                ?>
                <div class="rounded-3xl border border-slate-100 overflow-hidden shadow-sm">
                    <img src="<?= base_url('images/coorporate/' . $s['img_label']) ?>"
                         alt="Coorporate personal El Salvador"
                         class="h-[320px] md:h-[360px] w-full object-cover">

                    <div class="p-6">
                        <h3 class="text-lg font-extrabold tracking-tight"><?= esc($title) ?></h3>
                        <p class="mt-2 text-sm text-slate-600"><?= esc($desc) ?></p>

                        <a href="<?= wa_corp_link($phone, $locale, $title) ?>"
                           class="mt-5 inline-flex w-full justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">
                            <?= $locale === 'en' ? 'Request quote' : 'Solicitar cotización' ?>
                        </a>

                        <div class="mt-3 text-xs text-slate-500">
                            <?= $locale === 'en'
                                ? 'Tip: include date/time and pickup point.'
                                : 'Tip: incluye fecha/hora y punto de salida.' ?>
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
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? 'Punctual scheduling' : 'Programación puntual' ?></div>
                        <div class="mt-1 text-sm text-white/80"><?= $locale === 'en' ? 'We coordinate precisely and confirm details.' : 'Coordinamos con precisión y confirmamos detalles.' ?></div>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? 'Professional communication' : 'Comunicación profesional' ?></div>
                        <div class="mt-1 text-sm text-white/80"><?= $locale === 'en' ? 'Clear instructions, fast replies, profesional support.' : 'Indicaciones claras, respuestas rápidas, soporte profesional.' ?></div>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4">
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? 'Comfort & clean standards' : 'Comodidad y estándares de limpieza' ?></div>
                        <div class="mt-1 text-sm text-white/80"><?= $locale === 'en' ? 'A clean, comfortable vehicle on every service.' : 'Vehículo limpio y cómodo en cada servicio.' ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div class="grid gap-6 md:grid-cols-2 md:items-center">
            <div class="rounded-3xl border border-slate-100 p-7 md:p-10">
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                    <?= $locale === 'en' ? 'Need recurring service for your team?' : '¿Necesitas servicio recurrente para tu equipo?' ?>
                </h2>
                <p class="mt-3 text-slate-600">
                    <?= $locale === 'en'
                        ? 'We can coordinate fixed schedules, multiple pickups and event coverage.'
                        : 'Podemos coordinar horarios fijos, múltiples puntos de salida y cobertura de eventos.' ?>
                </p>

                <div class="mt-6 rounded-2xl bg-slate-50 p-4 text-sm text-slate-700">
                    <div class="font-semibold"><?= $locale === 'en' ? 'Send this info:' : 'Envíanos esta info:' ?></div>
                    <ul class="mt-2 space-y-1 text-slate-600">
                        <li>• <?= $locale === 'en' ? 'Service type (airport, executive, event, staff)' : 'Tipo de servicio (aeropuerto, ejecutivo, evento, personal)' ?></li>
                        <li>• <?= $locale === 'en' ? 'Date & time / frequency' : 'Fecha y hora / frecuencia' ?></li>
                        <li>• <?= $locale === 'en' ? 'Pickup & drop-off points' : 'Puntos de salida y destino' ?></li>
                        <li>• <?= $locale === 'en' ? 'Passengers' : 'Pasajeros' ?></li>
                    </ul>
                </div>

                <a href="<?= wa_corp_link($phone, $locale, 'Corporate Scheduling') ?>"
                   class="mt-6 inline-flex w-full justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                    <?= esc($t['ctaBottom']) ?>
                </a>

                <div class="mt-3 text-xs text-slate-500">
                    <?= $locale === 'en'
                        ? 'Online booking system coming soon.'
                        : 'Pronto lanzaremos reservas online.' ?>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-100 overflow-hidden bg-slate-50">
                <img src="<?= base_url('images/coorporate/personal.png') ?>"
                     alt="Private tours in El Salvador"
                     class="h-[320px] md:h-[360px] w-full object-cover">
            </div>
        </div>
    </section>

<?= $this->endSection() ?>