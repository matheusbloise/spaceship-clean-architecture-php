<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\InputBoundary;

use Symfony\Component\Validator\ConstraintViolationListInterface;

interface InputBoundaryInterface
{
    public function validate(InputBoundary $inputBoundary): array;

    public function getFailures(ConstraintViolationListInterface $constraintViolationList): array;
}
