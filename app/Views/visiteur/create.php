<?php
// Variables disponibles :
// $title   : titre de la page ("Créer un visiteur")
// $message : message flash éventuel
// $old     : valeurs précédentes du formulaire (['nom' => '...'])
// $errors  : erreurs de validation (['nom' => '...'])
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Créer un visiteur', ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        .error { color: red; }
        .flash {
            background: #eef;
            padding: .5rem 1rem;
            margin-bottom: 1rem;
            border: 1px solid #99c;
        }
        .field { margin-bottom: 1rem; }
        label { display: block; margin-bottom: .3rem; }
        input { width: 300px; }
   
    </style>
</head>
<body>

<h1><?= htmlspecialchars($title ?? 'Créer un visiteur', ENT_QUOTES, 'UTF-8'); ?></h1>

<?php if (!empty($message)): ?>
    <div class="flash">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>
<form action="../visiteur/create" method="post">

    <!-- Nom -->
    <div class="field">
        <label for="nom">Nom</label>
        <input
            type="text"
            name="nom"
            id="nom"
            value="<?= htmlspecialchars($old['nom'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            required
        >
        <?php if (!empty($errors['nom'])): ?>
            <div class="error">
                <?= htmlspecialchars($errors['nom'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Prénom -->
    <div class="field">
        <label for="prenom">Prénom</label>
        <input
            type="text"
            name="prenom"
            id="prenom"
            value="<?= htmlspecialchars($old['prenom'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            required
        >
        <?php if (!empty($errors['prenom'])): ?>
            <div class="error">
                <?= htmlspecialchars($errors['prenom'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Adresse -->
    <div class="field">
        <label for="adresse">Adresse</label>
        <input
            type="text"
            name="adresse"
            id="adresse"
            value="<?= htmlspecialchars($old['adresse'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            required
        >
        <?php if (!empty($errors['adresse'])): ?>
            <div class="error">
                <?= htmlspecialchars($errors['adresse'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Ville -->
    <div class="field">
        <label for="ville">Ville</label>
        <input
            type="text"
            name="ville"
            id="ville"
            value="<?= htmlspecialchars($old['ville'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            required
        >
        <?php if (!empty($errors['ville'])): ?>
            <div class="error">
                <?= htmlspecialchars($errors['ville'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Code postal -->
    <div class="field">
        <label for="CP">Code postal</label>
        <input
            type="text"
            name="CP"
            id="CP"
            value="<?= htmlspecialchars($old['CP'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            required
        >
        <?php if (!empty($errors['CP'])): ?>
            <div class="error">
                <?= htmlspecialchars($errors['CP'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Date d'embauche -->
    <div class="field">
        <label for="date_embauche">Date d’embauche</label>
        <input
            type="date"
            name="date_embauche"
            id="date_embauche"
            value="<?= htmlspecialchars($old['date_embauche'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            required
        >
        <?php if (!empty($errors['date_embauche'])): ?>
            <div class="error">
                <?= htmlspecialchars($errors['date_embauche'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>
     <!-- mdp-->
    <div class="field">
        <label for="mdp">mot de passe</label>
        <input
            type="text"
            name="mdp"
            id="mdp"
            value="<?= htmlspecialchars($old['mdp'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            required
        >
        <?php if (!empty($errors['mdp'])): ?>
            <div class="error">
                <?= htmlspecialchars($errors['mdp'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>
     <!-- login -->
    <div class="field">
        <label for="login">Login</label>
        <input
            type="text"
            name="login"
            id="login"
            value="<?= htmlspecialchars($old['login'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            required
        >
        <?php if (!empty($errors['login'])): ?>
            <div class="error">
                <?= htmlspecialchars($errors['login'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>



    <button type="submit">Enregistrer</button>
    <a href="/visiteur">Annuler</a>

</form>

</body>
</html>

</html>