<?php
namespace Controllers;

use Core\Controller;
use DateTime;
use Models\fichefrais;

final class fichefraisController extends Controller
{
    /* =================== INDEX =================== */
    
    
    public function index(): void
{
    if (empty($_SESSION['uid'])) {
        $this->redirect('/');
    }

    $fiches = \Models\fichefrais::findAll();

    $this->render('fichefrais/index', [
        'title' => 'Liste des fiches de frais',
        'fiches' => $fiches,
        'message' => $_SESSION['flash'] ?? ''
    ]);

    unset($_SESSION['flash']);
}


    /* =================== SHOW =================== */
    public function show(int $mois): void
    {
        if (empty($_SESSION['uid'])) $this->redirect('/');

        $IDvisiteur = (int) $_SESSION['uid'];

        try {
            $fiche = fichefrais::findById($IDvisiteur, $mois);

            if (!$fiche) {
                $_SESSION['flash'] = 'Fiche de frais introuvable.';
                $this->redirect('/fichefrais');
            }
        } catch (\Throwable $e) {
            $_SESSION['flash'] = 'Erreur lors du chargement de la fiche.';
            $this->redirect('/fichefrais');
        }

        $this->render('fichefrais/show', [
            'title' => 'Détail de la fiche de frais',
            'fiche' => $fiche,
            'message' => $_SESSION['flash'] ?? '',
        ]);

        unset($_SESSION['flash']);
    }

    /* =================== CREATE =================== */
    public function create(): void
    {
        if (empty($_SESSION['uid'])) $this->redirect('/');

        $this->render('fichefrais/create', [
            'title'  => 'Créer une fiche de frais',
            'old'    => $_SESSION['old'] ?? [
                'mois' => '',
                'nbrJustificatifs' => '',
                'montantValide' => '',
                'idEtat' => '',
                'idLigneFraisHorsForfait' => ''
            ],
            'errors' => $_SESSION['errors'] ?? [],
            'message'=> $_SESSION['flash'] ?? '',
        ]);

        unset($_SESSION['flash'], $_SESSION['old'], $_SESSION['errors']);
    }

    /* =================== STORE =================== */
    public function store(): void
{
    if (empty($_SESSION['uid'])) {
        $this->redirect('/');
    }

    $mois = (int)($_POST['mois'] ?? 0);
    $nbrJustificatifs = (int)($_POST['nbrJustificatifs'] ?? 0);
    $montantValide = (float)($_POST['montantValide'] ?? 0);
    $idEtat = (int)($_POST['idEtat'] ?? 1); // par défaut "Créée"

    $errors = [];

    if ($mois === 0) $errors['mois'] = 'Le mois est obligatoire';

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        $this->redirect('./fichefrais/create');
    }

    try {
        fichefrais::create(
            $_SESSION['uid'],          // IDvisiteur
            $mois,
            $nbrJustificatifs,
            $montantValide,
            new DateTime(),
            $idEtat
        );

        $_SESSION['flash'] = 'Fiche de frais créée avec succès.';
        $this->redirect('./fichefrais');

    } catch (\Throwable $e) {
        // DEBUG TEMPORAIRE (IMPORTANT)
        error_log($e->getMessage());

        $_SESSION['flash'] = 'Impossible de créer la fiche.';
        $this->redirect('./fichefrais/create');
    }
}


    /* =================== UPDATE =================== */
    public function update(int $mois): void
    {
        if (empty($_SESSION['uid'])) $this->redirect('/');

        $IDvisiteur = (int) $_SESSION['uid'];
        $fiche = fichefrais::findById($IDvisiteur, $mois);

        if (!$fiche) {
            $_SESSION['flash'] = 'Fiche introuvable.';
            $this->redirect('/fichefrais');
        }

        $this->render('fichefrais/update', [
            'title' => 'Modifier la fiche de frais',
            'fiche' => $fiche,
            'old'   => $_SESSION['old'] ?? $fiche,
            'errors'=> $_SESSION['errors'] ?? [],
            'message'=> $_SESSION['flash'] ?? '',
        ]);

        unset($_SESSION['flash'], $_SESSION['old'], $_SESSION['errors']);
    }

    /* =================== SAVE =================== */
    public function save(int $mois): void
    {
        if (empty($_SESSION['uid'])) $this->redirect('/');

        $IDvisiteur = (int) $_SESSION['uid'];

        try {
            fichefrais::update(
                $IDvisiteur,
                $mois,
                (int)$_POST['nbrJustificatifs'],
                (float)$_POST['montantValide'],
                new DateTime(),
                (int)$_POST['idEtat'],
                (int)$_POST['idLigneFraisHorsForfait']
            );

            $_SESSION['flash'] = 'Fiche de frais modifiée avec succès.';
            $this->redirect('/fichefrais/' . $mois);

        } catch (\Throwable $e) {
            $_SESSION['flash'] = 'Impossible de modifier la fiche.';
            $this->redirect('/fichefrais/' . $mois . '/update');
        }
    }

    /* =================== DELETE =================== */
    public function delete(int $mois): void
    {
        if (empty($_SESSION['uid'])) $this->redirect('/');

        try {
            fichefrais::delete((int)$_SESSION['uid'], $mois);
            $_SESSION['flash'] = 'Fiche supprimée avec succès.';
        } catch (\Throwable $e) {
            $_SESSION['flash'] = 'Impossible de supprimer la fiche.';
        }

        $this->redirect('/fichefrais');
    }
}
