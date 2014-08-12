<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\ZendModelGenerator\Lib\ZendCode;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlock\Tag\ParamTag;
use Zend\Code\Generator\DocBlock\Tag\ReturnTag;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\ParameterGenerator;
use Zend\Code\Generator\PropertyGenerator;

/**
 * Description of Entity
 *
 * @author teddy
 */
class Manager extends AbstractGenerator {

    private $data;

    public function getClassArrayRepresentation() {
        $this->data = $this->getData();
        return array(
            'name'          => 'Manager',
            'namespacename' => $this->data['_namespace'] . '\Table',
            'extendedclass' => 'AbstractTableGateway',
            'flags'         => ClassGenerator::FLAG_ABSTRACT,
            'docblock'      => DocBlockGenerator::fromArray(
                array(
                    'shortDescription' => 'Application Model DbTables',
                    'longDescription'  => null,
                    'tags'             => array(
                        array(
                            'name'        => 'package',
                            'description' => $this->data['_namespace'],
                        ),
                        array(
                            'name'        => 'author',
                            'description' => $this->data['_author'],
                        ),
                        array(
                            'name'        => 'copyright',
                            'description' => $this->data['_copyright'],
                        ),
                        array(
                            'name'        => 'license',
                            'description' => $this->data['_license'],
                        ),
                    )
                )
            ),
            'properties'    => array(
                array('entity', null, PropertyGenerator::FLAG_PROTECTED),
                array('container', null, PropertyGenerator::FLAG_PROTECTED),
            ),
            'methods'       => array(
                array(
                    'name'       => '__construct',
                    'parameters' => array(
                        ParameterGenerator::fromArray(array(
                            'name' => 'adapter',
                            //'type' => 'Adapter',
                        )),
                        ParameterGenerator::fromArray(array(
                            'name' => 'entity',
                            'type' => 'Entity',
                        )),
                    ),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       =>
                    '$this->adapter = $adapter;' . "\n" .
                    '$this->entity = $entity;' . "\n" .
                    '$this->featureSet = new Feature\FeatureSet();' . "\n" .
                    '$this->initialize();',
                    'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => 'Constructor',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ParamTag('adapter', array('Adapter')),
                                new ParamTag('entity', array('Entity')),
                            )
                        )
                    )
                ),
                array(
                    'name'       => 'setContainer',
                    'parameters' => array(ParameterGenerator::fromArray(array(
                            'name' => 'c',
                            'type' => 'Pimple',
                        ))),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       =>
                    '$this->container = $c;' . "\n" .
                    'return $this;',
                    'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => 'Inject container',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ParamTag('c', array('Pimple')),
                                new ReturnTag(array(
                                    'datatype' => 'self',
                                    )),
                            )
                        )
                    )
                ),
                array(
                    'name'       => 'getContainer',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => 'return $this->container;',
                    'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => '',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ReturnTag(array(
                                    'datatype' => 'Pimple',
                                    )),
                            )
                        )
                    )
                ),
                array(
                    'name'       => 'all',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => '$select = $this->select();'
                    . '$result = array();' . PHP_EOL
                    . 'foreach ($select as $v) {' . PHP_EOL
                    . '     $result[] = $v->getArrayCopy();' . PHP_EOL
                    . '}' . PHP_EOL
                    . 'return $result;',
                    'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => '',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ReturnTag(array(
                                    'datatype' => 'self',
                                    )),
                            )
                        )
                    )
                ),
                array(
                    'name'       => 'getPrimaryKeyName',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => 'return $this->id;',
                    'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => '',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ReturnTag(array(
                                    'datatype' => 'array|string',
                                    )),
                            )
                        )
                    )
                ),
                array(
                    'name'       => 'getTableName',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => 'return $this->table;',
                    'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => '',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ReturnTag(array(
                                    'datatype' => 'array|string',
                                    )),
                            )
                        )
                    )
                ),
                array(
                    'name'       => 'save',
                    'parameters' => array(ParameterGenerator::fromArray(array(
                            'name' => 'entity',
                            'type' => 'Entity',
                        ))),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       =>
                    '$data = $entity->toArray();' . "\n" .
                    '$returnId = false;' . "\n" .
                    '$id = (int)$data[$this->id];' . "\n" .
                    'if ($id == 0) {' . "\n" .
                    '   $this->insert($data);' . "\n" .
                    '   $returnId = $this->getLastInsertValue();' . "\n" .
                    '} else {' . "\n" .
                    '   if ($this->find($id)) {' . "\n" .
                    '       $returnId = $id;' . "\n" .
                    '       $this->update($data, array($this->id => $id));' . "\n" .
                    '   } else {' . "\n" .
                    '       throw new \Exception(\'Form id does not exit\');' . "\n" .
                    '   }' . "\n" .
                    '}' . "\n" .
                    'return $returnId;',
                    'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => 'Saves current row, and optionally dependent rows',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ParamTag('entity', array('Entity')),
                                new ReturnTag(array(
                                    'datatype' => 'int',
                                    )),
                            )
                        )
                    )
                ),
                array(
                    'name'       => 'deleteEntity',
                    'parameters' => array(ParameterGenerator::fromArray(array(
                            'name' => 'entity',
                            'type' => 'Entity',
                        )),
                        'useTransaction = true'),
                    'flags'      => array(MethodGenerator::FLAG_PUBLIC, MethodGenerator::FLAG_ABSTRACT),
                    'body'       => null,
                    'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => 'Converts database column name to php setter/getter function name',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ParamTag('entity', array('Entity')),
                                new ParamTag('useTransaction', array('boolean')),
                                new ReturnTag(array(
                                    'datatype' => 'int',
                                    )),
                            )
                        )
                    )
                )
            )
        );
    }

    public function generate() {
        $class         = ClassGenerator::fromArray($this->getClassArrayRepresentation());
        $class->addUse('Zend\Db\TableGateway\AbstractTableGateway')
            ->addUse('Zend\Db\TableGateway\Feature')
            ->addUse($this->data['_namespace'] . '\Entity\\Entity')
            ->addUse('Pimple')
            ->addUse('Zend\Db\Adapter\Adapter');
        $fileGenerator = $this->getFileGenerator();
        return $fileGenerator
                ->setClass($class)
                ->generate();
    }

}
