<?php

namespace Cisse\CategorieProduitPoo\Model\Entity;

class Categorie {
    private ?int $id = null;
    private string $nom;

    public function __construct(string $nom, ?int $id = null)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }
    public static function toEntity(\stdClass $obj) : self
    {
        return new self
        (
            nom: $obj->nom,
            id: $obj->id
        );
    }
}