<?php

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

    protected function modifyBuildArguments(array $arguments) : Array
    {
        return $arguments;
    }

    protected function getClassReflection($string)
    {
        $fullClassName = $this->getNamespace() . "\\" . $string;
        $this->ReflectedClass = new ReflectionClass($fullClassName);
        return $this->ReflectedClass;
    }

    protected function getNamespace() : String
    {
        $class = get_class($this);
        $ReflectionClass = new ReflectionClass($class);
        $this->namespace = $ReflectionClass->getNamespaceName();
        return $this->namespace;
    }

    protected function buildArgumentList(&$ReflectedClass, Array $argumentList) : Array
    {
        $ReflectedMethod = $ReflectedClass->getMethod('__construct');

        $reflectedMethodList = $ReflectedMethod->getParameters();

        for ($i = 0; $i < sizeof($reflectedMethodList); $i++) {
            $parameterType = $reflectedMethodList[$i]->getType();
            $parameterTypeName = null;

            if ($parameterType instanceof ReflectionNamedType) {
                $parameterTypeName = $parameterType->getName();
            }

            $parameterIsOptional = $reflectedMethodList[$i]->isOptional();
            $argumentEmpty = empty($argumentList[$i]);

            if(
                $argumentEmpty &&
                $parameterTypeName === 'array' &&
                $parameterIsOptional == true
            ) {
                $argumentList[$i] = array();
            }
        }

        return $argumentList;
    }
}
