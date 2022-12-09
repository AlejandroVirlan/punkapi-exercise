<?php

namespace App\PunkApi\Beers\Infrastructure\Controller;


use App\PunkApi\Beers\Application\GetBeerUseCase;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BeerController extends AbstractController
{
    private string $base_url = 'https://api.punkapi.com/v2/beers/';

    public function get_beer(GetBeerUseCase $getBeersUseCase, HttpClientInterface $httpClient, string $id): JsonResponse
    {
        $response = $httpClient->request('GET', $this->base_url.$id);
        $data = $response->toArray();
        $dataConverted = $getBeersUseCase->normalizeResponse($data);
        return $this->json($dataConverted, Response::HTTP_OK);
    }

    public function list(GetBeerUseCase $getBeersUseCase, HttpClientInterface $httpClient, Request $request): JsonResponse
    {
        $query = $request->query->get('food') ?? '';

        if ($query != '') {
            $response = $httpClient->request('GET', $this->base_url, ['query'=>['food'=>$query]]);
        } else {
            $response = $httpClient->request('GET', $this->base_url);
        }
        $data = $response->toArray();

        $dataConverted = $getBeersUseCase->normalizeResponse($data);

        return $this->json($dataConverted, Response::HTTP_OK);
    }
}
