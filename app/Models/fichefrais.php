<?php
namespace Models;

use Config\Database;
use DateTime;

final class fichefrais
{
    /* =================== FIND ALL =================== */
    public static function findAll(): array
{

    $pdo = Database::get();

    $sql = "
        SELECT 
            ff.IDvisiteur,
            ff.mois,
            ff.nbrJustificatifs,
            ff.montantValide,
            ff.dateModif,
            ff.idEtat,
            e.libelle AS etat_libelle
        FROM fichefrais ff
        JOIN etat e ON e.id = ff.idEtat
        ORDER BY ff.mois DESC
    ";

    return $pdo->query($sql)->fetchAll();
}

    /* =================== FIND BY ID =================== */
    public static function findById(int $IDvisiteur, int $mois): ?array
{
    $pdo = Database::get();

    $sql = "
        SELECT 
            ff.IDvisiteur,
            ff.mois,
            ff.nbrJustificatifs,
            ff.montantValide,
            ff.dateModif,
            ff.idEtat,
            e.libelle AS etat_libelle
        FROM fichefrais ff
        JOIN etat e ON e.id = ff.idEtat
        WHERE ff.IDvisiteur = :IDvisiteur
          AND ff.mois = :mois
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'IDvisiteur' => $IDvisiteur,
        'mois'       => $mois
    ]);

    return $stmt->fetch() ?: null;
}


    /* =================== CREATE =================== */
    public static function create(
    int $IDvisiteur,
    int $mois,
    int $nbrJustificatifs,
    float $montantValide,
    DateTime $dateModif,
    int $idEtat
): bool
{
    $pdo = Database::get();

    $sql = "
        INSERT INTO fichefrais (
            IDvisiteur,
            mois,
            nbrJustificatifs,
            montantValide,
            dateModif,
            idEtat
        ) VALUES (
            :IDvisiteur,
            :mois,
            :nbrJustificatifs,
            :montantValide,
            :dateModif,
            :idEtat
        )
    ";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        'IDvisiteur'        => $IDvisiteur,
        'mois'              => $mois,
        'nbrJustificatifs'  => $nbrJustificatifs,
        'montantValide'     => $montantValide,
        'dateModif'         => $dateModif->format('Y-m-d'),
        'idEtat'            => $idEtat
    ]);
}

    /* =================== UPDATE =================== */
    public static function update(
        int $IDvisiteur,
        int $mois,
        int $nbrJustificatifs,
        float $montantValide,
        DateTime $dateModif,
        int $idEtat,
        int $idLigneFraisHorsForfait
    ): bool {
        $pdo = Database::get();

        $sql = "
            UPDATE fichefrais
            SET
                nbrJustificatifs = :nbrJustificatifs,
                montantValide = :montantValide,
                dateModif = :dateModif,
                idEtat = :idEtat,
                idLigneFraisHorsForfait = :idLigneFraisHorsForfait
            WHERE IDvisiteur = :IDvisiteur
              AND mois = :mois
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'nbrJustificatifs'        => $nbrJustificatifs,
            'montantValide'           => $montantValide,
            'dateModif'               => $dateModif->format('Y-m-d'),
            'idEtat'                  => $idEtat,
            'idLigneFraisHorsForfait' => $idLigneFraisHorsForfait,
            'IDvisiteur'              => $IDvisiteur,
            'mois'                    => $mois
        ]);
    }

    /* =================== DELETE =================== */
    public static function delete(int $IDvisiteur, int $mois): bool
    {
        $pdo = Database::get();

        $sql = "
            DELETE FROM fichefrais
            WHERE IDvisiteur = :IDvisiteur
              AND mois = :mois
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'IDvisiteur' => $IDvisiteur,
            'mois'       => $mois
        ]);
    }
}
