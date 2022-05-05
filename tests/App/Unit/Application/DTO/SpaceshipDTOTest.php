<?php

declare(strict_types=1);

namespace App\Unit\Application\DTO;

use App\Application\DTO\SpaceshipDTO;
use App\Domain\Entity\Spaceship;
use PHPUnit\Framework\TestCase;

class SpaceshipDTOTest extends TestCase
{
    public function testToEntity(): void
    {
        $spaceship = SpaceshipDTO::toEntity([
            'guid' => 'f7d97079-118d-42f2-b836-3276ca30fd43',
            'name' => 'Space X',
            'engine' => '4 VLV 4/4',
        ]);

        self::assertInstanceOf(Spaceship::class, $spaceship);
    }

    public function testToEntityWithoutGuid(): void
    {
        $spaceship = SpaceshipDTO::toEntity(['name' => 'Space X', 'engine' => '4 VLV 4/4']);
        $this->assertInstanceOf(Spaceship::class, $spaceship);
        $this->assertNotNull($spaceship->getGuid());
        $this->assertTrue(uuid_is_valid($spaceship->getGuid()));
    }
}
