<?php
namespace Controllers;

use Core\Controller;
use Models\fichefrais;

final class fichefraisController extends Controller
{

    public function index(): void
    {
        $fiches = fichefrais::findAll();

        $this->render('fichefrais/index', [
            'title' => 'Liste des fiches de frais',
            'fiches' => $fiches
        ]);
    }

    public function show(string $idVisiteur, string $mois): void
    {
        $fiche = fichefrais::findById($idVisiteur, $mois);

        $this->render('fichefrais/show', [
            'fiche' => $fiche
        ]);
    }

    public function create(): void
    {
        $this->render('fichefrais/create');
    }

    public function store(): void
    {
        $IDvisiteur = $_SESSION['uid'];

        $mois = $_POST['mois'];
        $nbrJustificatifs = (int) $_POST['nbrJustificatifs'];
        $montantValide = (float) $_POST['montantValide'];

        fichefrais::create(
            $IDvisiteur,
            $mois,
            $nbrJustificatifs,
            $montantValide,
            'CR'
        );

        $this->redirect('./fichefrais');
    }

    public function update(string $idVisiteur, string $mois): void
    {
        $fiche = fichefrais::findById($idVisiteur, $mois);

        $this->render('fichefrais/update', [
            'fiche' => $fiche
        ]);
    }

    public function save(string $idVisiteur, string $mois): void
    {
        $nbrJustificatifs = (int) $_POST['nbrJustificatifs'];
        $montantValide = (float) $_POST['montantValide'];

        fichefrais::update(
            $idVisiteur,
            $mois,
            $nbrJustificatifs,
            $montantValide,
            'VA'
        );

        $this->redirect('../../fichefrais');
    }

    public function delete(string $idVisiteur, string $mois): void
    {
        fichefrais::delete($idVisiteur, $mois);

        $this->redirect(BASE_URL . 'fichefrais');
    }
}