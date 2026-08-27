<?php

namespace Cisse\CategorieProduitPoo\Core;

class RenderView {
    public static function renderView(string $vue, array $donnees = []): void
    {
        require_once dirname(__DIR__)."/View/{$vue}.html.php";
    }
}