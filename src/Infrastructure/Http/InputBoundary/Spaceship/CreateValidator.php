<?php declare(strict_types=1);

namespace App\Infrastructure\Http\InputBoundary\Spaceship;

use App\Infrastructure\Http\InputBoundary\InputBoundary;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateValidator extends InputBoundary
{

    #[Assert\NotNull(message: "This value is not a valid for name field")]
    private ?string $name;

    #[Assert\NotNull(message: "This value is not a valid for engine field")]
    private ?string $engine;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function fromArray(array $data): array
    {
        $this->name = $data['name'] ?? null;
        $this->engine = $data['engine'] ?? null;
        return parent::validate($this);
    }
}