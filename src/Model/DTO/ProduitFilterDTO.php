<?php

namespace Cisse\CategorieProduitPoo\Model\DTO;

class ProduitFilterDTO {
    public function __construct(
        public int $limite,
        public int $offset,
        public ?int $categorie = null
    ){}
}