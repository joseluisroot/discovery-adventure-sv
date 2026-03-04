<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<?php
$phone = '50369296224';

function invite_url(string $locale, string $token): string {
    return base_url($locale . '/review/' . $token);
}

function wa_message(string $locale, string $url): string {
    return ($locale === 'en')
            ? "Hi! Thanks for traveling with Discovery Adventure SV. Could you rate our service here? " . $url
            : "¡Hola! Gracias por viajar con Discovery Adventure SV. ¿Nos ayudas con tu reseña aquí? " . $url;
}

function wa_link(string $phone, string $locale, string $url): string {
    return 'https://wa.me/' . $phone . '?text=' . urlencode(wa_message($locale, $url));
}
?>

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight">Review Invites</h1>
            <p class="mt-1 text-slate-600 text-sm">
                Genera invitaciones por servicio y envíalas por WhatsApp. Luego publica las mejores reseñas.
            </p>
        </div>
    </div>

    <!-- Create invite -->
    <div class="mt-6 rounded-2xl bg-white border border-slate-100 p-5">
        <form method="post" action="<?= base_url($locale.'/admin/review-invites/create') ?>" class="grid gap-3 md:grid-cols-3 md:items-end">
            <?= csrf_field() ?>

            <div class="md:col-span-2">
                <label class="text-xs text-slate-500">Service</label>
                <select name="service_id" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" required>
                    <option value="">Select a service…</option>
                    <?php foreach (($services ?? []) as $s): ?>
                        <?php
                        $label = $s['service_type'].' · '.$s['origin'].' → '.$s['destination'].' (ID '.$s['id'].')';
                        ?>
                        <option value="<?= esc($s['id']) ?>"><?= esc($label) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="mt-2 text-xs text-slate-500">
                    Tip: usa “completed” para servicios ya realizados.
                </div>
            </div>

            <div>
                <label class="text-xs text-slate-500">Invite language</label>
                <select name="target_locale" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm">
                    <option value="<?= esc($locale) ?>" selected><?= $locale === 'en' ? 'English (default)' : 'Español (default)' ?></option>
                    <option value="en">English</option>
                    <option value="es">Español</option>
                </select>
            </div>

            <div class="md:col-span-3">
                <button class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">
                    Create invite
                </button>
            </div>
        </form>

        <?php if (session()->getFlashdata('reviewUrl')): ?>
            <?php
            $u = session()->getFlashdata('reviewUrl');
            $m = session()->getFlashdata('waMessage');
            $wa = 'https://wa.me/'.$phone.'?text='.urlencode($m);
            ?>
            <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                <div class="text-sm font-semibold text-emerald-900">Invite created ✅</div>

                <div class="mt-3 grid gap-3">
                    <div>
                        <div class="text-xs text-emerald-900/70">Review URL</div>
                        <div class="mt-1 flex gap-2">
                            <input readonly class="flex-1 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm"
                                   value="<?= esc($u) ?>">
                            <button type="button" data-copy="<?= esc($u) ?>"
                                    class="copyBtn rounded-xl border border-emerald-200 px-3 py-2 text-sm font-semibold hover:bg-white">
                                Copy
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="text-xs text-emerald-900/70">WhatsApp message</div>
                        <div class="mt-1 flex gap-2">
                            <input readonly class="flex-1 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm"
                                   value="<?= esc($m) ?>">
                            <button type="button" data-copy="<?= esc($m) ?>"
                                    class="copyBtn rounded-xl border border-emerald-200 px-3 py-2 text-sm font-semibold hover:bg-white">
                                Copy
                            </button>
                            <a href="<?= esc($wa) ?>" target="_blank"
                               class="rounded-xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white hover:bg-emerald-500">
                                Open WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Filters (client-side) -->
    <div class="mt-6 rounded-2xl bg-white border border-slate-100 p-4 flex flex-col md:flex-row md:items-center gap-3">
        <div class="text-sm font-semibold">Quick filters</div>
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" id="filterNotSent" class="h-4 w-4">
            Not sent
        </label>
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" id="filterNotResponded" class="h-4 w-4">
            Not responded
        </label>
        <div class="md:ml-auto text-xs text-slate-500">
            Filters apply instantly (no reload).
        </div>
    </div>

    <!-- List -->
    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-100 bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm" id="invitesTable">
                <thead class="bg-slate-50 border-b">
                <tr class="text-left">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Service</th>
                    <th class="px-4 py-3">Sent</th>
                    <th class="px-4 py-3">Responded</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($invites)): ?>
                    <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">No invites found.</td></tr>
                <?php else: ?>
                    <?php foreach ($invites as $i): ?>
                        <?php
                        $token = (string) $i['token'];
                        $url = invite_url($locale, $token);
                        $msg = wa_message($locale, $url);
                        $wa = wa_link($phone, $locale, $url);

                        $service = $servicesById[$i['service_id']] ?? null;
                        $serviceLabel = $service
                                ? ($service['service_type'].' · '.$service['origin'].' → '.$service['destination'])
                                : ('Service #'.$i['service_id']);

                        $isSent = !empty($i['sent_at']);
                        $isResponded = !empty($i['responded_at']);
                        ?>
                        <tr class="border-b last:border-b-0 inviteRow"
                            data-sent="<?= $isSent ? '1' : '0' ?>"
                            data-responded="<?= $isResponded ? '1' : '0' ?>">
                            <td class="px-4 py-3 font-semibold"><?= esc($i['id']) ?></td>
                            <td class="px-4 py-3">
                                <div class="font-semibold"><?= esc($serviceLabel) ?></div>
                                <div class="text-xs text-slate-500">
                                    service_id: <?= esc($i['service_id']) ?>
                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    Link: <span class="font-mono"><?= esc($url) ?></span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <?php if ($isSent): ?>
                                    <span class="inline-flex rounded-full bg-emerald-50 border border-emerald-200 px-3 py-1 text-xs font-semibold text-emerald-900">Yes</span>
                                    <div class="text-xs text-slate-500 mt-1"><?= esc($i['sent_at']) ?></div>
                                <?php else: ?>
                                    <span class="inline-flex rounded-full bg-slate-50 border border-slate-200 px-3 py-1 text-xs font-semibold">No</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if ($isResponded): ?>
                                    <span class="inline-flex rounded-full bg-emerald-50 border border-emerald-200 px-3 py-1 text-xs font-semibold text-emerald-900">Yes</span>
                                    <div class="text-xs text-slate-500 mt-1"><?= esc($i['responded_at']) ?></div>
                                <?php else: ?>
                                    <span class="inline-flex rounded-full bg-slate-50 border border-slate-200 px-3 py-1 text-xs font-semibold">No</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" data-copy="<?= esc($url) ?>"
                                            class="copyBtn rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold hover:bg-slate-50">
                                        Copy link
                                    </button>

                                    <button type="button" data-copy="<?= esc($msg) ?>"
                                            class="copyBtn rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold hover:bg-slate-50">
                                        Copy msg
                                    </button>

                                    <a href="<?= esc($wa) ?>" target="_blank"
                                       class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white hover:bg-emerald-500">
                                        WhatsApp
                                    </a>

                                    <?php if (!$isSent): ?>
                                        <form method="post" action="<?= base_url($locale.'/admin/review-invites/mark-sent/'.$i['id']) ?>">
                                            <?= csrf_field() ?>
                                            <button class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold hover:bg-slate-50">
                                                Mark sent
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <a href="<?= esc($url) ?>" target="_blank"
                                       class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold hover:bg-slate-50">
                                        Open form
                                    </a>

                                    <?php if (!empty($i['responded_at'])): ?>
                                        <a href="<?= base_url($locale.'/admin/reviews?published=0') ?>"
                                           class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold hover:bg-slate-50">
                                            Moderate reviews
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        (function () {
            // copy
            function copyText(text) {
                if (!text) return;
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text);
                    return;
                }
                const ta = document.createElement('textarea');
                ta.value = text;
                ta.style.position = 'fixed';
                ta.style.top = '-1000px';
                document.body.appendChild(ta);
                ta.focus();
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
            }

            document.querySelectorAll('.copyBtn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const text = btn.getAttribute('data-copy');
                    copyText(text);
                    const old = btn.textContent;
                    btn.textContent = 'Copied ✅';
                    setTimeout(() => btn.textContent = old, 900);
                });
            });

            // filters
            const notSent = document.getElementById('filterNotSent');
            const notResponded = document.getElementById('filterNotResponded');
            const rows = Array.from(document.querySelectorAll('.inviteRow'));

            function applyFilters() {
                rows.forEach(row => {
                    const sent = row.getAttribute('data-sent') === '1';
                    const responded = row.getAttribute('data-responded') === '1';

                    let show = true;
                    if (notSent.checked && sent) show = false;
                    if (notResponded.checked && responded) show = false;

                    row.style.display = show ? '' : 'none';
                });
            }

            notSent.addEventListener('change', applyFilters);
            notResponded.addEventListener('change', applyFilters);
        })();
    </script>

<?= $this->endSection() ?>