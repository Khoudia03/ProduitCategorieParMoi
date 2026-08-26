<?php
namespace Cisse\CategorieProduitPoo\Model\Entity;
class Produit
{
    private ?int $id = null;
    private string $libelle;
    private float $prix;
    private int $quantitestock;
    private Categorie $categorie_id;

    public function __construct(string $libelle, float $prix, int $quantitestock, Categorie $categorie_id, ?int $id = null)
    {
        $this->libelle = $libelle;
        $this->prix = $prix;
        $this->quantitestock = $quantitestock;
        $this->categorie_id = $categorie_id;
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getLibelle(): string
    {
        return $this->libelle;
    }
    public function getPrix(): float
    {
        return $this->prix;
    }
    public function getQuantiteStock(): int
    {
        return $this->quantitestock;
    }
    public function geTCategorie_id(): Categorie
    {
        return $this->categorie_id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }
    public function setQuantiteStock(int $quantitestock): void
    {
        $this->quantitestock = $quantitestock;
    }
    public function setCategorie_id(Categorie $categorie_id): void
    {
        $this->categorie_id = $categorie_id;
    }
    public function getMontantStock(): float
    {
        return $this->prix * $this->quantitestock;
    }
    public function getStatut(): string
    {
        return $this->quantitestock <= 5
        ? 'En Rupture'
        : 'En Stock';
    }
    public static function toEntity(\stdClass $obj): self
    {
        return new self
        (
            libelle: $obj->libelle,
            prix: $obj->prix,
            quantitestock: $obj->quantitestock,
            categorie_id: Categorie::toEntity($obj),
            id: $obj->id
        );
    }
}