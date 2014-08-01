<?php

namespace Weez\Core\Model\Model;
/**
*
* @package Weez\Core\Model_Model
* @subpackage Paginator
* @author T.ED <teddy.dubal@gmail.com>
* @copyright ZF model generator
* @license http://framework.zend.com/license/new-bsd     New BSD License
*/

/**
* Paginator class that extends Zend_Paginator_Adapter_DbSelect to return an
* object instead of an array.
*
* @package Weez\Core\Model_Model
* @subpackage Paginator
* @author T.ED <teddy.dubal@gmail.com>
*/
class Paginator extends Zend_Paginator_Adapter_DbSelect
{
/**
* Object mapper
*
* @var Weez\Core\Model\Model\MapperAbstract
*/
protected $_mapper = null;

/**
* Constructor.
*
* @param \Zend\Db\Sql\Select $select The select query
* @param Weez\Core\Model\Model\MapperAbstract $mapper The mapper associated with the object type
*/
public function __construct(\Zend\Db\Sql\Select $select, \Weez\Core\Model\Model\Mapper\MapperAbstract $mapper)
{
$this->_mapper = $mapper;
parent::__construct($select);
}

/**
* Returns an array of items as objects for a page.
*
* @param  integer $offset Page offset
* @param  integer $itemCountPerPage Number of items per page
* @return array An array of Weez\Core\Model_ModelAbstract objects
*/
public function getItems($offset, $itemCountPerPage)
{
$items = parent::getItems($offset, $itemCountPerPage);
$objects = array();

foreach ($items as $item) {
$objects[] = $this->_mapper->loadModel($item, null);
}

return $objects;
}
}
