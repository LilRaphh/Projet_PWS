<?php

namespace App\Entity;

use App\Repository\VinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: VinRepository::class)]
#[Vich\Uploadable]
class Vin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $quantitestock = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vinImageName = null;

    #[Vich\UploadableField(mapping: 'vins', fileNameProperty: 'vinImageName', size: 'imageVinSize')]
    private ?File $vinImageFile = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageVinSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'vin', targetEntity: PanierQte::class)]
    private Collection $panierQtes;

    public function __construct()
    {
        $this->panierQuantites = new ArrayCollection();
        $this->panierQtes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantitestock(): ?int
    {
        return $this->quantitestock;
    }

    public function setQuantitestock(int $quantitestock): static
    {
        $this->quantitestock = $quantitestock;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getVinImageName(): ?string
    {
        return $this->vinImageName;
    }

    public function setVinImageName(?string $imgUrl): static
    {
        $this->vinImageName = $imgUrl;

        return $this;
    }

    public function getVinImageFile(): ?File
    {
        return $this->vinImageFile;
    }

    public function setVinImageFile(?File $vinImageFile = null): void
    {
        $this->vinImageFile = $vinImageFile;

        if (null !== $vinImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageVinSize(): ?int
    {
        return $this->imageVinSize;
    }

    public function setImageVinSize(?int $imageVinSize): void
    {
        $this->imageVinSize = $imageVinSize;
    }

    /**
     * @return Collection<int, PanierQte>
     */
    public function getPanierQtes(): Collection
    {
        return $this->panierQtes;
    }

    public function addPanierQte(PanierQte $panierQte): static
    {
        if (!$this->panierQtes->contains($panierQte)) {
            $this->panierQtes->add($panierQte);
            $panierQte->setVin($this);
        }

        return $this;
    }

    public function removePanierQte(PanierQte $panierQte): static
    {
        if ($this->panierQtes->removeElement($panierQte)) {
            // set the owning side to null (unless already changed)
            if ($panierQte->getVin() === $this) {
                $panierQte->setVin(null);
            }
        }

        return $this;
    }

}
