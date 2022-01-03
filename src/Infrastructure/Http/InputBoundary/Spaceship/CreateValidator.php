<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\InputBoundary\Spaceship;

use App\Infrastructure\Http\InputBoundary\InputBoundary;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CreateValidator extends InputBoundary
{
    #[Assert\NotNull(message: 'This value is not a valid for name field')]
    private ?string $name;

    #[Assert\NotNull(message: 'This value is not a valid for engine field')]
    private ?string $engine;

    /**
     * @param array<string, string> $data
     * @return array<string, string>
     */
    public function getErrors(array $data): array
    {
        $this->name = $data['name'] ?? null;
        $this->engine = $data['engine'] ?? null;
        return parent::validate($this);
    }
}
