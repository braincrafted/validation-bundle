<?php

namespace Braincrafted\ValidationBundle\Tests\Validator\Constraints;

use Braincrafted\ValidationBundle\Validator\Constraints\Enum;
use Braincrafted\ValidationBundle\Validator\Constraints\EnumValidator;

class EnumValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new EnumValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }

    public function testNullIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, new Enum(array('foo', 'bar')));
    }

    public function testEmptyStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('', new Enum(array('foo', 'bar')));
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new Enum(array('foo', 'bar')));
    }

    public function testValidEnums()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new Enum(array('foo', 'bar'));
        $this->validator->validate('foo', $constraint);
    }

    public function testInvalidEnums()
    {
        $constraint = new Enum(array(
            'allowedValues' => array('foo', 'bar'),
            'message'       => 'myMessage'
        ));
        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage', $this->identicalTo(array(
                '{{ value }}'           => 'foobar',
                '{{ allowedValues }}'   => 'foo, bar'
            )), $this->identicalTo('foobar'), array('foo', 'bar'));

        $this->validator->validate('foobar', $constraint);
    }

    public function testConstraintGetDefaultOption()
    {
        $constraint = new Enum(array('foo'));

        $this->assertEquals(array('foo'), $constraint->allowedValues);
    }
}