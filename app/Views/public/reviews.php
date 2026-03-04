<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

<?php
$phone = '50369296224';

$t = [
        'badge' => $locale === 'en' ? 'Reviews' : 'Reseñas',
        'h1' => $locale === 'en'
                ? 'Real Experiences. Real Trust.'
                : 'Experiencias Reales. Confianza Real.',
        'sub' => $locale === 'en'
                ? 'We focus on customer service — and our clients feel it. Here are reviews from people who already traveled with us.'
                : 'Nos enfocamos en la atención al cliente — y nuestros clientes lo sienten. Aquí tienes reseñas de personas que ya viajaron con nosotros.',
        'cta' => $locale === 'en' ? 'Book via WhatsApp' : 'Reservar por WhatsApp',
        'kpiTitle' => $locale === 'en' ? 'Service quality summary' : 'Resumen de calidad del servicio',
        'kpiSub' => $locale === 'en'
                ? 'These metrics are calculated from published reviews.'
                : 'Estas métricas se calculan a partir de reseñas publicadas.',
        'noReviews' => $locale === 'en'
                ? 'No published reviews yet. Soon you will see real client experiences here.'
                : 'Aún no hay reseñas publicadas. Pronto verás aquí experiencias reales de clientes.',
        'labelAttention' => $locale === 'en' ? 'Customer service (attention)' : 'Atención al cliente',
        'labelScore' => $locale === 'en' ? 'Weighted score' : 'Score ponderado',
        'labelTop' => $locale === 'en' ? 'Top reviews' : 'Reseñas destacadas',
];

$waText = $locale === 'en'
        ? "Hello! I’m interested in booking a private tour / transportation with Discovery Adventure SV.\nDate: __\nPassengers: __\nPickup location: __\nDestination/Route: __"
        : "Hola! Estoy interesado en reservar un tour / transporte con Discovery Adventure SV.\nFecha: __\nPasajeros: __\nPunto de salida: __\nDestino/Ruta: __";

$waUrl = 'https://wa.me/'.$phone.'?text='.urlencode($waText);

