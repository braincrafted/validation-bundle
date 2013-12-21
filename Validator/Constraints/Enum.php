<?php

namespace Braincrafted\Bundle\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;

/**
 * Enum
 *
 * @package    BraincraftedValidationBundle
 * @subpackage Validator
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 *
 * @Annotation
 */
class Enum extends Constraint
{
    /** @var string */
    public $message = 'This value must be one of {{ allowedValues }}.';

    /** @var array */
    public $allowedValues;

    /**
     * @param array $options Options
     *
     * @throw MissingOptionsException when the allowedValues option is missing
     */
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

    /**
     * {@inheritDoc}
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}
