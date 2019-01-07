<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DepartementsRepository")
 */
class Departements
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Regions", inversedBy="departements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sites", mappedBy="departement")
     */
    private $sites;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
    }

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

    public function getRegion(): ?Regions
    {
        return $this->region;
    }

    public function setRegion(?Regions $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Sites[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Sites $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
            $site->setDepartement($this);
        }

        return $this;
    }

    public function removeSite(Sites $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
            // set the owning side to null (unless already changed)
            if ($site->getDepartement() === $this) {
                $site->setDepartement(null);
            }
        }

        return $this;
    }
}
