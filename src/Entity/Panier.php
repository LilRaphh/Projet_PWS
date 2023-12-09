<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'panier', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: PanierQte::class)]
    private Collection $panierQtes;

    public function __construct()
    {
        $this->panierQtes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(User $User): static
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, PanierQte>
     */
    public function getPanierQtes(): Collection
    {
        return $this->panierQtes;
    }

    public function hasPanierQte(Vin $vin): bool {
        foreach ($this->panierQtes as $pQte) {
            if ($pQte->getVin() == $vin) {
                return true;
            }
        }

        return false;
    }

    public function getPanierQte(Vin $vin): ?PanierQte {
        foreach ($this->panierQtes as $pQte) {
            if ($pQte->getVin() == $vin) {
                return $pQte;
            }
        }

        return null;
    }

    public function addPanierQte(PanierQte $panierQte): static
    {
        if (!$this->panierQtes->contains($panierQte)) {
            $this->panierQtes->add($panierQte);
            $panierQte->setPanier($this);
        }

        return $this;
    }

    public function removePanierQte(PanierQte $panierQte): static
    {
        if ($this->panierQtes->removeElement($panierQte)) {
            // set the owning side to null (unless already changed)
            if ($panierQte->getPanier() === $this) {
                $panierQte->setPanier(null);
            }
        }

        return $this;
    }

}
