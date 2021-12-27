<?php declare(strict_types=1);

namespace App\Domain\Entity;

final class Spaceship extends BaseEntity
{
    private string $name;
    private string $engine;

    public function __construct(string|null $guid, string $name, string $engine)
    {
        parent::__construct($guid);
        $this->name = $name;
        $this->engine = $engine;
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
