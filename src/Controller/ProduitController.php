<?php

namespace Cisse\CategorieProduitPoo\Controller;

use Cisse\CategorieProduitPoo\Model\Repositorie\CategorieRepository as CR;
use Cisse\CategorieProduitPoo\Model\Repositorie\ProduitRepository as PR;
use Cisse\CategorieProduitPoo\Model\DTO\ProduitFilterDTO as PFDTO;
use Cisse\CategorieProduitPoo\Core\Request as R;
use Cisse\CategorieProduitPoo\Core\RenderView as RV;
use Cisse\CategorieProduitPoo\Core\Debug as DD;

class ProduitController
{
    public static function liste(): void
    {
        $page = R::get('page') ? (int) R::get('page') : 1;

        if($page < 1)
        {
            $page = 1;
        }

        $limit = 5;
        $offset = ($page - 1) * $limit;
        
        $categorieRepository = CR::getAllCategories();
        
        //DD::dd($categorieRepository);
        $categorieId = !empty(R::get('categorie')) && R::get('categorie') !== 'Toutes les catégories' ? trim(R::get('categorie')) :  null;

        $filter = new PFDTO($limit, $offset, $categorieId);
        $produits = PR::getAllProduits($filter);

        $nbrProduits = PR::nbrProduit($filter);
        //DD::dd($nbrProduits);
        $nbrPage = max(1, (int)CEIL($nbrProduits / $limit));
        //DD::dd($nbrPage);
        if($page > $nbrPage)
        {
            $page = $nbrPage;
        }

        //DD::dd($produits);

        RV::renderView('Liste',
                [
                    'produits'=>$produits,
                    'categorieRepository'=>$categorieRepository,
                    'categorieId'=>$categorieId,
                    'page'=>$page,
                    'nbrPage'=>$nbrPage
                ]
        );
    }
    public static function enregistrerProduit()
    {
        $categorieRepository = CR::getAllCategories();

        if(R::isPost())
        {
            $produit = 
            [
                'libelle'=>R::post('libelle'),
                'prix'=>R::post('prix'),
                'quantiteStock'=>R::post('quantiteStock'),
                'categorie_id'=>R::post('categorie_id')
            ];

            PR::saveProduit($produit);
            header("Location: http://localhost:8000/");
            exit;
        }

        RV::renderView('AjoutProduit',
                [
                    'categorieRepository'=>$categorieRepository
                ]
        );
    } 
}