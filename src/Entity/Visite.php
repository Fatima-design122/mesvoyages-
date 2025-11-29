<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiteRepository::class)]
class Visite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $tempmin = null;

    #[ORM\Column(length: 255)]
    private ?string $tempmax = null;

    #[ORM\Column(length: 50)]
    private ?string $pays = null;

    // ⭐ Ajout du champ note
    #[ORM\Column]
    private ?int $note = null;

    // ⭐ Ajout du champ datecreation
    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $datecreation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;
        return $this;
    }

    public function getTempmin(): ?string
    {
        return $this->tempmin;
    }

    public function setTempmin(string $tempmin): static
    {
        $this->tempmin = $tempmin;
        return $this;
    }

    public function getTempmax(): ?string
    {
        return $this->tempmax;
    }

    public function setTempmax(string $tempmax): static
    {
        $this->tempmax = $tempmax;
        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;
        return $this;
    }

    // ⭐ Getter / Setter Note
    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;
        return $this;
    }

    // ⭐ Getter / Setter Datecreation
    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): static
    {
        $this->datecreation = $datecreation;
        return $this;
    }

    // ⭐ Méthode personnalisée pour afficher la date formatée
    public function getDatecreationString(): string
    {
        if ($this->datecreation === null) {
            return "";
        }
        return $this->datecreation->format('d/m/Y');
    }
}

