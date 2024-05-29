<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $weight = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description_common = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description_for_ozon = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description_for_wildberries = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getDescriptionCommon(): ?string
    {
        return $this->description_common;
    }

    public function setDescriptionCommon(?string $description_common): static
    {
        $this->description_common = $description_common;

        return $this;
    }

    public function getDescriptionForOzon(): ?string
    {
        return $this->description_for_ozon;
    }

    public function setDescriptionForOzon(?string $description_for_ozon): static
    {
        $this->description_for_ozon = $description_for_ozon;

        return $this;
    }

    public function getDescriptionForWildberries(): ?string
    {
        return $this->description_for_wildberries;
    }

    public function setDescriptionForWildberries(?string $description_for_wildberries): static
    {
        $this->description_for_wildberries = $description_for_wildberries;

        return $this;
    }
}
