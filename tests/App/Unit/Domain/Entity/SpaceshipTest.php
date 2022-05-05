<?php

declare(strict_types=1);

namespace App\Unit\Domain\Entity;

use App\Domain\Entity\Spaceship;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class SpaceshipTest extends TestCase
{
    private static Spaceship $spaceship;

    public static function setUpBeforeClass(): void
    {
        self::$spaceship = new Spaceship(guid: null, name: 'Space X', engine: '4 VLV 4/4');
    }

    public function testNewSpaceshipWithNewValidGuidGenerated(): void
    {
        $this->assertTrue((bool) preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', self::$spaceship->getGuid()));
    }

    public function testSpaceshipWithValidGuid(): void
    {
        $spaceship = new Spaceship(guid: 'f7d97079-118d-42f2-b836-3276ca30fd43', name: 'Space X', engine: '4 VLV 4/4');
        $this->assertTrue((bool) preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $spaceship->getGuid()));
    }

    public function testGetName(): void
    {
        $this->assertEquals('Space X', self::$spaceship->getName());
    }

    public function testGetEngine(): void
    {
        echo self::$spaceship->getGuid();
        $this->assertEquals('4 VLV 4/4', self::$spaceship->getEngine());
    }
}
