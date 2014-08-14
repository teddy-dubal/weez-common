<?php

namespace Weez\Model;

use \Exception;

class ModelFactory
{

    private $adapter;
    private $container;

    public function __construct($adapter, $container = null)
    {
        $this->adapter   = $adapter;
        $this->container = $container;
    }

    public function get($class_name)
    {
        if (class_exists($class_name)) {
            $class = new $class_name($this->adapter);
            $class->setContainer($this->container);
            return $class;
        }
        throw new Exception("Class Not found");
    }

}
