<?php
namespace Cisse\CategorieProduitPoo\Model\Repositorie;
use Cisse\CategorieProduitPoo\Core\Database;
use Cisse\CategorieProduitPoo\Model\Entity\Produit as P;
use Cisse\CategorieProduitPoo\Model\DTO\ProduitFilterDTO as PFDTO;
use Cisse\CategorieProduitPoo\Core\Debug as DD;

class ProduitRepository
{
    public static function getAllProduits(PFDTO $dto): array
    {
        $sql = "SELECT p.libelle, p.prix, p.quantiteStock as quantitestock, c.nom 
                FROM produits p 
                INNER JOIN categories c ON c.id = p.categorie_id";

        $jockers = [];
        if ($dto->categorie !== null) {
            $sql .= " WHERE p.categorie_id = :id";
            $jockers['id'] = $dto->categorie;
        }
        $sql .= " LIMIT :limit OFFSET :offset";
        $jockers['limit'] = $dto->limite;
        $jockers['offset'] = $dto->offset;
        $results = Database::executeQuery($sql, $jockers, false);
        //DD::dd($results);
        $produits = array_map(
            fn($result) => P::toEntity($result),
            $results
        );
        //DD::dd($produits);
        return $produits;
    }
    public static function nbrProduit(PFDTO $dto): int
    {
        $sql = "SELECT COUNT(*) as total FROM produits p INNER JOIN categories c ON c.id = p.categorie_id";

        $jockers = [];
        if ($dto->categorie !== null) {
            $sql .= " WHERE p.categorie_id = :id";
            $jockers['id'] = $dto->categorie;
        }

        $result = Database::executeQuery($sql, $jockers, false);
        //DD::dd($result);
        return $result ? (int) $result[0]->total : 0;
    }
    public static function saveProduit(array $produit): int
    {
        $sql = "INSERT INTO produits (libelle, prix, quantiteStock, categorie_id)
                VALUES(:libelle, :prix, :quantiteStock, :categorie_id)   RETURNING id";

        $stmt = Database::executeUpdate($sql, [
            'libelle' => $produit['libelle'],
            'prix' => $produit['prix'],
            'quantiteStock' => $produit['quantiteStock'],
            'categorie_id' => $produit['categorie_id']
        ]);
        //DD::dd($stmt);

        return $stmt;

    }
}