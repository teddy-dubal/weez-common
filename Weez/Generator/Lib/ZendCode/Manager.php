<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\Generator\Lib\ZendCode;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlock\Tag\GenericTag;
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
class Manager extends AbstractGenerator
{

    private $tableGatewayClass    = 'AbstractTableGateway';
    private $useTableGatewayClass = 'Zend\Db\TableGateway\AbstractTableGateway';
    private $data;

    public function getClassArrayRepresentation()
    {
        $this->data = $this->getData();

        return array(
            'name'          => 'Manager',
            'namespacename' => $this->data['_namespace'] . '\Table',
            'extendedclass' => $this->tableGatewayClass,
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
                PropertyGenerator::fromArray(
                    array(
                        'name'         => 'wasInTransaction',
                        'defaultvalue' => false,
                        'flags'        => PropertyGenerator::FLAG_PROTECTED,
                        'docblock'     => DocBlockGenerator::fromArray(
                                array(
                                    'shortDescription' => 'True if we were already in a transaction when try to start a new one',
                                    'longDescription'  => '',
                                    'tags'             => array(
                                        new GenericTag('var', 'bool'),
                                    )
                                )
                            )
                    )
                ),
            ),
            'methods'       => array(
                array(
                    'name'       => '__construct',
                    'parameters' => array(
                        ParameterGenerator::fromArray(
                            array(
                                'name' => 'adapter',
                                //'type' => 'Adapter',
                            )
                        ),
                        ParameterGenerator::fromArray(
                            array(
                                'name' => 'entity',
                                'type' => 'Entity',
                            )
                        ),
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
                    'parameters' => array(
                        ParameterGenerator::fromArray(
                            array(
                                'name' => 'c',
                                'type' => 'Container',
                            )
                        )
                    ),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       =>
                        '$this->container = $c;' . "\n" .
                        'return $this;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Inject container',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('c', array('Container')),
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
                                        'datatype' => 'Container',
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
                    'name'       => 'findBy',
                    'parameters' => array(
                        ParameterGenerator::fromArray(array(
                            'name'         => 'criteria',
                            'defaultvalue' => array(),
                            'type'         => 'array',
                        )),
                        ParameterGenerator::fromArray(array(
                            'name'         => 'order',
                            'defaultvalue' => null,
                        )),
                        ParameterGenerator::fromArray(array(
                            'name'         => 'limit',
                            'defaultvalue' => null,
                        )),
                        ParameterGenerator::fromArray(array(
                            'name'         => 'offset',
                            'defaultvalue' => null,
                        )),
                        ParameterGenerator::fromArray(array(
                            'name'         => 'toEntity',
                            'defaultvalue' => false,
                        )),
                    ),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => '$r = $this->sql->select()->where($criteria);' . PHP_EOL .
                    'if ($order) {' . PHP_EOL .
                    '      $r->order($order);' . PHP_EOL .
                    '}' . PHP_EOL .
                    'if ($limit) {' . PHP_EOL .
                    '      $r->limit($limit);' . PHP_EOL .
                    '}' . PHP_EOL .
                    'if ($offset) {' . PHP_EOL .
                    '      $r->offset($offset);' . PHP_EOL .
                    '}' . PHP_EOL .
                    '$result = $this->selectWith($r)->toArray();' . PHP_EOL .
                    'if ($toEntity) {' . PHP_EOL .
                    '    foreach($result as &$v){' . PHP_EOL .
                    '        $entity =  clone $this->entity;' . PHP_EOL .
                    '        $v = $entity->exchangeArray($v);' . PHP_EOL .
                    '    }' . PHP_EOL .
                    '}' . PHP_EOL .
                    'return $result;' . PHP_EOL,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Find by criteria',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('criteria', array('array'), 'Search criteria'),
                                    new ParamTag('order', array('string'), 'sorting option'),
                                    new ParamTag('limit', array('int'), 'limit option'),
                                    new ParamTag('offset', array('int'), 'offset option'),
                                    new ParamTag('toEntity', array('boolean'), 'return entity result'),
                                    new ReturnTag(array('array'), '' ),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'countBy',
                    'parameters' => array(
                        ParameterGenerator::fromArray(array(
                            'name'         => 'criteria',
                            'defaultvalue' => array(),
                            'type'         => 'array',
                        )),
                    ),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => '$r = $this->sql->select()->columns(array("count" => new Expression("count(*)")))->where($criteria);' . PHP_EOL .
                    'return  (int)current($this->selectWith($r)->toArray())["count"];' . PHP_EOL,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Count by criteria',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('criteria', array('array'), 'Criteria'),
                                    new ReturnTag(array('int'), ''),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'deleteEntity',
                    'parameters' => array(
                        ParameterGenerator::fromArray(
                            array(
                                'name' => 'entity',
                                'type' => 'Entity',
                            )
                        ),
                        'useTransaction = true'
                    ),
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
                ),
                array(
                    'name'       => 'beginTransaction',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PROTECTED,
                    'body'       => <<<'BODY'
if ($this->adapter->getDriver()->getConnection()->inTransaction()) {
    $this->wasInTransaction = true;

    return;
}
$this->adapter->getDriver()->getConnection()->beginTransaction();
BODY
                ,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Begin a transaction',
                                'longDescription'  => null,
                                'tags'             => array(),
                            )
                        )
                ),
                array(
                    'name'       => 'rollback',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PROTECTED,
                    'body'       => <<<'BODY'
if ($this->wasInTransaction) {
    throw new \Exception('Inside transaction rollback call');
}
$this->adapter->getDriver()->getConnection()->rollback();
BODY
                ,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Rollback a transaction',
                                'longDescription'  => null,
                                'tags'             => array(),
                            )
                        )
                ),
                array(
                    'name'       => 'commit',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PROTECTED,
                    'body'       => <<<'BODY'
if (!$this->wasInTransaction) {
    $this->adapter->getDriver()->getConnection()->commit();
}
BODY
                ,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => ' Commit a transaction',
                                'longDescription'  => null,
                                'tags'             => array(),
                            )
                        )
                ),
            )
        );
    }

    public function generate()
    {
        $class = ClassGenerator::fromArray($this->getClassArrayRepresentation());
        $class->addUse($this->useTableGatewayClass)
                ->addUse('Zend\Db\TableGateway\Feature')
            ->addUse('Zend\Db\Sql\Expression')
                ->addUse($this->data['_namespace'] . '\Entity\Entity')
            ->addUse('Pimple\Container')
            ->addUse('Zend\Db\Adapter\Adapter');
        $this->defineFileInfo($class);
        $fileGenerator = $this->getFileGenerator();

        return $fileGenerator
            ->setClass($class)
            ->generate();
    }

    /**
     * @param string $tableGatewayClass
     *
     * @return self
     */
    public function setTableGatewayClass($tableGatewayClass)
    {
        $this->tableGatewayClass = $tableGatewayClass;

        return $this;
    }

    /**
     * @param string $useTableGatewayClass
     *
     * @return self
     */
    public function setUseTableGatewayClass($useTableGatewayClass)
    {
        $this->useTableGatewayClass = $useTableGatewayClass;

        return $this;
    }

}
