<?php

namespace App\Entity;

use App\Repository\PanierQteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierQteRepository::class)]
class PanierQte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'panierQtes')]
    private ?Vin $vin = null;

    #[ORM\ManyToOne(inversedBy: 'panierQtes')]
    private ?Panier $panier = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVin(): ?Vin
    {
        return $this->vin;
    }

    public function setVin(?Vin $vin): static
    {
        $this->vin = $vin;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): static
    {
        $this->panier = $panier;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): void
    {
        $this->quantite = $quantite;
    }

}
