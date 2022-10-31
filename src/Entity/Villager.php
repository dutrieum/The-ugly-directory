<?php

namespace App\Entity;

use App\Repository\VillagerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VillagerRepository::class)]
class Villager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 150)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'villagers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personnality $personnality = null;

    #[ORM\Column]
    private ?int $ugliness = null;

    #[ORM\Column(length: 255)]
    private ?string $image_url = null;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPersonnality(): ?Personnality
    {
        return $this->personnality;
    }

    public function setPersonnality(?Personnality $personnality): self
    {
        $this->personnality = $personnality;

        return $this;
    }

    public function getUgliness(): ?int
    {
        return $this->ugliness;
    }

    public function setUgliness(int $ugliness): self
    {
        $this->ugliness = $ugliness;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }
}
