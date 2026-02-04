<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'Fiches de frais') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f0f2f5;color:#2c3e50;margin:0;padding:0 20px}

.topbar{display:flex;flex-wrap:wrap;gap:12px;align-items:center;margin:20px 0}
.topbar h1{margin:0;font-size:1.8rem;flex:1}

a.button,button,input[type=submit]{display:inline-block;padding:10px 16px;border-radius:6px;border:none;background:#3498db;color:#fff;font-weight:bold;cursor:pointer;text-decoration:none;transition:.3s,.2s}
a.button:hover,button:hover,input[type=submit]:hover{background:#2980b9;transform:translateY(-2px)}

.flash{padding:10px 15px;margin:15px 0;border-radius:6px;font-weight:bold}
.flash-success{background:#2ecc71;color:#fff}
.flash-error{background:#e74c3c;color:#fff}

table{width:100%;max-width:1000px;border-collapse:collapse;border-radius:6px;overflow:hidden;box-shadow:0 4px 8px rgba(0,0,0,.05);background:#fff}
th,td{padding:12px 15px;text-align:left}
th{background:#3498db;color:#fff;text-transform:uppercase;font-size:.9rem}
tr:nth-child(even){background:#f2f6fc}
tr:hover{background:#d6eaf8}
td a{color:#3498db;font-weight:bold;text-decoration:none}
td a:hover{text-decoration:underline}

form{max-width:500px;background:#fff;padding:20px;border-radius:6px;box-shadow:0 4px 10px rgba(0,0,0,.05);margin-bottom:30px}
.field{margin-bottom:15px}
label{display:block;margin-bottom:5px;font-weight:bold}
input[type=text],input[type=number],textarea{width:100%;padding:8px 12px;border-radius:6px;border:1px solid #ccc;font-size:1rem;box-sizing:border-box}
input:focus,textarea:focus{outline:none;border-color:#3498db}

.error{color:#e74c3c;font-size:.9rem;margin-top:4px}

@media(max-width:600px){
.topbar{flex-direction:column;align-items:flex-start}
table,th,td{font-size:.9rem}
input,button,a.button{width:100%;margin-bottom:10px}
td a{display:inline-block;margin-bottom:5px}
}
</style>

   

</head>
<body>

<div class="topbar">
    <h1>Liste des fiches de frais</h1>
    <a class="button" href="<?= BASE_URL ?>dashboard">Dashboard</a>
    <a class="button" href="<?= BASE_URL ?>logout">Déconnexion</a>
    <a class="button" href="<?= BASE_URL ?>fichefrais/create">Insérer</a>
</div>

<?php if (!empty($message)): ?>
    <div class="flash"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if (empty($fiches)): ?>
    <p>Aucune fiche trouvée.</p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th>Mois</th>
            <th>Justificatifs</th>
            <th>Montant</th>
            <th>État</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fiches as $fiche): ?>
            <tr>
                <td><?= htmlspecialchars($fiche['mois']) ?></td>
                <td><?= htmlspecialchars($fiche['nbrJustificatifs']) ?></td>
                <td><?= htmlspecialchars($fiche['montantValide']) ?></td>
                <td><?= htmlspecialchars($fiche['etat_libelle']) ?></td>

                <td>
                    <a class="button" href="<?= BASE_URL ?>fichefrais/<?= $fiche['mois'] ?>">Voir</a>
                    <a class="button" href="<?= BASE_URL ?>fichefrais/<?= $fiche['mois'] ?>/update">Modifier</a>

                    <form method="post"
                          action="<?= BASE_URL ?>fichefrais/<?= $fiche['mois'] ?>/delete"
                          style="display:inline"
                          onsubmit="return confirm('Supprimer cette fiche ?');">
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
