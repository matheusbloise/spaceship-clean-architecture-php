<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Database\Model;

use App\Infrastructure\Persistence\Database\Repository\SpaceshipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

#[ORM\Entity(repositoryClass: SpaceshipRepository::class)]
#[ORM\Table(name: 'spaceships')]
#[Index(columns: ['name'], name: 'search_by_name_idx')]
#[Index(columns: ['id'], name: 'search_by_id_idx')]
class Spaceship
{
    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    private string $id;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $engine;

    public function __construct(string $id, string $name, string $engine)
    {
        $this->id = $id;
        $this->name = $name;
        $this->engine = $engine;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEngine(): string
    {
        return $this->engine;
    }
}
