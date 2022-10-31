<?php

namespace App\Entity;

use App\Repository\PersonnalityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonnalityRepository::class)]
class Personnality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'personnality', targetEntity: Villager::class)]
    private Collection $villagers;

    public function __construct()
    {
        $this->villagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Villager>
     */
    public function getVillagers(): Collection
    {
        return $this->villagers;
    }

    public function addVillager(Villager $villager): self
    {
        if (!$this->villagers->contains($villager)) {
            $this->villagers->add($villager);
            $villager->setPersonnality($this);
        }

        return $this;
    }

    public function removeVillager(Villager $villager): self
    {
        if ($this->villagers->removeElement($villager)) {
            // set the owning side to null (unless already changed)
            if ($villager->getPersonnality() === $this) {
                $villager->setPersonnality(null);
            }
        }

        return $this;
    }
}
