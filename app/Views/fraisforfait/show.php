<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'frais forfait') ?></title>
    <link rel="stylesheet" href="/PPE-main/public/css/app.css">
</head>
<body>
    <h1>Détail du frais forfait</h1>

    <?php if (!empty($message)): ?>
        <div class="flash"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (!empty($fraisforfait)): ?>
        <div class="card">
            <p><strong>ID :</strong> <?= htmlspecialchars($fraisforfait['id']) ?></p>
            <p><strong>Libellé :</strong> <?= htmlspecialchars($fraisforfait['libelle']) ?></p>
            <p><strong>montant :</strong> <?= htmlspecialchars($fraisforfait['montant']) ?></p>
        
        </div>
        <a class="button" href="../fraisforfait">⬅ Retour à la liste</a>
    <?php else: ?>
        <p>Frais forfait introuvable.</p>
        <a class="button" href="../fraisforfait">Retour à la liste</a>
    <?php endif; ?>
</body>
</html>