function stars(float $value): string {
    // value 0-5; returns a simple star string like ★★★★☆
    $full = (int) floor($value);
    $empty = 5 - $full;
    return str_repeat('★', max(0,$full)) . str_repeat('☆', max(0,$empty));
}
?>

    <section class="mx-auto max-w-6xl px-4 pt-10 pb-10">
        <p class="text-sm font-semibold text-emerald-700"><?= esc($t['badge']) ?></p>

        <div class="mt-3 grid gap-6 md:grid-cols-2 md:items-center">
            <div>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight"><?= esc($t['h1']) ?></h1>
                <p class="mt-4 text-slate-600 max-w-xl"><?= esc($t['sub']) ?></p>

                <div class="mt-6">
                    <a href="<?= esc($waUrl) ?>"
                       class="inline-flex justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                        <?= esc($t['cta']) ?>
                    </a>
                </div>

                <div class="mt-4 text-xs text-slate-500">
                    <?= $locale === 'en'
                            ? 'Fast booking · Bilingual support available'
                            : 'Reserva rápida · Servicio bilingüe disponible' ?>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <div class="text-sm font-semibold"><?= esc($t['kpiTitle']) ?></div>
                <div class="mt-1 text-sm text-slate-600"><?= esc($t['kpiSub']) ?></div>

                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="text-xs text-slate-500"><?= esc($t['labelScore']) ?></div>
                        <div class="mt-2 text-2xl font-extrabold"><?= esc($metrics['avg_total']) ?>/5</div>
                        <div class="mt-1 text-sm text-slate-600"><?= esc(stars((float)$metrics['avg_total'])) ?></div>
                    </div>

                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="text-xs text-slate-500"><?= esc($t['labelAttention']) ?></div>
                        <div class="mt-2 text-2xl font-extrabold"><?= esc($metrics['avg_attention']) ?>/5</div>
                        <div class="mt-1 text-sm text-slate-600"><?= esc(stars((float)$metrics['avg_attention'])) ?></div>
                    </div>

                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="text-xs text-slate-500"><?= $locale === 'en' ? 'Published reviews' : 'Reseñas publicadas' ?></div>
                        <div class="mt-2 text-2xl font-extrabold"><?= esc($metrics['count']) ?></div>
                        <div class="mt-1 text-sm text-slate-600"><?= $locale === 'en' ? 'Total used in metrics' : 'Total usado en métricas' ?></div>
                    </div>

                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="text-xs text-slate-500"><?= esc($t['labelTop']) ?> (≥ 4.2)</div>
                        <div class="mt-2 text-2xl font-extrabold"><?= esc($metrics['pct_top']) ?>%</div>
                        <div class="mt-1 text-sm text-slate-600"><?= $locale === 'en' ? 'Of published reviews' : 'De reseñas publicadas' ?></div>
                    </div>
                </div>

                <div class="mt-4 grid gap-2 text-sm text-slate-600">
                    <div class="flex items-center justify-between">
                        <span><?= $locale === 'en' ? 'Punctuality' : 'Puntualidad' ?></span>
                        <span class="font-semibold"><?= esc($metrics['avg_punctuality']) ?>/5</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span><?= $locale === 'en' ? 'Cleanliness' : 'Limpieza' ?></span>
                        <span class="font-semibold"><?= esc($metrics['avg_cleanliness']) ?>/5</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span><?= $locale === 'en' ? 'Comfort' : 'Comodidad' ?></span>
                        <span class="font-semibold"><?= esc($metrics['avg_comfort']) ?>/5</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight"><?= $locale === 'en' ? 'Published reviews' : 'Reseñas publicadas' ?></h2>
                <p class="mt-2 text-slate-600">
                    <?= $locale === 'en'
                            ? 'We publish reviews to help new clients feel confident when booking.'
                            : 'Publicamos reseñas para que nuevos clientes reserven con confianza.' ?>
                </p>
            </div>
        </div>

        <?php if (empty($reviews)): ?>
            <div class="mt-6 rounded-3xl border border-slate-100 bg-white p-8 text-center text-slate-600">
                <?= esc($t['noReviews']) ?>
            </div>
        <?php else: ?>
            <div class="mt-6 grid gap-4 md:grid-cols-2">
                <?php foreach ($reviews as $r): ?>
                    <?php
                    $score = (float)($r['score_total'] ?? 0);
                    $badge = $score >= 4.2 ? 'bg-emerald-50 border-emerald-200 text-emerald-900'
                            : 'bg-slate-50 border-slate-200 text-slate-900';
                    $comment = trim((string)($r['comment'] ?? ''));
                    ?>
                    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-sm font-semibold">
                                    <?= $locale === 'en' ? 'Service review' : 'Reseña del servicio' ?>
                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    <?= $locale === 'en' ? 'Language:' : 'Idioma:' ?> <?= esc($r['language'] ?? $locale) ?>
                                    · ID: <?= esc($r['id']) ?>
                                </div>
                            </div>

                            <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold <?= $badge ?>">
              <?= $locale === 'en' ? 'Score' : 'Score' ?>: <?= esc($score) ?>/5
            </span>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
                            <div class="rounded-xl bg-slate-50 p-3">
                                <div class="text-xs text-slate-500"><?= $locale === 'en' ? 'Attention' : 'Atención' ?></div>
                                <div class="mt-1 font-semibold"><?= esc($r['rating_attention'] ?? '-') ?>/5</div>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3">
                                <div class="text-xs text-slate-500"><?= $locale === 'en' ? 'Punctuality' : 'Puntualidad' ?></div>
                                <div class="mt-1 font-semibold"><?= esc($r['rating_punctuality'] ?? '-') ?>/5</div>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3">
                                <div class="text-xs text-slate-500"><?= $locale === 'en' ? 'Cleanliness' : 'Limpieza' ?></div>
                                <div class="mt-1 font-semibold"><?= esc($r['rating_cleanliness'] ?? '-') ?>/5</div>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3">
                                <div class="text-xs text-slate-500"><?= $locale === 'en' ? 'Comfort' : 'Comodidad' ?></div>
                                <div class="mt-1 font-semibold"><?= esc($r['rating_comfort'] ?? '-') ?>/5</div>
                            </div>
                        </div>

                        <?php if ($comment !== ''): ?>
                            <div class="mt-4 rounded-2xl bg-white border border-slate-100 p-4">
                                <div class="text-xs text-slate-500"><?= $locale === 'en' ? 'Comment' : 'Comentario' ?></div>
                                <div class="mt-2 text-sm text-slate-700"><?= esc($comment) ?></div>
                            </div>
                        <?php endif; ?>

                        <div class="mt-5 flex justify-between items-center text-xs text-slate-500">
                            <span><?= $locale === 'en' ? 'Thank you for trusting us.' : 'Gracias por confiar en nosotros.' ?></span>
                            <a class="underline" href="<?= esc($waUrl) ?>">
                                <?= $locale === 'en' ? 'Book' : 'Reservar' ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

<?= $this->endSection() ?>