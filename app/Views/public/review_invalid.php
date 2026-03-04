<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-3xl px-4 py-16 text-center">
        <div class="rounded-3xl border border-red-100 bg-red-50 p-10 shadow-sm">

            <div class="text-4xl mb-4">⚠</div>

            <h1 class="text-2xl font-extrabold tracking-tight text-red-900">
                <?= $locale === 'en'
                        ? 'Invalid or expired review link'
                        : 'Enlace de reseña inválido o expirado' ?>
            </h1>

            <p class="mt-4 text-red-800">
                <?= $locale === 'en'
                        ? 'If you believe this is a mistake, please contact us.'
                        : 'Si crees que esto es un error, por favor contáctanos.' ?>
            </p>

        </div>
    </section>

<?= $this->endSection() ?>