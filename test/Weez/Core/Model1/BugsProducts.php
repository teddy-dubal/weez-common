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
class BugsProducts extends ModelAbstract
{

/**
* Database var type int(11)
*
* @var int
*/
protected $_BugId;

/**
* Database var type int(11)
*
* @var int
*/
protected $_ProductId;


/**
* Parent relation bugs_products_ibfk_1
*
* @var Weez\Core\Model\Model\Bugs
*/
protected $_Bug;

/**
* Parent relation bugs_products_ibfk_2
*
* @var Weez\Core\Model\Model\Products
*/
protected $_Product;


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
'bug_id'=>'BugId',
'product_id'=>'ProductId',
));

$this->setParentList(array(
'BugsProductsIbfk1'=> array(
'property' => 'Bug',
'table_name' => 'Bugs',
),
'BugsProductsIbfk2'=> array(
'property' => 'Product',
'table_name' => 'Products',
),
));

$this->setDependentList(array(
));
}

/**
* Sets column bug_id
*
* @param int $data
* @return Weez\Core\Model\Model\BugsProducts
*/
public function setBugId($data)
{
$this->_BugId = $data;
return $this;
}

/**
* Gets column bug_id
*
* @return int
*/
public function getBugId()
{
return $this->_BugId;
}

/**
* Sets column product_id
*
* @param int $data
* @return Weez\Core\Model\Model\BugsProducts
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
* Sets parent relation Bug
*
* @param Weez\Core\Model\Model\Bugs $data
* @return Weez\Core\Model\Model\BugsProducts
*/
public function setBug(\Weez\Core\Model\Model\Bugs $data)
{
$this->_Bug = $data;

$primary_key = $data->getPrimaryKey();
if (is_array($primary_key)) {
$primary_key = $primary_key['bug_id'];
}

$this->setBugId($primary_key);

return $this;
}

/**
* Gets parent Bug
*
* @param boolean $load Load the object if it is not already
* @return Weez\Core\Model\Model\Bugs
*/
public function getBug($load = true)
{
if ($this->_Bug === null && $load) {
$this->getMapper()->loadRelated('BugsProductsIbfk1', $this);
}

return $this->_Bug;
}

/**
* Sets parent relation Product
*
* @param Weez\Core\Model\Model\Products $data
* @return Weez\Core\Model\Model\BugsProducts
*/
public function setProduct(\Weez\Core\Model\Model\Products $data)
{
$this->_Product = $data;

$primary_key = $data->getPrimaryKey();
if (is_array($primary_key)) {
$primary_key = $primary_key['product_id'];
}

$this->setProductId($primary_key);

return $this;
}

/**
* Gets parent Product
*
* @param boolean $load Load the object if it is not already
* @return Weez\Core\Model\Model\Products
*/
public function getProduct($load = true)
{
if ($this->_Product === null && $load) {
$this->getMapper()->loadRelated('BugsProductsIbfk2', $this);
}

return $this->_Product;
}

/**
* Returns the mapper class for this model
*
* @return Weez\Core\Model\Model\Mapper\BugsProducts
*/
public function getMapper()
{
if ($this->_mapper === null) {
$this->setMapper(new \Weez\Core\Model\Model\Mapper\BugsProducts());
}

return $this->_mapper;
}

/**
* Deletes current row by deleting the row that matches the primary key
*
* @see Weez\Core\Model\Model\Mapper\BugsProducts::delete
* @return int|boolean Number of rows deleted or boolean if doing soft delete
*/
public function deleteRowByPrimaryKey()
{
$primary_key = array();
if (! $this->getBugId()) {
throw new \Exception('Primary Key BugId does not contain a value');
} else {
$primary_key['bug_id'] = $this->getBugId();
}

if (! $this->getProductId()) {
throw new \Exception('Primary Key ProductId does not contain a value');
} else {
$primary_key['product_id'] = $this->getProductId();
}

return $this->getMapper()->getDbTable()->delete('bug_id = '
. $this->getMapper()->getDbTable()->getAdapter()->quote($primary_key['bug_id'])
. ' AND product_id = '
. $this->getMapper()->getDbTable()->getAdapter()->quote($primary_key['product_id']));
}
}
