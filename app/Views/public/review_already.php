<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-3xl px-4 py-16 text-center">
        <div class="rounded-3xl border border-slate-100 bg-white p-10 shadow-sm">

            <div class="text-4xl mb-4">🙏</div>

            <h1 class="text-2xl font-extrabold tracking-tight">
                <?= $locale === 'en'
                    ? 'Thank you! Your review was already submitted.'
                    : '¡Gracias! Tu reseña ya fue enviada.' ?>
            </h1>

            <p class="mt-4 text-slate-600">
                <?= $locale === 'en'
                    ? 'We truly appreciate your time and feedback.'
                    : 'Agradecemos mucho tu tiempo y tus comentarios.' ?>
            </p>

            <div class="mt-8">
                <a href="<?= base_url($locale) ?>"
                   class="rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                    <?= $locale === 'en' ? 'Back to home' : 'Volver al inicio' ?>
                </a>
            </div>

        </div>
    </section>

<?= $this->endSection() ?>