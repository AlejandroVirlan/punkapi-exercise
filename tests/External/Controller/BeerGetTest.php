<?php

namespace App\Tests\External\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BeerGetTest extends WebTestCase
{
    public function testReturnsBeer(): void
    {
        $client = static::createClient();
        $client->request('GET', 'api/beers/1');
        self::assertResponseIsSuccessful();
        $content = (string) $client->getResponse()->getContent();
        self::assertStringContainsString('Buzz', $content);
    }
}
