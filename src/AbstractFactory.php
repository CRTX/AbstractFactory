<?php

/*
 * This file is part of the CRTX\AbstractFactory package.
 *
 * (c) Christian Ruiz <ruiz.d.christian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CRTX\AbstractFactory;

use ReflectionClass;
use ReflectionNamedType;

/**
  * Abstract factory
  *
  * @author Christian Ruiz <ruiz.d.christian@gmail.com>
  */
abstract class AbstractFactory
{
    public function build($className, array $arguments = array())
    {
        $ReflectedClass = $this->getClassReflection($className);
        $argumentList = $this->modifyBuildArguments(
            $this->buildArgumentList($ReflectedClass, $arguments)
        );
        return $ReflectedClass->newInstanceArgs($argumentList);
    }

    protected function modifyBuildArguments(array &$arguments)
    {
        return $arguments;
    }

    protected function getClassReflection($string)
    {
        $fullClassName = $this->getNamespace() . "\\" . $string;
        $this->ReflectedClass = new ReflectionClass($fullClassName);
        return $this->ReflectedClass;
    }

    protected function getNamespace()
    {
        $class = get_class($this);
        $ReflectionClass = new ReflectionClass($class);
        $this->namespace = $ReflectionClass->getNamespaceName();
        return $this->namespace;
    }

    protected function buildArgumentList(&$ReflectedClass, Array $argumentList)
    {
        return $argumentList;
    }
}
