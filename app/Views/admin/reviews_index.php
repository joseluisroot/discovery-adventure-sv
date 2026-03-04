<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight">Reviews</h1>
            <p class="mt-1 text-slate-600 text-sm">Publica solo las mejores. Enfócate en Atención al Cliente.</p>
        </div>

        <div class="grid grid-cols-2 md:flex gap-2">
            <div class="rounded-xl bg-white border border-slate-100 px-4 py-3">
                <div class="text-xs text-slate-500">Total</div>
                <div class="text-lg font-extrabold"><?= esc($metrics['count'] ?? 0) ?></div>
            </div>
            <div class="rounded-xl bg-white border border-slate-100 px-4 py-3">
                <div class="text-xs text-slate-500">Avg score</div>
                <div class="text-lg font-extrabold"><?= esc($metrics['avg_total'] ?? 0) ?></div>
            </div>
            <div class="rounded-xl bg-white border border-slate-100 px-4 py-3">
                <div class="text-xs text-slate-500">Avg attention</div>
                <div class="text-lg font-extrabold"><?= esc($metrics['avg_attention'] ?? 0) ?></div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <form class="mt-6 rounded-2xl bg-white border border-slate-100 p-4 flex flex-col md:flex-row gap-3 md:items-end" method="get">
        <div class="flex-1">
            <label class="text-xs text-slate-500">Published</label>
            <select name="published" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm">
                <option value="" <?= empty($filters['published']) ? 'selected' : '' ?>>All</option>
                <option value="1" <?= ($filters['published'] ?? '') === '1' ? 'selected' : '' ?>>Published</option>
                <option value="0" <?= ($filters['published'] ?? '') === '0' ? 'selected' : '' ?>>Unpublished</option>
            </select>
        </div>

        <div class="flex-1">
            <label class="text-xs text-slate-500">Min score</label>
            <input name="minScore" value="<?= esc($filters['minScore'] ?? '') ?>"
                   placeholder="e.g. 4.2"
                   class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm">
        </div>

        <div class="flex-1">
            <label class="text-xs text-slate-500">Low only</label>
            <select name="low" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm">
                <option value="" <?= empty($filters['low']) ? 'selected' : '' ?>>No</option>
                <option value="1" <?= ($filters['low'] ?? '') === '1' ? 'selected' : '' ?>>Yes (&lt; 3.5)</option>
            </select>
        </div>

        <button class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">
            Apply
        </button>

        <a href="<?= base_url($locale.'/admin/reviews') ?>"
           class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold hover:bg-slate-50 text-center">
            Reset
        </a>
    </form>

    <!-- Table -->
    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-100 bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 border-b">
                <tr class="text-left">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Attention</th>
                    <th class="px-4 py-3">Punctuality</th>
                    <th class="px-4 py-3">Clean</th>
                    <th class="px-4 py-3">Comfort</th>
                    <th class="px-4 py-3">Score</th>
                    <th class="px-4 py-3">Published</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($reviews)): ?>
                    <tr><td colspan="8" class="px-4 py-6 text-center text-slate-500">No reviews found.</td></tr>
                <?php else: ?>
                    <?php foreach ($reviews as $r): ?>
                        <?php
                        $score = (float)($r['score_total'] ?? 0);
                        $badge = $score >= 4.2 ? 'bg-emerald-50 border-emerald-200 text-emerald-900'
                                : ($score > 0 && $score < 3.5 ? 'bg-red-50 border-red-200 text-red-900'
                                        : 'bg-slate-50 border-slate-200 text-slate-900');
                        ?>
                        <tr class="border-b last:border-b-0">
                            <td class="px-4 py-3 font-semibold"><?= esc($r['id']) ?></td>
                            <td class="px-4 py-3"><?= esc($r['rating_attention'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($r['rating_punctuality'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($r['rating_cleanliness'] ?? '-') ?></td>
                            <td class="px-4 py-3"><?= esc($r['rating_comfort'] ?? '-') ?></td>
                            <td class="px-4 py-3">
                <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold <?= $badge ?>">
                  <?= esc($r['score_total'] ?? '-') ?>
                </span>
                            </td>
                            <td class="px-4 py-3">
                                <?= ((int)($r['published'] ?? 0) === 1) ? 'Yes' : 'No' ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if ((int)($r['published'] ?? 0) === 1): ?>
                                    <form method="post" action="<?= base_url($locale.'/admin/reviews/unpublish/'.$r['id']) ?>">
                                        <?= csrf_field() ?>
                                        <button class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold hover:bg-slate-50">
                                            Unpublish
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form method="post" action="<?= base_url($locale.'/admin/reviews/publish/'.$r['id']) ?>">
                                        <?= csrf_field() ?>
                                        <button class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white hover:bg-emerald-500">
                                            Publish
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>