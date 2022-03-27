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

    public function testFindById(): void
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('findById')
            ->with('f7d97079-118d-42f2-b836-3276ca30fd43')
            ->willReturn(reset(self::$spaceships));

        $result = $this->service->findById('f7d97079-118d-42f2-b836-3276ca30fd43');

        $this->assertEquals(3, count($result));
        $this->assertIsArray($result);
    }


    public function testFindByIdExceptionEntityNotFound(): void
    {
        $this->expectException(EntityNotFound::class);
        $this->expectExceptionCode(404);

        $this->repositoryMock
            ->expects($this->once())
            ->method('findById')
            ->with('1')
            ->willReturn([]);

        $this->service->findById('1');
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
        $this->repositoryMock
            ->expects($this->once())
            ->method('remove')
            ->with('f7d97079-118d-42f2-b836-3276ca30fd43')
            ->willReturn(true);

        $this->service->remove('f7d97079-118d-42f2-b836-3276ca30fd43');
    }

    public function testRemoveExceptionEntityNotFound(): void
    {
        $this->expectException(EntityNotFound::class);
        $this->expectExceptionCode(404);

        $this->repositoryMock
            ->expects($this->once())
            ->method('remove')
            ->with('1')
            ->willReturn(false);

        $this->service->remove('1');
    }
}
