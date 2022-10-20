<?php

declare(strict_types=1);

namespace App\Validator;

use Stringable;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ErrorsValidatorFactory
{
    /**
     * @return array<int, array<string, string>>
     */
    public static function formatErrors(ConstraintViolationListInterface $violationList): array
    {
        $errors = [];
        foreach ($violationList as $violation) {
            /* @var ConstraintViolation $violation */
            $errors[] = [
                'field' => $violation->getPropertyPath(),
                'message' => (string) $violation->getMessage(),
            ];
        }

        return $errors;
    }
}
