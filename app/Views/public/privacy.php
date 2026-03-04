<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-4xl px-4 pt-10 pb-14">
        <h1 class="text-3xl font-extrabold tracking-tight">
            <?= $locale === 'en' ? 'Privacy Policy' : 'Política de Privacidad' ?>
        </h1>

        <div class="mt-6 space-y-4 text-slate-700 leading-relaxed">
            <p>
                <?= $locale === 'en'
                    ? 'We collect only the information necessary to provide transportation and customer support (e.g., date, route, pickup point, group size).'
                    : 'Recopilamos únicamente la información necesaria para brindar el servicio y soporte (por ejemplo: fecha, ruta, punto de salida, cantidad de pasajeros).' ?>
            </p>
            <p>
                <?= $locale === 'en'
                    ? 'If you submit a review, your feedback may be published on our website without personal identifiers.'
                    : 'Si envías una reseña, tu opinión puede publicarse en el sitio web sin identificadores personales.' ?>
            </p>
            <p>
                <?= $locale === 'en'
                    ? 'For questions, contact us via WhatsApp.'
                    : 'Para consultas, contáctanos por WhatsApp.' ?>
            </p>
        </div>
    </section>

<?= $this->endSection() ?>