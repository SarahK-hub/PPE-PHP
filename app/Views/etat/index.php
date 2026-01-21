
<!doctype html>
<html lang="fr">
<head>
    
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'États') ?></title>
    <link rel="stylesheet" href="../css/app.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
    <div class="topbar">
        <h1 style="margin:0;">Liste des États</h1>
        <a class="button" href="./dashboard">Dashboard</a>
        <a class="button" href="./logout">Se déconnecter</a>
        <a class="button" href="./etat/create">Inserer</a>
       
         
    </div>

     <?php if (!empty($message)): ?>
        <div class="flash"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (empty($etats)): ?>
        <p>Aucun état trouvé.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Actions</th>
                </tr>
            </thead>
          <tbody>
<?php foreach ($etats as $etat): ?>
    <tr>
        <td><?= htmlspecialchars((string)$etat['id']) ?></td>
        <td><?= htmlspecialchars((string)$etat['libelle']) ?></td>
        <td>
            <a href="./etat/<?= (int)$etat['id'] ?>/update">Modifier</a>

            <form method="post"
                  action="./<?= (int)$etat['id'] ?>/delete"
                  style="display:inline"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer cet état ?');">
                <button type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>

               
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>