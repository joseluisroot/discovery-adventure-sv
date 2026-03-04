<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-4xl px-4 pt-10 pb-14">
        <h1 class="text-3xl font-extrabold tracking-tight">
            <?= $locale === 'en' ? 'Terms of Service' : 'Términos del Servicio' ?>
        </h1>

        <div class="mt-6 space-y-4 text-slate-700 leading-relaxed">
            <p>
                <?= $locale === 'en'
                    ? 'Service availability depends on scheduling and route confirmation.'
                    : 'La disponibilidad del servicio depende de la programación y confirmación de ruta.' ?>
            </p>
            <p>
                <?= $locale === 'en'
                    ? 'Clients should confirm pickup details in advance. Changes may affect the quote.'
                    : 'El cliente debe confirmar detalles de salida con anticipación. Cambios pueden afectar la cotización.' ?>
            </p>
            <p>
                <?= $locale === 'en'
                    ? 'We aim to provide punctual, safe and clean transportation.'
                    : 'Nos comprometemos a brindar transporte puntual, seguro y limpio.' ?>
            </p>
        </div>
    </section>

<?= $this->endSection() ?>