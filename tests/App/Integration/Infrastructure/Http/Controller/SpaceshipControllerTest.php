<?php

declare(strict_types=1);

namespace App\Integration\Infrastructure\Http\Controller;

use App\Fixture\SpaceshipFixture;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @internal
 * @coversNothing
 */
class SpaceshipControllerTest extends WebTestCase
{
    private static KernelBrowser $client;

    public static function setUpBeforeClass(): void
    {
        self::$client = static::createClient();
    }

    public function getSpaceships(): Response
    {
        self::$client->request('GET', '/spaceships');
        return self::$client->getResponse();
    }

    public function testIndex(): void
    {
        (new SpaceshipFixture())->builder();
        $response = $this->getSpaceships();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Spaceships has been found with success', json_decode($response->getContent())->message);
    }

    public function testIndexNotFound(): void
    {
        $this->assertEquals(404, $this->getSpaceships()->getStatusCode());
    }

    public function testFindById(): void
    {
        (new SpaceshipFixture())->builder();
        $spaceships = json_decode($this->getSpaceships()->getContent())->data;
        $id = reset($spaceships)->id;

        self::$client->request('GET', "/spaceships/{$id}");
        $response = self::$client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Spaceship has been found with success', json_decode($response->getContent())->message);
    }

    public function testFindByIdNotFound(): void
    {
        self::$client->request('GET', '/spaceships/1');
        $response = self::$client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('Entity not found', json_decode($response->getContent())->message);
        $this->assertCount(1, [json_decode($response->getContent())->data]);
    }

    public function testRemove(): void
    {
        (new SpaceshipFixture())->builder();
        $spaceships = json_decode($this->getSpaceships()->getContent())->data;
        $id = reset($spaceships)->id;
        self::$client->request('DELETE', "/spaceships/{$id}");
        $response = self::$client->getResponse();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEquals('', $response->getContent());
    }

    public function testRemoveNotFound(): void
    {
        self::$client->request('DELETE', '/spaceships/1');
        $response = self::$client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('Entity not found', json_decode($response->getContent())->message);
    }

    public function testStore()
    {
        self::$client->request('POST', '/spaceships', [
            'name' => 'Swagger Spaceship',
            'engine' => 'V12',
        ]);

        $response = self::$client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('Spaceship created with success', json_decode($response->getContent())->message);
    }

    public function testStoreInvalid()
    {
        (new SpaceshipFixture())->builder();
        self::$client->request('POST', '/spaceships');
        $this->assertEquals(400, self::$client->getResponse()->getStatusCode());
    }

    public function testUpdate()
    {
        (new SpaceshipFixture())->builder();
        $spaceships = json_decode($this->getSpaceships()->getContent())->data;
        $spaceship = reset($spaceships);

        $this->assertNotEquals('Swagger Spaceship', $spaceship->name);
        $this->assertNotEquals('V12', $spaceship->engine);

        self::$client->request('PUT', "/spaceships/{$spaceship->id}", [
            'name' => 'Swagger Spaceship',
            'engine' => 'V12',
        ]);

        $response = self::$client->getResponse();
        $content = json_decode($response->getContent());
        $this->assertEquals('Swagger Spaceship', $content->data->name);
        $this->assertEquals('V12', $content->data->engine);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Spaceship updated with success', $content->message);
    }

    public function testUpdateInvalid()
    {
        (new SpaceshipFixture())->builder();
        $spaceships = json_decode($this->getSpaceships()->getContent())->data;
        $spaceship = reset($spaceships);
        self::$client->request('PUT', "/spaceships/{$spaceship->id}", [
            'name' => 'Swagger Spaceship',
        ]);
        $this->assertEquals(400, self::$client->getResponse()->getStatusCode());
    }

    public function testOptions()
    {
        self::$client->request('OPTIONS', '/spaceships/1');
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
    }
}
