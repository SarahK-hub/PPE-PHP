<?php
namespace Models;

use Config\Database;
use DateTime;

final class fichefrais
{
    public static function findAll(): array
    {
        $pdo = Database::get();

        $sql = "
        SELECT ff.*, e.libelle AS etat
        FROM fichefrais ff
        JOIN etat e ON ff.idEtat = e.id
        ORDER BY ff.mois DESC
        ";

        return $pdo->query($sql)->fetchAll();
    }

    public static function findById(string $IDvisiteur, string $mois): ?array
    {
        $pdo = Database::get();

        $stmt = $pdo->prepare("
        SELECT ff.*, e.libelle AS etat
        FROM fichefrais ff
        JOIN etat e ON ff.idEtat = e.id
        WHERE ff.IDvisiteur = :IDvisiteur
        AND ff.mois = :mois
        ");

        $stmt->execute([
            'IDvisiteur' => $IDvisiteur,
            'mois' => $mois
        ]);

        $row = $stmt->fetch();

        return $row ?: null;
    }

    public static function create(
        string $IDvisiteur,
        string $mois,
        int $nbrJustificatifs,
        float $montantValide,
        string $idEtat
    ): bool
    {
        $pdo = Database::get();

        $stmt = $pdo->prepare("
        INSERT INTO fichefrais
        (IDvisiteur, mois, nbrJustificatifs, montantValide, dateModif, idEtat)
        VALUES
        (:IDvisiteur, :mois, :nbrJustificatifs, :montantValide, NOW(), :idEtat)
        ");

        return $stmt->execute([
            'IDvisiteur' => $IDvisiteur,
            'mois' => $mois,
            'nbrJustificatifs' => $nbrJustificatifs,
            'montantValide' => $montantValide,
            'idEtat' => $idEtat
        ]);
    }

    public static function update(
        string $IDvisiteur,
        string $mois,
        int $nbrJustificatifs,
        float $montantValide,
        string $idEtat
    ): bool
    {
        $pdo = Database::get();

        $stmt = $pdo->prepare("
        UPDATE fichefrais
        SET nbrJustificatifs = :nbrJustificatifs,
            montantValide = :montantValide,
            idEtat = :idEtat,
            dateModif = NOW()
        WHERE IDvisiteur = :IDvisiteur
        AND mois = :mois
        ");

        return $stmt->execute([
            'nbrJustificatifs' => $nbrJustificatifs,
            'montantValide' => $montantValide,
            'idEtat' => $idEtat,
            'IDvisiteur' => $IDvisiteur,
            'mois' => $mois
        ]);
    }

    public static function delete(string $IDvisiteur, string $mois): bool
    {
        $pdo = Database::get();

        $stmt = $pdo->prepare("
        DELETE FROM fichefrais
        WHERE IDvisiteur = :IDvisiteur
        AND mois = :mois
        ");

        return $stmt->execute([
            'IDvisiteur' => $IDvisiteur,
            'mois' => $mois
        ]);
    }
}