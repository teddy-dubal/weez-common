<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\ZendModelGenerator\Lib\ZendCode;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\MethodGenerator;

/**
 * Description of Entity
 *
 * @author teddy
 */
abstract class AbstractGenerator {

    private $fileGenerator;
    private $classGenerator;
    private $methodGenerator;
    private $data;
    private $entityClass;

    public function __construct() {
        $this->fileGenerator   = new FileGenerator();
        $this->classGenerator  = new ClassGenerator();
        $this->methodGenerator = new MethodGenerator();
    }

    public function setData($data = array()) {
        $this->data = $data;
    }

    public function setNamespace($data) {
        $this->data = array_merge($this->data, array('namespace' => $data));
    }

    public function getData() {
        return $this->data;
    }

    public function getFileGenerator() {
        return $this->fileGenerator;
    }

    abstract public function getClassArrayRepresentation();

    public function generate() {
        $class = ClassGenerator::fromArray($this->getClassArrayRepresentation());
        return $this->fileGenerator->setClass($class)->generate();
    }

    /**
     *
     *  removes underscores and capital the letter that was after the underscore
     *  example: 'ab_cd_ef' to 'AbCdEf'
     *
     * @param String $str
     * @return String
     */
    protected function _getCapital($str) {
        $temp = '';
        foreach (explode("_", $str) as $part) {
            $temp.=ucfirst($part);
        }
        return $temp;
    }

}
