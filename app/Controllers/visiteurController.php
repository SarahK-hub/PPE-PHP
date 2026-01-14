<?php
namespace Controllers;

use Core\Controller;
use Models\visiteur;

final class visiteurController extends Controller
{
    public function index(): void
    {
        if (empty($_SESSION['uid'])) {
            $this->redirect('/');
        }

        // 🆕 Récupération critère de recherche
        $search = trim($_GET['q'] ?? '');
$search = str_replace(['%', '_'], ['\%', '\_'], $search); // échappe les jokers
$searchLike = "%$search%";

        try {
            // 🆕 Si recherche → filtrer
            if ($search !== '') {
                $visiteurs = visiteur::findBySearch($search);
            } else {
                $visiteurs = visiteur::findAll();
            }
        } catch (\Throwable $e) {
            $_SESSION['flash'] = 'Impossible de charger les visiteurs.';
            var_dump($visiteurs);
            $visiteurs = [];
            
        }

        $this->render('visiteur/index', [
            'title'     => 'Liste des visiteurs',
            'visiteurs' => $visiteurs,
            'search'    => $search, // 🆕 pour réafficher la recherche
            'message'   => $_SESSION['flash'] ?? '',
        ]);

        unset($_SESSION['flash']);
    }


    public function show($id): void
    {
        if (empty($_SESSION['uid'])) {
            $this->redirect('/');
        }

        $id = (int)$id;

        try {
            $visiteur = visiteur::findById($id);

            if (!$visiteur) {
                http_response_code(404);
                $_SESSION['flash'] = 'visiteur introuvable.';
                $this->redirect('/visiteur');
            }
        } catch (\Throwable $e) {
            $_SESSION['flash'] = 'Erreur lors du chargement du visiteur.';
            $visiteur = null;
        }

        $this->render('visiteur/show', [
            'title'    => 'Détail du visiteur',
            'visiteur' => $visiteur,
            'message'  => $_SESSION['flash'] ?? '',
        ]);

        unset($_SESSION['flash']);
    }
    public function create(): void
{
    if (empty($_SESSION['uid'])) {
        $this->redirect('/');
    }

    $this->render('visiteur/create', [
        'title'   => 'Créer un visiteur',
        'message' => $_SESSION['flash'] ?? '',
        'old'     => $_SESSION['old'] ?? [
            'nom' => '',
            'prenom' => '',
            'adresse' => '',
            'ville' => '',
            'CP' => '',
            'date_embauche' => '',
            'login' => '',
            'mdp' => '',
        ],
        'errors'  => $_SESSION['errors'] ?? [],
    ]);

    unset($_SESSION['flash'], $_SESSION['old'], $_SESSION['errors']);
}


   public function store(): void
{
    if (empty($_SESSION['uid'])) {
        $this->redirect('/');
    }

    $nom            = trim($_POST['nom'] ?? '');
    $prenom         = trim($_POST['prenom'] ?? '');
    $adresse        = trim($_POST['adresse'] ?? '');
    $ville          = trim($_POST['ville'] ?? '');
    $CP             = trim($_POST['CP'] ?? '');
    $date_embauche  = trim($_POST['date_embauche'] ?? '');
    $mdp            = trim($_POST['mdp'] ?? '');
    $login          = trim($_POST['login'] ?? '');

    $errors = [];

    // Nom
    if ($nom === '') {
        $errors['nom'] = 'Le nom est obligatoire.';
    } elseif (mb_strlen($nom) > 100) {
        $errors['nom'] = 'Le nom ne doit pas dépasser 100 caractères.';
    }

    // Prénom
    if ($prenom === '') {
        $errors['prenom'] = 'Le prénom est obligatoire.';
    }

    // Adresse
    if ($adresse === '') {
        $errors['adresse'] = 'L’adresse est obligatoire.';
    }

    // Ville
    if ($ville === '') {
        $errors['ville'] = 'La ville est obligatoire.';
    }

    // Code postal
    if ($CP === '') {
        $errors['CP'] = 'Le code postal est obligatoire.';
    } elseif (!preg_match('/^\d{5}$/', $CP)) {
        $errors['CP'] = 'Le code postal doit contenir 5 chiffres.';
    }

    // Date d'embauche
    if ($date_embauche === '') {
        $errors['date_embauche'] = 'La date d’embauche est obligatoire.';
    }

    //login
    if ($login === '') {
        $errors['login'] = 'Le login est obligatoire.';
    }
    // mot de passe
    if ($mdp === '') {
        $errors['mdp'] = 'Le mot de passe est obligatoire.';
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = compact(
            'nom',
            'prenom',
            'adresse',
            'ville',
            'CP',
            'date_embauche',
            'mdp',
            'login'
        );
        $_SESSION['flash'] = 'Merci de corriger les erreurs du formulaire.';
        $this->redirect('/visiteur/create');
    }

    try {
        \Models\Visiteur::create(
            $nom,
            $prenom,
            $adresse,
            $ville,
            $CP,
            $date_embauche,
            $login,
            $mdp
            
        );

        $_SESSION['flash'] = 'Visiteur créé avec succès.';
        $this->redirect('./visiteur');
    } catch (\Throwable $e) {
        $_SESSION['flash'] = 'Impossible de créer le visiteur.';
        $this->redirect('/visiteur/create');
    }
}



}
