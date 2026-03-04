<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

    <h1 class="text-2xl font-extrabold tracking-tight">Dashboard</h1>
    <p class="mt-1 text-slate-600 text-sm">Métricas de calidad del servicio (enfoque: Atención al Cliente).</p>

    <!-- =========================
         REVIEWS (tu sección actual)
         ========================= -->
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

    <!-- =========================
         NUEVO: OPERACIÓN (Customers + Services)
         ========================= -->
<?php if (isset($ops)): ?>

    <?php
    // Badge helper por status (pending/confirmed/completed/canceled)
    $statusBadge = function ($status) {
        $status = (string) $status;

        $map = [
                'pending'   => 'bg-amber-50 border-amber-200 text-amber-900',
                'confirmed' => 'bg-blue-50 border-blue-200 text-blue-900',
                'completed' => 'bg-emerald-50 border-emerald-200 text-emerald-900',
                'canceled'  => 'bg-red-50 border-red-200 text-red-900',
        ];
        $cls = $map[$status] ?? 'bg-slate-50 border-slate-200 text-slate-800';

        return '<span class="rounded-full border px-2 py-1 text-xs ' . $cls . '">' . esc($status) . '</span>';
    };
    ?>

    <div class="mt-10 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold tracking-tight">Operación</h2>
            <p class="mt-1 text-sm text-slate-600">Resumen de clientes y servicios programados.</p>
        </div>

        <div class="flex gap-2">
            <a class="text-sm px-3 py-2 rounded-lg hover:bg-slate-50 border border-slate-200 bg-white"
               href="<?= base_url($locale.'/admin/customers') ?>">Customers</a>
            <a class="text-sm px-3 py-2 rounded-lg hover:bg-slate-50 border border-slate-200 bg-white"
               href="<?= base_url($locale.'/admin/services') ?>">Services</a>
        </div>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-4">
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Customers totales</div>
            <div class="mt-2 text-3xl font-extrabold"><?= esc($ops['customers_total'] ?? 0) ?></div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Services totales</div>
            <div class="mt-2 text-3xl font-extrabold"><?= esc($ops['services_total'] ?? 0) ?></div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Servicios hoy</div>
            <div class="mt-2 text-3xl font-extrabold"><?= esc($ops['today_total'] ?? 0) ?></div>
            <div class="mt-1 text-xs text-slate-500"><?= esc($today ?? '') ?></div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Servicios mañana</div>
            <div class="mt-2 text-3xl font-extrabold"><?= esc($ops['tomorrow_total'] ?? 0) ?></div>
            <div class="mt-1 text-xs text-slate-500"><?= esc($tomorrow ?? '') ?></div>
        </div>
    </div>

    <div class="mt-4 grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Pending</div>
            <div class="mt-2 text-2xl font-extrabold"><?= esc($ops['pending_total'] ?? 0) ?></div>
        </div>

        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="text-xs text-slate-500">Confirmed</div>
            <div class="mt-2 text-2xl font-extrabold"><?= esc($ops['confirmed_total'] ?? 0) ?></div>
        </div>
    </div>

    <div class="mt-6 grid gap-4 lg:grid-cols-3">
        <!-- Hoy -->
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold">Servicios hoy</div>
                <a class="text-sm text-slate-600 hover:underline" href="<?= base_url($locale.'/admin/services') ?>">Ver</a>
            </div>

            <div class="mt-3 space-y-3">
                <?php if (empty($todayServices)): ?>
                    <div class="text-sm text-slate-500">No hay servicios para hoy.</div>
                <?php else: ?>
                    <?php foreach ($todayServices as $s): ?>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 p-3">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold">
                                    <?= esc($s['service_time']) ?> · <?= esc($s['service_type']) ?>
                                </div>
                                <?= $statusBadge($s['status'] ?? '') ?>
                            </div>
                            <div class="mt-1 text-sm text-slate-600">
                                <?= esc($s['origin']) ?> → <?= esc($s['destination']) ?>
                            </div>
                            <div class="mt-2 text-xs text-slate-500">
                                <?= esc($s['customer_name'] ?? '—') ?>
                                <?= !empty($s['customer_phone']) ? ' · '.esc($s['customer_phone']) : '' ?>
                                · Pax: <?= esc($s['passengers']) ?>
                            </div>
                            <div class="mt-2">
                                <a class="text-sm font-semibold hover:underline"
                                   href="<?= base_url($locale.'/admin/services/'.$s['id'].'/edit') ?>">Editar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mañana -->
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold">Servicios mañana</div>
                <a class="text-sm text-slate-600 hover:underline" href="<?= base_url($locale.'/admin/services') ?>">Ver</a>
            </div>

            <div class="mt-3 space-y-3">
                <?php if (empty($tomorrowServices)): ?>
                    <div class="text-sm text-slate-500">No hay servicios para mañana.</div>
                <?php else: ?>
                    <?php foreach ($tomorrowServices as $s): ?>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 p-3">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold">
                                    <?= esc($s['service_time']) ?> · <?= esc($s['service_type']) ?>
                                </div>
                                <?= $statusBadge($s['status'] ?? '') ?>
                            </div>
                            <div class="mt-1 text-sm text-slate-600">
                                <?= esc($s['origin']) ?> → <?= esc($s['destination']) ?>
                            </div>
                            <div class="mt-2 text-xs text-slate-500">
                                <?= esc($s['customer_name'] ?? '—') ?>
                                <?= !empty($s['customer_phone']) ? ' · '.esc($s['customer_phone']) : '' ?>
                                · Pax: <?= esc($s['passengers']) ?>
                            </div>
                            <div class="mt-2">
                                <a class="text-sm font-semibold hover:underline"
                                   href="<?= base_url($locale.'/admin/services/'.$s['id'].'/edit') ?>">Editar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pendientes -->
        <div class="rounded-2xl bg-white border border-slate-100 p-5">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold">Pendientes / Próximos</div>
                <a class="text-sm text-slate-600 hover:underline" href="<?= base_url($locale.'/admin/services') ?>">Ver</a>
            </div>

            <div class="mt-3 space-y-3">
                <?php if (empty($pendingServices)): ?>
                    <div class="text-sm text-slate-500">No hay pendientes.</div>
                <?php else: ?>
                    <?php foreach ($pendingServices as $s): ?>
                        <div class="rounded-xl border border-slate-100 bg-slate-50 p-3">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold">
                                    <?= esc($s['service_date']) ?> <?= esc($s['service_time']) ?>
                                </div>
                                <?= $statusBadge($s['status'] ?? '') ?>
                            </div>
                            <div class="mt-1 text-sm text-slate-600">
                                <?= esc($s['origin']) ?> → <?= esc($s['destination']) ?>
                            </div>
                            <div class="mt-2 text-xs text-slate-500">
                                <?= esc($s['customer_name'] ?? '—') ?> · Pax: <?= esc($s['passengers']) ?>
                            </div>
                            <div class="mt-2">
                                <a class="text-sm font-semibold hover:underline"
                                   href="<?= base_url($locale.'/admin/services/'.$s['id'].'/edit') ?>">Editar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>

<?= $this->endSection() ?>