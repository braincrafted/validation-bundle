<?php

/**
 * Enum
 *
 * @category   Constraint
 * @package    BraincraftedValidationBundle
 * @subpackage Validator
 * @author     Florian Eckerstorfer <florian@theroadtojoy.at>
 * @copyright  2012 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/braincrafted/validation-bundle BraincraftedValidationBundle on GitHub
 */

namespace Braincrafted\ValidationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;

/**
 * Enum
 *
 * @category   Constraint
 * @package    BraincraftedValidationBundle
 * @subpackage Validator
 * @author     Florian Eckerstorfer <florian@theroadtojoy.at>
 * @copyright  2012 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/braincrafted/validation-bundle BraincraftedValidationBundle on GitHub
 *
 * @Annotation
 */
class Enum extends Constraint
{
    public $message = 'This value must be one of {{ allowedValues }}.';
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
