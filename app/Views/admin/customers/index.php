<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Customers</h1>
        <a href="/<?= esc($locale) ?>/admin/customers/new"
           class="rounded-lg bg-slate-900 px-4 py-2 text-white">
            + Nuevo
        </a>
    </div>

<?php if (session('success')): ?>
    <div class="mt-4 rounded-lg bg-green-50 p-3 text-green-800">
        <?= esc(session('success')) ?>
    </div>
<?php endif; ?>

<?php if (session('error')): ?>
    <div class="mt-4 rounded-lg bg-red-50 p-3 text-red-800">
        <?= esc(session('error')) ?>
    </div>
<?php endif; ?>

    <form class="mt-4 flex flex-col gap-2 md:flex-row" method="get">
        <input class="w-full rounded-lg border p-2"
               name="q"
               placeholder="Buscar por nombre, correo o teléfono…"
               value="<?= esc($q) ?>">
        <button class="rounded-lg bg-slate-100 px-4 py-2">Buscar</button>
    </form>

    <div class="mt-4 overflow-x-auto rounded-xl border">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left">
            <tr>
                <th class="p-3">#</th>
                <th class="p-3">Nombre</th>
                <th class="p-3">Teléfono</th>
                <th class="p-3">Correo</th>
                <th class="p-3">Idioma</th>
                <th class="p-3">Creado</th>
                <th class="p-3 text-right">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($customers)): ?>
                <tr><td class="p-4 text-slate-500" colspan="7">Sin registros.</td></tr>
            <?php endif; ?>

            <?php foreach ($customers as $c): ?>
                <tr class="border-t">
                    <td class="p-3"><?= esc($c['id']) ?></td>
                    <td class="p-3 font-medium"><?= esc($c['name']) ?></td>
                    <td class="p-3"><?= esc($c['phone'] ?? '') ?></td>
                    <td class="p-3"><?= esc($c['email'] ?? '') ?></td>
                    <td class="p-3"><?= esc($c['language'] ?? 'es') ?></td>
                    <td class="p-3"><?= esc($c['created_at'] ?? '') ?></td>
                    <td class="p-3 text-right">
                        <a class="rounded-lg bg-slate-900 px-3 py-1 text-white"
                           href="/<?= esc($locale) ?>/admin/customers/<?= esc($c['id']) ?>/edit">
                            Editar
                        </a>

                        <form class="inline" method="post"
                              action="/<?= esc($locale) ?>/admin/customers/<?= esc($c['id']) ?>/delete"
                              onsubmit="return confirm('¿Eliminar este customer?');">
                            <?= csrf_field() ?>
                            <button class="ml-2 rounded-lg bg-red-600 px-3 py-1 text-white">
                                Eliminar
                            </button>
                        </form>

                        <a class="rounded-lg bg-blue-600 px-3 py-1 text-white"
                           href="/<?= esc($locale) ?>/admin/customers/<?= esc($c['id']) ?>/services/new">
                            + Servicio
                        </a>
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