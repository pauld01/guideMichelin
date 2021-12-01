<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatRepository::class)
 */
class Plat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $intitule;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Resto",
     * inversedBy="plats_proposes", cascade={"persist"})
     */
    private $restos_proposent;

    public function __construct()
    {
        $this->restos_proposent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function __toString() {
        return $this->getIntitule();
    }

    /**
     * @return Collection|Resto[]
     */
    public function getRestosProposent(): Collection
    {
        return $this->restos_proposent;
    }

    public function addRestosProposent(Resto $restosProposent): self
    {
        if (!$this->restos_proposent->contains($restosProposent)) {
            $this->restos_proposent[] = $restosProposent;
        }

        return $this;
    }

    public function removeRestosProposent(Resto $restosProposent): self
    {
        $this->restos_proposent->removeElement($restosProposent);

        return $this;
    }
}
