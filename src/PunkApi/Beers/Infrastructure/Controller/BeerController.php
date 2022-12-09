<?php

namespace App\PunkApi\Beers\Infrastructure\Controller;

use App\PunkApi\Beers\Application\GetBeerUseCase;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class BeerController extends AbstractController
{
    private string $base_url = 'https://api.punkapi.com/v2/beers/';

    public function get_beer(GetBeerUseCase $getBeersUseCase, HttpClientInterface $httpClient, string $id, CacheInterface $beerCache): JsonResponse
    {
        return $beerCache->get("get-beer-$id", function (ItemInterface $item) use ($getBeersUseCase, $id, $httpClient) {
            $item->expiresAfter(3600);
            var_dump('No está en cache');
            $data = [];
            $response = $httpClient->request('GET', $this->base_url.$id);
            $data = $response->toArray();
            $dataConverted = $getBeersUseCase->normalizeResponse($data);;
            return $this->json($dataConverted, Response::HTTP_OK);
        });

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
