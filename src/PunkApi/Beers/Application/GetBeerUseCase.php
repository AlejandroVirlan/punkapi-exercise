<?php

declare(strict_types=1);

namespace App\PunkApi\Beers\Application;

use App\PunkApi\Beers\Domain\Entity\Beer;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class GetBeerUseCase
{
    public function normalizeResponse(array $data): array
    {
        $beers = [];
        for ($i = 0; $i < count($data); $i++) {
            $beers[$i] = new Beer();
            $beers[$i]->setId($data[$i]['id']);
            $beers[$i]->setName($data[$i]['name']);
            $beers[$i]->setTagline($data[$i]['tagline']);
            $beers[$i]->setFirstBrewed($data[$i]['first_brewed']);
            $beers[$i]->setDescription($data[$i]['description']);
            $beers[$i]->setImageUrl($data[$i]['image_url']);
            $beers[$i]->setFoodPairing($data[$i]['food_pairing']);
        }
        $serializer = new Serializer([new ObjectNormalizer()]);

        return $serializer->normalize($beers);
    }
}