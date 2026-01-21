
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'frais forfait') ?></title>
    <link rel="stylesheet" href="../css/app.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
</head>
<body>
    <div class="topbar">
        <h1 style="margin:0;">Liste des Frais forfaits</h1>
        <a class="button" href="./dashboard">Dashboard</a>
        <a class="button" href="./logout">Se déconnecter</a>
        <a class="button" href="./fraisforfait/create">Inserer</a>
        
    </div>

    <?php if (!empty($message)): ?>
        <div class="flash"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (empty($fraisforfaits)): ?>
        <p>Aucun frais forfait trouvé.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>montant</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fraisforfaits as $frais): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$frais['id']) ?></td>
                        <td><?= htmlspecialchars((string)$frais['libelle']) ?></td>
                        <td><?= htmlspecialchars((string)$frais['montant']) ?></td>
                        <td>
                       <a href="./fraisforfait/<?= $frais['id'] ?>">Voir</a>
    |
                        <a href="./fraisforfait/<?= $frais['id'] ?>/update">Modifier</a>
                         <form method="post"
                         action="./fraisforfait/<?= (int)$frais['id'] ?>/delete"
                         style="display:inline"
                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce frais forfait ?');">
                        <button type="submit">Supprimer</button>
                        </form>
                        </td>
                              
                            
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>