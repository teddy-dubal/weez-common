<?php

namespace Weez\ZendModelGenerator\Lib\ZendCode;

use \Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlock\Tag\GenericTag;
use \Zend\Code\Generator\DocBlock\Tag\ParamTag;
use \Zend\Code\Generator\DocBlock\Tag\PropertyTag;
use \Zend\Code\Generator\DocBlock\Tag\ReturnTag;
use \Zend\Code\Generator\DocBlockGenerator;
use \Zend\Code\Generator\MethodGenerator;
use \Zend\Code\Generator\ParameterGenerator;
use \Zend\Code\Generator\PropertyGenerator;

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
        $this->data = $this->getData();

        $methods = $this->getConstructor();
        $methods = array_merge($methods, $this->getAccessor());
        $methods = array_merge($methods, $this->getParentRelation());
        $methods = array_merge($methods, $this->getDependentTables());
        $methods = array_merge($methods, $this->getUtils());


        return array(
            'name'          => $this->data['_className'],
            'namespacename' => $this->data['_namespace'] . '\Entity',
            'extendedclass' => 'Entity',
            'docblock'      => DocBlockGenerator::fromArray(
                    array(
                        'shortDescription' => 'Application Entity',
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
            'properties'    => $this->getProperties(),
            'methods'       => $methods
        );
    }

    private function getProperties()
    {
        $classProperties = array();
        foreach ($this->data['_columns'] as $column) {
            $comment           = !empty($column['comment']) ? $column['comment'] : null;
            $classProperties[] = PropertyGenerator::fromArray(
                array(
                    'name'     => $column['capital'],
                    'flags'    => PropertyGenerator::FLAG_PROTECTED,
                    'docblock' => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => $column['capital'],
                                'longDescription'  => $comment,
                                'tags'             => array(
                                    new GenericTag('var', $column['phptype'] . ' ' . $column['capital']),
                                )
                            )
                        )
                )
            );
        }
        foreach ($this->data['foreignKeysInfo'] as $key) {
            $name              = $this->data['relationNameParent'][$key['key_name']] . $this->_getCapital(
                    $key['column_name']
                );
            $classProperties[] = PropertyGenerator::fromArray(
                array(
                    'name'     => $name,
                    'flags'    => PropertyGenerator::FLAG_PROTECTED,
                    'docblock' => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Parent relation',
                                'longDescription'  => null,
                                'tags'             => array(
                                    new GenericTag('var', '\\'.$this->data['_namespace'] . '\\' . $this->data['className'][$key['key_name']]['foreign_tbl_name'] . ' ' . $name),
                                )
                            )
                        )
                )
            );
        }
        foreach ($this->data['dependentTables'] as $key) {
            $name              = $this->data['relationNameDependent'][$key['key_name']];
            $longDescr         = sprintf(
                'Type:  %s relationship',
                ($key['type'] == 'one') ? 'One-to-One' : 'One-to-Many'
            );
            $classProperties[] = PropertyGenerator::fromArray(
                array(
                    'name'     => $name,
                    'flags'    => PropertyGenerator::FLAG_PROTECTED,
                    'docblock' => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => 'Dependent relation ',
                                'longDescription'  => $longDescr,
                                'tags'             => array(
                                    new GenericTag('var', '\\'.$this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name'] . ' ' . $name),
                                )
                            )
                        )
                )
            );
        }

        return $classProperties;
    }

    private function getConstructor()
    {
        $constructBody = '$this->setColumnsList(array(' . PHP_EOL;
        foreach ($this->data['_columns'] as $column) {
            $constructBody .= '     \'' . $column['field'] . '\' => \'' . $column['capital'] . '\',' . PHP_EOL;
        }
        $constructBody .= '));' . PHP_EOL;
        $constructBody .= '$this->setParentList(array(' . PHP_EOL;
        foreach ($this->data['foreignKeysInfo'] as $key) {
            $name = $this->data['relationNameParent'][$key['key_name']] . $this->_getCapital($key['column_name']);
            $constructBody .= ' \'' . $this->_getCapital($key['key_name']) . '\' => array(' . PHP_EOL;
            $constructBody .= '     \'property\' => \'' . $name . '\',' . PHP_EOL;
            $constructBody .= '     \'table_name\' => \'' . $this->data['className'][$key['key_name']]['foreign_tbl_name'] . '\',' . PHP_EOL;
            $constructBody .= ' ),' . PHP_EOL;
        }
        $constructBody .= '));' . PHP_EOL;
        $constructBody .= '$this->setDependentList(array(' . PHP_EOL;
        foreach ($this->data['dependentTables'] as $key) {
            $name = $this->data['relationNameDependent'][$key['key_name']];
            $constructBody .= ' \'' . $this->_getCapital($key['key_name']) . '\' => array(' . PHP_EOL;
            $constructBody .= '     \'property\' => \'' . $name . '\',' . PHP_EOL;
            $constructBody .= '     \'table_name\' => \'' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name'] . '\',' . PHP_EOL;
            $constructBody .= ' ),' . PHP_EOL;
        }
        $constructBody .= '));' . PHP_EOL;
        $methods = array(
            array(
                'name'       => '__construct',
                'parameters' => array(),
                'flags'      => MethodGenerator::FLAG_PUBLIC,
                'body'       => $constructBody,
                'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => 'Sets up column and relationship lists',
                            'longDescription'  => null,
                        )
                    )
            ),
        );

        return $methods;
    }

    private function getAccessor()
    {
        $methods = array();
        foreach ($this->data['_columns'] as $column) {
            $comment = 'Sets column ' . $column['field'];
            $comment .= strpos($column['type'], 'datetime') === false ? '' : ' Stored in ISO 8601 format .';
            $constructBody = '';
            if (strpos($column['type'], 'datetime') !== false) {
                $constructBody .= 'if (! empty($data)) {' . PHP_EOL;
                $constructBody .= '    if (! $data instanceof \DateTime) {' . PHP_EOL;
                $constructBody .= '        $data = new \DateTime($data);' . PHP_EOL;
                $constructBody .= '    }' . PHP_EOL;
                $constructBody .= '    $data = $data->format(\DateTime::ISO8601);' . PHP_EOL;
                $constructBody .= '}' . PHP_EOL;
            }
            $constructBody .= '$this->' . $column['capital'] . ' = $data;' . PHP_EOL;
            $constructBody .= 'return $this;' . PHP_EOL;
            $methods[] = array(
                'name'       => 'set' . $column['capital'],
                'parameters' => array('data'),
                'flags'      => MethodGenerator::FLAG_PUBLIC,
                'body'       => $constructBody,
                'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => $comment,
                            'longDescription'  => null,
                            'tags'             => array(
                                new ParamTag('data', $column['phptype'],$column['field']),
                                new ReturnTag(array(
                                    'datatype' => 'self',
                                )),
                            )
                        )
                    )
            );
            $comment   = 'Gets column ' . $column['field'];
            $comment .= strpos($column['type'], 'datetime') === false ? '' : ' Stored in ISO 8601 format .';
            $constructBody = '';
            $parameters    = array();
            $tags          = array(
                new ReturnTag(array(
                    'datatype' => $column['phptype'],
                )),
            );
            if (strpos($column['type'], 'datetime') !== false) {
                $parameters = array(
                    ParameterGenerator::fromArray(
                        array(
                            'name'         => 'returnDateTime',
                            'defaultvalue' => false,
                        )
                    )
                );
                array_unshift($tags, new ParamTag('returnDateTime', array('boolean'),'Should we return a DateTime object'));
                $constructBody .= 'if ($returnDateTime) {' . PHP_EOL;
                $constructBody .= '    if ($this->' . $column['capital'] . ' === null) {' . PHP_EOL;
                $constructBody .= '        return null;' . PHP_EOL;
                $constructBody .= '    }' . PHP_EOL;
                $constructBody .= '    return new \DateTime($this->' . $column['capital'] . ');' . PHP_EOL;
                $constructBody .= '}' . PHP_EOL;
                $constructBody .= 'return $this->' . $column['capital'] . ';' . PHP_EOL;
            } elseif ($column['phptype'] == 'boolean') {
                $constructBody .= 'return $this->' . $column['capital'] . ' ? true : false;' . PHP_EOL;
            } else {
                $constructBody .= 'return $this->' . $column['capital'] . ' ;' . PHP_EOL;
            }

            $methods[] = array(
                'name'       => 'get' . $column['capital'],
                'parameters' => $parameters,
                'flags'      => MethodGenerator::FLAG_PUBLIC,
                'body'       => $constructBody,
                'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => $comment,
                            'longDescription'  => null,
                            'tags'             => $tags
                        )
                    )
            );
        }

        return $methods;
    }

    private function getParentRelation()
    {
        $methods = array();
        foreach ($this->data['foreignKeysInfo'] as $key) {
            $comment       = 'Sets parent relation ' . $this->data['className'][$key['key_name']]['column_name'];
            $constructBody = '';
            $constructBody .= '$entityManager = new ' . '\\' . $this->data['_namespace'] . '\\Table\\' . $this->data['className'][$key['key_name']]['foreign_tbl_name'] . '();' . PHP_EOL;
            $constructBody .= '$this->' . $this->data['relationNameParent'][$key['key_name']] . $this->_getCapital(
                    $key['column_name']
                ) . ' = $data;' . PHP_EOL;
            $constructBody .= '$primary_key = $entityManager->getPrimaryKeyName();' . PHP_EOL;
            if (is_array($key['foreign_tbl_column_name']) && is_array($key['column_name'])) {
                while ($column = next($key['foreign_tbl_column_name'])) {
                    $foreign_column = next($key['column_name']);
                    $constructBody .= '$this->set' . $this->_getCapital(
                            $column
                        ) . '($primary_key[\'' . $foreign_column . '\']);' . PHP_EOL;
                }
            } else {
                $constructBody .= 'if (is_array($primary_key)) {' . PHP_EOL;
                $constructBody .= '     $primary_key = $primary_key[\'' . $key['foreign_tbl_column_name'] . '\'];' . PHP_EOL;
                $constructBody .= '}' . PHP_EOL;
                $constructBody .= '$this->set' . $this->_getCapital($key['column_name']) . '($primary_key);' . PHP_EOL;
            }
            $constructBody .= 'return $this;' . PHP_EOL;
            $methods[]     = array(
                'name'       => 'set' . $this->data['relationNameParent'][$key['key_name']] . $this->_getCapital(
                        $key['column_name']
                    ),
                'parameters' => array(
                    ParameterGenerator::fromArray(
                        array(
                            'name' => 'data',
                            'type' => '\\' . $this->data['_namespace'] . '\\Entity\\' . $this->data['className'][$key['key_name']]['foreign_tbl_name'],
                        )
                    )
                ),
                'flags'      => MethodGenerator::FLAG_PUBLIC,
                'body'       => $constructBody,
                'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => $comment,
                            'longDescription'  => null,
                            'tags'             => array(
                                new ParamTag('data', array('\\' . $this->data['_namespace'] . '\\Entity\\' . $this->data['className'][$key['key_name']]['foreign_tbl_name'])),
                                new ReturnTag(array('datatype' => '\\' . $this->data['_namespace'] . '\\Entity\\' . $this->data['_className']))
                            )
                        )
                    )
            );
            $comment       = 'Gets parent ' . $this->data['className'][$key['key_name']]['column_name'];
            $constructBody = '';
            $constructBody .= 'return $this->' . $this->data['relationNameParent'][$key['key_name']] . $this->_getCapital(
                    $key['column_name']
                ) . ';' . PHP_EOL;
            $methods[] = array(
                'name'       => 'get' . $this->data['relationNameParent'][$key['key_name']] . $this->_getCapital(
                        $key['column_name']
                    ),
                'parameters' => array(),
                'flags'      => MethodGenerator::FLAG_PUBLIC,
                'body'       => $constructBody,
                'docblock'   => DocBlockGenerator::fromArray(
                        array(
                            'shortDescription' => $comment,
                            'longDescription'  => null,
                            'tags'             => array(
                                new ReturnTag(array('datatype' => '\\' . $this->data['_namespace'] . '\\' . $this->data['className'][$key['key_name']]['foreign_tbl_name']))
                            )
                        )
                    )
            );
        }

        return $methods;
    }

    private function getDependentTables()
    {
        $methods = array();
        foreach ($this->data['dependentTables'] as $key) {
            if ($key['type'] == 'one') {
                $comment       = 'Sets dependent relation ' . $key['key_name'];
                $constructBody = '';
                $constructBody .= '$this->' . $this->data['relationNameDependent'][$key['key_name']] . ' = $data;' . PHP_EOL;
                $constructBody .= 'return $this;' . PHP_EOL;
                $methods[]     = array(
                    'name'       => 'set' . $this->data['relationNameDependent'][$key['key_name']],
                    'parameters' => array(
                        ParameterGenerator::fromArray(
                            array(
                                'name' => 'data',
                                'type' => '\\' . $this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name'],
                            )
                        )
                    ),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => $constructBody,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => $comment,
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('data', array('\\' . $this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name'])),
                                    new ReturnTag(array('datatype' => 'self'))
                                )
                            )
                        )
                );
                $comment       = 'Gets dependent ' . $key['key_name'];
                $constructBody = '';
                $constructBody .= 'return $this->' . $this->data['relationNameDependent'][$key['key_name']] . ';' . PHP_EOL;
                $methods[] = array(
                    'name'       => 'get' . $this->data['relationNameDependent'][$key['key_name']],
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => $constructBody,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => $comment,
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ReturnTag(array('datatype' => '\\' . $this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name']))
                                )
                            )
                        )
                );
            } else {
                $comment       = 'Sets dependent relation ' . $key['key_name'];
                $constructBody = '';
                $constructBody .= 'foreach ($data as $object) {' . PHP_EOL;
                $constructBody .= '     $this->add' . $this->data['relationNameDependent'][$key['key_name']] . '($object);' . PHP_EOL;
                $constructBody .= '}' . PHP_EOL;
                $constructBody .= 'return $this;' . PHP_EOL;
                $methods[]     = array(
                    'name'       => 'set' . $this->data['relationNameDependent'][$key['key_name']],
                    'parameters' => array(
                        ParameterGenerator::fromArray(
                            array(
                                'name' => 'data',
                                'type' => 'array',
                            )
                        )
                    ),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => $constructBody,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => $comment,
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('data', array('array'),' array of \\' . $this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name']),
                                    new ReturnTag(array('datatype' => 'self'))
                                )
                            )
                        )
                );
                $comment       = 'Gets dependent ' . $key['key_name'];
                $constructBody = '';
                $constructBody .= 'return $this->' . $this->data['relationNameDependent'][$key['key_name']] . ';' . PHP_EOL;
                $methods[]     = array(
                    'name'       => 'get' . $this->data['relationNameDependent'][$key['key_name']],
                    'parameters' => array(),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => $constructBody,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => $comment,
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ReturnTag(array('datatype' => 'array'),'array of \\' . $this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name'])
                                )
                            )
                        )
                );
                $comment       = 'Sets dependent relations ' . $key['key_name'];
                $constructBody = '';
                $constructBody .= '$this->' . $this->data['relationNameDependent'][$key['key_name']] . '[] = $data;' . PHP_EOL;
                $constructBody .= 'return $this;' . PHP_EOL;
                $methods[] = array(
                    'name'       => 'add' . $this->data['relationNameDependent'][$key['key_name']],
                    'parameters' => array(
                        ParameterGenerator::fromArray(
                            array(
                                'name' => 'data',
                                'type' => '\\' . $this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name'],
                            )
                        )
                    ),
                    'flags'      => MethodGenerator::FLAG_PUBLIC,
                    'body'       => $constructBody,
                    'docblock'   => DocBlockGenerator::fromArray(
                            array(
                                'shortDescription' => $comment,
                                'longDescription'  => null,
                                'tags'             => array(
                                    new ParamTag('data', array('\\' . $this->data['_namespace'] . '\\' . $this->data['classNameDependent'][$key['key_name']]['foreign_tbl_name']),$comment),
                                    new ReturnTag(array('datatype' => 'self'))
                                )
                            )
                        )
                );
            }
        }

        return $methods;
    }

    private function getUtils()
    {
        $constructBody = '';
        foreach ($this->data['_columns'] as $column) {
            $constructBody .= '$this->' . $column['capital'] . ' = (isset($data[\'' . $column['field'] . '\'] )) ? $data[\'' . $column['field'] . '\'] : null;' . PHP_EOL;
        }
        $constructBody .= 'return $this;';
        $methods[]     = array(
            'name'       => 'exchangeArray',
            'parameters' => array(
                ParameterGenerator::fromArray(
                    array(
                        'name' => 'data',
                        'type' => 'array',
                    )
                )
            ),
            'flags'      => MethodGenerator::FLAG_PUBLIC,
            'body'       => $constructBody,
            'docblock'   => DocBlockGenerator::fromArray(
                    array(
                        'shortDescription' => 'Array of options/values to be set for this model.',
                        'longDescription'  => 'Options without a matching method are ignored.',
                        'tags'             => array(
                            new ParamTag('data', array('array'),'array of values to set'),
                            new ReturnTag(array('datatype' => 'self')),
                        )
                    )
                )
        );
        $constructBody = '';
        $constructBody .= '$result = array(' . PHP_EOL;
        foreach ($this->data['_columns'] as $column) {
            $constructBody .= '     \'' . $column['field'] . '\' => $this->get' . $column['capital'] . '(),' . PHP_EOL;
        }
        $constructBody .= ');' . PHP_EOL;
        $constructBody .= 'return $result;' . PHP_EOL;
        $methods[] = array(
            'name'       => 'toArray',
            'parameters' => array(),
            'flags'      => MethodGenerator::FLAG_PUBLIC,
            'body'       => $constructBody,
            'docblock'   => DocBlockGenerator::fromArray(
                    array(
                        'shortDescription' => 'Returns an array, keys are the field names.',
                        'longDescription'  => null,
                        'tags'             => array(
                            new ReturnTag(array('datatype' => 'array')),
                        )
                    )
                )
        );

        return $methods;
    }

    /**
     *
     * @return type
     */
    public function generate()
    {
        $class = ClassGenerator::fromArray($this->getClassArrayRepresentation());
        $class
            ->addUse($this->data['_namespace'] . '\Entity\\Entity');
        $this->defineFileInfo($class);
        $fileGenerator = $this->getFileGenerator();

        return $fileGenerator
            ->setClass($class)
            ->generate();
    }

}
