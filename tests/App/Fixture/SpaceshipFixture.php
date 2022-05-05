<?php

declare(strict_types=1);

namespace App\Fixture;

use App\Application\DTO\SpaceshipDTO;
use App\Infrastructure\Persistence\Database\Repository\SpaceshipRepository;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpaceshipFixture extends WebTestCase
{
    private SpaceshipRepository $repository;

    public function __construct()
    {
        $this->repository = static::getContainer()->get(SpaceshipRepository::class);
    }

    public function builder(int $quantityToCreate = 10): void
    {
        if ($quantityToCreate > 10) {
            return;
        }
        $faker = Factory::create();
        for ($i = 0; $i < $quantityToCreate; ++$i) {
            $this->repository->store(
                SpaceshipDTO::toEntity([
                    'guid' => $faker->uuid(),
                    'name' => $faker->name(),
                    'engine' => $faker->name(),
                ])
            );
        }
    }
}
