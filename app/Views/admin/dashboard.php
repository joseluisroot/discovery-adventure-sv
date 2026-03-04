<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

    <h1 class="text-2xl font-extrabold tracking-tight">Dashboard</h1>
    <p class="mt-1 text-slate-600 text-sm">Métricas de calidad del servicio (enfoque: Atención al Cliente).</p>

    <div class="mt-6 grid gap-4 md:grid-cols-4">
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Reseñas totales</div>
            <div class="mt-2 text-3xl font-extrabold"><?= esc($metrics['reviews_total']) ?></div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Publicadas</div>
            <div class="mt-2 text-3xl font-extrabold"><?= esc($metrics['reviews_published']) ?></div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Score promedio (0–5)</div>
            <div class="mt-2 text-3xl font-extrabold"><?= esc($metrics['avg_total']) ?></div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Atención promedio (1–5)</div>
            <div class="mt-2 text-3xl font-extrabold"><?= esc($metrics['avg_attention']) ?></div>
        </div>
    </div>

    <div class="mt-4 grid gap-4 md:grid-cols-3">
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Puntualidad promedio</div>
            <div class="mt-2 text-2xl font-extrabold"><?= esc($metrics['avg_punctuality']) ?></div>
        </div>
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Limpieza promedio</div>
            <div class="mt-2 text-2xl font-extrabold"><?= esc($metrics['avg_cleanliness']) ?></div>
        </div>
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Comodidad promedio</div>
            <div class="mt-2 text-2xl font-extrabold"><?= esc($metrics['avg_comfort']) ?></div>
        </div>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-sm font-semibold">Calidad (últimas reseñas)</div>
            <div class="mt-3 flex gap-3 text-sm">
      <span class="rounded-full bg-emerald-50 border border-emerald-200 px-3 py-1 text-emerald-900">
        Top (≥ 4.2): <?= esc($metrics['top_pct']) ?>%
      </span>
                <span class="rounded-full bg-red-50 border border-red-200 px-3 py-1 text-red-900">
        Bajas (&lt; 3.5): <?= esc($metrics['low_pct']) ?>%
      </span>
            </div>
            <p class="mt-3 text-sm text-slate-600">
                Enfócate en mantener Atención al Cliente arriba. Si baja, es señal para ajustar comunicación y experiencia.
            </p>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-sm font-semibold">Acciones recomendadas</div>
            <p class="mt-2 text-sm text-slate-600">
                Reseñas bajas recientes (ideal: contactar, entender el problema, corregir).
            </p>

            <?php if (empty($needsFollowUp)): ?>
                <div class="mt-3 text-sm text-slate-500">Sin reseñas bajas recientes. ✅</div>
            <?php else: ?>
                <div class="mt-3 space-y-3">
                    <?php foreach ($needsFollowUp as $r): ?>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 p-3">
                            <div class="text-sm font-semibold">
                                Score: <?= esc($r['score_total']) ?> · Atención: <?= esc($r['rating_attention']) ?>
                            </div>
                            <?php if (!empty($r['comment'])): ?>
                                <div class="mt-1 text-sm text-slate-600"><?= esc($r['comment']) ?></div>
                            <?php endif; ?>
                            <div class="mt-2 text-xs text-slate-500">ID: <?= esc($r['id']) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?= $this->endSection() ?>