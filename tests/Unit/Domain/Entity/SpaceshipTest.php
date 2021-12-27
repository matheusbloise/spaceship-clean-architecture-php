<?php

namespace App\Test\Unit\Domain\Entity;

use App\Domain\Entity\Spaceship;
use PHPUnit\Framework\TestCase;

class SpaceshipTest extends TestCase
{
    private static Spaceship $spaceship;

    public static function setUpBeforeClass(): void
    {
        self::$spaceship = new Spaceship(guid: null, name: 'Space X', engine: '4 VLV 4/4');
    }

    public function testNewSpaceshipWithNewValidGuidGenerated()
    {
        self::assertTrue((bool) preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', self::$spaceship->getGuid()));
    }

    public function testSpaceshipWithValidGuid()
    {
        $spaceship = new Spaceship(guid: 'f7d97079-118d-42f2-b836-3276ca30fd43', name: 'Space X', engine: '4 VLV 4/4');
        self::assertTrue((bool) preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $spaceship->getGuid()));
    }

    public function testGetName()
    {
        self::assertEquals('Space X', self::$spaceship->getName());
    }

    public function testGetEngine()
    {
        echo self::$spaceship->getGuid();
        self::assertEquals('4 VLV 4/4', self::$spaceship->getEngine());
    }
}