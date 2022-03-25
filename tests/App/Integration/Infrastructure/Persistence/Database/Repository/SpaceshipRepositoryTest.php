<?php

namespace App\Integration\Infrastructure\Persistence\Database\Repository;

use App\Domain\Entity\Spaceship;
use App\Fixture\SpaceshipFixture;
use App\Infrastructure\Persistence\Database\Repository\SpaceshipRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpaceshipRepositoryTest extends WebTestCase
{
    private SpaceshipRepository $repository;
    private array $spaceships;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->prepare();
        $this->repository = static::getContainer()->get(SpaceshipRepository::class);
        $this->spaceships = $this->repository->findAll();
    }

    private function prepare(): void
    {
        (new SpaceshipFixture())->builder();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testFindAll(): void
    {
        $spaceships = $this->repository->findAll();
        $this->assertNotEmpty($spaceships);
        $this->assertIsArray($spaceships);
    }

    public function testFindById(): void
    {
        $spaceship = $this->repository->findById(reset($this->spaceships)['id']);
        $this->assertNotEmpty($spaceship);
        $this->assertIsArray($spaceship);
    }

    public function testRemove(): void
    {
        $this->assertTrue($this->repository->remove(reset($this->spaceships)['id']));
    }

    public function testTryToRemoveEntityNotFound()
    {
        self::assertFalse($this->repository->remove(1));;
    }

    public function testUpdate(): void
    {
        $spaceship = reset($this->spaceships);
        $spaceship = new Spaceship($spaceship['id'], 'Updated Spaceship Name', $spaceship['engine']);
        $spaceship = $this->repository->update($spaceship, $spaceship->getGuid());
        $this->assertEquals('Updated Spaceship Name', $spaceship->getName());
        $this->assertInstanceOf(Spaceship::class, $spaceship);
    }
}