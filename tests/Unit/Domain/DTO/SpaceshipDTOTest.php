<?php

namespace App\Test\Unit\Domain\DTO;

use App\Domain\DTO\SpaceshipDTO;
use App\Domain\Entity\Spaceship;
use PHPUnit\Framework\TestCase;

class SpaceshipDTOTest extends TestCase
{
    private static array $spaceshipArray;

    public static function setUpBeforeClass(): void
    {
        self::$spaceshipArray = [
            'guid' => 'f7d97079-118d-42f2-b836-3276ca30fd43',
            'name' =>  'Space X',
            'engine' => '4 VLV 4/4'
        ];
    }

    public static function tearDownAfterClass(): void
    {
        self::$spaceshipArray = [];
    }

    public function testToEntity()
    {
        $spaceshipEntity = SpaceshipDTO::toEntity(self::$spaceshipArray);
        self::assertInstanceOf(Spaceship::class, $spaceshipEntity);
    }
}