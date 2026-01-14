
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'visiteur') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Arial, sans-serif;
    margin: 24px;
    background: #eef1f5;
    color: #2b2b2b;
}

h1 {
    margin: 0;
    font-weight: 600;
}

.topbar {
    margin-bottom: 24px;
    display: flex;
    gap: 14px;
    align-items: center;
}

.button {
    display: inline-block;
    padding: 7px 14px;
    background: #ffffff;
    border: 1px solid #d3d3d3;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    font-size: 14px;
    transition: 0.25s ease;
}

.button:hover {
    background: #f3f3f3;
    border-color: #bbbbbb;
}

/* MESSAGE ERREUR */
.flash {
    padding: 10px 14px;
    background: #ffe6e6;
    border: 1px solid #ffb3b3;
    color: #a10000;
    border-radius: 6px;
    margin-bottom: 16px;
}

/* FORMULAIRE */
form {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
}

input[type="text"] {
    padding: 9px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    width: 260px;
    background: #fff;
    transition: 0.25s;
}

input[type="text"]:focus {
    border-color: #7a9cff;
    outline: none;
    box-shadow: 0 0 0 3px #dce5ff;
}

/* TABLEAU */
table {
    border-collapse: collapse;
    width: 100%;
    max-width: 940px;
    background: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

th {
    background: #f6f7fb;
    padding: 12px 14px;
    font-weight: 600;
    font-size: 14px;
    color: #444;
    border-bottom: 1px solid #e5e7eb;
}

td {
    padding: 12px 14px;
    border-bottom: 1px solid #f0f0f0;
}

tbody tr:hover {
    background: #f8faff;
}
    </style>
</head>
<body>
    <div class="topbar">
    <h1 style="margin:0;">Liste des visiteurs</h1>
    <a class="button" href="./dashboard">Dashboard</a>
    <a class="button" href="./logout">Se déconnecter</a>
    <a class="button" href="./visiteur/create">créer un visiteur</a>
</div>

<!-- 🆕 Formulaire de recherche -->
<form action="" method="get" style="margin-bottom:16px;">
    <input 
        type="text" 
        name="q"
        placeholder="Rechercher par nom"
        value="<?= htmlspecialchars($search ?? '') ?>"
        style="padding:6px; width:220px;"
    >
    <button type="submit" class="button">Rechercher</button>
</form>
 <?php if (!empty($message)): ?>
        <div class="flash"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

   <?php if (empty($visiteurs)): ?>
    <p>Aucun visiteur trouvé.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($visiteurs as $v): ?>
                <tr>
                    <td><?= htmlspecialchars($v['ID']) ?></td>
                    <td><?= htmlspecialchars($v['NOM']) ?></td>
                    <td><?= htmlspecialchars($v['PRENOM']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>