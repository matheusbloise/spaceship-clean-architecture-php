<?php

declare(strict_types=1);

namespace App\Integration\Infrastructure\DTO;

use App\Domain\Entity\Spaceship as Entity;
use App\Infrastructure\DTO\SpaceshipDTO;
use App\Infrastructure\Persistence\Database\Model\Spaceship as Model;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class SpaceshipDTOTest extends TestCase
{
    private Entity $spaceship;

    protected function setUp(): void
    {
        $this->spaceship = new Entity(guid: null, name: 'Space X', engine: '4 VLV 4/4');
    }

    public function testToModel(): void
    {
        $guid = $this->spaceship->getGuid();
        $spaceshipModel = SpaceshipDTO::toModel($this->spaceship);
        $this->assertInstanceOf(Model::class, $spaceshipModel);
        self::assertSame(
            [
                'guid' => $guid,
                'name' => $this->spaceship->getName(),
                'engine' => $this->spaceship->getEngine(),
            ],
            [
                'guid' => $spaceshipModel->getId(),
                'name' => $spaceshipModel->getName(),
                'engine' => $spaceshipModel->getEngine(),
            ]
        );
    }

    public function testToArray(): void
    {
        $spaceshipArray = SpaceshipDTO::toArray($this->spaceship);
        $this->assertArrayHasKey('guid', $spaceshipArray);
        $this->assertArrayHasKey('name', $spaceshipArray);
        $this->assertArrayHasKey('engine', $spaceshipArray);
    }
}
