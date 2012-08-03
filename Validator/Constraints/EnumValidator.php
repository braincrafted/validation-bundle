<?php

namespace Braincrafted\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EnumValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $stringValue = (string) $value;

        if (!in_array($stringValue, $constraint->enums)) {
            $this->context->addViolation($constraint->message, array(
                '{{ value }}'   => $stringValue,
                '{{ enums }}'   => implode(', ', $constraint->enums)
            ), $value, $constraint->enums);
        }
    }
}