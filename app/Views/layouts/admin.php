<!doctype html>
<html lang="<?= esc($locale ?? 'es') ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($meta['title'] ?? 'Admin | Discovery Adventure SV') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/app.css?v=' . time()) ?>">
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
<div class="min-h-screen">

    <!-- Topbar -->
    <div class="border-b bg-white">
        <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between">
            <div class="font-extrabold tracking-tight">
                Discovery Adventure SV <span class="text-slate-400 font-semibold">Admin</span>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                <a class="text-sm px-3 py-2 rounded-lg hover:bg-slate-50 border border-slate-200"
                   href="<?= base_url($locale.'/admin') ?>">Dashboard</a>

                <!-- ✅ NUEVO: Customers -->
                <a class="text-sm px-3 py-2 rounded-lg hover:bg-slate-50 border border-slate-200"
                   href="<?= base_url($locale.'/admin/customers') ?>">Customers</a>

                <!-- ✅ NUEVO: Services -->
                <a class="text-sm px-3 py-2 rounded-lg hover:bg-slate-50 border border-slate-200"
                   href="<?= base_url($locale.'/admin/services') ?>">Services</a>

                <a class="text-sm px-3 py-2 rounded-lg hover:bg-slate-50 border border-slate-200"
                   href="<?= base_url($locale.'/admin/review-invites') ?>">Invites</a>

                <a class="text-sm px-3 py-2 rounded-lg hover:bg-slate-50 border border-slate-200"
                   href="<?= base_url($locale.'/admin/reviews') ?>">Reviews</a>
            </div>
        </div>
    </div>

    <!-- Flash -->
    <div class="mx-auto max-w-7xl px-4 pt-4">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <?php $errs = session()->getFlashdata('errors'); ?>
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-900">
                <?php if (is_array($errs)): ?>
                    <ul class="list-disc ml-5">
                        <?php foreach ($errs as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <?= esc($errs) ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <main class="mx-auto max-w-7xl px-4 py-6">
        <?= $this->renderSection('content') ?>
    </main>

</div>
</body>
</html>