<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>

    <section class="mx-auto max-w-6xl px-4 pt-10 pb-8">
        <p class="text-sm font-semibold text-emerald-700">
            <?= $locale === 'en' ? 'Services' : 'Servicios' ?>
        </p>

        <h1 class="mt-3 text-3xl md:text-4xl font-extrabold tracking-tight">
            <?= $locale === 'en'
                ? 'Tourist and corporate transportation with exceptional customer service'
                : 'Transporte turístico y corporativo con atención excepcional' ?>
        </h1>

        <p class="mt-4 max-w-2xl text-slate-600">
            <?= $locale === 'en'
                ? 'We focus on punctuality, cleanliness, comfort and — above all — customer service. Book in minutes via WhatsApp.'
                : 'Nos enfocamos en puntualidad, limpieza, comodidad y — sobre todo — atención al cliente. Reserva en minutos por WhatsApp.' ?>
        </p>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-12">
        <div class="grid gap-4 md:grid-cols-2">
            <!-- Tourist -->
            <div class="rounded-3xl border border-slate-100 p-6 md:p-8 shadow-sm">
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                    <?= $locale === 'en' ? 'Tourist' : 'Turismo' ?>
                </div>

                <h2 class="mt-4 text-xl md:text-2xl font-extrabold tracking-tight">
                    <?= $locale === 'en' ? 'Tours & private routes' : 'Tours y rutas privadas' ?>
                </h2>

                <p class="mt-3 text-slate-600">
                    <?= $locale === 'en'
                        ? 'Perfect for families, friends and groups. Custom routes: beach, volcano, mountains and iconic places in El Salvador.'
                        : 'Ideal para familias, amigos y grupos. Rutas personalizadas: playa, volcán, montaña y lugares emblemáticos de El Salvador.' ?>
                </p>

                <ul class="mt-4 space-y-2 text-sm text-slate-700">
                    <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-emerald-600"></span><?= $locale === 'en' ? 'City Tour (San Salvador)' : 'Ruta de ciudad (San Salvador)' ?></li>
                    <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-emerald-600"></span><?= $locale === 'en' ? 'Ruta de las Flores' : 'Ruta de las Flores' ?></li>
                    <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-emerald-600"></span><?= $locale === 'en' ? 'Beach routes (Surf City, Costa del Sol)' : 'Rutas de playa (Surf City, Costa del Sol)' ?></li>
                    <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-emerald-600"></span><?= $locale === 'en' ? 'Volcano & mountain experiences' : 'Experiencias de volcán y montaña' ?></li>
                    <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-emerald-600"></span><?= $locale === 'en' ? 'Airport transfers' : 'Traslados al aeropuerto' ?></li>
                </ul>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a
                        href="<?=
                        $locale === 'en'
                            ? 'https://wa.me/50369296224?text=' . urlencode('Hello! I would like to book a TOUR with Discovery Adventure SV. We are a group of __ people. Date: __. Route: __.')
                            : 'https://wa.me/50369296224?text=' . urlencode('Hola! Quiero reservar un TOUR con Discovery Adventure SV. Somos un grupo de __ personas. Fecha: __. Ruta: __.')
                        ?>"
                        class="inline-flex justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800"
                    >
                        <?= $locale === 'en' ? 'Book a tour via WhatsApp' : 'Reservar tour por WhatsApp' ?>
                    </a>

                    <a
                        href="<?= base_url($locale.'/fleet') ?>"
                        class="inline-flex justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold hover:bg-slate-50"
                    >
                        <?= $locale === 'en' ? 'See fleet' : 'Ver flota' ?>
                    </a>
                </div>
            </div>

            <!-- Corporate -->
            <div class="rounded-3xl border border-slate-100 p-6 md:p-8 shadow-sm">
                <div class="inline-flex items-center gap-2 rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700">
                    <?= $locale === 'en' ? 'Corporate' : 'Corporativo' ?>
                </div>

                <h2 class="mt-4 text-xl md:text-2xl font-extrabold tracking-tight">
                    <?= $locale === 'en' ? 'Corporate transportation' : 'Transporte corporativo' ?>
                </h2>

                <p class="mt-3 text-slate-600">
                    <?= $locale === 'en'
                        ? 'Reliable service for your team: punctual pickups, clean vehicle standards and professional customer support.'
                        : 'Servicio confiable para tu equipo: puntualidad, limpieza y soporte profesional al cliente.' ?>
                </p>

                <ul class="mt-4 space-y-2 text-sm text-slate-700">
                    <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-slate-900"></span><?= $locale === 'en' ? 'Executive trips and meetings' : 'Traslados ejecutivos y reuniones' ?></li>
                    <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-slate-900"></span><?= $locale === 'en' ? 'Airport transfers for staff/clients' : 'Traslados al aeropuerto para personal/clientes' ?></li>
                    <li class="flex gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-slate-900"></span><?= $locale === 'en' ? 'Scheduled routes (monthly contracts)' : 'Rutas programadas (contratos mensuales)' ?></li>
                </ul>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a
                        href="<?=
                        $locale === 'en'
                            ? 'https://wa.me/50369296224?text=' . urlencode('Hello! I would like a CORPORATE transportation quote with Discovery Adventure SV. Company: __. Dates/frequency: __. Passengers: __.')
                            : 'https://wa.me/50369296224?text=' . urlencode('Hola! Quisiera una cotización de transporte CORPORATIVO con Discovery Adventure SV. Empresa: __. Fechas/frecuencia: __. Pasajeros: __.')
                        ?>"
                        class="inline-flex justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800"
                    >
                        <?= $locale === 'en' ? 'Request a quote via WhatsApp' : 'Solicitar cotización por WhatsApp' ?>
                    </a>

                    <a
                        href="<?= base_url($locale.'/contact') ?>"
                        class="inline-flex justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold hover:bg-slate-50"
                    >
                        <?= $locale === 'en' ? 'Contact' : 'Contacto' ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-14">
        <div class="rounded-3xl bg-slate-900 text-white p-7 md:p-10">
            <div class="grid gap-8 md:grid-cols-2 md:items-center">
                <div>
                    <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                        <?= $locale === 'en'
                            ? 'Fast booking today — online reservations next.'
                            : 'Reserva rápida hoy — reservas online muy pronto.' ?>
                    </h3>
                    <p class="mt-3 text-white/80">
                        <?= $locale === 'en'
                            ? 'We are launching our online booking system soon. For now, WhatsApp is the fastest way to confirm date, route and pickup.'
                            : 'Pronto lanzaremos nuestro sistema de reservas online. Por ahora, WhatsApp es la forma más rápida de confirmar fecha, ruta y punto de encuentro.' ?>
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 md:justify-end">
                    <a href="https://wa.me/50369296224"
                       class="inline-flex justify-center rounded-xl bg-white text-slate-900 px-5 py-3 text-sm font-semibold hover:bg-slate-100">
                        <?= $locale === 'en' ? 'WhatsApp now' : 'WhatsApp ahora' ?>
                    </a>
                    <a href="<?= base_url($locale.'/reviews') ?>"
                       class="inline-flex justify-center rounded-xl border border-white/20 px-5 py-3 text-sm font-semibold hover:bg-white/10">
                        <?= $locale === 'en' ? 'See reviews' : 'Ver reseñas' ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>