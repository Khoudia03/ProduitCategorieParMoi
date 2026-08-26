<?php
namespace Cisse\CategorieProduitPoo\Model\Repositorie;
use Cisse\CategorieProduitPoo\Core\Database;
use Cisse\CategorieProduitPoo\Model\Entity\Produit as P;
use Cisse\CategorieProduitPoo\Core\Debug as DD;

class ProduitRepository
{
    public static function getAllProduits(int $limite, int $offset, int $categorie = null): array
    {
        $sql = "SELECT p.libelle, p.prix, p.quantiteStock as quantitestock, c.nom 
                FROM produits p 
                INNER JOIN categories c ON c.id = p.categorie_id";

        $jockers = [];
        if ($categorie !== null) {
            $sql .= " WHERE p.categorie_id = :id";
            $jockers['id'] = $categorie;
        }
        $sql .= " LIMIT :limit OFFSET :offset";
        $jockers['limit'] = $limite;
        $jockers['offset'] = $offset;
        $results = Database::executeQuery($sql, $jockers, false);
        //DD::dd($results);
        $produits = [];
        foreach ($results as $result) {
            $produits[] = P::toEntity($result);
        }
        //DD::dd($produits);
        return $produits;
    }
    public static function nbrProduit(int $limite, int $offset, int $categorie = null): int
    {
        $sql = "SELECT COUNT(*) as total FROM produits p INNER JOIN categories c ON c.id = p.categorie_id";

        $jockers = [];
        if ($categorie !== null) {
            $sql .= " WHERE p.categorie_id = :id";
            $jockers['id'] = $categorie;
        }

        $sql .= " LIMIT :limit OFFSET :offset";
        $jockers['limit'] = $limite;
        $jockers['offset'] = $offset;
        $result = Database::executeQuery($sql, $jockers, false);
        //DD::dd($result);
        return $result ? (int) $result->total : 0;
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