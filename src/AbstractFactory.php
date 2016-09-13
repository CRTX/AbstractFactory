<?php

namespace CRTX\AbstractFactory;

/**
  * Abstract factory
  *
  * @author Christian Ruiz <ruiz.d.christian@gmail.com>
  */
abstract class AbstractFactory
{
    protected $namespace;
    protected $ReflectedClass;

    public function __construct()
    {
        $this->setNamespace();
    }

    protected function setNamespace()
    {
        $class = get_class($this);
        $R = new \ReflectionClass($class);
        $this->namespace = $R->getNamespaceName();
    }

    public function build($string, array $arguments = array())
    {
        $this->ReflectedClass = new \ReflectionClass($this->namespace . "\\" . $string);
        return $this->ReflectedClass->newInstanceArgs($this->modifyBuildArguments($arguments));
    }

    protected function modifyBuildArguments($arguments)
    {
        return $arguments;
    }
}
