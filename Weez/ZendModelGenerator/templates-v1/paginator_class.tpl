<?="<?php\n"?>

namespace <?=$this->_namespace?>\Model;
/**
*
* @package <?=$this->_namespace?>_Model
* @subpackage Paginator
* @author <?=$this->_author."\n"?>
* @copyright <?=$this->_copyright."\n"?>
* @license <?=$this->_license."\n"?>
*/

/**
* Paginator class that extends Zend_Paginator_Adapter_DbSelect to return an
* object instead of an array.
*
* @package <?=$this->_namespace?>_Model
* @subpackage Paginator
* @author <?=$this->_author."\n"?>
*/
class Paginator extends Zend_Paginator_Adapter_DbSelect
{
/**
* Object mapper
*
* @var <?=$this->_namespace?>\Model\MapperAbstract
*/
protected $_mapper = null;

/**
* Constructor.
*
* @param \Zend\Db\Sql\Select $select The select query
* @param <?=$this->_namespace?>\Model\MapperAbstract $mapper The mapper associated with the object type
*/
public function __construct(\Zend\Db\Sql\Select $select, \<?=$this->_namespace?>\Model\Mapper\MapperAbstract $mapper)
{
$this->_mapper = $mapper;
parent::__construct($select);
}

/**
* Returns an array of items as objects for a page.
*
* @param  integer $offset Page offset
* @param  integer $itemCountPerPage Number of items per page
* @return array An array of <?=$this->_namespace?>_ModelAbstract objects
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
