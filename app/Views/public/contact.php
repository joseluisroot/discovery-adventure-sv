<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-6xl px-4 pt-10 pb-8">
        <p class="text-sm font-semibold text-emerald-700">
            <?= $locale === 'en' ? 'Contact' : 'Contacto' ?>
        </p>

        <h1 class="mt-3 text-3xl md:text-4xl font-extrabold tracking-tight">
            <?= $locale === 'en'
                ? 'Book in minutes via WhatsApp'
                : 'Reserva en minutos por WhatsApp' ?>
        </h1>

        <p class="mt-4 max-w-2xl text-slate-600">
            <?= $locale === 'en'
                ? 'Tell us your date, route and group size. We’ll confirm availability and give you a clear quote.'
                : 'Cuéntanos tu fecha, ruta y cantidad de pasajeros. Confirmamos disponibilidad y te damos una cotización clara.' ?>
        </p>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div class="grid gap-6 md:grid-cols-2">

            <!-- WhatsApp Primary Card -->
            <div class="rounded-3xl border border-slate-100 p-6 md:p-8 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm font-semibold text-slate-900">
                            <?= $locale === 'en' ? 'WhatsApp (recommended)' : 'WhatsApp (recomendado)' ?>
                        </div>
                        <p class="mt-2 text-sm text-slate-600">
                            <?= $locale === 'en'
                                ? 'Fastest way to confirm date, route and pickup.'
                                : 'La forma más rápida de confirmar fecha, ruta y punto de salida.' ?>
                        </p>
                    </div>
                    <div class="rounded-2xl bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                        <?= $locale === 'en' ? 'Fast response' : 'Respuesta rápida' ?>
                    </div>
                </div>

                <div class="mt-5 grid gap-3">
                    <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-700">
                        <div class="font-semibold"><?= $locale === 'en' ? 'Send this info:' : 'Envíanos esta info:' ?></div>
                        <ul class="mt-2 space-y-1 text-slate-600">
                            <li>• <?= $locale === 'en' ? 'Date & time' : 'Fecha y hora' ?></li>
                            <li>• <?= $locale === 'en' ? 'Route / destination' : 'Ruta / destino' ?></li>
                            <li>• <?= $locale === 'en' ? 'Pickup location' : 'Punto de salida' ?></li>
                            <li>• <?= $locale === 'en' ? 'Passengers' : 'Cantidad de pasajeros' ?></li>
                        </ul>
                    </div>

                    <?php
                    $wa = $locale === 'en'
                        ? 'https://wa.me/50369296224?text=' . urlencode("Hello! I'd like to book transportation with Discovery Adventure SV.\nDate & time: __\nRoute/destination: __\nPickup location: __\nPassengers: __\nNotes: __")
                        : 'https://wa.me/50369296224?text=' . urlencode("Hola! Quiero reservar transporte con Discovery Adventure SV.\nFecha y hora: __\nRuta/destino: __\nPunto de salida: __\nPasajeros: __\nNotas: __");
                    ?>

                    <a href="<?= $wa ?>"
                       class="inline-flex justify-center rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-500">
                        <?= $locale === 'en' ? 'Open WhatsApp message' : 'Abrir mensaje en WhatsApp' ?>
                    </a>

                    <a href="https://wa.me/50369296224"
                       class="inline-flex justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold hover:bg-slate-50">
                        <?= $locale === 'en' ? 'WhatsApp: +503 6929 6224' : 'WhatsApp: +503 6929 6224' ?>
                    </a>

                    <div class="text-xs text-slate-500">
                        <?= $locale === 'en'
                            ? 'Bilingual service available (English/Spanish).'
                            : 'Servicio bilingüe disponible (Inglés/Español).' ?>
                    </div>
                </div>
            </div>

            <!-- Secondary: Contact & Next Steps -->
            <div class="rounded-3xl border border-slate-100 p-6 md:p-8">
                <h2 class="text-xl font-extrabold tracking-tight">
                    <?= $locale === 'en' ? 'What happens next?' : '¿Qué sigue?' ?>
                </h2>

                <div class="mt-4 space-y-3">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? '1) Confirm details' : '1) Confirmamos detalles' ?></div>
                        <div class="mt-1 text-sm text-slate-600">
                            <?= $locale === 'en' ? 'Route, schedule, pickup point and group size.' : 'Ruta, horario, punto de salida y tamaño del grupo.' ?>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? '2) Quote' : '2) Cotización' ?></div>
                        <div class="mt-1 text-sm text-slate-600">
                            <?= $locale === 'en' ? 'You get a clear quote — no surprises.' : 'Recibes una cotización clara — sin sorpresas.' ?>
                        </div>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="text-sm font-semibold"><?= $locale === 'en' ? '3) Reservation' : '3) Reserva' ?></div>
                        <div class="mt-1 text-sm text-slate-600">
                            <?= $locale === 'en'
                                ? 'We confirm the booking. Online reservations will be launched soon.'
                                : 'Confirmamos la reserva. Próximamente lanzaremos reservas online.' ?>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="text-sm font-semibold text-slate-900">
                        <?= $locale === 'en' ? 'Services we offer' : 'Servicios disponibles' ?>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2 text-xs">
                        <span class="rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 font-semibold"><?= $locale === 'en' ? 'Tours' : 'Tours' ?></span>
                        <span class="rounded-full bg-slate-50 text-slate-700 px-3 py-1 font-semibold"><?= $locale === 'en' ? 'Corporate' : 'Corporativo' ?></span>
                        <span class="rounded-full bg-slate-50 text-slate-700 px-3 py-1 font-semibold"><?= $locale === 'en' ? 'Airport transfers' : 'Aeropuerto' ?></span>
                        <span class="rounded-full bg-slate-50 text-slate-700 px-3 py-1 font-semibold"><?= $locale === 'en' ? 'Family groups' : 'Grupos familiares' ?></span>
                    </div>
                </div>

                <div class="mt-8 rounded-2xl bg-slate-900 text-white p-6">
                    <div class="text-sm font-semibold"><?= $locale === 'en' ? 'Want to see reviews first?' : '¿Quieres ver reseñas primero?' ?></div>
                    <p class="mt-2 text-sm text-white/80">
                        <?= $locale === 'en'
                            ? 'Real client feedback — with extra emphasis on customer service.'
                            : 'Reseñas reales — con énfasis en la atención al cliente.' ?>
                    </p>
                    <a href="<?= base_url($locale.'/reviews') ?>"
                       class="mt-4 inline-flex w-full justify-center rounded-xl bg-white text-slate-900 px-5 py-3 text-sm font-semibold hover:bg-slate-100">
                        <?= $locale === 'en' ? 'View reviews' : 'Ver reseñas' ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Minimal FAQ -->
        <div class="mt-10 grid gap-4 md:grid-cols-3">
            <div class="rounded-3xl border border-slate-100 p-6">
                <div class="text-sm font-bold"><?= $locale === 'en' ? 'Do you speak English?' : '¿Hablan inglés?' ?></div>
                <p class="mt-2 text-sm text-slate-600">
                    <?= $locale === 'en'
                        ? 'Yes. We can provide bilingual support and translation if needed.'
                        : 'Sí. Podemos brindar soporte bilingüe y traducción si se requiere.' ?>
                </p>
            </div>
            <div class="rounded-3xl border border-slate-100 p-6">
                <div class="text-sm font-bold"><?= $locale === 'en' ? 'Where do you operate?' : '¿En qué zonas trabajan?' ?></div>
                <p class="mt-2 text-sm text-slate-600">
                    <?= $locale === 'en'
                        ? 'Across El Salvador: city, mountains, beaches and custom routes.'
                        : 'En todo El Salvador: ciudad, montaña, playa y rutas personalizadas.' ?>
                </p>
            </div>
            <div class="rounded-3xl border border-slate-100 p-6">
                <div class="text-sm font-bold"><?= $locale === 'en' ? 'How do I book?' : '¿Cómo reservo?' ?></div>
                <p class="mt-2 text-sm text-slate-600">
                    <?= $locale === 'en'
                        ? 'For now, WhatsApp is the fastest. Online booking will be launched soon.'
                        : 'Por ahora WhatsApp es lo más rápido. Próximamente lanzaremos reservas online.' ?>
                </p>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>