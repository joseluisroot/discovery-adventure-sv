<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<?php
$isEdit = ($mode === 'edit');
$action = $isEdit
    ? "/{$locale}/admin/services/{$id}"
    : "/{$locale}/admin/customers/" . esc($data['customer_id']) . "/services";
?>

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold"><?= $isEdit ? 'Editar Servicio' : 'Nuevo Servicio' ?></h1>

            <?php if (!empty($customer)): ?>
                <p class="mt-1 text-sm text-slate-600">
                    Asociado a: <span class="font-semibold"><?= esc($customer['name']) ?></span>
                    <?= !empty($customer['phone']) ? ' · ' . esc($customer['phone']) : '' ?>
                </p>
            <?php endif; ?>
        </div>

        <a class="rounded-lg bg-slate-100 px-4 py-2" href="/<?= esc($locale) ?>/admin/services">Volver</a>
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
                <label class="text-sm font-semibold">Tipo de servicio *</label>
                <?php $st = old('service_type', $data['service_type'] ?? 'tour'); ?>
                <select class="mt-1 w-full rounded-lg border p-2" name="service_type" required>
                    <option value="tour" <?= $st === 'tour' ? 'selected' : '' ?>>Tour</option>
                    <option value="transfer" <?= $st === 'transfer' ? 'selected' : '' ?>>Traslado</option>
                    <option value="corporate" <?= $st === 'corporate' ? 'selected' : '' ?>>Corporativo</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold">Estado *</label>
                <?php $status = old('status', $data['status'] ?? 'pending'); ?>
                <select class="mt-1 w-full rounded-lg border p-2" name="status" required>
                    <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="confirmed" <?= $status === 'confirmed' ? 'selected' : '' ?>>Confirmado</option>
                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completado</option>
                    <option value="canceled" <?= $status === 'canceled' ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold">Origen *</label>
                <input class="mt-1 w-full rounded-lg border p-2" name="origin"
                       value="<?= esc(old('origin', $data['origin'] ?? '')) ?>" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Destino *</label>
                <input class="mt-1 w-full rounded-lg border p-2" name="destination"
                       value="<?= esc(old('destination', $data['destination'] ?? '')) ?>" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Fecha *</label>
                <input class="mt-1 w-full rounded-lg border p-2" type="date" name="service_date"
                       value="<?= esc(old('service_date', $data['service_date'] ?? date('Y-m-d'))) ?>" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Hora *</label>
                <input class="mt-1 w-full rounded-lg border p-2" type="time" name="service_time"
                       value="<?= esc(old('service_time', $data['service_time'] ?? '08:00')) ?>" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Pasajeros *</label>
                <input class="mt-1 w-full rounded-lg border p-2" type="number" min="1" max="99" name="passengers"
                       value="<?= esc(old('passengers', $data['passengers'] ?? 1)) ?>" required>
            </div>
        </div>

        <div>
            <label class="text-sm font-semibold">Notas</label>
            <textarea class="mt-1 w-full rounded-lg border p-2" name="notes" rows="4"><?= esc(old('notes', $data['notes'] ?? '')) ?></textarea>
        </div>

        <div class="flex gap-2">
            <button class="rounded-lg bg-slate-900 px-4 py-2 text-white">
                <?= $isEdit ? 'Guardar cambios' : 'Crear servicio' ?>
            </button>
        </div>
    </form>

<?= $this->endSection() ?>