<?php

namespace CRTX\AbstractFactory\Test;

/*
 * This file is part of the CRTX${0} package.
 *
 * (c) Christian Ruiz <ruiz.d.christian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use ArgumentCountError;
use PHPUnit\Framework\TestCase;
use CRTX\AbstractFactory\Test\DummyAbstractClassFactory;
use CRTX\AbstractFactory\Test\DummyTestRequiredConstructorClass;
use CRTX\AbstractFactory\Test\DummyTestConstructorClass;
use CRTX\AbstractFactory\Test\DummyTestClass;

/**
 * A test class to test that AbstractFactory class builds classes properly.
 *
 * @author Christian Ruiz <ruiz.d.christian@gmail.com>
 */
class AbstractFactoryTest extends TestCase
{
    /**
     * Test build method
     *
     * @return void
     * @author Christian Ruiz <ruiz.d.christian@gmail.com>
     **/
    public function testBuild() : void
    {
        $AbstractClassFactory = new DummyAbstractClassFactory();
        $DummyTestClass = $AbstractClassFactory->build('DummyTestClass');
        $this->assertInstanceOf(DummyTestClass::class, $DummyTestClass);
    }

    /**
     * Test build method
     *
     * @return void
     * @author Christian Ruiz <ruiz.d.christian@gmail.com>
     **/
    public function testConstructorBuild() : void
    {
        $AbstractClassFactory = new DummyAbstractClassFactory();
        $DummyTestConstructorClass = $AbstractClassFactory->build(
            'DummyTestConstructorClass'
        );
        $this->assertInstanceOf(
            DummyTestConstructorClass::class,
            $DummyTestConstructorClass
        );
    }

    /**
     * Test build method
     *
     * @return void
     * @author Christian Ruiz <ruiz.d.christian@gmail.com>
     **/
    public function testConstructorOptionalConstructorBuild() : void
    {
        $AbstractClassFactory = new DummyAbstractClassFactory();
        $DummyTestConstructorClass = $AbstractClassFactory->build(
            'DummyTestConstructorClass',
            array(array())
        );
        $this->assertInstanceOf(
            DummyTestConstructorClass::class,
            $DummyTestConstructorClass
        );
    }

    /**
     * Test build method
     *
     * @return void
     * @author Christian Ruiz <ruiz.d.christian@gmail.com>
     **/
    public function testConstructorOptionalNullConstructorBuild() : void
    {
        $AbstractClassFactory = new DummyAbstractClassFactory();
        $DummyTestConstructorClass = $AbstractClassFactory->build(
            'DummyTestConstructorClass',
            array(null, null, null)
        );
        $this->assertInstanceOf(
            DummyTestConstructorClass::class,
            $DummyTestConstructorClass
        );
    }

    /**
     * Test build method
     *
     * @return void
     * @author Christian Ruiz <ruiz.d.christian@gmail.com>
     **/
    public function testConstructorRequiredNullConstructorBuild() : void
    {
        $AbstractClassFactory = new DummyAbstractClassFactory();
        $DummyTestConstructorClass = $AbstractClassFactory->build(
            'DummyTestRequiredConstructorClass',
            array(null, null, null)
        );
        $this->assertInstanceOf(
            DummyTestRequiredConstructorClass::class,
            $DummyTestConstructorClass
        );
    }

    /**
     * Test build method
     *
     * @return void
     * @author Christian Ruiz <ruiz.d.christian@gmail.com>
     **/
    public function testArgumentCountErrorConstructorBuild() : void
    {
        try {
            $AbstractClassFactory = new DummyAbstractClassFactory();
            $DummyTestConstructorClass = $AbstractClassFactory->build(
                'DummyTestRequiredConstructorClass'
            );
        } catch (ArgumentCountError $e) {
            $throwed = true;
        }
        $this->assertTrue($throwed);
    }
}
