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
    public $enums;

    public function __construct($options = null)
    {
        if (null !== $options && is_array($options) && !isset($options['enums'])) {
            $options = array(
                'enums'    => $options
            );
        }

        parent::__construct($options);

        if (null === $this->enums) {
            throw new MissingOptionsException('The option "enums" must be given for constraint ' . __CLASS__, array('enums'));
        }
    }

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}
