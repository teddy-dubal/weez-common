<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\ZendModelGenerator\Lib\ZendCode;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlock\Tag\ParamTag;
use Zend\Code\Generator\DocBlock\Tag\PropertyTag;
use Zend\Code\Generator\DocBlock\Tag\ReturnTag;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\PropertyGenerator;

/**
 * Description of Entity
 *
 * @author teddy
 */
class EntityItem extends AbstractGenerator
{

    private $data;

    public function getClassArrayRepresentation()
    {
        $this->data      = $this->getData();
        $classProperties = array();
        foreach ($this->data['_columns'] as $column) {
            $comment           = !empty($column['comment']) ? $column['comment'] : '';
            $classProperties[] = PropertyGenerator::fromArray(array(
                        'name'     => $column['capital'],
                        'flags'    => PropertyGenerator::FLAG_PROTECTED,
                        'docblock' => DocBlockGenerator::fromArray(array(
                            'shortDescription' => $comment,
                            'longDescription'  => null,
                            'tags'             => array(
                                new PropertyTag($column['capital'], array($column['phptype'])),
                            )
                        ))
            ));
        }
        foreach ($this->data['foreignKeysInfo'] as $key) {
            $name              = $this->data['relationNameParent'][$key['key_name']] . '_' . $key['column_name'];
            $classProperties[] = PropertyGenerator::fromArray(array(
                        'name'     => $name,
                        'flags'    => PropertyGenerator::FLAG_PROTECTED,
                        'docblock' => DocBlockGenerator::fromArray(array(
                            'shortDescription' => 'Parent relation',
                            'longDescription'  => null,
                            'tags'             => array(
                                new PropertyTag($name, array($this->data['_namespace'] . '\\' . $this->data['className'][$key['key_name']]['foreign_tbl_name']))
                            )
                        ))
            ));
        }
        foreach ($this->data['dependentTables'] as $key) {
            $name              = $this->data['relationNameDependent'][$key['key_name']];
            $longDescr         = sprintf('Type:  %s relationship', ($key['type'] == 'one') ? 'One-to-One' : 'One-to-Many');
            $classProperties[] = PropertyGenerator::fromArray(array(
                        'name'     => $name,
                        'flags'    => PropertyGenerator::FLAG_PROTECTED,
                        'docblock' => DocBlockGenerator::fromArray(array(
                            'shortDescription' => 'Dependent relation ',
                            'longDescription'  => $longDescr,
                            'tags'             => array(
                                new PropertyTag($name, array($this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name']))
                            )
                        ))
            ));
        }
        $constructBody = '$this->setColumnsList(array(' . "\n";
        foreach ($this->data['_columns'] as $column) {
            $constructBody .= '     \'' . $column['field'] . '\' => \'' . $column['capital'] . '\',' . "\n";
        }
        $constructBody .='));' . "\n";
        $constructBody .='$this->setParentList(array(' . "\n";
        foreach ($this->data['foreignKeysInfo'] as $key) {
            $name = $this->data['relationNameParent'][$key['key_name']] . '_' . $key['column_name'];
            $constructBody .= ' \'' . $this->data['capital'][$key['key_name']] . '\' => array(' . "\n";
            $constructBody .= '     \'property\' => \'' . $name . '\',' . "\n";
            $constructBody .= '     \'table_name\' => \'' . $this->data['className'][$key['key_name']]['foreign_tbl_name'] . '\',' . "\n";
            $constructBody .= ' ),' . "\n";
        }
        $constructBody .='));' . "\n";
        $constructBody .='$this->setDependentList(array(' . "\n";
        foreach ($this->data['dependentTables'] as $key) {
            $name = $this->data['relationNameDependent'][$key['key_name']];
            $constructBody .= ' \'' . $this->data['capitalDependent'][$key['key_name']] . '\' => array(' . "\n";
            $constructBody .= '     \'property\' => \'' . $name . '\',' . "\n";
            $constructBody .= '     \'table_name\' => \'' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name'] . '\',' . "\n";
            $constructBody .= ' ),' . "\n";
        }
        $constructBody .='));' . "\n";
        $methods = array(
            array(
                'name'       => '__construct',
                'parameters' => array(
                ),
                'flags'      => MethodGenerator::FLAG_PUBLIC,
                'body'       => $constructBody,
                'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => 'Sets up column and relationship lists',
                            'longDescription'  => null,
                            'tags'             => array(
                                new ParamTag('adapter', array('Adapter')),
                                new ParamTag('entity', array('Entity')),
                            )
                        )
                )
            ),
        );
        $methods = array_merge($methods, $this->getAccessor($this->data));
        return array(
            'name'          => $this->data['_className'],
            'namespacename' => $this->data['_namespace'],
            'extendedclass' => 'Entity',
            'properties'    => $classProperties,
            'methods'       => $methods
        );
    }

