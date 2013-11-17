BraincraftedValidationBundle
============================

Handcrafted in Vienna by [Florian Eckerstorfer](http://florianeckerstorfer.com).

[![Build Status](https://secure.travis-ci.org/braincrafted/validation-bundle.png?branch=master)](http://travis-ci.org/braincrafted/validation-bundle)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/braincrafted/validation-bundle/badges/quality-score.png?s=6d50a21a93c38fe1a2a6527eaaa64079dac394c5)](https://scrutinizer-ci.com/g/braincrafted/validation-bundle/)
[![Code Coverage](https://scrutinizer-ci.com/g/braincrafted/validation-bundle/badges/coverage.png?s=50b60e54bc0691301748390e8c7e74636ed1bf53)](https://scrutinizer-ci.com/g/braincrafted/validation-bundle/)


Installation
------------

**BraincraftedValidationBundle** can be installed using Commposer.

    {
        "require": {
            "braincrafted/validation-bundle": "@stable"
        }
    }

Replace `@stable` with the latest stable release.


Usage
-----

If **BraincraftedValidationBundle** has been added to the project, its validators can be used just like every other Symfony2 validator.

### Using with YAML

    # src/Acme/BlogBundle/Resources/config/validation.yml
    Acme\DemoBundle\Entity\AcmeEntity:
        properties:
            name:
                - NotBlank: ~
                - Braincrafted\Bundle\ValidationBundle\Validator\Constraints\Enum:
                    allowedValues: ["ACTIVE", "PAUSED", "DELETED"]

### Using with Annotations

    // src/Acme/DemoBundle/Entity/AcmeEntity.php
    use Symfony\Component\Validator\Constraints as Assert;
    use Braincrafted\Bundle\ValidationBundle\Validator\Constraints as BraincraftedAssert;

    class AcmeEntity
    {
        // ...

        /**
         * @Assert\NotBlank
         * @BraincraftedAssert\Enum(allowedValues={"ACTIVE", "PAUSED, "DELETED""})
         */
        protected $status;

        // ...
    }

### Using with XML

    <!-- src/Acme/DemoBundle/Resources/config/validation.xml -->
    <?xml version="1.0" encoding="UTF-8" ?>
    <constraint-mapping xmlns="http://symfony.com/schema/dic/constraint-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://symfony.com/schema/dic/constraint-mapping http://symfony.com/schema/dic/constraint-mapping/constraint-mapping-1.0.xsd">

        <class name="Acme\DemoBundle\Entity\AcmeEntity">
            <property name="name">
                <constraint name="NotBlank" />
                <constraint name="Braincrafted\Bundle\ValidationBundle\Validator\Constraints\Enum">
                    <option name="allowedValues">
                        <value>ACTIVE</value>
                        <value>PAUSED</value>
                        <value>DELETED</value>
                    </option>
                </constraint>
            </property>
        </class>
    </constraint-mapping>

### Using with PHP

    // src/Acme/DemoBundle/Entity/AcmeEntity.php
    use Symfony\Component\Validator\Mapping\ClassMetadata;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Braincrafted\Bundle\ValidationBundle\Validator\Constraints\Enum;

    class AcmeEntity
    {
        public $name;

        public static function loadValidatorMetadata(ClassMetadata $metadata)
        {
            $metadata->addPropertyConstraint('status', new NotBlank());
            $metadata->addPropertyConstraint('status', new Enum(array('ACTIVE', 'PAUSED', 'DELETED')));
        }
    }


Available Validators
--------------------

### Enum

- Options:
    - `string` message
    - `array` allowedValues


Changelog
---------

### Version 0.2 (17 November 2013)

- Changed namespace to `Braincrafted\Bundle\ValidationBundle`


License
--------

### The MIT License (MIT)

Copyright (c) 2012-2013 Florian Eckerstorfer

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

