<?php
namespace Models;

use Config\Database;
use DateTime;


  class FicheFrais
{
    protected $table = 'fichefrais';

    public function getAll()
    {
        return $this->db->query(
            "SELECT ff.*, e.libelle AS etat
             FROM fichefrais ff
             JOIN etat e ON ff.idEtat = e.id
             ORDER BY ff.mois DESC"
        )->fetchAll();
    }

    public function find($idVisiteur, $mois)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM fichefrais WHERE idVisiteur = ? AND mois = ?"
        );
        $stmt->execute([$idVisiteur, $mois]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO fichefrais
            (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat)
            VALUES (?, ?, ?, ?, CURDATE(), ?)"
        );

        return $stmt->execute([
            $data['idVisiteur'],
            $data['mois'],
            $data['nbJustificatifs'],
            $data['montantValide'],
            'CR' // état créé
        ]);
    }

    public function update($data)
    {
        $stmt = $this->db->prepare(
            "UPDATE fichefrais
             SET nbJustificatifs = ?, montantValide = ?, dateModif = CURDATE()
             WHERE idVisiteur = ? AND mois = ?"
        );

        return $stmt->execute([
            $data['nbJustificatifs'],
            $data['montantValide'],
            $data['idVisiteur'],
            $data['mois']
        ]);
    }

    public function delete($idVisiteur, $mois)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM fichefrais WHERE idVisiteur = ? AND mois = ?"
        );
        return $stmt->execute([$idVisiteur, $mois]);
    }
}
