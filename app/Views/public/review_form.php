<!doctype html>
<html lang="<?= esc($locale) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $locale === 'en' ? 'Leave a review' : 'Dejar reseña' ?></title>
</head>
<body style="font-family: Arial; padding: 20px; max-width: 640px; margin: 0 auto;">
<h2><?= $locale === 'en' ? 'Your experience matters' : 'Tu experiencia es importante' ?></h2>

<?php if (!empty($errors)): ?>
    <div style="background:#ffecec; padding:12px; border:1px solid #ffb3b3; margin-bottom:12px;">
        <b><?= $locale === 'en' ? 'Please check:' : 'Por favor revisa:' ?></b>
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= esc($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= base_url($locale . '/review/submit') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="token" value="<?= esc($token) ?>">

    <?php
    $labels = [
        'rating_attention' => $locale === 'en' ? 'Customer Service / Attention' : 'Atención al cliente',
        'rating_punctuality' => $locale === 'en' ? 'Punctuality' : 'Puntualidad',
        'rating_cleanliness' => $locale === 'en' ? 'Vehicle Cleanliness' : 'Limpieza del vehículo',
        'rating_comfort' => $locale === 'en' ? 'Comfort' : 'Comodidad',
    ];
    ?>

    <?php foreach ($labels as $name => $label): ?>
        <div style="margin: 14px 0;">
            <label><b><?= esc($label) ?></b></label><br>
            <select name="<?= esc($name) ?>" required>
                <option value="">--</option>
                <?php for ($i=1; $i<=5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
    <?php endforeach; ?>

    <div style="margin: 14px 0;">
        <label><b><?= $locale === 'en' ? 'Comment (optional)' : 'Comentario (opcional)' ?></b></label><br>
        <textarea name="comment" rows="4" style="width:100%;"></textarea>
    </div>

    <button type="submit" style="padding:10px 14px;">
        <?= $locale === 'en' ? 'Submit review' : 'Enviar reseña' ?>
    </button>
</form>
</body>
</html>