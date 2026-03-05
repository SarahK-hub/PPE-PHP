<?php
namespace Controllers;

use Core\Controller;
use DateTime;
use Models\fichefrais;

class FicheFraisController extends Controller
{
    public function index()
    {
        $model = new FicheFrais();
        $fiches = $model->getAll();
        $this->render('fichefrais/index', compact('fiches'));
    }

    public function create()
    {
        $this->render('fichefrais/create');
    }

    public function store()
    {
        $data = [
            'idVisiteur' => $_SESSION['user']['id'],
            'mois' => $_POST['mois'],
            'nbJustificatifs' => $_POST['nbJustificatifs'],
            'montantValide' => $_POST['montantValide']
        ];

        $model = new FicheFrais();

        if ($model->create($data)) {
            header('Location: ' . BASE_URL . 'fichefrais');
            exit;
        }

        die("Impossible de créer la fiche");
    }

    public function edit($idVisiteur, $mois)
    {
        $model = new FicheFrais();
        $fiche = $model->find($idVisiteur, $mois);
        $this->render('fichefrais/edit', compact('fiche'));
    }

    public function update($idVisiteur, $mois)
    {
        $data = [
            'idVisiteur' => $idVisiteur,
            'mois' => $mois,
            'nbJustificatifs' => $_POST['nbJustificatifs'],
            'montantValide' => $_POST['montantValide']
        ];

        $model = new FicheFrais();
        $model->update($data);

        header('Location: ' . BASE_URL . 'fichefrais');
        exit;
    }

    public function delete($idVisiteur, $mois)
    {
        $model = new FicheFrais();
        $model->delete($idVisiteur, $mois);

        header('Location: ' . BASE_URL . 'fichefrais');
        exit;
    }
}

