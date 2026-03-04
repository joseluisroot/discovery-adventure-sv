<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-6xl px-4 pt-10 pb-8">
        <p class="text-sm font-semibold text-emerald-700">
            <?= $locale === 'en' ? 'Reviews' : 'Reseñas' ?>
        </p>

        <h1 class="mt-3 text-3xl md:text-4xl font-extrabold tracking-tight">
            <?= $locale === 'en' ? 'Real experiences from our clients' : 'Experiencias reales de nuestros clientes' ?>
        </h1>

        <p class="mt-4 max-w-2xl text-slate-600">
            <?= $locale === 'en'
                    ? 'We measure what matters: customer service, punctuality, cleanliness and comfort.'
                    : 'Medimos lo que importa: atención al cliente, puntualidad, limpieza y comodidad.' ?>
        </p>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-12">
        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-3xl border border-slate-100 p-6">
                <div class="text-sm text-slate-500"><?= $locale === 'en' ? 'Total reviews' : 'Total reseñas' ?></div>
                <div class="mt-2 text-3xl font-extrabold"><?= esc($metrics['count']) ?></div>
            </div>
            <div class="rounded-3xl border border-slate-100 p-6">
                <div class="text-sm text-slate-500"><?= $locale === 'en' ? 'Average score' : 'Promedio general' ?></div>
                <div class="mt-2 text-3xl font-extrabold"><?= esc($metrics['avg_total']) ?><span class="text-base font-semibold text-slate-500">/5</span></div>
            </div>
            <div class="rounded-3xl border border-slate-100 p-6">
                <div class="text-sm text-slate-500"><?= $locale === 'en' ? 'Customer service' : 'Atención al cliente' ?></div>
                <div class="mt-2 text-3xl font-extrabold"><?= esc($metrics['avg_attention']) ?><span class="text-base font-semibold text-slate-500">/5</span></div>
                <div class="mt-2 text-xs text-slate-500">
                    <?= $locale === 'en' ? 'Our #1 priority.' : 'Nuestra prioridad #1.' ?>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <?php if (empty($reviews)): ?>
                <div class="rounded-3xl border border-slate-100 p-8 text-slate-600">
                    <?= $locale === 'en' ? 'No reviews yet.' : 'Aún no hay reseñas publicadas.' ?>
                </div>
            <?php else: ?>
                <div class="grid gap-4 md:grid-cols-2">
                    <?php foreach ($reviews as $r): ?>
                        <?php
                        $score = (float)($r['score_total'] ?? 0);
                        $stars = (int) round($score); // 1..5
                        ?>
                        <div class="rounded-3xl border border-slate-100 p-6 shadow-sm">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-1 text-amber-500">
                                        <?php for ($i=1; $i<=5; $i++): ?>
                                            <span><?= $i <= $stars ? '★' : '☆' ?></span>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="mt-2 text-sm text-slate-600">
                                        <span class="font-semibold text-slate-900"><?= esc($score) ?>/5</span>
                                        <span class="text-slate-400">·</span>
                                        <?= $locale === 'en' ? 'Verified feedback' : 'Opinión verificada' ?>
                                    </div>
                                </div>

                                <div class="text-xs rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 font-semibold">
                                    <?= $locale === 'en' ? 'Customer service' : 'Atención' ?>: <?= esc($r['rating_attention']) ?>/5
                                </div>
                            </div>

                            <?php if (!empty($r['comment'])): ?>
                                <p class="mt-4 text-slate-700 leading-relaxed">
                                    “<?= esc($r['comment']) ?>”
                                </p>
                            <?php else: ?>
                                <p class="mt-4 text-slate-500">
                                    <?= $locale === 'en' ? 'Great experience.' : 'Excelente experiencia.' ?>
                                </p>
                            <?php endif; ?>

                            <div class="mt-5 grid grid-cols-2 gap-2 text-xs text-slate-600">
                                <div class="rounded-xl bg-slate-50 px-3 py-2">
                                    <?= $locale === 'en' ? 'Punctuality' : 'Puntualidad' ?>: <b><?= esc($r['rating_punctuality']) ?>/5</b>
                                </div>
                                <div class="rounded-xl bg-slate-50 px-3 py-2">
                                    <?= $locale === 'en' ? 'Cleanliness' : 'Limpieza' ?>: <b><?= esc($r['rating_cleanliness']) ?>/5</b>
                                </div>
                                <div class="rounded-xl bg-slate-50 px-3 py-2">
                                    <?= $locale === 'en' ? 'Comfort' : 'Comodidad' ?>: <b><?= esc($r['rating_comfort']) ?>/5</b>
                                </div>
                                <div class="rounded-xl bg-slate-50 px-3 py-2">
                                    <?= $locale === 'en' ? 'Overall' : 'General' ?>: <b><?= esc($score) ?>/5</b>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-10 rounded-3xl bg-slate-900 text-white p-7 md:p-10">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-xl md:text-2xl font-extrabold tracking-tight">
                        <?= $locale === 'en' ? 'Want to book your trip?' : '¿Quieres reservar tu viaje?' ?>
                    </h2>
                    <p class="mt-2 text-white/80">
                        <?= $locale === 'en'
                                ? 'Write us on WhatsApp and we’ll confirm route, date and pickup.'
                                : 'Escríbenos por WhatsApp y confirmamos ruta, fecha y punto de salida.' ?>
                    </p>
                </div>
                <a href="https://wa.me/50369296224"
                   class="inline-flex justify-center rounded-xl bg-white text-slate-900 px-5 py-3 text-sm font-semibold hover:bg-slate-100">
                    WhatsApp
                </a>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>