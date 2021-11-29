<?php

namespace App\Entity;

use App\Repository\RestoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Resto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\Regex(pattern="/^[0-3]$/",
     * message="le nombre d'étoile doit être comprit entre 0 et 3.")
     */
    private $etoiles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chef", cascade={"persist"})
     */
    private $idChef;

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

    public function getEtoiles(): ?int
    {
        return $this->etoiles;
    }

    public function setEtoiles(int $etoiles): self
    {
        $this->etoiles = $etoiles;

        return $this;
    }

    public function __toString() {
        return $this->getNom().'.-.'.$this->getEtoiles().'-'.$this->getIdChef();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function corrigerResto() {
        $this->nom = strtoupper($this->nom);
    }

    public function getIdChef(): ?Chef
    {
        return $this->idChef;
    }

    public function setIdChef(?Chef $idChef): self
    {
        $this->idChef = $idChef;

        return $this;
    }
}
