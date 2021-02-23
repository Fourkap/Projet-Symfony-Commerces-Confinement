<?php

namespace App\Entity;

use App\Repository\CodepostalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodepostalRepository::class)
 */
class Codepostal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arrondissement;

    /**
     * @ORM\ManyToMany(targetEntity=Commerce::class, mappedBy="Codepostal")
     */
    private $commerces;

    public function __construct()
    {
        $this->commerces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrondissement(): ?string
    {
        return $this->arrondissement;
    }

    public function setArrondissement(string $arrondissement): self
    {
        $this->arrondissement = $arrondissement;

        return $this;
    }

    /**
     * @return Collection|Commerce[]
     */
    public function getCommerces(): Collection
    {
        return $this->commerces;
    }

    public function addCommerce(Commerce $commerce): self
    {
        if (!$this->commerces->contains($commerce)) {
            $this->commerces[] = $commerce;
            $commerce->addCodepostal($this);
        }

        return $this;
    }

    public function removeCommerce(Commerce $commerce): self
    {
        if ($this->commerces->removeElement($commerce)) {
            $commerce->removeCodepostal($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->arrondissement;

    }
}
