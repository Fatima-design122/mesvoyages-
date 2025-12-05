<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $datecreation = null;

    // ⭐ Ajout du champ avis
    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $avis = null;

    /**
     * @var Collection<int, Environnement>
     */
    #[ORM\ManyToMany(targetEntity: Environnement::class)]
    private Collection $environnements;

    public function __construct()
    {
        $this->environnements = new ArrayCollection();
    }

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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;
        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): static
    {
        $this->datecreation = $datecreation;
        return $this;
    }

    // ⭐ Formatage personnalisé de la date
    public function getDatecreationString(): string
    {
        if ($this->datecreation === null) {
            return "";
        }
        return $this->datecreation->format('d/m/Y');
    }

    // ⭐ Getter / Setter avis
    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(?string $avis): static
    {
        $this->avis = $avis;
        return $this;
    }

    /**
     * @return Collection<int, Environnement>
     */
    public function getEnvironnements(): Collection
    {
        return $this->environnements;
    }

    public function addEnvironnement(Environnement $environnement): static
    {
        if (!$this->environnements->contains($environnement)) {
            $this->environnements->add($environnement);
        }

        return $this;
    }

    public function removeEnvironnement(Environnement $environnement): static
    {
        $this->environnements->removeElement($environnement);

        return $this;
    }
}

