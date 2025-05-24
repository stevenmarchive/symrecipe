<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->modificationAt = new \DateTimeImmutable();
    }


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50, minMessage: "Le champ doit contenir au moins {{ limit }} caractères.", maxMessage: "Le champ ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Assert\Positive()]
    #[Assert\LessThan(200,message : 'Le prix ne peut pas dépasser 200 euros')]
    private ?float $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $modificationAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $deleteAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModificationAt(): ?\DateTimeImmutable
    {
        return $this->modificationAt;
    }

    public function setModificationAt(\DateTimeImmutable $modificationAt): static
    {
        $this->modificationAt = $modificationAt;

        return $this;
    }

    public function getDeleteAt(): ?\DateTimeImmutable
    {
        return $this->deleteAt;
    }

    public function setDeleteAt(\DateTimeImmutable $deleteAt): static
    {
        $this->deleteAt = $deleteAt;

        return $this;
    }
}
