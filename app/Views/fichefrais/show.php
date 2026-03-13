<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Détail fiche frais</title>

<style>

body{
font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
background:#f0f2f5;
padding:20px
}

.card{
background:white;
padding:25px;
border-radius:8px;
box-shadow:0 4px 10px rgba(0,0,0,.05);
max-width:500px
}

a.button{
display:inline-block;
margin-top:15px;
padding:10px 14px;
background:#3498db;
color:white;
border-radius:6px;
text-decoration:none
}

a.button:hover{
background:#2980b9
}

</style>

</head>

<body>

<h1>Détail de la fiche de frais</h1>

<?php if(empty($fiche)): ?>

<p>Fiche introuvable.</p>

<a class="button" href="<?= BASE_URL ?>fichefrais">Retour</a>

<?php else: ?>

<div class="card">

<p>

<strong>Visiteur :</strong>

<?= htmlspecialchars($fiche['IDvisiteur'] ?? '') ?>

</p>

<p>

<strong>Mois :</strong>

<?php
$mois = $fiche['mois'] ?? '';
$moisAffichage = substr($mois,4,2).'/'.substr($mois,0,4);
?>

<?= htmlspecialchars($moisAffichage) ?>

</p>

<p>

<strong>Nombre justificatifs :</strong>

<?= htmlspecialchars($fiche['nbrJustificatifs'] ?? '') ?>

</p>

<p>

<strong>Montant validé :</strong>

<?= htmlspecialchars($fiche['montantValide'] ?? '') ?> €

</p>

<p>

<strong>Etat :</strong>

<?= htmlspecialchars($fiche['etat'] ?? '') ?>

</p>

<p>

<strong>Date modification :</strong>

<?= htmlspecialchars($fiche['dateModif'] ?? '') ?>

</p>

</div>

<a class="button" href="<?= BASE_URL ?>fichefrais">Retour à la liste</a>

<?php endif ?>

</body>
</html>