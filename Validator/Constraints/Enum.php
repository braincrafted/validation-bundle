<?php

namespace Braincrafted\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;

/**
 * @Annotation
 */
class Enum extends Constraint
{
    public $message = 'This value must be one of {{ enums }}.';
    public $allowedValues;

    public function __construct($options = null)
    {
        if (null !== $options && is_array($options) && !isset($options['allowedValues'])) {
            $options = array('allowedValues' => $options);
        }

        parent::__construct($options);

        if (null === $this->allowedValues) {
            throw new MissingOptionsException(
                sprintf('The option "allowedValues" must be given for constraint %s.', __CLASS__),
                array('allowedValues')
            );
        }
    }

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}
