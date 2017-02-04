<?php

namespace CRTX\AbstractFactory;

use ReflectionClass;

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
        return $ReflectedClass->newInstanceArgs($this->modifyBuildArguments($arguments));
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

    protected function modifyBuildArguments(array $arguments)
    {
        return $arguments;
    }
}
