<?php 
namespace Models;
use Config\Database;

final class visiteur {

    public static function findAll(): array
    {
        $pdo = Database::get();
        $st  = $pdo->query('SELECT ID, NOM, PRENOM,ADRESSE,VILLE,CP,DATE_EMBAUCHE FROM visiteur');
        return $st->fetchAll();
    }

    public static function findById(int $id): ?array
    {
        $pdo = Database::get();
        $st  = $pdo->prepare('SELECT ID, NOM, PRENOM,ADRESSE,VILLE,CP,DATE_EMBAUCHE FROM visiteur WHERE id = :id');
        $st->execute(['id' => $id]);
        $row = $st->fetch();
        return $row ?: null;
    }

    /* 🆕 Recherche filtrée */
    public static function findBySearch(string $search): array
{
    $pdo = Database::get();

    // Nettoyage de la recherche pour éviter les espaces inutiles
    $search = trim($search);

    // On ajoute les jokers pour le LIKE
    $searchLike = '%' . $search . '%';

    // Requête SQL avec insensibilité à la casse
    $sql = "
        SELECT ID, NOM, PRENOM, ADRESSE, VILLE, CP, DATE_EMBAUCHE
        FROM visiteur
        WHERE NOM LIKE :s
           OR PRENOM LIKE :s
    ";

    $st = $pdo->prepare($sql);
  $st->bindValue(':s', $searchLike, \PDO::PARAM_STR);
  $st->execute();


    // Retourner un tableau associatif
    return $st->fetchAll(\PDO::FETCH_ASSOC);
}
public static function create( string $nom, string $prenom,string $adresse, string $ville, string $CP,string $date_embauche,string $login,string $mdp
): bool
{
    $pdo = Database::get();

    $st = "
        INSERT INTO visiteur (nom,prenom,adresse,ville, CP, date_embauche,login,mdp) 
        VALUES (:nom,:prenom,:adresse,:ville,:CP,:date_embauche,:login,:mdp)
    ";

    $stmt = $pdo->prepare($st);

    return $stmt->execute([
        'nom'            => $nom,
        'prenom'         => $prenom,
        'adresse'        => $adresse,
        'ville'          => $ville,
        'CP'             => $CP,
        'date_embauche'  => $date_embauche,
        'login'          => $login,
        'mdp'            => $mdp

    ]);
}

}



    
