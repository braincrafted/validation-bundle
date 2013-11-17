<?php

namespace Braincrafted\Bundle\ValidationBundle\Tests\Validator\Constraints;

use Braincrafted\Bundle\ValidationBundle\Validator\Constraints\Enum;

/**
 * EnumTest
 *
 * @group unit
 */
class EnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Braincrafted\Bundle\ValidationBundle\Validator\Constraints\Enum::__construct()
     * @expectedException Symfony\Component\Validator\Exception\MissingOptionsException
     */
    public function testConstruct()
    {
        new Enum();
    }

    /**
     * @covers Braincrafted\Bundle\ValidationBundle\Validator\Constraints\Enum::validatedBy()
     */
    public function testValidatedBy()
    {
        $enum = new Enum(array('allowedValues' => array()));

        $this->assertRegexp('/EnumValidator$/', $enum->validatedBy());
    }
}
