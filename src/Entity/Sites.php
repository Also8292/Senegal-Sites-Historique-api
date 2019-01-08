<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SitesRepository")
 * @Vich\Uploadable
 */
class Sites
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coordonnees;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $images;

    /**
     * @Vich\UploadableField(mapping="sites", fileNameProperty="image")
     * @var File
     */
     private $imageFile;


     /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updateAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Regions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCoordonnees(): ?string
    {
        return $this->coordonnees;
    }

    public function setCoordonnees(string $coordonnees): self
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updateAt' is not defined in your entity, use another property
            $this->updateAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($images)
    {
        $this->images = $images;
    }

    public function getImage()
    {
        return $this->images;
    }

    public function getRegion(): ?Regions
    {
        return $this->region;
    }

    public function setRegion(?Regions $region): self
    {
        $this->region = $region;

        return $this;
    }

}
