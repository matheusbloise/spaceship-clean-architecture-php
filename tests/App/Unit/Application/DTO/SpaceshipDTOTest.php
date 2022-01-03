<?php

namespace App\Unit\Application\DTO;

use App\Application\DTO\SpaceshipDTO;
use App\Domain\Entity\Spaceship;
use PHPUnit\Framework\TestCase;

class SpaceshipDTOTest extends TestCase
{

    public function testToEntity()
    {
        $spaceship = SpaceshipDTO::toEntity([
            'guid' => 'f7d97079-118d-42f2-b836-3276ca30fd43', 
            'name' => 'Space X', 
            'engine' => '4 VLV 4/4'
        ]);
        
        self::assertInstanceOf(Spaceship::class, $spaceship);
    }

    public function testToEntityWithoutGuid()
    {
        $spaceship = SpaceshipDTO::toEntity(['guid' => null, 'name' => 'Space X', 'engine' => '4 VLV 4/4']);
        self::assertInstanceOf(Spaceship::class, $spaceship);
        self::assertNotNull($spaceship->getGuid());
        self::assertTrue(uuid_is_valid($spaceship->getGuid()));
    }
}
