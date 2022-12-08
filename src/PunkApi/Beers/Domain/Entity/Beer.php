<?php

declare(strict_types=1);

namespace App\PunkApi\Beers\Domain\Entity;

use App\PunkApi\Beers\Infrastructure\Persistence\Repository\BeerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeerRepository::class)]
class Beer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $tagline = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?string $first_brewed = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_url = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $food_pairing = [];

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getTagline(): ?string
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): self
    {
        $this->tagline = $tagline;

        return $this;
    }

    public function getFirstBrewed(): ?string
    {
        return $this->first_brewed;
    }

    public function setFirstBrewed(string $first_brewed): self
    {
        $this->first_brewed = $first_brewed;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getFoodPairing(): array
    {
        return $this->food_pairing;
    }

    public function setFoodPairing(array $food_pairing): self
    {
        $this->food_pairing = $food_pairing;

        return $this;
    }

}