<?php

namespace App\Entity;

use App\Repository\RecrutementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecrutementRepository::class)]
class Recrutement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(type: 'string')]
    private string $cv;

    public function getcv(): string
    {
        return $this->cv;
    }

    public function setcv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    #[ORM\Column(type: 'string')]
    private string $lettremotiv;

    public function getlettremotiv(): string
    {
        return $this->lettremotiv;
    }

    public function setlettremotiv(string $lettremotiv): self
    {
        $this->lettremotiv = $lettremotiv;

        return $this;
    }
}
