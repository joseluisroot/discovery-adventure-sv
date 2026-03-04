<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<?php
$isEdit = ($mode === 'edit');
$action = $isEdit ? "/{$locale}/admin/customers/{$id}" : "/{$locale}/admin/customers";
?>

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold"><?= $isEdit ? 'Editar Customer' : 'Nuevo Customer' ?></h1>
        <a class="rounded-lg bg-slate-100 px-4 py-2" href="/<?= esc($locale) ?>/admin/customers">Volver</a>
    </div>

<?php if (!empty($errors)): ?>
    <div class="mt-4 rounded-lg bg-red-50 p-3 text-red-800">
        <div class="font-semibold">Revisa los campos:</div>
        <ul class="list-disc pl-5">
            <?php foreach ($errors as $e): ?>
                <li><?= esc($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form class="mt-4 grid gap-4 rounded-xl border p-4" method="post" action="<?= esc($action) ?>">
        <?= csrf_field() ?>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold">Nombre *</label>
                <input class="mt-1 w-full rounded-lg border p-2" name="name"
                       value="<?= esc(old('name', $data['name'] ?? '')) ?>" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Teléfono</label>
                <input class="mt-1 w-full rounded-lg border p-2" name="phone"
                       value="<?= esc(old('phone', $data['phone'] ?? '')) ?>">
            </div>

            <div>
                <label class="text-sm font-semibold">Correo</label>
                <input class="mt-1 w-full rounded-lg border p-2" name="email" type="email"
                       value="<?= esc(old('email', $data['email'] ?? '')) ?>">
            </div>

            <div>
                <label class="text-sm font-semibold">Idioma</label>
                <select class="mt-1 w-full rounded-lg border p-2" name="language">
                    <?php $lang = old('language', $data['language'] ?? 'es'); ?>
                    <option value="es" <?= $lang === 'es' ? 'selected' : '' ?>>ES</option>
                    <option value="en" <?= $lang === 'en' ? 'selected' : '' ?>>EN</option>
                </select>
            </div>
        </div>

        <div class="flex gap-2">
            <button class="rounded-lg bg-slate-900 px-4 py-2 text-white">
                <?= $isEdit ? 'Guardar cambios' : 'Crear customer' ?>
            </button>
        </div>
    </form>

<?= $this->endSection() ?>