    private function getAccessor()
    {
        $methods = array();
        foreach ($this->data['_columns'] as $column) {
            $comment       = 'Sets column ' . $column['field'];
            $comment.= strpos($column['type'], 'datetime') === false ? '' : ' Stored in ISO 8601 format .';
            $constructBody = '';
            if (strpos($column['type'], 'datetime') !== false) {
                $constructBody .= 'if (! empty($data)) {' . "\n";
                $constructBody .= '     if (! $data instanceof \DateTime) {' . "\n";
                $constructBody .= '         $data = new \DateTime($data);' . "\n";
                $constructBody .= '     }' . "\n";
                $constructBody .= '     $data = $data->format (\'YYYY-MM-ddTHH:mm:ss.S\');' . "\n";
                $constructBody .= '}' . "\n";
            }
            $constructBody .= '$this->' . $column['capital'] . ' = $data;' . "\n";
            $constructBody .= 'return $this;' . "\n";
            $methods[]     = array(
                'name'       => 'set' . $column['capital'],
                'parameters' => array('data'),
                'flags'      => MethodGenerator::FLAG_PUBLIC,
                'body'       => $constructBody,
                'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => $comment,
                            'longDescription'  => null,
                            'tags'             => array(
                                new ParamTag('data', array('mixed')),
                            )
                        )
                )
            );
            $comment       = 'Gets column ' . $column['field'];
            $comment.= strpos($column['type'], 'datetime') === false ? '' : ' Stored in ISO 8601 format .';
            $constructBody = '';
            if (strpos($column['type'], 'datetime') !== false) {
                $constructBody .= 'if ($returnDateTime) {' . "\n";
                $constructBody .= '     if ($this->' . $column['capital'] . ' === null) {' . "\n";
                $constructBody .= '         return null;' . "\n";
                $constructBody .= '     }' . "\n";
                $constructBody .= '     return new \DateTime($this->' . $column['capital'] . ',\'YYYY-MM-ddTHH:mm:ss.S\');' . "\n";
                $constructBody .= '}' . "\n";
                $constructBody .= 'return $this->' . $column['capital'] . ';' . "\n";
            } elseif ($column['phptype'] == 'boolean') {
                $constructBody .= 'return $this->' . $column['capital'] . ' ? true : false;' . "\n";
            } else {
                $constructBody .= 'return $this->' . $column['capital'] . ' ;' . "\n";
            }
            $methods[] = array(
                'name'       => 'get' . $column['capital'],
                'parameters' => array(),
                'flags'      => MethodGenerator::FLAG_PUBLIC,
                'body'       => $constructBody,
                'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => $comment,
                            'longDescription'  => null,
                            'tags'             => array(
                                new ReturnTag(array(
                                    'datatype' => $column['phptype'],
                                        )),
                            )
                        )
                )
            );
        }
        return $methods;
    }

    /**
     *
     * @return type
     */
    public function generate()
    {
        $class         = ClassGenerator::fromArray($this->getClassArrayRepresentation());
        $class->addUse($this->data['_namespace'] . '\Entity');
        $fileGenerator = $this->getFileGenerator();
        return $fileGenerator
                        ->setClass($class)
                        ->generate();
    }

}
