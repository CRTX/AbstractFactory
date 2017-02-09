<?php

/*
 * This file is part of the CRTX${0} package.
 *
 * (c) Christian Ruiz <ruiz.d.christian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CRTX\AbstractFactory\Test;

/**
 * Dummy class to test class AbstractFactory
 *
 * @author Christian Ruiz <ruiz.d.christian@gmail.com>
 */
class DummyTestRequiredConstructorClass
{
    /**
     * @var string
     */
    public $testString;

    /**
     * @var array
     */
    public $testArray;

    /**
     * Dummy constructor for testing
     *
     * @return void
     * @author Christian Ruiz <ruiz.d.christian@gmail.com>
     **/
    public function __construct(?String $testString, ?Array $testArray, ?DummyTestClass $dummyClass){}
}
