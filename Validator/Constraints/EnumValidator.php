<?php

/**
 * EnumValidator
 *
 * @category   Validator
 * @package    BraincraftedValidationBundle
 * @subpackage Validator
 * @author     Florian Eckerstorfer <florian@theroadtojoy.at>
 * @copyright  2012 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/braincrafted/validation-bundle BraincraftedValidationBundle on GitHub
 */

namespace Braincrafted\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * EnumValidator
 *
 * @category   Validator
 * @package    BraincraftedValidationBundle
 * @subpackage Validator
 * @author     Florian Eckerstorfer <florian@theroadtojoy.at>
 * @copyright  2012 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/braincrafted/validation-bundle BraincraftedValidationBundle on GitHub
 */
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

        if (!in_array($stringValue, $constraint->allowedValues)) {
            $this->context->addViolation($constraint->message, array(
                '{{ value }}'           => $stringValue,
                '{{ allowedValues }}'   => implode(', ', $constraint->allowedValues)
            ), $value, $constraint->allowedValues);
        }
    }
}