<?php
// Variables disponibles :
// $title   : titre de la page ("Créer un frais forfait")
// $message : message flash éventuel
// $old     : valeurs précédentes du formulaire (['libelle' => '...'])
// $errors  : erreurs de validation (['libelle' => '...'])
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Modifier un frais forfait', ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="/PPE-main/public/css/app.css">
</head>
<body>

    <h1><?= htmlspecialchars($title ?? 'Modifier un frais forfait', ENT_QUOTES, 'UTF-8'); ?></h1>

    <?php if (!empty($message)): ?>
        <div class="flash">
            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

      <form method="post" action="./fraisforfait/<?= $fraisforfait['id'] ?>/update">

    <div class="field">
        <label for="libelle">Libellé</label>
        <input
            type="text"
            name="libelle"
            id="libelle"
            value="<?= htmlspecialchars($old['libelle'] ?? '', ENT_QUOTES); ?>"
            required
        >
        <?php if (!empty($errors['libelle'])): ?>
            <div class="error"><?= htmlspecialchars($errors['libelle']); ?></div>
        <?php endif; ?>
    </div>

    <div class="field">
        <label for="montant">Montant</label>
        <input
            type="text"
            name="montant"
            id="montant"
            value="<?= htmlspecialchars($old['montant'] ?? '', ENT_QUOTES); ?>"
            required
        >
        <?php if (!empty($errors['montant'])): ?>
            <div class="error"><?= htmlspecialchars($errors['montant']); ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Enregistrer</button>
    <a href="./fraisforfait">Annuler</a>
</form>
        

</body>
</html>