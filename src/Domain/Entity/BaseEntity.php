<?php declare(strict_types=1);

namespace App\Domain\Entity;

abstract class BaseEntity
{
    private string $guid;

    public function __construct(string|null $guid)
    {
        $this->guid = $guid ?? uuid_create();
    }

    public function getGuid(): string
    {
        return $this->guid;
    }
}