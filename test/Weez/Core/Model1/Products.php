<?php

namespace Weez\Core\Model\Model;
/**
* Application Models
*
* @package Weez\Core\Model\Model
* @subpackage Model
* @author T.ED <teddy.dubal@gmail.com>
* @copyright ZF model generator
* @license http://framework.zend.com/license/new-bsd     New BSD License
*/


/**
* 
*
* @package Weez\Core\Model\Model
* @subpackage Model
* @author T.ED <teddy.dubal@gmail.com>
*/
class Products extends ModelAbstract
{

/**
* Database var type int(11)
*
* @var int
*/
protected $_ProductId;

/**
* Database var type varchar(100)
*
* @var string
*/
protected $_ProductName;



/**
* Dependent relation bugs_products_ibfk_2
* Type: One-to-Many relationship
*
* @var Weez\Core\Model\Model\BugsProducts
*/
protected $_BugsProducts;

/**
* Sets up column and relationship lists
*/
public function __construct($adapter = null)
{
parent::init();
if (null != $adapter){
$this->getMapper()->getDbTable(array('db' => $adapter));
}
$this->setColumnsList(array(
'product_id'=>'ProductId',
'product_name'=>'ProductName',
));

$this->setParentList(array(
));

$this->setDependentList(array(
'BugsProductsIbfk2' => array(
'property' => 'BugsProducts',
'table_name' => 'BugsProducts',
),
));
}

/**
* Sets column product_id
*
* @param int $data
* @return Weez\Core\Model\Model\Products
*/
public function setProductId($data)
{
$this->_ProductId = $data;
return $this;
}

/**
* Gets column product_id
*
* @return int
*/
public function getProductId()
{
return $this->_ProductId;
}

/**
* Sets column product_name
*
* @param string $data
* @return Weez\Core\Model\Model\Products
*/
public function setProductName($data)
{
$this->_ProductName = $data;
return $this;
}

/**
* Gets column product_name
*
* @return string
*/
public function getProductName()
{
return $this->_ProductName;
}

/**
* Sets dependent relations bugs_products_ibfk_2
*
* @param array $data An array of Weez\Core\Model\Model\BugsProducts
* @return Weez\Core\Model\Model\Products
*/
public function setBugsProducts(array $data)
{
$this->_BugsProducts = array();

foreach ($data as $object) {
$this->addBugsProducts($object);
}

return $this;
}

/**
* Sets dependent relations bugs_products_ibfk_2
*
* @param Weez\Core\Model\Model\BugsProducts $data
* @return Weez\Core\Model\Model\Products
*/
public function addBugsProducts(\Weez\Core\Model\Model\BugsProducts $data)
{
$this->_BugsProducts[] = $data;
return $this;
}

/**
* Gets dependent bugs_products_ibfk_2
*
* @param boolean $load Load the object if it is not already
* @return array The array of Weez\Core\Model\Model\BugsProducts
*/
public function getBugsProducts($load = true)
{
if ($this->_BugsProducts === null && $load) {
$this->getMapper()->loadRelated('BugsProductsIbfk2', $this);
}

return $this->_BugsProducts;
}

/**
* Returns the mapper class for this model
*
* @return Weez\Core\Model\Model\Mapper\Products
*/
public function getMapper()
{
if ($this->_mapper === null) {
$this->setMapper(new \Weez\Core\Model\Model\Mapper\Products());
}

return $this->_mapper;
}

/**
* Deletes current row by deleting the row that matches the primary key
*
* @see Weez\Core\Model\Model\Mapper\Products::delete
* @return int|boolean Number of rows deleted or boolean if doing soft delete
*/
public function deleteRowByPrimaryKey()
{
if ($this->getProductId() === null) {
throw new \Exception('Primary Key does not contain a value');
}

return $this->getMapper()
->getDbTable()
->delete('product_id = ' .
$this->getMapper()
->getDbTable()
->getAdapter()
->quote($this->getProductId()));
}
}
