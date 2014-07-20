<?php

namespace Weez\Model;

use \Exception;

class ModelFactory {

    private $adapter;

    public function __construct($adapter) {
        $this->adapter = $adapter;
    }

    public function get($class_name) {
        if (class_exists($class_name)) {
            return new $class_name($this->adapter);
        }
        throw new Exception("Class Not found");
    }

}
