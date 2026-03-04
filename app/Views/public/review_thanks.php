<!doctype html>
<html lang="<?= esc($locale) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $locale === 'en' ? 'Thank you' : 'Gracias' ?></title>
</head>
<body style="font-family: Arial; padding: 20px; max-width: 640px; margin: 0 auto;">
<h2><?= $locale === 'en' ? 'Thank you for your review!' : '¡Gracias por tu reseña!' ?></h2>
<p><?= $locale === 'en' ? 'Your feedback helps us improve.' : 'Tu opinión nos ayuda a mejorar.' ?></p>
<p><b><?= $locale === 'en' ? 'Score:' : 'Puntaje:' ?></b> <?= esc($score) ?>/5</p>
</body>
</html>