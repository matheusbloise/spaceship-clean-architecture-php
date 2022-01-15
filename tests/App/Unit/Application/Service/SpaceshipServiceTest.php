<?php

namespace App\Unit\Application\Service;

use App\Application\Exception\EntityNotFound;
use App\Application\Service\SpaceshipService;
use App\Domain\Entity\Spaceship;
use App\Domain\Repository\SpaceshipRepositoryInterface;
use PHPUnit\Framework\TestCase;

class SpaceshipServiceTest extends TestCase
{
    private static array $spaceships;
    private SpaceshipRepositoryInterface $repositoryMock;
    private SpaceshipService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryMock = $this->createMock(SpaceshipRepositoryInterface::class);
        $this->service = new SpaceshipService($this->repositoryMock);
    }

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$spaceships = [
            [
                'id' => 'f7d97079-118d-42f2-b836-3276ca30fd43',
                'name' => 'Space X',
                'engine' => '4 VLV 4/4'
            ],
            [
                'id' => 'f7d97079-118d-42f2-b836-3276ca30fd43',
                'name' => 'Space X',
                'engine' => '4 VLV 4/4'
            ],
        ];
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::$spaceships = [];
    }

    public function testFindAll(): void
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('findAll')
            ->willReturn(self::$spaceships);

        $this->assertIsArray($this->service->findAll());
    }

    public function testUpdate(): void
    {
        $spaceshipArray = reset(self::$spaceships);
        $spaceshipArray['guid'] = $spaceshipArray['id'];
        $spaceshipEntity = new Spaceship(
            guid: $spaceshipArray['id'],
            name: $spaceshipArray['name'],
            engine: $spaceshipArray['engine']
        );
        $this->repositoryMock
            ->expects($this->once())
            ->method('update')
            ->with($this->equalTo($spaceshipEntity), $this->equalTo($spaceshipEntity->getGuid()))
            ->willReturn($spaceshipEntity);

        $spaceshipStored = $this->service->update($spaceshipArray, $spaceshipEntity->getGuid());
        $this->assertInstanceOf(Spaceship::class, $spaceshipStored);
    }

    public function testFindByGuid(): void
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('findByGuid')
            ->with('f7d97079-118d-42f2-b836-3276ca30fd43')
            ->willReturn(reset(self::$spaceships));

        $result = $this->service->findByGuid('f7d97079-118d-42f2-b836-3276ca30fd43');

        $this->assertEquals(3, count($result));
        $this->assertIsArray($result);
    }

    public function testStore(): void
    {
        $spaceshipArray = reset(self::$spaceships);
        $spaceshipEntity = new Spaceship(
            guid: $spaceshipArray['id'],
            name: $spaceshipArray['name'],
            engine: $spaceshipArray['engine']
        );
        unset($spaceshipArray['id']);
            
        $this->repositoryMock
            ->expects($this->once())
            ->method('store')
            ->willReturn($spaceshipEntity);

        $spaceshipStored = $this->service->store($spaceshipArray);
        $this->assertInstanceOf(Spaceship::class, $spaceshipStored);
    }

    public function testRemove(): void
    {
        $guid = 'f7d97079-118d-42f2-b836-3276ca30fd43';
        $this->repositoryMock
            ->expects($this->once())
            ->method('findByGuid')
            ->with()
            ->willReturn(reset(self::$spaceships));

        $this->repositoryMock
            ->expects($this->once())
            ->method('remove')
            ->with($guid);

        $this->service->remove($guid);
    }

    public function testRemoveEntityNotFound(): void
    {
        $this->expectException(EntityNotFound::class);
        $this->expectExceptionCode(404);

        $guid = 'f7d97079-118d-42f2-b836-3276ca30fd43';
        $this->repositoryMock
            ->expects($this->once())
            ->method('findByGuid')
            ->with($guid)
            ->willReturn([]);

        $this->repositoryMock
            ->expects($this->never())
            ->method('remove')
            ->with($guid);

        $this->service->remove($guid);
    }
}
