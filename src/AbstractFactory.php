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
    protected $buildArguments;

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
        $this->modifyBuildArguments($arguments);
        $reflection = new \ReflectionClass($this->namespace . $string);
        return $reflection->newInstanceArgs($this->buildArguments);
    }

    protected function modifyBuildArguments($arguments)
    {
        $this->buildArguments = $arguments;
    }
}
