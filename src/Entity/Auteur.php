<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuteurRepository::class)
 */
class Auteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="auteur")
     */
    private $prodcuts;

    public function __construct()
    {
        $this->prodcuts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProdcuts(): Collection
    {
        return $this->prodcuts;
    }

    public function addProdcut(Product $prodcut): self
    {
        if (!$this->prodcuts->contains($prodcut)) {
            $this->prodcuts[] = $prodcut;
            $prodcut->setAuteur($this);
        }

        return $this;
    }

    public function removeProdcut(Product $prodcut): self
    {
        if ($this->prodcuts->removeElement($prodcut)) {
            // set the owning side to null (unless already changed)
            if ($prodcut->getAuteur() === $this) {
                $prodcut->setAuteur(null);
            }
        }

        return $this;
    }
}
