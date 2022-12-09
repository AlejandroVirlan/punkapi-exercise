<?php

declare(strict_types=1);

namespace App\Tests\Mock;

use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpFoundation\Response;

final class PunkApiMock extends MockHttpClient
{
    private string $baseUri = 'https://api.punkapi.com';

    public function __construct()
    {
        $callback = \Closure::fromCallable([$this, 'handleRequest']);

        parent::__construct($callback, $this->baseUri);
    }

    private function handleRequests(string $method, string $url): MockResponse
    {
        if ($method === 'GET' && str_starts_with($url, $this->baseUri.'/v2/beers')) {
            return $this->getV1Mock();
        }

        throw new \UnexpectedValueException("Mock not implemented: $method/$url");
    }

    /**
     * "/api/v1" endpoint.
     */
    private function getV1Mock(): MockResponse
    {
        $mock =  [
            'id' => '6940582',
            'name' => 'Monster Beer',
            'tagline' => 'Modern. Spicy.',
            'first_brewed' => '02/2099',
            'description' => 'The best beer ever created',
            'image_url' => 'https://images.example.com/v1/monster-beer.png',
            'food_pairing' => [
                'Ramen ichiraku',
                'Tacos',
                'Bastami Rice'
            ],
        ];

        return new MockResponse(
            json_encode($mock, JSON_THROW_ON_ERROR),
            ['http_code' => Response::HTTP_OK]
        );
    }
}