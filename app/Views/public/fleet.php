<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-6xl px-4 pt-10 pb-8">
        <div class="flex flex-col gap-3">
            <p class="text-sm font-semibold text-emerald-700">
                <?= $locale === 'en' ? 'Our Fleet' : 'Nuestra Flota' ?>
            </p>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                <?= $locale === 'en'
                    ? 'Comfort, cleanliness and space for your group'
                    : 'Comodidad, limpieza y espacio para tu grupo' ?>
            </h1>
            <p class="text-slate-600 max-w-2xl">
                <?= $locale === 'en'
                    ? 'Modern microbus ideal for tourists, families and corporate transportation. Air conditioning, comfortable seating and luggage space.'
                    : 'Microbús moderno ideal para turismo, familias y transporte corporativo. Aire acondicionado, asientos cómodos y espacio para equipaje.' ?>
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-12">
        <div class="grid gap-4 md:grid-cols-3">
            <div class="md:col-span-2 rounded-3xl overflow-hidden border border-slate-100 shadow-sm">
                <img src="<?= base_url('images/fleet/microbus-1.jpg') ?>" class="w-full h-[360px] md:h-[480px] object-cover" alt="Microbus - exterior" loading="lazy">
            </div>
            <div class="grid gap-4">
                <div class="rounded-3xl overflow-hidden border border-slate-100 shadow-sm">
                    <img src="<?= base_url('images/fleet/microbus-2.jpg') ?>" class="w-full h-[170px] object-cover" alt="Microbus - interior" loading="lazy">
                </div>
                <div class="rounded-3xl overflow-hidden border border-slate-100 shadow-sm">
                    <img src="<?= base_url('images/fleet/microbus-3.jpg') ?>" class="w-full h-[170px] object-cover" alt="Microbus - interior seats" loading="lazy">
                </div>
            </div>
        </div>

        <div class="mt-10 grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-100 p-6">
                <div class="font-bold"><?= $locale === 'en' ? 'Capacity' : 'Capacidad' ?></div>
                <div class="mt-2 text-slate-600 text-sm"><?= $locale === 'en' ? 'Up to 15 passengers' : 'Hasta 15 pasajeros' ?></div>
            </div>
            <div class="rounded-2xl border border-slate-100 p-6">
                <div class="font-bold"><?= $locale === 'en' ? 'Comfort' : 'Comodidad' ?></div>
                <div class="mt-2 text-slate-600 text-sm"><?= $locale === 'en' ? 'Comfortable seating and A/C' : 'Asientos cómodos y A/C' ?></div>
            </div>
            <div class="rounded-2xl border border-slate-100 p-6">
                <div class="font-bold"><?= $locale === 'en' ? 'Cleanliness' : 'Limpieza' ?></div>
                <div class="mt-2 text-slate-600 text-sm"><?= $locale === 'en' ? 'Professional cleaning standards' : 'Estandar profesional de limpieza' ?></div>
            </div>
        </div>

        <div class="mt-10 flex flex-col sm:flex-row gap-3">
            <a href="https://wa.me/50369296224"
               class="inline-flex justify-center rounded-xl bg-slate-900 text-white px-5 py-3 font-semibold hover:bg-slate-800">
                <?= $locale === 'en' ? 'Book via WhatsApp' : 'Reservar por WhatsApp' ?>
            </a>
            <a href="<?= base_url($locale.'/services') ?>"
               class="inline-flex justify-center rounded-xl border border-slate-200 px-5 py-3 font-semibold hover:bg-slate-50">
                <?= $locale === 'en' ? 'See services' : 'Ver servicios' ?>
            </a>
        </div>
    </section>

<?= $this->endSection() ?>