<!doctype html>
<html lang="<?= esc($locale ?? 'es') ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Discovery Adventure SV</title>
    <link rel="stylesheet" href="<?= base_url('assets/app.css?v=' . time()) ?>">
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-6">
        <div class="text-xl font-extrabold tracking-tight">Discovery Adventure SV</div>
        <div class="mt-1 text-sm text-slate-600">Ingreso a administración</div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <?php $errs = session()->getFlashdata('errors'); ?>
            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-900">
                <?php if (is_array($errs)): ?>
                    <ul class="list-disc ml-5">
                        <?php foreach ($errs as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <?= esc($errs) ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <form class="mt-5 space-y-4" method="post" action="<?= base_url($locale.'/admin/attempt') ?>">
            <?= csrf_field() ?>

            <div>
                <label class="text-sm font-semibold">Email</label>
                <input class="mt-1 w-full rounded-lg border border-slate-200 p-2"
                       type="email" name="email" value="<?= esc(old('email')) ?>" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Contraseña</label>
                <input class="mt-1 w-full rounded-lg border border-slate-200 p-2"
                       type="password" name="password" required>
            </div>

            <button class="w-full rounded-lg bg-slate-900 px-4 py-2 text-white font-semibold hover:opacity-95">
                Ingresar
            </button>

            <div class="text-xs text-slate-500 text-center">
                Acceso restringido. Si necesitas soporte, contacta al administrador.
            </div>
        </form>
    </div>
</div>
</body>
</html>