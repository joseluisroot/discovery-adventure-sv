<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-6xl px-4 pt-10 pb-8">
        <div class="grid gap-10 md:grid-cols-2 md:items-center">
            <div>
                <p class="text-sm font-semibold text-emerald-700">
                    <?= $locale === 'en' ? 'Private Transportation & Tours' : 'Transporte Privado y Tours' ?>
                </p>

                <h1 class="mt-3 text-3xl md:text-5xl font-extrabold tracking-tight">
                    <?= $locale === 'en'
                        ? 'Discover El Salvador with comfort, safety and exceptional service.'
                        : 'Descubre El Salvador con comodidad, seguridad y atención excepcional.' ?>
                </h1>

                <p class="mt-4 text-slate-600 text-base md:text-lg">
                    <?= $locale === 'en'
                        ? 'Bilingual service for tourists and corporate clients. Clean vehicles, punctual pickups, and personalized attention.'
                        : 'Servicio bilingüe para turistas y clientes corporativos. Vehículos limpios, puntualidad y atención personalizada.' ?>
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="https://wa.me/50369296224"
                       class="inline-flex justify-center rounded-xl bg-slate-900 text-white px-5 py-3 font-semibold hover:bg-slate-800">
                        <?= $locale === 'en' ? 'Book via WhatsApp' : 'Reservar por WhatsApp' ?>
                    </a>
                    <a href="<?= base_url($locale.'/services') ?>"
                       class="inline-flex justify-center rounded-xl border border-slate-200 px-5 py-3 font-semibold hover:bg-slate-50">
                        <?= $locale === 'en' ? 'View services' : 'Ver servicios' ?>
                    </a>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3 text-sm">
                    <div class="rounded-xl border border-slate-100 p-4">
                        <?php
                        $stats = $reviewStats ?? ['count' => 0, 'avg_total' => 0, 'avg_attention' => 0];
                        $avg = (float)($stats['avg_total'] ?? 0);
                        $stars = (int) round($avg);
                        ?>

                        <div class="mt-6 grid grid-cols-2 gap-3 text-sm">
                            <div class="rounded-xl border border-slate-100 p-4">
                                <div class="flex items-center gap-2">
                                    <div class="text-amber-500">
                                        <?php for ($i=1; $i<=5; $i++): ?><span><?= $i <= $stars ? '★' : '☆' ?></span><?php endfor; ?>
                                    </div>
                                    <div class="font-bold"><?= esc($stats['avg_total']) ?>/5</div>
                                </div>
                                <div class="text-slate-600">
                                    <?= $locale === 'en' ? 'Average rating' : 'Calificación promedio' ?>
                                    <?php if ((int)$stats['count'] > 0): ?>
                                        · <?= esc($stats['count']) ?> <?= $locale === 'en' ? 'reviews' : 'reseñas' ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="rounded-xl border border-slate-100 p-4">
                                <div class="font-bold"><?= esc($stats['avg_attention']) ?>/5</div>
                                <div class="text-slate-600">
                                    <?= $locale === 'en' ? 'Customer service' : 'Atención al cliente' ?>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-600"><?= $locale === 'en' ? 'Client satisfaction' : 'Satisfacción' ?></div>
                    </div>
                    <div class="rounded-xl border border-slate-100 p-4">
                        <div class="font-bold"><?= $locale === 'en' ? 'Bilingual' : 'Bilingüe' ?></div>
                        <div class="text-slate-600"><?= $locale === 'en' ? 'English & Spanish' : 'Inglés y Español' ?></div>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl overflow-hidden border border-slate-100 shadow-sm">
                <img
                    src="<?= base_url('images/fleet/microbus-hero.jpg') ?>"
                    alt="Discovery Adventure SV microbus"
                    class="w-full h-[320px] md:h-[460px] object-cover"
                    loading="lazy"
                >
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-emerald-700">
                    <?= $locale === 'en' ? 'Reviews' : 'Reseñas' ?>
                </p>
                <h2 class="mt-2 text-2xl md:text-3xl font-extrabold tracking-tight">
                    <?= $locale === 'en' ? 'What clients say' : 'Lo que dicen nuestros clientes' ?>
                </h2>
                <p class="mt-2 text-slate-600 max-w-2xl">
                    <?= $locale === 'en'
                        ? 'Real feedback with extra emphasis on customer service.'
                        : 'Opiniones reales con énfasis especial en la atención al cliente.' ?>
                </p>
            </div>

            <a href="<?= base_url($locale.'/reviews') ?>"
               class="hidden md:inline-flex rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                <?= $locale === 'en' ? 'View all' : 'Ver todas' ?>
            </a>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <?php if (empty($featuredReviews)): ?>
                <div class="md:col-span-3 rounded-3xl border border-slate-100 p-8 text-slate-600">
                    <?= $locale === 'en' ? 'No published reviews yet.' : 'Aún no hay reseñas publicadas.' ?>
                </div>
            <?php else: ?>
                <?php foreach ($featuredReviews as $r): ?>
                    <?php
                    $score = (float)($r['score_total'] ?? 0);
                    $s = (int) round($score);
                    ?>
                    <div class="rounded-3xl border border-slate-100 p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-3">
                            <div class="text-amber-500">
                                <?php for ($i=1; $i<=5; $i++): ?><span><?= $i <= $s ? '★' : '☆' ?></span><?php endfor; ?>
                            </div>
                            <div class="text-xs rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 font-semibold">
                                <?= $locale === 'en' ? 'Service' : 'Atención' ?>: <?= esc($r['rating_attention']) ?>/5
                            </div>
                        </div>

                        <div class="mt-2 text-sm text-slate-600">
                            <span class="font-semibold text-slate-900"><?= esc($score) ?>/5</span>
                            <span class="text-slate-400">·</span>
                            <?= $locale === 'en' ? 'Verified feedback' : 'Opinión verificada' ?>
                        </div>

                        <p class="mt-4 text-slate-700 leading-relaxed">
                            <?php if (!empty($r['comment'])): ?>
                                “<?= esc($r['comment']) ?>”
                            <?php else: ?>
                                <?= $locale === 'en' ? 'Excellent experience.' : 'Excelente experiencia.' ?>
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="mt-6 md:hidden">
            <a href="<?= base_url($locale.'/reviews') ?>"
               class="inline-flex w-full justify-center rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold hover:bg-slate-50">
                <?= $locale === 'en' ? 'View all reviews' : 'Ver todas las reseñas' ?>
            </a>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-10">
        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-100 p-6">
                <h3 class="font-bold"><?= $locale === 'en' ? 'Tourist Routes' : 'Rutas Turísticas' ?></h3>
                <p class="mt-2 text-slate-600 text-sm">
                    <?= $locale === 'en' ? 'Beach, volcano, city and custom tours.' : 'Playa, volcán, ciudad y tours a tu medida.' ?>
                </p>
            </div>
            <div class="rounded-2xl border border-slate-100 p-6">
                <h3 class="font-bold"><?= $locale === 'en' ? 'Corporate Transport' : 'Transporte Corporativo' ?></h3>
                <p class="mt-2 text-slate-600 text-sm">
                    <?= $locale === 'en' ? 'Airport transfers and executive trips.' : 'Traslados aeropuerto y viajes ejecutivos.' ?>
                </p>
            </div>
            <div class="rounded-2xl border border-slate-100 p-6">
                <h3 class="font-bold"><?= $locale === 'en' ? 'Customer Service' : 'Atención al Cliente' ?></h3>
                <p class="mt-2 text-slate-600 text-sm">
                    <?= $locale === 'en' ? 'Our #1 priority — measured by real feedback.' : 'Nuestra prioridad — medida con reseñas reales.' ?>
                </p>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>