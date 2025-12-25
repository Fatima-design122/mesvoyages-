<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: VisiteRepository::class)]
#[Vich\Uploadable]
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
    #[Vich\UploadableField(mapping:'visites', fileNameProperty: 'imageName', size:'imageSize' )]
    #[Assert\Image(mimeTypes: ["image/jpeg"])]
    private? File $imageFile= null;
    
    #[ORM\Column(nullable:true)]
    private ?string $imageName= null;
    
    #[ORM\Column(nullable : true)]
    private ?int $imageSize = null;
    
    #[ORM\Column(nullable : true)]
    private ?\DateTimeImmutable $updateAt = null;
    
    public function getImageFile(): ?File {
        return $this->imageFile;
    }

    public function getImageName(): ?string {
        return $this->imageName;
    }

    public function getImageSize(): ?int {
        return $this->imageSize;
    }
    
    public function  setImageFile(?File $imageFile): void{
        $this->imageFile =$imageFile;
        if(null !== $imageFile){
            $this->updateAt = new \DateTimeImmutable();
        }
    }
    public function setImageName(?string $imageName): void{
        $this->imageName = $imageName;
    }
    public function setImageSize(?int $imageSize): void{
        $this->imageSize =$imageSize;
    }
    #[Assert\Callback]
    private function validate(ExecutionContextInterface $context){
        $file = $this->getImageFile();
        if($file != null && $file !=""){
            $poids=@filesize($file);
            if ($poids != false && $poids >512000){
                $context->buildViolation("cette image est trop lourde (500Ko max)")
                ->atPath('imageFile')
                ->addViolation(); 
            }
            $infosImage=@getimagesize($file);
            if($infosImage ==false){
                $context->buildViolation("Ce fichier n'est pas une image")
                        ->atPath('imageFile')
                        ->addViolation();
            }
           
        }
        
    }
    
    
    
}

