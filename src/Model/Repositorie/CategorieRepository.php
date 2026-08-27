<?php

namespace Cisse\CategorieProduitPoo\Model\Repositorie;

use Cisse\CategorieProduitPoo\Core\Database;
use Cisse\CategorieProduitPoo\Model\Entity\Categorie as C;
use Cisse\CategorieProduitPoo\Core\Debug as DD;

class CategorieRepository
{
    public static function getAllCategories(): array
    {
        $sql = "SELECT id, nom FROM categories";

        $resultats = Database::query($sql, false);
        
        $categories = array_map(
            fn($result) => C::toEntity($result),
            $resultats
        );
        //DD::dd($categories);
        return $categories;
    }
}