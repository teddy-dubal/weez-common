<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\ZendModelGenerator\Lib\ZendCode;

use Zend\Code\Generator\DocBlock\Tag\ParamTag;
use Zend\Code\Generator\DocBlock\Tag\ReturnTag;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\MethodGenerator;

/**
 * Description of Entity
 *
 * @author teddy
 */
class Entity extends AbstractGenerator
{

    public function getClassArrayRepresentation()
    {
        $data = $this->getData();
        return array(
            'name'          => 'Entity',
            'namespacename' => $data['_namespace'],
            'methods'       => array(
                array(
                    'name'       => 'setColumnsList',
                    'parameters' => array('data'),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => '$this->_columnsList = $data;' . "\n" . 'return $this;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Set the list of columns associated with this model',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('data', array('array')),
                                    new ReturnTag(array(
                                        'datatype' => 'self',
                                            )),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'getColumnsList',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => 'return $this->_columnsList;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Returns columns list array',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ReturnTag(array(
                                        'datatype' => 'array',
                                            )),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'setParentList',
                    'parameters' => array('data'),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => '$this->_parentList = $data;' . "\n" . 'return $this;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Set the list of relationships associated with this model',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('data', array('array')),
                                    new ReturnTag(array(
                                        'datatype' => 'self',
                                            )),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'getParentList',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => 'return $this->_parentList;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Returns relationship list array',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ReturnTag(array(
                                        'datatype' => 'array',
                                            )),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'setDependentList',
                    'parameters' => array('data'),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => '$this->_dependentList = $data;' . "\n" . 'return $this;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Set the list of relationships associated with this model',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('data', array('array')),
                                    new ReturnTag(array(
                                        'datatype' => 'self',
                                            )),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'getDependentList',
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => 'return $this->_dependentList;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Returns relationship list array',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ReturnTag(array(
                                        'datatype' => 'array',
                                            )),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'columnNameToVar',
                    'parameters' => array('column'),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => 'if (! isset($this->_columnsList[$column])) {' . "\n" .
                    '   throw new \Exception("column \'$column\' not found!");' . "\n" .
                    '}' . "\n" .
                    'return $this->_columnsList[$column];',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Converts database column name to php setter/getter function name',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('column', array('string')),
                                    new ReturnTag(array(
                                        'datatype' => 'self',
                                            )),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'varNameToColumn',
                    'parameters' => array('thevar'),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       =>
                    'foreach ($this->_columnsList as $column => $var) {' . "\n" .
                    '   if ($var == $thevar) {' . "\n" .
                    '       return $column;' . "\n" .
                    '   }' . "\n" .
                    '}' . "\n" .
                    'return null;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Converts database column name to PHP setter/getter function name',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('thevar', array('string')),
                                    new ReturnTag(array(
                                        'datatype' => 'self',
                                            )),
                                )
                            )
                    )
                ),
                array(
                    'name'       => 'setOptions',
                    'parameters' => array('options'),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       =>
                    '$this->exchangeArray($options);' . "\n" .
                    'return $this;',
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Array of options/values to be set for this model. Options without a matching method are ignored.',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('options', array('array')),
                                    new ReturnTag(array(
                                        'datatype' => 'self',
                                            )),
                                )
                            )
                    )
                ),
            )
        );
    }

}
