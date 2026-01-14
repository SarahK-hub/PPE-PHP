
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'États') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Arial,sans-serif;margin:24px;}
        table{border-collapse:collapse;width:100%;max-width:900px;}
        th,td{border:1px solid #ddd;padding:8px;text-align:left;}
        th{background:#f6f6f6;}
        .topbar{margin-bottom:16px;display:flex;gap:12px;align-items:center;}
        .flash{color:#b30000;margin:8px 0;}
        a.button{display:inline-block;padding:6px 10px;border:1px solid #ccc;border-radius:6px;text-decoration:none;}
    </style>
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
                  action="./etat/<?= (int)$etat['id'] ?>/delete"
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