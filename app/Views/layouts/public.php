<!doctype html>
<html lang="<?= esc($locale) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($meta['title'] ?? 'Discovery Adventure SV') ?></title>
    <meta name="description" content="<?= esc($meta['description'] ?? '') ?>">

    <link rel="canonical" href="<?= esc($meta['canonical'] ?? current_url()) ?>">

    <!-- OpenGraph -->
    <meta property="og:title" content="<?= esc($meta['og_title'] ?? ($meta['title'] ?? 'Discovery Adventure SV')) ?>">
    <meta property="og:description" content="<?= esc($meta['og_description'] ?? ($meta['description'] ?? '')) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= esc($meta['canonical'] ?? current_url()) ?>">
    <meta property="og:image" content="<?= esc($meta['og_image'] ?? base_url('assets/og-default.jpg')) ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" href="<?= base_url('assets/app.css?v=' . time()) ?>">
</head>

<body class="bg-white text-slate-900 antialiased bg-red-500">
<?php echo view('layouts/partials/navbar', ['locale' => $locale]); ?>

<main>
    <?= $this->renderSection('content') ?>
</main>

<?php echo view('layouts/partials/footer', ['locale' => $locale]); ?>
<?php echo view('layouts/partials/whatsapp_fab'); ?>

<!-- LocalBusiness Schema (básico) -->
<script type="application/ld+json">
  <?= json_encode($schema ?? [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
  </script>
</body>
</html>