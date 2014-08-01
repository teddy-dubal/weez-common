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
class User extends ModelAbstract
{

/**
* Database var type int(10) unsigned
*
* @var int
*/
protected $_Id;

/**
* Database var type varchar(20)
*
* @var string
*/
protected $_Name;



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
'id'=>'Id',
'name'=>'Name',
));

$this->setParentList(array(
));

$this->setDependentList(array(
));
}

/**
* Sets column id
*
* @param int $data
* @return Weez\Core\Model\Model\User
*/
public function setId($data)
{
$this->_Id = $data;
return $this;
}

/**
* Gets column id
*
* @return int
*/
public function getId()
{
return $this->_Id;
}

/**
* Sets column name
*
* @param string $data
* @return Weez\Core\Model\Model\User
*/
public function setName($data)
{
$this->_Name = $data;
return $this;
}

/**
* Gets column name
*
* @return string
*/
public function getName()
{
return $this->_Name;
}

/**
* Returns the mapper class for this model
*
* @return Weez\Core\Model\Model\Mapper\User
*/
public function getMapper()
{
if ($this->_mapper === null) {
$this->setMapper(new \Weez\Core\Model\Model\Mapper\User());
}

return $this->_mapper;
}

/**
* Deletes current row by deleting the row that matches the primary key
*
* @see Weez\Core\Model\Model\Mapper\User::delete
* @return int|boolean Number of rows deleted or boolean if doing soft delete
*/
public function deleteRowByPrimaryKey()
{
if ($this->getId() === null) {
throw new \Exception('Primary Key does not contain a value');
}

return $this->getMapper()
->getDbTable()
->delete('id = ' .
$this->getMapper()
->getDbTable()
->getAdapter()
->quote($this->getId()));
}
}
