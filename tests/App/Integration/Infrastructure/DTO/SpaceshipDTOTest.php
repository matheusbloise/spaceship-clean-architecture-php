<?php

namespace App\Integration\Infrastructure\DTO;

use App\Domain\Entity\Spaceship as Entity;
use App\Infrastructure\DTO\SpaceshipDTO;
use App\Infrastructure\Persistence\Database\Model\Spaceship as Model;
use PHPUnit\Framework\TestCase;

class SpaceshipDTOTest extends TestCase
{
    private Entity $spaceship;

    protected function setUp(): void
    {
        $this->spaceship = new Entity(guid: null, name: 'Space X', engine: '4 VLV 4/4');
    }

    public function testToModel(): void
    {
        $spaceshipModel = SpaceshipDTO::toModel($this->spaceship);
        $this->assertInstanceOf(Model::class, $spaceshipModel);
    }

    public function testToArray(): void
    {
        $spaceshipArray = SpaceshipDTO::toArray($this->spaceship);
        $this->assertArrayHasKey('id', $spaceshipArray);
        $this->assertArrayHasKey('name', $spaceshipArray);
        $this->assertArrayHasKey('engine', $spaceshipArray);
    }
}
