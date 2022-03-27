<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\InputBoundary\Spaceship;

use App\Infrastructure\Http\InputBoundary\InputBoundary;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateValidator extends InputBoundary
{
    #[Assert\NotNull(message: 'This value is not a valid for name field')]
    protected ?string $name;

    #[Assert\NotNull(message: 'This value is not a valid for engine field')]
    protected ?string $engine;

    /**
     * @param array<string, string> $data
     * @return array<string, string>
     */
    public function getErrors(array $data): array
    {
        $this->fill($data);
        return parent::validate($this);
    }
}
