<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'nom') ?></title>
    <style>
        .card {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    max-width: 420px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.card p {
    margin: 8px 0;
    font-size: 15px;
}
    </style>
</head>
<body>
    <h1>Détail du visiteur</h1>

    <?php if (!empty($message)): ?>
        <div class="flash"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (!empty($visiteur)): ?>
        <div class="card">
           <p><strong>ID :</strong> <?= htmlspecialchars($visiteur['ID']) ?></p>
           <p><strong>Nom :</strong> <?= htmlspecialchars($visiteur['NOM']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($visiteur['PRENOM']) ?></p>
            
        
        </div>
        <a class="button" href="../visiteur">⬅ Retour à la liste</a>
    <?php else: ?>
        <p>visiteur introuvable.</p>
        <a class="button" href="../visiteur">Retour à la liste</a>
    <?php endif; ?>
</body>
</html>