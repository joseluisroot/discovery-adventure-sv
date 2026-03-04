<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Services</h1>
    </div>

<?php if (session('success')): ?>
    <div class="mt-4 rounded-lg bg-green-50 p-3 text-green-800"><?= esc(session('success')) ?></div>
<?php endif; ?>

<?php if (session('error')): ?>
    <div class="mt-4 rounded-lg bg-red-50 p-3 text-red-800"><?= esc(session('error')) ?></div>
<?php endif; ?>

    <form class="mt-4 flex flex-col gap-2 md:flex-row" method="get">
        <input class="w-full rounded-lg border p-2" name="q"
               placeholder="Buscar por customer, teléfono, origen, destino o estado…"
               value="<?= esc($q) ?>">
        <button class="rounded-lg bg-slate-100 px-4 py-2">Buscar</button>
    </form>

    <div class="mt-4 overflow-x-auto rounded-xl border">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left">
            <tr>
                <th class="p-3">#</th>
                <th class="p-3">Customer</th>
                <th class="p-3">Tipo</th>
                <th class="p-3">Ruta</th>
                <th class="p-3">Fecha/Hora</th>
                <th class="p-3">Pax</th>
                <th class="p-3">Estado</th>
                <th class="p-3 text-right">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($services)): ?>
                <tr><td class="p-4 text-slate-500" colspan="8">Sin registros.</td></tr>
            <?php endif; ?>

            <?php foreach ($services as $s): ?>
                <tr class="border-t">
                    <td class="p-3"><?= esc($s['id']) ?></td>
                    <td class="p-3">
                        <div class="font-medium"><?= esc($s['customer_name'] ?? '—') ?></div>
                        <div class="text-xs text-slate-500"><?= esc($s['customer_phone'] ?? '') ?></div>
                    </td>
                    <td class="p-3"><?= esc($s['service_type']) ?></td>
                    <td class="p-3">
                        <div><?= esc($s['origin']) ?></div>
                        <div class="text-xs text-slate-500">→ <?= esc($s['destination']) ?></div>
                    </td>
                    <td class="p-3">
                        <?= esc($s['service_date']) ?> <?= esc($s['service_time']) ?>
                    </td>
                    <td class="p-3"><?= esc($s['passengers']) ?></td>
                    <td class="p-3"><?= esc($s['status']) ?></td>
                    <td class="p-3 text-right">
                        <a class="rounded-lg bg-slate-900 px-3 py-1 text-white"
                           href="/<?= esc($locale) ?>/admin/services/<?= esc($s['id']) ?>/edit">Editar</a>

                        <form class="inline" method="post"
                              action="/<?= esc($locale) ?>/admin/services/<?= esc($s['id']) ?>/delete"
                              onsubmit="return confirm('¿Eliminar este servicio?');">
                            <?= csrf_field() ?>
                            <button class="ml-2 rounded-lg bg-red-600 px-3 py-1 text-white">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?= $pager->links() ?>
    </div>

<?= $this->endSection() ?>