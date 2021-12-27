<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\InputBoundary;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class InputBoundary implements InputBoundaryInterface
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function validate(InputBoundary $inputBoundary): array
    {
        return $this->getFailures(
            $this->validator->validate($inputBoundary)
        );
    }

    public function getFailures(ConstraintViolationListInterface $constraintViolationList): array
    {
        $messages = [];
        foreach ($constraintViolationList as $violation) {
            $messages[$violation->getPropertyPath()][] = $violation->getMessage();
        }
        return $messages;
    }
}
