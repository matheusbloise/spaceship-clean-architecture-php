<?php declare(strict_types=1);

namespace App\Infrastructure\Http\InputBoundary;

use App\Domain\Entity\BaseEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface InputBoundaryInterface
{
    public function validate(InputBoundary $inputBoundary): array;
    public function getFailures(ConstraintViolationListInterface $constraintViolationList): array;
}