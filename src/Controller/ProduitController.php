<?php

namespace Cisse\CategorieProduitPoo\Controller;

use Cisse\CategorieProduitPoo\Model\Repositorie\CategorieRepository as CR;
use Cisse\CategorieProduitPoo\Model\Repositorie\ProduitRepository as PR;
use Cisse\CategorieProduitPoo\Core\Debug as DD;

class ProduitController
{
    public static function liste(): void
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        if($page < 1)
        {
            $page = 1;
        }

        $limit = 5;
        $offset = ($page - 1) * $limit;
        
        $categorieRepository = CR::getAllCategories();
        
        //DD::dd($categorieRepository);
        $categorieId = !empty($_GET['categorie']) && $_GET['categorie'] !== 'Toutes les catégories' ? trim($_GET['categorie']) :  null;

        $produits = PR::getAllProduits($limit,$offset,$categorieId);

        $nbrProduits = PR::nbrProduit($limit,$offset,$categorieId);
        $nbrPage = CEIL($nbrProduits / $limit);
        if($page > $nbrPage)
        {
            $page = $nbrPage;
        }

        //DD::dd($produits);

        require dirname(__DIR__) . "/View/Liste.html.php";
    }
    public static function enregistrerProduit()
    {
        $categorieRepository = CR::getAllCategories();

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $produit = 
            [
                'libelle'=>$_POST['libelle'],
                'prix'=>$_POST['prix'],
                'quantiteStock'=>$_POST['quantiteStock'],
                'categorie_id'=>$_POST['categorie_id']
            ];

            PR::saveProduit($produit);
            header("Location: http://localhost:8000/");
            exit;
        }

        require dirname(__DIR__) . "/View/AjoutProduit.html.php";
    } 
}